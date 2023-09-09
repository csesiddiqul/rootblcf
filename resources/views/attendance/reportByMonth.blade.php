@extends('layouts.app')

@section('title', __('Attendance Report'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('attendance.index',auth()->user()->school->code).'">'. trans('Attendance').'</a>  / <b>'. trans('Report By Month').'<b>'])
                @include('components.sectionbar.attendance')
                <div class="panel panel-default">
                    <div class="panel-body pad-top-0">
                        {!! Form::open(['method' => 'POST']) !!}
                        <div class="form-group pl-0 col-md-3{{ $errors->has('section') ? ' has-error' : '' }}" id="atn-15">
                            {!! Form::label('section', trans('Section'), ['class' => 'control-label']) !!}
                            {!! Form::select('section', $pluckSection , $section?? null , ['class' => 'select2 form-control','required','placeholder'=>'Choose']) !!}
                            @error('section')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3{{ $errors->has('month') ? ' has-error' : '' }}" id="atn-15">
                            {!! Form::label('month', trans('Month'), ['class' => 'control-label']) !!}
                            {!! Form::selectMonth('month' , $month??(date('n',strtotime(now()))) , ['class' => 'form-control']) !!}
                            @error('month')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3{{ $errors->has('year') ? ' has-error' : '' }}" id="atn-15">
                            {!! Form::label('year', trans('Year'), ['class' => 'control-label']) !!}
                            {!! Form::selectRange('year', date('Y'), 2000 , $year ?? (date('Y',strtotime(now()))) , ['class' => 'form-control']) !!}
                            @error('year')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2 mt-25" id="atn-15">
                            <button type="submit" class="{{btnClass()}}"
                                    style="height: 38px" >@lang('Get Report')</button>
                        </div>
                        {!! Form::close() !!}
                        @if (isset($attendances) && $attendances->count())
                            <div class="col-md-1 mt-25">
                                <span class="btn btn-default btn-sm pull-right"
                                      onclick="printDiv()">@lang('Print')</span>
                            </div>
                        @endif
                        <div class="clearfix"></div>
                        @isset($attendances)
                            <div id="printDiv">
                            <!-- <span class="pull-left d-print-block d-none">@lang('Print Date : ')<span
                                        id="printTime"></span></span> -->
                                <div class="clearfix"></div>
                                <div align="center" class="d-print-block d-none">
                                    <div style="display:flex;">
                                        <div class="logo" id="logodemo"  style="text-align:right; width: 30%; display:none;">
                                            @if (foqas_setting('logo_type') == 1)
                                                @php $logo = icpl_image(foqas_setting('express')); @endphp
                                                @empty($logo)
                                                    @php $logo = 'https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/favicon.png'; @endphp
                                                @else
                                                @endempty
                                            @else
                                                @php $logo = icpl_image(foqas_setting('standard')); @endphp
                                                @empty($logo)
                                                    @php $logo = 'https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/icpl.png'; @endphp
                                                @endempty
                                            @endif
                                            <img class="imgpri" style="width: 18% !important; margin-top:15px; margin-right:10px;" src="{{$logo}}" alt="Logo">
                                        </div>
                                        <div class="pppttt" id="schoolHeader"  style="text-align:left; display:none;">
                                            @php

                                                    @endphp
                                            <h4 style="color: #079850!important; margin-bottom:6px; margin-top:25px;" class="namebn">বাংলাদেশ ল্যাংগুয়েজ এন্ড
                                                কালচারাল ফাউন্ডেশন</h4>

                                            <h4 class="nameen" id="schoolengName"  style="font-family: Myriad Pro;  margin-bottom:6px;  margin-top:3px; color: #079850 !important; font-size:17px; word-spacing: 4px;">
                                                Bangladesh Language and Cultural Foundation
                                            </h4>
                                            <p id="maincon" class="font_12" style="margin-bottom:6px; font-size:11px; word-spacing: -3.8px;">23 Chuan Terrace, Lorong Chuan, Singapore 558491 (UEN : TT00SS0212J)</p>
                                            <p id="maincon2" style=" font-size:10px; word-spacing: -2.3px;" class="sans">Tel: {{foqas_setting('phone')}} Email: {{foqas_setting('email')}} Website: www.blcf.sg</p>
                                        </div>

                                        
                                    </div>

                                        <p id="mymr" class="font_10 special-box-develop lucida"
                                            style="display:none; text-align: center;  !important; margin-top:40px; width:100%; font-size: 28px; text-transform: uppercase; border: 1px solid #e9e4e4; "><span class="lucida" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:bold; font-size:22px;">REPORT BY MONTH</span><br>
                                        </p>
                                    
                                    
                                    <div class="clearhight50"></div>
                                </div>
                                @if(isset($attendances) && $attendances->count())
                                    <div class="page-panel-title w-100" style="margin-bottom: 15px">
                                        @foreach($attendances as $key => $attendance)
                                            @foreach ($attendance as $field=> $value)
                                                @if ($field == 'classname')
                                                    <b>{{trans(school('country')->code == 'BD' ? 'Class' : 'Grade')}}</b>
                                                    - {{$value}}
                                                @elseif ($field == 'section_number')
                                                    &nbsp;
                                                    <b>@lang('Section')</b>
                                                    -  {{$value}}
                                                @endif
                                                @if ( $field == 'exam_name') &nbsp; <b>@lang('Exam')</b>
                                                -  {{$value}}
                                                @endif
                                                @php $print = true; @endphp
                                            @endforeach
                                            @break($loop->first)
                                        @endforeach
                                        <span class="pull-right"><b>@lang('Attendance Report')</b> {{date("F", strtotime($month)).', '.$year}}</span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped" cellpadding="0"
                                               cellspacing="0" align="center">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                @foreach($attendances as $key => $attendance)
                                                    @foreach ($attendance as $field=> $value)
                                                        @if ($field == 'classname' || $field == 'exam_name'|| $field == 'section_number')
                                                        @elseif($field =='totalP')
                                                            <th>@lang('Total')<br>@lang('Present')</th>
                                                        @elseif($field =='totalA')
                                                            <th>@lang('Total')<br>@lang('Absent')</th>
                                                        @elseif($field =='student_code')
                                                            <td>@lang('Student Id')</td>
                                                        @elseif($field =='name')
                                                            <td>@lang('Name')</td>
                                                        @else
                                                            <th>@lang($field)</th>
                                                        @endif
                                                    @endforeach
                                                    @break($loop->first)
                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($attendances as $key => $attendance)
                                                <tr>
                                                    <td>{{$loop->index +1}}</td>
                                                    @foreach ($attendance as $field => $value)
                                                        @if ($field == 'classname' || $field == 'exam_name'|| $field == 'section_number')
                                                        @elseif($field =='totalP' || $field =='student_code'|| $field =='name' || $field =='totalA')
                                                            <td>{{$value}}</td>
                                                        @else
                                                            <td>
                                                                @if ($value == null)
                                                                @elseif ($value == 0)
                                                                    <span class="label label-danger">A</span>
                                                                @elseif ($value == 1)
                                                                    <span class="label label-success">P</span>
                                                                @elseif ($value == 2)
                                                                    <span class="label label-warning">E</span>
                                                                @endif
                                                                {{--{{$value == null ? '' : ($value == 1 ? 'P' : ($value == 0 ? 'A': 'E'))}}--}}
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @push('script')
                                        <script>
                                            $('.transform-270').css('height', $('.transform-270').width());

                                            function printDiv() {
                                                currentDateTime("printTime");
                                                var divToPrint = document.getElementById('printDiv');
                                                var newWin = window.open('', 'Print-Window');
                                                document.getElementById("schoolengName").style.cssText = `font-family: Myriad Pro;  margin-bottom:6px;  margin-top:3px; color: #079850 !important; font-size:18px; word-spacing: -0.6px !important;`;
                                                document.getElementById("logodemo").style.cssText = `display:block; text-align:right; width: 36%;`;
                                                document.getElementById("schoolHeader").style.cssText = `display:block; text-align:left;`;
                                                document.getElementById("maincon").style.cssText = `margin-bottom:6px; font-size:11px; word-spacing: -3px;`;
                                                document.getElementById("maincon2").style.cssText = `font-size:10px; word-spacing: -4.5px;`;
                                                document.getElementById("mymr").style.cssText = `display:block; margin-top:25px; border: 1px solid #e9e4e4;`;
                                                document.getElementById("hostName").style.cssText = `display:block; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:15px; text-align: center !important; margin-top: 30px; margin-left: 30px;  width: 95%;  border: 1px solid #e9e4e4; `;
                                                newWin.document.open();
                                                newWin.document.write('<html><title>Attendance Report Date {{ date("F", strtotime($month)) .', '.$year}}</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>@page {size: a4 landscape;}.label{border:none;font-weight: 500;padding:0px;font-size:10px;}.clearhight50{clear:both;height:50px}.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{font-size:9px;padding:6px}</style>' + divToPrint.innerHTML + '</body></html>');
                                                newWin.document.close();
                                                setTimeout(function () {
                                                    newWin.close();
                                                }, 1000);
                                            }
                                        </script>
                                    @endpush
                                @else
                                    @lang('No Related Data Found.')
                                @endif
                                <div class="clearhight50"></div>
                                <div class="d-print-block d-none" style="margin-top:50px;">
                                    <div class="pull-left" align="center">
                                        ----------------------
                                        <div class="clearfix"></div>
                                        <span class="border_dot">
                                        @lang('Class Teacher')
                                    </span>
                                    </div>
                                    <div class="pull-right" align="center">
                                        ----------------------
                                        <div class="clearfix"></div>
                                        <span class="border_dot">
                                        @lang('Head Teacher')
                                    </span>
                                    </div>
                                </div>
                                <div class="clearhight50"></div>
                                <div class="mt-30 special-box-develop" id="hostName"
                                 style="display:none; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:15px; text-align: center !important; margin-top: 30px; margin-left: 30px;  width: 95%;  border: 1px solid #e9e4e4; ">
                                    <p style="margin:0px;">Developed by:  IPSITA COMPUTERS PTE LTD <!--{{reseller()->name}}-->.</p>
                                </div>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection