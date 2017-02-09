<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Domain\Dashboard;
use App\Models\Domain\UUID;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Data\User;
use App\Models\Domain\Active;
use App\Models\Data\WebsiteSetting;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);

        Active::init();
    }

    public function username()
    {
        return 'username';
    }

    protected function validateLogin(Request $request)
    {
        \Validator::extend('found', function($attribute, $value, $parameters) {
            $user = User::where('username', $value)->first();
            return ($user) ? true : false;
        });

        $rules = [
            $this->username() => 'required|alpha_num|found',
            'password' => 'required|alpha_num',
        ];

        $messages = [
            'required' => '* :attribute not entered',
            'alpha_num' => '* :attribute not alphanumeric',
            'found' => '* :attribute not found',
            'failed' => '* Invalid password'
        ];

        $attributes = [
            $this->username() => 'Username',
            'password' => 'Password',
        ];

        $this->validate($request, $rules, $messages, $attributes);
    }

    protected function authenticated(Request $request, $user)
    {
        $user->timestamp = time();
        $user->userid = UUID::generateRandID();
        $user->save();

        Dashboard::initUserFtl($user);

        Active::toggleGuestToUser($_SERVER['REMOTE_ADDR'], $user);
    }

    public function logout(Request $request)
    {
        Active::toggleUserToGuest($this->guard()->user(), $_SERVER['REMOTE_ADDR']);

        $this->guard()->logout();

        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/');
    }

    public function showLoginForm(Request $request)
    {
        return view('auth.login', [
            'check_registration' => (WebsiteSetting::get('registration') == 1) ? true : false,
        ]);
    }
}
