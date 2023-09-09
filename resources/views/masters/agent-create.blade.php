@extends('layouts.app') 
@section('title', __('Master Dashboard')) 
@section('content')  
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.master-left-menu') 
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default col-sm-12">  
                <div class="panel-body p-0">
                    @include('masters.agent-menu')  
                    {!! Form::open(array('route' =>'agents.create','method' =>'POST','role' =>'form','autocomplete'=>'off','class'=>'row')) !!}  
                        <div class="col-md-4 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">* @lang('Full Name')</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                   required>
                            @if ($errors->has('name'))
                                <span class="help-block m-0">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-4 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">* @lang('E-mail')</label>
                            <input id="email" type="email" class="form-control" name="email"
                                   value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4 form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number" class="control-label">* @lang('Phone')</label>
                            <input id="phone_number" type="text" class="form-control" name="phone_number"
                                   value="{{ old('phone_number') }}">
                            @if ($errors->has('phone_number'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-4  form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            @if ($errors->has('password'))
                                @php $pmsg = $errors->first('password'); @endphp
                            @else
                                @php $pmsg = ''; @endphp
                            @endif
                            <label for="password" class="control-label" id="greterorless">* @lang('Password')</label>
                            <input id="password" type="password" class="form-control" name="password" required placeholder="{{$pmsg}}"> 
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="password-confirm" class="control-label" id="indicator">* @lang('Confirm Password')</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div> 
                        <div class="col-md-4 form-group{{ $errors->has('nationality') ? ' has-error' : '' }}">
                            <label for="nationality" class="control-label">* @lang('Nationality')</label>
                            {!! Form::select('nationality',$country,ip_info()['country_code'], array('id' => 'nationality', 'class' => 'form-control select2', 'placeholder' => trans('Select Country'),'required')) !!} 
                            @if ($errors->has('nationality'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('nationality') }}</strong>
                                </span>
                            @endif
                        </div>  
                        <div class="clearfix"></div>
                        <div class="col-md-4 form-group{{ $errors->has('shareOf') ? ' has-error' : '' }}">
                            <label for="percentage" class="control-label">* @lang('Share of percentage(%)')</label>
                            <input id="percentage" type="number" step="any" class="form-control" name="shareOf" value="{{ old('shareOf') }}" required min="1" max="50">
                            @if ($errors->has('percentage'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('shareOf') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-8 form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="control-label">*@lang('Address')</label>
                            <textarea id="address" class="form-control f-address" name="address" value="{{ old('address') }}" required rows="1"></textarea> 
                            @if ($errors->has('address'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>  
                        <div class="clearhight"></div>
                        <div class="col-md-2 form-group">
                            <button type="submit" id="registerBtn" class="btn btn-primary btn-sm btn-block">@lang('Submit Now')</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div> 
        </div>
    </div>
</div> 
<script> 
    /*For password*/
    $("#password").keyup(function () { 
        if ($(this).val().length < 6) { 
            $('#greterorless').html('*Password (Must be 6 characyers)').css('color', 'red');
            $('#registerBtn').attr({disabled: true});
        } else {
            var pass = $('#password').val();
            var cpass = $('#password-confirm').val();

            if (pass != cpass) { 
                $('#greterorless').html('Password').css('color', '#5f6368');
                $('#registerBtn').attr({disabled: true});
            }else{
                $('#greterorless').html('Password').css('color', '#5f6368');
                $('#registerBtn').attr({disabled: false});
            } 
        }
    });

    $('#password-confirm').keyup(function () {
        var pass = $('#password').val();
        var cpass = $('#password-confirm').val();
        if (pass != cpass) {
            $('#indicator').html('*Confirm password (Not matching)').css('color', 'red');
            $('#registerBtn').attr({disabled: true});
        } else {
            $('#indicator').html('Password Confirmed').css('color', '#5f6368');
            $('#registerBtn').attr({disabled: false});
        }
    });
</script>
@endsection
