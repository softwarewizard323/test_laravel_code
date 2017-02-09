<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\AccountFormRequest;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('maintenance');
        $this->middleware('banned');
    }

    public function index()
    {
        $user = \Auth::getUser();

        return view('dashboard.account', [
            'user' => $user,
            'email' => (old('email') == "") ? $user->email : old('email')
        ]);
    }

    public function process(AccountFormRequest $request)
    {
        $user = \Auth::getUser();
        $user->email = $request->email;
        if ($request->newpass) {
            $user->password = bcrypt($request->newpass);
        }
        $user->save();

        \Session::flash('status', true);
        return redirect(url('/dashboard/settings'));
    }
}
