<?php

namespace Groupedesign\Fatora;

use Illuminate\Support\Facades\Redirect;

class Checkout
{
    public static function checkout($order)
    {
        $url = 'https://maktapp.credit/v3/AddTransaction';

        $data = array(
            'token'           => config('fatora.key'),
            // 'FcmToken'        => "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX",
            'currencyCode'    => $order->currencyCode,
            'orderId'         => $order->orderNo,
            'amount'          => $order->amount,
            'customerEmail'   => $order->customerEmail,
            'customerName'    => $order->customerName,
            'customerPhone'   => $order->customerPhone,
            'customerCountry' => $order->customerCountry,
            'lang'            => $order->lang,
            'note'            => $order->note,
        );

        $response =  curl_post($url, $data);
        $data_json_decode = json_decode($response);
        $result = $data_json_decode->{'result'};

        $response = checkResponseStatus($result);
        if ($response == "success") {
            return Redirect::to($result);
        } else {
            $error_msg = $response;
            return redirect()->route('payment.error', ['error_msg' => $error_msg]);
        }
    }
}
