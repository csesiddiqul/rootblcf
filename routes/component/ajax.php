<?php
Route::post('/getDistrict', function () {
    return getDistrict($_REQUEST['value']);
});
Route::post('/getThana', function () {
    return getThana($_REQUEST['value']);
});
Route::post('/getState', function () {
    return getState($_REQUEST['value']);
});
Route::post('/getSection', function () {
    return getSection($_REQUEST['value']);
});
Route::post('/getStudentsBySection', function () {
    return getStudent($_REQUEST['value']);
});
Route::post('/getStudentsBySectionRS', function () {
    return getStudentRS($_REQUEST['rs_value'],$_REQUEST['section_id']);
});
Route::post('/getBoardExamByStudent', function () {
    return getBoardExamByStudent($_REQUEST['value']);
});
Route::post('/getStudentsBySession', function () {
    return getStudentBySession($_REQUEST['section_id'], $_REQUEST['session_id']);
});
Route::post('/getStudentsInfo', function () {
    return getStudentsInfo($_REQUEST['student_id']);
});
Route::post('/getCourseByGroup/{id}', function ($id) {
    return (new \App\Course())->getCourseByGroup($id);
});
Route::post('/uploadedImg/delete', function () {
    return uploadedImgDelete($_REQUEST['table'], $_REQUEST['id'], $_REQUEST['field']);
});
Route::post('/uploadedImg/updated', function () {
    return uploadedImgUpdated($_REQUEST['table'], $_REQUEST['id'], $_REQUEST['field'], $_REQUEST['value']);
});
Route::post('/checkIsClassAdmission/{class_id}', function ($class_id) {
    return checkClassIsAdmission($class_id);
});
Route::post('/getAdmissionTotalBySection/{section_id}', function ($section_id) {
    return getAdmissionTotalBySection($section_id);
});
Route::post('/getRollBySection/{section_id}', function ($section_id) {
    return getRollBySection($section_id);
});

Route::post('/pricings/checkcode', 'PricingController@checkCode')->name('pricings.checkcode');
Route::post('/agents/check', 'AgentController@agentCheck')->name('agent.check');
Route::post('/school/secret_key', 'SettingController@secret_key')->name('school.secret_key');