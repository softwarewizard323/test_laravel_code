<?php

namespace App\Http\Controllers;

use App\Models\Domain\Dashboard;
use App\Models\Domain\Payment;

class PaymentController extends Controller
{
    public $ipn_request;

    public function ipnBalance()
    {
        $response = $this->sendRequest();

        // Inspect IPN validation result and act accordingly
        // Split response headers and payload, a better way for strcmp
        $tokens = explode("\r\n\r\n", trim($response));
        $res = trim(end($tokens));
        if (strcmp ($res, "VERIFIED") == 0) {
            // Approve payment
            Payment::approveBalance($_POST);

            if(env('APP_DEBUG') == true) {
                // Save log, and stop script.
                Dashboard::saveLOG("Verified IPN: {$this->ipn_request}");
            }
        }
        else if (strcmp ($res, "INVALID") == 0) {
            if(env('APP_DEBUG') == true) {
                // Save log, and stop script.
                Dashboard::saveLOG("Invalid IPN: {$this->ipn_request}");
            }
        }
    }

    public function ipnBuilder()
    {
        $response = $this->sendRequest();

        // Inspect IPN validation result and act accordingly
        // Split response headers and payload, a better way for strcmp
        $tokens = explode("\r\n\r\n", trim($response));
        $res = trim(end($tokens));
        if (strcmp ($res, "VERIFIED") == 0) {
            // Approve payment
            Payment::approveBuilder($_POST);

            if(env('APP_DEBUG') == true) {
                // Save log, and stop script.
                Dashboard::saveLOG("Verified IPN: {$this->ipn_request}");
            }
        }
        else if (strcmp ($res, "INVALID") == 0) {
            if(env('APP_DEBUG') == true) {
                // Save log, and stop script.
                Dashboard::saveLOG("Invalid IPN: {$this->ipn_request}");
            }
        }
    }

    public function getPostIPN()
    {
        // Read POST data
        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $key_val) {
            $key_val = explode ('=', $key_val);
            if (count($key_val) == 2)
                $myPost[$key_val[0]] = urldecode($key_val[1]);
        }

        // read the post from PayPal system and add 'cmd'
        $this->ipn_request = 'cmd=_notify-validate';
        if(function_exists('get_magic_quotes_gpc')) {
            $get_magic_quotes_exists = true;
        } else {
            $get_magic_quotes_exists = false;
        }

        foreach ($myPost as $key => $value) {
            if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }
            $this->ipn_request .= "&$key=$value";
        }

        return $this->ipn_request;
    }

    public function sendRequest()
    {
        $action = (env('PAYPAL_USE_SANDBOX') == true)
            ? env('PAYPAL_URL_SANDBOX')
            : env('PAYPAL_URL_LIVE');

        $ch = curl_init($action);
        if ($ch == FALSE) {
            return FALSE;
        }

        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getPostIPN());
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        if(env('APP_DEBUG') == true) {
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        }

        // Set TCP timeout to 30 seconds
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

//        $cert = public_path("/include/cacert.pem");
//        curl_setopt($ch, CURLOPT_CAINFO, $cert);

        $res = curl_exec($ch);

        if (curl_errno($ch) != 0) // cURL error
        {
            if(env('APP_DEBUG') == true) {
                Dashboard::saveLOG("Can't connect to PayPal to validate IPN message: " . curl_error($ch));
            }
            curl_close($ch);
            exit;
        } else {
            // Log the entire HTTP response if debug is switched on.
            if(env('APP_DEBUG') == true) {
                Dashboard::saveLOG("HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: {$this->ipn_request}" );
                Dashboard::saveLOG("HTTP response of validation request: {$res}");
            }
            curl_close($ch);
        }

        return $res;
    }
}
