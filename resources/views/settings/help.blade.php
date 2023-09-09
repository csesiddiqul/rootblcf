@extends('layouts.app') 
@section('title', __('User Manual')) 
@section('content')
 <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel-group">
                    <div class="col-md-6 col-md-offset-2">
                        <div class="panel panel-default">
                            <div style="font-size: 16.5px;" class="panel-heading"><i style="padding-right:10px;" class="fa fa-hand-o-right" aria-hidden="true"></i>@lang('User Manuals')</div>
                            <div class="panel-body col-md-offset-2">
                                <ul style="list-style:none;">
                                    <li><a href="{{asset('storage/help/BLCF_academics_user_manual.pdf')}}" target="_blank"><i style="padding-right:7px;" class="fa fa-university" aria-hidden="true"></i> 
                                    <b>Academics</b></a></li><br>
                                    <li ><a href="{{asset('storage/help/BLCF_admission_user_manual.pdf')}}" target="_blank"><i style="padding-right:10px;" class="fa fa-book" aria-hidden="true"></i> 
                                    <b>Admission</b></a></li><br>
                                    <li><a href="{{asset('storage/help/BLCF_attendance_user_manual.pdf')}}" target="_blank"><i style="padding-right:12px;" class="fa fa-clock-o" aria-hidden="true"></i> 
                                    <b>Attendance</b></a></li><br>
                                    <li><a href="{{asset('storage/help/blcf_communication_user_manual.pdf')}}" target="_blank"><i style="padding-right:10px;" class="fa fa-bullhorn" aria-hidden="true"></i> 
                                    <b>Communication</b></a></li><br>
                                    <li><a href="{{asset('storage/help/blcf_hr part user manual.pdf')}}" target="_blank"><i style="padding-right:9px;" class="fa fa-users" aria-hidden="true"></i> 
                                    <b>Human Resource</b></a></li><br>
                                    <li><a href="{{asset('storage/help/blcf_manage_accounts_user_manual.pdf')}}" target="_blank"><i style="padding-right:18px;" class="fa fa-usd" aria-hidden="true"></i> 
                                    <b>Accounts</b></a></li><br>
                                    <li><a href="{{asset('storage/help/blcf_student part user manual.pdf')}}" target="_blank"><i style="padding-right:12px;" class="fa fa-user-circle-o" aria-hidden="true"></i> 
                                    <b>Students</b></a></li><br>
                                    <li><a href="{{asset('storage/help/BLCF_calender_user_manual.pdf')}}" target="_blank"><i style="padding-right:12px;" class="fa fa-calendar" aria-hidden="true"></i> 
                                    <b>Calendar</b></a></li><br>
                                    <li><a href="{{asset('storage/help/blcf_payroll.pdf')}}" target="_blank"><i style="padding-right:12px;" class="fa fa-product-hunt" aria-hidden="true"></i> 
                                    <b>Payroll</b></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
             </div>
        </div>
</div>
@endsection