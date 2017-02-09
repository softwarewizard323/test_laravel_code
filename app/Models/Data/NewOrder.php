<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class NewOrder extends Model
{
    protected $table = 'tbl_new_orders';
    protected $primaryKey = 'order_id';

    private $_messageCheck = null;
    private $_adminMessageCheck= null;

    public $timestamps = false;

    public function Source()
    {
        $foreignKey = ($this->adsense_tier == 'none') ? 'source' : 'adsense_tier';
        return $this->belongsTo('App\Models\Data\Source', $foreignKey, 'source_id');
    }

    public function End()
    {
        return $this->hasOne('App\Models\Data\OrderEnd', 'order_id');
    }

    public function getShortCountryAttribute()
    {
        return Country::getShortCountry($this->country);
    }

    public function getUserBalanceAttribute()
    {
        $user = UserSettings::where('username', $this->username)->first();
        return $user ? $user->account_balance : 0;
    }

    public function getAdminMessageCheckAttribute()
    {
        if (!$this->_adminMessageCheck) {
            $this->_adminMessageCheck = AdminMessage::join('tbl_admin_message_status', 'tbl_admin_message.messageID', '=', 'tbl_admin_message_status.messageID')
                ->where('orderID', $this->order_id)->first();
        }
        return $this->_adminMessageCheck;
    }

    public function getMessageCheckAttribute()
    {
        if (!$this->_messageCheck) {
            $this->_messageCheck = AdminMessage::join('tbl_message_status', 'tbl_admin_message.messageID', '=', 'tbl_message_status.messageID')
                ->where('orderID', $this->order_id)->where('messageStatus', 0)->first();
        }
        return $this->_messageCheck;
    }

    public function packageDetail()
    {
        return $this->belongsTo('App\Models\Data\PackageDetail', 'pkg_id', 'pdid');
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
