@extends('layouts.app')
@section('content') 
    <link rel="stylesheet" href="{{asset('css/custome.css')}}">  
    <div id="registry" class="signup">
        <div class="signup-connect"> 
            <h1 class="name-title">{{session('completed')['school']}}</h1> 
            <div class="clearfix"></div>
            <div class="text-center">
                <p>{{session('completed')['email']}}</p>  
            </div>
            <div class="brdiv"></div>
            <div class="text-left">
                @php
                    $type = array('1'=>'Stripe','2'=>'SSL');
                    $currency = array('usd'=>'$','bdt'=>'৳');
                @endphp 
                <p><b>Transction ID:</b> {{$spdetails->trans_number}}</p>
                <p><b>Method Payment:</b> {{$type[$spdetails->trans_type]}} Payment</p>
                <p><b>{{pricingfor($spdetails->purpose_id).' + '.subscription($spdetails->month)}} Subscription:</b> {{$currency[$spdetails->currency].$spdetails->amount}}</p>
                <p><b>+Transaction Fee:</b> {{$currency[$spdetails->currency].$spdetails->stripe_fee}}</p>
                <p><b>Total Paid:</b> {{$currency[$spdetails->currency].($spdetails->amount+$spdetails->stripe_fee)}}</p>
            </div>
            <div class="brdiv"></div>
            <a id="topback" href="{{'https://'.session('completed')['sc_code'].'.foqasacademy.com'}}" class="btn btn-social btn-back">
                <i class="fas fa-home fa"></i>
                @lang('Go to your website')
            </a> 
        </div>
        <div class="signup-classic" id="regForm">
            <h2>@lang('Payment and Registration Success')</h2> 
            <ul class="progressbar">
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
                <li class="active"></li>
            </ul>
            <div class="brdiv"></div>
            <div class="alert alert-success alert-dismissible" role="alert"> 
                <small>@lang('We have sent registration details on your email. Please check your inbox and spam.')</small>
            </div>
            <div class="clearfix"></div> 
            <a href="{{'https://'.session('completed')['sc_code'].'.foqasacademy.com/login'}}" class="btn btn-login"> 
                @lang('Log in')
            </a>
            <a id="bottomback" href="{{'https://'.session('completed')['sc_code'].'.foqasacademy.com'}}" class="btn btn-social btn-back">
                <i class="fas fa-home fa"></i>
                @lang('Go to your website')
            </a> 
        </div> 
    </div> 
@endsection
