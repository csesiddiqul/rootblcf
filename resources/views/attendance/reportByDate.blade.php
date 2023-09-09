@extends('layouts.app')

@section('title', trans('Attendance Report'))

@section('content')
    <style>
        .swal2-textarea {
            height: 11.75em !important;
            min-width: 260px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('attendance.index',auth()->user()->school->code).'">'. trans('Attendance').'</a>  / <b>'. trans('Report By Date').'<b>'])
                @include('components.sectionbar.attendance')
                <div class="panel panel-default">
                    <div class="panel-body pad-top-0">
                        {!! Form::open(['method' => 'POST','autocomplete'=>'off']) !!}
                        <div class="form-group pl-0 col-md-3{{ $errors->has('section') ? ' has-error' : '' }}"
                             id="atn-15">
                            {!! Form::label('section', trans('Section'), ['class' => 'control-label']) !!}
                            {!! Form::select('section', $pluckSection , $section?? null , ['class' => 'select2 form-control','required','placeholder'=>'Choose']) !!}
                            @error('section')
                            <span class="help-block">
                                <strong>{{ trans($message) }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3{{ $errors->has('date') ? ' has-error' : '' }}" id="atn-15">
                            {!! Form::label('date', trans('Date'), ['class' => 'control-label']) !!}
                            {!! Form::text('date', $date ?? date('d-m-Y') , ['class' => 'form-control','required','readonly']) !!}
                            @error('date')
                            <span class="help-block">
                                <strong>{{ trans($message) }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2 mt-25" id="atn-15">
                            <button type="submit" class="{{btnClass()}}"
                                    style="height: 38px">@lang('Get Report')</button>
                        </div>
                        {!! Form::close() !!}
                        @if (isset($results) && count($results)>0)
                            <div class="col-md-4 mt-25">
                                <button style="height: 38px" class="btn btn-sm foqas-btn"
                                        onclick="attendanceSendSMS('{{base64_encode($section)}}','{{base64_encode($date)}}','{{$date}}')">@lang('Send SMS to Absent Student')</button>
                                <span style="height: 38px" class="btn btn-default btn-sm pull-right"
                                      onclick="printDiv()">@lang('Print')</span>
                            </div>
                        @endif
                        <div class="clearfix"></div>
                        @isset($results)
                            @if(count($results)>0)
                                <div id="printDiv">
                                    <span class="pull-left d-print-block d-none">
                                        @lang('Print Date :')
                                        <span id="printTime"></span>
                                    </span>
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
                                            style="display:none; text-align: center;  !important; margin-top:40px; width:100%; font-size: 28px; text-transform: uppercase; border: 1px solid #e9e4e4; "><span class="lucida" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:bold; font-size:22px;">REPORT BY DATE</span><br>
                                        </p>
                                        <div class="clearhight50"></div>
                                    </div>
                                    <div class="page-panel-title w-100">
                                        @foreach ($results as $result)
                                            @if(count($result->attendance) == 1)
                                                <b>{{trans(school('country')->code == 'BD' ? ' Class' : 'Grade')}}</b>
                                                - {{$result->section->class->name}}  &nbsp; <b>@lang('Section')</b>
                                                - {{ $result->section->section_number}} &nbsp;
                                                <b>@lang('Exam')</b>
                                                @foreach ($result->attendance as $attendance)
                                                    - {{ $attendance->exam->exam_name}}
                                                @endforeach
                                                @break
                                            @endempty
                                        @endforeach

                                        <span class="pull-right"><b>@lang('Attendance Date'):</b> &nbsp;{{ $date}}</span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>@lang('Student ID')</th>
                                                <th>@lang('Name')</th>
                                                <th>@lang('Phone')</th>
                                                <th>@lang('Attendance')</th>
                                                <th>@lang('Remark')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($results as $result)
                                                <tr>
                                                    <td>{{$loop->index +1}}</td>
                                                    <td>{{$result->student_code}}</td>
                                                    <td>{{$result->name}}</td>
                                                    <td>{{$result->phone_number}}</td>
                                                    <td>
                                                        @if(count($result->attendance) == 1)
                                                            @foreach ($result->attendance as $attendance)
                                                                @if ($attendance->present == 0)
                                                                    <span class="label label-danger">@lang('Absent')</span>
                                                                @elseif ($attendance->present == 1)
                                                                    <span class="label label-success">@lang('Present')</span>
                                                                @elseif ($attendance->present == 2)
                                                                    <span class="label label-warning">@lang('Escaped')</span>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <span class="label label-danger">@lang('Absent')</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if(count($result->attendance) == 1)
                                                            @foreach ($result->attendance as $attendance)
                                                                {{$attendance->remark}}
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="clearhight50"></div>
                                    <div class="d-print-block d-none">
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
                                    <div align="center" class="d-print-block d-none">Developed by : {{reseller()->name}}
                                    </div>
                                </div>
                                @push('script')
                                    <script>
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
                                            newWin.document.write('<html><title>Attendance Report Date {{ $date}}</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>.label{border:none}.clearhight50{clear:both;height:50px}</style>' + divToPrint.innerHTML + '</body></html>');
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
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function () {
            $('#date').datepicker({
                format: "dd-mm-yyyy",
                endDate: "today",
                maxDate: 'today',
                autoclose: true
            });
        })
    </script>
@endpush