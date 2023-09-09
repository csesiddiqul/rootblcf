@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/1/0').'">'. trans('Students').'</a> / <a href="'. route('academic.board_exam.index').'">'.trans('Board Exam') .'</a> / <b>'. trans('Edit').'<b>'])
                @component('components.sectionbar.student_board_exam')@endcomponent
                <div class="panel panel-default">
                    <div class="panel-body pl-0">
                        {!! Form::model($studentBoardExam, ['method' => 'PATCH','route' => ['academic.board_exam.update', $studentBoardExam->id]]) !!}
                        @include('students.board_exam.element')
                        <div class="clearhight"></div>
                        <div class="col-md-2">
                            <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                @lang('Update')
                            </button>
                        </div>
                        <div class="col-md-2 text-center ">
                            <a href="{{route('academic.board_exam.index')}}" class="{{btnClass()}}">@lang('Cancel')</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

