<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Domain\Active;
use App\Models\Domain\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after reset.
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

    protected function validatePassword(Request $request)
    {
        $rules = [
            'token' => 'required',
            'username' => 'required|alpha_num',
            'password' => 'required|confirmed|alpha_num|min:6',
        ];

        $messages = [
            'required' => '* :attribute not entered',
            'alpha_num' => '* :attribute not alphanumeric',
            'min' => '* :attribute below :min characters',
            'confirmed' => '* Password confirmation does not match',
        ];

        $attributes = [
            'username' => 'Username',
            'password' => 'Password',
            'password_confirmation' => 'Password confirmation',
        ];

        $this->validate($request, $rules, $messages, $attributes);
    }

    public function reset(Request $request)
    {
        $this->validatePassword($request);

        $response = $this->broker()->reset(
            $this->credentials($request), function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($response)
            : $this->sendResetFailedResponse($request, $response);
    }

    protected function credentials(Request $request)
    {
        return $request->only(
            'username', 'password', 'password_confirmation', 'token'
        );
    }

    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => bcrypt($password),
            'remember_token' => Str::random(60),
        ])->save();

        Active::toggleGuestToUser($_SERVER['REMOTE_ADDR'], $user);

        SendMail::sendNewPass($user, $password);

        $this->guard()->login($user);
    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()
            ->withInput($request->only('username'))
            ->withErrors(['username' => trans($response)]);
    }
}
