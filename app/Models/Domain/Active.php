<?php

namespace App\Models\Domain;

use App\Models\Data\ActiveUser;
use App\Models\Data\ActiveGuest;

class Active
{
    public static function init()
    {
        self::removeInactiveUsers();
        self::removeInactiveGuests();

        self::addGuest($_SERVER['REMOTE_ADDR']);
    }

    public static function toggleGuestToUser($ip, $user)
    {
        self::addUser($user);
        self::removeActiveGuest($ip);
    }

    public static function toggleUserToGuest($user, $ip)
    {
        self::addGuest($ip);
        self::removeActiveUser($user);
    }

    public static function addUser($user)
    {
        if(!env('TRACK_VISITORS')) return;

        $active = ActiveUser::where('username', $user->username)->first();
        if (!$active) {
            $active = new ActiveUser();
            $active->username = $user->username;
        }
        $active->timestamp = time();
        $active->save();
    }

    public static function addGuest($ip)
    {
        if(!env('TRACK_VISITORS')) return;

        $active = ActiveGuest::where('ip', $ip)->first();
        if (!$active) {
            $active = new ActiveGuest();
            $active->ip = $ip;
        }
        $active->timestamp = time();
        $active->save();
    }

    public static function removeActiveUser($user)
    {
        if(!env('TRACK_VISITORS')) return;

        if ($user) {
            ActiveUser::destroy($user->username);
        }
    }

    public static function removeActiveGuest($ip)
    {
        if(!env('TRACK_VISITORS')) return;

        ActiveGuest::destroy($ip);
    }

    public static function removeInactiveUsers()
    {
        if(!env('TRACK_VISITORS')) return;

        $timeout = time() - 10 * 60;
        ActiveUser::where('timestamp', '<', $timeout)->delete();
    }

    public static function removeInactiveGuests()
    {
        if(!env('TRACK_VISITORS')) return;

        $timeout = time() - 10 * 60;
        ActiveGuest::where('timestamp', '<', $timeout)->delete();
    }
}