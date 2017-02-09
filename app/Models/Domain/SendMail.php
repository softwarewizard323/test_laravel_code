<?php

namespace App\Models\Domain;

class SendMail
{
    public static function sendContactUs($request)
    {
        function clean_string($string) {
            $bad = array("content-type","bcc:","to:","cc:","href");
            return str_replace($bad,"",$string);
        }

        $email_message = "Form details below.\n\n";
        $email_message .= "First Name: ".clean_string($request->first_name)."\n";
        $email_message .= "Email: ".clean_string($request->email)."\n";
        $email_message .= "Comments: ".clean_string($request->comments)."\n";

        \Mail::raw($email_message,
            function ($message) use ($request) {
                $message
                    ->to(env('MAIL_CONTACT_MAIL'))
                    ->subject('ExpressVisits - Contact Us')
                    ->from($request->email, $request->first_name);
            }
        );
    }

    public static function sendWelcome($data)
    {
        $email_message = $data['fname'].",\n\n"
            ."Welcome! You've just registered at ExpressVisits.com "
            ."with the following information:\n\n"
            ."Username: ".$data['user']."\n"
            ."Password: ".$data['pass']."\n\n"
            ."If you ever lose or forget your password, a new "
            ."password will be generated for you and sent to this "
            ."email address, if you would like to change your "
            ."email address you can do so by going to the "
            ."Settings page after signing in.\n\n"
            ."";

        \Mail::raw($email_message,
            function ($message) use ($data) {
                $message
                    ->to($data['email'])
                    ->subject('ExpressVisits - Welcome!')
                    ->from(env('MAIL_INFO_MAIL'), env('MAIL_INFO_NAME'));
            }
        );
    }

    public static function sendNewPass($user, $password)
    {
        $email_message = $user->username.",\n\n"
            ."We've generated a new password for you at your "
            ."request, you can use this new password with your "
            ."username to log in to ExpressVisits User Panel.\n\n"
            ."Username: ".$user->username."\n"
            ."New Password: ".$password."\n\n"
            ."It is recommended that you change your password "
            ."to something that is easier to remember, which "
            ."can be done by going to the Settings page "
            ."after signing in.\n\n"
            ."";

        \Mail::raw($email_message,
            function ($message) use ($user) {
                $message
                    ->to($user->email)
                    ->subject('ExpressVisits - Your new password')
                    ->from(env('MAIL_INFO_MAIL'), env('MAIL_INFO_NAME'));
            }
        );
    }

    public static function sendTourRequest($post, $user, $ip)
    {
        $email_message = "Hello, this is to let you know, that someone is requesting tutor on ExpressVisits.com\n"
            ."------------------------------------------------------ \n"
            ."Name: {$post['name']} \n"
            ."Email: {$post['email']} \n"
            ."Registered Email: {$user->email} \n"
            ."Name: {$post['skype_id']} \n"
            ."Name: {$post['reason']} \n"
            ."IP: {$ip} \n"
            ."------------------------------------------------------ \n"
            ."";

        return \Mail::raw($email_message,
            function ($message) use ($user) {
                $message
                    ->to('nycboris@yahoo.com')
                    ->subject('Someone requesting tutor')
                    ->from(env('MAIL_DO_NOT_REPLY'), env('MAIL_INFO_NAME'));
            }
        );
    }

    public static function sendStartCampaign($user, $order)
    {
        $email_message = "Thank you for placing an order on ExpressVisits.com! \n"
	        ."Your order #{$order->order_id} is now activated and your website have started receiving visitors from our servers. \n"
        	."------------------------------------------------------ \n"
	        ."Username: {$user->username} \n"
	        ."Order ID: {$order->order_id} \n"
	        ."------------------------------------------------------ \n"
        	."To make another order visit your user panel at ". url('/dashboard/campaign') ." \n"
            ."";

        return \Mail::raw($email_message,
            function ($message) use ($user) {
                $message
                    ->to($user->email)
                    ->subject('ExpressVisits Order Activated')
                    ->from(env('MAIL_DO_NOT_REPLY'), env('MAIL_INFO_NAME'));
            }
        );
    }

    public static function sendStartConversion($user, $order)
    {
        $email_message = "Thank you for placing an order on ExpressVisits.com! \n"
            ."Your order #{$order->co_id} is now activated and your website have started receiving visitors from our servers. \n"
            ."------------------------------------------------------ \n"
            ."Username: {$user->username} \n"
            ."Order ID: {$order->co_id} \n"
            ."------------------------------------------------------ \n"
            ."To make another order visit your user panel at ". url('/dashboard/campaign') ." \n"
            ."";

        return \Mail::raw($email_message,
            function ($message) use ($user) {
                $message
                    ->to($user->email)
                    ->subject('ExpressVisits Premium Order Activated')
                    ->from(env('MAIL_DO_NOT_REPLY'), env('MAIL_INFO_NAME'));
            }
        );
    }

    public static function sendMessage($user)
    {
        $email_message = "This is automatic email which has purpose to inform that you have received a new message at ExpressVisits.com \n"
            ."To read this message please visit your ExpressVisits inbox located at ". url('/dashboard/messages') ." \n"
            ."Thank you for using ExpressVisits.com! \n"
            ."";

        return \Mail::raw($email_message,
            function ($message) use ($user) {
                $message
                    ->to($user->email)
                    ->subject('ExpressVisits New Admin Message')
                    ->from(env('MAIL_DO_NOT_REPLY'), env('MAIL_INFO_NAME'));
            }
        );
    }


    public static function sendTicket($user, $ticket)
    {
        $email_message = "Hello {$user->username} \n"
            ."You have a new message on your ticket #{$ticket->ticket_id} \n"
            ."Please login to your ExpressVisits.com account and visit ". url('/dashboard/support') ." in order to read it. \n"
            ."Thank you for using ExpressVisits.com services! \n"
            ."";

        return \Mail::raw($email_message,
            function ($message) use ($user) {
                $message
                    ->to($user->email)
                    ->subject('ExpressVisits Support Ticket Activity')
                    ->from(env('MAIL_DO_NOT_REPLY'), env('MAIL_INFO_NAME'));
            }
        );
    }

}