<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Data\NewOrder;
use App\Models\Data\UserSettings;
use App\Repositories\BoosterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Auth\Authenticatable;

class BoosterController extends Controller
{
    private $booster;

    public function __construct(BoosterRepository $booster)
    {
        $this->middleware('auth');
        $this->middleware('maintenance');
        $this->middleware('banned');

        $this->booster = $booster;
    }

    public function google(Authenticatable $user)
    {
        return view('dashboard.booster.google', [
            'user' => $user,
            'vip' => $this->booster->vip($user),
            'sources' => $this->booster->sources(1),
            'dailySpending' => $this->booster->dailySpending($user),
        ]);
    }

    public function googleSetup(Authenticatable $user)
    {
        $country = Input::get('country');
        if (!$country || $country == '') {
            return redirect('/dashboard/booster/google');
        }

        return view('dashboard.booster.google-setup', [
            'user' => $user,
            'price' => Input::get('price'),
            'country' => $country,
            'traffic_type' => Input::get('traffic-type'),
            'source_name' => Input::get('source'),
            'source' => $this->booster->source(Input::get('source')),
            'countDripFeed' => $this->booster->countDripfeed($country),
        ]);
    }

    public function googleConfirm(Authenticatable $user)
    {
        $country = Input::get('country');
        if (!$country || $country == '') {
            return redirect('/dashboard/booster/google');
        }

        $source = Input::get('source');

        $add_price = 0;
        $ga_track = Input::get('ga_track');
        if ($ga_track == 'free') { $add_price = 0; }
        if ($ga_track == 'basic') { $add_price = 0.50; }

        //logic to get and combine all the keywords
        $sum = 0;
        $keywordtextarray = array();
        $keywordcountarray = array();
        foreach($_POST as $key => $value ) {
            //check if there is a keyword variable.
            if ( strpos($key,'keywordtext') !== false){ $keywordtextarray[] = $value; }
            if ( strpos($key,'keywordcount') !== false){ $keywordcountarray[] = $value; $sum = $sum + $value; }
        }

        //now join both the arrays
        $combinedKeywords =  join(";", $keywordtextarray);
        $combinedCounts = join(";", $keywordcountarray);

        $totalPrice = Input::get('totalprice') ? Input::get('totalprice') : 0;
        $totalPrice = $totalPrice + $add_price;

        //did user selected 24dripfeed
        $dripfeed = Input::get('dripfeed');

        return view('dashboard.booster.google-confirm', [
            'user' => $user,
            'source' => $source,
            'source_name' => $this->booster->source($source),
            'type' => Input::get('type'),
            'sum' => $sum,
            'ga_track' => $ga_track,
            'ga_tracking_code' => Input::get('ga_tracking_code'),
            'country' => $country,
            'google_tld' => Input::get('google_tld'),
            'combinedKeywords' => $combinedKeywords,
            'combinedCounts' => $combinedCounts,
            'totalPrice' => $totalPrice,
            'websiteurl' => Input::get('website'),
            'dripfeed' => (isset($dripfeed) && $dripfeed == 'Yes') ? 1 : 0,

        ]);
    }

    public function googleComplete(Authenticatable $user, Request $request)
    {
        if ($request->isMethod('get')) {
            return view('dashboard.booster.google-complete');
        }

        $country = Input::get('country');
        if (!$country || $country == '') {
            return redirect('/dashboard/booster/google');
        }

        $order = new NewOrder();
        $order->username = $user->username;
        $order->source = Input::get('source');
        $order->country = trim(Input::get('country'));
        $order->quantity = Input::get('combinedCounts');
        $order->total_quantity = Input::get('sum');
        $order->website = Input::get('websiteurl');
        $order->keywords = Input::get('combinedKeywords');
        $order->price = Input::get('totalPrice');
        $order->google_ext = Input::get('google_tld');
        $order->ga_track = Input::get('ga_track');
        $order->ga_tracking_code = Input::get('ga_tracking_code');
        $order->type = Input::get('type');
        $order->dripfeed = Input::get('dripfeed');
        $order->discount = '0';
        $order->subscribe = '1';
        $order->date = date("Y-m-d H:i:s");
        $order->save();

        $new_balance = $user->settings->account_balance - (Input::get('additionalKeywords') ? Input::get('additionalKeywords') : 0);
        UserSettings::where('username', $user->username)->update(['account_balance' => $new_balance]);

        return redirect('/dashboard/booster/google/complete');
    }

