<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'school/secretKey/*','sslcommerz/ipn','sslcommerz/pay-via-ajax','sslcommerz/success','sslcommerz/cancel','sslcommerz/fail','admission/payment/success','admission/payment/fail','admission/payment/cancel','admission/paynow/*','rewnew_subs/*','service_charge/*','bkash/*','student/pay/*'
    ];
}
