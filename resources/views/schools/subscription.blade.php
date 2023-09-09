@extends('layouts.app') 
@section('title', __('Master Dashboard')) 
@section('content')  
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar') 
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default col-sm-12"> 
                <div class="panel-body p-0"> 
                    @include('schools.sub-left-menu') 
                    @include('schools.countdown')
                    <div class="table-responsive">   
                        <table class="table table-bordered table-data-div table-condensed table-striped table-hover" style="margin-top: 10px !important; ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('Trans_No')</th>
                                <th scope="col">@lang('Amount Paid')</th>
                                <th scope="col">@lang('Subscription')</th>
                                <th scope="col">@lang('Start Date')</th> 
                                <th class="textleft" scope="col">@lang('End Date')</th>
                                {{--<th scope="col">@lang('Status')</th>--}} 
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($subscriptions)>0)
                                @foreach ($subscriptions as $key=>$subscription)  
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th> 
                                    <td>{{$subscription->schoolPayment->trans_number}}</td>
                                    <td>
                                        @if($subscription->schoolPayment->currency=='bdt' || $subscription->schoolPayment->currency=='BDT')
                                            @php $cs='৳'; $format = 'd-m-Y h:i:s A'; @endphp
                                        @else
                                            @php $cs='$'; $format = 'm-d-Y H:i:s'; @endphp
                                        @endif 
                                        {{$cs.$subscription->schoolPayment->amount}}
                                    </td> 
                                    <td>{{subscription($subscription->month)}} </td>  
                                    <td>{{ date($format,strtotime($subscription->rangeFrom)) }}</td> 
                                    <td class="textleft">{{ date($format,strtotime($subscription->rangeTo)) }}</td> 
                                    {{--<td>
                                        @if(strtotime(now()) > strtotime($subscription->rangeTo))
                                            <span class="btn btn-xs btn-danger btn-block">Expired</span>
                                        @else
                                            <span class="btn btn-xs btn-info btn-block">Active</span>
                                        @endif 
                                    </td> --}}
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="6" class="text-center text-danger">@lang('No Related Data Found.')</td>
                                    <td>&nbsp;</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>   
@endsection
