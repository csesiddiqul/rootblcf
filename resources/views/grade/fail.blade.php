@extends('layouts.app')

@section('title', __('Merit List'))

@section('content')
    <style>
        .table-borderless > thead > tr > th, .table-borderless > tbody > tr > th, .table-borderless > tfoot > tr > th, .table-borderless > thead > tr > td, .table-borderless > tbody > tr > td, .table-borderless > tfoot > tr > td {
            border: none !important;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('exams').'">'. trans('Exams').'</a>  / <b>'. trans('Fail List').'<b>'])
                @include('components.sectionbar.examination-bar')
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div id="table-content">
                      <span class="pull-left">
                            <button class="btn btn-xs btn-success d-print-none" role="button" id="btnPrint"
                                    onclick="printDiv()"><i class="fa fa-print"></i> @lang('Print')
                            </button>
                        </span>
                            <div class="clearfix"></div>
                            <div align="center">
                                <div class="imga" style="display: inline-block;">
                                    <h2 class="headname">
                                        &nbsp&nbsp&nbsp {{Auth::user()->school->name}}</h2>
                                </div>
                                <h4 style="margin-top: -10px;">{{Auth::user()->school->address}}</h4>
                                <img class="" src="{{getLogo()}}"
                                     alt="{{Auth::user()->school->name}}"
                                     style="width: 10%;margin-top: 5px;">
                                <h4>@lang('Fail List')</h4>
                                <hr>
                            </div>
                            @php
                                $cName = subjectOrCourseNameWithOutS();
                                $className = school('country')->code == 'BD' ? 'Class' : 'Grade';
                            @endphp
                            <div class="academic_info">
                                <table class="table table-borderless" style="width:100%">
                                    <tbody>
                                    @foreach($results as $result)
                                        <tr>
                                            <td>{{$className}}</td>
                                            <td>:</td>
                                            <td>{{$result->class_name}}</td>
                                            <td>@lang('Section')</td>
                                            <td>:</td>
                                            <td>{{$result->section_number}}</td>
                                            @if (!empty($result->group))
                                                <td>@lang('Group')</td>
                                                <td>:</td>
                                                <td>{{$result->group}}</td>
                                            @endif
                                            <td>@lang('Exam')</td>
                                            <td>:</td>
                                            <td>{{$result->exam->exam_name}}</td>
                                            <td>@lang('Session')</td>
                                            <td>:</td>
                                            <td>{{getSessionById($result->exam->session_id,'schoolyear')}}</td>
                                        </tr>
                                        @break
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="clearfix"></div>
                                <table class="table table-responsive table-bordered">
                                    <thead>
                                    <tr>
                                        <th>@lang('SI')</th>
                                        <th>@lang('Student Code')</th>
                                        <th>@lang('Name')</th>
                                        <th>@lang("Father's Name")</th>
                                        <th>@lang("Mother's Name")</th>
                                        <th>@lang("Roll")</th>
                                        <th>@lang("Subject")</th>
                                        <th>@lang("Marks")</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $key=1 @endphp
                                    @foreach($results as $result)
                                        @if ($result->fail > 0)
                                            <tr>
                                                <td>{{$key++}}</td>
                                                <td>{{$result->student_code}}</td>
                                                <td>{{$result->name}}</td>
                                                <td>{{$result->father_name}}</td>
                                                <td>{{$result->mother_name}}</td>
                                                <td>{{$result->class_roll}}</td>
                                                <td>{{$result->fail}}</td>
                                                <td>{{round($result->tMark)}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            // $("#btnPrint").trigger("click");
            function printDiv() {
                var divToPrint = document.getElementById('table-content');
                var newWin = window.open('', 'Print-Window');
                newWin.document.open();
                newWin.document.write('<html><title>@lang("Fail List")</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>#btnPrint{display:none}.d-print-none{display:none}.gradeTable{width:25% !important;top:55px !important;right:10px !important}.clearhight50{clear:both;height:50px}.clearhight25 {clear: both;height: 25px;}.clearhight15 {clear: both}.print_style {border: 1px dashed;position: relative;overflow: auto;padding: 0px 10px;min-height:97%}.div_break{padding: 10px 0;page-break-before: always;}.custom-tabel{background-color: #f0f0f0 !important;} .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{font-size:11px; border: 1px solid #000;padding: 2.5px;}.table-borderless > thead > tr > th, .table-borderless > tbody > tr > th, .table-borderless > tfoot > tr > th, .table-borderless > thead > tr > td, .table-borderless > tbody > tr > td, .table-borderless > tfoot > tr > td{border: none !important;}.headname{font-size:26px} </style>' + divToPrint.innerHTML + '</body></html>');
                newWin.document.close();
                setTimeout(function () {
                    newWin.close();
                }, 1000);
            }

            jQuery(document).bind("keyup keydown", function (e) {
                if (e.ctrlKey && e.keyCode == 80) {
                    printDiv();
                    return false;
                }
            });
        </script>
    @endpush
@endsection
