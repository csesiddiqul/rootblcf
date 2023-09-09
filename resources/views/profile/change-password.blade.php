@extends('layouts.app')

@section('title', __('Change Password'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @if(Auth::user()->role == 'master')
                    @include('layouts.master-left-menu')
                @elseif(Auth::user()->role == 'agent')
                    @include('layouts.agent-left-menu')
                @else
                    @include('layouts.leftside-menubar')
                @endif
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default pt-0">
                    @if(Auth::user()->role == 'agent')
                        @include('components.pages-bar',['pageTitle' =>'<a href="'. route('agent.profile',auth()->user()->student_code).'">'. trans('Profile').'</a> /  <b>'. trans('Change Password').'<b>'])
                    @else
                        @include('components.pages-bar',['pageTitle' =>'<b>'. trans('Change Password').'<b>'])
                    @endif
                    <div class="panel-body">
                        <div class="col-md-5 p-0">
                            {!! Form::open(['route' => 'user.changePassword', 'method' => 'post','autocomplete'=>'off']) !!}
                            <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                                {!! Form::label('old_password', trans('Old Password'), ['class' => 'control-label']) !!}
                                {!! Form::password('old_password', ['class' => 'form-control','required']) !!}
                                <span toggle="#old_password"
                                      class="fa fa-fw fa-eye eye-field-icon toggle-password"></span>
                                @error('old_password')
                                <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                                {!! Form::label('new_password', trans('New Password'), ['class' => 'control-label']) !!}
                                {!! Form::password('new_password', ['class' => 'form-control','required']) !!}
                                <span toggle="#new_password"
                                      class="fa fa-fw fa-eye eye-field-icon toggle-password"></span>
                                @error('new_password')
                                <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group{{ $errors->has('password_confirm') ? ' has-error' : '' }}">
                                {!! Form::label('password_confirm', trans('Confirm Password'), ['class' => 'control-label']) !!}
                                {!! Form::password('password_confirm', ['class' => 'form-control','required']) !!}
                                <span toggle="#password_confirm"
                                      class="fa fa-fw fa-eye eye-field-icon toggle-password"></span>
                                @error('password_confirm')
                                <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-5 pl-0">
                                {!! Form::submit(transMsg('Change Now'), ['class' => btnClass()]) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
