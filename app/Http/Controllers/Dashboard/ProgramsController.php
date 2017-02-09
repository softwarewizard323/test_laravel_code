<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProgramsController extends Controller
{
    const PROGRAMS = [
        'achievements-sharing' => 'Achievements Sharing',
        'vip-rates' => 'VIP / Loyalty Program'
    ];

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('maintenance');
        $this->middleware('banned');
    }

    public function index($name)
    {
        if (!array_key_exists($name, self::PROGRAMS))
            abort(404);

        return view('dashboard.programs',[
            'program_type' => $name,
            'program_title' => self::PROGRAMS[$name]
        ]);
    }
}
