<?php

namespace App\Models\Domain;

use App\Models\Data\Log;
use App\Models\Data\Referral;
use App\Models\Data\UserFtl;
use App\Models\Data\UserSettings;

class Dashboard
{
    public static function initUserFtl($user)
    {
        $loginCount = UserFtl::where('userUsername', $user->username)->count();

        if($loginCount == 0)
        {
            /**
             * Inserting User Settings
             */
            $settings = new UserSettings();
            $settings->username = $user->username;
            $settings->save();

            /**
             * Inserting User Referalls
             */
            $referral = new Referral();
            $referral->ref_friend = $user->username;
            $referral->ref_points = 0;
            $referral->ref_type = $referral::TYPE_NEW;
            $referral->save();

            /**
             * Writing First Logging attempt
             */
            $ftl = new UserFtl();
            $ftl->userUsername = $user->username;
            $ftl->status = '1';
            $ftl->save();
        }

        Active::addUser($user);
    }

    /**
     * Get either a Gravatar URL or complete image tag for a specified email address.
     *
     * @param string $email The email address
     * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
     * @param boolean $img True to return a complete IMG tag False for just the URL
     * @param array $atts Optional, additional key/value attributes to include in the IMG tag
     * @return String containing either just a URL or a complete image tag
     * @source http://gravatar.com/site/implement/images/php/
     */
    public static function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }
        return $url;
    }

    public static function getIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    public static function saveLOG($message)
    {
        $model = new Log();
        $model->controller = \Route::getCurrentRoute()->getActionName();
        $model->message = $message;
        $model->save();
    }

    public static function ev_timestamp($date)
    {
        if(empty($date)) {
            return " ";
        }

        $periods		= array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths		= array("60","60","24","7","4.35","12","10");

        $now			= time();
        $unix_date		= strtotime($date);

        // check validity of date
        if(empty($unix_date)) {
            return "Bad date";
        }

        // is it future date or past date
        if($now > $unix_date) {
            $difference     = $now - $unix_date;
            $tense         = "ago";

        } else {
            $difference     = $unix_date - $now;
            $tense         = "from now";
        }

        for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        if($difference != 1) {
            $periods[$j].= "s";
        }

        return "$difference $periods[$j] {$tense}";
    }
}