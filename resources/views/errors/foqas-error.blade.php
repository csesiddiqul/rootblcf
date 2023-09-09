@extends('public.layout.public')
@section('sliderText')
    <h1 class="page-title"> @yield('code', __('404')) | @yield('message', __('Not Found'))</h1>
@endsection
@section('content')
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <style>
        .dontcry{
            margin-top: 98px;
        }
    </style>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="dontcry ">
                 <img src="{{asset('image/foqas_cry.png')}}" alt="foqas_cry">
            </div>
        </div>
        <div class="col-md-8">
           <div class="dontcry ">
                <h3>@lang('Awww…. Don’t Cry.')</h3>
            <p>@lang('Looks like the page you were looking for no longer exist or the server encountered a temporary error
                    and
                    could not complete your request, in that case please try again in 30 seconds.')</p>

                <p>@lang('In most cases, this error is resolved if you <b>DELETE</b> your browser cache and cookies.')</p>
           </div>
        </div>
    </div>
</div>
   
    
@endsection
