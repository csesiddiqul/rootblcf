@extends('public.layout.public',['title' => $event->title,'tname'=>true])

@section('sliderText')
    <h1 class="page-title">{{$event->title}}</h1>
@endsection
@section('content')
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <div class="rs-event-details pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="event-details-content">
                        <h3 class="event-title">{{$event->title}}
                        </h3>
                        <div class="event-meta">
                            @isset($event->event_date)
                                <div class="event-date">
                                    <i class="fa fa-calendar"></i>
                                    <span>{{$event->event_date}}</span>
                                </div>
                            @endisset
                            @if(isset($event->event_time) || isset($event->event_timend))
                                <div class="event-time">
                                    <i class="fa fa-clock-o"></i>
                                    <span>
                                        @isset($event->event_time)
                                            {{$event->event_time}}
                                        @endisset
                                        @isset($event->event_timend)
                                            {{isset($event->event_time) ? ' - ' : ''}}
                                            {{$event->event_timend}}
                                        @endisset
                                    </span>
                                </div>
                            @endif
                            @isset($event->venue)
                                <div class="event-location">
                                    <i class="fa fa-map-marker"></i>
                                    <span>Venue: {{$event->venue}}</span>
                                </div>
                            @endisset
                        </div>
                        @php
                            $extension = pathinfo($event->file_path, PATHINFO_EXTENSION);
                        @endphp
                        <div class="event-img">
                           
                            @if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg')

                            
                                <img src="{{$event->file_path}}" alt="Event Details Images"/>
                            @elseif($extension == 'pdf')
                                <iframe src="{{$event->file_path}}" style="width:100%; height:500px;" frameborder="0"
                                        allowfullscreen></iframe>
                            @endif

                        </div>


                        <div class="event-desc text-justify">
                            <p>
                                {!! $event->description !!}
                            </p>

                        </div>
                        {{--<div id="googleMap"></div>--}}
                        <div class="share-area">
                            <div class="row rs-vertical-middle">
                                <div class="col-md-4">
                                    {{--   <div class="book-btn">
                                           <a href="#">Book Now</a>
                                       </div>--}}
                                </div>
                                <div class="col-md-8">
                                    <div class="share-inner">
                                        <span>SHARE:</span>
                                        <a href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                        <a href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                        <a href="javascript:void(0)"><i class="fa fa-google"></i></a>
                                        <a href="javascript:void(0)"><i class="fa fa-pinterest-p"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="col-lg-4 col-md-12">
                    <div class="sidebar-area">
                        <div class="search-box">
                            <h3 class="title">Search Courses</h3>
                            <div class="box-search">
                                <input class="form-control" placeholder="Search Here ..." name="srch-term"
                                       id="srch-term" type="text">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"
                                                                                 aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <div class="cate-box">
                            <h3 class="title">Categories</h3>
                            <ul>
                                <li>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Analysis & Features
                                        <span>(05)</span></a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Video Reviews
                                        <span>(07)</span></a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Engineering Tech
                                        <span>(09)</span></a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#"> Righteous
                                        Indignation <span>(08)</span></a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">General Education
                                        <span>(04)</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="latest-courses">
                            <h3 class="title">Latest Courses</h3>
                            <div class="post-item">
                                <div class="post-img">
                                    <a href="blog-details.html"><img src="{{asset('public/images/blog-details/sm1.jpg')}}" alt=""
                                                                     title="News image"></a>
                                </div>
                                <div class="post-desc">
                                    <h4><a href="blog-details.html">Raken develops reporting The software</a></h4>
                                    <span class="duration">
                                            <i class="fa fa-clock-o" aria-hidden="true"></i> 4 Years
                                        </span>
                                    <span class="price">Price: <span>$350</span></span>
                                </div>
                            </div>
                            <div class="post-item">
                                <div class="post-img">
                                    <a href="blog-details.html"><img src="{{asset('public/images/blog-details/sm2.jpg')}}" alt=""
                                                                     title="News image"></a>
                                </div>
                                <div class="post-desc">
                                    <h4><a href="blog-details.html">Raken develops reporting The software</a></h4>
                                    <span class="duration">
                                            <i class="fa fa-clock-o" aria-hidden="true"></i> 4 Years
                                        </span>
                                    <span class="price">Price: <span>$350</span></span>
                                </div>
                            </div>
                            <div class="post-item">
                                <div class="post-img">
                                    <a href="blog-details.html"><img src="{{asset('public/images/blog-details/sm3.jpg')}}" alt=""
                                                                     title="News image"></a>
                                </div>
                                <div class="post-desc">
                                    <h4><a href="blog-details.html">Raken develops reporting The software</a></h4>
                                    <span class="duration">
                                            <i class="fa fa-clock-o" aria-hidden="true"></i> 4 Years
                                        </span>
                                    <span class="price">Price: <span>$350</span></span>
                                </div>
                            </div>
                        </div>
                        <div class="tags-cloud clearfix">
                            <h3 class="title">Product Tags</h3>
                            <ul>
                                <li>
                                    <a href="#">SCIENCE</a>
                                </li>
                                <li>
                                    <a href="#">HUMANITIES</a>
                                </li>
                                <li>
                                    <a href="#">DIPLOMA</a>
                                </li>
                                <li>
                                    <a href="#">BUSINESS</a>
                                </li>
                                <li>
                                    <a href="#">SPROTS</a>
                                </li>
                                <li>
                                    <a href="#">RESEARCH</a>
                                </li>
                                <li>
                                    <a href="#">ARTS</a>
                                </li>
                                <li>
                                    <a href="#">ADMISSIONS</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
@endsection