<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'tbl_faq';
    protected $primaryKey = 'faq_id';

    public $timestamps = false;
}
