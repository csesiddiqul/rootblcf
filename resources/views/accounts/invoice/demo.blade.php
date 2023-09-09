@extends('layouts.app')
@section('title', __('Income & Expense report'))
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
    </style>
    <div class="container-fluid">
        <div class="row">
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
                                <span class="btn btn-default btn-sm"
                                      onclick="printDiv('forPrint')">@lang('Print')</span>

                            </div>
                        @endif
                        <div class="clearhight50"></div>
                        {!! Form::close() !!}

                    </div>
                    <div class="clearfix"></div>
                    @if(isset($income))

                        {{--                        --}}{{--<button class="printbtn btn  btn-success pull-right mr-15"--}}
                        {{--                         onclick="printDiv('forPrint')" style="margin-top: 10px !important;"--}}
                        {{--                         role="button" id="btnPrint"><i class="fa fa-print"></i> @lang('Print')--}}
                        {{--                        </button>--}}
                        {{--                        --}}{{--<span class="btn btn-default btn-sm pull-right mr-15 mt-11" onclick="Export()">@lang('Download ')</span>--}}
                        <div class="forSign col-md-12" id="forPrint">
                    <span class="pull-left d-print-block d-none">@lang('Print Date') : <span
                                id="printTime"></span></span>
                            <div class="clearfix"></div>
                            <h3 style="text-align: center;">@lang('Income Expense Report')</h3>
                            <div style="text-align: center;">
                                <p>@lang('Financial Year') : {{active_financial_year()->name}}</p>
                                @lang('Date'): @if($from == $to) {{$from}} @else {{$from}} @lang('to') {{$to}} @endif
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered  table-striped" id="tbl">
                                    <col>
                                    <colgroup span="2"></colgroup>
                                    <colgroup span="2"></colgroup>
                                    <tr>
                                        <th colspan="2" id="pd-12" scope="colgroup"
                                            style="text-align: center;">@lang('Income')</th>
                                        <th colspan="2" id="pd-12" scope="colgroup"
                                            style="text-align: center;">@lang('Expense')</th>
                                    </tr>
                                    <tr>
                                        <th scope="col" id="pd-12">@lang('Head')</th>
                                        <th scope="col" id="pd-12"><span class="pull-right">@lang('Amount')</span></th>
                                        <th scope="col" id="pd-12">@lang('Head')</th>
                                        <th scope="col" id="pd-12"><span class="pull-right">@lang('Amount')</span></th>
                                    </tr>
                                    @php $totalIncome = 0;$totalExpense  = 0; @endphp
                                    @foreach($income as $key => $r)
                                        @php
                                            $totalIncome += $r->amount??0;
                                            if(count($expense)>$key){
                                                $totalExpense += $expense[$key]->expensesAmount??0;
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{$r->name}}</td>
                                            <td><span class="pull-right">{{number_format($r["amount"]??0,2)}}</span>
                                            </td>

                                            <td>@if(count($expense)>$key) {{$expense[$key]->name}} @endif</td>
                                            <td>
                                                <span class="pull-right">@if(count($expense)>$key) {{number_format($expense[$key]->expensesAmount??0 ,2)}} @endif</span>
                                            </td>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td><b>@lang('Total')</b></td>
                                        <td><span class="pull-right"><b>{{number_format($totalIncome,2)}}</b></span>
                                        </td>
                                        <td><b>@lang('Total')</b></td>
                                        <td><span class="pull-right"><b>{{number_format($totalExpense,2)}}</b></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>@lang('Profit & Loss')</b></td>
                                        <td colspan="3">
                                            <span class="pull-right">
                                                <b>
                                                    @if(number_format($totalIncome-$totalExpense,2) == 0)
                                                        {{number_format($totalIncome-$totalExpense,2)}}
                                                    @elseif(number_format($totalIncome-$totalExpense,2) < 0)
                                                        <p style="color: red"> {{number_format($totalIncome-$totalExpense,2)}}</p>
                                                    @else
                                                        <p style="color: green">{{number_format($totalIncome-$totalExpense,2)}}</p>
                                                    @endif
                                                </b>
                                            </span>
                                        </td>
                                    </tr>
                                </table>

                                <div>
                                    <hr>
                                    <h5 class="border" style="font-size: 15px;color:#444;font-weight:bold;padding-left:3px;">Account Current Balance : </h5>
                                    <table class="table table-bordered  table-striped">
                                        <tr>
                                            <th>Types</th>
                                            <th>Account Name</th>
                                            <th>Balance</th>
                                            <th>Date</th>
                                        </tr>
                                        <tr>
                                        @php
                                            $x = 0;
                                        @endphp
                                        @foreach($ledgers as $key => $value)
                                            @if(!empty($key))
                                            @endif
                                            @foreach($value->sortBy('name') as $ledger)

                                                <tr>
                                                    <td>{{$key}}</td>
                                                    <td>{{$ledger->name}}</td>
                                                    <td class="">{{number_format($ledger->current_balance,2)}}</td>
                                                    <td>{{date('d-M-Y')}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="d-none">
                                                        @php
                                                            if (isset($ledger->current_balance)){
                                                                  $x += $ledger->current_balance;
                                                            }
                                                        @endphp
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endforeach
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <strong>  Current Balance (Cash / Bank):</strong>
                                                    </td>
                                                    <td>
                                                        <strong>{{number_format($x,2)}}</strong>
                                                    </td>
                                                    <td>
                                                        {{date('d-m-y')}}
                                                    </td>
                                                </tr>
                                    </table>
                                </div>


                            </div>
                            <div class="clearhight50"></div>
                            <div class="d-print-block d-none ">
                                <div class="pull-left mt-25 ml-10" align="center">
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
                            <div class="clearhight50"></div>
                            <div align="center" class="d-print-block d-none">Developed by : {{reseller()->name}}</div>
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

        function printDiv() {
            currentDateTime("printTime");
            var divToPrint = document.getElementById('forPrint');
            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write('<html><title>Income Expense Report</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>#pd-12{padding: 12px;font-size: 18px}.clearhight50{clear:both;height:50px}.table-responsive{margin-top: 32px;}caption{display:none;}.txt{display:none;}</style>' + divToPrint.innerHTML + '</body></html>');
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
        export default {
            components: {BootstrapEditable}
        }
    </script>

    <script src="{{ asset('js/export2.js') }}"></script>
    <script>

        function Export() {
            $("#tbl").table2excel({
                filename: "Table.xls"
            });
        }


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
