@extends('layouts.app')

@section('title', (school('country')->code == 'BD' ? 'Subject' : 'Course'. ' Group Create'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @php
                    $courseTN = school('country')->code == 'BD' ? 'Subject' : 'Course';
                @endphp
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.class').'">'. trans('Academics').'</a> / <a href="'. route('academic.coursegroup.index').'">'. transMsg($courseTN.' Group').'</a> / <b>'. trans('Add').'<b>'])
                @include('components.sectionbar.course-bar')
                <div class="panel panel-default">
                    <div class="panel-title">
                    </div>
                    <div class="panel-body ">
                        {!! Form::open(['route' => 'academic.coursegroup.store', 'method' => 'post']) !!}
                        @include('coursegroup.element')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection