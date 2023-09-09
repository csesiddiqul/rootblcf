@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default">
                    {{--<div class="page-panel-title">@lang('Division Create')</div>--}}
                    @component('components.sectionbar.division')@endcomponent
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" id="registerForm"
                              action="{{ route('academic.division.store') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">* @lang('Division Name')</label>
                                <div class="col-md-6">
                                    {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('Division Name'),'required')) !!}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('namebn') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">* @lang('Division Name Bangla')</label>
                                <div class="col-md-6">
                                    {!! Form::text('namebn', NULL, array('id' => 'namebn', 'class' => 'form-control', 'placeholder' => trans('Division Name Bangla'),'required')) !!}
                                    @if ($errors->has('namebn'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('namebn') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">* @lang('Status')</label>
                                <div class="col-md-6">
                                    {!! Form::select('status', ['1'=>'Active','2'=>'De-Active'] , null , ['class' => 'form-control','id' => 'status','required']) !!}
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