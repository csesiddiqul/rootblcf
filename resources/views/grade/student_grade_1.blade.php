@extends('layouts.app')
@section('title', __('Result Card'))
@section('content')
    <style>
        * {
            -webkit-print-color-adjust: exact;
        }

        .table-bordered, .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
            border: 1px solid #000;
            padding: 1.5px;
        }

        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            border-top: 1px solid #000 !important;
        }

        .print_style {
            padding: 0px 10px;
            border: 7px solid transparent;
            border-image: url(https://www.w3schools.com/css/border.png) 30% round;
        }

        .div_break {
            padding: 10px 0;
        }

        .custom-tabel {
            background-color: #f0f0f0 !important;
        }

        .table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
            background-color: #f6f6f6 !important;
        }

        .flex-column .nav-item .nav-link {
            padding: 10px 5px !important;
        }

        .table-borderless.table > thead > tr > th, .table > tbody > tr > th, .table-borderless.table > tfoot > tr > th, .table > thead > tr > td, .table-borderless.table > tbody > tr > td, .table > tfoot > tr > td {
            font-size: 15px;
            border: none !important;
            padding: 1.5px;
        }

        .table-font > tbody > tr > td, .table-font > tbody > tr > th, .table-font > thead > tr > th {
            font-size: 15px
        }

        .font-Brush {
            font-family: 'Brush Script MT';
        }

        .font-cursive {
            font-family: cursive;
        }

        .font-bold {
            font-weight: bold;
        }

        .shihab {
            width: 100%
        }


    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div id="table-content" style="background: #FFFFFF">
                        <span class=" ">
                            <button class="btn btn-xs btn-success d-print-none" role="button" id="btnPrint"
                                    onclick="printDiv()"><i class="fa fa-print"></i> @lang('Print')
                            </button>
                           {{-- <button class="btn btn-xs foqas-btn pull-right d-print-none"
                                    onclick="resultsSendSMS('{{$exams[0]->id}}','{{$section}}')">@lang('Send SMS')</button>--}}
                        </span>
                    @foreach($grade_array_multi as $grades)
                        @foreach($grades as $grade_multi)
                            @php
                                $grade = $grade_multi[0] ?? false;
                            @endphp
                            @if ($grade)
                                @php
                                    $studentName = $grade->student->name;
                                    $classNumber = $grade->student->section->class->name;
                                    $classNumber = $grade->student->section->class->name;
                                    $sectionNumber = $grade->student->section->section_number;
                                    $rollNumber = $grade->student->studentInfo->class_roll ?? '';
                                    $codeNumber = $grade->student->student_code;
                                    $cName = subjectOrCourseNameWithOutS();
                                    $className = school('country')->code == 'BD' ? 'Class' : 'Grade';
                                @endphp
                                <div class="col-md-12 div_break">
                                    <div class="print_style">
                                        <div align="center">
                                            <div class="imga" style="display: inline-block;">
                                                <h2 class="font-Brush">
                                                    &nbsp&nbsp&nbsp {{Auth::user()->school->name}}</h2>
                                                @if(foqas_setting('marksheet_address') == 1)
                                                    <h4 style="margin-top: -10px;"
                                                        class="font-Brush">{{Auth::user()->school->address}}</h4>
                                                @endif
                                                @if(foqas_setting('marksheet_established') == 1)
                                                    <h4 style="margin-top: -10px;"
                                                        class="font-Brush">@lang('Established')
                                                        : {{school('established')}}</h4>
                                                @endif
                                                @php $logo = getLogo();
                                                 if (serverIsLocal())
                                                     $imageSize = array();
                                                else
                                                    $imageSize = getimagesize($logo);
                                                @endphp
                                                <img src="{{$logo}}"
                                                     alt="{{Auth::user()->school->name}}"
                                                     style="width: {{(isset($imageSize[0]) && $imageSize[0] == '80' && $imageSize[1] == '80') ? '20%' : '10%'}};margin-top: 5px;">
                                            </div>
                                            <h4>{{ucwords($grade->exam->exam_name)}}
                                                - {{currentSession()->schoolyear}}</h4>
                                            <h4 class="underline font-cursive">@lang('Academic Transcript')</h4>
                                        </div>
                                        <div class="clearhight15"></div>
                                        @if(auth()->user()->school_id == 3)
                                            <img src="{{$logo}}"
                                                 class="watermark d-print-block d-none " alt="logo"
                                                 style="margin-top: 20px; width:500px;height:500px;">
                                        @endif
                                        <table class="table table-bordered table-borderless pull-left table-font"
                                               style="width: 80%">
                                            <tbody>
                                            <tr>
                                                <td class="font-bold">@lang("Student's Name")</td>
                                                <td>:</td>
                                                <td colspan="7" class="font-cursive">{{$studentName}}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-bold">@lang("Father's Name")</td>
                                                <td>:</td>
                                                <td colspan="7"
                                                    class="font-cursive">{{$grade->student->studentInfo->father_name??''}}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-bold">@lang("Mother's Name")</td>
                                                <td>:</td>
                                                <td colspan="7"
                                                    class="font-cursive">{{$grade->student->studentInfo->mother_name??''}}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-bold">@lang("Institution")</td>
                                                <td>:</td>
                                                <td colspan="7" class="font-cursive">{{foqas_setting('eiin')}}
                                                    - {{school('name')}}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-bold">@lang("Student ID")</td>
                                                <td>:</td>
                                                <td class="font-cursive">{{$codeNumber}}</td>
                                                <td class="font-bold">@lang($className)</td>
                                                <td>:</td>
                                                <td class="font-cursive">{{$classNumber}}</td>
                                                <td class="font-bold">@lang("Section")</td>
                                                <td>:</td>
                                                <td class="font-cursive">{{$sectionNumber}}</td>
                                            </tr>
                                            <tr>
                                                <td class="font-bold">@lang('Roll')</td>
                                                <td>:</td>
                                                <td class="font-cursive">{{$rollNumber}}</td>
                                                <td class="font-bold">@lang("Session")</td>
                                                <td>:</td>
                                                <td class="font-cursive">{{$grade->student->studentInfo->sessions->schoolyear??''}}</td>
                                                <td class="font-bold">@lang('Group')</td>
                                                <td>:</td>
                                                <td class="font-cursive">{{$grade->student->studentInfo->group??''}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="table-bordered table pull-right gradeTable"
                                               style="font-size: 9px; width: 20%; top: 25%; right: 15px;">
                                            <thead>
                                            <tr>
                                                <th colspan="3"
                                                    class="text-center">@lang('Mark Comparison with Grade Point')</th>
                                            </tr>
                                            <tr class="text-center">
                                                <th>@lang('Marks')</th>
                                                <th>@lang('Grade')</th>
                                                <th>@lang('Point')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($gradesystems as $gradeSystem)
                                                <tr>
                                                    <td>{{$gradeSystem->from_mark.' - '.$gradeSystem->to_mark}}</td>
                                                    <td class="text-center">{{$gradeSystem->grade}}</td>
                                                    <td class="text-center">{{number_format($gradeSystem->point,2)}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="" id="">
                                            <table class="table table-bordered table-font" style="font-size: 10px;">
                                                <thead>
                                                <tr class="text-center">
                                                    <th style="vertical-align: middle;text-align:center">@lang('SI')</th>
                                                    <th scope="col"
                                                        style="text-align:center;vertical-align : middle;">@lang('Name Of '.$cName)</th>
                                                    <th scope="col">@lang('CA')</th>
                                                    @if($grade->course_config->final_exam_percent > 0)
                                                        <th scope="col">@lang('Written')</th>
                                                        <th scope="col">@lang('Mcq')</th>
                                                    @endif
                                                    <th scope="col">@lang('Practical')</th>
                                                    <th scope="col">@lang('Total')</th>
                                                    <th scope="col">@lang('Point')</th>
                                                    <th scope="col">@lang('Grade')</th>
                                                    @if(foqas_setting('marksheet_ctn')  == 1)
                                                        <th scope="col">@lang($cName.' Teacher')</th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $total_marks = $grade_point = $optional_grade = $subject_count =0;$optional = $subject_group_join = $lastFailExam = false; @endphp
                                                @foreach ($grade_multi as  $grade)
                                                    @if (isset($grade->student->studentInfo->course_group->course))
                                                        @if(in_array($grade->course_config->course->id,explode(',',$grade->student->studentInfo->course_group->course)))
                                                            @php $subject_group_join = false; $total_marks += round($grade->marks);$subject_count++; @endphp
                                                            <tr>
                                                                <td class="text-center">{{$loop->index+1}}</td>
                                                                <td>{{$grade->course_config->course->name}}
                                                                    @if(in_array($grade->course_config->course->id,explode(',',$grade->student->studentInfo->course_group->optional)))
                                                                        @php $optional = true @endphp
                                                                        (@lang('Optional'))
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">{{round($grade->ca)}}</td>
                                                                @if($grade->course_config->final_exam_percent > 0)
                                                                    <td>{{round($grade->written)}}</td>
                                                                    <td>{{round($grade->mcq)}}</td>
                                                                @endif
                                                                <td class="text-center">{{round($grade->practical)}}</td>
                                                                <td class="text-center">{{round($grade->marks)}}</td>
                                                                @php
                                                                    $gradesystemsMany = $grade->course_config->gradeSystemMany($grade->course_config->id);
                                                                    $echo_grade = 'F';
                                                                @endphp
                                                                <td class="text-center">
                                                                    @foreach($gradesystemsMany as $gs)
                                                                        @if(round($grade->marks) >= $gs->from_mark && round($grade->marks) <= $gs->to_mark)
                                                                            @php $grade_point += $gs->point ;$echo_grade=$gs->grade@endphp
                                                                            <b>{{number_format($gs->point,2)}}</b>
                                                                            @if($grade->course_config->course->type == 2)
                                                                                @php $optional_grade = $gs->point @endphp
                                                                            @endif
                                                                            @if($gs->point == 0)
                                                                                @php $lastFailExam = true  @endphp
                                                                            @endif
                                                                            @break
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                                <td class="text-center">{{$echo_grade}}</td>
                                                                @if(foqas_setting('marksheet_ctn') == 1)
                                                                    <td>{{$grade->teacher->name}}</td>
                                                                @endif
                                                            </tr>
                                                        @endif
                                                    @else
                                                        @php $subject_group_join = true; @endphp
                                                    @endif
                                                @endforeach
                                                @if ($subject_group_join)
                                                    <tr>
                                                        <th class="text-danger text-center"
                                                            colspan="{{$grade->course_config->final_exam_percent > 0 ? 9 : 7}}">@lang('There is no '.$cName.' Group.')</th>
                                                    </tr>
                                                    @php toast(transMsg('There is no '.$cName.' Group.'), 'info')->timerProgressBar() @endphp
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        @if ($subject_group_join == false)
                                            <div>
                                                <table class="table table-bordered pull-left"
                                                       style="font-size: 9px;width: 16%">
                                                    <thead>
                                                    <tr>
                                                        <th colspan="4"
                                                            class="text-center">{{$grade->exam->exam_name}}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr class="text-center">
                                                        <td>@lang("Marks")</td>
                                                        <td>{{round($total_marks)}}</td>
                                                        <td>@lang("GPA")</td>
                                                        <td>
                                                            @php
                                                                if($optional){
                                                                        $subject_count = $subject_count -1 ;
                                                                       if ($optional_grade >= 2) {
                                                                           $optional_minus = 2;
                                                                       }elseif ($optional_grade >= 1) {
                                                                            $optional_minus = 1;
                                                                       }else{
                                                                           $optional_minus = 0;
                                                                       }
                                                                        $grade_point = $grade_point - $optional_minus;
                                                                }
                                                                $gpa = $grade_point / $subject_count;
                                                                if ($gpa > 5) {
                                                                    $gpa = 5;
                                                                }
                                                            @endphp
                                                            @if ($lastFailExam)
                                                                0
                                                            @else
                                                                {{number_format($gpa,2)}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <td>@lang("Status")</td>
                                                        <td class="{{ $lastFailExam ? 'text-danger' : ''}}">
                                                            {{$lastFailExam ? 'Fail' : ($gpa>=1 ? 'Pass' : 'Fail')}}
                                                        </td>
                                                        <td>@lang('Position')</td>
                                                        <td>
                                                            @foreach ($grade_multi as  $grade)
                                                                @php $position_no = 1; @endphp
                                                                @foreach($positions as $step => $position)
                                                                    @if ($grade->exam_id == $position->exam_id)
                                                                        @if ($grade->student_id == $position->student_id)
                                                                            @if ($lastFailExam)
                                                                                @php $position_no --; @endphp
                                                                                -
                                                                            @else
                                                                                {{convert_ordinary($position_no)}}
                                                                            @endif
                                                                        @endif
                                                                        @php $position_no ++; @endphp
                                                                    @endif
                                                                @endforeach
                                                                @break
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                                    <tr class="text-center">
                                                        <td>@lang("Comment")</td>
                                                        <td colspan="3"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                        @if(foqas_setting('marksheet_signature') == 1)
                                            <div class="clearhight50"></div>
                                            <div class="d-print-block d-none shihab">
                                                @if(foqas_setting('marksheet_signature_type') == 1)
                                                    <div class="pull-right" style="width: 33%" align="center">
                                                        @if(school('id') == 3)
                                                            <img width="50%"
                                                                 src="https://foqasacademy.s3.us-east-2.amazonaws.com/FA21370339S/FA21370339H/2021/Icon/radhanagar_head_sign.png"
                                                                 alt="Head Of the Institute">
                                                            <div class="clearfix"></div>
                                                        @endif
                                                        ----------------------------
                                                        <div class="clearfix"></div>
                                                        <span class="border_dot">
                                                            @lang('Head Of the Institute')
                                                        </span>
                                                    </div>
                                                @elseif(foqas_setting('marksheet_signature_type') == 2)
                                                    <div class="pull-left " style="width: 34%" align="center">
                                                        -----------------------------------
                                                        <div class="clearfix"></div>
                                                        <span class="border_dot">
                                                                @lang('Signature of Class Teacher')
                                                            </span>
                                                    </div>
                                                    <div class="pull-right" style="width: 33%" align="center">
                                                        @if(school('id') == 3)
                                                            <img width="50%"
                                                                 src="https://foqasacademy.s3.us-east-2.amazonaws.com/FA21370339S/FA21370339H/2021/Icon/radhanagar_head_sign.png"
                                                                 alt="Head Of the Institute">
                                                            <div class="clearfix"></div>
                                                        @endif
                                                        ----------------------------
                                                        <div class="clearfix"></div>
                                                        <span class="border_dot">
                                                            @lang('Head Of the Institute')
                                                        </span>
                                                    </div>
                                                @else
                                                    <div style="width: 33%" class="pull-left" align="center">
                                                        ----------------------------
                                                        <div class="clearfix"></div>
                                                        <span class="border_dot">
                                                        @lang('Signature of Guardian')
                                                    </span>
                                                    </div>
                                                    <div class="pull-left " style="width: 34%" align="center">
                                                        -----------------------------------
                                                        <div class="clearfix"></div>
                                                        <span class="border_dot">
                                                        @lang('Signature of Class Teacher')
                                                    </span>
                                                    </div>
                                                    <div class="pull-left" style="width: 33%" align="center">
                                                        @if(school('id') == 3)
                                                            <img width="50%"
                                                                 src="https://foqasacademy.s3.us-east-2.amazonaws.com/FA21370339S/FA21370339H/2021/Icon/radhanagar_head_sign.png"
                                                                 alt="Head Of the Institute">
                                                            <div class="clearfix"></div>
                                                        @endif
                                                        ----------------------------
                                                        <div class="clearfix"></div>
                                                        <span class="border_dot">
                                                        @lang('Head Of the Institute')
                                                    </span>
                                                    </div>
                                                @endif
                                                <div class="clearhight15"></div>
                                                <div align="center" class="d-print-block d-none"
                                                     style="font-size: 9px">
                                                    @if(isset($exams[0]))
                                                        <span style="float: left">Date of Publication of Results: {{$exams[0]->updated_at->format('F  j, Y')}}</span>
                                                    @endif
                                                    <span style="float: right"> Developed By : {{reseller()->name}}</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
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
                newWin.document.write('<html><title>@lang("Result Card")</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>@page {size: a4 portrait !important;}@media print {  *{background-color: #FEFEEC !important;-webkit-print-color-adjust: exact;}  }#btnPrint{display:none}.d-print-none{display:none}.gradeTable{width:25% !important;top:15% !important;right:10px !important;position: absolute;}.clearhight50{clear:both;height:50px}.clearhight25 {clear: both;height: 25px;}.clearhight15 {clear: both}.print_style {border: 7px solid transparent;padding: 0 15px 0 15px;border-image: url(https://www.w3schools.com/css/border.png) 30% round;position: relative;overflow: auto;min-height:99%;}.div_break{padding: 5px 0;page-break-before: always;}.custom-tabel{background-color: #f0f0f0 !important;} .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{font-size:9px; border: 1px solid #000;padding: 1.5px;background-color: #FEFEEC !important;} .table-borderless.table > thead > tr > th, .table > tbody > tr > th, .table-borderless.table > tfoot > tr > th, .table > thead > tr > td, .table-borderless.table > tbody > tr > td, .table > tfoot > tr > td{font-size:12px; border: none !important;padding: 1.5px;background:none} .table-bordered.table-borderless,.table-borderless{border:none !important;background:none} .table-font > tbody > tr > td, .table-font > tbody > tr > th, .table-font > thead > tr > th {font-size: 15px} .font-Brush {font-family: "Brush Script MT";} .font-cursive{font-family: cursive;}  .font-bold{font-weight: bold;}.watermark {position: absolute;bottom: 30%;right: 15%;opacity: 0.1 !important;z-index: 99;color: white;}.shihab{width:98% !important;position:fixed; bottom:1%;right:1%}table td,table th,{background: transparent!important; background-color: transparent;!important}</style>' + divToPrint.innerHTML + '</body></html>');
                newWin.document.close();
                setTimeout(function () {
                    newWin.close();
                }, 3000);
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
