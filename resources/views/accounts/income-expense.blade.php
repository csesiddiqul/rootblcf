@extends('layouts.app')
@section('title', __('Income & Expense report'))
@section('content')
    <style  media="print">
        .table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
            font-weight: normal;
            font-size: 13.5px;
        }
        h4 {
            font-size: 20px !important;
        }
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .mt-25 {
            margin-top: 25px !important;
        }
        .ml-10 {
            margin-left: 10px !important;
        }
        .mr-10 {
            margin-right: 10px !important;
        }
        .mr-15 {
            margin-right: 15px !important;
        }
        #pd-12 {
            font-size: 18px !important;
        }
        .table-responsive {
            margin-top: 32px;
        }

        .txt {
            display: none;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
        .mt-11 {
            margin-top: 11px;
        }
        .page_br{
            page-break-after: always;
        }
        
        strong {
            font-size: 15px !important;
        }
    </style>

    <div class="container-fluid">
        <div class="row cus_font_fmly" style="font-family: serif;">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Income Expense Reports').'<b>'])
                @include('components.sectionbar.reports-bar')
                <div class="panel-body pl-0 pr-0">
                    <div class="col-md-12">
                        {!! Form::open(array('route' => 'accounts.incomeexpense', 'method' => 'POST', 'role' =>'form','enctype'=>'multipart/form-data', 'class' => 'needs-validation')) !!}
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
                    <div class="clearfix"></div>
                    @if(isset($income))
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
                               style="text-align: center; margin-bottom:8px !important; margin-top:20px; width:100%; font-size: 28px; text-transform: uppercase; border: 1px solid #e9e4e4; "><span class="lucida" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:bold;">@lang('Income Expense Report')</span><br>
                            </p>
                            <div style="text-align: center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                <p style="font-size:18px;">@lang('Financial Year') : {{active_financial_year()->name}}</p>
                                <p style="font-size:14px;">@lang('Date'): @if($from == $to) {{$from}} @else {{$from}} @lang('to') {{$to}} @endif</p>
                            </div>
                            <div class="table-responsive">
                            </div>
                            @php
                                $memsum = 0;
                            @endphp

                            <div class="page_br">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <table class="table table-bordered  table-striped" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;">
                                            <tr>
                                                <th style="font-weight: bold; font-size: 20px!important;" colspan="2" class="text-center">Income</th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <strong>
                                                        Head
                                                    </strong>
                                                </th>
                                                <th style="text-align: right;">
                                                    <strong>
                                                        Amount (S$)
                                                    </strong>
                                                </th>
                                            </tr>

                                            @php $totalIncome = 0;$totalExpense  = 0; $totalincomepay  = 0; @endphp
                                            @foreach($income as $key => $r)
                                                @php
                                                    $totalIncome += $r->amount??0;
                                                @endphp
                                                @if($r->amount > 0)
                                                    <tr>
                                                        <td>@if($r->amount > 0){{$r->name}}@endif</td>
                                                        <td><span class="pull-right">
                                                            @if($r->amount > 0){{number_format($r["amount"]??0,2)}}@endif
                                                        </span>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            @foreach($incomepey as $myid=> $exdate )
                                                <tr>
                                                    @php
                                                        if(count($incomepey) > $myid){
                                                        $totalincomepay  += $expense[$myid]->incomeAmount??0;
                                                        }
                                                    @endphp
                                                    <td>{{$incomepey[$myid]->name}}</td>
                                                    <td>
                                                        <span class="pull-right">{{number_format($incomepey[$myid]->incomeAmount??0 ,2)}}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            
                                            @php 
                                                $expensedata =  count($expense) - count($income)
                                            @endphp
                                            @php
                                                $expensedatas =  count($expense)
                                            @endphp

                                            @for ($i = 1; $i < $expensedata; $i++)
                                                <tr>
                                                    <td id="removetr" style="padding:18px; border:1px solid #fff;background: #fff;"></td>
                                                    <td id="removetr" style="padding:18px; border:1px solid #fff;background: #fff;"></td>
                                                </tr>
                                            @endfor

                                            @php
                                               $incomesum = $incomepey->sum('incomeAmount')
                                            @endphp
                                        </table>
                                    </div>

                                    <div class="col-xs-6" >
                                        <div id="sidePrb">
                                            <table class="table table-bordered  table-striped" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;">
                                                <tr>
                                                    <th style="font-weight: bold; font-size: 20px!important;"  colspan="2" class="text-center">Expense</th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        <strong>Head</strong>
                                                    </th>
                                                    <th style="text-align: right;">
                                                        <strong>Amount (S$)</strong>
                                                    </th>
                                                </tr>
                                                @foreach($expense as $myid=> $exdate )
                                                    <tr>
                                                        @php
                                                            if(count($expense) > $myid){
                                                            $totalExpense += $expense[$myid]->expensesAmount??0;
                                                            }
                                                        @endphp
                                                        <td>{{$expense[$myid]->name}}</td>
                                                        <td>
                                                            <span class="pull-right">{{number_format($expense[$myid]->expensesAmount??0 ,2)}}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6" >
                                        <div class="">
                                            <table class="table table-bordered  table-striped" style="margin-top:5px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;">
                                                <tr>
                                                    <th>
                                                        <strong>
                                                            @lang('Total')
                                                        </strong>
                                                    </th>
                                                    <th>
                                                        <span class="pull-right"><b>S$ {{number_format($totalIncome + $memsum + $incomesum,2)}}</b></span>
                                                    </th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-xs-6" >
                                        <div class="">
                                            <table class="table table-bordered  table-striped" style="margin-top:5px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;">
                                                <tr>
                                                    <th>
                                                        <strong>
                                                            @lang('Total')
                                                        </strong>
                                                    </th>
                                                    <th>
                                                        <span class="pull-right"><b>S$ {{number_format($totalExpense,2)}}</b></span>
                                                    </th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12" >
                                        <table class="table table-bordered  table-striped" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;">
                                            <tr>
                                                <td><b>@lang('Profit / Loss')</b></td>
                                                <td colspan="3">
                                                <span class="pull-right">
                                                    <b>
                                                        @if(number_format($totalIncome+$memsum+$incomesum-$totalExpense ,2) == 0)
                                                            {{number_format($totalIncome+$memsum+$incomesum-$totalExpense,2)}}
                                                        @elseif(number_format($totalIncome+$memsum+$incomesum-$totalExpense,2) < 0)
                                                            <p style="color: red">S$ {{number_format($totalIncome+$memsum+$incomesum-$totalExpense,2)}}</p>
                                                        @else
                                                            <p style="color: green">S${{number_format($totalIncome+$memsum+$incomesum-$totalExpense,2)}}</p>
                                                        @endif
                                                    </b>
                                                </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="page_br">
                                <div class="starbl-closebl" style="width: 100%;  margin-bottom: -30px;">
                                    <div class=""  style="width: 100%;">
                                        <div class="col-xs-6"  style="width: 50%;">
                                            <div style="width: 100%;">
                                                <hr>
                                                <h5 class="border" style="font-size: 15px;color:#444;font-weight:bold;padding-left:3px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;">Account Opening Balance </h5>
                                                <table class="table table-bordered  table-striped" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;">
                                                    <tr>
                                                        <th style="font-weight: bold;">Account Name</th>
                                                        <th style="font-weight: bold;">Balance</th>
                                                        <th style="font-weight: bold; width:120px;">Date</th>
                                                    </tr>
                                                    <tr>
                                                    @php
                                                        $x = 0;
                                                        $y = 0;
                                                    @endphp

                                                    @foreach($ledgers as $key => $value)
                                                        @if(!empty($key))
                                                        @endif
                                                        @foreach($value as $ledger)

                                                            <tr style="display: none !important;">
                                                                @php
                                                                        $ledger->payment->sum('waiver');
                                                                        $creditT = $ledger->payment->sum('total') -  $ledger->payment->sum('waiver');
                                                                        $incomep = $ledger->income->sum('amount');
                                                                        $debit = $ledger->expense->sum('amount');
                                                                        $credit = $creditT+$incomep  - $debit ;
                                                                        $cretre = 0;
                                                                        $devtre = 0;

                                                                @endphp
                                                            </tr>


                                                            <tr>
                                                                <td style="width:230px;">
                                                                  
                                                                    {{$ledger->name}}
                                                                </td>
                                                                <td class="" style="text-align: right;">
                                                                    @foreach($internalTransfersCr  as $trdata)
                                                                        @php
                                                                            if ($ledger->id == $trdata->ledger_id_credit){
                                                                               $cretre =   $trdata->amountc;
                                                                            }
                                                                        @endphp
                                                                    @endforeach

                                                                    @foreach($internalTransfersDa  as $trdatada)
                                                                            @php
                                                                                if ($ledger->id == $trdatada->ledger_id_david){
                                                                                   $devtre =   $trdatada->amountd;
                                                                                }
                                                                            @endphp
                                                                    @endforeach

                                                                    {{number_format($ledger->current_balance-$credit-$memsum+$cretre-$devtre,2)}}

                                                                 </td>
                                                                 <td>{{date('d-M-Y',strtotime($ledger->created_at))}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="display: none !important;">
                                                                    @php
                                                                        if (isset($ledger->current_balance)){
                                                                              $y += $ledger->current_balance-$credit-$memsum+$cretre-$devtre;
                                                                        }
                                                                    @endphp
                                                                </td>
                                                            </tr>

                                                            @endforeach

                                                            @endforeach
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2">
                                                                    <strong>  Opening Balance (Cash / Bank): <span style="float: right">{{number_format($y,2)}}</span></strong>
                                                                </td>
                                                                <td>{{date('d-M-Y',strtotime($ledger->created_at))}}</td>
                                                            </tr>
                                                </table>
                                            </div>
                                        </div>


                                        <div class="col-xs-6"  style="width: 50%;">
                                            <div style="width: 100%; font-size:13px;">
                                                <hr>
                                                <h5 class="border" style="font-size: 15px; word-spacing: 3px; color:#444;font-weight:bold;padding-left:3px;">Account  Current  Balance</h5>
                                                <table class="table table-bordered  table-striped" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;">
                                                    <tr>
                                                        <th style="font-weight: bold;">Account Name</th>
{{--                                                        <th style="font-weight: bold;">Payment </th>--}}
{{--                                                        <th style="font-weight: bold;">Income </th>--}}
{{--                                                        <th style="font-weight: bold;">Expense</th>--}}
                                                        <th style="font-weight: bold;">Balance</th>
                                                        <th style="font-weight: bold;">Date</th>
                                                    </tr>
                                                    @php
                                                        $todaycrrentbl = 0;
                                                    @endphp
                                                    @foreach($allIncPayEx as $demo)
                                                        <tr>
                                                            <td style="width:230px;">
                                                                {{$demo->name}}
{{--                                                                {{$demo->payment->sum('waiver')}}--}}
                                                            </td>

                                                            <td style="display: none">
                                                                    <?php
                                                                    $waiverPay = 0;
                                                                    foreach($demo->payment as $waiverData){
                                                                        $waiverPay = $waiverPay + $waiverData->waiver;
                                                                    }
                                                                    echo $waiverPay;
                                                                    ?>
                                                            </td>

                                                            <td style="display: none">
                                                                    <?php
                                                                    $allexin = 0;
                                                                    foreach($demo->payment as $expay){
                                                                        $allexin = $allexin + $expay->total;
                                                                    }
                                                                    echo $allexin;
                                                                    ?>
                                                            </td>
                                                            <td style="display: none">
                                                                    <?php
                                                                    $allin = 0;
                                                                    foreach($demo->income as $einc){
                                                                        $allin = $allin + $einc->amount;
                                                                    }
                                                                    echo $allin;
                                                                    ?>
                                                            </td>
                                                            <td style="display: none">
                                                                    <?php
                                                                    $allex= 0;foreach($demo->expense as $ex){
                                                                    $allex = $allex + $ex->amount;
                                                                }echo $allex;
                                                                    ?>
                                                            </td>

                                                            <td>

                                                                @foreach($ledgers as $key => $value)
                                                                @if(!empty($key))
                                                                @endif
                                                                @foreach($value as $ledger)
                                                                    @php
                                                                        $ledger->payment->sum('waiver');
                                                                        $creditT = $ledger->payment->sum('total') -  $ledger->payment->sum('waiver');
                                                                        $incomep = $ledger->income->sum('amount');
                                                                        $debit = $ledger->expense->sum('amount');
                                                                        $credit = $creditT+$incomep  - $debit ;
                                                                        $cretredd=0;
                                                                        $devtredd =0;
                                                                    @endphp
                                                                            @if($demo->id == $ledger->id)

                                                                            @if($demo->id == 1)
                                                                                    <?php
                                                                                    $cretredd = 0; ?>
                                                                            @endif
                                                                            @if($demo->id == 5)
                                                                                    <?php
                                                                                    $devtredd = 0; ?>
                                                                            @endif
                                                                                {{number_format($serctotal = $allexin + $allin-$allex+$ledger->current_balance-$credit-$memsum-$cretredd+$devtredd -  $ledger->payment->sum('waiver'),2)}}
                                                                                <?php
                                                                                if (isset($serctotal)){
                                                                                    $todaycrrentbl += $serctotal;
                                                                                }
                                                                                ?>
                                                                            @endif
                                                                    @endforeach
                                                                    @endforeach

                                                            </td>

                                                            <td>
                                                                @if($to) {{date('d-M-Y',strtotime($to))}} @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="1">
                                                            <strong>  Current Balance (Cash / Bank):</strong>
                                                        </td>
                                                        <td style="text-align: right;">
                                                            <strong>{{number_format($todaycrrentbl,2)}}</strong>
                                                        </td>
                                                        <td>@if($to) {{$to}} @endif</td>
                                                    </tr>

                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>

                            <div class="page_br">
                                <div class="cusfont">
                                    <div class="col-xs-12">
                                        <h3 class="bordern text-center " style=" width:100%; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;">
                                            <span style="font-weight: bold">Balance Sheet  as of </span>
                                            @if($from == $to) {{$from}} @else {{$from}} @lang('to') {{$to}} @endif</h3>
                                    </div>
                                    <div class="col-xs-6">
                                        <table class="table table-bordered  table-striped" style="margin-top:30px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;">
                                            <tr>
                                                <th> <strong>Liabilities</strong></th>
                                                <th><strong class="pull-right">-</strong></th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Opening Balance
                                                </td>

                                                <td>
                                                    <span class="pull-right font-13">
                                                         {{number_format( $y ,2)}}
                                                    </span>

                                                </td>
                                            </tr>

                                            <tr>
                                                <th>
                                                    <strong>
                                                        Profit / Loss
                                                    </strong>
                                                </th>

                                                <th>
                                                    <strong class="pull-right">
                                                        <b>
                                                            @if(number_format($totalIncome+$memsum+$incomesum-$totalExpense ,2) == 0)
                                                                {{number_format($totalIncome+$memsum+$incomesum-$totalExpense,2)}}
                                                            @elseif(number_format($totalIncome+$memsum+$incomesum-$totalExpense,2) < 0)
                                                                <span style="color: red"> {{number_format($totalIncome+$memsum+$incomesum-$totalExpense,2)}}</span>
                                                            @else
                                                                <span style="color: green"> {{number_format($totalIncome+$memsum+$incomesum-$totalExpense,2)}}</span>
                                                            @endif
                                                        </b>
                                                    </strong>
                                                </th>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="col-xs-6">
                                        <div class="">
                                            <table class="table table-bordered  table-striped" style="margin-top:30px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;">
                                                <tr>
                                                    <th> <strong>Assets</strong></th>
                                                    <th><strong class="pull-right">-</strong>
                                                    </th>
                                                </tr>

                                                @php
                                                    $todaycrrentbl = 0;
                                                @endphp
                                                @foreach($allIncPayEx as $demo)
                                                    <tr>
                                                        <td style="width:230px;">
                                                            {{$demo->name}}
                                                        </td>
                                                        <td style="display:none">
                                                                <?php
                                                                $allexin = 0;
                                                                foreach($demo->payment as $expay){
                                                                    $allexin = $allexin + $expay->total;
                                                                }
                                                                echo $allexin;
                                                                ?>
                                                        </td>
                                                        <td style="display:none">
                                                                <?php
                                                                $allin = 0;
                                                                foreach($demo->income as $einc){
                                                                    $allin = $allin + $einc->amount;
                                                                }
                                                                echo $allin;
                                                                ?>
                                                        </td>
                                                        <td style="display:none">
                                                                <?php
                                                                $allex= 0;foreach($demo->expense as $ex){
                                                                $allex = $allex + $ex->amount;
                                                            }echo $allex;
                                                                ?>
                                                        </td>
                                                        <td>

                                                            @foreach($ledgers as $key => $value)
                                                                @if(!empty($key))
                                                                @endif
                                                                @foreach($value as $ledger)
                                                                    @php
                                                                        $ledger->payment->sum('waiver');
                                                                        $creditT = $ledger->payment->sum('total') -  $ledger->payment->sum('waiver');
                                                                        $incomep = $ledger->income->sum('amount');
                                                                        $debit = $ledger->expense->sum('amount');
                                                                        $credit = $creditT+$incomep  - $debit ;
                                                                    @endphp
                                                                    @if($demo->id == $ledger->id)
                                                                        <span style="float:right">{{number_format($serctotal = $allexin + $allin-$allex+$ledger->current_balance-$credit-$memsum- $ledger->payment->sum('waiver'),2)}}</span>
                                                                            <?php
                                                                            if (isset($serctotal)){
                                                                                $todaycrrentbl += $serctotal;
                                                                            }
                                                                            ?>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach



                                                        </td>
                                                        <td style="display:none">
                                                            @if($to) {{$to}} @endif
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                @foreach($payresives as $payresive)
                                                    <tr>
                                                        <td><strong style="font-weight: normal;">{{$payresive->name}}</strong></td>
                                                        <td><strong class="pull-right" style="font-weight: normal;">{{$payresive->amount}} </strong></td>
                                                    </tr>
                                                @endforeach
                                            </table>

                                        </div>
                                    </div>


                                    <div class="col-xs-6" >
                                        <div class="">
                                            <table class="table table-bordered  table-striped" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;">
                                                <tr>
                                                    <th>
                                                        <strong>
                                                            @lang('Total')
                                                        </strong>
                                                    </th>

                                                    <th>
                                                        <span class="pull-right"><b>
                                                            S$ {{number_format($y + $totalIncome+$memsum+$incomesum-$totalExpense ,2)}}</b></span>
                                                    </th>
                                                </tr>
                                            </table>

                                        </div>
                                    </div>
                                    <div class="col-xs-6" >
                                        <div class="">
                                            <table class="table table-bordered  table-striped" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;">
                                                <tr>
                                                    <th>
                                                        <strong>
                                                            @lang('Total')
                                                        </strong>
                                                    </th>

                                                    @php
                                                        $noteblance = $payresives->sum('amount');
                                                    @endphp


                                                    <th>
                                                        <span class="pull-right"><b>S$  {{number_format($todaycrrentbl+$noteblance ,2)}} </b></span>
                                                    </th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div style=" font-weight:bold; text-align: justify; width:45%; float: left; margin-top: -15px; margin-left:15px;">
                                        <p >  {!! $setnotes->notes !!}</p>
                                    </div>
                                    <div style="margin-top: 150px; text-align: center; width:50%; float: left;">
                                        <p>________________________________</p>
                                        <strong>{{$setnotes->treasurer}}<br>Treasurer</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="page_br">
                                <div style="margin-left:15px; margin-top:80px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;">
                                    <div style="margin-top: 30px; font-weight:normal; text-align: justify; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;">
                                        <div style="width: 100%; text-align:center; display:inline-block">
                                            <h3  style="font-weight:bold;">Auditor's Report</h3>
                                        </div>
                                        <div style="margin-top: 15px;"> {!! $setnotes->auditors_report !!}</div>

                                        <table width="100%" style="margin-top: 200px ;font-size: 14px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;">
                                            <tr style="color: #5f6368;">
                                                <th style="text-align: center">

                                                    <p>________________________________</p>
                                                    <p>{{$setnotes->auditor1st}}<br>Hon.Auditor </p>

                                                </th>
                                                <th style="text-align: center">
                                                    <p>________________________________</p>
                                                    <p>{{$setnotes->auditor2st}} <br>
                                                        Hon.Auditor
                                                    </p>
                                                </th>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearhight50"></div>
                        <div class="d-print-block d-none ">
                            <div class="pull-left mt-50 ml-10" align="center">
                                ----------------------
                                <div class="clearfix"></div>
                                <span class="border_dot">
                                            @lang('Cashier')
                                        </span>
                            </div>
                            <div class="pull-right mt-25 mr-10" align="center">
                                ----------------------
                                <div class="clearfix"></div>
                                <span class="border_dot">
                                            @lang('Authorised Signature')
                                        </span>
                            </div>
                        </div>

                        <!-- =================== Print End Part =============================-->

                        <div class="clearhight50"></div>
                        <div class="mt-30 special-box-develop"
                             style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:15px; text-align: left !important; margin-top: 30px; margin-left: 30px;  width: 90%;  border: 1px solid #e9e4e4; ">
{{--                            <p>Developed by:  IPSITA COMPUTERS PTE LTD <!--{{reseller()->name}}-->.</p>--}}
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

        // function printDiv() {
        //     window.print();
        //     var printcontent = document.getElementById().innerHTML;
        //     var originalContent = document.body.innerHTML;
        //     document.body.innerHTML = printcontent;
        //     window.print();
        //     document.body.innerHTML = originalContent;
        // }




        function printDiv() {

            currentDateTime("printTime");
            var divToPrint = document.getElementById('forPrint');
            var newWin = window.open('', 'Print-Window');
            document.getElementById("schoolengName").style.cssText = `font-family: Myriad Pro;  margin-bottom:6px;  margin-top:3px; color: #079850 !important; font-size:18px; word-spacing: -0.6px !important;`;
            document.getElementById("maincon").style.cssText = `margin-bottom:6px; font-size:11px; word-spacing: -3px;`;
            document.getElementById("maincon2").style.cssText = `font-size:10px; word-spacing: -4.5px;`;
            newWin.document.open();
            newWin.document.write('<html><title>Income Expense Report</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>@page{size:A4 landscape;} @media print {a[href]:after {content: " (" attr(href) ")";}} body{padding:30px; font-size:10px; }#pd-12{padding: 12px;font-size: 18px}#removetr{padding:18px !important; border:1px solid #fff !important; background: #fff !important;}.page_br{page-break-after: always;}.starbl-closebl{width:88%;}.clearhight50{clear:both;height:50px}.table-responsive{margin-top: 32px;}caption{display:none;}.txt{display:none;}</style>' + divToPrint.innerHTML + '</body></html>');
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

        // jQuery(document).bind("keyup keydown", function(e){
        //     if(e.ctrlKey && e.keyCode == 80){
        //     printPageCounter();
        //     }
        // });
    </script>

    <script src="{{ asset('js/export2.js') }}"></script>
    <script>

        function Export() {
            $("#tbl").table2excel({
                filename: "Table.xls"
            });
        }



        // window.onload = function() {
        //     document.getElementById("optotal").onchange = function() {
        //         console.log(this.value);
        //     }
        //
        //
        // }



        $(function () {
            var tables = $("#tbl").tableExport({
                bootstrap: true,
                headings: true,
                footers: true,
                formats: ["xlsx", "xls", "csv", "txt"],
                fileName: "MyExcel",
                position: "top",
                ignoreRows: null,
                ignoreCols: null,
                ignoreCSS: ".tableexport-ignore",
                emptyCSS: ".tableexport-empty",
                trimWhitespace: false
            });
        });
    </script>

@endpush
