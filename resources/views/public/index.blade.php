@extends('public.layout.public')
@section('content')
    @if(foqas_setting('breaking_news_position') == 1)
        @include('public.inc.breaking_news')
    @endif
    @include('public.inc.header')
    @include('public.inc.slider')
    @if(foqas_setting('breaking_news_position') == 3 && useragentMobile() == false)
        @include('public.inc.breaking_news')
    @endif
    {{-- @include('public.inc.search-course')
     <!-- Courses Start  slider er por search course chilo delete kore diyechi-->
    <!-- Courses End -->--}}
    @php
        $indexMenu =  \App\Menu::bySchool(\school('id'))->whereIn('menus.slug', ['chairman-message', 'headteacher-message'])->where('status', 1)->get();
        $menu_content_count = 0;
    @endphp
    @foreach($indexMenu as $menu_content)
        @if(isset($menu_content->content))
            @php $menu_content_count++ @endphp
        @endif
    @endforeach
    @if($menu_content_count>0)
        @include('public.inc.index_about_1')
    @else
        @include('public.inc.index_about')
    @endif

    <!-- Team Start -->
    {{-- <div id="rs-team" class="rs-team sec-color">
        <div class="container" style="max-width: 100%;{{useragentMobile() == false ? 'padding-left: 50px' : ''}}">
            <div class="col-md-9 pull-left {{useragentMobile() == false ? '' : 'pr-0 pl-0'}}" style="padding-top: 50px">
                <div class="sec-title mb-50 text-center">
                    <h2>@lang('OUR TEACHERS')</h2>
                    <div class="view-more">
                        <a href="{{route('teacher.index')}}">@lang('View All Teacher') <i
                                    class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
                @if (count($teachers)>0)
                    <div class="rs-carousel owl-carousel p-3" data-loop="true" data-items="3" data-margin="30"
                         data-autoplay="true"
                         data-autoplay-timeout="5000" data-smart-speed="1200" data-dots="true" data-nav="true"
                         data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="true"
                         data-mobile-device-dots="true" data-ipad-device="2" data-ipad-device-nav="true"
                         data-ipad-device-dots="true" data-md-device="3" data-md-device-nav="true"
                         data-md-device-dots="true">
                        @foreach($teachers as $teacher)
                            <div class="team-item">
                                <div class="team-img">
                                    @empty($teacher->pic_path)
                                        @php $profileImage = asset('image/blank.jpg') @endphp
                                    @else
                                        @if (file_exists($teacher->pic_path))
                                            @php $profileImage = icpl_image($teacher->pic_path) @endphp
                                        @else
                                            @php $profileImage = asset('image/blank.jpg') @endphp
                                        @endif
                                    @endempty
                                    <img src="{{$profileImage}}" alt="team Image"/>
                                    <div class="normal-text">
                                        <a href="{{route('teacher.show',['id'=>$teacher->student_code,'name'=>\Illuminate\Support\Str::slug($teacher->name)])}}">
                                            <h3 class="team-name">{{$teacher->name}}</h3></a>
                                        <span class="subtitle">{{trans(ucwords($teacher->role_title))}}</span>
                                    </div>
                                </div>
                                <div class="team-content" style="cursor: pointer;"
                                     onclick="window.location='{{route('teacher.show',['id'=>$teacher->student_code,'name'=>\Illuminate\Support\Str::slug($teacher->name)])}}';">
                                    <div class="overly-border"></div>
                                    <div class="display-table">
                                        <div class="display-table-cell">
                                            <h3 class="team-name"><a
                                                        href="{{route('teacher.show',['id'=>$teacher->student_code,'name'=>\Illuminate\Support\Str::slug($teacher->name)])}}">{{$teacher->name}}</a>
                                            </h3>
                                            <span class="team-title">{{trans(ucwords($teacher->role_title))}}</span>

                                            <div class="team-social">
                                                <a href="#" class="social-icon"><i class="fa fa-facebook"></i></a>
                                                <a href="#" class="social-icon"><i class="fa fa-google-plus"></i></a>
                                                <a href="#" class="social-icon"><i class="fa fa-twitter"></i></a>
                                                <a href="#" class="social-icon"><i class="fa fa-pinterest-p"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-md-3 pull-left  {{useragentMobile() == false ? 'pr-0' : 'pr-0 pl-0'}} ">
                @if(school('country')->code == 'BD')
                    <div class="col-lg-12 ">
                        <h4 class="org-title bg-black text-white  py-1 px-1"> @lang('National Anthem')</h4>
                        <div class="text-left" style="border: 2px solid {{foqas_setting('theme_bg')}};">
                            <audio controls="" style="width:100%">
                                <source src="{{asset('audio/bd_national_anthem.mp3')}}" type="audio/mp3">
                            </audio>
                        </div>
                    </div>
                @endif
                <div class="col-lg-12 my-2">
                    <h4 class="org-title bg-black text-white  py-1 px-1"> @lang('Academic Calendar') </h4>
                    <div class="text-left" style="border: 2px solid {{foqas_setting('theme_bg')}};">
                        @push('styles')
                            <link rel="stylesheet" href="{{asset('public/css/calendar.css')}}">
                        @endpush
                        <main>
                            <div class="calendar-wrapper" id="calendar-wrapper"></div>
                        </main>
                        @push('script')
                            <script src="{{asset('public/js/calendar.js')}}"></script>
                            <script type="text/javascript">
                                var config = `function selectDate(date) {
                                          $('#calendar-wrapper').updateCalendarOptions({
                                            date: date
                                          });
                                          console.log(calendar.getSelectedDate());
                                        }

                                        var defaultConfig = {
                                          weekDayLength: 1,
                                          date: '{{date('m/d/Y',strtotime(now()))}}',
                                          onClickDate: selectDate,
                                          showYearDropdown: true,
                                          startOnMonday: true,
                                        };
                                        var calendar = $('#calendar-wrapper').calendar(defaultConfig);
                                        console.log(calendar.getSelectedDate());
                                        `;
                                eval(config);
                            </script>
                        @endpush
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Team End -->
    <div class="clearfix"></div>

    @if(foqas_setting('slider_notice') == 1)
        @empty(!$singleNotice)
            <!-- Latest News Start -->
            <div id="rs-latest-news" class="rs-latest-news sec-spacer">
                <div class="container">
                    <div class="sec-title mb-50">
                        <h2>@lang('NOTICES')</h2>
                        {{--<p>Fusce sem dolor, interdum in efficitur at, faucibus nec lorem. Sed nec molestie justo.</p>--}}
                        <div class="view-more">
                            <a href="{{route('public.notice')}}">@lang('View All Notices') <i
                                        class="fa fa-angle-double-right"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            @if (count($notices)>0)
                                <div class="news-list-block">
                                    @foreach($notices as $notice)
                                        <div class="news-list-item" style="cursor: pointer;"
                                             onclick="window.location='{{route('single.notice',$notice->slug)}}';">
                                            <div class="news-img" style="cursor: pointer;">
                                                <img src="{{getIconByExtension(pathinfo($notice->file_path, PATHINFO_EXTENSION))}}"
                                                     alt=""/>
                                            </div>
                                            <div class="news-content">
                                                <h5 class="news-title">
                                                    <a href="{{route('single.notice',$notice->slug)}}">{{$notice->title}}</a>
                                                </h5>
                                                <div class="news-date">
                                                    <i class="fa fa-calendar-check-o"></i>
                                                    <span>{{date('M d,Y',strtotime($notice->created_at))}}</span>
                                                </div>
                                                <div class="news-desc">
                                                    <p>
                                                        <a href="{{route('single.notice',$notice->slug)}}">{!! \Illuminate\Support\Str::limit($notice->description,80) !!}</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="news-normal-block" style="cursor: pointer;     padding-bottom: 50px;"
                                 onclick="window.location='{{route('single.notice',$singleNotice->slug)}}';">
                                <div class="news-img text-center" style="cursor: pointer;">
                                    <img class="w-30"
                                         src="{{getIconByExtension(pathinfo($singleNotice->file_path, PATHINFO_EXTENSION))}}"
                                         alt=""/>
                                </div>
                                <div class="news-date">
                                    <i class="fa fa-calendar-check-o"></i>
                                    <span>{{date('M d,Y',strtotime($singleNotice->created_at))}}</span>
                                </div>
                                <h4 class="news-title"><a
                                            href="{{route('single.notice',$singleNotice->slug)}}">{{$singleNotice->title}}</a>
                                </h4>
                                <div class="news-desc">
                                    <p>
                                        <a href="{{route('single.notice',$singleNotice->slug)}}">{!! \Illuminate\Support\Str::limit($singleNotice->description,150) !!}</a>
                                    </p>
                                </div>
                                <div class="news-btn">
                                    <a href="{{route('single.notice',$singleNotice->slug)}}">@lang('Read More')</a>
                                </div>
                            </div>
                            {{--<div class="news-normal-block">
                                <div class="news-img">
                                    <a href="#">
                                        <img src="{{asset('public/images/blog/1.jpg')}}" alt=""/>
                                    </a>
                                </div>
                                <div class="news-date">
                                    <i class="fa fa-calendar-check-o"></i>
                                    <span>June  28,  2017</span>
                                </div>
                                <h4 class="news-title"><a href="blog-details.html">Those Other College Expenses You Aren't
                                        Thinking About</a></h4>
                                <div class="news-desc">
                                    <p>
                                        Blandit rutrum, erat et egestas ultricies, dolor tortor egestas enim, quiste rhoncus sem
                                        the purus eu sapien curabitur.Lorem Ipsum is therefore always free from repetitionetc.
                                    </p>
                                </div>
                                <div class="news-btn">
                                    <a href="#">@lang('Read More')</a>
                                </div>
                            </div>
                            <div class="news-normal-block">
                                <div class="news-img">
                                    <a href="#">
                                        <img src="{{asset('public/images/blog/1.jpg')}}" alt=""/>
                                    </a>
                                </div>
                                <div class="news-date">
                                    <i class="fa fa-calendar-check-o"></i>
                                    <span>June  28,  2017</span>
                                </div>
                                <h4 class="news-title"><a href="blog-details.html">Those Other College Expenses You Aren't
                                        Thinking About</a></h4>
                                <div class="news-desc">
                                    <p>
                                        Blandit rutrum, erat et egestas ultricies, dolor tortor egestas enim, quiste rhoncus sem
                                        the purus eu sapien curabitur.Lorem Ipsum is therefore always free from repetitionetc.
                                    </p>
                                </div>
                                <div class="news-btn">
                                    <a href="#">@lang('Read More')</a>
                                </div>
                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Latest News End -->
        @endempty
    @endif
    <!-- Video Start -->
    {{--<div id="rs-video" class="rs-video bg6">
        <div class="container">
            <div class="video-content">
                <a class="popup-youtube" href="https://www.youtube.com/watch?v=3f9CAMoj3Ec" title="Video Icon">
                    <i class="fa fa-play"></i>
                </a>
                <span>TAKE A TOUR</span>
            </div>
        </div>
    </div>--}}
    <!-- Video End -->
    @if ($testimonials->count())
        <!-- Testimonial Start -->
        <div id="rs-testimonial-2"
             class="rs-testimonial-2 sec-color {{useragentMobile() == false ? 'pt-100 pb-70' : ''}}">
            <div class="container">
                <div class="sec-title {{useragentMobile() == false ? 'mb-50' : 'mb-0'}}">
                    <h2>@lang('WHAT PEOPLE SAYS')</h2>
                    {{--                    <p>Fusce sem dolor, interdum in efficitur at, faucibus nec lorem. Sed nec molestie justo.</p>--}}
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="rs-carousel owl-carousel" data-loop="true" data-items="2" data-margin="30"
                             data-autoplay="true" data-autoplay-timeout="5000" data-smart-speed="1200" data-dots="false"
                             data-nav="true" data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="true"
                             data-mobile-device-dots="false" data-ipad-device="2" data-ipad-device-nav="true"
                             data-ipad-device-dots="false" data-md-device="2" data-md-device-nav="true"
                             data-md-device-dots="false">
                            @foreach($testimonials as $testimonial)
                                <div class="testimonial-item">
                                    <div class="testi-img">
                                        <img src="{{$testimonial->photo}}" alt="Jhon Smith">
                                    </div>
                                    <div class="testi-desc">
                                        <h4 class="testi-name">{{$testimonial->title}}</h4>
                                        <p>
                                            {!! $testimonial->message !!}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Testimonial End -->
    @endif
@endsection
@push('styles')
    <style>
        .rs-footer {
            margin-top: 0px !important;
        }
    </style>
@endpush
