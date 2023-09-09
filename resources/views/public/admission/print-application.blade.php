@extends('public.layout.public',['title' => transMsg('Preview Admission') ])
@section('sliderText')
    <h1 class="page-title">@lang('Preview Admission')</h1>
@endsection
@section('content')
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <br>
    <br>
    <div id="print-container">
        <div class="container">
            <div class="row">
               @include('public.admission.print_element')
            </div>
        </div>
    </div>
    @php session()->forget('applicationVal') @endphp
@endsection
