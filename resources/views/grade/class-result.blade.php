@extends('layouts.app')

@section('title', __('Grade'))

@section('content')
    @php
        $className = school('country')->code == 'BD' ? 'Class' : 'Grade';
        $cName = subjectOrCourseNameWithOutS();
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @if(Auth::user()->role != 'student')
                    <ol class="breadcrumb" style="margin-top: 3%;">
                        <li><a href="{{url('grades/all-exams-grade')}}" style="color:#3b80ef;">@lang('Grades')</a></li>
                        <li class="active">@lang('Section Grade')</li>
                    </ol>
                @endif
                <div class="panel panel-default">
                    @if(count($grades) > 0)
                        <div class="panel-body">
                            @foreach($grades as $grade)
                                <h4><b>@lang($className):</b> {{$grade->student->section->class->name}} &nbsp;
                                    <b>@lang('Section'):</b> {{$grade->student->section->section_number}} <span
                                            class="pull-right">@lang('Marks and Grades')</span></h4>
                                @break
                            @endforeach
                            <table class="table table-data-div table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th scope="row">@lang('Exam Name')</th>
                                    <th scope="row">@lang($cName.' Name')</th>
                                    <th scope="row">@lang('Student Code')</th>
                                    <th scope="row">@lang('Student Name')</th>
                                    <th scope="row">@lang('Total Mark')</th>
                                    <th scope="row">@lang('GPA')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($grades as $grade)
                                    <tr>
                                        <td>{{$grade->exam->exam_name}}</td>
                                        <td>{{$grade->course_config->course->name}}</td>
                                        <td>{{$grade->student->student_code}}</td>
                                        <td>
                                            <a target="_blank" href="{{url('user/'.$grade->student->student_code)}}">{{$grade->student->name}}</a>
                                        </td>
                                        <td>{{$grade->marks}}</td>
                                        <td>{{$grade->gpa}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
