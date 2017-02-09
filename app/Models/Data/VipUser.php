<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class VipUser extends Model
{
    protected $table = 'tbl_vip_users';
    protected $primaryKey = 'vip_user_id';

    public $timestamps = false;

    public static function getVip($user)
    {
        return self::where('username', $user->username)->first();
    }
}
