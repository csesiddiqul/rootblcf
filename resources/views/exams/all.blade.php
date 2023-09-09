@extends('layouts.app')
@section('title', __('All Examinations'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('exams').'">'. trans('Exams').'</a>  / <b>'. trans('Manage Examinations').'<b>'])
                @include('components.sectionbar.examination-bar')
                <div class="panel panel-default pt-0">
                    <div class="panel-heading">@lang('Information')</div>
                    <div class="panel-body">
                        <div class="mb-3">
                                @lang('An Examination represents a Semester. All Courses of a Semester belong to an Examination. So, all Quiz, Class Test, Assignment, Attendance, Written, Practical, etc. in a Course are subjected to that specific Examination.')
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        @component('components.exams-list',['exams'=>$exams])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
