@extends('layouts.app')
@section('title', __('Salary Payslip'))
@push('styles')
    <style>

        .panel-body{
            margin: 0 80px;

        }


        a.help-block {
            text-decoration: none!important;
            font-size: 13px!important;
            margin-top: 2px!important;
            margin-bottom: 0px!important;
        }
        a.help-block:hover {
            color: #597ea2!important;
        }
        input:read-only {
            background-color: #ecf0f1 !important;
        }
        #remarks {
            line-height: 28px;
        }
        .table-bordered>tbody>tr>td {
            font-size: 14px!important;
        }
        .branchSmall {
            font-size: 12px!important;
            color: #10598b!important;
            font-weight: 600!important;
            cursor: pointer;
        }
        .v-middle {
            vertical-align: middle!important;
        }
        table.table-bordered.dataTable >tbody>tr>td.dataTables_empty {
            text-align: center!important;
        }
        table.table-bordered.dataTable td:last-child {
            text-align: left!important;
        }
        .f-600 {
            font-weight: 600!important;
        }

        #paySlips .header {
            border: 1px dashed #cccccc;
            width: 100%;
            position: relative;
        }

        #paySlips .wrapper {
            width: 100%;
            position: relative;
            margin: 30px 0;
        }



        #paySlips .namebn, #paySlips .nameen {
            font-size: 27.3px;
            text-align: right;
            font-weight: 600;
            line-height: 20px;
        }
        #paySlips .namebn {
            font-family: 'AdorshoLipi', sans-serif;
            word-spacing: 4px !important;
            margin-bottom: 0px;
            margin-top: 26px;
        }
        #paySlips .namebn > span {
            font-size: 1.5em;
        }
        #paySlips .nameen {
            margin-top: 0px;
            margin-bottom: 0px;
        }
        #paySlips .nameen > span {
            font-size: 1.4em;
        }
        #paySlips .font_14 {
            font-size: 14px;
            margin: 2px 0px;
        }
        #paySlips .font_12 {
            font-size: 12px !important;
            margin-top: 10px !important;
            word-spacing: -1px;
            margin: 2px 0px;
            font-family: sans-serif !important;
            font-weight: 600;
        }
        #paySlips .sans {
            font-family: sans-serif;
            font-size: 12px !important;
            margin: 2px 0px;
            font-weight: 600;
            word-spacing: -2.8px;
        }
        #paySlips .header-header {
            width: 100%;
        }
        #paySlips .lucida {
            font-family:sans-serif;
        }
        #paySlips .clearboth {
            clear: both;
            width: 100%;
        }
        #paySlips .clear15 {
            clear: both;
            height: 15px;
            width: 100%;
        }
        #paySlips .clear35 {
            clear: both;
            height: 35px;
            width: 100%;
        }
        #paySlips .special-box {
            text-transform: uppercase;
            border: 1px solid #cccccc;
            padding: 5px 20px;
            font-weight: 600;
            width: 100%;
            margin: 0px auto;
            color: #000000;
            word-spacing: 3px;
            text-align: center;
        }
        .detailDiv {
            width: 100%;
            margin: 0 auto;
        }
        table.table-borderless > tbody > tr > td,
        table.table-borderless > tbody > tr > th,
        table.table-borderless > tfoot > tr > td,
        table.table-borderless > tfoot > tr > th,
        table.table-borderless > thead > tr > td,
        table.table-borderless > thead > tr > th {
            border: none!important;
        }
        table.table-borderless > tbody > tr > td.td1 {
            width: 20%;
            padding: 2px 0px;

        }
        table.table-borderless > tbody > tr > td.td2 {
            width: 35%;
            border-bottom-style: dotted!important;
            border-bottom-width: .06em!important;
            text-align: right;
            padding: 2px 0px;
        }
        table.table-borderless > tbody > tr > td.td3 {
            width: 20%;
            padding: 2px 0px 2px 20px;
        }
        table.table-borderless > tbody > tr > td.td4 {
            width: 25%;
            border-bottom-style: dotted!important;
            border-bottom-width: .06em!important;
            text-align: right;
            padding: 2px 0px;
        }
        .paydetailDiv {
            width: 100%;
            margin: 0 auto;
        }
        .v-middle {
            vertical-align: middle;
        }
        table.table-borderless > tbody > tr > td.info-bank0, table.table-borderless > tbody > tr > td.info-bank1, table.table-borderless > tbody > tr > td.info-bank2 {
            padding: 0px;
        }
        span.info_border {
            border-bottom: 1px;
            border-bottom-style: dotted!important;
            border-bottom-width: .06em!important;
        }



        @media print {

            /*@page {*/
            /*    size: A4 portrait!important;*/
            /*    margin-top: 0;*/
            /*    margin-bottom: 0;*/
            /*}*/

            @page {
                size: A4 portrait !important;   /* auto is the initial value */
                margin: 0px 50px !important;
            }
            .table > thead > tr.active > th{
                background: #ecf0f1 !important;
            }
            .table > tbody > tr > td{
                padding: 0px 5px 0px 5px!important;
            }
            .wrapper {
                width: 100%;
                position: relative;
                margin: 30px 0;
            }
            .namebn{

                padding-top: 30px !important;
            }
            .nameen {
                font-size: 27.3px;
                text-align: right;
                font-weight: 600;
                line-height: 20px;
            }
            /* #maincon{
                text-align: right;
                font-size: 5px !important;
                margin-top: 20px !important;
                word-spacing: 3px;
                margin: 2px 0px;
                font-family: sans-serif !important;
                font-weight: 600;
            } */

            /* #maincon2{
            font-family: sans-serif;
            font-size: 5px !important;
            margin: 2px 0px;
            font-weight: 600;text-align: right;
            } */
            #saslip{
                 text-transform: uppercase;
                 border: 1px solid #cccccc;
                 padding: 5px 20px;
                 font-weight: 600;
                 width: 100%;
                 margin: 0px auto;
                 color: #000000;
                 word-spacing: 3px;
                 text-align: center;
                margin-top: 50px !important;
                margin-bottom: 25px !important;
             }


            #td1{
                width: 20%;
                padding: 2px 0px;
                font-size: 18px !important;
                line-height: 1.42857143;
                vertical-align: top;

            }
            #td2{
                width: 35%;
                border-bottom-style: dotted !important;
                border-bottom-width: .06em !important;
                text-align: right;
                padding: 2px 0px;
                font-size: 14.5px !important;
                line-height: 1.42857143;
                vertical-align: top;
            }
            #td3{
                width: 20%;
                padding: 2px 0px 2px 20px;
                font-size: 14.5px !important;
                line-height: 1.42857143;
                vertical-align: top;

            }
            #td4{
                width: 25%;
                border-bottom-style: dotted !important;
                border-bottom-width: .06em !important;
                text-align: right;
                padding: 2px 0px;
                line-height: 1.42857143;
                vertical-align: top;
                font-size: 14px !important;
            }

            .paydetailDiv{
                width: 100%;
                margin: 0 auto;

            }
            #detailDiv{
                margin-bottom: 30px !important;
            }
            #earndis1,#earndis2{
                font-size: 14.5px !important;
                padding: 8px !important;
                line-height: 1.42857143;
                background: #ecf0f1 !important;
            }

            #notid{
                font-family: sans-serif;
                font-size: 15.1px !important;
                margin: 10px 0px !important;
                font-weight: 600;
                padding-left:7px ;
            }
            #bankdata1{
                line-height: 1.42857143;
                vertical-align: top;
                font-weight: normal;
                font-size: 14.5px !important;
                margin: 2px 0px !important;
            }
           #bankdata2,#bankdata3{
               line-height: 1.42857143;
               vertical-align: top;
               font-weight: normal;
               font-size: 14px !important;
               text-align: left;
           }






        }

    </style>
{{--    <link rel="stylesheet" href="{{asset('css/payslip.css')}}">--}}
    <link href="https://fonts.maateen.me/adorsho-lipi/font.css" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid" id="body">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.sectionbar.payrolls-bar')
                <div class="panel panel-default pt-0" id="paySlips">
                    <div class="panel-heading" style="padding: 5px 5px 0px 5px;">
                        <ul class="nav nav-tabs" role="tablist" style="margin-bottom:-1px;">
                            <li role="presentation" class="{{$firstSlip->empType == 1 ? 'active':'teacher'}}"><a href="{{ url('payroll/paidlist/1') }}">&nbsp; Teacher &nbsp;</a></li>
                            <li role="presentation" class="{{$firstSlip->empType == 2 ? 'active':'employee'}}"><a href="{{ url('payroll/paidlist/2') }}">&nbsp; Employee &nbsp;</a></li>
                            <li class="pull-right"><a class="bg-info" style="cursor: pointer;" href="{{ url('payroll/paidlist/'.$firstSlip->empType) }}">&nbsp; Back &nbsp;</a></li>
                            <li class="pull-right">
                                <a class="bg-warning" media="print"  style="cursor: pointer;" onclick="myFunction()">&nbsp; Print &nbsp; &nbsp</a>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-body" id="data">
                        <div class="header" id='topsp'>
                            <div class="wrapper">
                                <div class="mydiv" id="datacenter">
                                    <div style="display:flex;">
                                        <div class="logo" id="logodemo" style="text-align: right; width:30%; text-align:right;">
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
                                            <img class="imgpri" id="logo_img" style="width: 25% !important; margin-top: 15px; margin-right:10px;" src="{{$logo}}" alt="Logo">
                                        </div>
                                        <div st class="header-text" style="width:70%;">
                                            @php
                                                $school_name = $firstSlip->school['name'];
                                                $first_value = strtok($school_name," ");
                                                $first_value = transMsgOnline($first_value,'bn');
                                                $second_value = substr(strstr($school_name, " "), 1);
                                            @endphp
                                            <h4 style="color: #079850!important;margin-bottom: 6px; font-size: 20px;text-align: left;" class="namebn">{{$first_value}} ল্যাংগুয়েজ এন্ড
                                                কালচারাল ফাউন্ডেশন</h4>
                                            @php
                                                $school_name = $school_name;
                                                $first_value = strtok($school_name," ");
                                                $second_value = substr(strstr($school_name, " "), 1);
                                            @endphp
                                            <h4 class="nameen" id="schoolEn"  style="font-family: Myriad Pro; word-spacing: 2px; color: #079850 !important; text-align: left; font-size:20px;">
                                                {{$first_value}} {{$second_value}}</h4>
                                            <p id="maincon" class="font_12 " style="text-align:left;">{{$firstSlip->school['address']}} (UEN : TT00SS0212J)</p>
                                            <p id="maincon2" class="sans " style="text-align:left">Tel: {{foqas_setting('phone')}} Email: {{foqas_setting('email')}} Website: www.blcf.sg</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear35"></div>
                                <div class="header-header" >
                                    <p class="font_10 special-box lucida" id="saslip" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Pay Slip</p>
                                </div>
                                <div class="clear35"></div>
                                <div class="detailDiv" >
                                    <table class="table table-borderless" id="detailDiv" style="ffont-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;" >
                                        <tr>
                                            <td class="td1" id="td1">Name <span class="pull-right">:</span></td>
                                            <td class="td2" id="td2" style="font-weight: bolder !important;">{{ $firstSlip->payrollUser->name }}</td>
                                            <td class="td3" id="td3">
                                                &nbsp;&nbsp;{{ $firstSlip->empType == 1 ? ' Dept. & Des.' : 'Designation'}}
                                                <span class="pull-right">:</span>
                                            </td>
                                            <td class="td4" id="td4">
                                                {{ $firstSlip->empType == 1 ? $firstSlip->payrollUser->department->department_name.',': '' }}

                                                {!! !empty($firstSlip->payrollUser->role_title) ? $firstSlip->payrollUser->role_title : "N/A" !!}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="td1" style="font-size: 15px!important;">Month Of <span class="pull-right">:</span></td>
                                            <td class="td2" style="font-size: 12px!important; text-align: center">
                                                {{ date('F, Y',strtotime($firstSlip->payDate)) }}
                                            </td>
                                            <td class="td3" style="font-size: 15px!important;">&nbsp;&nbsp;&nbsp;Branch <span class="pull-right">:</span></td>
                                            <td class="td4" style="font-size: 12px!important;">
                                                {!! isset($firstSlip->payrollUser->employeeDetail->house) ? $firstSlip->payrollUser->employeeDetail->house->name : "N/A" !!}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="clear35"></div>
                                <div class="paydetailDiv">
                                    <table class="table table-bordered" id="dataid" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                        <thead>
                                        <tr class="active">
                                            <th class="text-center" id='earndis1'>Earnings Description</th>
                                            <th class="text-center" id='earndis2'>Amount&nbsp;S$</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $basic = $firstSlip->payScale * $firstSlip->weekNumber;
                                            $extra = $firstSlip->exScale * $firstSlip->exNumber;
                                        @endphp
                                        <tr>
                                            <td>
                                                Basic Salary
                                                <span  class="pull-right">({{ $firstSlip->payScale." * ".$firstSlip->weekNumber }})</span>
                                            </td>
                                            <td><span  class="pull-right" id="basda1">{{ number_format($basic,2) }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Extra {{ $firstSlip->empType == 1 ? 'Classes' : 'Hours'}}
                                                <span class="pull-right">({{ $firstSlip->exScale." * ".$firstSlip->exNumber }})</span>
                                            </td>
                                            <td><span class="pull-right" id="basda2">{{ number_format($extra,2) }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Bonus</td>
                                            <td><span class="pull-right" id="basda3">{{ number_format($firstSlip->bonus,2) }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Arrears</td>
                                            <td><span class="pull-right" id="basda4">{{ number_format($firstSlip->arrears,2) }}</span></td>
                                        </tr>
                                        @if ($firstSlip->arrearsPay > 0)
                                            <tr>
                                                <td>
                                                    Arrears
                                                    <span class="pull-right">({{ number_format($firstSlip->arrears,2) }})</span>
                                                </td>
                                                <td><span class="pull-right" id="basda4">{{ number_format($firstSlip->arrearsPay,2) }}</span></td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>
                                                <strong class="pull-right">
                                                    Net Salary (Current + Arrears)&nbsp;S$ =
                                                </strong>
                                            </td>
                                            <td>
                                                <strong class="pull-right" id="basda6">
                                                    {{ number_format($firstSlip->netPayable,2) }}
                                                </strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong class="pull-right">
                                                    Amount Paid&nbsp;S$ =
                                                </strong>
                                            </td>
                                            <td>
                                                <strong class="pull-right" id="basda5">
                                                    {{ number_format($firstSlip->amountPaid,2) }}
                                                </strong>
                                            </td>
                                        </tr>
                                        @if ($firstSlip->amountDue > 0)
                                            <tr>
                                                <td>
                                                    <strong class="pull-right">
                                                        Amount Due&nbsp;S$ =
                                                    </strong>
                                                </td>
                                                <td>
                                                    <strong class="pull-right">
                                                        {{ number_format($firstSlip->amountDue,2) }}
                                                    </strong>
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    <div class="clearboth"></div>
                                    <div class="" id="" style="font-weight: bold">



                                        In Sum of SG Dollar :
                                        {{convertNumberNEW(number_format($firstSlip->amountPaid,2))}} {{convertdesi(extractFraction($firstSlip->amountPaid)) }}  Only.


{{--                                        {{convertNumber(number_format($firstSlip->amountPaid,2))}}.--}}
                                    </div>
                                    <div class="clear15"></div>
                                    <table class="table table-borderless">
                                        <tbody>
                                        <tr>
                                            <td class="info-bank0" id='bankdata1'>
                                                Dated As: <span class="info_border">{{ $firstSlip->approved }}</span>
                                            </td>
                                            <td class="info-bank1 text-center bankdata" id='bankdata2'>
                                                Bank Name: <span class="info_border">{{ $firstSlip->bank_name }}</span>
                                            </td>
                                            <td class="info-bank2 text-center bankdata" id='bankdata3'>
                                                Account No.: <span class="info_border">{{ $firstSlip->account_no }}</span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="clear15"></div>
                                    <div class="sans" id="mydata">
                                        <i>&nbsp;Notes: {!! !empty($firstSlip->remarks) ? nl2br($firstSlip->remarks) : ' N/A' !!}</i>
                                    </div>
                                    <div class="clear15"></div>
                                    <div class="mt-30">
                                        <div id="myseg" class="pull-left" style="width: 70%; margin-top: 33px !important;">
                                            <div style="clear:both;height:84px;width:100%;"></div>
                                            ----------------------------
                                            <div class="clearfix cb"></div>
                                            <span class="sans">
                                                {!! $firstSlip->empType == 1 ? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Teacher&nbsp;Signature" : "&nbsp;&nbsp;&nbsp;&nbsp;Employee&nbsp;Signature" !!}
                                            </span>
                                        </div>
                                        @php
                                            $headSign = url('img/blcf_stamp.jpg');
                                            if (empty($headSign)){
                                                $pad = 0;
                                            }else{
                                                $pad = '46px';
                                            }
                                        @endphp
                                        <div class="pull-right" align="center" style="width: 30%; margin-top: 25px !important; ">
                                            <img width="40%" src="{{$headSign}}" alt="Head Of the Institute">
                                            <div class="clearfix"></div>
                                            -------------------------
                                            <div class="clearfix cb"></div>
                                            <span class="sans">
                                                @lang('Authorised Signature')
                                                <br>
                                                @lang('For BLCF')
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="clear35"></div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="example" class="table datatable table-bordered table-condensed table-striped table-hover" style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                <thead>
                                <tr class="active">
                                    <th colspan="4" class="text-left f-600 v-middle">
                                        {!! $firstSlip->empType == 1 ? "Teacher Name: " : "Employee Name: " !!}
                                        {{ $firstSlip->payrollUser->name }}
                                    </th>
                                    <th colspan="4" class="text-center f-600 v-middle">
                                        SALARY SLIP
                                    </th>
                                    <th colspan="4" class="text-right v-middle f-600">
                                        Branch: {!! isset($firstSlip->payrollUser->employeeDetail->house) ? strtoupper($firstSlip->payrollUser->employeeDetail->house->name) : "N/A" !!}
                                    </th>
                                </tr>
                                <tr>
                                    <th>@lang('#')</th>
                                    <th>
                                        The Month Of
                                        <hr style='margin: 1px 0px;'>
                                        Approved Date
                                    </th>
                                    <th>
                                        Weekly
                                        <div style="clear: both;"></div>
                                        Scale(S$)
                                    </th>
                                    <th>
                                        Total
                                        <div style="clear: both;"></div>
                                        Weeks
                                    </th>
                                    <th>{!! ($firstSlip->empType == 1 ? 'Rate&nbsp;Per <div style="clear: both;"></div> Ex.&nbsp;Class(S$)' : 'Rate&nbsp;Per <div style="clear: both;"></div> Ex.&nbsp;Hour(S$)') !!}</th>
                                    <th>{!! ($firstSlip->empType == 1 ? 'Total&nbsp;Ex. <div style="clear: both;"></div> Classes' : 'Total&nbsp;Ex. <div style="clear: both;"></div> Hours') !!}</th>
                                    <th>@lang('Arrears')</th>
                                    <th>@lang('Bonus')</th>
                                    <th>
                                        Net
                                        <div style="clear: both;"></div>
                                        Payable&nbsp;(S$)
                                    </th>
                                    <th>
                                        Amount
                                        <div style="clear: both;"></div>
                                        Paid&nbsp;(S$)</th>
                                    <th>
                                        Amount
                                        <div style="clear: both;"></div>
                                        Due&nbsp;(S$)
                                    </th>
                                    <th class="text-left">
                                        Bank&nbsp;Name
                                        <hr style="margin: 1px 0px;">
                                        Account&nbsp;No.
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($allSlips as $key=>$result)
                                    <tr>
                                        <td class="v-middle" scope="row">{{ $key + 1 }}</td>
                                        <td class="v-middle" style="min-width: 150px;padding:0px;">
                                            <a title="View & Print Payslip" style="text-decoration: none;padding:5px 5px 0px 5px;display:block;" href="{{url('payroll/payslip/'.$result->id."-".$result->payrollUser->student_code)}}">
                                                {{ date('F, Y',strtotime($result->payDate)) }}
                                            </a>
                                            <hr style="margin: 1px 0px;border-color:#ddd;">
                                            <a style="text-decoration: none;padding:0px 5px 5px 5px;display:block;" href="{{url('payroll/payslip/'.$result->id."-".$result->payrollUser->student_code)}}" class="branchSmall" title="Approved date of Payroll">
                                                {{ $result->approved }}
                                            </a>
                                        </td>
                                        <td class="v-middle">{{ $result->payScale }}</td>
                                        <td class="v-middle">{{ $result->weekNumber }}</td>
                                        <td class="v-middle">{{ $result->exScale }}</td>
                                        <td class="v-middle">{{ $result->exNumber }}</td>
                                        <td class="text-right v-middle">{{ $result->arrearsPay }}</td>
                                        <td class="text-right v-middle">{{ $result->bonus }}</td>
                                        <td class="text-right v-middle">{{ $result->netPayable }}</td>
                                        <td class="text-right v-middle">{{ $result->amountPaid }}</td>
                                        <td class="text-right v-middle">{{ $result->amountDue }}</td>
                                        <td style="min-width: 200px;">
                                            {{ $result->bank_name }}
                                            <hr style="margin: 1px 0px;">
                                            <small class="branchSmall" title="Account No">
                                                {{ $result->account_no }}
                                            </small>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="text-right f-600" colspan="5"></td>
                                    <td class="text-right f-600" colspan="5"></td>
                                    <td class="text-right f-600">Arrears = </td>
                                    <td class="text-right f-600">S${{ $firstSlip->payrollUser->employeeDetail->arrears }}</td>
                                </tr>
                                </tfoot>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {
                //for data table & sum total
                var table = $('#example').DataTable({
                    'order': [],
                    "footerCallback": function ( row, data, start, end, display ) {
                        var api = this.api(), data;
                        var intVal = function ( i ) {
                            return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0;
                        };

                        var arreapays = api.column( 6 ).data().reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                        var payables = api.column( 8 ).data().reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                        var paid = api.column( 9 ).data().reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                        var arrears = parseFloat(arreapays);
                        var payableTotals = parseFloat(payables);
                        var netvalue = payableTotals - arrears;
                        var netpayable = parseFloat(netvalue).toFixed(2);

                        var paidTotals = parseFloat(paid).toFixed(2);
                        var currency = "S$";

                        $( api.column( 0 ).footer() ).html('Net&nbsp;Payable&nbsp;= '+ currency + ' '+ netpayable);
                        $( api.column( 5 ).footer() ).html('Total&nbsp;Amount&nbsp;Paid&nbsp;= '+ currency + ' '+ paidTotals);
                    },
                    paging: true,
                    autoWidth:true,
                    pageLength: 25,
                    "bDestroy": true
                });
            });


            //print script//

            function myFunction() {
                var body = document.getElementById('body').innerHTML;
                var data = document.getElementById('data').innerHTML;
                document.getElementById('body').innerHTML= data;
                document.getElementById("maincon").style.cssText = `margin-bottom:6px; font-size:11px; word-spacing: 4px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;`;
                document.getElementById("maincon2").style.cssText = `font-size:10px; word-spacing: 5.2px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;`;
                document.getElementById("logo_img").style.cssText = `width: 45% !important; margin-top: 15px; margin-right:10px;`;
                document.getElementById("logodemo").style.cssText = `margin-top:20px; ext-align: right; width:23%; text-align:right;`;
                document.getElementById("schoolEn").style.cssText = `word-spacing: 5px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #079850 !important; text-align: left; font-size:18px; font-weight:500;`;

                window.print();
                document.getElementById('body').innerHTML= body;
            }

        </script>
    @endpush

@endsection
