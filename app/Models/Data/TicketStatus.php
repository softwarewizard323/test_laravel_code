<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    protected $table = 'ev_user_ticket_status';
    protected $primaryKey = null;

    public $incrementing = false;
    public $timestamps = false;
}
