<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class BannedUser extends Model
{
    protected $table = 'ev_banned_users';
    protected $primaryKey = 'username';

    public $incrementing = false;
    public $timestamps = false;
}
