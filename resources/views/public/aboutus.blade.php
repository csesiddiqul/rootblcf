@extends('public.layout.public',['title' => transMsg('About') ])
@section('sliderText')
    <h1 class="page-title">@lang('About Us')</h1>
@endsection
@section('content')
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <!-- History Start -->
    <div class="rs-history sec-spacer">
        <div class="container">
            <div class="row">
                <div class="{{empty(foqas_setting('about_pic')) ? 'col-lg-12' : 'col-lg-12'}} col-md-12">
                    <div class="abt-title">
                        <h2>@lang('OUR HISTORY')</h2>
                    </div>
                    @empty(!foqas_setting('about_pic'))
                        <div class="rs-vertical-bottom mobile-mb-50 pull-right">
                            <img src="{{foqas_setting('about_pic')}}" style="border-radius: 5px;padding: 0 15px 0"
                                 alt="History Image"/>
                        </div>
                    @endempty
                    <div class="about-desc text-justify">
                        {!! nl2br(school('about')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- History End -->

    <!-- Mission Start -->
    <div class="rs-mission sec-color sec-spacer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 mobile-mb-50">
                    <div class="abt-title">
                        <h2>@lang('OUR MISSION')</h2>
                    </div>
                    <div class="about-desc text-justify">
                        {!! nl2br(school('mission')) !!}
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 mobile-mb-50">
                    <div class="abt-title">
                        <h2>@lang('OUR VISION')</h2>
                    </div>
                    <div class="about-desc text-justify">
                        {!! nl2br(school('vision')) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Mission End -->

    <!-- Vision Start -->
    {{--<div class="rs-vision sec-spacer">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 mobile-mb-50">
                    <div class="vision-img rs-animation-hover">
                        <img src="{{asset('public/images/about/vision.jpg')}}" alt="img02"/>
                        <a class="popup-youtube rs-animation-fade" href="https://www.youtube.com/watch?v=3f9CAMoj3Ec"
                           title="Video Icon">
                        </a>
                        <div class="overly-border"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="abt-title">
                        <h2>OUR VISION</h2>
                    </div>
                    <div class="vision-desc">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eius mod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehe derit in
                            voluptate velit esse cillum.</p>

                        <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled
                            and demoralized by the charms of pleasure of the moment, so blinded by desire, that they
                            cannot fore see the pain and trouble that are bound to ensue; and equal who fail in their
                            duty.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
    <!-- Vision End -->


    <!-- Team Start -->
    {{--<div id="rs-team" class="rs-team sec-spacer">
        <div class="container">
            <div class="abt-title mb-70 text-center">
                <h2>OUR EXPERIENCED STAFFS</h2>
                <p>Considering desire as primary motivation for the generation of narratives is a useful concept.</p>
            </div>
            <div class="rs-carousel owl-carousel" data-loop="true" data-items="3" data-margin="30" data-autoplay="false"
                 data-autoplay-timeout="5000" data-smart-speed="1200" data-dots="true" data-nav="true"
                 data-nav-speed="false" data-mobile-device="1" data-mobile-device-nav="true"
                 data-mobile-device-dots="true" data-ipad-device="2" data-ipad-device-nav="true"
                 data-ipad-device-dots="true" data-md-device="3" data-md-device-nav="true" data-md-device-dots="true">
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{asset('public/images/team/1.jpg')}}" alt="team Image"/>
                        <div class="normal-text">
                            <h3 class="team-name">ABD Rashid Khan</h3>
                            <span class="subtitle">Vice Chancellor</span>
                        </div>
                    </div>
                    <div class="team-content">
                        <div class="overly-border"></div>
                        <div class="display-table">
                            <div class="display-table-cell">
                                <h3 class="team-name"><a href="teachers-single.htmll">ABD Rashid Khan</a></h3>
                                <span class="team-title">Vice Chancellor</span>
                                <p class="team-desc">Entrusted with planning, implementation and evaluation.</p>
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
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{asset('public/images/team/2.jpg')}}" alt="team Image"/>
                        <div class="normal-text">
                            <h3 class="team-name">Luyes Figery</h3>
                            <span class="subtitle">A. Professor</span>
                        </div>
                    </div>
                    <div class="team-content">
                        <div class="overly-border"></div>
                        <div class="display-table">
                            <div class="display-table-cell">
                                <h3 class="team-name"><a href="teachers-single.html">Luyes Figery</a></h3>
                                <span class="team-title">A. Professor</span>
                                <p class="team-desc">Entrusted with planning, implementation and evaluation.</p>
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
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{asset('public/images/team/3.jpg')}}" alt="team Image"/>
                        <div class="normal-text">
                            <h3 class="team-name">Mr. Mahabub Alam</h3>
                            <span class="subtitle">Assistant Professor</span>
                        </div>
                    </div>
                    <div class="team-content">
                        <div class="overly-border"></div>
                        <div class="display-table">
                            <div class="display-table-cell">
                                <h3 class="team-name"><a href="teachers-single.htmll">Mr. Mahabub Alam</a></h3>
                                <span class="team-title">Assistant Professor</span>
                                <p class="team-desc">Entrusted with planning, implementation and evaluation.</p>
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
            </div>
        </div>
    </div>--}}
    <!-- Team End -->
    @if (count($branchs) > 0 && school('branch_per') == 1)
        <!-- Branches Start -->
        <div id="rs-branches" class="rs-branches sec-color pt-100 pb-70">
            <div class="container">
                <div class="abt-title mb-70 text-center">
                    <h2>@lang('OUR BRANCHES')</h2>
                    {{--<p>Considering desire as primary motivation for the generatio.</p>--}}
                </div>
                <div class="row">
                    @foreach($branchs as $branch)
                        <div class="col-lg-4 col-md-6">
                            <div class="branches-item">
                                <h1>{{$loop->index + 1}}</h1>
                                {{--                            <img src="{{asset('public/images/about/australia.png')}}" alt="Australia Flag">--}}
                                <h3>
                                    <span>{{$branch->branch_code}}</span>
                                    {{$branch->name}}
                                </h3>
                                <p>
                                    {{$branch->address}}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Branches End -->
    @endif

@endsection