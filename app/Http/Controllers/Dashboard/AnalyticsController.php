<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnalyticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('maintenance');
        $this->middleware('banned');
    }

    public function index()
    {
        return view('dashboard.analytics',[
            'our_mail' => 'happytom2@gmail.com',
        ]);
    }
}
