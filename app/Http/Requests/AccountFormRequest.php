<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Input;

class AccountFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        \Validator::extend('check_password', function($attribute, $value, $parameters) {
            $user = \Auth::user();
            return \Hash::check($value, $user->password);
        });

        \Validator::extend('check_current', function($attribute, $value, $parameters) {
            return (Input::get('curpass') == '') ? false : true;
        });

        \Validator::extend('check_new', function($attribute, $value, $parameters) {
            return (Input::get('newpass') == '') ? false : true;
        });

        return [
            'email' => ['required', 'email'],
            'curpass' => ['check_password', 'check_new'],
            'newpass' => ['alpha_num', 'min:4', 'check_current'],
        ];
    }

    public function messages()
    {
        return [
            'required' => '* :attribute not entered',
            'email' => '* :attribute invalid',
            'alpha_num' => '* :attribute not alphanumeric',
            'min' => '* :attribute too short',
            'curpass.check_password' => '* Current Password incorrect',
            'curpass.check_new' => '* New Password not entered',
            'newpass.check_current' => '* Current Password not entered',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Email',
            'curpass' => 'Current Password',
            'newpass' => 'New Password',
        ];
    }
}
