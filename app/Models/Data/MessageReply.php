<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class MessageReply extends Model
{
    protected $table = 'tbl_message_replies';
    protected $primaryKey = 'msgReplyID';

    public $timestamps = false;

    public function signature()
    {
        return $this->belongsTo('App\Models\Data\Signature', 'signature_id');
    }
}
