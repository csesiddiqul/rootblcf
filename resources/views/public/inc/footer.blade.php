{{--<div id="rs-partner" class="rs-partner pt-70 pb-70">
    <div class="container">
        <div class="rs-carousel owl-carousel" data-loop="true" data-items="5" data-margin="80" data-autoplay="true"
             data-autoplay-timeout="5000" data-smart-speed="2000" data-dots="false" data-nav="false"
             data-nav-speed="false" data-mobile-device="2" data-mobile-device-nav="false"
             data-mobile-device-dots="false" data-ipad-device="4" data-ipad-device-nav="false"
             data-ipad-device-dots="false" data-md-device="5" data-md-device-nav="false" data-md-device-dots="false">
            <div class="partner-item">
                <a href="#"><img src="{{asset('public/images/partner/1.png')}}" alt="Partner Image"></a>
            </div>
            <div class="partner-item">
                <a href="#"><img src="{{asset('public/images/partner/2.png')}}" alt="Partner Image"></a>
            </div>
            <div class="partner-item">
                <a href="#"><img src="{{asset('public/images/partner/2.png')}}" alt="Partner Image"></a>
            </div>
            <div class="partner-item">
                <a href="#"><img src="{{asset('public/images/partner/2.png')}}" alt="Partner Image"></a>
            </div>
            <div class="partner-item">
                <a href="#"><img src="{{asset('public/images/partner/2.png')}}" alt="Partner Image"></a>
            </div>


        </div>
    </div>
</div>--}}
<footer id="rs-footer" class="bg3 rs-footer {{useragentMobile() == false ? '' : 'mt-0'}}">
    <div class="container">
        <!-- Footer Address -->
    {{--<div>
        <div class="row footer-contact-desc">
            <div class="col-md-4">
                <div class="contact-inner">
                    <i class="fa fa-map-marker"></i>
                    <h4 class="contact-title">Address</h4>
                    <p class="contact-desc">
                        503 Old Buffalo Street<br>
                        Northwest #205, New York-3087
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-inner">
                    <i class="fa fa-phone"></i>
                    <h4 class="contact-title">Phone Number</h4>
                    <p class="contact-desc">
                        +3453-909-6565<br>
                        +2390-875-2235
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-inner">
                    <i class="fa fa-map-marker"></i>
                    <h4 class="contact-title">Email Address</h4>
                    <p class="contact-desc">
                        support@rstheme.com<br>
                        www.yourname.com
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>--}}
    <!-- Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    {{--<div class="col-lg-3 col-md-12">
                        <h5 class="footer-title">RECENT POSTS</h5>
                        <div class="recent-post-widget">
                            <div class="post-item">
                                <div class="post-date">
                                    <span>28</span>
                                    <span>June</span>
                                </div>
                                <div class="post-desc">
                                    <h5 class="post-title"><a href="#">While the lovely valley team work</a></h5>
                                    <span class="post-category">Keyword Analysis</span>
                                </div>
                            </div>
                            <div class="post-item">
                                <div class="post-date">
                                    <span>28</span>
                                    <span>June</span>
                                </div>
                                <div class="post-desc">
                                    <h5 class="post-title"><a href="#">@lang('I must explain to you how all this idea')</a></h5>
                                    <span class="post-category">@lang('Spoken English')</span>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                    @if (count($noticesFooter)>0)
                        <div class="col-lg-3 col-md-12">
                            <h4 class="footer-title">@lang('RECENT NOTICES')</h4>
                            @foreach($noticesFooter as $noticeFooter)
                                <div class="recent-post-widget mb-2">

                                    <div class="post-item" style="cursor: pointer;"
                                         onclick="window.location='{{route('single.notice',$noticeFooter->slug)}}';">
                                        <div class="post-date">

                                            <span>{{date('M d,Y',strtotime($noticeFooter->created_at))}}</span>
                                        </div>
                                        <div class="post-desc">
                                            <h5 class="post-title"><a
                                                        href="{{route('single.notice',$noticeFooter->slug)}}">{!! \Illuminate\Support\Str::limit($noticeFooter->title,20) !!}</a>
                                            </h5>
                                            <span class="post-category"></span>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="col-lg-3 col-md-12 ">
                        <div class="for_center">
                            <h4 class="footer-title">@lang('QUICK LINK')</h4>
                            <ul class="sitemap-widget">
                                <li class="active" style="width: 35%;"><a href="{{route('public.index')}}"><i
                                                class="fa fa-angle-right f-15" aria-hidden="true"></i>@lang('Home')</a>
                                </li>
                                <li style="width: 65%;"><a href="{{route('about.index')}}"><i
                                                class="fa fa-angle-right f-15" aria-hidden="true"></i>@lang('About Us')
                                    </a></li>
                                <li style="width: 35%"><a href="{{route('teacher.index')}}"><i
                                                class="fa fa-angle-right f-15" aria-hidden="true"></i>@lang('Teachers')
                                    </a></li>


                                <li style="width: 65%;"><a href="{{route('event.index')}}"><i
                                                class="fa fa-angle-right f-15" aria-hidden="true"></i>@lang('Events')
                                    </a></li>

                                <li style="width: 35%"><a href="{{route('committee.school')}}"><i
                                                class="fa fa-angle-right f-15" aria-hidden="true"></i>@lang('Committee')
                                    </a></li>


                                <li style="width: 65%;"><a href="{{route('gallery.index')}}"><i
                                                class="fa fa-angle-right f-15" aria-hidden="true"></i>@lang('Gallery')
                                    </a></li>
                                <li style="width: 35%"><a href="{{route('contact.index')}}"><i
                                                class="fa fa-angle-right f-15" aria-hidden="true"></i>@lang('Contact')
                                    </a></li>

                                <li style="width: 65%;"><a href="{{route('public.notice')}}"><i
                                                class="fa fa-angle-right f-15" aria-hidden="true"></i>@lang('Notices')
                                    </a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 address ">
                        <h4 class="footer-title">@lang('CONTACT INFO')</h4>
                        <p>{{school('address')}}</p>
                        <p>@lang('TEL'): {{foqas_setting('telephone')}}</p>
                        <p>@lang('MOBILE'): {{foqas_setting('phone')}}</p>
                        <p>@lang('E-Mail'): {{foqas_setting('email')}}</p>
                        {{--<p>Sign Up to Our Newsletter to Get Latest Updates &amp; Services</p>
                        <form class="news-form">
                            <input type="text" class="form-input" placeholder="Enter Your Email">
                            <button type="submit" class="form-button"><i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </button>
                        </form>--}}
                    </div>

                    <div class="col-lg-3 col-md-12 address ">
                        <h4 class="footer-title">@lang('FEEDBACK')</h4>
                        <ul class="">
                            <li><a href="{{route('public.complain')}}" class="complain"><i
                                            class="fa fa-pencil-square-o i-plain" aria-hidden=""> </i> @lang('Feedback')
                                </a></li>
                        </ul>
                        <div class="footer-share">
                            <ul>
                                <li><a href="{{foqas_setting('facebook')}}"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="{{foqas_setting('linkedin')}}"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="{{foqas_setting('twitter')}}"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="{{foqas_setting('pinterest')}}"><i class="fa fa-pinterest-p"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @if(foqas_setting('slogan'))
                <div class="col-md-12 text-center slogan">{{foqas_setting('slogan')}}</div>
                @endif
                @if(school('country')->code == 'BD')
                <div class="footer-share" style="margin-top: 20px">
                    @if(useragentMobile())
                        <img src="{{asset('img/SSLCOMMERZ_mobile_Aug 21-03.png')}}" alt="">
                    @else
                        <img src="{{asset('img/SSLCOMMERZ_Aug_21-05.png')}}" alt="">
                    @endif
                </div>
                @endif
            </div>
        </div>
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="copyright">
                    <p class="pull-left">&copy; @php echo date("Y"); @endphp {{school('name')}}. @lang('All Right Reserved.') @lang(' A')
                        <a href="https://www.foqas.com" target="_blank"> @lang('Foqas') </a> @lang('Platform.')</p>
                    @if(useragentMobile())
                        <div class="clearfix"></div>
                    @endif
                    <p class="pull-right">Powered By :&nbsp; <a target="_blank" href="https://ipsitasoft.com">IPSITA COMPUTERS PTE LTD</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>