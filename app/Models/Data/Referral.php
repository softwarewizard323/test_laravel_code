<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    const TYPE_NEW = 'bmpl';

    protected $table = 'tbl_referral';
    protected $primaryKey = 'ref_id';

    public $timestamps = false;
}
