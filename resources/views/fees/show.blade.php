@extends('layouts.app')
@section('content')
    <style>
        h4 {
            font-size: 21px !important;
        }

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

        .txt {
            display: none;
        }

        .xlsx {
            padding-left: 0
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <a href="'. route('fees.index').'">'. trans('Fees').'</a> / <b>'.trans('Show').'<b>'])
                @include('components.sectionbar.accounts-bar')
                @if (isset($fee))
                    <div id="printDiv">
                    <span class="pull-left d-print-block d-none">@lang('Print Date') : <span
                                id="printTime"></span></span>
                        <div class="clearfix"></div>
                        <div align="center" class="d-print-block d-none">
                            <h3>{{school('name')}}</h3>
                            <h5>{{school('address')}}</h5>
                            <div class="clearhight50"></div>
                        </div>
                        <div class="panel panel-default" style="border: none;">
                            <div class="page-panel-title w-100" style="margin-bottom: 15px">
                                @foreach($fee->due as $due)
                                    <b>{{trans(school('country')->code == 'BD' ? 'Class' : 'Grade')}}</b>
                                    - {{$due->class->name}}
                                    &nbsp;
                                    <b>@lang('Section')</b>
                                    - {{$due->section->section_number}}
                                    &nbsp;
                                    <b>@lang('Fee Name')</b>
                                    - {{$fee->account_sector->name}}
                                    @break
                                @endforeach
                                <span class="pull-right"><b>@lang('Dues Date'): {{date('d-m-Y',strtotime($fee->date))}}</b><br>
                                <b>@lang('Created Date'): {{date('d-m-Y',strtotime($fee->created_at))}}</b>
                                </span>
                            </div>
                            <div class="clearfix"></div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed table-striped table-hover" id="tbl">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">@lang('Student Code')</th>
                                            <th scope="col">@lang('Student Name')</th>
                                            @if(school('country')->code == 'BD')
                                                <th scope="col">@lang('Roll')</th>
                                            @endif
                                            <th class="text-right" scope="col">@lang('Amount')</th>
                                            <th class="text-right" scope="col">@lang('Action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @php($totalDue=0)
                                        @foreach($fee->due as $due)
                                            @if (isset($due->student->student_code))
                                                @php($totalDue += $fee->amount)
                                                <tr>
                                                    <td scope="row">{{  $loop->index + 1 }}</td>
                                                    <td><small>{{$due->student->student_code}}</small></td>
                                                    <td><small>{{$due->student->name}}</small></td>
                                                    @if(school('country')->code == 'BD')
                                                        <td><small>{{$due->student->studentInfo->class_roll}}</small></td>
                                                    @endif
                                                    <td class="text-right">
                                                        <small>{{number_format($fee->amount, 2)}}</small>
                                                    </td>
                                                    <td class="text-center">

                                                            <?php
                                                            $mydate = date('d-m-Y');
                                                            ?>


                                                        <a href="{{route('accounts.ledger.searchdata',[$due->student->student_code,$mydate])}}" class="btn btn-default ">$ Money Receipt</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td colspan="{{school('country')->code == 'SG' ? 3 : 4}}"><b>@lang('Total')</b></td>
                                            <td class="text-right"><b>{{number_format($totalDue,2)}}</b></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{--                        <div class="form-group col-md-2 mt-28 ">--}}
                        {{--                            <button type="submit" id="admitButton" class="{{btnClass()}}">--}}
                        {{--                                @lang('Money Receipt')--}}
                        {{--                            </button>--}}
                        {{--                        </div>--}}

                        @push('script')
                            <script>
                                function printDiv() {
                                    currentDateTime("printTime");
                                    var divToPrint = document.getElementById('printDiv');
                                    var newWin = window.open('', 'Print-Window');
                                    newWin.document.open();
                                    newWin.document.write('<html><title>@lang("Student Fee Details")</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>@page {size: a4 portrait;}.label{border:none;}.clearhight50{clear:both;height:50px}caption{display:none;}.txt{display:none;}.panel-body{padding:0px}</style>' + divToPrint.innerHTML + '</body></html>');
                                    newWin.document.close();
                                    setTimeout(function () {
                                        newWin.close();
                                    }, 1000);
                                }

                                $(function () {
                                    var tables = $("#tbl").tableExport({
                                        bootstrap: true,
                                        headings: true,
                                        footers: true,
                                        formats: ["xlsx", "xls", "csv", "txt"],
                                        fileName: "{{$fee->account_sector->name.'-'.$due->class->name.'-'.$due->section->section_number}}",
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
                        @else
                            <div class="panel panel-default" style="border: none;">
                                <div class="panel-body">
                                    @lang('No Related Data Found.')
                                </div>
                            </div>
                        @endif
                        <div class="clearhight50"></div>
                        <div class="d-print-block d-none">
                            <div class="pull-left" align="center">
                                ---------------------
                                <div class="clearfix"></div>
                                <span class="border_dot">
                            @lang('Accountant')
                        </span>
                            </div>
                            <div class="pull-right" align="center">
                                ---------------------
                                <div class="clearfix"></div>
                                <span class="border_dot">
                            @lang('Headmaster')
                        </span>
                            </div>
                        </div>

                        <div class="clearhight50"></div>
                        <div align="center" class="d-print-block d-none">Developed by : {{reseller()->name}}</div>
                    </div>
            </div>
        </div>
@endsection