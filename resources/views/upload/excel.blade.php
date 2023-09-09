@extends('layouts.app')

@section('title', __('Upload'))
@section('content')
    <div class="container{{ (\Auth::user()->role == 'master')? '' : '-fluid' }}">
        <div class="row">
            @if(\Auth::user()->role != 'master')
                <div class="col-md-2" id="side-navbar">
                    @include('layouts.leftside-menubar')
                </div>
            @endif
            <div class="col-md-10" id="main-container">
                @if($type == 'student')
                    @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/1/0').'">'. trans('Students').'</a> / <b>'.trans('Upload Excel').'<b>'])
                    @include('components.sectionbar.student-bar')
                @elseif($type == 'teacher')
                    @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/0/1').'">'. trans('Human Resource').'</a> / <b>'.trans('Upload Excel').'<b>'])
                    @include('components.sectionbar.teacher-bar')
                @endif
                <div class="panel panel-default">
                    @if($type == 'student' || $type == 'teacher')
                        <div class="panel-body">
                            <h4>@lang('Mass upload Excel') {{ucfirst($type)}}</h4>
                            @component('components.excel-upload-form', ['type'=>$type])
                            @endcomponent
                        </div>
                    @endif
                    @if($type == 'staff')
                        @include('components.sectionbar.teacher-bar')
                    @endif
                    @if($type == 'accountant')
                        @include('components.sectionbar.teacher-bar')
                    @endif
                    @if($type == 'librarian')
                        @include('components.sectionbar.teacher-bar')
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
