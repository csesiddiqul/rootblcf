@extends('layouts.app')

@section('title', __('Course'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            @if(Auth::user()->role != 'student')
            <ol class="breadcrumb">
                <li><a href="{{route('academic.class')}}" style="color:#3b80ef;">@lang('Academics')</a></li>
                <li><a href="{{url('school/sections?course=1')}}" style="color:#3b80ef;">{{transMsg(school('country')->code == 'BD' ? 'All Classes' : 'All Grade')}} &amp; @lang('Sections')</a></li>
                <li class="active">{{transMsg(school('country')->code == 'BD' ? 'Subjects' : 'Courses')}}</li>
            </ol>
            @endif
            <div class="panel panel-default">
              @if(count($courses) > 0)
                @foreach ($courses as $course)
                    <div class="page-panel-title"><b>{{transMsg(school('country')->code == 'BD' ? 'Class' : 'Grade')}}</b> -  {{$course->section->class->name}} <b>@lang('Section')</b> -   {{$course->section->section_number}} &nbsp;</div>
                    @break($loop->first)
                @endforeach
                <div class="panel-body">
                    <div class="clearfix"></div>
                    @component('components.course-table',['courses'=>$courses, 'exams'=>$exams, 'student'=>(Auth::user()->role == 'student')?true:false])
                    @endcomponent
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
