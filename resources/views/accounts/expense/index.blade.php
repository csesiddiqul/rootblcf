@extends('layouts.app')
@section('title', __('Expense List'))
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
          rel="stylesheet">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Expenses').'<b>'])
                @include('components.sectionbar.accounts-bar')
                <div class="panel panel-default ptlb-515">
                    <div class="panel-body plt-07">
                        <div class="page-panel-title">@lang('List of Expense')
                            <button class="btn btn-xs btn-success pull-right" role="button" id="btnPrint">
                                <i class="fa fa-print"></i> @lang('Print')
                            </button>
                        </div>
                        <div class="row">
                            <div class="pull-right">
                                <form id="registerForm" action="{{route('accounts.expense.index')}}" method="put"
                                      autocomplete="off">
                                    @csrf
                                    <div class="col-md-6" style="z-index: 2000!important;">
                                        <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                            <input id="date" type="text" class="form-control datepicker"
                                                   name="year" value="{{$year}}" placeholder="@lang('Year')"
                                                   required>
                                            @if ($errors->has('year'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('year') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="z-index: 2000!important;">
                                        <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                            @lang('Get Expense List')
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">
                                <div style="width:100%; height: 300px;">
                                    <canvas id="canvas"></canvas>
                                </div>
                            </div>
                            <div class="clearheight"></div>
                            <div class="col-md-12">

                                @isset($expenses)
                                    <div class="table-responsive">
                                        <table class="table table-data-div table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">@lang('Date')</th>
                                                <th scope="col">@lang('Expense Head')</th>
                                                <th scope="col">@lang('Name')</th>
                                                <th scope="col">@lang('Voucher No')</th>
                                                <th scope="col">@lang('Amount') (S$)</th>
                                                <th scope="col">@lang('Purchase Invoice Number')</th>
                                                <th scope="col">@lang('Attached File')</th>
                                                @if(school('expense_edit') == 1)
                                                    <th scope="col">@lang('Action')</th>
                                                @endif
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($expenses as $expense)
                                                <tr title="{{$expense->description}}" class="popTop">
                                                    <td>{{($loop->index + 1)}}</td>
                                                    <td>{{date('d-m-Y',strtotime($expense->date))}}</td>
                                                    <td>{{$expense->accountSector->name}}</td>
                                                    <td>{{$expense->name}}</td>
                                                    <td><a href="{{route('accounts.expense.voucher',$expense->voucher_no)}}">{{$expense->voucher_no}}</a></td>
                                                    <td>{{number_format($expense->amount,2)}}</td>
                                                    <td>{{$expense->invoice_number}}</td>
                                                    <td class="text-center">
                                                        
                                                    
                                                        
                                                        
                                                        @isset($expense->file)
                                                        
                                                            @if($expense->file !='')
                                                                <a href="{{url('/'.$expense->file)}}" class="btn btn-xs foqas-btn "
                                                                   target="_blank">
                                                                    <i class="fa fa-eye"></i>
                                                                 </a>
                                                                 
                                                                @else
                                                                
                                                                @lang('No file')
                                                            
                                                            @endif
                                                            
                                                            
                                                            
                                                        @endisset
                                                    </td>
                                                    @if(school('expense_edit') == 1)
                                                        <td><a title='Edit' class='btn btn-info btn-xs'
                                                               href='{{route("accounts.expense.edit",$expense->id)}}'>@lang('Edit')</a>
                                                        </td>
                                                    @endif
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
                                            style="text-align: center; margin-bottom:8px !important; margin-top:40px; width:100%; font-size: 25px; text-transform: uppercase; border: 1px solid #e9e4e4; "><span class="lucida" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:bold;">@lang('Expense List')</span><br>
                                        </p>

                                            <h4 style="text-align:center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">@lang('Expense Year - '.$year)</h4>
                                            <table class="table table-bordered"
                                                   style="border: 1px solid #888888;border-collapse: collapse;background-color: #f5f5f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"
                                                   cellpadding="5">
                                                <thead>
                                                <tr style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                                    <th style="border: 1px solid #888888;">#</th>
                                                    <th style="border: 1px solid #888888;">@lang('Date')</th>
                                                    <th style="border: 1px solid #888888; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">@lang('Expense Head')</th>
                                                    <th style="border: 1px solid #888888;">@lang('Name')</th>
                                                    <th style="border: 1px solid #888888;">@lang('Voucher No')</th>
                                                    <th style="border: 1px solid #888888;">@lang('Amount') (S$)</th>
                                                    <th style="border: 1px solid #888888;">@lang('Invoice Number')</th>
                                                    <th style="border: 1px solid #888888;">@lang('Year')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($expenses as $expense)
                                                    <tr>
                                                        <td style="border: 1px solid #888888;">{{($loop->index + 1)}}</td>
                                                        <td style="border: 1px solid #888888;">{{date('d-m-Y',strtotime($expense->date))}}</td>
                                                        <td style="border: 1px solid #888888;">{{$expense->accountSector->name}}</td>
                                                        <td style="border: 1px solid #888888;">{{$expense->name}}</td>
                                                        <td style="border: 1px solid #888888;">{{$expense->voucher_no}}</td>
                                                        <td style="border: 1px solid #888888;">{{number_format($expense->amount,2)}}</td>
                                                        <td style="border: 1px solid #888888;">{{$expense->invoice_number}}</td>
                                                        <td style="border: 1px solid #888888;">{{Carbon\Carbon::parse($expense->created_at)->format('Y')}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                @endisset
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
                    newWin.document.write('<html><title>@lang("Expense List")</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>#btnPrint{display:none}.d-print-none{display:none} .gradeTable{width:25% !important;top:55px !important;right:10px !important}.clearhight50{clear:both;height:50px}.clearhight25 {clear: both;height: 25px;}.clearhight15 {clear: both}.print_style {border: 1px dashed;position: relative;overflow: auto;padding: 0px 10px;min-height:97%}.div_break{padding: 10px 0;page-break-before: always;}.custom-tabel{background-color: #f0f0f0 !important;} .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{font-size:9px; border: 1px solid #000;padding: 1.5px;} </style>' + divToPrint.innerHTML + '</body></html>');

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
            <script>
                'use strict';
                window.chartColors = {
                    red: 'rgb(255, 99, 132)',
                    orange: 'rgb(255, 159, 64)',
                    yellow: 'rgb(255, 205, 86)',
                    green: 'rgb(75, 192, 192)',
                    blue: 'rgb(54, 162, 235)',
                    purple: 'rgb(153, 102, 255)',
                    grey: 'rgb(201, 203, 207)'
                };
                var color = Chart.helpers.color;
                var config = {
                    type: 'line',
                    data: {
                        datasets: [{
                            label: @json( __('Expense')),
                            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                            borderColor: window.chartColors.red,
                            fill: false,
                            data: [@foreach($expenses->groupBy('date')->sort() as $date => $ex)
                            {
                                t: "{{Carbon\Carbon::parse($date)->format('Y-d-m')}}",
                                y: {{$ex->sum('amount')}}
                            },
                                @endforeach]
                        }]
                    },
                options: {
                        title: {
                            display: true,
                            text: @json( __('Expense (In SGD) in Time Scale'))
                        },
                        maintainAspectRatio: false,
                        scales: {
                            xAxes: [{
                                type: @json( __('time')),
                                time: {
                                    parser: 'YYYY-DD-MM',
                                    unit: 'day',
                                    displayFormats: {
                                        days: 'MM/YY'
                                    },
                                    tooltipFormat: 'DD/MM/YYYY'
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: @json( __('Days'))
                                }
                            }],
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: @json( __('SG Dollar'))
                                },
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        },
                    }
                };

                window.onload = function () {
                    var ctx = document.getElementById('canvas').getContext('2d');
                    window.myLine = new Chart(ctx, config);
                };
            </script>
    @endpush
@endsection
