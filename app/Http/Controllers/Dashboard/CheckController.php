<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Data\DripfeedCountry;
use App\Models\Data\Source;
use App\Models\Data\VipUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CheckController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('maintenance');
        $this->middleware('banned');
    }

    public function check($name)
    {
        $user = \Auth::user();

        switch ($name) {
            case 'balance' :
                echo ( $user->settings->account_balance >= Input::get('total')) ? 1 : 0;
                break;

            case 'google_prices' :
                $countrypost = Input::get('country');
                $source = Input::get('source');

                $query_vip = VipUser::where('username', $user->username)->where('status', '!=', 1)->first();
                $query_source = Source::where('source_id', $source)->first();

                $countries = explode(',', $query_source['source_country']);
                $prices = explode(';', $query_source['source_price']);

                $final_price = 0;

                if ($user->username == $query_vip['username']) {
                    foreach(array_combine($countries, $prices) as $country => $price){
                        if($country == $countrypost) {
                            $newprice = $price - $query_vip['discount'];
                            $final_price = $newprice;
                        }
                    }
                } else {
                    foreach(array_combine($countries, $prices) as $country => $price){
                        if($country == $countrypost) {
                            $final_price = $price;
                        }
                    }
                }

                echo $final_price;
                break;

            case 'country_drip_feed' :
                $country = Input::get('country');
                echo DripfeedCountry::where('country', $country)->count();
                break;

        }
    }
}
