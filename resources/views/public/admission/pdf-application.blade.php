@extends('public.layout.public')
@section('content')
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <br>
    <br>
    <div class="container">
        <div class="row" id="print-container">
            @include('public.admission.print_element')
        </div>
    </div>
@endsection
