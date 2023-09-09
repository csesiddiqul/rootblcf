<div class="full-width-header">
    @include('public.inc.top-bar')
    @if(foqas_setting('breaking_news_position') == 2)
        @include('public.inc.breaking_news')
    @endif
    @push('styles')
        <style>
            .home2 .menu-area .main-menu, .menu-sticky.sticky {
                background: {{foqas_setting('menu_bg')}}        !important;
            }

            .home2 .nav-menu > li > a, .menu-sticky.sticky .logo-area span {
                color: {{foqas_setting('menu_color')}}          !important;
            }

            .rs-menu ul ul, .nav-menu > .menu-item-has-children > span.rs-menu-parent {
                background: {{foqas_setting('submenu_bg')}}        !important;
                border-left: 1px solid {{foqas_setting('submenu_bg')}}          !important;
            }

            .menu-item-has-children {
                color: {{foqas_setting('submenu_color')}}          !important;
            }

            .rs-menu ul ul {
                border-bottom: 1px solid {{foqas_setting('menu_bg')}}          !important;
            }

            @media only screen and (max-width: 991px) {
                .rs-menu-toggle {
                    background: {{foqas_setting('menu_bg')}}          !important;
                    border-left: 1px solid {{foqas_setting('menu_bg')}}          !important;
                    color: {{foqas_setting('menu_color')}}          !important;
                }

                .nav-menu > li > a {
                    border-bottom: 1px solid {{foqas_setting('menu_bg')}}          !important;
                }
            }

        </style>
