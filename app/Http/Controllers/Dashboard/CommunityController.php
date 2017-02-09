<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Data\ForumBannedUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Data\WebsiteSetting;
use App\Http\Controllers\Controller;

class CommunityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('maintenance');
        $this->middleware('banned');
    }

    public function index()
    {
        if ($this->check()) return $this->check();

        return view('dashboard.community.index');
    }

    public function check()
    {
        if (WebsiteSetting::get('community') == 1) {
            return view('dashboard.community.disabled', [
                'disabled' => true,
                'banned' => false
            ]);
        }

        /**
         * Let's check if user is banned.
         * If ban is already expired, unban him.
         */
        $user = \Auth::user();
        $banned = ForumBannedUser::where('username', $user->username)->first();
        if ($banned) {
            if($banned->banned_till != 0) {
                if(time() > $banned->banned_till) {
                    $banned->delete();
                    return false;
                }
            }

            return view('dashboard.community.disabled', [
                'disabled' => false,
                'banned' => $banned
            ]);
        }
    }
}
