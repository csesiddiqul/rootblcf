@push('styles')
    <style>
        .menu-sticky.sticky {
            background: {{foqas_setting('menu_bg')}}      !important;
        }

        .menu-sticky.sticky .nav-menu > li > a {
            color: {{foqas_setting('menu_color')}}        !important;
        }

        .menu-item-has-children {
            color: {{foqas_setting('submenu_color')}}        !important;
        }

        .rs-menu ul ul, .nav-menu > .menu-item-has-children > span.rs-menu-parent {
            background: {{foqas_setting('submenu_bg')}}      !important;
            border-left: 1px solid {{foqas_setting('submenu_bg')}}        !important;
        }

        .menu-sticky.sticky .rs-menu-toggle,.menu-sticky.sticky .logo-area span {
            color: {{foqas_setting('menu_color')}}        !important;
        }

        @media only screen and (max-width: 991px) {
            .inner-page .rs-menu > ul, .instructor-home .rs-menu > ul, .home3 .rs-header .menu-area {
                background: {{foqas_setting('menu_bg')}}      !important;
            }

            .nav-menu > li > a {
                border-bottom: 1px solid {{foqas_setting('menu_bg')}}        !important;
                color: {{foqas_setting('menu_color')}}        !important;
            }
        }
    </style>
@endpush
<div class="full-width-header">
   @include('public.inc.top-bar')
    @php $logo = getLogo() @endphp
    @php
        if (serverIsLocal())
             $imageSize = array();
        else
            $imageSize = getimagesize($logo);
    @endphp
    <style>
        @media only screen and (max-width: 575px) {
            .logo-area img {
                max-width: 100% !important;
            }
            .row.rs-vertical-middle div:first-child {
                padding-right: 15px;
            }
            .rs-breadcrumbs {
                @if (foqas_setting('logo_type') == 1)
                       padding: 30px 0 35px;
                @else
                       padding: 0px 0 35px;
            @endif
            }
        }
        @media (min-width: 768px) {
            @if (foqas_setting('logo_type') == 1 && !empty(foqas_setting('express')))
            .logo_style3 img {
                width: {{( isset($imageSize[0]) && $imageSize[0] == '80' && $imageSize[1] == '80') ? 'auto' : '18%'}};
            }
        @endif
        }
    </style>
    <!--Header Start-->
    <header id="rs-header-2" class="rs-header-2">
        <!-- Menu Start -->
        <div class="menu-area menu-sticky">
            <div class="container-fluid">
                <div class="row rs-vertical-middle">
                    <div class="col-lg-2 col-md-3 col-sm-5 col-5 pr-0 pl-0"
                         @if(foqas_setting('logo_type') == 2) style="padding: 0;" @endif>
                        <div class="logo-area logo_style3" style="    margin-left: 20px;">
                            @if (foqas_setting('logo_type') == 1)
                                <a href="{{route('public.index')}}"><img src="{{ $logo }}" alt="logo">
                                    <span class="">
                                  {{transMsg(school('short_name'))}}
                                </span>
                                </a>
                            @else
                                <a href="{{route('public.index')}}">
                                    <img style="width: 100% !important;" src="{{ $logo }}" alt="logo">
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-9 col-sm-7 col-7">
                        <div class="main-menu">
                            <a class="rs-menu-toggle"><i class="fa fa-bars"></i>@lang('Menu')</a>
                            <nav class="rs-menu">
                                <ul class="nav-menu">
                                    @if ($menus->count())
                                        @foreach($menus[0] as $key=> $menu)
                                            <li class="{{!empty($menus[$menu->id]) ? 'menu-item-has-children' : ''}}">
                                                <a href="{{$menu->url == 1 ? ($menu->type == 1 ? url($menu->slug) : route('public.pages',$menu->slug)) : 'javascript:void(0)'}}">{{transMsg($menu->name)}}</a>
                                                @if(!empty($menus[$menu->id]))
                                                    <ul class="sub-menu">
                                                        @foreach($menus[$menu->id] as $menuSec)
                                                            <li class="{{!empty($menus[$menuSec->id]) ? 'menu-item-has-children' : ''}}">
                                                                <a href="{{$menuSec->url == 1 ? ($menuSec->type == 1 ? url($menuSec->slug) : route('public.pages',$menuSec->slug)) : 'javascript:void(0)'}}"
                                                                   class="menu-item-has-children">{{transMsg($menuSec->name)}}</a>
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
                        </div>
                        {{--<div class="searce-box">
                            <a class="rs-search" data-target=".search-modal" data-toggle="modal" href="#"><i
                                        class="fa fa-search"></i></a>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
        <!-- Menu End -->
    </header>
    <!--Header End-->

</div>
