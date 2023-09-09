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
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <a href="'. route('academic.event.index').'">'.trans('Event') .'</a> / <b>'. trans('Edit').'<b>'])
                @include('components.sectionbar.frontmanagement-bar')
                <div class="panel panel-default">
                    <div class="panel-body ">
                            {!! Form::model($event, ['class'=>'row','method' => 'POST','route' => ['academic.event.update', $event->id],'enctype'=>'multipart/form-data','autocomplete'=>'off']) !!}
                            @include('events.element')
                            <div class="col-md-2">
                                <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                    @lang('Update')
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
    </div>

    <script>
        $(function () {
            $('#event_date').datepicker({
                format: "dd-mm-yyyy",
                viewMode: "days",
                minViewMode: "days"
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
        #NoticeSection {
            display: block;
        }
    </style>
    @component('components.cropper.element',['width'=>'300','height'=>'300','type'=>'square']) @endcomponent
@endsection 