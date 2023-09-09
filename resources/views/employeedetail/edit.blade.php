@extends('layouts.app')

@section('title', __('Salary Information'))
@push('styles') 
    <style>
        #loading-image {
            width: 50px;
            height: 50px;
            position: fixed;  
            right: 45%;
            z-index: 1; 
            display: none;
        }
    </style>
@endpush
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
                            <a class="nav-link" href="{{url('create-school')}}"><i class="material-icons">gamepad</i> @lang('Manage School')</a>
                        </li>
                    </ul>
                </div>
            @endif
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default pt-0"> 
                    <div class="panel-heading">
                        @php
                            $passcode = "/".($user->role=='student' ? 1:0)."/".($user->role=='teacher' ? 1: ($user->role=='student' ? 0:2));
                        @endphp
                        <a id="topback" href="{{ url('/users/'.Auth::user()->school->code.$passcode)}}"  class="">{{trans(ucfirst($user->role))}}</a> / 
                        <a id="topback" href="{{url('user/'.$user->student_code)}}"  class="">@lang('Profile')</a> / @lang('Salary Information') &#10153; {{ $user->name }}
                    </div>
                    <div class="panel-body"> 
                        <div align="center" id="loading-image">
                            <img src="{{asset('image/loader1.gif')}}" alt="Loading" class="img-responsive">
                        </div>
                        <div class="col-md-4 form-group{{ $errors->has('section') ? ' has-error' : '' }}">
                            <label for="section" class="control-label">
                                @if ($user->role=='teacher')
                                    {{ trans('Teachers') }} Name
                                @else
                                    {{ trans('Staff') }} Name
                                @endif
                            </label>
                            <select name="emplistget" id="emplistget" class="select2 form-control">
                                @foreach ($emplists as $emplist) 
                                    <option value="{{route('salary.information',$emplist->student_code)}}" {{ $user->id == $emplist->id ? 'selected':'' }}>{{ $emplist->name }}</option>
                                @endforeach
                            </select>  
                        </div>
                        <div style="clear:both;height:5px;"></div>
                        {!! Form::open(['route' => ['salary.information',$user->student_code], 'method' => 'post','autocomplete'=>'off']) !!}
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('payScale') ? ' has-error' : '' }}">
                                {!! Form::label('payScale', trans('Weekly Scale ( S$ )'), ['class' => 'control-label']) !!}
                                {!! Form::input('number','payScale',old('exScale', isset($user->employeeDetail) ? $user->employeeDetail->payScale : 0), ['class' => 'form-control','required','step'=>'.01','min'=>'0','placeholder'=>'0.00']) !!} 
                                @error('payScale')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('exScale') ? ' has-error' : '' }}">
                                {!! Form::label('exScale', ($user->role == 'teacher' ? 'Rate Per Extra Class ( S$ )' : 'Rate Per Extra Hour ( S$ )'), ['class' => 'control-label']) !!}
                                {!! Form::input('number','exScale',old('exScale', isset($user->employeeDetail) ? $user->employeeDetail->exScale : 0), ['class' => 'form-control','required','step'=>'.01','min'=>'0','placeholder'=>'0.00']) !!} 
                                @error('exScale')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                {!! Form::label('bank_name', trans('Bank Name'), ['class' => 'control-label']) !!}
                                {!! Form::text('bank_name',old('exScale', isset($user->employeeDetail) ? $user->employeeDetail->bank_name : ''), ['class' => 'form-control','required','placeholder'=>'***.***.***']) !!} 
                                @error('bank_name')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('account_no') ? ' has-error' : '' }}">
                                {!! Form::label('account_no', trans('Account No'), ['class' => 'control-label']) !!}
                                {!! Form::text('account_no',old('account_no', isset($user->employeeDetail) ? $user->employeeDetail->account_no : ''), ['class' => 'form-control','required','placeholder'=>'***.***.***']) !!} 
                                @error('account_no')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('remarks') ? ' has-error' : '' }}">
                                {!! Form::label('remarks', trans('Remarks'), ['class' => 'control-label']) !!}
                                {!! Form::textarea('remarks',old('remarks', isset($user->employeeDetail) ? $user->employeeDetail->remarks : ''), ['class' => 'form-control','placeholder'=>'Write here...','rows'=>1]) !!} 
                                @error('remarks')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div style="clear:both;height:5px;"></div>
                        <div class="col-md-6">
                            <div class="form-group col-md-4 pl-0">
                                <a href="{{route('user.show',$user->student_code)}}" class="{{btnClass()}}">@lang('Cancel')</a> 
                            </div>
                            <div class="form-group col-md-4 pr-0"> 
                                {!! Form::submit(transMsg('Update'), ['class' => btnClass()]) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script') 
<script>
    $(function(){ 
        $('#emplistget').on('change', function () {
            $('#loading-image').show();
            var url = $(this).val(); 
            if (url) { 
                window.location = url; 
            }
            return false;
        });
    });
</script>
@endpush