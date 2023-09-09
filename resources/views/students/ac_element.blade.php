<div class="table-responsive" style="clear: both;">
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>@lang('Fees head')</th>
            <th class="text text-left">@lang('Dues Date')</th>
            <th class="text text-left">@lang('Status')</th>
            <th class="text text-right">@lang('Amount')
                <span>({{school('country')->code == 'BD' ? '৳' : '$'}})</span>
            </th>
            <th class="text text-left">@lang('TrxId')</th>
            <th class="text text-left">@lang('Method')</th>
            <th class="text text-left">@lang('Date')</th>
            <th class="text text-right">@lang('Waiver')
                <span>({{school('country')->code == 'BD' ? '৳' : '$'}})</span>
            </th>
            <th class="text text-right">@lang('Fine') <span>({{school('country')->code == 'BD' ? '৳' : '$'}})</span>
            </th>
            <th class="text text-right">@lang('Paid') <span>({{school('country')->code == 'BD' ? '৳' : '$'}})</span>
            </th>
            <th class="text text-right">@lang('Balance')</th>
        </tr>
        </thead>
        <tbody>
        @if($user->due->count())
            @php
                $grandTotal=$waiverTotal=$fineTotal=$paidTotal=$balanceTotal=0;
            @endphp
            @foreach($user->due as $due)
                @php
                    $grandTotal +=$due->fee->amount;
                @endphp
                <tr class="dark-gray">
                    <td>{{$due->fee->account_sector->name}}</td>
                    <td class="text text-left">
                        {{date('d-M-Y',strtotime($due->fee->date))}}
                    </td>
                    <td class="text text-left">
                        @if($due->status == 2)
                            <span class="label label-success">@lang('Paid')</span>
                        @else
                            <span class="label label-danger">@lang('Unpaid')</span>
                        @endif
                    </td>
                    <td class="text text-right">  {{number_format($due->fee->amount,2)}}</td>
                    <td colspan="4" class="text text-right">0.00</td>
                    <td class="text text-right">0.00</td>
                    <td class="text text-right">0.00</td>
                    <td class="text text-right">
                        @if(count($due->paymentDetail) == 0)
                            @php $balanceTotal += $due->fee->amount; @endphp
                            {{number_format($due->fee->amount,2)}}
                        @endif
                    </td>
                </tr>
                @if(count($due->paymentDetail) > 0)
                    @php $alreadyPaid =$balance= 0 @endphp
                    @foreach($due->paymentDetail as $paymentDetail)
                        @php
                            $waiverTotal +=$paymentDetail->waiver;
                            $fineTotal +=0;
                            $paidTotal +=$paymentDetail->amount;
                            if ($due->status == 1 && $due->paymentDetail->last() == $paymentDetail){
                                $balance = $due->fee->amount-($alreadyPaid+$paymentDetail->amount+$paymentDetail->waiver);
                                $balanceTotal += $balance;
                            }else{
                                $alreadyPaid += $paymentDetail->amount+$paymentDetail->waiver;
                            }
                        @endphp
                        <tr class="white-td">
                            <td colspan="4" class="text-right">
                                <img src="{{asset('img/table-arrow.png')}}"
                                     alt="">
                            </td>
                            @if($paymentDetail->payment->payment_type == 2)
                                @php $payment_type = 'SSLCommerz'; @endphp
                            @elseif($paymentDetail->payment->payment_type == 3)
                                @php $payment_type = 'Stripe'; @endphp
                            @elseif($paymentDetail->payment->payment_type == 4)
                                @php $payment_type = 'Paypal'; @endphp
                            @elseif($paymentDetail->payment->payment_type == 5)
                                @php $payment_type = 'Rocket'; @endphp
                            @else
                                @php $payment_type = 'Cash'; @endphp
                            @endif
                            <td class="text text-left">
                                @if(auth()->user()->role == 'admin')
                                    <a href="{{route('invoice',$paymentDetail->payment->reciept_number)}}"
                                       target="_blank" class="popTop"
                                       title='<span style="width:50%" class="">@lang('Online fees deposit through') {{$payment_type}} TXN ID: {{$paymentDetail->payment->reciept_number}} <br> @lang('Collected By'): {{$paymentDetail->payment->user->name}}</span>
                                                                    '> {{$paymentDetail->payment->reciept_number}}</a>
                                @else
                                    {{$paymentDetail->payment->reciept_number}}
                                @endif
                            </td>
                            <td class="text text-left">{{$payment_type}}</td>
                            <td class="text text-center">
                                {{date('d-M-Y',strtotime($paymentDetail->payment->trans_date))}}
                            </td>
                            <td class="text text-right">{{number_format($paymentDetail->waiver,2)}}</td>
                            <td class="text text-right">0.00</td>
                            <td class="text text-right">{{number_format($paymentDetail->amount,2)}}</td>
                            <td class="text text-right">
                                @if($balance>0)
                                    {{number_format($balance,2)}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
            @endforeach
        @else
            <tr>
                <td colspan="11" class="text-center text-danger">@lang('These student has no Financial Statement')</td>
            </tr>
        @endif
        </tbody>
        @if($user->due->count())
            <tfoot>
            <tr>
                <td colspan="3" class="text text-right">@lang('Grand Total')</td>
                <td class="text text-right">{{school('country')->code == 'BD' ? '৳' : '$'}}{!! number_format($grandTotal,2) !!}</td>
                <td colspan="4"
                    class="text text-right">{{school('country')->code == 'BD' ? '৳' : '$'}}{!! number_format($waiverTotal,2) !!}</td>
                <td class="text text-right">{{school('country')->code == 'BD' ? '৳' : '$'}}{!! number_format($fineTotal,2) !!}</td>
                <td class="text text-right">{{school('country')->code == 'BD' ? '৳' : '$'}}{!! number_format($paidTotal,2) !!}</td>
                <td class="text text-right">{{school('country')->code == 'BD' ? '৳' : '$'}}{!! number_format($balanceTotal,2) !!}</td>
            </tr>
            </tfoot>
        @endif
    </table>
</div>

@if(auth()->user()->role != 'student')
{{--   <a class="btn btn-xs btn-success" href="{{route('accounts.moneyreceipt')}}?studentId={{$user->student_code}}" target="_blank">@lang('Receive')</a>--}}

@isset($due->student->student_code)
    <a class="btn btn-xs btn-success" href={{route('accounts.ledger.searchdata',[$due->student->student_code,date('d-m-Y')])}}>@lang('Receive Fee')</a>
@endisset

   <a class="btn btn-xs btn-success" href={{url('fees/singale_create/'.$user->student_code)}}>@lang('Create Due')</a>
@endif
