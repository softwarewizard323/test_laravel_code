<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminUsersRequest;
use App\Http\Controllers\Controller;
use App\Models\Data\User;
use App\Models\Data\BannedUser;
use App\Models\Data\UserFtl;
use App\Models\Data\UserSettings;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        return view('admin.users.users', $this->getAll());
    }

    public function level(AdminUsersRequest $request)
    {
        $user = User::where('username', $request->level_user)->first();
        $user->userlevel = $request->level;
        $user->save();

        \Session::flash('message', '<span class="fw-semi-bold">Success:</span> Level for user "<b>'. $user->username .'</b>" has been changed');
        return redirect('/admin/users');
    }

    public function password(AdminUsersRequest $request)
    {
        $user = User::where('username', $request->password_user)->first();
        $user->password = bcrypt($request->new_password);
        $user->save();

        \Session::flash('message', '<span class="fw-semi-bold">Success:</span> Password for user "<b>'. $user->username .'</b>" has been changed');
        return redirect('/admin/users');
    }

    public function delete(AdminUsersRequest $request)
    {
        User::where('username', $request->del_user)->delete();
        UserSettings::where('username', $request->del_user)->delete();
        UserFtl::where('userUsername', $request->del_user)->delete();

        return redirect('/admin/users');
    }

    public function clear(AdminUsersRequest $request)
    {
        $inactive_time = time() - $request->inactive_days*24*60*60;
        $users = User::where('timestamp', '<', $inactive_time)->where('userlevel', '!=', \App\User::LEVEL_ADMIN)->get();
        foreach ($users as $user) {
            UserFtl::where('userUsername', $user->username)->delete();
            UserSettings::where('username', $user->username)->delete();
            $user->delete();
        }

        return redirect('/admin/users');
    }

    public function ban(AdminUsersRequest $request)
    {
        $user = User::where('username', $request->ban_user)->first();
        $user->userlevel = 0;
        $user->save();

        $ban = new BannedUser();
        $ban->username = $user->username;
        $ban->timestamp = time();
        $ban->save();

        return redirect('/admin/users');
    }

    public function banned(AdminUsersRequest $request)
    {
        $user = User::where('username', $request->banned_user)->first();
        $user->userlevel = 1;
        $user->save();

        BannedUser::where('username', $user->username)->delete();

        return redirect('/admin/users');
    }

    private function getAll()
    {
        $allUsers = User::where('userlevel', '!=', 0)->get();
        $bannedUsers = BannedUser::all();
        return compact('allUsers', 'bannedUsers');
    }
}