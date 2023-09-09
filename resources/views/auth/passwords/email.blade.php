@extends('public.layout.public',['title' => transMsg('Forgot Password') ])
@section('sliderText')
    <h1 class="page-title">@lang('Forgot Password')</h1>
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Schoolbell"/>

    <style>

        h3.sufya {
            font-family: Schoolbell;

            text-align: center;
            color: #000;
            font-size: 30px;
            letter-spacing: -0.01em;
            line-height: 28px;

            font-weight: 600;
        }
    </style>
    <!--
        <style>
            .my_login_box_title {
                font-size: 18px;
                border-bottom: 2px solid #038bbc;
                margin: 10px 0px 20px;
                color: #038bbc;
            }

            .my_school_logo {
                width: 100px;
                height: 100px;
                border: 1px solid #fff;
                color: red;
                margin: 0px auto;
                border-radius: 50%;
                box-shadow: 0px 0px 5px #000;
            }

            .my_school_logo img {
                width: 100%;
                height: 100%;
            }

            .my_school_title {
                color: #fff;
                margin: 10px 0px 20px;
                text-shadow: 1px 1px 1px #333;
            }

            .my_input {
                width: 100%;
                margin: 5px 0px;
                padding: 10px;
                background: #fcfbea;
                border: 1px solid #e8d0fe;
                border-radius: 1px;
            }

            .my_button {
                width: 100px;
                margin: 10px 0px;
                padding: 10px;
                border-radius: 1px;
            }

            .nav li a {
                background: #ddd;
                color: #035124;
                font-weight: bold;
            }

            .f_logo {

                width: 30%;
                margin-top: 5px;
                margin-left: 5px;
            }

            .f_logo img {

                width: 100%;
            }

            .blue {
                background-color: #4A9FD7;

            }

            .blue h2 {
                width: 100%;
                margin-top: 100px;

                font-size: 50px;
                color: #fff;
                font-weight: normal;
                font-family: Schoolbell;
                text-align: center;

            }

        </style>

        <style>
            h3.sufya {
                font-family: Schoolbell;

                text-align: center;
                color: #000;
                font-size: 30px;
                letter-spacing: -0.01em;
                line-height: 28px;
                margin-top: 10px;
                margin-bottom: 15px;
                font-weight: 600;
            }

            @media only screen and (min-width: 220px) and (max-width: 400px) {
                .navmobile {
                    padding-left: 15px;
                }

                #flashMessage {
                    color: red;
                    font-size: 12px;
                    line-height: 18px;
                    text-align: center;
                    padding-bottom: 5px;

                }
            }

            @media only screen and (min-width: 220px) and (max-width: 767px) {
                .navbar-brand > img {
                    width: 70%;
                    margin-top: -5px;
                }

            }

            @media only screen and (min-width: 400px) and (max-width: 767px) {
                .navmobile {
                    padding-left: 15px;
                }

                #flashMessage {
                    color: red;
                    font-size: 14px;
                    line-height: 18px;
                    text-align: center;
                    padding-bottom: 5px;
                }
            }

            @media only screen and (min-width: 767px) {
                .navmobile {
                    padding-left: 15px;
                }

                #flashMessage {
                    color: red;
                    font-size: 14px;
                    line-height: 18px;
                    text-align: center;
                    padding-bottom: 5px;
                }
            }

            button.sinBtn {
                border-radius: 4px;
                background-color: #4A9FD7 !important;
                border: 1px solid #4a9fd7;
            }

            a.google-auth__button {
                background: #FFFFFF;
                color: rgba(0, 0, 0, 0.54);
                width: 100%;
                margin-bottom: 10px;
                border-radius: 4px;
                border: 1px solid #ccc;
            }

            img.google-auth__logo {
                display: inline-block;
                margin-right: 3px;
                margin-top: 1px;
                vertical-align: top;
            }

            .stage {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            input:-webkit-autofill, input:-webkit-autofill:hover, input:-webkit-autofill:focus, input:-webkit-autofill:active {
                -webkit-box-shadow: 0 0 0 30px white inset !important;
            }

            @media only screen and (min-width: 220px) and (max-width: 320px) {
                .forg-signup label {
                    width: 100%;
                }

                .forg-signup label.xs-hidde {
                    display: none;

                }
            }

            .greens {
                color: green !important;
            }

            h3 {

            }
        </style>
        <style type="text/css">
            #mainNav {
                background-color: #4a9fd7;
            }

            .navbar {
                margin-bottom: 0px;
            }

            .form-control {
                height: calc(1.5em + .75rem + 2px) !important;

            }

            .btn {
                padding: .375rem .75rem !important;
            }
            .sin{
               background-color: #4A9FD7 !important;
                border: 1px solid #4a9fd7;
            }
        </style>


        <style>

            html, body, .blue {

                height: 80vh;
            }
        </style> -->
    <!-- new Start -->
    @include('public.inc.pages-header')

    @include('public.inc.pages-slider')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-8 offset-lg-4  offset-md-4   offset-sm-2"
                 style="margin-top: 65px; padding: 0;  margin-bottom: 60px;       box-shadow: -3px 3px 7px 6px #eee;">
                <!-- <div class="col-md-6 blue" style=" padding-right: 0px; padding-left: 0px;" >

                    <div class="f_logo" >
                        <img src="img/upload/logo/f_logo.png" alt="">
                    </div>
                    <h2>Welcome to<br>Foqas Academy</h2>


                </div> -->
                <div class="col-md-12 " style="">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <h3 style="    padding-top: 25px;" class="sufya text-center">@lang('Reset Password')</h3>
                            <label for="email" class="col-md-10 offset-md-1 ">@lang('Enter E-Mail Address')</label>

                            <div class="col-md-10 offset-md-1">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox col-sm-12 col-xs-12"
                                 style="text-align:left;     padding-bottom: 15px; ">
                                <div class="row justify-content-center">
                                    <div class="col-md-10   ">
                                        <div class="row justify-content-center">
                                            <div class="col-md-5">
                                                <a style="width: 100%;" href="{{route('login')}}"
                                                   class=" btn btn-primary sin"> @lang('Back')</a>
                                            </div>

                                            <div class="col-md-5">
                                                <button type="submit"
                                                        class="  btn btn-primary sinBtn"> @lang('Reset Password')</button>
                                            </div>
                                        </div>

                                    </div>

                                </div>


                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>


    </div>

    <!-- new End -->



    {{--<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="page-panel-title text-center">@lang('Reset Password')</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">@lang('E-Mail Address')</label>

                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-primary">
                                        @lang('Send Password Reset Link')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
@endsection
