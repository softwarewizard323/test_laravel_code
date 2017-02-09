<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class OrderEnd extends Model
{
    protected $table = 'tbl_order_end';
    protected $primaryKey = 'toe_id';

    public $timestamps = false;
}
