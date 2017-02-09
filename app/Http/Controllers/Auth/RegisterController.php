<?php

namespace App\Http\Controllers\Auth;

use App\Models\Domain\Dashboard;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Data\BannedUser;
use App\Models\Data\WebsiteSetting;
use App\Models\Domain\UUID;
use App\Models\Domain\Active;
use App\Models\Domain\SendMail;
use App\Models\Data\UserSettings;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

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
        $this->middleware('guest');

        Active::init();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        \Validator::extend('banned', function($attribute, $value, $parameters) {
            $user = BannedUser::where('username', $value)->first();
            return ($user) ? false : true;
        });

        \Validator::extend('reserved', function($attribute, $value, $parameters) {
            return (strcasecmp($value, User::RESERVED) == 0) ? false : true;
        });

        $rules = [
            'fname' => 'required|max:255|regex:/^[A-Za-z0-9]*$/i',
            'lname' => 'required|max:255|regex:/^[A-Za-z0-9]*$/i',
            'user' => 'required|alpha_num|regex:/^[A-Za-z0-9]*$/i|min:3|max:30|unique:ev_users,username|banned|reserved',
            'email' => 'required|email|max:50|unique:ev_users',
            'pass' => 'required|alpha_num|min:6',
        ];

        $messages = [
            'required' => '* :attribute not entered',
            'min' => '* :attribute below :min characters',
            'max' => '* :attribute above :max characters',
            'alpha_num' => '* :attribute not alphanumeric',
            'regex' => '* :attribute not alphanumeric',
            'unique' => '* :attribute already in use',
            'reserved' => '* :attribute reserved word',
            'banned' => '* :attribute banned',
            'email' => '* :attribute invalid',
            'pass.min' => '* :attribute too short'
        ];

        $attributes = [
            'fname' => 'First name',
            'lname' => 'Last name',
            'user' => 'Username',
            'pass' => 'Password',
            'email' => 'Email',
        ];

        return Validator::make($data, $rules, $messages, $attributes);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'username' => $data['user'],
            'email' => $data['email'],
            'password' => bcrypt($data['pass']),
            'userlevel' => (strcasecmp($data['user'], User::SPECIAL['admin_name']) == 0) ? User::SPECIAL['admin_level'] : User::SPECIAL['user_level'],
            'userid' => UUID::generateRandID(),
            'timestamp' => time()
        ]);

        Dashboard::initUserFtl($user);

        SendMail::sendWelcome($data);

        Active::toggleGuestToUser($_SERVER['REMOTE_ADDR'], $user);

        return $user;
    }

    public function showRegistrationForm()
    {
        return view('auth.register', [
            'check_registration' => (WebsiteSetting::get('registration') == 1) ? true : false
        ]);
    }
}
