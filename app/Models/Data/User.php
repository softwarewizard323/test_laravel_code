<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'ev_users';

    public $timestamps = false;

    public function getOrdersAttribute()
    {
        return \DB::table('tbl_new_orders')->select(\DB::raw('sum(price) as sumPrice, count(order_id) as countOrders'))
            ->where('username', $this->username)->where('status', 1)->groupBy('username')->first();
    }

    public function getDailySpendingAttribute()
    {
        return (float) \Cache::remember('dailySpendingAttribute-'.$this->username, 60, function() {
            return ($this->orders) ? $this->orders->sumPrice : 0;
        });
    }

    public function getCountOrdersAttribute()
    {
        return \Cache::remember('countOrdersAttribute-'.$this->username, 60, function() {
            return ($this->orders) ? $this->orders->countOrders : 0;
        });
    }
}
