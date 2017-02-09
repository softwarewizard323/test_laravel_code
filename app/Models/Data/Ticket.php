<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'ev_tickets';
    protected $primaryKey = 'ticket_id';

    private $_avg = null;
    private $_replay = null;
    private $_ticketStatus = null;

    public $timestamps = false;

    public function getUserTicketStatusAttribute()
    {
        if (!$this->_ticketStatus){
            $user = \Auth::user();
            $this->_ticketStatus = UserTicketStatus::where('userUsername', $user->username)->where('ticket_id', $this->ticket_id)->first();
        }
        return $this->_ticketStatus;
    }

    public function getReplayAttribute()
    {
        if (!$this->_replay) {
            $this->_replay = TicketReplay::where('ticket_id', $this->ticket_id)->groupBy('ticket_rid')->orderBy('ticket_replay_date', 'desk')->first();
        }
        return $this->_replay;
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Data\TicketReplay', 'ticket_id')->orderBy('ticket_replay_date');
    }

    public function getRatingAttribute()
    {
        return TicketRating::where('ticket_id', $this->ticket_id)->first();
    }

    public function getAvgRatingAttribute()
    {
        if (!$this->_avg) {
            $this->_avg = TicketRating::select(\DB::raw('count(ticket_rating_id) as count_rating, sum(ticket_rating_value) as sum_value, ticket_rid'))
                ->where('ticket_id', $this->ticket_id)->first();
        }
        return $this->_avg;
    }

    public function getCountUserTicketStatusesAttribute()
    {
        $user = \Auth::user();
        return UserTicketStatus::where('userUsername', $user->username)->where('ticket_id', $this->ticket_id)->where('ticket_status', 0)->count();
    }

    public function adminTicketStatus()
    {
        return $this->hasOne('App\Models\Data\AdminTicketStatus', 'ticket_id');
    }

    public function rating()
    {
        return $this->hasOne('App\Models\Data\TicketRating', 'ticket_id');
    }

}
