<?php

namespace App\Http\Requests;

use App\Models\Data\BannedUser;
use App\User;
use App\Models\Data\User as Users;
use Illuminate\Support\Facades\Input;

class AdminUsersRequest extends Request
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
        \Validator::extend('found', function($attribute, $value, $parameters) {
            $user = Users::where('username', $value)->first();
            return ($user) ? true : false;
        });

        \Validator::extend('banned', function($attribute, $value, $parameters) {
            $user = BannedUser::where('username', $value)->first();
            return ($user) ? false : true;
        });

        \Validator::extend('level', function($attribute, $value, $parameters) {
            return ($value == User::LEVEL_BASIC || $value == User::LEVEL_ADMIN) ? true : false;
        });

        \Validator::extend('new_password', function($attribute, $value, $parameters) {
            return (Input::get('new_password') == '') ? false : true;
        });

        return [
            'level_user' => ['sometimes', 'required', 'found'],
            'del_user' => ['sometimes', 'required', 'found'],
            'ban_user' => ['sometimes', 'required', 'found', 'banned'],
            'banned_user' => ['sometimes', 'required', 'found'],
            'level' => ['level'],
            'password_user' => ['sometimes', 'required', 'found', 'new_password'],
            'new_password' => ['alpha_num', 'min:4']
        ];
    }

    public function messages()
    {
        return [
            'required' => '* :attribute not entered',
            'found' => '* :attribute does not exist',
            'level' => '* :attribute is incorrect',
            'banned' => '* :attribute already banned',
            'self' => 'You can\'t change self attributes',
            'new_password' => '* New password not entered',
        ];
    }

    public function attributes()
    {
        return [
            'level_user' => 'Username',
            'del_user' => 'Username',
            'ban_user' => 'Username',
            'banned_user' => 'Username',
            'level' => 'User level',
            'password_user' => 'Username',
            'new_password' => 'New password',
        ];
    }
}
