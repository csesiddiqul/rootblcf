@php
    if (\Cache::has('school_change_master_' . school('id')))
    {
        session()->forget('current_school');
        \Cache::forget('school_change_master_' . school('id'));
    }
@endphp
        <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" id="html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @empty(foqas_setting('icon'))
        @php $icon = 'storage/img/01/favicon.png'; @endphp
    @else
        @php $icon = foqas_setting('icon'); @endphp
    @endempty
    <title> @isset($title){{$title}} {{!isset($tname) ? '|' : ''}} @endisset @if (!isset($tname))
            {{ (Auth::check() ? transMsg(Auth::user()->school->name) : (school('name') == 'name' ? transMsg(config('app.name')) : transMsg(school('name')))) }} @endif</title>
    <link rel="shortcut icon" href="{{icpl_image($icon)}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ url('/') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/loader.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/vendors.css') }}" id="bootswatch-print-id">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/application.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/print.css')}}" media="print">
    <link rel="stylesheet" type="text/css" href="{{asset('css/certificate-print.css')}}" media="print">
    <link rel="stylesheet" type="text/css" href="{{asset('css/paymentreport.css')}}" media="print">
    <link rel="stylesheet" type="text/css" href="{{asset('css/certificate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/customize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('additional/select4.2/select2.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('additional/fonts/material-icon.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/TableExport/3.3.13/css/tableexport.css"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script type="text/javascript" src="{{ asset('js/vendors.js') }}"></script>
    <script type="text/javascript" src="{{asset('additional/sweetalert2/sweetalert2.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/export2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/fontawesome.js') }}"></script>
    <script type="text/javascript" src="{{ asset('excel/src/stable/js/Blob.js') }}"></script>
    <script type="text/javascript" src="{{ asset('excel/src/stable/js/xlsx.core.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('excel/src/stable/js/FileSaver.js') }}"></script>
    <script type="text/javascript" src="{{ asset('excel/src/stable/js/tableexport.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/application.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('styles')
    @yield('after_scripts')
    @if ('addinfo' != \Route::current()->getName())
        @php session()->forget('able_registry'); @endphp
    @endif
    
    <style>
        .table > thead > tr > th{
            font-weight:bolder !important;
            font-size:15px;
            text-align:center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
        }
        .table > > tbody > tr > td{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
        }
    </style>
    
</head>
<body>
{{--@include('components.loader')--}}
<div id="app">
    @auth
        @include('components.sectionbar.css')
        @include('components.navbar-top')
    @endauth
    @yield('content')
</div>
@stack('modalAppend')
@auth
    <script src="{{asset('additional/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('additional/select4.2/select2.min.js')}}"></script>
    <script>
        $(function () {
            $(".select2").select2();
            //if ($.session.get("full_screen") === true)
            // full();
            @if (Route::current()->getName() != 'attendance.index' && session('adjustCheckAttendance'))
            $.ajax({
                url: "/adjustAttendance",
                method: "PUT",
                async: false,
                success: function (data) {
                    // console.log(data);
                }
            });
            @endif
        });
        window.addEventListener('load', function () {
            data_table_div("{{(session('localLang') ?? 'en') == 'bn' ? asset('excel/bn.json') : false}}");
        })
    </script>
    <script src="//cdn.ckeditor.com/4.17.2/full/ckeditor.js"></script>
    <style>
        #cke_20,#cke_21,#cke_37,#cke_38,#cke_45,#cke_47,#cke_56,#cke_57,#cke_71,#cke_75,#cke_90,#cke_92{display: none}
    </style>
    {{--
     <div >
                            <p>
                                <a href="#" id="toggle_fullscreen">Toggle Fullscreen</a>
                            </p>
                            I will be fullscreen, yay!
                        </div>
    <script>
        $('#toggle_fullscreen').on('click', function () {
            // if already full screen; exit
            // else go fullscreen
            full();
        });
        function full() {
            if (
                document.fullscreenElement ||
                document.webkitFullscreenElement ||
                document.mozFullScreenElement ||
                document.msFullscreenElement
            ) {
                $.session.set("full_screen", false);
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            } else {
                $.session.set("full_screen", true);
                element = $('#html').get(0);
                if (element.requestFullscreen) {
                    element.requestFullscreen();
                } else if (element.mozRequestFullScreen) {
                    element.mozRequestFullScreen();
                } else if (element.webkitRequestFullscreen) {
                    element.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                } else if (element.msRequestFullscreen) {
                    element.msRequestFullscreen();
                }
            }
        }
    </script>--}}
    @if(session('create_session_now') ||  session('active_session_now'))
        @include('components.session_check_update')
    @endif
    @include('components.expired_check_update')
@endif
@include('sweetalert::alert')
@stack('script')
</body>
</html>
