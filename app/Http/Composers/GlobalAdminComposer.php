<?php

namespace App\Http\Composers;

use App\Models\Data\ActiveGuest;
use App\Models\Data\ActiveUser;
use App\Models\Data\AdminMessage;
use App\Models\Data\AdminMessageStatus;
use App\Models\Data\AdminTicketStatus;
use App\Models\Domain\Active;
use App\Models\Domain\Dashboard;
use Illuminate\Contracts\View\View;

class GlobalAdminComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = \Auth::user();
        if ($user)
        {
            // Auto update logged user to active status
            Active::addUser($user);

            $view->with('user', $user);
            $view->with('gravatar_url', $user->gravatar);

            $activeGuests = ActiveGuest::count();
            $view->with('active_guests', $activeGuests);

            $activeUsers = ActiveUser::count();
            $view->with('active_users', $activeUsers);

            $messagesCount = AdminMessageStatus::where('messageStatus', 0)->where('adminUsername', $user->username)->count();
            $view->with('messagesCount', $messagesCount);

            $ticketsCount = AdminTicketStatus::where('ticket_status', 0)->count();
            $view->with('ticketsCount', $ticketsCount);

            $messages = AdminMessage::join('tbl_admin_message_status', 'tbl_admin_message.messageID', '=', 'tbl_admin_message_status.messageID')
                ->where('tbl_admin_message_status.adminUsername', $user->username)->where('messageStatus', 0)
                ->orderBy('statusUpdated', 'desc')->limit(5)->get();
            $view->with('messages', $messages);
        }
    }

}