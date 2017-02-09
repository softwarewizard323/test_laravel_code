<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class DripfeedCountry extends Model
{
    protected $table = 'tbl_dripfeed_countries';
    protected $primaryKey = 'dfc_id';

    public $timestamps = false;
}