    public function direct(Authenticatable $user)
    {
        return view('dashboard.booster.direct', [
            'user' => $user,
            'vip' => $this->booster->vip($user),
            'sources' => $this->booster->sources(3),
            'dailySpending' => $this->booster->dailySpending($user),
        ]);
    }

    public function directSetup(Authenticatable $user)
    {
        $country = Input::get('country');
        if (!$country || $country == '') {
            return redirect('/dashboard/booster/direct');
        }

        return view('dashboard.booster.direct-setup', [
            'user' => $user,
            'price' => Input::get('price'),
            'country' => $country,
            'traffic_type' => Input::get('traffic-type'),
            'source_name' => Input::get('source'),
            'source' => $this->booster->source(Input::get('source')),
            'countDripFeed' => $this->booster->countDripfeed($country),
        ]);
    }

    public function directConfirm(Authenticatable $user)
    {
        $country = Input::get('country');
        if (!$country || $country == '') {
            return redirect('/dashboard/booster/google');
        }

        $source = Input::get('source');

        //logic to get and combine all the keywords
        $sum = 0;
        $keywordtextarray = array();
        $keywordcountarray = array();
        foreach($_POST as $key => $value ) {
            //check if there is a keyword variable.
            if ( strpos($key,'keywordtext') !== false){ $keywordtextarray[] = $value; }
            if ( strpos($key,'keywordcount') !== false){ $keywordcountarray[] = $value; $sum = $sum + $value; }
        }

        //now join both the arrays
        $combinedKeywords =  join(";", $keywordtextarray);
        $combinedCounts = join(";", $keywordcountarray);
        $totalPrice = Input::get('totalprice') ? Input::get('totalprice') : 0;

        //did user selected 24dripfeed
        $dripfeed = Input::get('dripfeed');

        return view('dashboard.booster.direct-confirm', [
            'user' => $user,
            'source' => $source,
            'source_name' => $this->booster->source($source),
            'type' => Input::get('type'),
            'sum' => $sum,
            'country' => $country,
            'combinedKeywords' => $combinedKeywords,
            'combinedCounts' => $combinedCounts,
            'totalPrice' => $totalPrice,
            'websiteurl' => Input::get('website'),
            'dripfeed' => (isset($dripfeed) && $dripfeed == 'Yes') ? 1 : 0,

        ]);
    }


    public function directComplete(Authenticatable $user, Request $request)
    {
        if ($request->isMethod('get')) {
            return view('dashboard.booster.direct-complete');
        }

        $country = Input::get('country');
        if (!$country || $country == '') {
            return redirect('/dashboard/booster/google');
        }

        $order = new NewOrder();
        $order->username = $user->username;
        $order->source = Input::get('source');
        $order->country = trim(Input::get('country'));
        $order->quantity = Input::get('combinedCounts');
        $order->total_quantity = Input::get('sum');
        $order->website = Input::get('websiteurl');
        $order->keywords = Input::get('combinedKeywords');
        $order->price = Input::get('totalPrice');
        $order->type = Input::get('type');
        $order->dripfeed = Input::get('dripfeed');
        $order->discount = '0';
        $order->subscribe = '1';
        $order->date = date("Y-m-d H:i:s");
        $order->save();

        $new_balance = $user->settings->account_balance - (Input::get('additionalKeywords') ? Input::get('additionalKeywords') : 0);
        UserSettings::where('username', $user->username)->update(['account_balance' => $new_balance]);

        return redirect('/dashboard/booster/direct/complete');
    }
}
