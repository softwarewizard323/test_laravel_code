<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class ActiveGuest extends Model
{
    protected $table = 'ev_active_guests';
    protected $primaryKey = 'ip';

    public $incrementing = false;
    public $timestamps = false;
}
