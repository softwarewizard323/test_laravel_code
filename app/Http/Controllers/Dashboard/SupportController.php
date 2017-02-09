<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Data\AdminTicketStatus;
use App\Models\Data\NewConversionOrder;
use App\Models\Data\NewOrder;
use App\Models\Data\Ticket;
use App\Models\Data\TicketRating;
use App\Models\Data\TicketReplay;
use App\Models\Data\UserTicketStatus;
use App\Models\Data\WebsiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class SupportController extends Controller
{
    public static $TYPES = [
        'cosmetic' => 'for Cosmetic Traffic',
        'conversion' => 'for Conversion Traffic',
        'other' => 'for Other'
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('maintenance');
        $this->middleware('banned');
    }

    public function index()
    {
        $user = \Auth::getUser();
        return view('dashboard.support.index', [
            'check_tickets' => WebsiteSetting::get('tickets'),
            'tickets' => Ticket::where('userUsername', $user->username)->orderBy('ticket_status', 'desk')->get(),
        ]);
    }

    public function create($type)
    {
        if (!array_key_exists($type, self::$TYPES)) {
            abort(404);
        }

        $user = \Auth::user();
        return view('dashboard.support.create', [
            'orders' => NewOrder::where('username', $user->username)->orderBy('order_id')->get(),
            'conversions' => NewConversionOrder::where('user', $user->username)->orderBy('co_id')->get(),
            'check_tickets' => WebsiteSetting::get('tickets'),
            'type' => $type,
        ]);
    }

    public function process($type)
    {
        if (!array_key_exists($type, self::$TYPES)) {
            abort(404);
        }

        $user = \Auth::user();

        $ticket = new Ticket();
        $ticket->ticket_title = Input::get('ticketTitle');
        $ticket->ticket_text = Input::get('ticketText');
        $ticket->userUsername = $user->username;
        $ticket->ticket_orderID = Input::get('OrderID') ? Input::get('OrderID') : 0;
        $ticket->corder_id = Input::get('COrderID') ? Input::get('COrderID') : 0;
        $ticket->ticket_priority = Input::get('ticketPriority');
        $ticket->ticket_status = 1;
        $ticket->save();

        $admin_status = new AdminTicketStatus();
        $admin_status->adminUsername = '';
        $admin_status->ticket_id = $ticket->ticket_id;
        $admin_status->ticket_status = 0;
        $admin_status->save();

        $user_status = new UserTicketStatus();
        $user_status->ticket_id = $ticket->ticket_id;
        $user_status->userUsername = $user->username;
        $user_status->ticket_status = 1;
        $user_status->save();

        \Session::flash('status', true);
        return redirect(url('/dashboard/support'));
    }

    public function view($sid)
    {
        $user = \Auth::user();
        $ticket = Ticket::find($sid);

        if(!$ticket || $ticket->userUsername != $user->username) {
            return redirect('/dashboard/support');
        }

        UserTicketStatus::where('ticket_id', $ticket->ticket_id)->update(['ticket_status' => 1]);

        return view('dashboard.support.view', [
            'check_tickets' => WebsiteSetting::get('tickets'),
            'ticket' => $ticket
        ]);
    }

    public function answer($sid)
    {
        $user = \Auth::user();
        $ticket = Ticket::find($sid);

        if(!$ticket || $ticket->userUsername != $user->username) {
            return redirect('/dashboard/support');
        }

        $replay = new TicketReplay();
        $replay->ticket_id = $ticket->ticket_id;
        $replay->userUsername = $user->username;
        $replay->ticket_reply_text = Input::get('ticketText');
        $replay->save();

        AdminTicketStatus::where('ticket_id', $ticket->ticket_id)->update(['ticket_status' => 0]);

        if ($ticket->ticket_status == 0) {
            $ticket->ticket_status = 1;
            $ticket->save();
        }

        return redirect('/dashboard/support/view/'.$ticket->ticket_id);
    }

    public function delete($id)
    {
        foreach (Input::get('checkbox') as $checkbox)
        {
            Ticket::where('ticket_id', $checkbox)->delete();
            AdminTicketStatus::where('ticket_id', $checkbox)->delete();
            UserTicketStatus::where('ticket_id', $checkbox)->delete();
        }

        return redirect('/dashboard/support');
    }

    public function solve(Request $request, $sid)
    {
        $user = \Auth::user();
        $ticket = Ticket::find($sid);
        if ($ticket) {
            $ticket->ticket_status = 2;
            if ($request->isMethod('get')) {
                if($ticket->userUsername == $user->username) {
                    $ticket->save();
                }
            } else {
                $ticket->save();
            }
        }

        return redirect('/dashboard/support');
    }

    public function star($sid)
    {
        $ticket = Ticket::find($sid);
        if(!$ticket) {
            return redirect('/dashboard/support');
        }

        $star1 = Input::get('star1');
        $star2 = Input::get('star2');
        $star3 = Input::get('star3');
        $star4 = Input::get('star4');
        $star5 = Input::get('star5');

        if ($star1 == 'undefined') {$ratingValue = 1;}
        if ($star2 == 'undefined') {$ratingValue = 2;}
        if ($star3 == 'undefined') {$ratingValue = 3;}
        if ($star4 == 'undefined') {$ratingValue = 4;}
        if ($star5 == 'undefined') {$ratingValue = 5;}

        $rating = new TicketRating();
        $rating->ticket_rating_value = $ratingValue;
        $rating->ticket_rid = Input::get('ticketRID');
        $rating->ticket_id = $ticket->ticket_id;
        $rating->userUsername = \Auth::user()->username;
        $rating->save();

        return redirect('/dashboard/support/view/'.$ticket->ticket_id);
    }
}