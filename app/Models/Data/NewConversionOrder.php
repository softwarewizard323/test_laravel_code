<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class NewConversionOrder extends Model
{
    protected $table = 'tbl_new_conversion_orders';
    protected $primaryKey = 'co_id';

    public $timestamps = false;

    public function getAdminMessageCheckAttribute()
    {
        return AdminMessage::join('tbl_admin_message_status', 'tbl_admin_message.messageID', '=', 'tbl_admin_message_status.messageID')
            ->where('orderID', $this->order_id)->first();
    }

    public function getMessageCheckAttribute()
    {
        return AdminMessage::join('tbl_message_status', 'tbl_admin_message.messageID', '=', 'tbl_message_status.messageID')
            ->where('corder_id', $this->co_id)->where('messageStatus', 0)->first();
    }
}
