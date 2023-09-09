@extends('layout.public',['title' => transMsg('404') ])

@section('sliderText')
    <h1 class="page-title">@lang('ERROR')</h1>
@endsection
@section('content')
    @include('inc.pages-header')
    @include('inc.pages-slider')
    <div class="error-page-area sec-spacer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 error-page-message">
                    <div class="error-page">
                        <h1>@lang('404')</h1>
                        <p>@lang('Page was not Found')</p>
                        <div class="home-page">
                            <a href="index.html">@lang('Go to Home Page')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection