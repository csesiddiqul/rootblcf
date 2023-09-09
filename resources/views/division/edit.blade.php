@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default">
                    <div class="panel panel-default"> 
                        @component('components.sectionbar.division')@endcomponent
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" id="registerForm" action="{{ route('academic.division.update',$division->id) }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">* @lang('Division Name')</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $division->name }}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('namebn') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">* @lang('Division Name')</label>
                                <div class="col-md-6">
                                    <input id="namebn" type="text" class="form-control" name="namebn" value="{{ $division->namebn }}">
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
                                    {!! Form::select('status', ['1'=>'Active','2'=>'De-Active'] , $division->status , ['class' => 'form-control','id' => 'status','required']) !!}
                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            
                            @method('PUT')
                            <div class="form-group">
                                <div class="col-md-2 col-md-offset-4">
                                    {!! Form::button(trans('Update'), array('class' => btnClass(),'type' => 'submit' )) !!}
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection