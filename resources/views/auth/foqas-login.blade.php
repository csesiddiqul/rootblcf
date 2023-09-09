@extends('layouts.app',['title' => transMsg(school('name')),'tname'=>true ])
@section('content')
    <style>
        .sin_btn {
            background: #fff !important;
            color: #5f6368 !important;
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
            background-color: none !important;
            box-shadow: none !important;
        }

        .sin_btn:focus {
            outline: none !important;

        }

        .mt-0 {
            margin-top: 0px !important;
        }

        .regbtn {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            width: 50px;
            height: 100%;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.1);
            line-height: 32px;
            font-size: 20px;
            border-radius: 5px 0 0 5px;
        }

        #registry .btn-back {
            top: 20%;
        }
    </style>
    <!-- Start -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Schoolbell"/>
    <link rel="stylesheet" href="{{asset('css/custome.css')}}">
    <!-- partial:index.partial.html -->
    <div id="registry" class="signup">
        <div class="signup-connect">
            <div>
                <a href="https://www.foqas.com" target="_blank">
                    <img src="{{asset('image/f_logo.png')}}" onmouseover="this.src='{{asset("image/logo.png")}}'"
                         onmouseout="this.src='{{asset("image/f_logo.png")}}'" width="40%" alt="Foqas Logo"/></a>
            </div>
            <h1>@lang('Welcome to')<br>{{school('name')}}</h1>
            {{-- <div class="forSlogo">
                 <img src="https://trello-attachments.s3.amazonaws.com/5f4f1c974719e18dcbcac0d8/5f4f1d43a5aabf803fbf0177/745f3e08d0efb80dd69b8e5d3fd66d82/Foqas_symbol_white.png"
                      alt="Logo" class="logoSchool">
             </div>
             <a id="topback" href="{{route('public.index')}}" class="btn btn-social posi btn-back">
                 <i class="fas fa-home fa"></i>
                 Back to Home
             </a>--}}
            <a id="topback" href="{{route('now.register')}}" class="btn btn-social posi btn-back">
                <i class="fal fa-sign-in-alt regbtn"></i>
                @lang('Register your Academy')
            </a>
        </div>
        <div class="signup-classic heading" style="padding: 30px 30px;">
            <h2 class=" text-center">@lang('Login to') {{school('name')}}</h2>
            {!! Form::open(['method' => 'PUT','autocomplete'=>'off','route'=>'foqas.login']) !!}
            <div class="form-check pull-left">
                <input class="form-check-input" onchange="this.form.submit()" type="radio" name="loginfor"
                       id="forSchool" value="1" {{session('foqasLoginFor') == 1 ? 'checked' : ''}} />
                <label class="form-check-label" for="forSchool"> @lang('For School') </label>
            </div>
            <div class="form-check pull-left ml-5">
                <input class="form-check-input" onchange="this.form.submit()" type="radio" name="loginfor" id="forAgent"
                       value="2" {{session('foqasLoginFor') == 2 ? 'checked' : ''}} />
                <label class="form-check-label" for="forAgent"> @lang('For Agent') </label>
            </div>
            {!! Form::close() !!}
            <div class="clearfix"></div>
            {!! Form::open(['method' => 'post','autocomplete'=>'off','route'=>'foqas.login']) !!}
            <fieldset>
                @if (session('foqasLoginFor') == 1)
                    <div class="form-group">
                        {!! Form::label('schoolcode',trans('School Code'),array('class'=>'control-label')) !!}
                        {!! Form::text('schoolcode',$schoolcode ?? null, array('class' => 'form-control','autocomplete' => 'off','required')) !!}
                        @error('code')
                        <span class="help-block mt-0">
                          <strong>{{$message}}</strong>
                    </span>
                        @enderror
                    </div>
                @endif
                <div class="form-group">
                    {!! Form::label('email',trans('Email'),array('class'=>'control-label')) !!}
                    {!! Form::email('email', $email ?? null, array('class' => 'form-control','autocomplete' => 'off','required')) !!}
                    @error('email')
                    <span class="help-block mt-0">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('password',trans('Password'),array('class'=>'control-label')) !!}
                    {!! Form::password('password', array('class' => 'form-control','autocomplete' => 'off','required')) !!}
                    @error('password')
                    <span class="help-block mt-0">
                        <strong>{{$message}}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> @lang('Remember Me')
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-default sin_btn"> @lang('Login') </button>
                </div>
                <div class="col-sm-12 text-center forg-signup" style="font-size:small;">
                    <label><a href="{{ route('password.request') }}"
                              style="font-size:13px;">@lang('Forgot Password?')</a>
                    </label>
                    {{--<label class="xs-hidde">&nbsp;&nbsp;||&nbsp;&nbsp;</label><label><a href="#" style="">@lang('Create New Ledger')</a></label>      --}}
                </div>
            </fieldset>
            {!! Form::close() !!}
            <a id="bottomback" href="{{route('public.index')}}" class="btn btn-social btn-back">
                <i class="fas fa-home fa"></i>
                @lang('Back')
            </a>
        </div>
    </div>
    <!-- partial -->
@endsection
