@extends('layouts.app')
@section('title', __('Admission Instruction'))
@push('styles')
    <style>
        fieldset.scheduler-border {
            border: 1px groove #f9f9f985 !important;
        }

        .button-wrapper {
            text-align: center;
        }

        .button-wrapper span.label {
            display: inline-block;
            width: 100%;
            background: #0077f7;
            cursor: pointer;
            color: #fff;
            padding: 12px 0;
            font-size: 1.2rem;
            border-radius: .2rem;
        }

        .upload-box {
            display: inline-block;
            position: absolute;
            z-index: 1;
            width: 100%;
            height: 50px;
            top: 20px;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .button-wrapper span.label:hover {
            color: #fff;
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.admission.pending').'">'. transMsg('Admission').'</a> / <b>'.transMsg('Admission Instruction').'<b>'])
                @include('components.sectionbar.admission-bar')
                <div class="clearfix"></div>
                <div class="panel panel-default">
                    <div class="panel-body pad-top-0">
                        <form method="POST" action="{{ route('academic.admission.instruction') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <label for="instruction_title"> @lang('Instruction Title')</label>
                                    {!! Form::text('instruction_title', foqas_setting('instruction_title'), array('id' => 'instruction_title', 'class' => 'form-control','autocomplete' => 'off')) !!}
                                    @error('instruction_title')
                                    <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label upperlabel"
                                           for="form_link"> @lang('Manual Admission Form Upload')
                                    @if(!empty(foqas_setting('form_link')))
                                            <a href="{{foqas_setting('form_link')}}" class="btn btn-xs btn-success pull-right" target="_blank">View</a>
                                        @endif
                                    </label>
                                    <div class="button-wrapper">
                                                  <span class="label">
                                                   @lang('Choose File')
                                                  </span>
                                        <input type="file" name="form_link" id="form_link"
                                               class="form-control upload-box"
                                               accept="*" placeholder="@lang('Upload File')">
                                    </div>
                                    @error('form_link')
                                    <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group {{ $errors->has('instruction_description') ? ' has-error' : '' }}">
                                    <label for="name">@lang('Instruction Description')</label>
                                    {!! Form::textarea('instruction_description', foqas_setting('instruction_description'), array('id' => 'instruction_description', 'required', 'class' => 'form-control ckeditor ', 'placeholder' => trans('Description'))) !!}
                                    @if ($errors->has('instruction_description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('instruction_description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-2">
                                    <button type="submit" class="{{btnClass()}}">
                                        @lang('Submit')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
