@extends('layouts.app')

@section('title', __('Grade'))

@section('content')
    <style>
        .head h2 {
            margin-left: 30px !important;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10 head" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('exams').'">'. trans('Exams').'</a>  / <b>'. trans('Grades').'<b>'])
                @include('components.sectionbar.examination-bar')
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::open(['route' => 'exams.post_report', 'method' => 'post']) !!}
                        <div class="col-md-3 pl-0">
                            <div class="form-group{{ $errors->has('report_type') ? ' has-error' : '' }}">
                                {!! Form::label('report_type', trans('Report Type'), ['class' => 'control-label']) !!}
                                {!! Form::select('report_type',examReportType(), null, array('required', 'class' => 'select2 form-control','placeholder'=>trans('Choose'))) !!}
                                @error('report_type')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 pl-0">
                            <div class="form-group{{ $errors->has('exam') ? ' has-error' : '' }}">
                                {!! Form::label('exam', trans('Exam'), ['class' => 'control-label']) !!}
                                {!! Form::select('exam',$exam, null, array('required', 'class' => 'select2 form-control','placeholder'=>trans('Choose'))) !!}
                                @error('exam')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('section') ? ' has-error' : '' }} ">
                                {!! Form::label('section', trans('Section'), ['class' => 'control-label']) !!}
                                {!! Form::select('section',$section, null, array('required', 'class' => 'select2 form-control', 'placeholder' => trans('Choose'))) !!}
                                @error('section')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" id="registerBtn" class="{{btnClass()}}"
                                    @if (!useragentMobile()) style="margin-top:27px"@endif>
                                @lang('Get')
                            </button>
                        </div>
                        {!! Form::close() !!}
                        @if (empty($session))
                            <div class="clearfix"></div>
                            <code><i><b>*@lang('Note')
                                        :</b> @lang('There has no session active now.') <a
                                            href="{{route('academic.session.index')}}"
                                            target="_blank">@lang('Please active an session first.')</a></i></code>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
