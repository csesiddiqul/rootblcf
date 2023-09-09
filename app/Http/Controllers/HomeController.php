<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Income;
use App\Payment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Ledger;
use Illuminate\Support\Carbon;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_user = Auth::user();
        if ($auth_user->role == 'master') {
            return redirect('/masters');
        } elseif ($auth_user->role == 'agent') {
            $loginture = session('logintrue');
            if (!$loginture) {
                session()->put('logintrue', true);
                toast(transMsg('Login Successfully!'), 'success')->timerProgressBar();
            }
            session()->forget('foqasLoginFor');
            return view('agent.dashboard');
        } else {
            $minutes = 1440;// 24 hours = 1440 minutes
            $school_id = $auth_user->school->id;
            $classes = \Cache::remember('classes-' . $school_id, $minutes, function () use ($school_id) {
                return \App\Myclass::bySchool($school_id)
                    ->pluck('id')
                    ->toArray();
            });
            $totalStudents = \App\User::bySchool($school_id)
                ->where('role', 'student')
                ->where('active', 1)
                ->count();
            $totalTeachers = \App\User::bySchool($school_id)
                ->where('role', 'teacher')
                ->where('active', 1)
                ->count();
            $totalBooks = \Cache::remember('totalBooks-' . $school_id, $minutes, function () use ($school_id) {
                return \App\Book::bySchool($school_id)->count();
            });
            $totalClasses = \App\Myclass::bySchool($school_id)->count();
            $totalSections = \App\Section::whereIn('class_id', $classes)->count();
            $notices = \Cache::remember('notices-' . $school_id, $minutes, function () use ($school_id) {
                return \App\Notice::bySchool($school_id)->active()->get();
            });
            $events = \Cache::remember('events-' . $school_id, $minutes, function () use ($school_id) {
                return \App\Event::bySchool($school_id)->active()->get();
            });
            $routines = \Cache::remember('routines-' . $school_id, $minutes, function () use ($school_id) {
                return \App\Routine::bySchool($school_id)->active()->get();
            });
            $syllabuses = \Cache::remember('syllabuses-' . $school_id, $minutes, function () use ($school_id) {
                return \App\Syllabus::bySchool($school_id)->active()->get();
            });
            $exams = \Cache::remember('exams-' . $school_id, $minutes, function () use ($school_id) {
                return \App\Exam::bySchool($school_id)->active()->get();
            });
            if ($auth_user->school->status == 3 && $auth_user->hasRole('admin'))
                session()->put('school_expired', true);
            // if(\$auth_user->role == 'student')
            //   $messageCount = \App\Notification::where('student_id',\$auth_user->id)->count();
            // else
            //   $messageCount = 0;
            $loginture = session('logintrue');
            if (!$loginture) {
                session()->put('logintrue', true);
                toast(transMsg('Login Successfully!'), 'success')->timerProgressBar();
            }
            $all_amount = Ledger::sum('current_balance');

            $month = Carbon::now()->month;
            $year = Carbon::now()->year;
            $amount_income = Income::whereMonth('date','=',$month)->whereYear('date','=',$year)->sum('amount');
            $amount_payment = Payment::whereMonth('trans_date','=',$month)->whereYear('trans_date','=',$year)->sum('total');
            $current_income = $amount_income + $amount_payment;
            $current_expense = Expense::whereMonth('date','=',$month)->whereYear('date','=',$year)->sum('amount');

            $year_income = Income::whereYear('date','=',$year)->sum('amount');
            $year_payment = Payment::whereYear('trans_date','=',$year)->sum('total');
            $current_year_income = $year_income + $year_payment;
            $current_year_expense = Expense::whereYear('date','=',$year)->sum('amount');

            //    return $result = DB::table('incomes')
            //             ->leftJoin('payments','payments.id','incomes.payment_id')
            //             ->select('incomes.*','payments.remark')
            //             ->get();

            $expenseMsum  = Expense::select(
                DB::raw('sum(amount) as sums'),
                DB::raw("DATE_FORMAT(date,'%M %$year') as months")
            )->whereYear('date','=',$year)
                ->groupBy('months')
                ->orderBy('date', 'ASC')
                ->get();


            $January_ex = 0;
            $February_ex = 0;
            $March_ex = 0;
            $April_ex = 0;
            $May_ex = 0;
            $June_ex = 0;
            $July_ex = 0;
            $August_ex = 0;
            $September_ex = 0;
            $October_ex = 0;
            $November_ex = 0;
            $December_ex = 0;

            foreach ($expenseMsum as $payment){
                if ( $payment->months == "January $year"){
                    $January_ex =  $payment->sums;
                }elseif($payment->months == "February $year"){
                    $February_ex =  $payment->sums;
                }elseif ($payment->months == "March $year"){
                    $March_ex =  $payment->sums;
                }elseif ($payment->months == "April $year"){
                    $April_ex =  $payment->sums;
                }elseif ($payment->months == "May $year"){
                    $May_ex =  $payment->sums;
                }elseif ($payment->months == "June $year"){
                    $June_ex =  $payment->sums;
                }elseif ($payment->months == "July $year"){
                    $July_ex =  $payment->sums;
                }elseif ($payment->months == "August $year"){
                    $August_ex =  $payment->sums;
                }elseif ($payment->months == "September $year"){
                    $September_ex =  $payment->sums;
                }elseif ($payment->months == "October $year"){
                    $October_ex =  $payment->sums;
                }elseif ($payment->months == "November $year"){
                    $November_ex =  $payment->sums;
                }elseif ($payment->months == "December $year"){
                    $December_ex =  $payment->sums;
                }

            }

            $all_expence =  array(
                0 => array(
                    'sums'=>$January_ex,'months'=>'January '.$year
                ),
                1 => array(
                    'sums'=>$February_ex,'months'=>'February '.$year
                ),
                2 => array(
                    'sums'=>$March_ex,'months'=>'March '.$year
                ),
                3 => array(
                    'sums'=>$April_ex,'months'=>'April '.$year
                ),
                4 => array(
                    'sums'=>$May_ex,'months'=>'May '.$year
                ),
                5 => array(
                    'sums'=>$June_ex,'months'=>'June '.$year
                ),
                6 => array(
                    'sums'=>$July_ex,'months'=>'July '.$year
                ),
                7 => array(
                    'sums'=>$August_ex,'months'=>'August '.$year
                ),
                8 => array(
                    'sums'=>$September_ex,'months'=>'September '.$year
                ),
                9 => array(
                    'sums'=>$October_ex,'months'=>'October '.$year
                ),
                10 => array(
                    'sums'=>$November_ex,'months'=>'November '.$year
                ),
                11 => array(
                    'sums'=>$December_ex,'months'=>'December '.$year
                )
            );
            $expenseport = '';
            if (0 < count($expenseMsum)){
                $last = $expenseMsum[count($expenseMsum) - 1];
                $last->months;
                $x1 = 0;
                do {
                    $expenseport .=  $all_expence[$x1]['sums'] .',';
                    if ($all_expence[$x1]['months'] == $last->months){
                        break;
                    }
                    $x1++;
                } while ($x1 <= 11);
            }


            $Paymentsum  = Payment::select(
                DB::raw('sum(total) as sums'),
                DB::raw("DATE_FORMAT(trans_date,'%M %$year') as months")
            )->whereYear('trans_date','=',$year)
                ->where('trans_status','=','Paid')
                ->groupBy('months')
                ->orderBy('trans_date', 'ASC')
                ->get();

            $January = 0;
            $February = 0;
            $March = 0;
            $April = 0;
            $May = 0;
            $June = 0;
            $July = 0;
            $August = 0;
            $September = 0;
            $October = 0;
            $November = 0;
            $December = 0;

            foreach ($Paymentsum as $payment){
                if ( $payment->months == "January $year"){
                    $January =  $payment->sums;
                }elseif($payment->months == "February $year"){
                    $February =  $payment->sums;
                }elseif ($payment->months == "March $year"){
                    $March =  $payment->sums;
                }elseif ($payment->months == "April $year"){
                    $April =  $payment->sums;
                }elseif ($payment->months == "May $year"){
                    $May =  $payment->sums;
                }elseif ($payment->months == "June $year"){
                    $June =  $payment->sums;
                }elseif ($payment->months == "July $year"){
                    $July =  $payment->sums;
                }elseif ($payment->months == "August $year"){
                    $August =  $payment->sums;
                }elseif ($payment->months == "September $year"){
                    $September =  $payment->sums;
                }elseif ($payment->months == "October $year"){
                    $October =  $payment->sums;
                }elseif ($payment->months == "November $year"){
                    $November =  $payment->sums;
                }elseif ($payment->months == "December $year"){
                    $December =  $payment->sums;
                }

            }

            $all_payment =  array(
             0 => array(
                 'sums'=>$January,'months'=>'January '.$year
             ),
             1 => array(
                 'sums'=>$February,'months'=>'February '.$year
             ),
             2 => array(
                 'sums'=>$March,'months'=>'March '.$year
             ),
             3 => array(
                 'sums'=>$April,'months'=>'April '.$year
             ),
             4 => array(
                 'sums'=>$May,'months'=>'May '.$year
             ),
             5 => array(
                 'sums'=>$June,'months'=>'June '.$year
             ),
             6 => array(
                 'sums'=>$July,'months'=>'July '.$year
             ),
             7 => array(
                 'sums'=>$August,'months'=>'August '.$year
             ),
             8 => array(
                 'sums'=>$September,'months'=>'September '.$year
             ),
             9 => array(
                 'sums'=>$October,'months'=>'October '.$year
             ),
             10 => array(
                 'sums'=>$November,'months'=>'November '.$year
             ),
             11 => array(
                 'sums'=>$December,'months'=>'December '.$year
             )
         );
            $all_payments = '';
            if (0 < count($Paymentsum)){
                $last = $Paymentsum[count($Paymentsum) - 1];
                $last->months;
                $x1 = 0;
                do {
                    $all_payments .=  $all_payment[$x1]['sums'] .',';
                    if ($all_payment[$x1]['months'] == $last->months){
                        break;
                    }
                    $x1++;
                } while ($x1 <= 11);
            }

            $IncomeMsum  = Income::select(
                DB::raw('sum(amount) as sums'),
                DB::raw("DATE_FORMAT(date,'%M %$year') as months")
            )->whereYear('date','=',$year)
                ->groupBy('months')
                ->orderBy('date', 'ASC')
                ->get();


            $January_in = 0;
            $February_in = 0;
            $March_in = 0;
            $April_in = 0;
            $May_in = 0;
            $June_in = 0;
            $July_in = 0;
            $August_in = 0;
            $September_in = 0;
            $October_in = 0;
            $November_in = 0;
            $December_in = 0;

            foreach ($IncomeMsum as $Income){
                if ( $Income->months == "January $year"){
                    $January_in =  $Income->sums;
                }elseif($Income->months == "February $year"){
                    $February_in =  $Income->sums;
                }elseif ($Income->months == "March $year"){
                    $March_in =  $Income->sums;
                }elseif ($Income->months == "April $year"){
                    $April_in =  $Income->sums;
                }elseif ($Income->months == "May $year"){
                    $May_in =  $Income->sums;
                }elseif ($Income->months == "June $year"){
                    $June_in =  $Income->sums;
                }elseif ($Income->months == "July $year"){
                    $July_in =  $Income->sums;
                }elseif ($Income->months == "August $year"){
                    $August_in =  $Income->sums;
                }elseif ($Income->months == "September $year"){
                    $September_in =  $Income->sums;
                }elseif ($Income->months == "October $year"){
                    $October_in =  $Income->sums;
                }elseif ($Income->months == "November $year"){
                    $November_in =  $Income->sums;
                }elseif ($Income->months == "December $year"){
                    $December_in =  $Income->sums;
                }

            }



            $all_income =  array(
                0 => array(
                    'sums'=>$January_in,'months'=>'January '.$year
                ),
                1 => array(
                    'sums'=>$February_in,'months'=>'February '.$year
                ),
                2 => array(
                    'sums'=>$March_in,'months'=>'March '.$year
                ),
                3 => array(
                    'sums'=>$April_in,'months'=>'April '.$year
                ),
                4 => array(
                    'sums'=>$May_in,'months'=>'May '.$year
                ),
                5 => array(
                    'sums'=>$June_in,'months'=>'June '.$year
                ),
                6 => array(
                    'sums'=>$July_in,'months'=>'July '.$year
                ),
                7 => array(
                    'sums'=>$August_in,'months'=>'August '.$year
                ),
                8 => array(
                    'sums'=>$September_in,'months'=>'September '.$year
                ),
                9 => array(
                    'sums'=>$October_in,'months'=>'October '.$year
                ),
                10 => array(
                    'sums'=>$November_in,'months'=>'November '.$year
                ),
                11 => array(
                    'sums'=>$December_in,'months'=>'December '.$year
                )
            );

//         return   $allpayincome = $all_payment  $all_income;


//            $allpayincome = '';
//
//            foreach ($all_income as $incomedata){
//                foreach ($all_payment as $paymentdata){
//                    if ($incomedata['months'] == $paymentdata['months']){
//                        $allpayincome .= $incomedata['sums'] + $paymentdata['sums'] .',';
//                    }
//                }
//            }
//
//            $allpayincome;





            $all_incomes = '';

            if (0 < count($IncomeMsum)){
                $last = $IncomeMsum[count($IncomeMsum) - 1];
//               return $last->months;

                $x2 = 0;
                do {
                    $all_incomes .=  $all_income[$x2]['sums'] .',';

                    if ($all_income[$x2]['months'] == $last->months){
                        break;
                    }
                    $x2++;
                } while ($x2 <= 11);
            }
//          return  $all_incomes;



            return view('home', [
                'totalStudents' => $totalStudents,
                'totalTeachers' => $totalTeachers,
                'totalBooks' => $totalBooks,
                'totalClasses' => $totalClasses,
                'totalSections' => $totalSections,
                'notices' => $notices,
                'events' => $events,
                'routines' => $routines,
                'syllabuses' => $syllabuses,
                'exams' => $exams,
                // 'messageCount'=>$messageCount,
                'all_amount'=>$all_amount,
                'current_expense'=>$current_expense,
                'current_income'=>$current_income,
                'all_payments'=>$all_payments,
                'all_incomes'=>$all_incomes,
                'expenseport'=>$expenseport,
                'current_year_expense'=>$current_year_expense,
                'current_year_income'=>$current_year_income,
            ]);
        }
    }

    public function search(Request $request)
    {
        $student_id = $request->student_id;
        if (is_numeric($student_id)) {
            $student = User::bySchool(auth()->user()->school_id)->student()->where('student_code', $student_id)->first();
            if (empty($student)) {
                toast(transMsg('Student not found'), 'info')->timerProgressBar();
                return redirect()->back();
            }
            return redirect()->route('user.show', $student_id);
        } else {
            return redirect()->route('invoice', $student_id);
        }
    }

    public function help(){
        return view('settings.help');
    }
}