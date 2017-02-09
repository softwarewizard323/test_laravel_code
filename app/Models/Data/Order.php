<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'tbl_order';
    protected $primaryKey = 'order_id';

    public $timestamps = false;

    public function packageDetail()
    {
        return $this->belongsTo('App\Models\Data\PackageDetail', 'pkg_id', 'pdid');
    }
}
