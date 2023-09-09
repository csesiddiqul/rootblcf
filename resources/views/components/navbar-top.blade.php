<style>
    /* .nav-item.active, .nav-item:hover, .nav-item:focus {
         background-color: #ffffff !important;
     }*/
    .navbar-left-section {
        padding: 0px;
        margin-top: 25px;
    }
    .m-top-10 {
        margin-top:10px;
    }
    .pd-0 {
        padding-top: 0px!important;
        padding-bottom: 0px!important;
    }
    .font-27 {
        font-size: 27px;
        color: #838384!important;
    }
    .font-27:hover {
        color: #0077f7!important;
    }
    .pdr-0 {
        padding-right: 0px;
    }
    .ex-w-h-74 {

    }
    .lang-select {
        font-size: 14px;
        font-wight: 700!important;
        border-radius: 3px!important;
    }

    .page-panel-title{
        padding-left: 15px !important;
    }
 
    @media (max-width: 999px) { 
           .nav-all-con{
            width: 100%;
           }
           .imga{
            padding: 5px 0;
            margin: 0;
            width: 20%;
            margin-left: 13px !important;
           } 
           .navbar-toggle{
            margin-top: 22px;
           }
           .navbar-form{
            width: 100%;
            margin-right: 0;
           }
           .page-panel-title{
                padding-left: 0 !important;
            }
    }
