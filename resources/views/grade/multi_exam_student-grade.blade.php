@extends('layouts.app')
@section('title', __('Result Card'))
@section('content')
    <style>
        body {
            color: #000;
            background: #fff;
            font-family: Arial;
        }

        .table-bordered, .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
            border: 1px solid #000;
            padding: 1.5px;
        }

        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            border-top: 1px solid #000 !important;
        }

        .print_style {
            border: 1px dashed;
            padding: 0px 10px;
        }

        #table-content {
            padding: 15px 0;
        }

        .crazy-border {
            margin: 50px 10px;
            box-shadow: 0 0 0 2px red,
            0 0 0 4px white,
            0 0 0 6px orange,
            0 0 0 8px white,
            0 0 0 10px gold,
            0 0 0 12px white,
            0 0 0 14px green,
            0 0 0 16px white,
            0 0 0 18px blue,
            0 0 0 20px white,
            0 0 0 22px purple;
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
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div id="table-content">
                        <span class="pull-left">
                            <button class="btn btn-xs btn-success d-print-none" role="button" id="btnPrint"
                                    onclick="printDiv()"><i class="fa fa-print"></i> @lang('Print')
                            </button>
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
                                            @php
                                                $length = Illuminate\Support\Str::length(Auth::user()->school->name);
                                                $grade_point_right = '28px;';
                                                $logo_width = '20%';
                                                $logo_margin_top = '3%';
                                                $address_mtop = '-10px;';
                                                if (foqas_setting('logo_type') == 2){
                                                     if($length>25){
                                                        $width = '95%;';
                                                        $grade_point_right = '28px;';
                                                        $logo_width = '25%';
                                                        $logo_margin_top = '2%';
                                                    }elseif($length>20){
                                                        $width = '80%;';
                                                        $grade_point_right = '28px;';
                                                        $logo_width = '25%';
                                                    }elseif($length>15){
                                                        $width = '73%;';
                                                        $logo_width = '25%';
                                                    }elseif($length>10){
                                                        $width = '66%;';
                                                        $logo_width = '29%';
                                                    }elseif($length>0){
                                                        $width = '55%;';
                                                        $logo_width = '33%';
                                                    }
                                                }else{
                                                    if($length>25){
                                                        $width = '65%;';
                                                        $logo_width = '10%;';
                                                    }elseif($length>20){
                                                         $width = '60%;';
                                                        $logo_width = '12%;';
                                                    }elseif($length>15){
                                                         $width = '50%;';
                                                        $logo_width = '13%;';
                                                    }elseif($length>10){
                                                        $width = '45%;';
                                                        $logo_width = '18%';
                                                        $address_mtop = '-25px;';
                                                    }elseif($length>0){
                                                        $width = '45%;';
                                                        $logo_width = '18%';
                                                    }
                                                }
                                            @endphp
                                            <div class="imga" align="center"
                                                 style="display: inline-block; {{'width: '.$width}}">
                                                <img class="pull-left" src="{{getLogo()}}"
                                                     alt="{{Auth::user()->school->name}}"
                                                     style="width: {{$logo_width}};{{foqas_setting('logo_type') == 2 ? 'margin-top: '.$logo_margin_top.';' : 'margin-top: 5px'}}">
                                                <h2 class="pull-left">
                                                    &nbsp&nbsp&nbsp {{Auth::user()->school->name}}</h2>
                                            </div>
                                            <h4 style="margin-top: {{ $address_mtop}}">{{Auth::user()->school->address}}</h4>
                                            <h4>@lang('Result Card')</h4>
                                        </div>
                                        <table class="table table-bordered pull-left"
                                               style="font-size: 9px;width: 65%">
                                            <thead>
                                            <tr>
                                                <th colspan="2"
                                                    class="text-center">@lang('Personal Information')</th>
                                                <th colspan="4"
                                                    class="text-center">@lang('School Information')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>@lang("Student's Name")</td>
                                                <td>{{$studentName}}</td>
                                                <td>@lang("Student ID")</td>
                                                <td>{{$codeNumber}}</td>
                                                <td>@lang('Roll')</td>
                                                <td>{{$rollNumber}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang("Father's Name")</td>
                                                <td>{{$grade->student->studentInfo->father_name??''}}</td>
                                                <td>@lang($className)</td>
                                                <td>{{$classNumber}}</td>
                                                <td>@lang("Session")</td>
                                                <td>{{$grade->student->studentInfo->sessions->schoolyear??''}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang("Mother's Name")</td>
                                                <td>{{$grade->student->studentInfo->mother_name??''}}</td>
                                                <td>@lang("Section")</td>
                                                <td>{{$sectionNumber}}</td>
                                                <td>@lang('Group')</td>
                                                <td>{{$grade->student->studentInfo->group??''}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="table-bordered table pull-right gradeTable"
                                               style="font-size: 9px; width: 20%; top: 50px;  right: {{$grade_point_right}}">
                                            <thead>
                                            <tr>
                                                <th colspan="3"
                                                    class="text-center">@lang('Mark Comparison with Grade Point')</th>
                                            </tr>
                                            <tr>
                                                <th>@lang('Marks')</th>
                                                <th>@lang('Grade')</th>
                                                <th>@lang('Point')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($gradesystems as $gradeSystem)
                                                <tr>
                                                    <td>{{$gradeSystem->from_mark.' - '.$gradeSystem->to_mark}}</td>
                                                    <td>{{$gradeSystem->grade}}</td>
                                                    <td>{{$gradeSystem->point}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        @php $total_exam=0 @endphp
                                        <div class="" id="">
                                            <table class="table table-bordered" style="font-size: 10px;">
                                                <thead>
                                                <tr>
                                                    <th rowspan="2"
                                                        style="text-align:center;vertical-align : middle;"
                                                        scope="col">@lang($cName)</th>
                                                    @foreach($grades as $grade_multi)
                                                        @foreach ($grade_multi as  $grade)
                                                            <th colspan="{{$grade->course_config->final_exam_percent > 0 ? 7 : 5}}"
                                                                class="text-center"
                                                                scope="col">{{$grade->exam->exam_name}}</th>
                                                            @php $total_exam++@endphp
                                                            @break
                                                        @endforeach
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    @foreach($grades as $grade_multi)
                                                        @foreach ($grade_multi as  $grade)
                                                            <th scope="col">@lang('CA')</th>
                                                            @if($grade->course_config->final_exam_percent > 0)
                                                                <th scope="col">@lang('Written')</th>
                                                                <th scope="col">@lang('Mcq')</th>
                                                            @endif
                                                            <th scope="col">@lang('Practical')</th>
                                                            <th scope="col">@lang('Total')</th>
                                                            <th scope="col">@lang('Point')</th>
                                                            <th scope="col">@lang('Grade')</th>
                                                            @break
                                                        @endforeach
                                                    @endforeach
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $total_marks = $grade_point = $optional_grade = $subject_count = 0;$optional = $subject_group_join = $lastFailExam = false;$exam_array = $course_array= array();@endphp
                                                @foreach($grades as  $grade_multi)
                                                    @foreach ($grade_multi as $grade)
                                                        @php ${"total_marks" . $grade->exam_id} =  ${"subject_count" . $grade->exam_id} = ${"optional_grade" . $grade->exam_id} = ${"grade_point" . $grade->exam_id} = 0; ${"fail" . $grade->exam_id} =false; @endphp
                                                    @endforeach
                                                @endforeach
                                                @foreach ($grade_multi as $key => $grade)
                                                    @if (isset($grade->student->studentInfo->course_group->course))
                                                        @if(in_array($grade->course_config->course->id,explode(',',$grade->student->studentInfo->course_group->course)))
                                                            @php $subject_group_join = false; @endphp
                                                            <tr>
                                                                <td>{{$grade->course_config->course->name}}
                                                                    @if(in_array($grade->course_config->course->id,explode(',',$grade->student->studentInfo->course_group->optional)))
                                                                        @php $optional = true @endphp
                                                                        (@lang('Optional'))
                                                                    @endif
                                                                </td>
                                                                @foreach($grades as  $grade_multi)
                                                                    @foreach ($grade_multi as $sec_key => $grade)
                                                                        @if(!in_array($grade->exam_id.$key,$exam_array) && !in_array($grade->course_id.$grade->exam_id,$course_array))
                                                                            <td class="text-center">{{round($grade->ca)}}</td>
                                                                            @if($grade->course_config->final_exam_percent > 0)
                                                                                <td class="text-center">{{round($grade->written)}}</td>
                                                                                <td class="text-center">{{round($grade->mcq)}}</td>
                                                                            @endif
                                                                            <td class="text-center">{{round($grade->practical)}}</td>
                                                                            <td class="text-center">{{round($grade->marks)}}</td>
                                                                            @php
                                                                                $gradesystemsMany = $grade->course_config->gradeSystemMany($grade->course_config->id);
                                                                                $echo_grade = 0;
                                                                            @endphp
                                                                            <td class="text-center">
                                                                                @foreach($gradesystemsMany as $gs)
                                                                                    @if(round($grade->marks) >= $gs->from_mark && round($grade->marks) <= $gs->to_mark)
                                                                                        @php ${"grade_point" . $grade->exam_id} += $gs->point ;$echo_grade=$gs->grade@endphp
                                                                                        <b>{{number_format($gs->point,2)}}</b>
                                                                                        @if($grade->course_config->course->type == 2)
                                                                                            @php ${"optional_grade" . $grade->exam_id} = $gs->point  @endphp
                                                                                        @endif
                                                                                        @if($gs->point == 0)
                                                                                            @php ${"fail" . $grade->exam_id} = true  @endphp
                                                                                        @endif
                                                                                        @break
                                                                                    @endif
                                                                                @endforeach
                                                                            </td>
                                                                            <td class="text-center">{{$echo_grade}}</td>
                                                                            @php
                                                                                array_push($exam_array, $grade->exam_id.$key);
                                                                                array_push($course_array, $grade->course_id.$grade->exam_id);
                                                                                ${"total_marks" . $grade->exam_id} += round($grade->marks);
                                                                                ${"subject_count" . $grade->exam_id}++;
                                                                            @endphp
                                                                            @if (${"fail" . $grade->exam_id} && $loop->last)
                                                                                @php $lastFailExam = true; @endphp
                                                                            @endif
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </tr>
                                                        @endif
                                                    @else
                                                        @php $subject_group_join = true; @endphp
                                                    @endif
                                                @endforeach
                                                @if ($subject_group_join)
                                                    <tr>
                                                        <th class="text-danger text-center"
                                                            colspan="{{$grade->course_config->final_exam_percent > 0 ? (8*$total_exam-1) : (6*$total_exam-1)}}">@lang('There is no '.$cName.' Group.')</th>
                                                    </tr>
                                                    @php toast(transMsg('There is no '.$cName.' Group.'), 'info')->timerProgressBar() @endphp
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        @if ($subject_group_join == false)
                                            <div>
                                                <table class="table table-bordered pull-left"
                                                       style="font-size: 9px;">
                                                    <thead>
                                                    <tr>
                                                        @foreach($grades as  $grade_multi)
                                                            @foreach ($grade_multi as  $grade)
                                                                <th colspan="4"
                                                                    class="text-center">{{$grade->exam->exam_name}}</th>
                                                                @break
                                                            @endforeach
                                                        @endforeach
                                                        <th class="text-center"
                                                            colspan="{{$total_exam+6}}">@lang('Final Report')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php $grand_total_gpa=0;$grand_total=0 @endphp
                                                    <tr>
                                                        @foreach($grades as  $grade_multi)
                                                            @foreach ($grade_multi as  $grade)
                                                                <td>@lang("Marks")</td>
                                                                <td>{{ round(${"total_marks" . $grade->exam_id}) }}</td>
                                                                <td>@lang("GPA")</td>
                                                                <td>
                                                                    @php
                                                                        if($optional){
                                                                                ${"subject_count" . $grade->exam_id} = ${"subject_count" . $grade->exam_id} -1 ;
                                                                               if (${"optional_grade" . $grade->exam_id} >= 2) {
                                                                                   $optional_minus = 2;
                                                                               }elseif (${"optional_grade" . $grade->exam_id} >= 1) {
                                                                                    $optional_minus = 1;
                                                                               }else{
                                                                                   $optional_minus = 0;
                                                                               }
                                                                                ${"grade_point" . $grade->exam_id} = ${"grade_point" . $grade->exam_id} - $optional_minus;
                                                                        }
                                                                        ${"gpa" . $grade->exam_id} = ${"grade_point" . $grade->exam_id} / ${"subject_count" . $grade->exam_id};
                                                                        if (${"gpa" . $grade->exam_id} > 5) {
                                                                            ${"gpa" . $grade->exam_id} = 5;
                                                                        }
                                                                        $grand_total_gpa+=${"gpa" . $grade->exam_id};
                                                                    @endphp
                                                                    @if (${"fail" . $grade->exam_id})
                                                                        0
                                                                    @else
                                                                        {{number_format(${"gpa" . $grade->exam_id},2)}}
                                                                    @endif
                                                                </td>
                                                                @break
                                                            @endforeach
                                                        @endforeach
                                                        @foreach($grades as  $grade_multi)
                                                            @foreach ($grade_multi as  $grade)
                                                                <td>{{$grade->exam->exam_name}}</td>
                                                                @break
                                                            @endforeach
                                                        @endforeach
                                                        <td>@lang('Total Mark')</td>
                                                        <td>@lang('Total Avg. Mark')</td>
                                                        <td>@lang('Total Avg. GPA')</td>
                                                        <td>@lang('Grade')</td>
                                                        <td>@lang('Position')</td>
                                                        <td>@lang("Status")</td>
                                                    </tr>
                                                    <tr>
                                                        @foreach($grades as  $grade_multi)
                                                            @foreach ($grade_multi as  $grade)
                                                                @php $fail = ${"fail" . $grade->exam_id} ? true : (${"gpa" . $grade->exam_id}>0 ? false : true) @endphp
                                                                <td>@lang("Status")</td>
                                                                <td class="{{ $fail ? 'text-danger' : ''}}">
                                                                    {{ $fail ? 'Fail' : 'Pass'}}
                                                                </td>
                                                                <td>@lang('Position')</td>
                                                                <td>
                                                                    @php $position_no = 1; @endphp
                                                                    @foreach($positions as $step => $position)
                                                                        @if ($grade->exam_id == $position->exam_id)
                                                                            @if ($grade->student_id == $position->student_id)
                                                                                @if ($fail)
                                                                                    @php $position_no --; @endphp
                                                                                    -
                                                                                @else
                                                                                    {{convert_ordinary($position_no)}}
                                                                                @endif
                                                                            @endif
                                                                            @php $position_no ++; @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                                @break
                                                            @endforeach
                                                        @endforeach
                                                        @foreach($grades as  $grade_multi)
                                                            @foreach ($grade_multi as  $grade)
                                                                @php $grand_total+=${"total_marks" . $grade->exam_id}; @endphp
                                                                <td>{{ round(${"total_marks" . $grade->exam_id}) }}</td>
                                                                @break
                                                            @endforeach
                                                        @endforeach
                                                        <td>{{ round($grand_total)}}</td>
                                                        <td>{{ round($grand_total/$total_exam)}}</td>
                                                        @php $grand_gpa=$grand_total_gpa/$total_exam; @endphp
                                                        <td>{{$lastFailExam ? '-' : number_format($grand_gpa,2)}}</td>
                                                        <td>
                                                            @php $previous_point=0 @endphp
                                                            @foreach($gradesystems as $gs)
                                                                @if($grand_gpa >= $gs->point && $grand_gpa <= $previous_point)
                                                                    <b>{{ $lastFailExam ? '-' : $gs->grade}}</b>
                                                                    @break
                                                                @endif
                                                                @php $previous_point=$gs->point @endphp
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @php $position_no = 1; @endphp
                                                            @foreach($grades as  $grade_multi)
                                                                @foreach ($grade_multi as  $grade)
                                                                    @foreach($final_positions as $final_position)
                                                                        @if ($grade->student_id == $final_position->student_id)
                                                                            @if ($lastFailExam)
                                                                                @php $position_no --; @endphp
                                                                                -
                                                                            @else
                                                                                {{convert_ordinary($position_no)}}
                                                                            @endif
                                                                        @endif
                                                                        @php $position_no ++; @endphp
                                                                    @endforeach
                                                                    @break
                                                                @endforeach
                                                                @break
                                                            @endforeach
                                                        </td>
                                                        @php $finalFail = $lastFailExam ? true : ($grand_gpa>0 ? false : true) @endphp
                                                        <td class="{{ $finalFail ? 'text-danger' : ''}}">
                                                            {{ $finalFail ? 'Fail' : 'Pass'}}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        @foreach($grades as  $grade_multi)
                                                            @foreach ($grade_multi as  $grade)
                                                                <td>@lang("Comment")</td>
                                                                <td colspan="3"></td>
                                                                @break
                                                            @endforeach
                                                        @endforeach
                                                        <td>@lang('Comment')</td>
                                                        <td class="text-center"
                                                            colspan="{{$total_exam+5}}"></td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                        <div class="clearhight50"></div>
                                        <div class="d-print-block d-none" style="width: 100%">
                                            <div style="width: 33%" class="pull-left" align="center">
                                                ----------------------------
                                                <div class="clearfix"></div>
                                                <span class="border_dot">
                                                    @lang('Signature of Guardian')
                                                </span>
                                            </div>
                                            <div class="pull-left " style="width: 34%" align="center">
                                                ----------------------------
                                                <div class="clearfix"></div>
                                                <span class="border_dot">
                                                        @lang('Signature of Class Teacher')
                                                    </span>
                                            </div>
                                            <div class="pull-left" style="width: 33%" align="center">
                                                ----------------------------
                                                <div class="clearfix"></div>
                                                <span class="border_dot">
                                                        @lang('Principal Signature')
                                                    </span>
                                            </div>
                                            <div class="clearhight15"></div>
                                            <div align="center" class="d-print-block d-none"
                                                 style="font-size: 9px">
                                                Developed By : {{reseller()->name}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearhight15 d-print-none"></div>
                            @endif
                            @break
                        @endforeach
                    @endforeach
                </div>
                @push('script')
                    <script>
                        // $("#btnPrint").trigger("click");
                        function printDiv() {
                            var divToPrint = document.getElementById('table-content');
                            var newWin = window.open('', 'Print-Window');
                            newWin.document.open();
                            newWin.document.write('<html><title>@lang("Result Card")</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>#btnPrint{display:none}.d-print-none{display:none}.gradeTable{width:25% !important;top:55px !important;right:10px !important;position: absolute;}.clearhight50{clear:both;height:50px}.clearhight25 {clear: both;height: 25px;}.clearhight15 {clear: both}.print_style {border: 1px dashed;position: relative;overflow: auto;padding: 0px 10px;min-height:97%}.div_break{padding: 10px 0;page-break-before: always;}.custom-tabel{background-color: #f0f0f0 !important;} .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{font-size:9px; border: 1px solid #000;padding: 1.5px;} </style>' + divToPrint.innerHTML + '</body></html>');
                            newWin.document.close();
                            setTimeout(function () {
                                newWin.close();
                            }, 100);
                        }
                    </script>
                @endpush
            </div>
        </div>
    </div>
@endsection
