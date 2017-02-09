<?php

namespace App\Http\Composers;

use App\Models\Data\AdminMessage;
use App\Models\Data\MessageStatus;
use App\Models\Data\UserTicketStatus;
use App\Models\Data\VipUser;
use App\Models\Domain\Active;
use App\Models\Domain\Dashboard;
use Illuminate\Contracts\View\View;

class GlobalComposer
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
            $view->with('user_settings', $user->settings);

            $messagesCount = MessageStatus::where('messageStatus', 0)->where('userUsername', $user->username)->count();
            $view->with('messagesCount', $messagesCount);

            $ticketsCount = UserTicketStatus::where('ticket_status', 0)->where('userUsername', $user->username)->count();
            $view->with('ticketsCount', $ticketsCount);

            $query_vip = VipUser::where('username', $user->username)->where('status', '!=', 1)->first();
            $view->with('query_vip', $query_vip);

            $messages = AdminMessage::join('tbl_message_status', 'tbl_admin_message.messageID', '=', 'tbl_message_status.messageID')
                ->where('tbl_message_status.userUsername', $user->username)->where('messageStatus', 0)
                ->orderBy('statusUpdated', 'desc')->get();
            $view->with('messages', $messages);
        }
    }

}