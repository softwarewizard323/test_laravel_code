<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Data\AdminMessageStatus;
use App\Models\Data\AdminTicketStatus;
use App\Models\Data\Signature;
use App\Models\Data\Ticket;
use App\Models\Data\TicketReplay;
use App\Models\Data\User;
use App\Models\Data\UserTicketStatus;
use App\Models\Domain\SendMail;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Input;

class SupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Authenticatable $user)
    {
        $tickets = Ticket::where('ticket_status', 1)->orderBy('ticket_status', 'DESC')->get();
        return view('admin.support.support-open', compact('user', 'tickets'));
    }

    public function ticketRead($id, Authenticatable $user)
    {
        $ticket = Ticket::find($id);
        $signatures = Signature::get();

        AdminTicketStatus::where('ticket_id', $ticket->ticket_id)->update(['ticket_status' => 1]);

        return view('admin.support.tickets-read', compact('ticket', 'user', 'signatures'));
    }

    public function ticketReply()
    {
        $model = new TicketReplay();
        $model->ticket_id = Input::get('TicketID');
        $model->userUsername = Input::get('userUsername');
        $model->adminUsername = Input::get('adminUsername');
        $model->ticket_reply_text = Input::get('ticketText');
        $model->signature_id = Input::get('signatureID');
        $model->save();

        UserTicketStatus::where('ticket_id', $model->ticket_id)->update(['ticket_status' => 0]);
        AdminTicketStatus::where('ticket_id', $model->ticket_id)->update(['ticket_status' => 1]);

        $ticket = Ticket::find($model->ticket_id);
        if ($ticket->ticket_status == 0) {
            $ticket->ticket_status = 1;
            $ticket->save();
        }

        $user = User::where('username', $model->userUsername)->first();
        SendMail::sendTicket($user, $model);

        return redirect(\URL::previous());
    }

    public function ticketClose($id)
    {
        Ticket::where('ticket_id', $id)->update(['ticket_status' => 0]);
        return redirect('/admin/support/archives');
    }

    public function ticketUnread($id)
    {
        $ticket = Ticket::where('ticket_id', $id)->first();
        AdminTicketStatus::where('ticket_id', $id)->update(['ticket_status' => 0]);
        if ($ticket->ticket_status) {
            return redirect('/admin/support');
        }
        return redirect('/admin/support/archives');
    }

    public function archiveSupport(Authenticatable $user)
    {
        $tickets = Ticket::where('ticket_status', 0)->orderBy('ticket_status', 'DESC')->get();
        return view('admin.support.support-archive', compact('user', 'tickets'));
    }

    public function groupDelete()
    {
        if (!empty(Input::get('checkbox'))) {
            Ticket::whereIn('ticket_id', Input::get('checkbox'))->delete();
            AdminTicketStatus::whereIn('ticket_id', Input::get('checkbox'))->delete();
        }

        return redirect(\URL::previous());
    }

}
