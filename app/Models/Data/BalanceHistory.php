<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class BalanceHistory extends Model
{
    protected $table = 'tbl_balance_history';
    protected $primaryKey = 'dh_id';

    public $timestamps = false;
}
