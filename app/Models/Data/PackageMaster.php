<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class PackageMaster extends Model
{
    protected $table = 'tbl_package_master';
    protected $primaryKey = 'mid';

    public $timestamps = false;
}
