<?php

namespace App\Models\Domain;


use App\Models\Data\AccountBalance;
use App\Models\Data\PayPalBalance;
use App\Models\Data\User;
use App\Models\Data\UserLevelsExpiry;
use App\Models\Data\UserSettings;
use App\Models\Data\WebsiteBuilder;

class Payment
{
    // url's for PayPal form "notify_url" field
    public static $NOTIFY = [
        'balance' => '/ipn-balance',
        'builder' => '/ipn-builder',
    ];

    public static function approveBalance($post)
    {
        $txn_id = $post['txn_id'];
        $currency = $post['mc_currency'];

        $query_count = PayPalBalance::where('txn_id', $txn_id)->count();
        $account_balance = AccountBalance::find($post['item_number']);
        $user = $account_balance->user;

        $seller_email = (env('PAYPAL_USE_SANDBOX') == true)
            ? env('PAYPAL_BUSINESS_SANDBOX')
            : env('PAYPAL_BUSINESS_LIVE');

        if( ($post['payment_status'] == 'Completed') && ($post['receiver_email'] == $seller_email) && ($currency == 'USD') && ($query_count == 0) && ($account_balance) ) {

            $mc_gross = $post['mc_gross'];

            $username = $user->username;

            $date = time();

            $model = new PayPalBalance();
            $model->txn_id = $txn_id;
            $model->mc_gross = $mc_gross;
            $model->currency = $currency;
            $model->payer_email = $post['payer_email'];
            $model->payment_made = $date;
            $model->first_name = $user->fname;
            $model->last_name = $user->lname;
            $model->contact_phone = '';
            $model->residence_country = $post['residence_country'];
            $model->username = $username;
            $model->confirmed = '1';
            $model->IP = $post['custom'];
            $model->save();

            $user_settings = UserSettings::where('username', $username)->first();
            UserSettings::where('username', $username)->update(['account_balance' => $user_settings->account_balance + $mc_gross]);

            $account_balance->status = 1;
            $account_balance->save();

            /*
             * Level system depending on money upload
            */

            $moneySpendedLastMonth = PayPalBalance::where('username', $username)
                ->where('payment_made', '>=', strtotime('first day of this month'))
                ->where('payment_made', '<=', strtotime('last day of this month'))
                ->where('txn_id', '!=' , 'Voucher')
                ->sum('mc_gross');

            $userLevel = \App\User::LEVEL_BASIC;
            $newSubscribe = false;
            if( $moneySpendedLastMonth >= 1000 && $moneySpendedLastMonth <= 3000 ) {
                $userLevel = \App\User::LEVEL_ADVANCED;
                $newSubscribe = true;
            } elseif( $moneySpendedLastMonth > 3000 ) {
                $userLevel = \App\User::LEVEL_PREMIER;
                $newSubscribe = true;
            }

            if($newSubscribe == true)
            {
                /**
                 * Let's check if user already have subscription
                 */
                $model = UserLevelsExpiry::where('username', $username)->first();
                if(!$model) {
                    $model = new UserLevelsExpiry();
                }
                $model->username  = $username;
                $model->date_start = $date;
                $model->date_end   = strtotime("+1 month");
                $model->user_level = $userLevel;
                $model->save();

                User::where('username', $username)->update(['userLevel' => $userLevel]);
            }
        }
    }

    public static function approveBuilder($post)
    {
        $txn_id = $post['txn_id'];
        $order_id = $post['custom'];
        $currency = $post['mc_currency'];

        $query_count = WebsiteBuilder::where('txn_id', $txn_id)->count();

        $seller_email = (env('PAYPAL_USE_SANDBOX') == true)
            ? env('PAYPAL_BUSINESS_SANDBOX')
            : env('PAYPAL_BUSINESS_LIVE');

        if( ($post['payment_status'] == 'Completed') && ($post['receiver_email'] == $seller_email) && ($currency == 'USD') && ($query_count == 0))
        {
            WebsiteBuilder::where('order_id', $order_id)
                ->update([
                    'status' => 0,
                    'txn_id' => $txn_id,
                    'payment_status' => 'Paid'
                ]);
        }
    }
}