</style>
<nav class="navbar navbar-default navbar-static-top"
     style="background: #fff;border-bottom: none">
    <div class="container-fluid">
        <div class="nav-all-con">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">@lang('Toggle Navigation')</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            @if (foqas_setting('logo_type') == 1)
                @php $logo = foqas_setting('express'); @endphp
                @if(!empty($logo))
                    <style>
                        @media screen and (min-width: 998px) {
                            .img-fluid {
                                width: 25% !important;
                                height: auto;
                            }
                        }

                        @media screen and (max-width: 998px) {
                            .img-fluid {
                                width: 70% !important;
                            }
                        }
                    </style>
                @else
                    <style>
                        .img-fluid {
                            width: 25% !important;
                            height: 58px;
                        }
                    </style>
                @endif
            @else
                <style>
                    .img-fluid {
                        width: 100% !important;
                        height: 40px;
                    }

                    .navbar-left-section {
                        padding: 7px 0px 10px 14px;
                    }
                </style>
            @endif
        <!-- Branding Image -->
            <div class="imga navbar-left-section">
                <a href="{{route('home')}}" style="text-decoration:none;">
                    {{-- <img class="img-fluid" src="{{getLogo()}}" alt="{{school('title')}}" --}}
                    <img class="img-fluid" src="{{ asset('image/BLCF.png')}}" alt="{{school('title')}}"
                         style="margin-top: 2px;">
                </a>
            </div>
            @if(useragentMobile() == false)
                @if (foqas_setting('logo_type') == 1)
                    {{-- <a class="navbar-brand" href="{{ url('/home') }}" style="color: #000; padding-left: 30px;">
                         {{transMsg(school('name'))}}
                     </a>--}}
                @endif
            @endif
        </div>
        <div class="navbar-right-section">
        {{--@if(useragentMobile() == false)
            <div class="transcss">
                @php
                    $localLang = session('localLang') ?? foqas_setting('language');
                    if(empty($localLang))
                        $localLang = \App::getLocale();
                @endphp
                <form action="{{route('setLang')}}" method="POST" autocomplete="off" onfocus="false">
                    @csrf
                    <select name="lang" onchange="this.form.submit()" title="@lang('Change language')">
                        <option value="en" {{$localLang == 'en' ? 'selected' : ''}}>English</option>
                        <option value="bn" {{$localLang == 'bn' ? 'selected' : ''}}>Bangla</option>
                    </select>
                </form>
            </div>
        @endif--}}
        <!-- Right Side Of Navbar -->
            <ul class="nav pull-right nav-item dropdown m-top-10">
                <!-- Authentication Links -->
                @if(useragentMobile() == false) 
                    @php
                        $localLang = session('localLang') ?? foqas_setting('language');
                        if(empty($localLang))
                            $localLang = \App::getLocale();
                    @endphp
                    <li class="pull-left transcss">
                        <form action="{{route('setLang')}}" method="POST" autocomplete="off" onfocus="false">
                            @csrf
                            <select class="lang-select" name="lang" onchange="this.form.submit()" title="@lang('Change language')">
                                <option value="en" {{$localLang == 'en' ? 'selected' : ''}}>English</option>
                                <option value="bn" {{$localLang == 'bn' ? 'selected' : ''}}>Bangla</option>
                            </select>
                        </form>
                    </li>
                    <li class="pull-left" style="margin: 16px 2px 0px 5px">
                        <a class="pd-0" href="{{url('/')}}" target="_blank"><i class="fa fa-home font-27"></i></a>
                    </li>
                    <li class="pull-left transcss pdr-0">&nbsp;</li> 
                @endif
                @guest
                    <li><a href="{{ route('login') }}" style="color: #000;">@lang('Login')</a></li>
                @else
                    @if(useragentMobile() == false)
                        @if(\Auth::user()->role == 'student')
                            <li class="nav-item back_white">
                                <a href="{{url('user/'.\Auth::user()->id.'/notifications')}}"
                                   class="nav-link nav-link-align-btn"
                                   role="button"> <i class="fal fa-envelope"></i>
                                    <?php
                                    $mc = \App\Notification::where('student_id', \Auth::user()->id)->where('active', 1)->count();
                                    ?>
                                    @if($mc > 0)
                                        <span style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">{{$mc}}</span>
                                    @endif
                                </a>
                            </li>
                        @endif
                    @endif
                    <li class="nav-item dropdown back_white">
                        <a href="javascript:void(0)" class="nav-link dropdown-toggle nav-link-align-btn" data-toggle="dropdown"
                           role="button" aria-expanded="true" aria-haspopup="true">
                            @if(useragentMobile() == false)
                                <span class="label foqas-label">
                                    {{ transMsg(ucfirst(\Auth::user()->role)) }}
                                </span>&nbsp;&nbsp;
                            @endif
                            @if(!empty(Auth::user()->pic_path))
                                @if (file_exists(asset('01-progress.gif')))
                                    <img data-src="{{asset('01-progress.gif')}}" src="{{url(Auth::user()->pic_path)}}"
                                         alt=""
                                         style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">
                                @else
                                    @if(strtolower(Auth::user()->gender) == 'male')
                                        <img data-src="{{asset('01-progress.gif')}}"
                                             src="https://img.icons8.com/color/48/000000/architect.png"
                                             alt=""
                                             style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">
                                    @else
                                        <img data-src="{{asset('01-progress.gif')}}"
                                             src="https://img.icons8.com/color/48/000000/architect-female.png"
                                             alt=""
                                             style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">
                                    @endif
                                @endif
                            @else
                                @if(strtolower(Auth::user()->gender) == 'male')
                                    <img data-src="{{asset('01-progress.gif')}}"
                                         src="https://img.icons8.com/color/48/000000/architect.png"
                                         alt=""
                                         style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">
                                @else
                                    <img data-src="{{asset('01-progress.gif')}}"
                                         src="https://img.icons8.com/color/48/000000/architect-female.png"
                                         alt=""
                                         style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">
                                @endif
                            @endif
                            <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu pull-right">
                            @if(Auth::user()->role != 'master')
                                <li>
                                    <a href="{{url('user/'.Auth::user()->student_code)}}">@lang('Profile')</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{url('user/config/change_password')}}">@lang('Change Password')</a>
                            </li>
                            @if(env('APP_ENV') != 'production' && serverIsLocal())
                                <li>
                                    <a href="{{url('user/config/impersonate')}}">
                                        {{ app('impersonate')->isImpersonating() ? __('Leave Impersonation') : __('Impersonate') }}
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="javascript:void(0)" onclick="confirmLogout()">
                                    @lang('Logout')
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>