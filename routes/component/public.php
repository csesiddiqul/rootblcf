<?php
/* Admission Call */
require_once 'admission.php';

Route::match(['GET', 'POST', 'PUT'], 'foqas/login', 'PublicController@foqasLogin')->name('foqas.login');
Route::post('setLang', 'PublicController@setLang')->name('setLang');
Route::get('contact', 'PublicController@getContact')->name('contact.index');
Route::post('contact', 'ContactController@store')->name('contact.store');
Route::middleware(['main_academy'])->group(function () {
    Route::get('about', 'PublicController@getAboutus')->name('about.index');
    Route::get('{title}-message', 'PublicController@anyMessage')->name('any_message');
    Route::get('teacher', 'PublicController@getTeacher')->name('teacher.index');
    Route::get('complain', 'PublicController@viewComplain')->name('public.complain');
    Route::post('complain', 'ComplainController@store')->name('public.complain_store');
    Route::get('blog', 'PublicController@getBlog')->name('blog.index');
    Route::get('committee', 'PublicController@getCommittee')->name('committee.school');
    Route::get('members', 'PublicController@getMembers')->name('public.member');
    Route::get('managements', 'PublicController@getManagements')->name('public.management');
    Route::get('blogdetails', 'PublicController@getBlogdetails')->name('blogdetails.index');
    Route::get('forcourse', 'PublicController@getCourse')->name('forcourse.index');
    Route::get('coursedetails', 'PublicController@getCoursedetails')->name('coursedetails.index');
    Route::get('profile/view', 'UserController@viewProfile')->name('profile.view');
    Route::get('event', 'PublicController@getEvent')->name('event.index');
    Route::get('event/{slug}', 'PublicController@getEventdetails')->name('event.show');
    Route::get('teacher/{id}/{name}', 'PublicController@teacherDetails')->name('teacher.show');
    Route::get('gallery', 'PublicController@getGallery')->name('gallery.index');
    Route::get('testimonial', 'TestimonialController@viewTestimonial')->name('public.testimonial');
    Route::post('school/secretKey/{key}', 'PublicController@secretKey')->name('school.secretKey');

    Route::get('/registry', 'UserController@employeeinfo')->name('addinfo');
    Route::get('/registry/active', 'PublicController@registryActive')->name('registry.active');
    Route::post('/employeestore', 'UserController@employeestore')->name('employee.store');

    Route::get('/notice', 'PublicController@viewall')->name('public.notice');
    Route::get('notice/{slug}', 'PublicController@singleNotice')->name('single.notice');
    Route::get('/pages/{slug}', 'PublicController@pagesIndex')->name('public.pages');
    Route::match(['GET', 'POST'], '/academic-results', 'PublicController@academicResults')->name('academic-results');
   /* For Student Payment online*/
    Route::match(['GET', 'POST'], '/pay-online', 'PublicController@payOnline')->name('pay_online');
    Route::post('/student/pay/{student_code}/{type}/{section_id}/{due_ids}', 'StudentPaymentController@payOnlineNow')->name('payOnlineNow');
    Route::post('/student/pay/hosted/{student_code}/{type}/{section_id}/{due_ids}', 'StudentPaymentController@payOnlineNow_hosted')->name('payOnlineNow_hosted');
    Route::post('/student/pay/success', 'StudentPaymentController@success');
    Route::post('/student/pay/cancel', 'StudentPaymentController@cancel');
    Route::post('/student/pay/fail', 'StudentPaymentController@fail');
});

Route::post('checkEmail', 'PublicController@checkEmail')->name('checkEmail');

Route::match(array('GET', 'POST'), '/register_now', 'NewRegisterController@nowRegister')->name('now.register');
Route::match(array('GET', 'POST'), '/school_info', 'NewRegisterController@schoolInfo')->name('school.info');
Route::match(array('GET', 'POST'), '/payment_info', 'NewRegisterController@paymentInfo')->name('payment.info');
Route::match(array('GET', 'POST'), '/pay_now', 'NewRegisterController@payNow')->name('pay.now');
Route::match(array('GET', 'POST'), '/pay_and_reg_succeeded', 'NewRegisterController@paymentRegister')->name('payment.register');

Route::get('/privacypolicy', 'PublicController@privacypolicy')->name('privacypolicy');
Route::get('/termscondition', 'PublicController@termscondition')->name('termscondition');
/* Social login */
Route::get('auth/google', 'SocialiteController@redirectToGoogle')->name('login_google');
Route::get('/callback', 'SocialiteController@handleGoogleCallback');
Route::get('/auth/facebook', 'SocialiteController@redirectToFacebook');
Route::get('/auth/facebook/callback', 'SocialiteController@handleFacebookCallback');

/* sslcommerz Call */
require_once 'sslcommerz.php';
