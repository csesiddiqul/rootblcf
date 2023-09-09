@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default">
                    {{--<div class="page-panel-title">@lang('District Create')</div>--}}
                   @include('components.sectionbar.state-bar')
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" id="registerForm"
                              action="{{ route('academic.state.store') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">* @lang('Country Name')</label>
                                <div class="col-md-6">
                                    {!! Form::select('country_id',$country, old('country_id'), array('id' => 'country_id', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                                    @if ($errors->has('country_id'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('country_id') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">* @lang('State Name')</label>
                                <div class="col-md-6">
                                    {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('State Name'))) !!}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                           
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">* @lang('Status')</label>
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
@endsection