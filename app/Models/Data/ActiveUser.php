<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class ActiveUser extends Model
{
    protected $table = 'ev_active_users';
    protected $primaryKey = 'username';

    public $incrementing = false;
    public $timestamps = false;
}
