@if (foqas_setting('site_published') == 0)
@include('public.inc.maintenance')
@php
    exit();
@endphp
@endif
@empty(foqas_setting('icon'))
@php $icon = 'https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/favicon.png'; @endphp
@else
@php $icon = foqas_setting('icon'); @endphp
@endempty
@php if (\Cache::has('school_change_master_' . school('id')))
    {
        session()->forget('current_school');
        \Cache::forget('school_change_master_' . school('id'));
    }
@endphp
        <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- meta tag -->
    <meta charset="utf-8">
    <title> @isset($title){{$title}} {{!isset($tname) ? '|' : ''}} @endisset @if (!isset($tname))
            {{transMsg(school('name') == 'name' ? config('app.name') : school('name'))}}  @endif</title>
    <!-- responsive tag -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="origin-when-crossorigin">
    <meta name="robots" content="all">
    <meta name="copyright" content="{{transMsg('Foqas Academy')}}">
    <meta name="description" content="{{transMsg(school('name') == 'name' ? config('app.name') : school('name'))}}">
    <meta name="keywords"
          content="School,{{transMsg(school('name') == 'name' ? config('app.name') : school('name'))}},{{getShortName(school('name'))}},{{transMsg('Foqas Academy')}},{{transMsg('Smart School')}}">
    <meta name="geo.placename" content="{{transMsg(school('name') == 'name' ? config('app.name') : school('name'))}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ url('/') }}">
    <link rel="shortcut icon" href="{{$icon}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/owl.carousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/rsmenu-main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/rsmenu-transitions.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/magnific-popup.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/fonts/flaticon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/fonts/fonts2/flaticon.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/academy.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/print.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/style.css')}}">
    <script src="{{asset('public/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/js/popper.min.js')}}"></script>
    <script src="{{asset('public/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('additional/sweetalert2/sweetalert2.js')}}"></script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <style>
        .rs-toolbar, .org-title,.org-buttom, .week .day.selected span, #scrollUp i, .rs-footer, .owl-nav .owl-prev, .owl-nav .owl-next, .team-social a, .rs-team .team-item .team-title:after,.rs-gallery .gallery-item .gallery-desc .image-popup,.event-btn  a {
            background: {{foqas_setting('theme_bg')}}        !important;
        }

        .rs-toolbar a, .rs-toolbar i,.org-buttom a,.org-buttom, .rs-toolbar a.beforedivider:before, .org-title, .week .day.selected span, .rs-footer a, .rs-footer i, .rs-footer p, .rs-footer span, .rs-footer .slogan, .footer-title, #scrollUp i, .team-social a i,.event-btn  a {
            color: {{foqas_setting('theme_color')}}        !important;
        }

        .rs-testimonial-2 .testimonial-item .testi-desc:before, .rs-testimonial-2 .testimonial-item .testi-desc:after{
            color: {{foqas_setting('theme_bg')}}        !important;
        }
        .overly-border::before {
            border-top: 5px solid {{foqas_setting('theme_bg')}}        !important;
            border-bottom: 5px solid {{foqas_setting('theme_bg')}}        !important;
        }
        .overly-border::after {
            border-right: 5px solid {{foqas_setting('theme_bg')}}        !important;
            border-left: 5px solid {{foqas_setting('theme_bg')}}        !important;
        }
    </style>
    @stack('styles')
</head>
<body class="{{(\Route::current()->getName() == 'public.index'?'home2':'')}} {{(\Route::current()->getName() != 'public.index'?'inner-page':'')}} ">
{{--<div class="book_preload ">
    <div class="book">
        <img src="{{asset('image/gpLoader.gif')}}" alt="">
    </div>
</div>--}}
@yield('content')
@if ('addinfo' != \Route::current()->getName())
    @php session()->forget('able_registry'); @endphp
@endif
<!-- Footer Start and Partner Start -->
@if($footerFalse ?? 1 == 1)
    @include('public.inc.footer')
@endif
<!-- Footer End and Partner End-->
<!-- start scrollUp  -->
<div id="scrollUp">
    <i class="fa fa-angle-up"></i>
</div>
<!-- Search Modal Start -->
{{--@include('public.inc.search-modal')--}}
@stack('modal')
@include('sweetalert::alert')
<script src="{{asset('public/js/modernizr-2.8.3.min.js')}}"></script>
<script src="{{asset('additional/jquery-validate/jquery.validate.min.js')}}"></script>
<script src="{{asset('public/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('public/js/slick.min.js')}}"></script>
<script src="{{asset('public/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('public/js/imagesloaded.pkgd.min.js')}}"></script>
<script src="{{asset('public/js/wow.min.js')}}"></script>
<script src="{{asset('public/js/waypoints.min.js')}}"></script>
<script src="{{asset('public/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('public/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('public/js/rsmenu-main.js')}}"></script>
<script src="{{asset('public/js/plugins.js')}}"></script>
<script src="{{asset('public/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('public/js/main.js')}}"></script>
<script src="{{asset('public/js/academy.js')}}"></script>
@stack('script')
@if (Session::has('getSecretKey'))
    <script>
        $(document).ready(function () {
            registry_sweet();
            $(window).load(function () {
                $('.book').delay(2000).fadeOut();
            });
        })
    </script>
@endif
</body>
</html>
