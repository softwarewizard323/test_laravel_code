<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class TicketRating extends Model
{
    protected $table = 'ev_tickets_ratings';
    protected $primaryKey = 'ticket_rating_id';

    public $timestamps = false;
}
