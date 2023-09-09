@extends('layouts.app')

@section('title', __('Grade'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <style>
                    #main-container {
                        height: 100% !important;
                    }
                    .nav-item .nav-link {
                        padding: 12px 6px !important;
                    }
                </style>
                <form action="{{route('course.configuration')}}" method="POST">
                    {{csrf_field()}}
                    <div class="panel panel-default" id="main-container">
                        @if(count($grades) > 0)
                            @foreach ($grades as $grade)
                                <input type="hidden" name="id" value="{{$grade->course_config_id}}">
                                <div class="page-panel-title w-100" style="font-size: 15px;"><b>@lang('Course')</b>
                                    - {{$grade->course_config->course->name}} &nbsp; <b>@lang('Class')</b>
                                    - {{$grade->student->section->class->name}} &nbsp;<b>@lang('Section')</b>
                                    - {{$grade->student->section->section_number}} &nbsp;<b>@lang('Exam')</b>
                                    - {{$grade->exam->exam_name}}
                                    <button type="submit" class="btn btn-success btn-xs pull-right">
                                        <span class="glyphicon glyphicon-floppy-disk"
                                              aria-hidden="true"></span> @lang('Save')
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                                @break($loop->first)
                            @endforeach
                            <div class="panel-body" style="padding-top: 0px;">
                                <div class="alert alert-info alert-dismissible" style="font-size:13px;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <ul>
                                        <li>
                                            @lang('Select which Grade System you want to use.')
                                        </li>
                                        <li>
                                            <b>@lang('Count Example')
                                                :</b> @lang('If you take 3 Quizes and want to count best 2, then Quiz Count is 2.')
                                        </li>
                                        <li>
                                            <b>@lang('Percentage Example')
                                                :</b> @lang('Total percentage must be 100%. You can put 100% to a field or distribute it according to your need. Full mark is also needed for Percentage to work')
                                            .
                                        </li>
                                        <li>
                                            <b>@lang('Full Mark Example')
                                                :</b> @lang('If you take a Class Test where full mark is 15, then Full mark for Class Test is 15')
                                            .
                                        </li>
                                    </ul>
                                </div>
                                <table class="table table-condensed table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col" style="width:10%;">@lang('Select Grade System')</th>
                                        <th scope="col" style="width:10%;">@lang('Quiz Count')</th>
                                        <th scope="col" style="width:10%;">@lang('Assignment Count')</th>
                                        <th scope="col" style="width:10%;">@lang('Class Test Count')</th>
                                        <th scope="col" style="width:10%;">@lang('Attendance %')</th>
                                        <th scope="col" style="width:10%;">@lang('Assignment ')%</th>
                                        <th scope="col" style="width:10%;">@lang('Quiz %')</th>
                                        <th scope="col" style="width:10%;">@lang('Class Test %')</th>
                                    </tr>
                                    </thead>
                                    <?php
                                    $section_id = 0;
                                    ?>
                                    @foreach ($grades as $grade)
                                        <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-control input-sm" name="grade_system_name">
                                                    @php($gsName='')
                                                    @foreach($gradesystems as $gs)
                                                        @if ($gsName != $gs->grade_system_name)
                                                            @php($gsName=$gs->grade_system_name)
                                                            <option {{($grade->grade_system_name  == $gs->grade_system_name)?'selected=selected':''}}>{{$gs->grade_system_name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control input-sm" id="quiz-count"
                                                       name="quiz_count" placeholder="@lang('Quiz Count')" max="5"
                                                       value="{{$grade->quiz_count}}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control input-sm" id="assignment-count"
                                                       name="assignment_count" placeholder="@lang('Assignment Count')"
                                                       max="3" value="{{$grade->assignment_count}}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control input-sm" id="ct-count"
                                                       name="ct_count" placeholder="@lang('CT Count')" max="5"
                                                       value="{{$grade->ct_count}}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control input-sm" id="attendance"
                                                       name="attendance_percent" placeholder="@lang('Percentage')"
                                                       max="50" value="{{$grade->attendance_percent}}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control input-sm" id="assignment"
                                                       name="assignment_percent"
                                                       placeholder="@lang('Percentage')" max="50"
                                                       value="{{$grade->assignment_percent}}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control input-sm" id="quiz"
                                                       name="quiz_percent" placeholder="@lang('Percentage')" max="50"
                                                       value="{{$grade->quiz_percent}}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control input-sm" id="class-test"
                                                       name="ct_percent" placeholder="@lang('Percentage')" max="50"
                                                       value="{{$grade->ct_percent}}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="col" style="width:10%;">@lang('Final Exam %')</th>
                                            <th scope="col" style="width:10%;">@lang('Practical %')</th>
                                            <th scope="col" style="width:10%;">
                                                @lang('Quiz Full Marks')
                                            </th>
                                            <th scope="col" style="width:10%;">
                                                @lang('Assignment Full Marks')
                                            </th>
                                            <th scope="col" style="width:10%;">
                                                @lang('CT Full Marks')
                                            </th>
                                            <th scope="col" style="width:10%;">
                                                @lang('Final Exam Full Marks')
                                            </th>
                                            <th scope="col" style="width:10%;">
                                                @lang('Practical Full Marks')
                                            </th>
                                            <th scope="col" style="width:10%;">
                                                @lang('Attendance Full Marks')
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="number" class="form-control input-sm" id="final"
                                                       name="final_exam_percent" placeholder="@lang('Percentage')"
                                                       max="100" value="{{$grade->final_exam_percent}}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control input-sm"
                                                       id="practical_percent" name="practical_percent"
                                                       placeholder="@lang('Percentage')" max="100"
                                                       value="{{$grade->practical_percent}}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control input-sm" id="q_full"
                                                       name="quiz_fullmark" placeholder="@lang('Quiz Full Marks')"
                                                       max="20" value="{{$grade->quiz_fullmark}}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control input-sm" id="a_full"
                                                       name="a_fullmark" placeholder="@lang('Assignment Full Marks')"
                                                       max="50" value="{{$grade->a_fullmark}}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control input-sm" id="ct_full"
                                                       name="ct_fullmark" placeholder="@lang('CT Full Marks')" max="20"
                                                       value="{{$grade->ct_fullmark}}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control input-sm" id="final_full"
                                                       name="final_fullmark" placeholder="@lang('Final Full Marks')"
                                                       max="100" value="{{$grade->final_fullmark}}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control input-sm" id="practical_full"
                                                       name="practical_fullmark"
                                                       placeholder="@lang('Practical Full Marks')" max="100"
                                                       value="{{$grade->practical_fullmark}}">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control input-sm" id="att_full"
                                                       name="att_fullmark" placeholder="@lang('Attendance Full Marks')"
                                                       max="100" value="{{$grade->att_fullmark}}">
                                            </td>
                                        </tr>
                                        </tbody>
                                        <?php
                                        $section_id = $grade->section_id;
                                        ?>
                                        @break($loop->first)
                                    @endforeach
                                </table>
                                {!! $grades->links() !!}
                            </div>
                        @else
                            <div class="panel-body">
                                @lang('No Related Data Found.')
                            </div>
                        @endif
                    </div>
                </form>
                <div class="panel panel-default">
                    @if(count($grades) > 0)
                        <div class="page-panel-title w-100" style="font-size: 15px;">
                            <form action="{{route('marks.calculate')}}" method="POST">
                                {{csrf_field()}}
                                @lang('Give Marks to Students')
                                <input type="hidden" name="course_id" value="{{$course_id}}">
                                <input type="hidden" name="course_config_id" value="{{$grade->course_config_id}}">
                                <input type="hidden" name="section_id" value="{{$section_id}}">
                                @foreach($gradesystems as $gs)
                                    @foreach ($grades as $grade)
                                        @if($grade->grade_system_name  == $gs->grade_system_name)
                                            <input type="hidden" name="grade_system_name"
                                                   value="{{$gs->grade_system_name}}">
                                            @break
                                        @endif
                                    @endforeach
                                @endforeach
                                <input type="hidden" name="exam_id" value="{{$exam_id}}">
                                <input type="hidden" name="teacher_id" value="{{$teacher_id}}">
                                <button type="submit" class="btn btn-info btn-xs pull-right">
                                    <span class="glyphicon glyphicon-blackboard"
                                          aria-hidden="true"></span> @lang('Get Total Marks')
                                </button>
                            </form>
                        </div>
                        <div class="panel-body">
                            @include('layouts.teacher.grade-form')
                        </div>
                    @else
                        <div class="panel-body">
                            @lang('No Related Data Found.')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
