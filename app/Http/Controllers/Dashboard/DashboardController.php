<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Data\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Data\NewOrder;
use App\Models\Data\NewConversionOrder;

class DashboardController extends Controller
{
    public static $TYPES = [
        'cosmetic' => 'Cosmetic Traffic Campaigns',
        'arbitrage' => 'Arbitrage Traffic Campaigns',
        'conversion' => 'Conversion Traffic Campaigns'
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('maintenance');
        $this->middleware('banned');
    }

    public function dashboard()
    {
        return redirect('/dashboard/campaign');
    }

    public function index($type = null)
    {
        if (!$type) {
            return redirect('/dashboard/campaign/cosmetic');
        }

        if (!array_key_exists($type, self::$TYPES)) {
            abort(404);
        }

        $user = \Auth::user();

        $orders = NewOrder::where('username', $user->username)->where('status', '!=', 3)->get();
        if ($type == 'arbitrage') {
            $orders = NewOrder::where('username', $user->username)->where('status', 4)->get();
        }
        elseif ($type == 'conversion') {
            $orders = NewConversionOrder::where('user', $user->username)->get();
        }

        $dailySpending = NewOrder::where('username', $user->username)->where('status', 1)->where('discount', 0)->groupBy('username')->sum('price');
        $lowBalanceCheck = $dailySpending * 3;

        $all_news = News::where('news_status', 1)->where('news_pinned', 0)->orderBy('news_date', 'desc')->get();
        $pinned_news = News::where('news_status', 1)->where('news_pinned', 1)->get();

        return view('dashboard.index', [
            'type' => $type,
            'user' => $user,
            'all_news' => $all_news,
            'pinned_news' => $pinned_news,
            'orders' => $orders,
            'dailySpending' => $dailySpending,
            'lowBalanceCheck' => $lowBalanceCheck,
        ]);
    }
}
