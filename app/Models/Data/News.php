<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'tbl_news';
    protected $primaryKey = 'news_id';

    public $timestamps = false;
}
