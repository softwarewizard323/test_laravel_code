<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class MessageStatus extends Model
{
    protected $table = 'tbl_message_status';
    protected $primaryKey = null;

    public $incrementing = false;
    public $timestamps = false;
}
