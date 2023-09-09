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
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('exams').'">'. trans('Exams').'</a>  / <b>'. trans('Tabulation').'<b>'])
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
                                    <h2 class="pull-left headname"> {{Auth::user()->school->name}}</h2>
                                </div>
                                <h4 style="margin-top: -10px;">{{Auth::user()->school->address}}</h4>
                                <img src="{{getLogo()}}" alt="{{Auth::user()->school->name}}"
                                     style="width: 10%;margin-top: 5px;">
                                <h4>@lang('Tabulation Sheet')</h4>
                            </div>
                            @php
                                $cName = subjectOrCourseNameWithOutS();
                                $className = school('country')->code == 'BD' ? transMsg('Class') : transMsg('Grade');
                            @endphp
                            <div class="academic_info">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{$className}}</th>
                                        <th>@lang('Section')</th>
                                        <th>@lang('Group')</th>
                                        <th>@lang('Exam')</th>
                                        <th>@lang('Session')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results as $result)
                                        <tr>
                                            <td>{{$result->class_name}}</td>
                                            <td>{{$result->section_number}}</td>
                                            <td>{{$result->group}}</td>
                                            <td>{{$result->exam->exam_name}}</td>
                                            <td> @php
                                                    $currentSession = currentSession();
                                                @endphp
                                                {{$currentSession->schoolyear}}
                                            </td>
                                        </tr>
                                        @break
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="clearfix"></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered" style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th rowspan="2"
                                                style="text-align:center;vertical-align : middle;">@lang('SI')</th>
                                            <th rowspan="2"
                                                style="text-align:center;vertical-align : middle;">@lang('Student Code')</th>
                                            <th rowspan="2"
                                                style="text-align:center;vertical-align : middle;">@lang('Roll')</th>
                                            <th rowspan="2"
                                                style="text-align:center;vertical-align : middle;">@lang('Name')</th>
                                            @foreach($courses as $course)
                                                <th colspan="6" id="course_{{$course->id}}"
                                                    style="text-align:center">{{$course->name}}</th>
                                            @endforeach
                                            <th colspan="4" style="text-align:center">@lang('Final')</th>
                                        </tr>
                                        <tr>
                                            @foreach($courses as $course)
                                                <th id="ca_{{$course->id}}">@lang('CA')</th>
                                                <th>@lang('CQ')</th>
                                                <th id="mcq_{{$course->id}}">@lang('MCQ')</th>
                                                <th id="practical_{{$course->id}}">@lang('P')</th>
                                                <th>@lang('Mark')</th>
                                                <th>@lang('LG')</th>
                                            @endforeach
                                            <th>@lang('Total')</th>
                                            <th>@lang('GPA')</th>
                                            <th>@lang('LG')</th>
                                            <th>@lang('Merit')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $pre_stu=null;$student_array=array();$key=1;$td_ca =$td_mcq=$td_practical= false;@endphp
                                        @foreach($results as $result)
                                            @if (!in_array($result->student_code,$student_array))
                                                @php array_push($student_array,$result->student_code);$pre_stu=$result->student_code;$sub_total=$sub_gpa=$subject_count=$optional_grade=0;$optional=$fail=$optional_fail=false;$print_text=''; @endphp
                                                <tr>
                                                    <td>{{$key++}}</td>
                                                    <td>{{$result->student_code}}</td>
                                                    <td>{{$result->class_roll}}</td>
                                                    <td>{{$result->student_name}}</td>
                                                    @foreach($courses as $course)
                                                        @php $course_colspan=0; @endphp
                                                        @if(in_array($course->id,explode(',',$result->course_groups)))
                                                            @foreach($results as $t_result)
                                                                @if($t_result->course_id == $course->id && $pre_stu == $t_result->student_code)
                                                                    @php $sub_total += round($t_result->marks);$sub_gpa +=$t_result->gpa;$subject_count++; @endphp
                                                                    @if ($t_result->ca)
                                                                        @php ${"ca" . $course->id} = true; $td_ca = true;@endphp
                                                                        <td>{{round($t_result->ca)}}</td>
                                                                    @else
                                                                        @if (!isset(${"ca" . $course->id}))
                                                                            @php $course_colspan +=1 @endphp
                                                                            @push('script')
                                                                                <script>
                                                                                    $("#ca_" + {{$course->id}}).css('display', 'none');
                                                                                </script>
                                                                            @endpush
                                                                            @php $print_text= $print_text.'#ca_'.$course->id.'{display: none;}'@endphp
                                                                        @elseif(isset(${"ca" . $course->id}) && $td_ca)
                                                                            <td>0</td>
                                                                        @endif
                                                                    @endif
                                                                    <td>{{round($t_result->written)}}</td>
                                                                    @if ($t_result->mcq)
                                                                        @php ${"mcq" . $course->id} = true;$td_mcq = true; @endphp
                                                                        <td>{{round($t_result->mcq)}}</td>
                                                                    @else
                                                                        @if (!isset(${"mcq" . $course->id}))
                                                                            @php $course_colspan +=1 @endphp
                                                                            @push('script')
                                                                                <script>
                                                                                    $("#mcq_" + {{$course->id}}).css('display', 'none');
                                                                                </script>
                                                                            @endpush
                                                                            @php $print_text= $print_text.'#mcq_'.$course->id.'{display: none;}'@endphp
                                                                        @elseif(isset(${"mcq" . $course->id}) && $td_mcq)
                                                                            <td>0</td>
                                                                        @endif
                                                                    @endif
                                                                    @if ($t_result->practical)
                                                                        @php ${"practical" . $course->id} = true;$td_practical = true;@endphp
                                                                        <td>{{round($t_result->practical)}}</td>
                                                                    @else
                                                                        @if (!isset(${"practical" . $course->id}))
                                                                            @php $course_colspan +=1 @endphp
                                                                            @push('script')
                                                                                <script>
                                                                                    $("#practical_" + {{$course->id}}).css('display', 'none');
                                                                                </script>
                                                                            @endpush
                                                                            @php $print_text= $print_text.'#practical_'.$course->id.'{display: none;}'@endphp
                                                                        @elseif(isset(${"practical" . $course->id}) && $td_practical)
                                                                            <td>0</td>
                                                                        @endif
                                                                    @endif
                                                                    <td>{{round($t_result->marks)}}</td>
                                                                    <td>
                                                                        @php
                                                                            $gradesystemsMany = (new \App\CourseConfig())->gradeSystemMany($t_result->course_config_id);
                                                                        @endphp
                                                                        @foreach($gradesystemsMany as $gs)
                                                                            @if(round($t_result->marks) >= $gs->from_mark && round($t_result->marks) <= $gs->to_mark)
                                                                                <b class="{{strtolower($gs->grade) == 'f' ? 'text-danger' : ''}}">
                                                                                    @if (strtolower($gs->grade) == 'f')
                                                                                        @php $fail=true; @endphp
                                                                                        @if($t_result->optional == 1)
                                                                                            @php $optional_fail = true @endphp
                                                                                        @endif
                                                                                    @endif
                                                                                    {{$gs->grade}}
                                                                                </b>
                                                                                @break
                                                                            @endif
                                                                        @endforeach
                                                                    </td>
                                                                    @if ($optional == false && $t_result->optional == 1)
                                                                        @php $optional=true; $optional_grade=$t_result->gpa; @endphp
                                                                    @endif
                                                                    @break
                                                                @endif
                                                            @endforeach
                                                            @push('script')
                                                                <script>
                                                                    $(document).ready(function () {
                                                                        $("#course_" + {{$course->id}}).attr('colspan', {{6-$course_colspan}});
                                                                    })
                                                                </script>
                                                            @endpush
                                                        @else
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        @endif
                                                    @endforeach
                                                    <td>{{round($sub_total)}}</td>
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
                                                                    $sub_gpa = $sub_gpa - $optional_minus;
                                                            }
                                                            $gpa = $sub_gpa / $subject_count;

                                                            if ($gpa > 5) {
                                                                $gpa = 5;
                                                            }
                                                            if ($fail && $optional_fail)
                                                               echo '0.00';
                                                            else
                                                                echo number_format($gpa,2);
                                                        @endphp
                                                    </td>
                                                    <td>
                                                        @php
                                                            $first_gsystem = (new \App\Gradesystem())->where('school_id', auth()->user()->school_id)->select('grade_system_name')->distinct()->first();
                                                            $gradesystemsMany = (new \App\Gradesystem())->where('school_id', auth()->user()->school_id)->where('grade_system_name', $first_gsystem->grade_system_name)->get();
                                                            $previous_point=0;
                                                        @endphp
                                                        @foreach($gradesystemsMany as $gs)
                                                            @if($gpa >= $gs->point && $gpa <= $previous_point)
                                                                <b class="{{$fail  ? 'text-danger' : ''}}">
                                                                    @if ($fail && $optional_fail)
                                                                        F
                                                                    @else
                                                                        {{$gs->grade}}
                                                                    @endif
                                                                </b>
                                                                @break
                                                            @endif
                                                            @php $previous_point=$gs->point @endphp
                                                        @endforeach
                                                    </td>
                                                    <td class="{{$fail  ? 'text-danger' : ''}}">
                                                        @if ($fail && $optional_fail)
                                                            <b>F</b>
                                                        @else
                                                            @php $position_no = 1; @endphp
                                                            @foreach($t_marits as $merit)
                                                                @if ($merit->student_code == $result->student_code)
                                                                    {{convert_ordinary($position_no)}}
                                                                @endif
                                                                @php $position_no ++; @endphp
                                                            @endforeach
                                                        @endif
                                                    </td>
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
    </div>
    @push('script')
        <script>
            // $("#btnPrint").trigger("click");
            function printDiv() {
                var divToPrint = document.getElementById('table-content');
                var newWin = window.open('', 'Print-Window');
                newWin.document.open();
                newWin.document.write('<html><title>@lang("Tabulation List")</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>#btnPrint{display:none}.d-print-none{display:none}.table-responsive { overflow-x: unset;}.gradeTable{width:25% !important;top:55px !important;right:10px !important}.clearhight50{clear:both;height:50px}.clearhight25 {clear: both;height: 25px;}.clearhight15 {clear: both}.print_style {border: 1px dashed;position: relative;overflow: auto;padding: 0px 10px;min-height:97%}.div_break{padding: 10px 0;page-break-before: always;}.custom-tabel{background-color: #f0f0f0 !important;} .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{font-size:11px; border: 1px solid #000;padding: 2.5px;}.table-borderless > thead > tr > th, .table-borderless > tbody > tr > th, .table-borderless > tfoot > tr > th, .table-borderless > thead > tr > td, .table-borderless > tbody > tr > td, .table-borderless > tfoot > tr > td{border: none !important;} {{$print_text ?? ''}} .headname{font-size:26px}</style>' + divToPrint.innerHTML + '</body></html>');
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
