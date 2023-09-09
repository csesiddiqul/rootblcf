@extends('public.layout.public',['title' => $notice->title ,'tname'=>true])
@section('sliderText')
    <h1 class="page-title">{{$notice->title}}</h1>
@endsection
@section('content')
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <div class="rs-event-details pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="event-details-content">
                        <h3 class="event-title">{{$notice->title}}
                            <a href="{{url('/'.$notice->file_path)}}" target="_blank" download style="font-size: 20px;">Download Here</a>
                        </h3>


                        <div class="event-meta">
                            <div class="event-date">
                                <i class="fa fa-calendar"></i>
                                <span>{{date('M d,Y',strtotime($notice->created_at))}}</span>
                            </div>
                        </div>

                        @php
                            $extension = pathinfo($notice->file_path, PATHINFO_EXTENSION);
                        @endphp
                        <div class="event-img">
                            @if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg')
                                <img src="{{$notice->file_path}}" alt="Event Details Images"/>
                            @elseif($extension == 'pdf')
                                <div class="news-normal-block" style="cursor: pointer;     padding-bottom: 50px;">
                                    <img style="width: 30%;" src="{{getIconByExtension(pathinfo($notice->file_path, PATHINFO_EXTENSION))}}" alt="pdf">
                                    <div class="news-btn mt-3">
                                        <a href="{{url('/'.$notice->file_path)}}" target="_blank" download style="font-size: 20px;">Download Here</a>
                                    </div>
                                </div>

                            @elseif($extension == 'doc' || $extension == 'docx')

                                <div class="news-normal-block" style="cursor: pointer;     padding-bottom: 50px;">
                                    <img style="width: 30%;" src="{{getIconByExtension(pathinfo($notice->file_path, PATHINFO_EXTENSION))}}" alt="doc">
                                    <div class="news-btn mt-3">
                                        <a href="{{url('/'.$notice->file_path)}}" target="_blank" download style="font-size: 20px;">Download Here</a>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @isset($notice->description)
                            <div class="event-desc">
                                <p>
                                    {!! $notice->description !!}
                                </p>

                            </div>
                        @endisset
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
                @if (count($moreNotices)>0)
                    <div class="col-lg-5 col-md-12">
                        <div id="rs-latest-news" class="rs-latest-news sec-spacer" style="margin-top: 40px;">
                            <div class="news-list-block">
                                @foreach($moreNotices as $moreNotice)
                                    <div class="news-list-item" style="cursor: pointer;"
                                         onclick="window.location='{{route('single.notice',$moreNotice->slug)}}';">

                                        <div class="news-img">
                                            <a href="{{route('single.notice',$moreNotice->slug)}}" >
                                                <img src="{{getIconByExtension(pathinfo($moreNotice->file_path, PATHINFO_EXTENSION))}}" alt="" />
                                            </a>
                                        </div>
                                        <div class="news-content">
                                            <h5 class="news-title">
                                                <a href="{{route('single.notice',$moreNotice->slug)}}">{{$moreNotice->title}}</a>
                                            </h5>
                                            <div class="news-date">
                                                <i class="fa fa-calendar-check-o"></i>
                                                <span>{{date('M d,Y',strtotime($moreNotice->created_at))}}</span>
                                            </div>
                                            <div class="news-desc">
                                                <p>
                                                    <a href="{{route('single.notice',$moreNotice->slug)}}">{!! \Illuminate\Support\Str::limit($moreNotice->description,80) !!}</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="view-more">
                                <a href="{{route('public.notice')}}" style="cursor: pointer;">@lang('View All Notices') <i
                                            class="fa fa-angle-double-right" ></i></a>
                            </div>

                        </div>
                    </div>


                @endif
            </div>
        </div>
    </div>
@endsection