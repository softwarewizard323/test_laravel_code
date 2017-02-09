<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class Traffic extends Model
{
    protected $table = 'tbl_traffics';

    public $timestamps = false;

    public function getTicketsAttribute()
    {
        $user = \Auth::user();
        return Ticket::where('userUsername', $user->username)->where('traffic_id', $this->id)->orderBy('ticket_status', 'desk')->get();
    }

    public function getCountUserTicketStatusAttribute()
    {
        $count = 0;
        foreach ($this->tickets as $ticket) {
            if ($ticket->countUserTicketStatuses > 0) {
                $count++;
            }
        }

        return $count;
    }
}
