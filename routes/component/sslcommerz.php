<?php

use \App\Http\Controllers\SslCommerzPaymentController;
use \App\Http\Controllers\AdmissionPaymentController;
use \App\Http\Controllers\SubscriptionController;

// SSLCOMMERZ Start
Route::post('/sslcommerz/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/sslcommerz/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);


Route::post('/sslcommerz/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

Route::post('/sslcommerz/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/sslcommerz/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/sslcommerz/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/admission/payment/stripe/{roll}', [AdmissionPaymentController::class, 'stripe_pay'])->name('admission_payment.stripe');
Route::post('/admission/payment/success', [AdmissionPaymentController::class, 'success']);
Route::post('/admission/payment/fail', [AdmissionPaymentController::class, 'fail']);
Route::post('/admission/payment/cancel', [AdmissionPaymentController::class, 'cancel']);
Route::get('/admission/payment/index/{id}', [AdmissionPaymentController::class, 'index'])->name('admission_payment.index');
Route::post('/admission/paynow/{roll}', [AdmissionPaymentController::class, 'payViaAjax'])->name('admission.paynow');

Route::post('/rewnew_subs/success', [SubscriptionController::class, 'success']);
Route::post('/rewnew_subs/fail', [SubscriptionController::class, 'fail']);
Route::post('/rewnew_subs/cancel', [SubscriptionController::class, 'cancel']);
Route::post('/rewnew_subs/{school_code}/{pricing}', [SubscriptionController::class, 'renewNowCheckout'])->name('renew.now');

Route::post('/service_charge/success', 'SchoolPaymentController@success'); 
Route::post('/service_charge/fail', 'SchoolPaymentController@fail'); 
Route::post('/service_charge/cancel', 'SchoolPaymentController@cancel');  