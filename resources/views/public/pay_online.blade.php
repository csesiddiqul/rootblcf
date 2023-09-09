@extends('public.layout.public',['title' => transMsg($pagesMenu->name) ])
@section('sliderText')
    <h1 class="page-title">{{transMsg($pagesMenu->name)}}</h1>
@endsection
@section('content')
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <style>
        .clearhight25 {
            clear: both;
            height: 25px;
        }
        .col-md-4, .col-md-3 {
            float: left
        }

        #rs-team-2 .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6 !important;
        }

        #rs-team-2 .table td, .table th {
            padding: 0.25rem !important;
        }

        #sslczPayBtn {
            height: 34px !important;
            width: 170px !important;
        }
    </style>
    <div id="rs-team-2" class="rs-team-2 sec-spacer">
        <div class="container">
            <div class="col-lg-12">
                <div class="aos-init aos-animate" data-aos="fade-up">
                    <h3 class="pull-left">@lang('Online Payment')</h3>
                    <div class="clearhight25"></div>
                    <hr>
                    {!! Form::open(['route' => 'pay_online', 'method' => 'post']) !!}
                    <div class="col-md-3">
                        <div class="form-group">
                            @if(school('country')->code =='BD')
                                <label for="section_id">@lang('Class') - @lang('Section')</label>
                            @else
                                <label for="section_id">@lang('Grade') - @lang('Section')</label>
                            @endif
                            {!! Form::select('section_id' , getSectionAndClassPluck(), null, array('id' => 'section_id', 'required','class' => 'form-control select2', 'placeholder' => trans('Choose'))) !!}
                            @error('section_id')
                            <span class="help-block">
                             <strong>{{ $message }}</strong>
                         </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="roll">@lang('Roll')</label>
                            {!! Form::select('roll' ,array(),null , array('id' => 'roll', 'class' => 'form-control','required','placeholder'=>transMsg('Choose'))) !!}
                            @error('roll')
                            <span class="help-block">
                             <strong>{{ $message }}</strong>
                         </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="payment_type">@lang('Payment Type')</label>
                            {!! Form::select('payment_type' ,$payment_types, null, array('id' => 'payment_type', 'class' => 'form-control','required','placeholder'=>transMsg('Choose'))) !!}
                            @error('payment_type')
                            <span class="help-block">
                             <strong>{{ $message }}</strong>
                         </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 mt-3">
                        <div class="form-group mt-3">
                            <button class="btn btnSubmit btn-primary">@lang('Search')</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    {!! Form::close() !!}
                </div>
            </div>
            @if(isset($dues))
                @if($dues->count())
                    <hr>
                    <div class="clearfix"></div>
                    @foreach($dues as $due)
                        <div class="col-md-12">
                            <h3>@lang('Student Dues History')</h3>
                            <table class="table" style="width: {{useragentMobile() ? '100%' : '40%'}};">
                                <tbody>
                                <tr>
                                    <td>@lang('Student Name')</td>
                                    <td>:</td>
                                    <td>{{$due->name}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Student Id')</td>
                                    <td>:</td>
                                    <td>{{$due->student_code}}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Class')</td>
                                    <td>:</td>
                                    <td>{{ \App\Myclass::findOrFail($due->class_id)->name }}</td>
                                </tr>
                                <tr>
                                    <td>@lang('Section')</td>
                                    <td>:</td>
                                    <td>{{\App\Section::findOrFail($due->section_id)->section_number}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        @break($loop->first)
                    @endforeach
                    <div class="clearfix"></div>
                    <div class="col-md-8 table-responsive">
                        {{-- Form::open(['route' => ['payOnlineNow',[$student_code,$payment_type,$section_id]], 'method' => 'post']) --}}
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>@lang('Sl')</th>
                                <th>@lang('Payment type')</th>
                                <th class="text-right">@lang('Payable Amount')
                                    In {{school('country')->code == 'BD' ? 'Tk' :'$'}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total = 0; $ids=array();
                            @endphp
                            @foreach($dues as $due)
                                @php
                                    $total += $due->due;array_push($ids,$due->id);
                                @endphp
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$due->account_sectors}}</td>
                                    <td class="text-right">{{number_format($due->due,2)}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>@lang('Sub Total')</td>
                                <td colspan="2" class="text-right">{{number_format($total,2)}}</td>
                            </tr>
                            @php
                                if (foqas_setting('add_amount_charge') == 1) {
                                    //  charge create with amount
                                     if (school('country')->code == 'BD'){
                                           $amount = ssl_bd_amount($total);
                                       }else{
                                            $amount = stripe_amount($total);
                                       }
                                }else{
                                    $amount = $total;
                                }
                            @endphp
                            <tr>
                                <td>@lang('Online Charge')</td>
                                <td colspan="2" class="text-right">(+) {{number_format($amount-$total,2)}}</td>
                            </tr>
                            <tr>
                                <td>@lang('Grand Total')</td>
                                <td colspan="2" class="text-right">{{number_format($amount,2)}}</td>
                            </tr>
                            </tbody>
                        </table>
                        @php $dues_ids = base64_encode(implode(',',$ids)); @endphp
                        <div class="clearfix"></div>
                        <div class="col-md-3" style="float: right !important;">
                            @if (school('country')->code == 'BD')
                                @if(serverIsLocal() && env('APP_ENV') == 'local')
                                    <form action="{{route('payOnlineNow_hosted',[$student_code,$payment_type,$section_id,$dues_ids])}}"
                                          method="POST">
                                        @csrf
                                        <button class="btn btn-primary btn-sm sinBtn d-print-none" type="submit"
                                                id="sslczPayBtn"> @lang('Proceed to Pay')
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-primary btn-sm sinBtn d-print-none"
                                            id="sslczPayBtn"
                                            token="{{csrf_token()}}" postdata="" order="{{$student_code}}"
                                            endpoint="{{route('payOnlineNow',[$student_code,$payment_type,$section_id,$dues_ids])}}"> @lang('Proceed to Pay')
                                    </button>
                                    @push('script')
                                        <script>
                                            (function (window, document) {
                                                var loader = function () {
                                                    var script = document.createElement("script"),
                                                        tag = document.getElementsByTagName("script")[0];
                                                    @if(env('SANDBOX_MODE'))
                                                        script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
                                                    {{-- NOTE: USE THIS FOR SANDBOX --}}
                                                            @else
                                                        script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
                                                    {{-- NOTE: USE THIS FOR LIVE --}}
                                                    @endif
                                                    tag.parentNode.insertBefore(script, tag);
                                                };
                                                window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
                                            })(window, document);
                                        </script>
                                    @endpush
                                @endif
                            @endif
                        </div>
                    </div>
                @else
                    <alert class="alert alert-info" style="margin-left: 30px">@lang('No Dues found')</alert>
                @endif
            @endif
        </div>
    </div>
@endsection
@push('styles')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endpush
@push('script')
    <script>
        $("#section_id").change(function () {
            let value = $(this).val();
            getAllRoll(value);
        })
        @if($errors->any())
        $(document).ready(function () {
            getAllRoll($("#section_id").val());
        })
        @endif
        function getAllRoll(value) {
            if (value) {
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "/getRollBySection/" + value,
                    async: false,
                    success: function (data) {
                        if (data.status === 200)
                            $('#roll').html(data.students);
                        else
                            console.log('something want wrong!');
                    },
                    error: function (xhr, textStatus, thrownError, jqXHR) {
                    },
                });
            }
        }
    </script>
@endpush
