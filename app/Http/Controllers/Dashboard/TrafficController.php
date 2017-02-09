<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Data\DripfeedCountry;
use App\Models\Data\MessageStatus;
use App\Models\Data\NewOrder;
use App\Models\Data\Source;
use App\Models\Data\UserSettings;
use App\Models\Data\UserTicketStatus;
use App\Models\Data\VipUser;
use App\Repositories\BoosterRepository;
use App\Repositories\NewOrderRepository;
use App\Repositories\UserSettingsRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TrafficController extends Controller
{
    private $userSetting;
    private $order;
    private $booster;

    public function __construct(UserSettingsRepository $userSetting, NewOrderRepository $order, BoosterRepository $booster)
    {
        $this->middleware('auth');
        $this->middleware('maintenance');
        $this->middleware('banned');

        $this->userSetting = $userSetting;
        $this->order = $order;
        $this->booster = $booster;
    }

    public function index()
    {
        return view('dashboard.traffic.index');
    }

    /*** High Clicks Booster ***/

    public function clicks(Authenticatable $user)
    {
        $data = (object)[];
        $dailySpending = $this->order->dailySpending($user);
        $data->dailySpendingSum = $dailySpending->sum('price');
        $data->lowBalanceCheck = $data->dailySpendingSum * 3;
        $data->accountBalance = $this->userSetting->userSettings($user)->account_balance;
        $data->source = Source::where('source_discount', 0)->where('source_type', 2)->get();
        $data->vip = VipUser::where('username', $user->username)->first();

        return view('dashboard.traffic.clicks', compact('user', 'data'));
    }

    public function clicksSetup(Authenticatable $user, Request $request)
    {
        $country = Input::get('country');
        if (!$country || $country == '') {
            return redirect('/dashboard/traffic/clicks');
        }

        $data = (object)[];
        $data->newMessagesCount = MessageStatus::where('messageStatus', 0)
            ->where('userUsername', $user->username)->get();
        $data->newTicketsCount = UserTicketStatus::where('ticket_status', 0)
            ->where('userUsername', $user->username)->get();

        $data->vipBadge = VipUser::where('username', $user->username)->get();
        $data->sourceTab = Source::where('source_id', Input::get('source'))->first();
        $data->countryDripFeed = DripfeedCountry::where('country', Input::get('country'))->first();
        $data->traffic = Input::get('traffic-type');
        $data->source = Input::get('source');
        $data->country = Input::get('country');
        $data->price = Input::get('price');

        return view('dashboard.traffic.clicks-setup', compact('user', 'data'));
    }

    public function clicksConfirm(Authenticatable $user, Request $request)
    {
        $country = Input::get('country');
        if (!$country || $country == '') {
            return redirect('/dashboard/traffic/clicks');
        }

        $data = (object)[];
        $data->sourceTab = Source::where('source_id', Input::get('source'))->first();
        $data->source = Input::get('source');
        $data->country = Input::get('country');
        $data->totalPrice = Input::get('totalprice');
        $data->websiteurl = Input::get('website');
        $data->type = Input::get('type');
        //did user selected 24dripfeed
        $data->dripfeed = (Input::get('dripfeed') == 'Yes') ? 1 : 0;
        //logic to get and combine all the keywords
        $data->sum = 0;
        $keywordtextarray = array();
        $keywordcountarray = array();
        foreach ($_POST as $key => $value) {
            //check if there is a keyword variable.
            if (strpos($key, 'keywordtext') !== false) {
                $keywordtextarray[] = $value;
            }
            if (strpos($key, 'keywordcount') !== false) {
                $keywordcountarray[] = $value;
                $data->sum = $data->sum + $value;
            }
        }
        //now join both the arrays
        $data->combinedKeywords = join(";", $keywordtextarray);
        $data->combinedCounts = join(";", $keywordcountarray);

        return view('dashboard.traffic.clicks-confirm', compact('user', 'data'));
    }

    public function clicksComplete(Authenticatable $user, Request $request)
    {
        if ($request->isMethod('get')) {
            return view('dashboard.traffic.clicks-complete');
        }

        $country = Input::get('country');
        if (!$country || $country == '') {
            return redirect('/dashboard/traffic/clicks');
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

        $new_balance = $user->settings->account_balance - Input::get('additionalKeywords');
        UserSettings::where('username', $user->username)->update(['account_balance' => $new_balance]);

        return view('dashboard.traffic.clicks-complete');
    }

    /*** Adsense Booster ***/

    public function adsense(Authenticatable $user)
    {
        $data = (object)[];
        $dailySpending = $this->order->dailySpending($user);
        $data->dailySpendingSum = $dailySpending->sum('price');
        $data->lowBalanceCheck = $data->dailySpendingSum * 3;
        $data->accountBalance = $this->userSetting->userSettings($user)->account_balance;
        $data->source = Source::whereIn('source_id', [12, 13])->get();
        $data->vip = VipUser::where('username', $user->username)->first();

        return view('dashboard.traffic.adsense', compact('user', 'data'));
    }

    public function adsenseSetup(Authenticatable $user, Request $request)
    {
        $country = Input::get('country');
        if (!$country || $country == '') {
            return redirect('/dashboard/traffic/adsense');
        }

        $data = (object)[];
        $data->traffic = Input::get('traffic-type');
        $data->source = Input::get('source');
        $data->country = Input::get('country');
        $data->price = Input::get('price');
        $data->referrer = Input::get('referrer');
        $data->countryDripFeed = DripfeedCountry::where('country', Input::get('country'))->first();
        $data->sourceTab = Source::where('source_id', Input::get('source'))->first();

        return view('dashboard.traffic.adsense-setup', compact('user', 'data'));
    }

    public function adsenseConfirm(Authenticatable $user, Request $request)
    {
        $country = Input::get('country');
        if (!$country || $country == '') {
            return redirect('/dashboard/traffic/adsense');
        }
        $data = (object)[];
        $data->sourceTab = Source::where('source_id', Input::get('source'))->first();
        $data->source = Input::get('source');
        $data->country = Input::get('country');
        $data->totalPrice = Input::get('totalprice');
        $data->google_tld = Input::get('google_tld');
        $data->ga_track = Input::get('ga_track');
        $data->referrer = Input::get('referrer');
        $data->ga_tracking_code = Input::get('ga_tracking_code');
//        if ($data->ga_track == 'free') {
//            $add_price = '0';
//        }
        $add_price = (Input::get('ga_track') == 'basic') ? 0.50 : 0;

        //did user selected 24dripfeed
        $data->dripfeed = (Input::get('dripfeed') == 'Yes') ? 1 : 0;
        //logic to get and combine all the keywords
        $data->sum = 0;
        $keywordtextarray = array();
        $keywordcountarray = array();
        foreach ($_POST as $key => $value) {
            //check if there is a keyword variable.
            if (strpos($key, 'keywordtext') !== false) {
                $keywordtextarray[] = $value;
            }
            if (strpos($key, 'keywordcount') !== false) {
                $keywordcountarray[] = $value;
                $data->sum = $data->sum + $value;
            }
        }
        //now join both the arrays
        $data->combinedKeywords = join(";", $keywordtextarray);
        $data->combinedCounts = join(";", $keywordcountarray);

        $data->totalPrice = Input::get('totalprice') + $add_price;
        $data->websiteurl = Input::get('website');
        $data->type = Input::get('type');

        return view('dashboard.traffic.adsense-confirm', compact('user', 'data'));
    }

    public function adsenseComplete(Authenticatable $user, Request $request)
    {
        if ($request->isMethod('get')) {
            return view('dashboard.traffic.adsense-complete');
        }

        $country = Input::get('country');
        if (!$country || $country == '') {
            return redirect('/dashboard/traffic/adsense');
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
        $order->type = 'Adsense '.$this->booster->source(Input::get('source'))->source_name.' - '.Input::get('referrer');
        $order->dripfeed = Input::get('dripfeed');
        $order->discount = '0';
        $order->subscribe = '1';
        $order->date = date("Y-m-d H:i:s");
        $order->save();

        $new_balance = $user->settings->account_balance - Input::get('additionalKeywords');
        UserSettings::where('username', $user->username)->update(['account_balance' => $new_balance]);

        return view('dashboard.traffic.adsense-complete');
    }
}
