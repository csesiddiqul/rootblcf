@extends('layouts.app')

@section('title', __('SMS'))

@section('content')
    <link href="{{asset('additional/tagsinput/bootstrapTags.css')}}" rel="stylesheet">
    <script src="{{asset('additional/tagsinput/bootstrapTypeTag.js')}}"></script>
    <script src="{{asset('additional/tagsinput/bootstrapTag.js')}}"></script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.contact.index').'">'. trans('Communicate').'</a>  / <b>'. trans('Send E-mail').'<b>'])
                @include('components.sectionbar.communicate-bar')
                <div class="col-md-12 pl-0  pr-0">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {!! Form::open(['route' => 'academic.send_email', 'method' => 'post']) !!}
                            <div class="col-md-3 pl-0">
                                <div class="form-group{{ $errors->has('teacher') ? ' has-error' : '' }}">
                                    {!! Form::label('teacher', trans('Teacher'), ['class' => 'control-label']) !!}
                                    {!! Form::select('teacher[]',$teacher ?? array(), null, array('class' => 'select2 form-control','multiple')) !!}
                                    @error('teacher')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 pl-0">
                                <div class="form-group{{ $errors->has('section') ? ' has-error' : '' }} ">
                                    {!! Form::label('section', trans('Section'), ['class' => 'control-label']) !!}
                                    {!! Form::select('section',$section, $request_section ?? null, array('class' => 'select2 form-control','onchange'=>'getStudentsBySection(this.value,1,0)', 'placeholder' => trans('Choose'))) !!}
                                    @error('section')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="form-group{{ $errors->has('student') ? ' has-error' : '' }}">
                                    {!! Form::label('student', trans('Student'), ['class' => 'control-label']) !!}
                                    {!! Form::select('student[]',array(), null, array('id'=>'student','class' => 'select2 form-control','multiple')) !!}
                                    @error('student')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                {!! Form::label('other_email', trans('Other Email Separate with (Comma/tab/Enter)'), ['class' => 'control-label']) !!}
                                {!! Form::text('other_email', null, array('class' => 'form-control','data-role' => 'tagsinput', 'placeholder' => transMsg('something@gmail.com'))) !!}
                                @error('other_email')
                                <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                {!! Form::label('subject', trans('Subject'), ['class' => 'control-label']) !!}
                                {!! Form::text('subject', null, array('class' => 'form-control','required', 'placeholder' => transMsg('Subject'))) !!}
                                @error('subject')
                                <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('message', trans('Message'), ['class' => 'control-label']) !!}
                                {!! Form::textarea('message', NULL, array('id' => 'message', 'required', 'class' => 'form-control ckeditor ', 'placeholder' => trans('Message'))) !!}
                                @error('message')
                                <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2 mt-25">
                                <button type="submit" class="{{btnClass()}}"
                                        style="height: 38px">@lang('Send')</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .cke_toolbar_break {
            clear: none !important;
        }
    </style>
@endsection
@push('script')
@endpush