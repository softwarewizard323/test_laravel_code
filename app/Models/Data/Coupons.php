<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    protected $table = 'tbl_coupons';
    protected $primaryKey = 'coupon_id';

    public $timestamps = false;
}
