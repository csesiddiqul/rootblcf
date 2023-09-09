@extends('layouts.app')
@section('title', __('Income List'))
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
          rel="stylesheet">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Transaction').'<b>'])
                @include('components.sectionbar.accounts-bar')
                <div class="panel panel-default ptlb-515">
                    <div class="panel-body plt-07">
                        <div class="page-panel-title" style="font-weight: bold">@lang('Internal Transfer List')
                            <button class="btn btn-xs btn-success pull-right" role="button"  style="margin-left: 10px;" id="btnPrint">
                                <i class="fa fa-print"></i> @lang('Print')
                            </button>
                        </div>
                        <div class="row">
                            <div class="pull-right" style="padding-right: 16px;padding-bottom: 12px; ">
                                <a href="{{ route('accounts.internal_transfer.create') }}" style="z-index: 10;" class="{{btnClass()}}" >Start Transfer</a>
                            </div>
{{--                            <div class="col-md-12">--}}
{{--                                <div style="width:100%; height: 300px;">--}}
{{--                                   --}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="clearheight"></div>
                            <div class="col-md-12">

                                    <div class="table-responsive">
                                        <table class="table table-data-div table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">@lang('Date')</th>
                                                <th scope="col">@lang('Voucher No')</th>
                                                <th scope="col">@lang('Amount') (S$)</th>
                                                <th scope="col">@lang('Credit')</th>
                                                <th scope="col">@lang('Debit')</th>
                                                <th scope="col">@lang('By')</th>
{{--                                                <th scope="col">@lang('Action')</th>--}}
{{--                                                @if(school('Income_edit') == 1)--}}
{{--                                                    <th scope="col">@lang('Action')</th>--}}
{{--                                                @endif--}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($transaction as $incomd)
                                                <tr title="{{$incomd->description}}" class="popTop">
                                                    <td>{{($loop->index + 1)}}</td>
                                                    <td>{{date('d-m-Y',strtotime($incomd->date))}}</td>
                                                    <td><a href="{{route('accounts.internal_transfer.voucher',$incomd->voucher_no)}}">{{$incomd->voucher_no}}</a></td>
                                                    <td>{{number_format($incomd->amount,2)}}</td>
                                                    <td>{{$incomd->ledgerCredit->name}}</td>
                                                    <td>{{$incomd->ledgerDebit->name}}</td>
                                                    <td>{{$incomd->user->name}}</td>

{{--                                                    @if(school('expense_edit') == 1)--}}
{{--                                                        <td><a title='Edit' class='btn btn-info btn-xs'--}}
{{--                                                               href='{{route("accounts.income.edit",$incomd->id)}}'>@lang('Edit')</a>--}}
{{--                                                        </td>--}}
{{--                                                    @endif--}}
{{--                                                    --}}{{--                                                    @if(school('expense_edit') == 1)--}}
{{--                                                    --}}{{--                                                        <td><a title='Adjustment' class='btn btn-info btn-xs'--}}
{{--                                                    --}}{{--                                                               href='{{route("accounts.income.edit",$incomd->id)}}'>@lang('Adjustment')</a>--}}
{{--                                                    --}}{{--                                                        </td>--}}
{{--                                                    --}}{{--                                                    @endif--}}
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div id="printDiv" class="visible-print">

                                        <div class="mydiv" id="datacenter" style="text-align:center; display:flex; ">
                                            <div class="logo" id="logodemo"  style="text-align:right; width: 30%;">
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
                                                <img class="imgpri" style="width: 26% !important; margin-top:10px; margin-right:10px;" src="{{$logo}}" alt="Logo">
                                            </div>
                                            <div class="pppttt"  style="text-align:left;">
                                                @php

                                                        @endphp
                                                <h4 style="color: #079850!important; margin-bottom:6px;" class="namebn">বাংলাদেশ ল্যাংগুয়েজ এন্ড
                                                    কালচারাল ফাউন্ডেশন</h4>

                                                <h4 class="nameen" id="schoolengName"  style="font-family: Myriad Pro;  margin-bottom:6px;  margin-top:3px; color: #079850 !important; font-size:17px; word-spacing: 4px;">
                                                    Bangladesh Language and Cultural Foundation
                                                </h4>
                                                <p id="maincon" class="font_12" style="margin-bottom:6px; font-size:11px; word-spacing: -3.8px;">23 Chuan Terrace, Lorong Chuan, Singapore 558491 (UEN : TT00SS0212J)</p>
                                                <p id="maincon2" style=" font-size:10px; word-spacing: -2.3px;" class="sans">Tel: {{foqas_setting('phone')}} Email: {{foqas_setting('email')}} Website: www.blcf.sg</p>
                                            </div>
                                        </div>

                                        <p id="mymr" class="font_10 special-box-develop lucida"
                                            style="text-align: center; margin-bottom:8px !important; margin-top:40px; width:100%; font-size: 25px; text-transform: uppercase; border: 1px solid #e9e4e4; "><span class="lucida" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:bold;">@lang('Internal Transfer List')</span><br>
                                        </p>


                                            <table class="table table-bordered"
                                                   style="border: 1px solid #888888;border-collapse: collapse;background-color: #f5f5f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"
                                                   cellpadding="5">
                                                <thead>
                                                <tr style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                                    <th scope="col">#</th>
                                                    <th scope="col">@lang('Date')</th>
                                                    <th scope="col">@lang('Voucher No')</th>
                                                    <th scope="col">@lang('Amount') (S$)</th>
                                                    <th scope="col">@lang('Credit')</th>
                                                    <th scope="col">@lang('Debit')</th>
                                                    <th scope="col">@lang('By')</th>
                                                </tr>
                                                </thead>
                                                <tbody>


                                                @foreach($transaction as $incomd)
                                                    <tr title="{{$incomd->description}}" class="popTop">
                                                        <td>{{($loop->index + 1)}}</td>
                                                        <td>{{date('d-m-Y',strtotime($incomd->date))}}</td>
                                                        <td><a href="{{route('accounts.internal_transfer.voucher',$incomd->voucher_no)}}">{{$incomd->voucher_no}}</a></td>
                                                        <td>{{number_format($incomd->amount,2)}}</td>
                                                        <td>{{$incomd->ledgerCredit->name}}</td>
                                                        <td>{{$incomd->ledgerDebit->name}}</td>
                                                        <td>{{$incomd->user->name}}</td>

                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
        @push('script')
            <script>
                $('.datepicker').datepicker({
                    format: 'yyyy',
                    viewMode: "years",
                    minViewMode: "years",
                    autoclose: true,
                });
                $("#btnPrint").on("click", function () {
                    var divToPrint = document.getElementById('printDiv');
                    var newWin = window.open('', 'Print-Window');
                    document.getElementById("schoolengName").style.cssText = `font-family: Myriad Pro;  margin-bottom:6px;  margin-top:3px; color: #079850 !important; font-size:18px; word-spacing: -0.6px !important;`;
                    document.getElementById("maincon").style.cssText = `margin-bottom:6px; font-size:11px; word-spacing: -3px;`;
                    document.getElementById("maincon2").style.cssText = `font-size:10px; word-spacing: -4.5px;`;
                    newWin.document.open();
                    newWin.document.write('<html><title>@lang("Income List")</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>#btnPrint{display:none}.d-print-none{display:none} .gradeTable{width:25% !important;top:55px !important;right:10px !important}.clearhight50{clear:both;height:50px}.clearhight25 {clear: both;height: 25px;}.clearhight15 {clear: both}.print_style {border: 1px dashed;position: relative;overflow: auto;padding: 0px 10px;min-height:97%}.div_break{padding: 10px 0;page-break-before: always;}.custom-tabel{background-color: #f0f0f0 !important;} .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{font-size:9px; border: 1px solid #000;padding: 1.5px;} </style>' + divToPrint.innerHTML + '</body></html>');

                    newWin.document.close();
                    setTimeout(function () {
                        newWin.close();
                    }, 100);
                });
            </script>
        @endpush
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
        @push('script')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
            <style>
                canvas {
                    -moz-user-select: none;
                    -webkit-user-select: none;
                    -ms-user-select: none;
                }
                .popTop {
                    cursor: default;
                }
            </style>

    @endpush
@endsection
