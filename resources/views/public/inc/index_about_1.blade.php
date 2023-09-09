<!-- Why Choose Us Start-->
<div class="rs-why-choose sec-spacer divide">
    <div class="container" style="max-width: 100%">
        <div class="row">
            <div class="col-md-9">
                @php $limit=1700; @endphp
                @if(school('country')->code == 'BD')
                    @php $limit=950; @endphp
                    <div style="margin-bottom: 30px">
                        <img src="{{asset('img/National-Portal-Card-PM.jpeg')}}"
                             class="img-responsive" alt="">
                    </div>
                @endif
                <div class="pull-left">
                    <div class="sec-title">
                        <h2>@lang(foqas_setting('home_atitle'))</h2>
                    </div>
                    @if(school('country')->code != 'BD')
                        @empty(!foqas_setting('about_pic'))
                            <div class="choose-img" style="{{useragentMobile() == false ? '' : 'padding:0px'}}">
                                <img src="{{foqas_setting('about_pic')}}" style="border-radius: 5px;"
                                     alt="{{foqas_setting('home_atitle')}}">
                            </div>
                        @endempty
                    @endif
                    <div class="choose-desc text-justify my-4">
                        {!! \Illuminate\Support\Str::limit(nl2br(school('about')),$limit) !!}
                        @if(strlen(nl2br(school('about'))) > $limit)
                            <a class="text-center small d-block blue-text pb-2 pull-right"
                               href="{{url('/about')}}"><i class="fa fa-arrow-right"></i> @lang('See more') </a>
                        @endif
                    </div>
                </div>
                @if(foqas_setting('home_counter') == 1)
                    <!-- Counter Up Section Start-->
                    @include('public.inc.counter')
                    <!-- Counter Up Section End -->
                @endif
               <div id="rs-team" class="rs-team sec-color">
        <div class="container" style="max-width: 100%;{{useragentMobile() == false ? 'padding-left: 50px' : ''}}">
            <div class="col-md-12 pull-left {{useragentMobile() == false ? '' : 'pr-0 pl-0'}}" style="padding-top: 50px">
                <div class="sec-title mb-50 ">
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
        </div>
    </div>
            </div>
            <div class="col-md-3">
                @if(school('country')->code == 'BD')
                <div class="col-lg-12 mb-2">
                    <h4 class="org-title text-white  py-1 px-1"> @lang('Golden Jubilee of Independence')</h4>
                    <div class="text-left" style="border: 2px solid {{foqas_setting('theme_bg')}};">
                        <a href="https://shed.portal.gov.bd/sites/default/files/files/shed.portal.gov.bd/npfblock/%E0%A6%AC%E0%A6%B0%E0%A7%8D%E0%A6%B7%E0%A7%87%20%E0%A6%95%E0%A6%B0%E0%A7%8D%E0%A6%AE%E0%A6%AA%E0%A6%B0%E0%A6%BF%E0%A6%95%E0%A6%B2%E0%A7%8D%E0%A6%AA%E0%A6%A8%E0%A6%BE1.pdf">
                            <img alt="" src="{{asset('img/SubarnaJoyanti.png')}}" style="width:100%">
                        </a>
                    </div>
                </div>
                @endif
                @foreach($message_menus as $menu)
                    <div class="{{useragentMobile() == false ? 'col-lg-12' : ''}} dece-head" style="margin-top: 2.5rem">
                        <h4 class="org-title text-white text-center py-1 px-1"> {{transMsg($menu->name)}} </h4>
                        <div class="text-left" style="padding:14px; border: 2px solid {{foqas_setting('theme_bg')}};display: inline-block">
                            <a href="{{url($menu->slug)}}">
                                <img alt="" src="{{$menu->content->image}}" style="width:100%">
                            </a>
                            <h6 style="text-align:center"><span style="font-size:16px">{{$menu->content->title}}</span>
                            </h6>
                            <p> {!! \Illuminate\Support\Str::limit(nl2br($menu->content->description),40) !!}&nbsp;</p>
                            <p class="org-buttom"><a class="text-center small d-block blue-text"
                                  href="{{url($menu->slug)}}"><i class="fa fa-arrow-right"></i> @lang('See more')
                                </a></p>
                        </div>
                    </div>
                @endforeach
                
            <div class="col-md-12 pull-left">
                @if(school('country')->code == 'BD')
                    <div class="col-lg-12">
                        <h4 class="org-title bg-black text-white  py-1 px-1"> @lang('National Anthem')</h4>
                        <div class="text-left" style="border: 2px solid {{foqas_setting('theme_bg')}};">
                            <audio controls="" style="width:100%">
                                <source src="{{asset('audio/bd_national_anthem.mp3')}}" type="audio/mp3">
                            </audio>
                        </div>
                    </div>
                @endif
                <div class="col-lg-12 my-4 mb-0 p-0">
                    <h4 class="org-title bg-black text-white text-center  py-1 px-1"> @lang('Academic Calendar') </h4>
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
        </div>
    </div>
</div>
<!-- Why Choose Us End -->