@endpush
<!--Header Start-->
    <header id="rs-header" class="rs-header">
        <!-- Header Top Start -->
        <div class="rs-header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12" style="padding-left:0px">
                        @if (foqas_setting('logo_type') == 1)
                            @php $logo = foqas_setting('express'); @endphp
                            @empty($logo)
                                @php $logo = 'https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/favicon.png'; @endphp
                            @endempty
                        @else
                            @php $logo = foqas_setting('standard'); @endphp
                            @empty($logo)
                                @php $logo = 'https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/icpl.png'; @endphp
                            @endempty
                        @endif
                        <div class="logo-area logo_style">
                            @if (foqas_setting('logo_type') == 1)
                                <a href="{{route('public.index')}}"><img src="{{ $logo }}" alt="logo"></a>
                                <a href="{{route('public.index')}}">
                                    {{transMsg(school('name'))}}
                                </a>
                            @else
                                <a href="{{route('public.index')}}"><img src="{{ $logo }}" alt="logo"></a>
                            @endif
                        </div>
                    </div>
                    @if(useragentMobile() == false)
                        <div class="col-lg-4 col-md-12">
                            <div class="row d-flex justify-content-end pt15">
                                <div class="col-sm-12 ">
                                    <div class="header-contact">
                                        <div id="phone-details" class="widget-text">
                                            <i class="glyph-icon flaticon-phone-call"></i>
                                            <div class="info-text">
                                                <a href="tel:{{foqas_setting('phone')}}">
                                                    <span>@lang('Call Us')</span>
                                                    {{foqas_setting('phone')}}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-sm-4">
                                     <div class="header-contact">
                                         <div id="info-details" class="widget-text">
                                             <i class="glyph-icon flaticon-email"></i>
                                             <div class="info-text">
                                                 <a href="mailto:info@domain.com">
                                                     <span>Mail Us</span>
                                                     {{foqas_setting('email')}}
                                                 </a>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-sm-4">
                                     <div class="header-contact">
                                         <div id="address-details" class="widget-text">
                                             <i class="glyph-icon flaticon-placeholder"></i>
                                             <div class="info-text">
                                                 <span>Location</span>
                                                 {{school('address')}}
                                             </div>
                                         </div>
                                     </div>
                                 </div>--}}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- Header Top End -->
        <!-- Menu Start -->
        <div class="menu-area menu-sticky" style="{{useragentMobile() == false ? 'padding: 0 15px' : ''}}">
            <div class="container" style="max-width: 100%">
                <div class="main-menu">
                    <div class="row">
                        <div class="col-sm-12">
                            <a class="rs-menu-toggle "><i class="fa fa-bars"></i>@lang('Menu')</a>
                            <nav class="rs-menu">
                                <ul class="nav-menu">
                                    {{--<li class="menu-item-has-children"><a href="#">Courses</a>
                                        <ul class="sub-menu">
                                            <li><a href="{{route('forcourse.index')}}">Courses</a></li>
                                            <li><a href="{{route('coursedetails.index')}}">Course Details</a></li>
                                        </ul>
                                    </li>--}}
                                    {{--<li class="menu-item-has-children"><a href="{{route('event.index')}}">Events</a>
                                        <ul class="sub-menu">
                                            <li><a href="{{route('event.index')}}">Events</a></li>
                                            <li><a href="{{route('eventdetails.index')}}">Events Details</a></li>
                                        </ul>
                                    </li>--}}
                                    {{--<li class="menu-item-has-children"><a href="#">Blog</a>
                                        <ul class="sub-menu">
                                            <li><a href="{{route('blog.index')}}">Blog</a>
                                            <li><a href="{{route('blogdetails.index')}}">Blog Details</a></li>
                                        </ul>
                                    </li>--}}
                                    @if ($menus->count())
                                        @foreach($menus[0] as $key=> $menu)
                                            <li class="{{!empty($menus[$menu->id]) ? 'menu-item-has-children' : ''}}">
                                                <a href="{{$menu->url == 1 ? ($menu->type == 1 ? url($menu->slug) : route('public.pages',$menu->slug)) : 'javascript:void(0)'}}">{{transMsg($menu->name)}}</a>
                                                @if(!empty($menus[$menu->id]))
                                                    <ul class="sub-menu">
                                                        @foreach($menus[$menu->id] as $menuSec)
                                                            <li class="{{!empty($menus[$menuSec->id]) ? 'menu-item-has-children' : ''}}">
                                                                <a href="{{$menuSec->url == 1 ? ($menuSec->type == 1 ? url($menuSec->slug) : route('public.pages',$menuSec->slug)) : 'javascript:void(0)'}}" >{{transMsg($menuSec->name)}}</a>
                                                                @if(!empty($menus[$menuSec->id]))
                                                                    <ul class="sub-menu">
                                                                        @foreach($menus[$menuSec->id] as $menuThe)
                                                                            <li class="{{!empty($menus[$menuThe->id]) ? 'menu-item-has-children' : ''}}">
                                                                                <a href="{{$menuThe->url == 1 ? ($menuThe->type == 1 ? url($menuThe->slug) : route('public.pages',$menuThe->slug)) : 'javascript:void(0)'}}">{{transMsg($menuThe->name)}}</a>
                                                                                @if(!empty($menus[$menuThe->id]))
                                                                                    <ul class="sub-menu">
                                                                                        @foreach($menus[$menuThe->id] as $menuFo)
                                                                                            <li class="{{!empty($menus[$menuFo->id]) ? 'menu-item-has-children' : ''}}">
                                                                                                <a href="{{$menuFo->url == 1 ? ($menuFo->type == 1 ? url($menuFo->slug) : route('public.pages',$menuFo->slug)) : 'javascript:void(0)'}}">{{transMsg($menuFo->name)}}</a>
                                                                                                @if(!empty($menus[$menuFo->id]))
                                                                                                    <ul class="sub-menu">
                                                                                                        @foreach($menus[$menuFo->id] as $menuFive)
                                                                                                            <li>
                                                                                                                <a href="{{$menuFive->url == 1 ? ($menuFive->type == 1 ? url($menuFive->slug) : route('public.pages',$menuFive->slug)) : 'javascript:void(0)'}}">{{transMsg($menuFive->name)}}</a>
                                                                                                            </li>
                                                                                                        @endforeach
                                                                                                    </ul>
                                                                                                @endif
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @endif
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="current-menu-item current_page_item menu-item-has-children"><a
                                                    href="{{route('public.index')}}" class="home">@lang('Home')</a>
                                        </li>
                                        <li><a href="{{route('gallery.index')}}">@lang('Gallery')</a></li>
                                        <li><a href="{{route('contact.index')}}">@lang('Contact')</a></li>
                                    @endif
                                </ul>
                            </nav>
                            <a class="hidden-xs rs-search" data-target=".search-modal" data-toggle="modal" href="#"><i
                                        class="fa fa-search"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Menu End -->
    </header>
    <!--Header End-->
</div>

