<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Data\AccountBalance;
use App\Models\Data\Coupons;
use App\Models\Data\DeductDate;
use App\Models\Data\NewOrder;
use App\Models\Data\User;
use App\Models\Data\UserSettings;
use App\Models\Data\VipUser;
use App\Repositories\NewOrderRepository;
use App\Repositories\UserSettingsRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Input;

class BalancesController extends Controller
{
    private $userSetting;
    private $order;

    public function __construct(UserSettingsRepository $userSetting, NewOrderRepository $order)
    {
        $this->middleware('auth');
        $this->middleware('admin');

        $this->userSetting = $userSetting;
        $this->order = $order;
    }

    public function manageBalance(Authenticatable $user)
    {
        $data = (object)[];
        $data->lastDeduct = DeductDate::where('status', 1)->orderBy('date', 'desc')->first();
        $data->earnings = AccountBalance::where('status', 1)
            ->where(\DB::raw('MONTH(date)'), '=', date('n'))
            ->where(\DB::raw('YEAR(date)'), '=', date('Y'))
            ->sum('amount');
        $data->users = User::join('ev_user_settings', 'ev_user_settings.username', '=', 'ev_users.username')->get();

        return view('admin.balances.manage-balance', compact('user', 'data'));
    }

    public function manageBalanceAll(Authenticatable $user)
    {
        $data = (object)[];
        // Select all new support tickets that user have received from admin.
        $data->lastDeduct = DeductDate::where('status', 1)->orderBy('date', 'desc')->first();
        $data->earnings = AccountBalance::where('status', 1)->where(\DB::raw('MONTH(date)'), '=', date('n'))->sum('amount');
        $data->users = User::join('ev_user_settings', 'ev_user_settings.username', '=', 'ev_users.username')->whereNotIn('ev_users.username', ['admin','boriszex'])->get();

        return view('admin.balances.manage-balance-all', compact('user', 'data'));
    }

    public function manageBalanceUpdate()
    {
        UserSettings::where('username', Input::get('username'))
            ->update(['account_balance' => Input::get('balance')]);
        return redirect(\URL::previous());
    }

    public function deductDate(Authenticatable $user)
    {
        $orders = NewOrder::select(\DB::raw('username, sum(price) as sumPrice'))->where('status', 1)->where('discount', 0)->groupBy('username')->get();
        foreach ($orders as $order) {
            $_user = UserSettings::where('username', $order->username)->first();
            $newBalance =  $_user->account_balance - $order->sumPrice;

            $account_balance = number_format((float)$newBalance, 2, '.', '');
            UserSettings::where('username', $order->username)->update(['account_balance' => $account_balance]);
        }

        \Artisan::call('cache:clear');

        DeductDate::create(['username' => $user->username, 'status' => 1]);
        return redirect(url('/admin/balance/manage'));
    }

    public function viewPayments(Authenticatable $user)
    {
        $data = (object)[];
        $data->allUsers = AccountBalance::where('status',1)->get();
        return view('admin.balances.view-payments', compact('user', 'data'));
    }

    public function voucher(Authenticatable $user)
    {
        $data = (object)[];
        $data->allVouchers = Coupons::where('coupon_status',1)->get();
        return view('admin.balances.vouchers', compact('user', 'data'));
    }

    public function voucherDelete($id)
    {
        Coupons::where('coupon_id', $id)->delete();
        return redirect(\URL::previous());
    }

    public function voucherCreate()
    {
        $model = new Coupons();
        $model->coupon_amount =	Input::get ('voucherAmount');

        $voucher_key = '';
        $c  = 'bcdfghjklmnprstvwz'; //consonants except hard to speak ones
        $v  = 'aeiou';              //vowels
        $a  = $c.$v;                //both

        //use two syllables...
        for($i=0;$i < 2; $i++){
            $voucher_key .= $c[rand(0, strlen($c)-1)];
            $voucher_key .= $v[rand(0, strlen($v)-1)];
            $voucher_key .= $a[rand(0, strlen($a)-1)];
        }
        //... and add a nice number
        $voucher_key .= rand(10,99);

        $model-> coupon_code = $voucher_key;
        $model-> coupon_status = 1;
        $model->save();

        return redirect(url('/admin/balance/vouchers'));
    }

    public function vipUser(Authenticatable $user)
    {
        $data = (object)[];
        $data->allVipUsers = VipUser::all();
        return view('admin.balances.vip-users', compact('user', 'data'));
    }

    public function vipUserDelete($id)
    {
        VipUser::where('vip_user_id', $id)->delete();
        return redirect(\URL::previous());
    }

    public function vipUserCreate()
    {
        $model = new VipUser();
        $model->username = Input::get('user');
        $model->discount = Input::get('amount');
        $model->save();

        return redirect(\URL::previous());
    }
}