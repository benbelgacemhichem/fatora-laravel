<?php

namespace Groupedesign\Fatora\Http\Middleware;

use Closure;

class CheckTransactionStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $orderId =  $request->query->get("orderId");
        $url = 'https://maktapp.credit/v3/CheckStatus';
        $data = array(
            'token'           => config('fatora.key'),
            'orderId'         => $orderId
        );

        $response = curl_post($url, $data);
        $data_json_decode = json_decode($response);
        $result = $data_json_decode->{'result'};

        $response = checkResponseStatus($result);

        if ($response == "success") {
            $request->route()->setParameter('orderId', $orderId);
            $request->route()->setParameter('chkStatus', 1);
            // return to sccuess page
            return $next($request);
        } else {
            $error_msg = $response;
            return redirect()->route('payment.error', ['error_msg' => $error_msg]);
        }
    }
}
