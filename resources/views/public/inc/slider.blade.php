@if(foqas_setting('slider_notice') == 2)
    <div style="{{useragentMobile() == false ? 'padding-top: 25px': ''}}">
        <div id="rs-slider"
             class="slider-overlay-1 col-md-8 col-sm-12 {{useragentMobile() == false ? 'pl-0' : 'pr-0 pl-0'}} pull-left">
            <div id="home-slider">
            @if($sliders->count())
                @foreach ($sliders as $key => $slider)
                    <!-- Item {{$key+1}} -->
                        <div class="item active">
                            <img src="{{$slider->image}}" alt="Slide{{$key+1}}"/>
                            <div class="slide-content">
                                <div class="display-table">
                                    <div class="display-table-cell">
                                        <div class="container">
                                            @empty(!$slider->title)
                                                <h1 class="slider-title" data-animation-in="fadeInLeft"
                                                    data-animation-out="animate-out">
                                                    {!! $slider->title !!}</h1>
                                            @endempty
                                            @empty(!$slider->shortdrc)
                                                <p data-animation-in="fadeInUp" data-animation-out="animate-out"
                                                   class="slider-desc">{!! nl2br($slider->shortdrc) !!}</p>
                                            @endempty
                                            @empty(!$slider->link)
                                                <a href="{{$slider->link}}" class=" sl-get-started-btn mr-30 "
                                                   data-animation-in="lightSpeedIn"
                                                   data-animation-out="animate-out">@lang('LEARN MORE')</a>
                                            @endempty
                                            {{-- <a href="#" class="sl-get-started-btn" data-animation-in="lightSpeedIn"
                                                data-animation-out="animate-out">GET STARTED NOW</a>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="item active">
                        <img src="https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/3471639910867.png"
                             alt="Slide0"/>
                    </div>
                    <div class="item active">
                        <img src="https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/1341634382467.png"
                             alt="Slide1"/>
                    </div>
                @endif
            </div>
        </div>
        @if(foqas_setting('breaking_news_position') == 3 && useragentMobile())
            <div class="clearfix"></div>
            @include('public.inc.breaking_news')
        @endif
        <div class="col-md-4 col-sm-12 {{useragentMobile() == false ? 'pl-0' : ''}} pull-right"
             style="padding-top: 15px">
            <h4 class="org-title bg-black text-white  py-1 px-1"> @lang('Notices Board')</h4>
            <div class="choose-desc text-justify slider-notice-body" style="border: 2px solid {{foqas_setting('theme_bg')}};">
                @if($notices->count())
                    <ul class="list-group">
                        @foreach($notices as $notice)
                            <li class="slider-notice-li">
                                <a href="{{route('single.notice',$notice->slug)}}">
                                    <i class="fa fa-chevron-circle-right text-primary pull-left"></i>
                                    <h5 class="slider-notice-h4">{{$notice->title}}</h5>
                                    <span class="slider-notice-span">
                                <i class="fa fa-calendar-check-o"></i> {{date('M d,Y',strtotime($notice->created_at))}}
                              </span>
                                </a>
                            </li>
                        @endforeach
                        <a href="{{route('public.notice')}}" style="padding: 10px; bottom: 0;position: absolute;"
                           class="small blue-text">
                            <i class="fa fa-arrow-right"></i> @lang('More Notices')</a>

                    </ul>
                @else
                    <span style="padding: 139px;position: absolute;">@lang('No notice was published')</span>
                @endif
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    @push('script')
        <style>
            .slider-notice-body {
                @if(foqas_setting('breaking_news_position') == 3)
                height: 334px;
                @else
                height: 334px;
                @endif
                background: #fafafa;
            }
        </style>
    @endpush
@else
    <div id="rs-slider" class="slider-overlay-1">
        <div id="home-slider">
        @if($sliders->count())
            @foreach ($sliders as $key => $slider)
                <!-- Item {{$key+1}} -->
                    <div class="item active">
                        <img src="{{$slider->image}}" alt="Slide{{$key+1}}"/>
                        <div class="slide-content">
                            <div class="display-table">
                                <div class="display-table-cell">
                                    <div class="container">
                                        @empty(!$slider->title)
                                            <h1 class="slider-title" data-animation-in="fadeInLeft"
                                                data-animation-out="animate-out">
                                                {!! $slider->title !!}</h1>
                                        @endempty
                                        @empty(!$slider->shortdrc)
                                            <p data-animation-in="fadeInUp" data-animation-out="animate-out"
                                               class="slider-desc">{!! nl2br($slider->shortdrc) !!}</p>
                                        @endempty
                                        @empty(!$slider->link)
                                            <a href="{{$slider->link}}" class=" sl-get-started-btn mr-30 "
                                               data-animation-in="lightSpeedIn"
                                               data-animation-out="animate-out">@lang('LEARN MORE')</a>
                                        @endempty
                                        {{-- <a href="#" class="sl-get-started-btn" data-animation-in="lightSpeedIn"
                                            data-animation-out="animate-out">GET STARTED NOW</a>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="item active">
                    <img src="https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/3471639910867.png"
                         alt="Slide0"/>
                </div>
                <div class="item active">
                    <img src="https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/1341634382467.png"
                         alt="Slide1"/>
                </div>
            @endif
        </div>
    </div>
@endif
