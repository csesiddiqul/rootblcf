@extends('layouts.app')

@section('title', __(school('country')->code == 'BD' ? 'Subject' : 'Course'. ' Create'))

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
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.class').'">'. trans('Academics').'</a> / <a href="'. route('academic.course.index').'">'. transMsg($courseTN).'</a> / <b>'. trans('Add').'<b>'])
                @include('components.sectionbar.course-bar')
                <div class="panel panel-default">
                    <div class="panel-body pl-0">
                        <div class="col-md-5">
                            {!! Form::open(['route' => 'academic.course.store', 'method' => 'post']) !!}
                            @include('course.element')
                            <div class="col-md-5 pl-0">
                                <button type="submit" class="{{btnClass()}}">@lang('Submit')</button>
                            </div>
                            <div class="col-md-5 text-center pl-0">
                                <a href="{{route('academic.course.index')}}" class="{{btnClass()}}">@lang('Cancel')</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection