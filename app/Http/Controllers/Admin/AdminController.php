<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountFormRequest;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return redirect('/admin/orders');
    }


    public function settings()
    {
        $user = \Auth::getUser();

        return view('admin.account', [
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
        return redirect(url('/admin/settings'));
    }

}
