<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class BannedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = \Auth::user();
        if ($user->isBanned) {
            return view('dashboard.banned');
        }

        return redirect('/dashboard');
    }
}
