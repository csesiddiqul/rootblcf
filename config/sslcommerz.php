<?php
return [
    'projectPath' => env('PROJECT_PATH'),
    // For Sandbox, use "https://sandbox.sslcommerz.com"
    // For Live, use "https://securepay.sslcommerz.com"
    'apiDomain' => env("API_DOMAIN_URL", "https://sandbox.sslcommerz.com"),
    'apiCredentials' => [
        'store_id' => env('STORE_ID', 'store_id'),
        'store_password' => env('STORE_PASSWORD', 'password'),
    ],
    'apiUrl' => [
        'make_payment' => "/gwprocess/v4/api.php",
        'transaction_status' => "/validator/api/merchantTransIDvalidationAPI.php",
        'order_validate' => "/validator/api/validationserverAPI.php",
        'refund_payment' => "/validator/api/merchantTransIDvalidationAPI.php",
        'refund_status' => "/validator/api/merchantTransIDvalidationAPI.php",
    ],
    'connect_from_localhost' => env('SANDBOX_MODE', true), // For Sandbox, use "true", For Live, use "false"
    'success_url' => env('SUCCESS_URL', '/sslcommerz/success'),
    'failed_url' => env('FAIL_URL', '/sslcommerz/fail'),
    'cancel_url' => env('CANCEL_URL', '/sslcommerz/cancel'),
    'ipn_url' => env('IPN_URL', '/sslcommerz/ipn'),
];
