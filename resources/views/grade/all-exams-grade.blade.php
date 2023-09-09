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
                        {!! Form::open(['route' => 'academic.grade_mark', 'method' => 'post']) !!}
                        <div class="col-md-3 pl-0">
                            <div class="form-group{{ $errors->has('exam') ? ' has-error' : '' }}">
                                {!! Form::label('exam', trans('Exam'), ['class' => 'control-label']) !!}
                                {!! Form::select('exam[]',$exam, null, array('required', 'class' => 'select2 form-control','multiple')) !!}
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
                                {!! Form::select('section',$section,$_GET['section'] ?? null, array('required', 'class' => 'select2 form-control', 'placeholder' => trans('Choose'),'onchange'=>'getStudentsBySection(this.value,1)')) !!}
                                @error('section')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        @if (isset($student_user))
                            @push('script')
                                <script>
                                    $(document).ready(function () {
                                        getStudentsBySection({{$student_user->section_id}}, 1);
                                        setTimeout(function () {
                                            $("#student").val("{{$student_user->id}}").trigger('change');
                                        }, 1000);
                                    })
                                </script>
                            @endpush
                        @endif
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('student') ? ' has-error' : '' }}">
                                <label for="student">@lang('Student')</label>
                                {!! Form::select('student',array(), null, array('id' => 'student', 'class' => 'form-control select2','required','placeholder' =>trans('All'))) !!}
                                @if ($errors->has('student'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('student') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3" id="range_student">
                            <div class="form-group{{ $errors->has('range_from') ? ' has-error' : '' }}"
                                 style="width: 35%;float: left">
                                <label for="range_from">@lang('From')</label>
                                {!! Form::number('range_from', null, array('id' => 'range_from', 'class' => 'form-control','min'=>0,'required')) !!}
                            </div>
                            <div class="form-group{{ $errors->has('range_to') ? ' has-error' : '' }}"
                                 style="width: 35%;float: left;margin-left: 10%;">
                                <label for="range_to">@lang('To')</label>
                                {!! Form::number('range_to', null, array('id' => 'range_to', 'class' => 'form-control','min'=>0,'required')) !!}
                            </div>
                            <div class="clearfix"></div>
                            @if ($errors->has('range_to'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('range_to') }}</strong>
                                </span>
                            @endif
                            @if ($errors->has('range_from'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('range_from') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="clearfix"></div>
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
    <script>
        $('#student').change(function () {
            var conceptName = $(this).find(":selected").val();
            if (conceptName == 'all') {
                $("#range_student").removeClass('d-none');
                $("#range_from").attr('required', true);
                $("#range_to").attr('required', true);
            } else {
                $("#range_student").addClass('d-none');
                $("#range_from").attr('required', false);
                $("#range_to").attr('required', false);
            }
        })
    </script>
@endsection
