<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class AccountBalance extends Model
{
    protected $table = 'tbl_account_balance';
    protected $primaryKey = 'ab_id';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\Data\User', 'username', 'username');
    }
}
