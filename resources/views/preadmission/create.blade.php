@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default">
                    {{--<div class="page-panel-title">@lang('Pre Admission Create')</div>--}}
                    @component('components.sectionbar.admission-bar')@endcomponent
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" id="registerForm"
                              action="{{ route('academic.preadmission.store') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                <label for="year" class="col-md-4 control-label">* @lang('Year')</label>
                                <div class="col-md-6">
                                    {!! Form::text('year', NULL, array('id' => 'year', 'class' => 'form-control', 'placeholder' => trans('Year'),'autocomplete'=>'off','required')) !!}
                                    @if ($errors->has('year'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('year') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('shift') ? ' has-error' : '' }}">
                                <label for="shift" class="col-md-4 control-label">* @lang('Shift')</label>
                                <div class="col-md-6">
                                    {!! Form::text('shift', NULL, array('id' => 'shift', 'class' => 'form-control', 'placeholder' => trans('shift'),'required')) !!}
                                    @if ($errors->has('shift'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('shift') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status" class="col-md-4 control-label">* @lang('Status')</label>
                                <div class="col-md-6">

                                    {!! Form::select('status',status(), old('status'), array('id' => 'status', 'class' => 'form-control', 'placeholder' => trans('Choose'),'required')) !!}
                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-2 col-md-offset-4">
                                    <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                        @lang('Create')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#year').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            });
        });
    </script>
@endsection