<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class AdminTicketStatus extends Model
{
    protected $table = 'ev_admin_ticket_status';
    protected $primaryKey = null;

    public $incrementing = false;
    public $timestamps = false;
}
