<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\TrialBalanceController;
use App\Http\Controllers\AdjustmentReportController;
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
Route::fallback(function () {
    return abort('404');
});
Route::middleware(['timezone', 'web'])->group(function () {
    Route::get('generate-pdf', 'PublicController@generatePDF');
    Route::get('money-receipt', 'PublicController@money_receipt')->name('money-receipt');
    //Route::get('.well-known/acme-challenge/{filename}', 'PublicController@retrieveLetsEcriptData');
    Route::any('division/uploadingimg', 'DivisionController@uploadImage')->name('division.upload');
    Route::get('/', 'PublicController@index')->name('public.index')->middleware('main_academy');

//    Route::get('filemanager', ['PublicController@fileManagerMy'])->name('fileManager');




    /* Public Call */
    require_once 'component/public.php';
    /* Ajax Call */
    require_once 'component/ajax.php';
    require_once 'component/bkash.php';
    Auth::routes(['verify' => true]);
    Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
    Route::middleware(['auth', 'master'])->group(function () {
        Route::get('/masters', 'MasterController@index')->name('masters.index');
        Route::get('/agents', 'MasterController@agentsIndex')->name('agents.index');
        Route::match(array('GET', 'POST'), '/agents/create', 'MasterController@agentsCreate')->name('agents.create');
        Route::resource('/schools', 'SchoolController')->only(['index', 'edit', 'store', 'update']);
    });
    Route::middleware(['auth', 'check_session'])->group(function () {
        Route::get('/search', 'HomeController@search')->name('search');
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
        // Route::get('/view-attendance/section/{section_id}',function($section_id){
        //   if($section_id > 0){
        //     $attendances = App\Attendance::with(['student'])->where('section_id', $section_id)->get();
        //   }
        // });

        Route::get('attendances/students/{teacher_id}/{course_config_id}/{exam_id}/{section_id}', 'AttendanceController@addStudentsToCourseBeforeAtt')->middleware(['teacher']);
        //  Route::get('attendances/{section_id}/{student_id}/{exam_id}', 'AttendanceController@index');
        Route::match(['GET', 'POST'], 'attendances/{school_code}', 'AttendanceController@index')->name('attendance.index');
        Route::get('attendances/{section_id}', 'AttendanceController@sectionIndex')->middleware(['teacher']);
        Route::post('attendance/take-attendance', 'AttendanceController@store')->middleware(['teacher']);
        Route::get('attendance/adjust/{student_id}/{course_id}/{exam_id}', 'AttendanceController@adjust')->middleware(['teacher'])->name('attendance.adjust');
        Route::post('attendance/adjust', 'AttendanceController@adjustPost')->middleware(['teacher'])->name('attendance.adjust_post');;
        Route::match(['PUT', 'POST'], 'adjustAttendance', 'AttendanceController@adjustPostAjax')->middleware(['admin'])->name('adjustPostAjax');
        Route::post('takeAttendanceViaSection', 'AttendanceController@takeAttendanceViaSection')->middleware(['admin']);
        Route::post('attendanceSendSMS', 'AttendanceController@attendanceSendSMS')->middleware(['admin']);
        Route::match(['GET', 'POST'], 'attendances/{school_code}/reportByDate', 'AttendanceController@reportByDate')->middleware(['admin'])->name('attendance.reportByDate');
        Route::match(['GET', 'POST'], 'attendances/{school_code}/reportByMonth', 'AttendanceController@reportByMonth')->middleware(['admin'])->name('attendance.reportByMonth');
        Route::post('resultsSendSMS', 'ExamController@resultsSendSMS')->middleware(['admin']);
    });

    Route::middleware(['auth', 'teacher'])->prefix('grades')->group(function () {
        Route::get('all-exams-grade', 'GradeController@allExamsGrade')->name('grades.index');
        Route::get('section/{section_id}', 'GradeController@gradesOfSection');
        Route::get('t/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'GradeController@tindex')->name('teacher_grade');
        Route::get('c/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'GradeController@cindex');
        Route::post('save-grade', 'GradeController@update')->name('grades.update');
    });

    Route::get('grades/{student_code}', 'GradeController@index')->middleware(['auth', 'teacher.student'])->name('grade.each_student');
    Route::get('grades/print/{student_code}', 'GradeController@print')->middleware(['auth', 'teacher.student'])->name('grade.each_student_print');;

    Route::middleware(['auth', 'accountant'])->prefix('fees')->name('fees.')->group(function () {
        Route::get('all', 'FeeController@index')->name('index');
        Route::get('show/{id}', 'FeeController@show')->name('show');
        Route::get('create', 'FeeController@create')->name('create');
        Route::get('singale_create/{sid}', 'FeeController@singalecreate')->name('singalecreate');
        Route::get('monay_edit/{sid}', 'FeeController@edit')->name('monay_edit');
        Route::post('create', 'FeeController@store');

    });

    Route::middleware(['auth', 'admin', 'check_session'])->group(function () {
        Route::get('/team', 'UserController@getTeam')->name('team.index');
        Route::get('/school/make_a_payment', 'SchoolPaymentController@makePaymentSchool')->name('make.payment.school');

        Route::get('/upload/excel/{type}', 'UploadController@uploadExcel')->name('upload.excel');
        Route::get('/upload/required_data', 'UploadController@requiredData')->name('upload.required_data');
        Route::get('/settings', 'SettingController@index')->name('settings.index');
        Route::post('/update_info', 'SettingController@updateInfo')->name('setting.update');
        Route::resource('teacherEducationInfo', 'TeacherEducationInfoController');
        Route::post('/routeExamDegreeTitle', function () {
            return getExamDegreeTitle($_REQUEST['value'], $_REQUEST['id']);
        });
        Route::get('/admission/student-admission', 'AdmissionController@getAdmission')->name('student-admission');
        Route::resource('gpa', 'GradesystemController');
    });
    Route::middleware(['auth', 'teacher'])->group(function () {
        Route::get('gpa', 'GradesystemController@index')->name('gpa.index');
    });

    Route::get('invoice/{receipt_number}', 'AccountController@invoice')->name('invoice');
    Route::middleware(['auth', 'check_session'])->group(function () {
        Route::get('/application', 'UserController@getApplication')->name('application.index');
        if ('production' != config('app.env')) {
            Route::get('user/config/impersonate', 'UserController@impersonateGet');
            Route::post('user/config/impersonate', 'UserController@impersonate');
        }
        Route::get('/students', 'UserController@getStudents')->name('students.index');
        Route::match(['GET', 'POST'], 'users/{school_code}/{student_code}/{teacher_code}', 'UserController@index')->name('all_index')->middleware('check_session');
        Route::get('employee/{school_code}/{employee_status}/{employee_role}', 'UserController@employeeindex')->name('employee_index');
        Route::get('users/{school_code}/{role}', 'UserController@indexOther');
        Route::get('user/{user_code}', 'UserController@show')->name('user.show');
        Route::match(array('GET', 'POST'), 'user/config/change_password', 'UserController@changePassword')->name('user.changePassword');
        Route::get('section/students/{section_id}', 'UserController@sectionStudents');
        Route::get('courses/{teacher_id}/{section_id}', 'CourseController@index')->name('course.index');
    });


    Route::middleware(['auth', 'teacher'])->group(function () {
        Route::get('course/students/{teacher_id}/{course_id}/{exam_id}/{section_id}', 'CourseController@course');
        Route::post('courses/create', 'CourseController@create');
        // Route::post('courses/save-under-exam', 'CourseController@update');
        Route::post('courses/save-configuration', 'CourseController@saveConfiguration')->name('course.configuration');
    });

    Route::middleware(['auth', 'admin'])->prefix('academic')->name('academic.')->group(function () {
        Route::resource('session', 'SessionController');
        Route::get('help', 'HomeController@help')->name('help');
        Route::middleware(['check_session'])->group(function () {
            Route::post('grades', 'GradeController@markGrade')->name('grade_mark');;
            Route::get('class', 'MyclassController@getClass')->name('class');
            Route::match(array('GET', 'POST'), 'send_sms', 'MessageController@send_sms')->name('send_sms');
            Route::match(array('GET', 'POST'), 'send_email', 'MessageController@send_email')->name('send_email');
            /* Admission */
            Route::prefix('admission')->name('admission.')->group(function () {
                Route::get('pending', 'AdmissionController@pendingList')->name('pending');
                Route::get('approve', 'AdmissionController@approveList')->name('approve');
                Route::match(array('GET', 'POST'), 'instruction', 'AdmissionController@instruction')->name('instruction');
                Route::match(array('GET', 'POST'), 'lottery', 'AdmissionController@lottery')->name('lottery');
                Route::match(array('GET', 'POST'), 'enroll/{school_code}/{preAddId}/{year}', 'AdmissionController@enrollStudent')->name('enroll');
                Route::match(array('GET', 'POST'), 'markentry/{school_code}/{preAddId}/{year}', 'AdmissionController@markEntry')->name('markEntry');
                Route::post('marksentry', 'AdmissionController@insertMarks')->name('markSubmit');
                Route::post('enroll/store/{preAddId}', 'AdmissionController@enrollPost')->name('enrollPost');
                Route::post('actions/{value}/{id}/{remarks}', 'AdmissionController@admissionActions')->name('actions');
                Route::post('lottery/send_sms/{section_id}/{preAddId}', 'AdmissionController@lottery_sms')->name('lottery_sms');
            });
            /* Course */
            Route::prefix('course')->name('course.')->group(function () {
                Route::get('/', 'CourseController@getCourseindex')->name('index');
                Route::get('create', 'CourseController@create')->name('create');
                Route::post('store', 'CourseController@store')->name('store');
                Route::get('edit/{id}', 'CourseController@edit')->name('edit');
                Route::post('update/{id}', 'CourseController@update')->name('update');
                Route::delete('destroy/{id}', 'CourseController@destroy')->name('destroy');
            });
            /* Syllabus */
            Route::prefix('syllabus')->name('syllabus.')->group(function () {
                Route::get('/', 'SyllabusController@index')->name('index');
                Route::get('{class_id}', 'SyllabusController@create')->name('create');
                Route::post('store', 'SyllabusController@store')->name('store');
                Route::delete('{id}', 'SyllabusController@destroy')->name('destroy');
            });
            /* Notice */
            Route::prefix('notice')->name('notice.')->group(function () {
                Route::get('/', 'NoticeController@index')->name('index');
                Route::get('create', 'NoticeController@create')->name('create');
                Route::post('store', 'NoticeController@store')->name('store');
                Route::get('edit/{id}', 'NoticeController@edit')->name('edit');
                Route::post('update/{id}', 'NoticeController@edit')->name('update');
            });
            /* Event */
            Route::prefix('event')->name('event.')->group(function () {
                Route::get('/', 'EventController@index')->name('index');
                Route::get('create', 'EventController@create')->name('create');
                Route::post('store', 'EventController@store')->name('store');
                Route::get('edit/{id}', 'EventController@edit')->name('edit');
                Route::post('update/{id}', 'EventController@edit')->name('update');
            });
            /* Routine */
            Route::prefix('routine')->name('routine.')->group(function () {
                Route::get('/', 'RoutineController@index')->name('index');
                Route::get('{section_id}', 'RoutineController@create')->name('create');
                Route::post('store', 'RoutineController@store')->name('store');
                Route::delete('{id}', 'RoutineController@destroy')->name('destroy');
            });

            Route::match(['GET', 'POST'], 'testimonials', 'CertificateController@testimonialDesign')->name('testimonials');
            Route::get('tc', 'CertificateController@tcDesign')->name('tc');
            Route::get('bangla/testimonials', 'CertificateController@banglaTestimonial')->name('bangla.testimonials');
            Route::match(['GET', 'POST'], 'seatplan', 'CertificateController@seatPlan')->name('seatplan');
            Route::get('certificate', 'CertificateController@create')->name('certificate.create');
            Route::post('certificate/store', 'CertificateController@store')->name('certificate.store');
            Route::get('member', 'CommitteeController@memberIndex')->name('member.index');

            Route::get('member/create', 'CommitteeController@memberCreate')->name('member.create');
            Route::get('management', 'CommitteeController@managementIndex')->name('management.index');
            Route::get('management/create', 'CommitteeController@managementCreate')->name('management.create');
            Route::post('clone/course_config', 'CourseConfigController@cloneAT')->name('course_config.clone');
            Route::post('examcomment/store', 'ExamCommentController@store');

            Route::resource('breaking_news', 'BreakingNewsController');
            Route::resource('department', 'DepartmentController');
            Route::resource('designation', 'DesignationController');
            Route::resource('course_config', 'CourseConfigController');
            Route::resource('template', 'TempleteDesignController');
            Route::resource('admission', 'AdmissionController');
            Route::resource('preadmission', 'PreAdmissionController');
            Route::resource('branch', 'BranchController');
            Route::resource('category', 'CategoryController');
            Route::resource('complain', 'ComplainController');
            Route::resource('committee', 'CommitteeController');
            Route::resource('content', 'ContentController');
            Route::resource('contact', 'ContactController');
            Route::resource('coursegroup', 'CourseGroupController');
            Route::resource('district', 'DistrictController');
            Route::resource('division', 'DivisionController');
            Route::resource('gallery', 'GalleryController');
            Route::resource('importantLink', 'ImportantLinkController');
            Route::resource('house', 'HouseController');
            Route::resource('menu', 'MenuController');
            Route::resource('state', 'StateController');
            Route::resource('slider', 'SliderController');
            Route::resource('testimonial', 'TestimonialController');
            Route::resource('thana', 'ThanaController');
            Route::resource('tc', 'TransferCertificateController');
            Route::resource('board_exam', 'StudentBoardExamController');
            Route::resource('degree', 'DegreeController');
            // remove routes
            Route::prefix('remove')->name('remove.')->group(function () {
                Route::post('removetempleteImg/{id}/{name}', 'TempleteDesignController@removetempleteImg');
                Route::post('syllabus/{id}/{status}', 'SyllabusController@update')->name('syllabus');
                Route::post('notice/{id}/{status}', 'NoticeController@update')->name('notice');
                Route::post('event/{id}/{status}', 'EventController@update')->name('event');
                Route::post('certificate/{id}', 'CertificateController@update')->name('certificate');
                Route::post('routine/{id}/{status}', 'RoutineController@update')->name('routine');
            });
        });
    });

    Route::middleware(['auth', 'student'])->group(function () {
        Route::get('user/{id}/notifications', 'NotificationController@index');
        Route::get('academic/student/certificates', 'CertificateController@index');
        Route::get('user/financial_statement', 'AccountController@ac_statement')->name('ac_statement');
    });

    Route::middleware(['auth', 'admin', 'check_session'])->prefix('exams')->name('exams.')->group(function () {
        Route::get('/', 'ExamController@index')->name('index');
        Route::get('create', 'ExamController@create')->name('create');
        Route::post('store', 'ExamController@store')->name('store');
        Route::post('activate-exam', 'ExamController@update')->name('update');
        Route::match(['GET', 'POST'], 'admitcard', 'ExamController@admitcard')->name('admitcard.view');
        Route::get('signature', 'ExamController@signatureView')->name('signature');
        Route::get('report', 'ExamController@get_report')->name('report');
        Route::post('report', 'ExamController@post_report')->name('post_report');
    });

    Route::middleware(['auth', 'teacher'])->group(function () {
        Route::get('exams/active', 'ExamController@indexActive');
        Route::get('school/sections', 'SectionController@index');
    });

    Route::middleware(['auth', 'librarian'])->namespace('Library')->group(function () {
        Route::prefix('library')->name('library.')->group(function () {
            Route::resource('books', 'BookController');
        });
    });

    Route::middleware(['auth', 'librarian'])->prefix('library')->name('library.issued-books.')->group(function () {
        Route::get('issue-books', 'IssuedbookController@create')->name('create');
        Route::post('issue-books', 'IssuedbookController@store')->name('store');
        Route::get('issued-books', 'IssuedbookController@index')->name('index');
        Route::post('save_as_returned', 'IssuedbookController@update');
    });

    Route::middleware(['auth', 'accountant'])->prefix('accounts')->name('accounts.')->group(function () {
        Route::get('sectors', 'AccountController@sectors')->name('sectors.index');
        Route::post('create-sector', 'AccountController@storeSector')->name('sectors.create');
        Route::get('edit-sector/{sector}', 'AccountController@editSector')->name('sectors.edit');
        Route::patch('update-sector/{sector}', 'AccountController@updateSector')->name('sectors.update');
        Route::get('sectors/{sector}', 'AccountController@sectorInfo')->name('sectors.show');
        //Route::get('delete-sector/{sector}','AccountController@deleteSector')->name('sectors.delete');
//        Route::get('committee_list', 'CommitteeController@committee_list')->name('committee_list.list');

        Route::get('fileManager',[\App\Http\Controllers\PublicController::class,'fileManagerMy'])->name('fileManager');

        Route::get('ledger', 'AccountController@ledger')->name('ledger.index');
        Route::get('trial_balance', 'TrialBalanceController@AllDataTrialBl')->name('ledger.trial_balance');
        Route::post('create-ledger', 'AccountController@storeLedger')->name('ledger.store');
        Route::get('edit-ledger/{id}', 'AccountController@editLedger')->name('ledger.edit');
        Route::get('ledger/{id}', 'AccountController@ledgerInfo')->name('ledger.show');
        Route::post('update-ledger/{id}', 'AccountController@updateLedger')->name('ledger.update');
        Route::post('delete-ledger/{id}', 'AccountController@deleteLedger')->name('ledger.destroy');
        Route::get('searchdata/{id}/{mydate}', 'AccountController@searchdata')->name('ledger.searchdata');

        Route::get('student_payment_list', 'AccountController@studentPaymentList')->name('student_payment_list');
        Route::post('studentPayment_form', 'AccountController@studentPaymentListSearch')->name('student_payment_form');

        Route::get('editdue/{id}/{mydate}', 'AccountController@editdeu')->name('ledger.editdue');
        Route::post('updatedue/{id}', 'AccountController@updatedue')->name('updatedue');

        Route::get('delete_due/{due_id}/{fee_id}', 'AccountController@delete_due')->name('delete_due');

        Route::get('expense/voucher/{voucher_no}', 'ExpenseController@voucher')->name('expense.voucher');

        Route::match(array('GET', 'POST'), 'adjustment_report', 'AdjustmentReportController@index')->name('adjustmentReport');
//        Route::resource('expense', 'ExpenseController');


        Route::get('income/voucher/{voucher_no}', 'IncomeController@voucher')->name('income.voucher');
        Route::resource('membership_fee', '\App\Http\Controllers\MembershipController');
        Route::resource('expense', 'ExpenseController');
        Route::resource('income', '\App\Http\Controllers\IncomeController');
        Route::resource('internal_transfer','\App\Http\Controllers\InternalTransferController');
        Route::get('income/internal_transfer/{voucher_no}', 'InternalTransferController@voucher')->name('internal_transfer.voucher');

        Route::resource('set_notes','\App\Http\Controllers\SetNotesController');
        Route::resource('pay_receive','\App\Http\Controllers\PayReceivController');
        Route::resource('financialyear', 'FinancialYearController');
        Route::match(array('GET', 'POST','$id'), 'money-receipt', 'AccountController@moneyreceipt')->name('moneyreceipt');
        Route::post('money-received/{student_code}', 'AccountController@moneyreceived')->name('moneyreceived');
        Route::match(array('GET', 'POST'), 'feereport', 'AccountController@feereport')->name('feereport');
        Route::match(array('GET', 'POST'), 'income-expense', 'AccountController@incomeexpense')->name('incomeexpense');
        Route::match(array('GET', 'POST'), 'due-report', 'AccountController@duereport')->name('duereport');

        Route::match(array('GET', 'POST'), 'trial_balance', 'TrialBalanceController@AllDataTrialBl')->name('trial_balance');


        Route::match(array('GET', 'POST'), 'studentfeereport', 'AccountController@studentfeereport')->name('studentfeereport');
        Route::match(array('GET', 'POST'), 'studentpaymentreport', 'AccountController@studentpaymentreport')->name('studentpaymentreport');
        Route::match(array('GET', 'POST'), 'expense-report', 'AccountController@expensereport')->name('expensereport');
        Route::match(array('GET', 'POST'), 'monthly-report', 'AccountController@monthlyreport')->name('monthlyreport');
    });

    //Payroll Admin/Accountant
    Route::middleware(['auth', 'payroll'])->prefix('payroll')->name('payroll.')->group(function () { 
        Route::post('setting', 'EmployeePayrollController@updateSetting')->name('index.setting'); 
        Route::get('process/{ids}', 'EmployeePayrollController@index')->name('index.process');
        Route::post('store', 'EmployeePayrollController@store')->name('store');
        Route::get('pending/{ids}/{pid?}', 'EmployeePayrollController@pending')->name('index.pending');
        Route::get('approve/{ids}/{pid?}', 'EmployeePayrollController@approve')->name('index.approve');
        Route::post('update/{back}', 'EmployeePayrollController@update')->name('update');
        Route::get('approved', 'EmployeePayrollController@edit')->name('index.approvenow'); 
        Route::match(array('GET', 'POST'), 'paidlist/{ids}', 'EmployeePayrollController@paidlist')->name('index.paidlist');
        Route::get('payslip/{ids}', 'EmployeePayrollController@show')->name('index.show');
    });

    //Agent
    Route::middleware(['auth', 'agent'])->group(function () {
        Route::get('agent/profile/edit', 'AgentController@edit')->name('agent.profile.edit');
        Route::patch('agent/profile/edit', 'AgentController@update')->name('agent.profile.update');
        Route::get('/pricings/list', 'PricingController@pricingList')->name('pricings.list');
        Route::get('/school/make_a_payment_agent/{code}', 'SchoolPaymentController@makePaymentAgent')->name('school.make.payment.agent');
    });

    //Master OR Agent
    Route::middleware(['auth', 'master.agent'])->group(function () {
        Route::get('agent/profile/{code}', 'MasterController@agentProfile')->name('agent.profile');
        Route::get('/agent/school/list/{code}', 'AgentController@agentschoolList')->name('agent.school.list');
        Route::get('/schoolpayments/agent/{code}', 'AgentController@index')->name('agent.index');
        Route::get('/schoolpayments/unpaid/{code}', 'AgentController@unpaid')->name('agent.unpaid');
        Route::get('/schoolpayments/paid/{code}', 'AgentController@paid')->name('agent.paid');
        Route::get('/school/payments/list/{code}', 'SchoolPaymentController@indexList')->name('school.payments.indexlist');
        Route::get('/school/subscription/list/{code}', 'SchoolPaymentController@subscriptionList')->name('school.payments.subscriptionlist');
        Route::get('/school/subscription/plan/{code}', 'SchoolPaymentController@subscriptionPlan')->name('school.payments.subscriptionplan');
        Route::get('/school/subscription/plan_details/{school_code}/{pricing}', 'SchoolPaymentController@subscriptionPlandetails')->name('school.payments.subscription.plandetails');
    });

    //Admin OR Agent
    Route::middleware(['auth', 'admin.agent'])->group(function () {
        Route::match(array('GET', 'POST'), 'school/renew_now/{school_code}/{pricing}', 'SubscriptionController@renewNow')->name('school.renew.now');
    });

    //Master OR Admin OR Agent
    Route::middleware(['auth', 'master.admin.agent'])->group(function () {
        Route::match(array('GET', 'POST'), 'school/service_charge/{school_code}', 'SchoolPaymentController@serviceCharge')->name('school.service.charge');
        Route::post('school/services_charge/{school_code}', 'SchoolPaymentController@servicesCharge')->name('school.services.charge');
    });

    Route::middleware(['auth', 'master'])->group(function () {
        Route::post('school/services_charge_cash/{school_code}', 'SchoolPaymentController@servicesChargeCash')->name('school.services.charge_cash');
        Route::get('register/admin/{id}/{code}', function ($id, $code) {
            session([
                'register_role' => 'admin',
                'register_school_id' => $id,
                'register_school_code' => $code,
            ]);
            return redirect()->route('register');
        });
        Route::get('master/activate-admin/{id}', 'UserController@activateAdmin');
        Route::get('master/deactivate-admin/{id}', 'UserController@deactivateAdmin');

        Route::get('agent/edit/{code}', 'MasterController@agentEdit')->name('agent.edit');
        Route::post('agent/store', 'MasterController@agentStore')->name('agent.store');

        Route::get('/pricings', 'PricingController@index')->name('pricings.index');
        Route::get('/pricings/create', 'PricingController@create')->name('pricings.create');
        Route::post('/pricings/create', 'PricingController@store')->name('pricings.store');
        Route::post('/pricings/status/{value}/{id}', 'PricingController@pricingActions')->name('pricings.actions');

        Route::post('/schoolpayments/payselected/{code}', 'AgentController@payselected')->name('agent.payselected');

        Route::resource('pricings', 'PricingController');
        Route::get('/school_payments_unpaid', 'SchoolPaymentController@indexPaymentsUnpaid')->name('index.payments.unpaid');
        Route::get('/school_payments_failed', 'SchoolPaymentController@indexPaymentsFailed')->name('index.payments.failed');
        Route::get('/school/make_a_payment_fa/{code}', 'SchoolPaymentController@makePaymentFa')->name('school.make.payment.fa');
        Route::resource('schoolpayments', 'SchoolPaymentController');

    });

    Route::middleware(['auth', 'admin', 'check_session'])->group(function () {
        Route::get('register/branch/admin/{id}/{code}', function ($id, $code) {
            session([
                'register_role' => 'admin',
                'register_school_id' => $id,
                'register_school_code' => $code,
                'register_branch_admin' => true,
            ]);
            return redirect()->route('register');
        })->name('branch.admin.create');
        Route::get('school/activate-admin/{id}', 'UserController@activateAdmin');
        Route::get('school/deactivate-admin/{id}', 'UserController@deactivateAdmin');

        Route::prefix('school')->name('school.')->group(function () {
            Route::get('website', 'SettingController@website')->name('website');
            Route::get('subscription', 'SchoolController@subscription')->name('subscription');
            Route::get('subscription/plans', 'PricingController@subscriptionPlans')->name('subscription.plans');
            Route::post('add-class', 'MyclassController@store');
            Route::get('class/{id}/edit', 'MyclassController@edit')->name('class_edit');
            Route::post('class/{id}', 'MyclassController@update')->name('class_update');
            Route::get('class/{id}/section', 'SectionController@create')->name('section.create');
            Route::get('section/{class_id}/{id}', 'SectionController@edit')->name('section.edit');
            Route::post('section/{class_id}/{id}/update', 'SectionController@update')->name('section.update');
            Route::post('add-section', 'SectionController@store');
            Route::post('add-department', 'SchoolController@addDepartment');
            Route::get('promote-students/{section_id}', 'UserController@promoteSectionStudents');
            Route::post('promote-students', 'UserController@promoteSectionStudentsPost');
            Route::post('theme', 'SchoolController@changeTheme');
            Route::post('set-ignore-sessions', 'SchoolController@setIgnoreSessions');
        });

        Route::prefix('register')->name('register.')->group(function () {
            Route::get('{role_type}', 'UserController@redirectToRegister');
            Route::post('student', 'UserController@store');
            Route::post('teacher', 'UserController@storeTeacher');
            Route::post('accountant', 'UserController@storeAccountant');
            Route::post('librarian', 'UserController@storeLibrarian');
            Route::post('staff', 'UserController@storeStaff');
        });
    });

    //Master OR Admin Or Teacher
    Route::middleware(['auth', 'master.admin.teacher'])->group(function () {
        Route::get('user/edit/{student_code}', 'UserController@edit')->name('user.edit');
        Route::post('user/update/{student_code}', 'UserController@update')->name('user.update');
    });

    //Master OR Admin
    Route::middleware(['auth', 'master.admin'])->group(function () {
        Route::post('register/admin', 'UserController@storeAdmin');
        Route::post('upload/file', 'UploadController@upload');
        Route::post('users/import/user-xlsx', 'UploadController@import');
        Route::get('users/export/students-xlsx', 'UploadController@export');
        Route::get('admission/export/admission_students.xlsx', 'UploadController@export');
        Route::get('committee/export/committees.xlsx', 'UploadController@export');
        Route::get('school/admin-list/{school_code}', 'SchoolController@show')->name('school.show');
        Route::post('users/active_inactive_user/{id}/{status}', 'UserController@changeStatus')->name('users.changeStatus');
        Route::match(array('GET', 'POST'), 'user/{user_code}/change_password', 'UserController@changepasswordById')->name('user.changePasswordById');
        Route::match(array('GET', 'POST'), 'employee/{user_code}/salary_information', 'EmployeeDetailController@edit')->name('salary.information');
        //   Route::get('pdf/profile/{user_id}',function($user_id){
//     $data = App\User::find($user_id);
//     PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true]);
//     $pdf = PDF::loadView('pdf.profile-pdf', ['user' => $data]);
// 		return $pdf->stream('profile.pdf');
//   });
//   Route::get('pdf/result/{user_id}/{exam_id}',function($user_id, $exam_id){
//     $data = App\User::find($user_id);
//     $grades = App\Grade::with('exam')->where('student_id', $user_id)->where('exam_id',$exam_id)->latest()->get();
//     PDF::setOptions(['defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true]);
//     $pdf = PDF::loadView('pdf.result-pdf', ['grades' => $grades, 'user'=>$data]);
// 		return $pdf->stream('result.pdf');
//   });
    });
    Route::middleware(['auth', 'teacher'])->group(function () {
        Route::get('/communication', 'MessageController@getCommunication')->name('communication.index');
        Route::post('calculate-marks', 'GradeController@calculateMarks')->name('marks.calculate');
        Route::post('message/students', 'NotificationController@store');
    });

// View Emails - in browser
    Route::prefix('emails')->group(function () {
        // Welcome Email
        Route::get('/welcome', function () {
            $user = App\User::find(1);
            $password = 'ABCXYZ';

            return new App\Mail\SendWelcomeEmailToUser($user, $password);
        });
    });

    Route::middleware(['auth', 'student'])->prefix('stripe')->group(function () {
        Route::get('charge', 'CashierController@index');
        Route::post('charge', 'CashierController@store');
        Route::get('receipts', 'PaymentController@index');
    });

    Route::get('/clear', function () {
        $exitCode = Artisan::call('config:clear');
        $exitCode = Artisan::call('cache:clear');
        $exitCode = Artisan::call('config:cache');
        $exitCode = Artisan::call('view:clear');
        $exitCode = Artisan::call('route:clear');
        return redirect()->back(); //Return anything
    });
});
