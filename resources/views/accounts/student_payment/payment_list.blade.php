@extends('layouts.app')
@section('title', __('Student Payment  List'))
@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
          rel="stylesheet">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Student Payment ').'<b>'])
                @include('components.sectionbar.accounts-bar')
                <div class="panel panel-default ptlb-515">
                    <div class="panel-body plt-07">
                        <div class="page-panel-title">@lang('Student Payment ')
                            <button class="btn btn-xs btn-success pull-right" role="button" id="btnPrint">
                                <i class="fa fa-print"></i> @lang('Print')
                            </button>
                        </div>
                        <div class="row">
                            <div class="pull-right">
                                <form id="registerForm" action="{{route('accounts.student_payment_form')}}" method="post"
                                      autocomplete="off">

                                    @csrf
                                    <div class="form-group col-md-3" style="z-index:2000000!important">
                                        <label for="date">@lang('From')</label>
                                        {!! Form::text('from', $date ?? date('01-m-Y'), array('id' => 'date', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
                                        @error('from')
                                        <span class="help-block">
                                <strong>{{ trans($message) }}</strong>
                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-3" style="z-index:2000000!important">
                                        <label for="date">@lang('To')</label>
                                        {!! Form::text('to', $date ?? date('t-m-Y'), array('id' => 'date', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
                                        @error('to')
                                        <span class="help-block">
                                <strong>{{ trans($message) }}</strong>
                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6" style="z-index:2000000!important">
                                        <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                            @lang('Get Payment List')
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
                                @isset($totalPay)
                                    <div class="font_14 mr-2">Total Amount (S$) :   {{number_format($totalPay ?? 0 ,2)}}</div>
                                @endisset

                                @isset($data)
                                    <div class="table-responsive">
                                        <table class="table table-data-div table-hover">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">@lang('Student name')</th>
                                                <th scope="col">@lang('Class')</th>
                                                <th scope="col">@lang('Date')</th>
                                                <th scope="col">@lang('MR No')</th>
                                                <th scope="col">@lang('Amount (S$)')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $incomd)
                                                    <tr title="" class="popTop">
                                                        <td>{{($loop->index + 1)}}</td>
                                                        <td>
                                                            {{ $incomd->student->name}}
                                                        </td>
                                                        <td>
                                                            @if($incomd->student->section->class_id)
                                                                @php
                                                                    $classNmae = getsectionData($incomd->student->section->class_id);
                                                                @endphp
                                                                {{$classNmae[0]->name}}
                                                            @endif
                                                            {{ '-' . $incomd->student->section->section_number}}
                                                        </td>
                                                        <td>
                                                            {{$incomd->trans_date}}
                                                        </td>
                                                        <td>
                                                            <a href="{{route('invoice',$incomd->reciept_number)}}"
                                                               target="_blank" class="popTop"
                                                               title='<span style="width:50%" class="">@lang('Online fees deposit through') TXN ID: {{$incomd->reciept_number}} <br> @lang('Collected By'): {{$incomd->trans_date}}</span>'> {{$incomd->reciept_number}}</a>
                                                        </td>

                                                        <td style="text-align: right"> {{number_format($incomd->total  - $incomd->waiver?? 0 ,2)}}</td>

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
                                                    <p id="maincon" class="font_12" style="margin-bottom:6px; font-size:11px; word-spacing: -3.8px;">23 Chuan Terrace, Lorong Chuan, Singapore 558491 (UEN : T00SS0212J)</p>
                                                    <p id="maincon2" style=" font-size:10px; word-spacing: -2.3px;" class="sans">Tel: {{foqas_setting('phone')}} Email: {{foqas_setting('email')}} Website: www.blcf.sg</p>
                                                </div>
                                            </div>

                                            <p id="mymr" class="font_10 special-box-develop lucida"
                                               style="text-align: center; margin-bottom:8px !important; margin-top:40px; width:100%; font-size: 25px; text-transform: uppercase; border: 1px solid #e9e4e4; "><span class="lucida" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:bold;">@lang('Student Payment')</span><br>
                                            </p>

                                            <h4 style="text-align:center; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">@lang('Student Payment - ' ) @isset($year) {{$year}} @endisset</h4>
                                            <table class="table table-data-div table-hover">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">@lang('Student name')</th>
                                                    <th scope="col">@lang('Class')</th>
                                                    <th scope="col">@lang('Date')</th>
                                                    <th scope="col">@lang('MR No')</th>
                                                    <th scope="col">@lang('Amount (S$)')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($data as $incomd)
                                                    <tr title="" class="popTop">
                                                        <td>{{($loop->index + 1)}}</td>
                                                        <td>
                                                            {{ $incomd->student->name}}
                                                        </td>
                                                        <td>
                                                            @if($incomd->student->section->class_id)
                                                                @php
                                                                    $classNmae = getsectionData($incomd->student->section->class_id);
                                                                @endphp
                                                                {{$classNmae[0]->name}}
                                                            @endif
                                                            {{ '-' . $incomd->student->section->section_number}}
                                                        </td>
                                                        <td>
                                                            {{$incomd->trans_date}}
                                                        </td>
                                                        <td>
                                                          {{$incomd->reciept_number}}
                                                        </td>

                                                        <td> {{number_format($incomd->total - $incomd->waiver ?? 0 ,2)}}</td>

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
                $(function () {
                    $('.datepicker').datepicker({
                        format: "dd-mm-yyyy",
                        viewMode: "days",
                        minViewMode: "days",
                        autoclose: true
                    });
                });
                $("#btnPrint").on("click", function () {
                    var divToPrint = document.getElementById('printDiv');
                    var newWin = window.open('', 'Print-Window');
                    document.getElementById("schoolengName").style.cssText = `font-family: Myriad Pro;  margin-bottom:6px;  margin-top:3px; color: #079850 !important; font-size:18px; word-spacing: -0.6px !important;`;
                    document.getElementById("maincon").style.cssText = `margin-bottom:6px; font-size:11px; word-spacing: -3px;`;
                    document.getElementById("maincon2").style.cssText = `font-size:10px; word-spacing: -4.5px;`;
                    newWin.document.open();
                    newWin.document.write('<html><title>@lang("Student Payment List")</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>#btnPrint{display:none}.d-print-none{display:none} .gradeTable{width:25% !important;top:55px !important;right:10px !important}.clearhight50{clear:both;height:50px}.clearhight25 {clear: both;height: 25px;}.clearhight15 {clear: both}.print_style {border: 1px dashed;position: relative;overflow: auto;padding: 0px 10px;min-height:97%}.div_break{padding: 10px 0;page-break-before: always;}.custom-tabel{background-color: #f0f0f0 !important;} .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{font-size:9px; border: 1px solid #000;padding: 1.5px;} </style>' + divToPrint.innerHTML + '</body></html>');

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
            @isset($data)
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
                            label: @json( __('Student Payment')),
                            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                            borderColor: window.chartColors.red,
                            fill: false,



                            data: [@foreach($data->groupBy('trans_date')->sort() as $date => $ex)
                            {
                                t: "{{Carbon\Carbon::parse($date)->format('Y-d-m')}}",
                                y: {{$ex->sum('total')}}
                            },
                                @endforeach]
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: @json( __('Student Payment  (In SGD) in Time Scale'))
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

                @endisset


    @endpush
@endsection
