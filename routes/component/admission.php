<?php
Route::middleware(['main_academy'])->prefix('admission')->group(function () {
    Route::get('apply', 'PublicController@admission')->name('apply.admission');
    Route::match(array('GET', 'POST'), 'review', 'PublicController@admissionPreview')->name('review.apply');
    Route::post('submit', 'AdmissionController@store')->name('submit.admission');
    Route::get('print', 'PublicController@admissionPrint')->name('print.apply');
    Route::get('download', 'PublicController@showdownloadApplication')->name('download.application');
    Route::post('download', 'PublicController@downloadApplication')->name('postDownload.admission');
    Route::match(array('GET', 'POST'), 'admitcard', 'PublicController@admitCard')->name('admitcard.view');
    Route::get('meritlist', 'PublicController@meritlist')->name('admission.meritlist');
    Route::match(array('GET', 'POST'), 'verify', 'PublicController@verifyApplication')->name('verify.admission');
    Route::get('payment/{roll}', 'PublicController@paymentApplication')->name('payment.admission');
    Route::get('waiting_step_{step}', 'PublicController@admissionWaiting')->name('waiting.admission');
});
