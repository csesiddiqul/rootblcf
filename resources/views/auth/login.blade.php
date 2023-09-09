@extends('layouts.app',['title' => transMsg('Login') ])
@section('content')
    <style>
        .sin_btn {
            background: #55acee !important;
            color: #363738 !important;
            width: 100%;
            border: 1px solid #cccccc94 !important;
        }

        .stage .btn {
            background: #fff !important;
            color: #5f6368 !important;
        }

        .heading h2 {
            font-size: 22px !important;
        }

        .posi {
            padding-left: 0px !important;
        }

        .stage .btn:hover {
            background-color: none !important;
            box-shadow: none !important;
        }

        .sin_btn .btn:hover {
            background-color: #4a9fd7 !important;
            box-shadow: none !important;
        }

        .sin_btn:focus {
            outline: none !important;

        }
        .signup{
            min-height: 85vh;
            border-radius: 100px 0 100px 0 !important;
        }
        .signup-connect{
            border-radius: 0px 20px 20px 0px;
            flex-direction: column !important;
            justify-content: end !important;
            display: flex !important;
            position: relative;
        }
        .signup-classic{
            padding: 60px 35px !important;
            position: relative;
        }
        .form-group{
            padding: 5px 16px;
            margin-bottom: 0 !important;
        }
        .form-horizontal{
            margin-top: 65px;
        }
        .formr img{
            opacity: 0.9;
            position: absolute;
            right: 35px;
            top: 35px;
        }
        .formr img{
            width: 20%;
        }
        .logr img{
            opacity: 0.9;
            position: absolute;
            right: 0;
            top: 0;
        }
        .logl img{
            opacity: 0.9;
            position: absolute;
            left: 0;
            top: 0;
        }
        h2{
            font-weight: bold !important;
            font-family: 'Microsoft JhengHei Light ', sans-serif !important;
            color: #4A9FD7;
        }
        label{
            font-weight: 600 !important;
        }
        input[type='text'], input[type='password'] {
            box-sizing: border-box;
            height: 44px;
            width: 325px;
            padding: 18px 25px !important;
            outline: none;
            border: 1px solid #4A9FD7 !important;
            border-radius: 25px 0px 0px 25px !important;
            box-shadow: 0 0 10px rgba(15, 15, 51, 0.2);
            font-size: 16px;
            color: rgba(0, 0, 0, 0.8);
            background-color: #ffffff;
            transition: .4s;
            
        }
        input[type='text']:focus,input[type='password']:focus{
            box-shadow: 0 0 10px rgba(15, 15, 51, 0.2);
        }
        .btn-hob:hover{
            background-color: #006cb4 !important;
        }
        @media (max-width: 425px) and (min-width: 320px) {
            #registry .signup-classic {
                padding: 5px 30px !important;
            }
        }
        @media (max-width: 768px) { 
            .signup{
                border-radius: 5px !important;
                width: 90%;
            }
            .signup-classic h2{
                padding-top: 25px;
            }
            .signup-connect{
                border-radius: 0;
            }
            input[type='text'], input[type='password'] {
                width: 100% !important;
            }
         }
        mt-0{
            margin-bottom: 0px;
        }
        
    </style>
    <!-- Start -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css"/>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Schoolbell"/>
    <link rel="stylesheet" href="{{asset('css/custome.css')}}">
    <!-- partial:index.partial.html -->
    <div id="registry" class="signup">
        <div class="signup-connect text-center">
            @if (foqas_setting('logo_type') == 1)
                @php $logo = foqas_setting('express'); @endphp
            @else
                @php $logo = foqas_setting('standard'); @endphp
            @endif
            @empty($logo)
                @php $logo = 'https://trello-attachments.s3.amazonaws.com/5f4f1c974719e18dcbcac0d8/5f4f1d43a5aabf803fbf0177/745f3e08d0efb80dd69b8e5d3fd66d82/Foqas_symbol_white.png'; @endphp
            @endempty
            <div class="logl">
                <img src="{{ asset('image/login-icon-01.png')}}" alt="Logo" class="logoSchool">
            </div>
            <div class="logr">
                <img src="{{ asset('image/icon-02.png')}}" alt="Logo" class="logoSchool">
            </div>
            <div class="">
                <img src="{{ asset('image/log.png')}}" alt="Logo" class="logoSchool">
            </div>
            @if ($_SERVER['SERVER_NAME'] != 'foqasacademy.com' || $_SERVER['SERVER_NAME'] != 'www.foqasacademy.com')
                <a id="topback" href="{{route('public.index')}}" class="btn btn-social posi btn-back">
                    <i class="fas fa-home fa"></i>
                    @lang('Back to Home')
                </a>
            @endif
        </div>

        <div class="signup-classic heading col-sm-12">
            <h2>@lang('Welcome to')   @if (foqas_setting('logo_type') == 1) {{transMsg(school('short_name') ?? school('name'))}}   @endif</h2>
            {{-- <strong>@lang('Login to') {{transMsg(school('short_name') ?? school('name'))}}</strong> --}}
            
            <div class="formr">
                <img src="{{ asset('image/BLCF.png')}}" alt="Logo">
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                @csrf
                <fieldset>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">@lang('E-mail')</label>
                        <input id="email" type="text" class="form-control" name="email"
                               value="{{ old('email') }}" required autofocus>
                        @error('email')
                        <div class="clearhight"></div>
                        <span class="help-block">
                                        <strong>{{ transMsg($message) }}</strong>
                                    </span>
                        @enderror
                        @error('phone_number')
                        <div class="clearhight"></div>
                        <span class="help-block">
                                        <strong>{{ transMsg($message) }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">@lang('Password')</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if ($errors->has('password'))
                            <div class="clearhight"></div>
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"
                                       name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('Remember Me')
                            </label>
                        </div>
                    </div>
                    <div class="form-group mt-0">
                        <button type="submit" style="color: #fff !important;"
                                class="btn btn-sm btn-hob sin_btn text-light">@lang('Login')
                        </button>
                        {{--    <button type="submit" class="btn btn-primary">
                               @lang('Login')
                           </button>

                            <a class="btn btn-link" href="{{ route('password.request') ">
                               @lang('Forgot Your Password?')
                           </a> --}}
                    </div>
                    <div class="form-group" style="margin-top: -12px;">
                        <div style="text-align: center;" class="stage">
                            
                           <label>or</label>
                            <a href="{{route('login_google')}}" style="margin: 0;"
                               class="ui button google-auth__button btn  sin_btn">
                                <img src="https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/foqas_google.svg"
                                     alt="">
                               <img style="height: 20px;" src="{{ asset('image/google.png') }}" alt="" srcset="">
                            </a>
                            {{-- <a href="{{route('login_google')}}"
                               class="ui button google-auth__button btn  sin_btn">
                                <img src="https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/foqas_google.svg"
                                     alt="">
                                @lang('Sign in with Google')
                            </a> --}}
                        </div>
                    </div>
                    <div class="text-center forg-signup" style="font-size:small;">
                        <label><a href="{{ route('password.request') }}" style="font-size:13px;">@lang('Forgot Password ?')</a>
                        </label>
                        {{--<label class="xs-hidde">&nbsp;&nbsp;||&nbsp;&nbsp;</label><label><a href="#" style="">Create New Ledger</a></label>      --}}
                    </div>
                </fieldset>
            </form>

            <a id="bottomback" href="{{route('public.index')}}" class="btn btn-social btn-back">
                <i class="fas fa-home fa"></i>
                @lang('Back')
            </a>
        </div>

    </div>
    <!-- partial -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
    <!-- End-->

    {{--<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" id="main-container">
                <div class="panel panel-default">
                    <div class="page-panel-title">@lang('Login')</div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">@lang('E-Mail Or Phone Number')</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">@lang('Password')</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('Remember Me')
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        @lang('Login')
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        @lang('Forgot Your Password?')
                                    </a>
                                    --}}
    {{--  </div>
      </div>
      </form>
      </div>
      </div>
      </div>
      </div>
      </div>--}}
@endsection
