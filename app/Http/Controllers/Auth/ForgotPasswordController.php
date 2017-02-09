<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Domain\Active;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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

    protected function validateUser(Request $request)
    {
        $rules = [
            'username' => 'required|alpha_num',
        ];

        $messages = [
            'required' => '* :attribute not entered',
            'alpha_num' => '* :attribute not alphanumeric',
        ];

        $attributes = [
            'username' => 'Username',
        ];

        $this->validate($request, $rules, $messages, $attributes);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateUser($request);

        $response = $this->broker()->sendResetLink(
            $request->only('username'), $this->resetNotifier()
        );

        if ($response === Password::RESET_LINK_SENT) {
            return back()->with('status', trans($response));
        }

        return back()->withErrors(
            ['username' => trans($response)]
        );
    }
}
