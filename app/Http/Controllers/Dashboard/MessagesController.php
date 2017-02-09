<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\MessageReplyFormRequest;
use App\Models\Data\AdminMessageStatus;
use App\Models\Data\MessageReply;
use App\Models\Data\MessageStatus;
use Illuminate\Http\Request;
use App\Models\Data\AdminMessage;
use App\Http\Controllers\Controller;

class MessagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('maintenance');
        $this->middleware('banned');
    }

    public function index(Request $request)
    {
        $user = \Auth::user();
        $currentDate = date('d-m-Y', time());

        $messages = AdminMessage::join('tbl_message_status', 'tbl_admin_message.messageID', '=', 'tbl_message_status.messageID')
            ->where('tbl_admin_message.userUsername', $user->username);

        if ($request->ajax())
        {
            return view('dashboard.messages.ajax', [
                'messages' => $messages->orderBy('statusUpdated', 'DESC')->limit(15)->get(),
                'currentDate' => $currentDate
            ]);
        }

        return view('dashboard.messages.index', [
            'messages' => $messages->orderBy('tbl_message_status.messageStatus', 'DESC')->orderBy('statusUpdated', 'DESC')->get(),
            'currentDate' => $currentDate
        ]);
    }

    public function view($id)
    {
        $user = \Auth::user();

        $message = AdminMessage::find($id);

        if (!$message || $message->userUsername != $user->username) {
            return redirect('/dashboard/messages');
        }

        MessageStatus::where('messageID', $message->messageID)->update(['messageStatus' => 1]);

        return view('dashboard.messages.view', [
            'user' => $user,
            'message' => $message
        ]);
    }

    public function answer(MessageReplyFormRequest $request, $id)
    {
        $user = \Auth::user();
        $message = AdminMessage::find($id);

        if ($message->userUsername == $user->username)
        {
            $reply = new MessageReply();
            $reply->messageID = $message->messageID;
            $reply->userUsername = $user->username;
            $reply->adminUsername = $message->adminUsername;
            $reply->msgReplyText = $request->msgAnswer;
            $reply->msgIdentify = 1;
            $reply->save();

            AdminMessageStatus::where('messageID', $message->messageID)->update(['messageStatus' => 0]);
        }

        return redirect(url('/dashboard/message', ['id' => $message->messageID]));
    }
}