@extends('public.layout.public',['title' => transMsg($verifyMenu->name) ])
@section('sliderText')
    <h1 class="page-title">{{transMsg($verifyMenu->name)}}</h1>
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Schoolbell"/>
    <style>
        h3.sufya {
            font-family: Schoolbell;
            text-align: center;
            color: #000;
            font-size: 30px;
            letter-spacing: -0.01em;
            line-height: 28px;
            font-weight: 600;
            padding-top: 25px;
        }

        .verifypanel {
            margin-top: 100px;
            @if(!isset($admission))
                               padding: 0;
            box-shadow: -3px 3px 7px 6px #eee;
        @endif


        }

        .table td, .table th {
            padding: 1px !important;
        }

        .main-body strong {
            width: 40px;
        }

        .stripe-button-el span, .stripe-button-el {
            color: #fff;
            background: #28a745 !important;
            border-color: #28a745;
        }

        .stripe-button-el:active {
            color: #fff;
            background: #1a8e34 !important;
        }

        .stripe-button-el:focus {
            border-color: #28a745;
            outline: none;
        }

        #sslczPayBtn {
            height: 34px !important;
            width: 130px !important;
        }

        @media print {
            .full-width-header, .rs-breadcrumbs, .rs-footer, .btn-group {
                display: none;
            }

            .verifypanel {
                width: 100%;
            }

            .badge {
                border: none;
                color: #505050;
            }

            .table tr td:first-child {
                width: 50% !important;
            }
        }
    </style>
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <div class="container-fluid" id="table-content">
        <div align="center" class="d-print-block d-none">
            <h3>{{school('name')}}</h3>
            <h5>{{school('address')}}</h5>
            <div class="clearhight50"></div>
        </div>
        <div class="row">
            <div class="verifypanel col-lg-4 col-md-6 col-8 offset-lg-4 offset-md-3 offset-2">
                @if(foqas_setting('admission_verify') == 1)
                    @isset($admission)
                        <fieldset class="scheduler-border">
                            <legend class="scheduler-border">@lang('Admission Student Info')</legend>
                            <div class="main-body">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td width="{{localLang()=='bn' ? '45':'35'}}%"><b>@lang('Roll')</b></td>
                                        <td>
                                            <spna>:</spna>
                                        </td>
                                        <td>{{$admission->roll}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>
                                                @if (getCountryName($admission->country, false)->code == 'BD')
                                                @lang('Admission In')
                                                @else
                                                @lang('Enroll In')
                                                @endif
                                            </b></td>
                                        <td>
                                            <spna>:</spna>
                                        </td>
                                        <td>{{admissionClass()[$admission->section_id]??'N/A'}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>@lang('Name')</b></td>
                                        <td>
                                            <spna>:</spna>
                                        </td>
                                        <td>{{$admission->name}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>@lang('Father Name')</b></td>
                                        <td>
                                            <spna>:</spna>
                                        </td>
                                        <td>{{$admission->father_name}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>@lang('Date of Brith')</b></td>
                                        <td>
                                            <spna>:</spna>
                                        </td>
                                        <td>{{$admission->dob}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>@lang('Status')</b></td>
                                        <td>
                                            <spna>:</spna>
                                        </td>
                                        <td>
                                            @isset($admission->admissionPayment->trans_status)
                                                @switch($admission->admissionPayment->trans_status)
                                                    @case('Paid')
                                                    <span class="badge badge-success">{{transMsg('Paid')}}</span>
                                                    @break
                                                    @default
                                                    <span class="badge badge-danger">{{transMsg('Unpaid')}}</span>
                                                @endswitch
                                            @else
                                                @isset($admission->status)
                                                    <span class="badge badge-{{$admission->status ==4 ? 'success' : 'danger'}}">{{admissionstatus($admission->status)}}</span>
                                                @endisset
                                            @endisset
                                        </td>
                                    </tr>
                                    @if($admission->status == 4)
                                        @isset($admission->admissionPayment->card_type)
                                            <tr>
                                                <td><b>@lang('Payment Method')</b></td>
                                                <td>
                                                    <spna>:</spna>
                                                </td>
                                                <td>
                                                    @switch($admission->admissionPayment->card_type)
                                                        @case('BKASH-BKash')
                                                        @lang('Bkash')
                                                        @break
                                                        @case('DBBLMOBILEB-Dbbl Mobile Banking')
                                                        @lang('DBBL Mobile Banking')
                                                        @break
                                                        @default
                                                        {{$admission->admissionPayment->card_type}}
                                                    @endswitch
                                                </td>
                                            </tr>
                                        @endisset
                                        @isset($admission->admissionPayment->trans_number)
                                            <tr>
                                                <td><b>@lang('Transaction ID')</b></td>
                                                <td>
                                                    <spna>:</spna>
                                                </td>
                                                <td>
                                                    {{$admission->admissionPayment->trans_number}}
                                                </td>
                                            </tr>
                                        @endisset
                                        @isset($admission->admissionPayment->trans_date)
                                            <tr>
                                                <td><b>@lang('Transaction Date')</b></td>
                                                <td>
                                                    <spna>:</spna>
                                                </td>
                                                <td>
                                                    {{$admission->admissionPayment->trans_date}}
                                                </td>
                                            </tr>
                                        @endisset
                                    @endif
                                    @if($admission->status == 5 && foqas_setting('add_payment_status') == 1)
                                        @php
                                            $admission_amount = $admission->section->add_amount;
                                             if (foqas_setting('add_amount_charge') == 1) {
                                                 //  charge create with amount
                                                  if (getCountryName($admission->country, false)->code == 'BD'){
                                                        $amount = ssl_bd_amount($admission_amount);
                                                    }else{
                                                         $amount = stripe_amount($admission_amount);
                                                    }
                                             }else{
                                                 $amount = $admission_amount;
                                             }
                                        @endphp
                                        <tr>
                                            <td><b>@lang('Amount')</b></td>
                                            <td>
                                                <spna>:</spna>
                                            </td>
                                            <td>{{transMsg($amount)}}{{getCountryName($admission->country, false)->currency == 'BDT' ? 'Tk' : '$'}}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                                <div class="btn-group">
                                    <a href="{{route('verify.admission')}}"
                                       class="btn btn-primary btn-sm sinBtn d-print-none">@lang('Verify Another')</a>
                                    @if($admission->status == 5 && foqas_setting('add_payment_status') == 1)
                                        @php($roll =  base64_encode(base64_encode($admission->roll)).base64_encode(date('Y')))
                                        @if (getCountryName($admission->country, false)->code == 'BD')
                                            {{--        <a href="{{route('payment.admission',$roll)}}"
                                                 class="ml-3 btn btn-success btn-sm sinBtn">@lang('Pay Now')</a>--}}
                                                <button class="ml-3 btn btn-primary btn-sm sinBtn d-print-none"
                                                          id="sslczPayBtn"
                                                          token="{{csrf_token()}}" postdata="" order="{{$roll}}"
                                                          endpoint="{{route('admission.paynow',$roll)}}"> @lang('Pay Now')
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
                                        @else
                                            @push('styles')
                                                <script src="https://js.stripe.com/v3/"></script>
                                            @endpush
                                            &nbsp; &nbsp;
                                            {!! Form::open(array('route' =>['admission_payment.stripe',$roll],'method' =>'POST','role' =>'form','autocomplete'=>'off','class'=>'form','id'=>'chargeform')) !!}
                                            <script
                                                    src="https://checkout.stripe.com/checkout.js"
                                                    class="stripe-button d-print-none"
                                                    data-key="{{stripe_secretKey()}}"
                                                    data-currency="usd"
                                                    data-name="{{$admission->name}}"
                                                    data-email="{{$admission->email}}"
                                                    data-allow-remember-me="true"
                                                    data-description="Online Payment"
                                                    data-image="https://www.foqas.com/img/title_icon.png"
                                                    data-locale="auto"
                                                    data-panel-label="Payment Submit"
                                                    data-label="Pay Now"
                                                    data-zip-code="true">
                                            </script>
                                            {!! Form::close() !!}
                                        @endif
                                    @endif
                                    @if($admission->status == 4 && foqas_setting('admit_card') == 1)
                                        <a href="{{route('admitcard.view')}}"
                                           class="ml-3 btn btn-success btn-sm sinBtn d-print-none">@lang('Download Admitcard')</a>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                    @else
                        <form method="POST" action="{{route('verify.admission')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <h3 class="sufya text-center"> {{transMsg($verifyMenu->name)}}</h3>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="roll">@lang('Admission Roll')</label>
                                        <input type="text" name="roll" value="{{old('roll')}}" required
                                               class="form-control {{ $errors->has('roll') ? ' has-error' : '' }}"
                                               id="roll"
                                               placeholder="@lang('Enter Admission Roll')">
                                        @error('roll')
                                        <span class="help-block">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12" align="center">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary sinBtn"> @lang('Verify')</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endisset
                @else
                    @lang('Admission verify not published yet')
                @endif
            </div>
        </div>
        <div class="clearhight50"></div>
        @php($school = \App\School::find(school('id')))
        <div align="center" class="d-print-block d-none">Developed by : {{$school->reseller->name}}</div>
    </div>
    @push('script')
        <script>
            function printDiv() {
                var divToPrint = document.getElementById('table-content');
                var newWin = window.open('', 'Print-Window');
                newWin.document.open();
                newWin.document.write('<html><title>@lang("Verify Admission")</title><body onload="window.print()"><style>#btnPrint{display:none}.d-print-none{display:none}.badge-danger {color: #fff;background-color: #dc3545;}.badge {display: inline-block;padding: 0.25em 0.4em;font-size: 75%;font-weight: 700;line-height: 1;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: 0.25rem;}.badge-success {color: #fff;background-color: #28a745;} </style>' + divToPrint.innerHTML + '</body></html>');
                newWin.document.close();
                setTimeout(function () {
                    newWin.close();
                }, 100);
            }

            jQuery(document).bind("keyup keydown", function (e) {
                if (e.ctrlKey && e.keyCode == 80) {
                    printDiv();
                    return false;
                }
            });
        </script>
    @endpush
@endsection
