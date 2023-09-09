@extends('public.layout.public',['title' => transMsg($mcMenu->name) ])
@section('sliderText')
    <h1 class="page-title">@lang($mcMenu->name)</h1>
@endsection
@section('content')
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <!-- Team Start -->
    <div id="rs-team-2" class="rs-team-2 team-page sec-spacer">
        <div class="container">
            @if (count($committees) > 0)
                <div class="row grid">
                    @foreach($committees as $committee)
                        <div class="col-lg-3 col-md-6 col-xs-6 grid-item">
                            <div class="team-item">
                                <div class="team-img">
                                    @php
                                        if (empty($committee->image)) {
                                            $image = asset('image/blank.jpg');
                                        }else{
                                            $image = icpl_image($committee->image);
                                        }
                                    @endphp
                                    <a href="javascript:void(0)"><img src="{{ $image }}" alt=""/></a>
                                    <div class="social-icon">
                                        <a href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                        <a href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                        <a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a>
                                        <a href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                                    </div>
                                </div>
                                <div class="team-body">
                                    <a href="javascript:void(0)"><h3 class="name">{{$committee->name}}</h3></a>
                                    <span class="designation">{{designation($committee->designation,true)}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
{{--                <nav aria-label="Page navigation example">
                    {{$committees->links()}}
                </nav>--}}
            @else
                <div class="alert alert-danger text-center">
                    @lang($mcMenu->name.' not found')
                </div>

            @endif
        </div>
    </div>
    <!-- Team End -->
@endsection