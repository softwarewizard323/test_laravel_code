<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Data\AccountBalance;
use App\Models\Data\Coupons;
use App\Models\Data\UserSettings;
use App\Models\Domain\Dashboard;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Http\Controllers\Controller;
use App\Models\Data\WebsiteSetting;
use Illuminate\Support\Facades\Input;
use Psy\Util\Json;


class BalanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('maintenance');
        $this->middleware('banned');
    }

    public function index(Authenticatable $user)
    {
        return view('dashboard.balance', [
            'user' => $user,
            'balance' => AccountBalance::where('username', $user->username)->where('status', 1)->orderBy('ab_id', 'desc')->get(),
            'check_minimal_upload' => WebsiteSetting::get('paypalMinimum'),
        ]);
    }
/*
    public function skrill()
    {
        $user = \Auth::user();

        $model = new PayPalBalance();
        $model->txn_id = Input::get('skrill_transaction');
        $model->mc_gross = Input::get('skrill_amount');
        $model->currency = 'USD';
        $model->payer_email = Input::get('skrill_email');
        $model->payment_made = time();
        $model->first_name = $user->fname;
        $model->last_name = $user->lname;
        $model->contact_phone = '';
        $model->residence_country = '';
        $model->username = $user->username;
        $model->IP = Dashboard::getIP();

        if ($model->save()) {
            \Session::flash('skrillSuccess', true);
        } else {
            \Session::flash('skrillFailed', true);
        }

        return redirect(url('/dashboard/mybalance'));
    }
*/
    public function voucher(Authenticatable $user)
    {
        $coupon = Coupons::where('coupon_code', Input::get('voucher'))->where('coupon_status', 1);

        if (Input::get('check')) {
            return Json::encode(['count' => $coupon->count()]);
        }

        $coupon = $coupon->first();
        if(!$coupon)
        {
            \Session::flash('voucherFailed', true);
            return redirect(url('/dashboard/balance'));
        }

        $balance = new AccountBalance();
        $balance->username = $user->username;
        $balance->ip_address_2 = $_SERVER['REMOTE_ADDR'];
        $balance->amount = $coupon->coupon_amount;
        $balance->status = 1;
        $balance->payment_method = 'Voucher';
        $balance->save();

//        $model = new PayPalBalance();
//        $model->txn_id = 'Voucher';
//        $model->mc_gross = $coupon->coupon_amount;
//        $model->currency = 'USD';
//        $model->payer_email = $coupon->coupon_code;
//        $model->payment_made = time();
//        $model->first_name = $user->fname;
//        $model->last_name = $user->lname;
//        $model->contact_phone = '';
//        $model->residence_country = '';
//        $model->username = $user->username;
//        $model->IP = Dashboard::getIP();
//        $model->save();

        $coupon->coupon_status = 0;
        $coupon->username = $user->username;
        $coupon->save();

        UserSettings::where('username', $user->username)->update(['account_balance' => $user->settings->account_balance + $coupon->coupon_amount]);

        \Session::flash('voucherSuccess', true);
        return redirect(url('/dashboard/balance'));
    }

    public function PayPal()
    {
        $user = \Auth::getUser();

        $accBalance = Input::get('accBalance');

        $balance = new AccountBalance();
        $balance->username = $user->username;
        $balance->ip_address = Input::get('ip_1');
        $balance->ip_address_2 = Input::get('ip_2');
        $balance->amount = $accBalance;
        $balance->payment_method = 'PayPal';
        $balance->save();

        $item_name = 'ExpressVisits-Balance';
        $item_number = $balance->ab_id;
        $currency_code = 'USD';
        $notify_url = url(\App\Models\Domain\Payment::$NOTIFY['balance']);
        $cancel_return = url('/dashboard/useful-services/website-builder');
        $return = url('/dashboard/useful-services/website-builder/return');

        $payPalUrl = (env('PAYPAL_USE_SANDBOX')) ? env('PAYPAL_URL_SANDBOX') : env('PAYPAL_URL_LIVE');
        $business = (env('PAYPAL_USE_SANDBOX')) ? env('PAYPAL_BUSINESS_SANDBOX') : env('PAYPAL_BUSINESS_LIVE');
        return redirect($payPalUrl.'?cmd=_xclick&business='.$business.'&currency_code='.$currency_code.'&item_number='.$item_number.'&amount='.$accBalance.'&item_name='.$item_name.'&custom='.Dashboard::getIP());
    }
}
