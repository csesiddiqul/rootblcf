@extends('layouts.app')

@section('title', __('Change Password'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if(Auth::user()->role !== 'master')
                <div class="col-md-2" id="side-navbar">
                    @include('layouts.leftside-menubar')
                </div>
            @else
                <div class="col-md-2">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('create-school')}}"><i
                                        class="material-icons">gamepad</i> @lang('Manage School')</a>
                        </li>
                    </ul>
                </div>
            @endif
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default pt-0">
                    @include('components.pages-bar',['pageTitle' =>'<b>'. trans('Change Password').'<b>'])
                    <div class="panel-body">
                        <div class="col-md-5">
                        {!! Form::open(['route' => ['user.changePasswordById',$user->student_code], 'method' => 'post','autocomplete'=>'off']) !!}
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
                        <div class="form-group col-md-4 pl-0">
                            @if ($user->school->parent_id == Auth::user()->school_id  && $user->role == 'admin')
                                <a href="{{route('user.edit',$user->student_code)}}" class="{{btnClass()}}">@lang('Cancel')</a>
                            @else
                            <a href="{{route('user.show',$user->student_code)}}" class="{{btnClass()}}">@lang('Cancel')</a>
                            @endif
                        </div>
                        <div class="form-group col-md-4 pr-0">
                            {!! Form::submit(transMsg('Update'), ['class' => btnClass()]) !!}
                        </div>
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
