@extends('layouts.app')
@section('title', __('Add Event'))
@section('content')
    @include('components.cropper.multifile_js')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <a href="'. route('academic.event.index').'">'.trans('Event') .'</a> / <b>'. trans('Add').'<b>'])
                @include('components.sectionbar.frontmanagement-bar')
                <div class="panel panel-default">
                    <div class="panel-body pl-0 pr-0">
                            {!! Form::open(array('route' => 'academic.event.store', 'method' => 'POST', 'role' =>'form','enctype'=>'multipart/form-data', 'class' => 'needs-validation','autocomplete'=>'off')) !!}
                            @include('events.element')
                            <div class="col-md-2">
                                <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                    @lang('Submit')
                                </button>
                            </div>
                            <div class="col-md-2 text-center">
                                <a href="{{route('academic.event.index')}}" class="{{btnClass()}}">@lang('Cancel')</a>
                            </div>
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(function () {
                $('#event_date').datepicker({
                    format: "dd-mm-yyyy",
                    viewMode: "days",
                    minViewMode: "days",
                    autoclose: true
                });
                var nowTime = new Date();
                $('#event_time').datetimepicker({
                    defaultDate: nowTime,
                    ignoreReadonly: true,
                    format: 'LT'
                });


                $('#event_timend').datetimepicker({
                    defaultDate: nowTime,
                    ignoreReadonly: true,
                    format: 'LT'
                });
            });
        </script>
        <script src="{{ asset('additional/moment.min.js')}}"></script>
        <script src="{{ asset('additional/bootstrap-datetimepicker.css')}}"></script>
        <script src="{{ asset('additional/bootstrap-datetimepicker.min.js')}}"></script>
        <style>
            #EventSection {
                display: block;
            }
        </style>
    @component('components.cropper.element',['width'=>'300','height'=>'300','type'=>'square']) @endcomponent
@endsection 



