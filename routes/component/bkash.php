<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('bkash', 'Bkash\BkashController@indexView');
Route::group(['middleware' => ['web']], function () {

    // Payment Routes for bKash
    Route::post('bkash/get-token', 'Bkash\BkashController@getToken')->name('bkash-get-token');
    Route::post('bkash/create-payment', 'Bkash\BkashController@createPayment')->name('bkash-create-payment');
    Route::post('bkash/execute-payment', 'Bkash\BkashController@executePayment')->name('bkash-execute-payment');
    Route::get('bkash/query-payment', 'Bkash\BkashController@queryPayment')->name('bkash-query-payment');
    Route::post('bkash/success', 'Bkash\BkashController@bkashSuccess')->name('bkash-success');

    // Refund Routes for bKash
    Route::get('bkash/refund', 'Bkash\BkashRefundController@index')->name('bkash-refund');
    Route::post('bkash/refund', 'Bkash\BkashRefundController@refund')->name('bkash-refund');

});