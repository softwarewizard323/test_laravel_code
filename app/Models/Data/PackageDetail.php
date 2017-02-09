<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model
{
    protected $table = 'tbl_package_details';
    protected $primaryKey = 'pdid';

    public $timestamps = false;

    public function master()
    {
        return $this->belongsTo('App\Models\Data\PackageMaster', 'mid', 'mid');
    }
}
