<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class TicketReplay extends Model
{
    protected $table = 'ev_tickets_replays';
    protected $primaryKey = 'ticket_rid';

    public $timestamps = false;

    public function getRatingAttribute()
    {
        return TicketRating::where('ticket_rid', $this->ticket_rid)->first();
    }

    public function getOwnerFullNameAttribute()
    {
        $user = \Auth::user();
        if ($this->adminUsername != ''){
            $user = User::where('username', $this->adminUsername)->first();
        }
        return $user->fname . ' ' .$user->lname;
    }

    public function signature()
    {
        return $this->belongsTo('App\Models\Data\Signature', 'signature_id');
    }
}
