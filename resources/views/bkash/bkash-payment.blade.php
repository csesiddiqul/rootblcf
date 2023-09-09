@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10 " id="main-container">
                <script id="myScript"
                        src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script>
                {{--    This Commented Script for Live Production --}}
                {{--    <script id="myScript"--}}
                {{--            src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>--}}
                <p class="card-text amount">500</p>
                <p class="card-text invoice">25</p>
                <div class="wrapper" style="text-align: center">
                    <button class="btn btn-primary" id="bKash_button">Pay with bKash</button>
                </div>
            </div>
        </div>
    </div>

    @include('bkash.bkash-script')
@endsection