@extends('layouts.app')
@section('title', __('Expense Reports'))
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

        .mt-28 {
            margin-top: 28px;
        }

        .txt {
            display: none;
        }

    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Expense Reports').'<b>'])
                @include('components.sectionbar.reports-bar')
                <div class="panel-body pl-0 pr-0">
                    <div class="col-md-12 pl-0">
                        {!! Form::open(array('route' => 'accounts.expensereport', 'method' => 'POST', 'role' =>'form','enctype'=>'multipart/form-data', 'class' => 'needs-validation')) !!}
                        <div class="form-group col-md-3">
                            <label for="date">@lang('From')</label>
                            {!! Form::text('from', $from ?? date('01-m-Y'), array('id' => 'date', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
                            @error('from')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="date">@lang('To')</label>
                            {!! Form::text('to', $to ?? date('t-m-Y'), array('id' => 'date', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
                            @error('to')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-2 mt-28 ">
                            <button type="submit" id="admitButton" class="{{btnClass()}}">
                                @lang('Search')
                            </button>
                        </div>
                        @if (isset($expenses) && $expenses->count())
                            <div class="col-md-1 mt-28">
                                <span class="btn btn-default btn-sm " onclick="printDiv()">@lang('Print')</span>
                            </div>
                        @endif
                        <div class="clearhight50"></div>
                        {!! Form::close() !!}
                    </div>
                    <div class="clearfix"></div>
                    @isset($expenses)
                        <div id="printDiv">
                            <span class="pull-left d-print-block d-none">@lang('Print Date :') <span
                                        id="printTime"></span></span>
                            <div class="clearfix"></div>
                            <div align="center" class="d-print-block d-none">
                                <h3>{{school('name')}}</h3>
                                <h5>{{school('address')}}</h5>
                                <h4>@lang('Expense Reports')</h4>
                                <div class="clearhight50"></div>
                            </div>
                            <div class="page-panel-title w-100" style="margin-bottom: 15px">
                                <span class="pull-left">@lang('Financial Year') : {{active_financial_year()->name}}</span>
                                <span class="pull-right"><b>@lang('Expense Report') {{$from}} @lang('to') {{$to}}</b></span>
                            </div>
                            @if($expenses->count())
                                <div class="clearfix"></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered  table-striped" id="tbl">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            @foreach ($expenses as $expense)
                                                @foreach ($expense as $field=> $value)
                                                    <th class="text-right">{{$field}}</th>
                                                @endforeach
                                                @break($loop->first)
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($colspan=1)
                                        @foreach ($expenses as $expense)
                                            <tr>
                                                <td>{{$loop->index +1}}</td>
                                                @foreach ($expense as $field=> $value)
                                                    @php($colspan++)
                                                    <td class="text-right">{{$value ?? '0.00'}} </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2">@lang('Sub Total')</td>
                                            @php($subtotal=0)
                                            @foreach ($totals as $total)
                                                @foreach ($total as $key=> $value)
                                                    @php($subtotal +=$value)
                                                    <td class="text-right">{{number_format($value,2)}}</td>
                                                @endforeach
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td><b>@lang('Total')</b></td>
                                            <td colspan="{{$colspan}}"
                                                class="text-right"><b>{{number_format($subtotal,2)}}</b></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @push('script')
                                    <script>
                                        function printDiv() {
                                            currentDateTime("printTime");
                                            var divToPrint = document.getElementById('printDiv');
                                            var newWin = window.open('', 'Print-Window');
                                            newWin.document.open();
                                            newWin.document.write('<html><title>Expense Report {{ $from." to ".$to}}</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>@page {size: a4 portrait;}.label{border:none;}.clearhight50{clear:both;height:50px}.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{padding:6px:font-size:9px}.table > tbody > tr > td:nth-child(2){width:10%}caption{display:none;}.txt{display:none;}</style>' + divToPrint.innerHTML + '</body></html>');
                                            newWin.document.close();
                                            setTimeout(function () {
                                                newWin.close();
                                            }, 100);
                                        }
                                    </script>
                                @endpush
                            @else
                                @lang('No Related Data Found.')
                            @endif
                            <div class="clearhight50"></div>
                            <div class="d-print-block d-none">
                                <div class="pull-left" align="center">
                                    ----------------------
                                    <div class="clearfix"></div>
                                    <span class="border_dot">
                                        @lang('Accountant')
                                    </span>
                                </div>
                                <div class="pull-right" align="center">
                                    ----------------------
                                    <div class="clearfix"></div>
                                    <span class="border_dot">
                                        @lang('Authorised Signature')
                                    </span>
                                </div>
                            </div>
                            <div class="clearhight50"></div>
                            <div align="center" class="d-print-block d-none">Developed by
                                : {{reseller()->name}}</div>
                        </div>
                    @endisset
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
    <script>
        $(function () {
            $('.select2').select2();
        });
    </script>

    <script>
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
