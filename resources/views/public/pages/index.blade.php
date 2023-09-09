@extends('public.layout.public',['title' => $content->title ?? '' ])
@section('sliderText')
    <h1 class="page-title">{{$content->title ?? ''}}</h1>
@endsection
@section('content')
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <!-- History Start -->
    <div class="rs-courses-details pt-100 pb-70">
        <div class="container">
            <div class="row">
                @empty($content)
                    <span class="alert alert-danger w-100 text-center">@lang('Content not available')</span>
                @else
                    <div class="col-lg-12 col-md-12">
                        <div class="detail-img">
                            <img class="w-100" src="{{$content->image ?? ''}}" alt="Courses Images"/>

                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="crse">
                            {!! $content->description ?? '' !!}
                        </div>
                    </div>
                @endempty
            </div>
        </div>
    </div>
@endsection