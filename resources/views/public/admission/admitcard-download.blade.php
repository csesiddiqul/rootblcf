@extends('public.layout.public',['title' => transMsg($admitCardMenu->name) ])
@section('sliderText')
    <h1 class="page-title">{{transMsg($admitCardMenu->name)}}</h1>
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
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <div class="container-fluid">
        <div class="row">
            @if(foqas_setting('admission_exam') == 1)
                @if(foqas_setting('admit_card') == 1)
                    <div class="col-lg-4 col-md-4 col-sm-8 offset-lg-4  offset-md-4   offset-sm-2"
                         style="margin-top: 100px; padding: 0; box-shadow: -3px 3px 7px 6px #eee;">
                        <div class="col-md-12 " style="">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form class="form-horizontal" id="downloadApp" method="POST" action="{{route('admitcard.view')}}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <h3 style="    padding-top: 25px;"
                                        class="sufya text-center">{{transMsg($admitCardMenu->name)}}</h3>
                                    <div class="col-md-10 offset-md-1">
                                        <div class="form-group {{ $errors->has('roll') ? ' has-error' : '' }}">
                                            <label for="roll">@lang('Admission Roll')</label>
                                            <input type="text" name="roll" value="{{old('roll')}}" required
                                                   class="form-control" id="roll"
                                                   placeholder="@lang('Enter Admission Roll')">
                                            @if ($errors->has('roll'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('roll') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password">@lang('Password')</label>
                                            <input type="password" name="password" required class="form-control"
                                                   id="password" placeholder="@lang('Enter Password')">
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox col-sm-12 col-xs-12"
                                         style="text-align:left;     padding-bottom: 15px; ">
                                        <div class="row justify-content-center">
                                            <div class="col-md-10   ">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-5 text-center">
                                                        <button type="submit"
                                                                class="  btn btn-primary sinBtn"> @lang('Download')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div align="center"
                         class="alert alert-danger col-md-12">@lang("Admit card not published yet")</div>
                @endif
            @else
                <div align="center"
                     class="alert alert-danger col-md-12">@lang("Admission exam not granted")</div>
            @endif
        </div>
    </div>
@endsection
