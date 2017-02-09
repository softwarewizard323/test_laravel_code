<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    protected $table = 'ev_user_settings';
    protected $primaryKey = null;

    public $incrementing = false;
    public $timestamps = false;

    public function userSetting()
    {
        return $this->belongsTo('App\Models\Data\User', 'username', 'username');
    }
}
