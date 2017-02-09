<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Data\WebsiteBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Domain\Dashboard;
use App\Models\Domain\SendMail;
use Illuminate\Support\Facades\Input;

class ServicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('maintenance');
        $this->middleware('banned');
    }

    public function index()
    {
        $user = \Auth::user();
        return view('dashboard.services.index', [
            'user' => $user,
        ]);
    }

    public function builder()
    {
        return view('dashboard.services.website-builder');
    }

    public function faq()
    {
        return view('dashboard.services.website-builder-faq');
    }

    public function requestTour(Request $request)
    {
        SendMail::sendTourRequest($request->all(), \Auth::user(), Dashboard::getIP());
        \Session::flash('message', '<span class="fw-semi-bold">Success:</span> Request is sent, our tutor will contact you as soon as possible!');

        return redirect(url('/dashboard/useful-services'));
    }

    public function builderProcess()
    {
        $user = \Auth::user();

        $price = 114.00;

        $model = new WebsiteBuilder();
        $model->username = $user->username;
        $model->niche = Input::get('niche');
        $model->price = $price;
        $model->domain = Input::get('domain');
        $model->ftp_address = Input::get('ftp_address');
        $model->ftp_username = Input::get('ftp_username');
        $model->ftp_password = Input::get('ftp_password');
        $model->ftp_port = Input::get('ftp_port');
        $model->ftp_more = Input::get('ftp_more');
        $model->save();

        $order_id = $model->order_id;

        $notify_url = url(\App\Models\Domain\Payment::$NOTIFY['builder']);
        $item_name = 'EV Website Builder';
        $item_number = '';
        $currency_code = 'USD';
        $cancel_return = url('/dashboard/useful-services/website-builder');
        $return = url('/dashboard/useful-services/website-builder/return');

        $last = WebsiteBuilder::orderBy('order_id', 'desc')->first();
        $last_id = $last->order_id;

        $payPalUrl = (env('PAYPAL_USE_SANDBOX')) ? env('PAYPAL_URL_SANDBOX') : env('PAYPAL_URL_LIVE');

        return redirect($payPalUrl.'?cmd=_xclick&business='.env('SELLER_EMAIL_BUILDER').'&currency_code='.$currency_code.'&item_number='.$last_id.'&amount='.$price.'&item_name='.$item_name.'&notify_url='.$notify_url.'&custom='.$order_id.'');
    }

    public function PayPalReturn()
    {
        return view('dashboard.services.website-builder-return');
    }
}
