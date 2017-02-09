<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class AdminMessage extends Model
{
    protected $table = 'tbl_admin_message';
    protected $primaryKey = 'messageID';

    public $timestamps = false;

    public function status()
    {
        return $this->hasOne('App\Models\Data\AdminMessageStatus', 'messageID');
    }

    public function reply()
    {
        return $this->hasOne('App\Models\Data\MessageReply', 'messageID')->orderBy('msgReplyDate');
    }

    public function replies()
    {
        return $this->hasMany('App\Models\Data\MessageReply', 'messageID')->orderBy('msgReplyDate');
    }

    public function signature()
    {
        return $this->belongsTo('App\Models\Data\Signature', 'signature_id');
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Data\Order', 'orderID', 'order_id');
    }

    public function getPackageMasterNameAttribute()
    {
        if ($this->order) {
            if ($this->order->packageDetails) {
                if ($this->order->packageDetails->packageMaster) {
                    return $this->order->packageDetails->packageMaster->package_master_name;
                } else { return false; }
            } else { return false; }
        } else { return false; }
    }

    public function getPackageNameAttribute()
    {
        if ($this->order) {
            if ($this->order->packageDetails) {
                return $this->order->packageDetails->packageMaster->package_name;
            } else { return false; }
        } else { return false; }
    }
}
