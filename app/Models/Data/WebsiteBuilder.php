<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class WebsiteBuilder extends Model
{
    protected $table = 'tbl_website_builder';
    protected $primaryKey = 'order_id';

    public $timestamps = false;
}
