@extends('layouts.app')
@section('title', __('Ledger Sectors'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <a href="'. route('accounts.ledger.index').'">'. trans('Ledger').'</a> / <b>'.$ledger->name.'<b>'])
                @include('components.sectionbar.accounts-bar')
                <div class="panel panel-default" id="print-content">
                    <div class="panel-body">
                        <h3 class="text-center">
                            <button class="btn btn-xs btn-success d-print-none pull-left" role="button" id="btnPrint"
                                    onclick="printDiv()"><i class="fa fa-print"></i> @lang('Print')
                            </button>
                            {{$ledger->name}}</h3>
                        @php
                            $creditT = $ledger->payment->sum('total') -  $ledger->payment->sum('waiver');
                            $debit = $ledger->expense->sum('amount');
                            $creditIT = $ledger->income->sum('amount');
                            $memberfe1 = $membership->sum('amount');


                            $allcre = $creditT + $memberfe1 + $creditIT;

                            $credit = $creditT - $debit + $memberfe1;
                        @endphp
                        <p>
                            <span class="pull-left">Opening Date : {{date('d-M-Y',strtotime($ledger->created_at))}}</span>
                            <span class="pull-right">Today's Date : {{date('d-M-Y')}}</span></p>
                        <br>
                        <p>
                            <span class="pull-left"> Opening Balance :

                                {{number_format($ledger->current_balance-$credit+$internalTransfersCr-$internalTransfersDa-$incomeall,2)}}

                            </span>
                            <span class="pull-right"> Current Balance : {{number_format($ledger->current_balance,2)}}</span>
                        </p>
                        <br>
                        <div class="col-md-6 credit">
                            <h4 class="text-center"><b>Credit ({{number_format($allcre,2)}})</b></h4>
                            <table class="table {{$ledger->payment->count() > 25 ? 'table-data-div' : ''}}">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th class="text-right">Amount (S$)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ledger->payment->sortByDesc('trans_date') as $payment)
                                    <tr>
                                        <td><a href="{{route('invoice',$payment->reciept_number)}}" target="_blank">{{$payment->trans_date}}</a></td>
                                        <td class="text-right">{{number_format($payment->total-$payment->waiver,2)}}</td>
                                    </tr>
                                @endforeach

                                @foreach($ledger->income->sortByDesc('trans_date') as $payment)
                                    <tr>

                                        <td>
                                            <a href="{{route('accounts.income.voucher',$payment->voucher_no)}}" target="_blank">{{$payment->created_at->format('y-d-m')}}</a>
                                        </td>
                                        <td class="text-right">{{number_format($payment->amount,2)}}</td>
                                    </tr>
                                @endforeach



                                @foreach($membership->sortByDesc('date') as $memberfee)
                                    <tr>
                                        <td>
                                            <a href="{{route('accounts.membership_fee.show',$memberfee->id)}}" target="_blank">{{$memberfee->date}}</a>
                                        </td>
                                        <td class="text-right">{{number_format($memberfee->amount,2)}}</td>
                                    </tr>


                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6 debit">
                            <h4 class="text-center"><b>Debit ({{number_format($debit,2)}})</b></h4>
                            <table class="table {{$ledger->expense->count() > 25 ? 'table-data-div' : ''}}">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th class="text-right">Amount (S$)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($ledger->expense->sortByDesc('date') as $expense)
                                    <tr>
                                        <td><a href="{{route('accounts.expense.voucher',$expense->voucher_no)}}" target="_blank">{{$expense->date}}</a></td>
                                        <td class="text-right">{{number_format($expense->amount,2)}}</td>
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
    <script>
        jQuery(document).bind("keyup keydown", function (e) {
            if (e.ctrlKey && e.keyCode == 80) {
                $("#DataTables_Table_0_wrapper .row:first-child").hide();
                $("#DataTables_Table_1_wrapper .row:first-child").hide();
                $("#DataTables_Table_0_wrapper .row:last-child").hide();
                $("#DataTables_Table_1_wrapper .row:last-child").hide();
                printDiv();
                $("#DataTables_Table_0_wrapper .row:first-child").show();
                $("#DataTables_Table_1_wrapper .row:first-child").show();
                $("#DataTables_Table_0_wrapper .row:last-child").show();
                $("#DataTables_Table_1_wrapper .row:last-child").show();
                return false;
            }
        });

        function printDiv() {
            var divToPrint = document.getElementById('print-content');
            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write('<html><title>@lang("Ledger Info")</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>#btnPrint{display:none}.d-print-none{display:none}.table-responsive { overflow-x: unset;} table>thead>tr>th, .table>thead>tr>th, table>tbody>tr>th, .table>tbody>tr>th, table>tfoot>tr>th, .table>tfoot>tr>th, table>thead>tr>td, .table>thead>tr>td, table>tbody>tr>td, .table>tbody>tr>td, table>tfoot>tr>td, .table>tfoot>tr>td {border: 1px solid #f4f4f4 !important;    padding: 4px;}.col-md-6{width:50%;float:left}   a[href]:after {content: none !important;} a{text-decoration:none !important}</style>' + divToPrint.innerHTML + '</body></html>');
            newWin.document.close();
            setTimeout(function () {
                newWin.close();
            }, 1000);
        }
    </script>
@endsection
