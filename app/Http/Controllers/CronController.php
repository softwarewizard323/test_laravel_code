<?php

namespace App\Http\Controllers;

use App\Models\Data\User;
use App\Models\Data\UserLevelsExpiry;

class CronController extends Controller
{
    public function index($action)
    {
        switch ($action) {
            case 'check_level_expiry' :
                return $this->checkLevelExpiry();
                break;

            case 'password' :
//                return $this->passwords();
                break;

            case 'cache_account_balance' :
                return $this->cacheAccountBalance();
                break;

            default:
                break;
        }
    }

    public function checkLevelExpiry()
    {
        error_reporting(0);

        $users = UserLevelsExpiry::all();

        $log_file = storage_path("logs/check_level_expiry.crontab.log");

        error_log(date('[Y-m-d H:i e] '). " *** User Level Crontab Started " . PHP_EOL, 3, $log_file);
        error_log(date('[Y-m-d H:i e] '). " *** Expired users found: ".$users->count()." " . PHP_EOL, 3, $log_file);

        foreach ($users as $user)
        {
            error_log(date('[Y-m-d H:i e] '). " *********************  " . PHP_EOL, 3, $log_file);
            error_log(date('[Y-m-d H:i e] '). " *** Username: ".$user['username']." " . PHP_EOL, 3, $log_file);
            error_log(date('[Y-m-d H:i e] '). " *** Started: ".date('Y-m-d H:i:s', $user['date_start'])." " . PHP_EOL, 3, $log_file);
            error_log(date('[Y-m-d H:i e] '). " *** Expired: ".date('Y-m-d H:i:s', $user['date_end'])." " . PHP_EOL, 3, $log_file);
            error_log(date('[Y-m-d H:i e] '). " *** User Level: ".$user['user_level']." " . PHP_EOL, 3, $log_file);

            User::where('username', $user->username)->update(['userlevel' => 1]);
            $user->delete();

            error_log(date('[Y-m-d H:i e] '). " *** Setting back to user level 1 and deleting subscription" . PHP_EOL, 3, $log_file);
            error_log(date('[Y-m-d H:i e] '). " *********************  " . PHP_EOL, 3, $log_file);
        }

        error_log(date('[Y-m-d H:i e] '). " *** User Level Crontab Ended " . PHP_EOL, 3, $log_file);
    }

    public function cacheAccountBalance()
    {
        $users = User::join('ev_user_settings', 'ev_user_settings.username', '=', 'ev_users.username')->get();
        $array = [];
        foreach ($users as $user) {
            $array[$user->username] = [
                'countOrders' => $user->countOrders,
                'dailySpending' => $user->dailySpending,
            ];
        }

//        echo '<pre>';
//        print_r($array);
//        echo '</pre>';

        return 'Done';
    }

    public function passwords()
    {
        set_time_limit(0);

        $users = User::all();
        foreach ($users as $user) {
            $user->password = bcrypt($user->old_password);
            $user->save();
            echo $user->id . "\n";
        }

        return 'Done';
    }
}
