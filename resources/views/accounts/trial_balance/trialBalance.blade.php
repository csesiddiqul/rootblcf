@extends('layouts.app')
@section('title', __('Income & Expense report'))
@section('content')


    <div class="container-fluid">
        <div class="row cus_font_fmly" style="font-family: serif;">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>


            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Income Expense Reports').'<b>'])
                @include('components.sectionbar.accounts-bar')

                <div class="panel-body pl-0 pr-0">
                    <div class="col-md-12">
                        {!! Form::open(array('route' => 'accounts.trial_balance', 'method' => 'POST', 'role' =>'form','enctype'=>'multipart/form-data', 'class' => 'needs-validation')) !!}
                        <div class="form-group col-md-3">
                            <label for="date">@lang('From')</label>
                            {!! Form::text('from', $date ?? date('01-m-Y'), array('id' => 'date', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
                            @error('from')
                            <span class="help-block">
                                <strong>{{ trans($message) }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="date">@lang('To')</label>
                            {!! Form::text('to', $date ?? date('t-m-Y'), array('id' => 'date', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
                            @error('to')
                            <span class="help-block">
                                <strong>{{ trans($message) }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2 mt-28 ">
                            <button type="submit" id="admitButton" class="{{btnClass()}}">
                                @lang('Search')
                            </button>
                        </div>
                        @if (isset($income) && $income->count())
                            <div class="col-md-1 mt-28">
                                <span class="btn btn-default btn-sm" onclick="printDiv('forPrint')">@lang('Print')</span>
                            </div>
                        @endif
                        <div class="clearhight50"></div>
                        {!! Form::close() !!}
                    </div>
                    @if(isset($incomepey))
                        <div class="forSign col-md-12" id="forPrint">
                            <div class="clearfix"></div>
                            <!--============================= Print Start Section ============================== -->
                            <div class="mydiv" id="datacenter" style="text-align:center; display:flex; ">
                                <div class="logo" id="logodemo"  style="text-align:right; width: 37%;">
                                    @if (foqas_setting('logo_type') == 1)
                                        @php $logo = icpl_image(foqas_setting('express')); @endphp
                                        @empty($logo)
                                            @php $logo = 'https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/favicon.png'; @endphp
                                        @else
                                        @endempty
                                    @else
                                        @php $logo = icpl_image(foqas_setting('standard')); @endphp
                                        @empty($logo)
                                            @php $logo = 'https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/icpl.png'; @endphp
                                        @endempty
                                    @endif
                                    <img class="imgpri" style="width: 17% !important; margin-right:10px;" src="{{$logo}}" alt="Logo">
                                </div>
                                <div class="pppttt"  style="text-align:left;">
                                    @php
                                            @endphp
                                    <h4 style="color: #079850!important; margin-bottom:6px;" class="namebn">বাংলাদেশ ল্যাংগুয়েজ এন্ড
                                        কালচারাল ফাউন্ডেশন</h4>

                                    <h4 class="nameen" id="schoolengName"  style="font-family: Myriad Pro;  margin-bottom:6px;  margin-top:3px; color: #079850 !important; font-size:17px; word-spacing: 4px;">
                                        Bangladesh Language and Cultural Foundation
                                    </h4>
                                    <p id="maincon" class="font_12" style="margin-bottom:6px; font-size:11px; word-spacing: -3.8px;">23 Chuan Terrace, Lorong Chuan, Singapore 558491 (UEN : T00SS0212J)</p>
                                    <p id="maincon2" style=" font-size:10px; word-spacing: -2.3px;" class="sans">Tel: {{foqas_setting('phone')}} Email: {{foqas_setting('email')}} Website: www.blcf.sg</p>
                                </div>
                            </div>
                            <div class="clear35"></div>
                            <p id="mymr" class="font_10 special-box-develop lucida"
                               style="text-align: center; margin-bottom:8px !important; margin-top:20px; width:100%; font-size: 28px; text-transform: uppercase; border: 1px solid #e9e4e4; "><span class="lucida" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:bold;">@lang('Trial Balance')</span><br>
                            </p>
                            <div style="text-align: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                <p style="font-size:18px;">@lang('Financial Year') : {{active_financial_year()->name}}</p>
                                {{--            <p style="font-size:14px;">@lang('Date'): @if($from == $to) {{$from}} @else {{$from}} @lang('to') {{$to}} @endif</p>--}}
                            </div>
                            <div class="table-responsive">
                            </div>
                            @php
                                $memsum = 0;
                            @endphp

                            <div class="table-responsive">
                                <table class="table table-bordered  table-striped" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                    <thead>
                                    <tr>
                                        <th>@lang('Account Name')</th>
                                        <th class="text-right">@lang('O/P Balance')</th>
                                        <th class="text-right">@lang('Debit Total')</th>
                                        <th class="text-right">@lang('Credit Total')</th>
                                        <th class="text-right">@lang('C/L Balance')</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($incomes as $allincome)

                                        <tr>
                                            <td>{{$allincome->name}}</td>
                                            <td class="text-right" >{{number_format(0,2)}}</td>
                                            <td class="text-right">{{number_format(0,2)}}</td>
                                            <td class="text-right">{{number_format($allincome->amount,2)}}</td>
                                            <td class="text-right">{{number_format($allincome->amount,2)}}</td>
                                        </tr>

                                    @endforeach

                                    @foreach($incomepey as $allinpay)

                                        <tr>
                                            <td>{{$allinpay->name}}</td>
                                            <td class="text-right">{{number_format(0,2)}}</td>
                                            <td class="text-right">{{number_format(0,2)}}</td>
                                            <td class="text-right">{{$allinpay->incomeAmount}}</td>
                                            <td class="text-right">{{number_format($allinpay->incomeAmount,2)}}</td>
                                        </tr>


                                    @endforeach

                                    @foreach($expense as $allexpense)

                                        <tr>
                                            <td>{{$allexpense->name}}</td>
                                            <td class="text-right">{{number_format(0,2)}}</td>
                                            <td class="text-right">{{number_format($allexpense->expensesAmount,2)}}</td>
                                            <td class="text-right">{{number_format(0,2)}}</td>
                                            <td class="text-right">{{number_format($allexpense->expensesAmount,2)}}</td>
                                        </tr>


                                    @endforeach

                                    @php



                                        $mainincome = $incomes->sum('amount') + $incomepey->sum('incomeAmount');

                                        $mainexpance = $expense->sum('expensesAmount');

                                    @endphp




                                    @php
                                        $myincom = 0;
                                        $mypayment =0;

                                        $myexpane = 0;

                                        $totalIncomeex = 0;

                                    @endphp



                                    @foreach($allIncPayEx as $alldataddd)

                                        @php
                                            $mypayment = $mypayment + $alldataddd->payment->sum('total')
                                        @endphp

                                        @php
                                            $myincom = $myincom + $alldataddd->income->sum('amount')
                                        @endphp

                                        @php
                                            $myexpane = $myexpane + $alldataddd->expense->sum('amount');
                                        @endphp




                                    @endforeach


                                    <h4>

                                        @php
                                            $finalincom =  $myincom + $mypayment;
                                             $trbl =$finalincom - $myexpane;


                                             if ($trbl<0){
                                                   $mytrde = $trbl - $mainexpance;
                                             }

                                             if ($trbl>0){
                                                  $mytrblcr = $trbl + $mainincome;
                                             }



                                        @endphp
                                        Profit / Loss :
                                        {{number_format($trbl,2)}}

                                    </h4>




                                    <tr>
                                        <td style="font-weight: bold;font-size: 18px">Total</td>
                                        <td></td>
                                        @if($trbl<0)
                                            <td class="text-right">{{number_format($mainexpance + $trbl,2)}}</td>
                                        @else
                                            <td class="text-right">{{number_format($mainexpance,2)}}</td>
                                        @endif




                                        @if($trbl>0)
                                            <td class="text-right">{{number_format($mainincome-$trbl,2)}}</td>
                                        @else
                                            <td class="text-right">{{number_format($mainincome,2)}}</td>
                                        @endif



                                        <td class="text-right"></td>
                                    </tr>





                                    </tbody>
                                </table>
                            </div>





                        </div>
                    @endif
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    </div>

@endsection
@push('script')
    <script>
        $(function () {
            $('.datepicker').datepicker({
                format: "dd-mm-yyyy",
                viewMode: "days",
                minViewMode: "days",
                autoclose: true
            });
        });
    </script>
@endpush
