@extends('layouts.app')
@section('content') 
    <link rel="stylesheet" href="{{asset('css/custome.css')}}"> 
    <div id="registry" class="signup">
        <div class="signup-connect"> 
            <h1 class="name-title">{{session('step1')['name']}}</h1> 
            <div class="brdiv"></div>
            <div class="text-left">
                <p><b>@lang('E-mail:')</b> {{session('step1')['email']}}</p>
                <p><b>@lang('Country:')</b> {{getCountryByCode(session('step1')['nationality'])['name']}}</p>
                <p><b>@lang('Phone:')</b> {{session('step1')['phone_number']}}</p>
            </div>
            <div class="clearfixh"></div>  
            @if(session()->has('step2'))
            <div class="col-sm-5 p-0"> 
                <a id="topback" href="{{route('now.register')}}" class="btn btn-back"> 
                    @lang('Step 1')
                </a>
            </div>
            <div class="col-sm-2 p-0">
            </div>
            <div class="col-sm-5 p-0">
                @if (session('step1')['nationality']=='BD')
                    <a id="topback" href="{{route('payment.info')}}" class="btn btn-back btn-next">
                        @lang('Step 3')
                    </a>
                @else
                    <a id="topback" href="{{route('pay.now')}}" class="btn btn-back btn-next"> 
                        @lang('Step 3')
                    </a> 
                @endif 
            </div>
            @else
            <a id="topback" href="{{route('now.register')}}" class="btn btn-social btn-back">
                <i class="fas fa-reply fa"></i>
                @lang('Step 1')
            </a>
            @endif
        </div>
        <div class="signup-classic" id="regForm">
            <h2>@lang('Register your account in') {{school('short_name') ?? school('name')}}</h2> 
            <ul class="progressbar">
                <li class="active"></li>
                <li class="pre-active"></li>
                <li class=""></li>
                <li class=""></li>
            </ul>
            <div class="brdiv"></div>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <small>@lang('We have sent verification code on your email!')</small>
            </div>
            <div class="clearfix"></div> 
            {!! Form::open(array('route' =>'school.info','method' =>'POST','role' =>'form','autocomplete'=>'off','class'=>'form')) !!} 
            <fieldset>
                {!! Form::text('vcode', NULL, array('id' => 'vcode', 'class' => 'input-text', 'placeholder' => trans('Verification Code'),'required')) !!}
                <label class="label-helper" for="vcode" id="indicator">@lang('Verification Code')</label>
                @error('vcode')
                <span class="help-block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </fieldset>
            <fieldset>
                {!! Form::text('eiin', NULL, array('id' => 'eiin', 'class' => 'input-text', 'placeholder' => trans('EIIN'),'required')) !!}
                @error('established')
                <span class="help-block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label class="label-helper" for="eiin">@lang('EIIN')</label>
            </fieldset>
            <fieldset>
                {!! Form::text('established', NULL, array('id' => 'established', 'class' => 'input-text', 'placeholder' => trans('Established'),'required')) !!}
                @error('established')
                <span class="help-block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label class="label-helper" for="established">@lang('Established')</label>
            </fieldset> 
            <fieldset> 
            	@if($datafield=='city')
                    {!! Form::text($datafield, NULL, array('id' => 'city', 'class' => 'input-text', 'placeholder' => trans('City Name'),'required')) !!}
                    <label class="label-helper" for="city">@lang('City Name')</label>
                    @error('city')
                    <span class="help-block">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                @elseif($datafield=='district_id')
                    {!! Form::select($datafield,$disState,NULL, array('id' => 'disState', 'class' => 'input-text', 'placeholder' => trans('Select District'),'required')) !!}
                    <label class="label-helper" for="disState">District</label>
                @else
                    {!! Form::select($datafield,$disState,NULL, array('id' => 'disState', 'class' => 'input-text', 'placeholder' => trans('Select State'),'required')) !!}
                    <label class="label-helper" for="disState">@lang('State')</label>
                @endif 
            </fieldset> 
            <fieldset>
                {!! Form::textarea('address', NULL, array('id' => 'address', 'class' => 'input-text', 'placeholder' => trans('Address'),'required')) !!}
                @error('address')
                <span class="help-block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label class="label-helper" for="address">@lang('Address')</label>
            </fieldset>
            {!! Form::button(trans('Next'), array('class' => 'btn ','type' =>'submit','id'=>'regbtn' )) !!}
            {!! Form::close() !!}

            @if(session()->has('step2'))
            <div class="col-sm-5 p-0"> 
                <a id="bottomback" href="{{route('now.register')}}" class="btn btn-social btn-back">
                    <i class="fas fa-reply fa"></i>
                    @lang('Step 1')
                </a> 
            </div>
            <div class="col-sm-2 p-0">
            </div>
            <div class="col-sm-5 p-0">
                @if (session('step1')['nationality']=='BD') 
                    <a id="bottomback" href="{{route('payment.info')}}" class="btn btn-social btn-back">
                        <i class="fas fa-share fa"></i>
                        @lang('Step 3')
                    </a>
                @else 
                    <a id="bottomback" href="{{route('pay.now')}}" class="btn btn-social btn-back">
                        <i class="fas fa-share fa"></i>
                        @lang('Step 3')
                    </a> 
                @endif 
            </div>
            @else
            <a id="bottomback" href="{{route('now.register')}}" class="btn btn-social btn-back">
                <i class="fas fa-reply fa"></i>
                @lang('Step 1')
            </a> 
            @endif 
        </div>

    </div>
    <script>
        $('#vcode').keyup(function () {
            var code = $('#vcode').val(); 
            var sendcode = "{{session('step1')['code']}}"; 
            if (sendcode != code) {
                $('#indicator').html('*Verification Code <img src="{{url("/img/verify.gif")}}" alt="Image"/>').css('color', 'red');
                $('#regbtn').attr({disabled: true});
            } else {
                $('#indicator').html('Verified Code').css('color', '#5f6368');
                $('#regbtn').attr({disabled: false});
            }
        });
    </script>
@endsection
