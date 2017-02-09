<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MessageNewFormRequest;
use App\Http\Requests\MessageReplyFormRequest;
use App\Models\Data\AdminMessageStatus;
use App\Models\Data\MessageReply;
use App\Models\Data\MessageStatus;
use App\Models\Data\NewConversionOrder;
use App\Models\Data\NewOrder;
use App\Models\Data\Signature;
use App\Models\Domain\SendMail;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use App\Models\Data\AdminMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class MessagesController extends Controller
{
    private $templates = [
        0 => '',
        1 => 'Hi Sir,<br><br>Your site is not indexed in Google, therefore we are unable to process it as Google Booster until it is indexed.<br><br>Would you like to wait for it to be indexed or perhaps send in direct traffic which doesnt require indexing?<br><br>Regards,<br>ExpressVisits Support',
        2 => 'Hi Sir,<br><br>your account balance is too low for us to start this campaign. Please increase your account balance by using <a href="http://expressvisits.com/panel/acc-balance.php">this page</a> or let us know if you have any questions.<br><br>Regards,<br>ExpressVisits Support',
        3 => 'Hi Sir,<br><br>We can only drive direct traffic to Blogspot URLs, please let me know if this is okay, or if you wish to use a non-blogspot URL for the Google Booster.<br><br>Regards,<br>ExpressVisits Support',
        4 => 'Hi Sir,<br><br>Your account has insufficient funds to run this campaign for $100 per day, as the minimum runtime is 2 days. Please topup an additional $100 to proceed. Alternatively, you may lower down the daily visits.<br><br>Regards,<br>ExpressVisits Support',
        5 => 'Hi Sir,<br><br>Your website seems to be down at this point of time, as it is showing an error.<br>You might want to fix it first before I process your campaign.<br><br>Best Regards,',
        6 => 'Hi Sir<br><br>Before proceeding on your campaign of 3000 visitors a day, may I know if you are aware you will need at least a good VPS server to handle the load?<br><br>3000 visitors browsing your website, and staying for few minutes each per day will take an intensive load on your server CPU memory.<br><br>If your server is unable to handle the load, the traffic you paid for will go to waste.<br><br>If you think your server is ready to handle the load, please do let me know and I will start your campaign right away. :)<br>',
        7 => 'Hello Sir,<br><br>To greatly thank you for the loyalty towards Expressvisits, we are happy to inform you that your account has been converted to VIP, and that you should see a VIP badge next to your username on the top left corner.<br><br>The main benefit of being VIP for now is that you will receive VIP discount of 20%. Your current campaigns will be amended to the new rate of immediate effect.<br><br>There will be more exclusive VIP rewards coming in time. We would like to assure you that Expressvisits is taking steps to improve the overall business, and treat our loyal clients better. We are confident that you will be happy with the new upcoming changes!<br>'
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Authenticatable $user)
    {
        $messages = AdminMessage::join('tbl_message_status', 'tbl_admin_message.messageID', '=', 'tbl_message_status.messageID');

        if ($user->username == 'piyushk61') {
            $messages = $messages->where('corder_id', '!=', '');
        }

        return view('admin.messages.index', [
            'messages' => $messages->orderBy('tbl_message_status.messageStatus', 'DESC')->orderBy('statusUpdated', 'DESC')->get()
        ]);
    }

    public function create(Authenticatable $user, MessageNewFormRequest $request, $id, $template = 0)
    {
        $order = NewOrder::where('order_id', $id)->first();
        if(!$order) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            return $this->createMessage($order, $user, $request, 'order');
        }

        return view('admin.messages.create', [
            'id' => $order->order_id,
            'username' => $order->username,
            'action' => url('/admin/message/new', ['id' => $order->order_id]),
            'content' => (array_key_exists($template, $this->templates)) ? $this->templates[$template] : '',
            'signatures' => Signature::get(),
        ]);
    }

    public function ccreate(Authenticatable $user, MessageNewFormRequest $request, $id, $template = 0)
    {
        $order = NewConversionOrder::where('co_id', $id)->first();
        if(!$order) {
            abort(404);
        }

        if ($request->isMethod('post')) {
            return $this->createMessage($order, $user, $request, 'conversion');
        }

        return view('admin.messages.create', [
            'id' => $order->co_id,
            'username' => $order->user,
            'action' => url('/admin/message/cnew', ['id' => $order->co_id]),
            'content' => (array_key_exists($template, $this->templates)) ? $this->templates[$template] : '',
            'signatures' => Signature::get(),
        ]);
    }

    public function createMessage($order, $user, $request, $type)
    {
        $message = new AdminMessage();
        if ($type == 'conversion') {
            $message->corder_id = $order->co_id;
        } else {
            $message->orderID = $order->order_id;
        }
        $message->adminUsername = $user->username;
        if ($type == 'conversion') {
            $message->userUsername = $order->user;
        } else {
            $message->userUsername = $order->username;
        }
        $message->messageText = $request->msgText;
        $message->messageTitle = $request->msgTitle;
        $message->signature_id = $request->signatureID;
        $message->save();

        $status = new AdminMessageStatus();
        $status->messageID = $message->messageID;
        $status->adminUsername = $message->adminUsername;
        $status->messageStatus = 1;
        $status->save();

        $status = new MessageStatus();
        $status->messageID = $message->messageID;
        $status->userUsername = $message->userUsername;
        $status->messageStatus = 0;
        $status->save();

        $user = User::where('username', $message->userUsername)->first();
        SendMail::sendMessage($user);

        return redirect(url('/admin/message', ['id' => $message->messageID]));
    }

    public function view(Authenticatable $user, $id)
    {
        $message = AdminMessage::find($id);

        AdminMessageStatus::where('messageID', $message->messageID)->update(['messageStatus' => 1]);

        return view('admin.messages.view', [
            'user' => $user,
            'message' => $message,
            'signatures' => Signature::get(),
        ]);
    }

    public function answer(Authenticatable $user, MessageReplyFormRequest $request, $id)
    {
        $message = AdminMessage::find($id);
        if($message) {
            $reply = new MessageReply();
            $reply->messageID = $message->messageID;
            $reply->userUsername = $request->userUsername;
            $reply->adminUsername = $user->username;
            $reply->msgReplyText = $request->msgAnswer;
            $reply->signature_id = $request->signatureID;
            $reply->save();

            MessageStatus::where('messageID', $message->messageID)->update(['messageStatus' => 0]);

            $user = User::where('username', $request->userUsername)->first();
            SendMail::sendMessage($user);
        }

        return redirect(url('/admin/message', ['id' => $message->messageID]));
    }

    public function delete()
    {
        if (Input::get('delete')) {
            if (!empty(Input::get('checkbox'))) {
                AdminMessage::whereIn('messageID', Input::get('checkbox'))->delete();
                AdminMessageStatus::whereIn('messageID', Input::get('checkbox'))->delete();
            }
        }

        return redirect(url('/admin/messages'));
    }

    public function unread($id)
    {
        AdminMessageStatus::where('messageID', $id)->update(['messageStatus' => 0]);
        return redirect(url('/admin/messages'));
    }
}