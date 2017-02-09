<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Data\WebsiteSetting;

class MaintenanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (WebsiteSetting::get('maintenance') == 1) {
            return view('dashboard.maintenance');
        }

        return redirect('/dashboard');
    }
}
