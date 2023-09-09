@extends('public.layout.public',['title' => transMsg($content->menu->name) ])
@section('sliderText')
    <h1 class="page-title">{{transMsg($content->menu->name)}}</h1>
@endsection
@section('content')
    <style>
       .org-des p {
            margin: 0 0 10px !important;
        }
    </style>
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <div id="rs-team-2" class="rs-team-2 sec-spacer">
        <div class="container">
            <div class="col-lg-12">
                <div class="org-des aos-init aos-animate" data-aos="fade-up">
                    <img alt="" class="pull-right" src="{{$content->image}}" style="padding: 0px 0px 10px 20px">
                    <span class="pull-left">{{$content->title}}</span>
                    <br>
                    <hr>
                    {!! $content->description!!}
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection