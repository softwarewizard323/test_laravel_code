<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $table = 'tbl_source';
    protected $primaryKey = 'source_id';

    protected $fillable = ['source_name', 'source_desc', 'source_country', 'source_price', 'source_dripfeed', 'source_subscribe', 'source_status', 'source_discount'];

    public $timestamps = false;

    private static $discount;

    public function getJsonPricesAttribute()
    {
        $countries = explode(',', $this->source_country);
        $prices = explode(';', $this->source_price);

        return json_encode(array_combine($countries, $prices));
    }

    public function getJsonVipPricesAttribute()
    {
        if (!self::$discount) {
            $user = \Auth::getUser();
            self::$discount = VipUser::getVip($user)->discount;
        }

        $countries = explode(',', $this->source_country);
        $prices = explode(';', $this->source_price);
        $_prices = [];

        foreach ($prices as $price) {
            $_prices[] = $price - self::$discount;
        }

        return json_encode(array_combine($countries, $_prices));
    }
}
