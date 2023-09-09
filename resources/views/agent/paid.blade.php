@extends('layouts.app') 
@section('title', __('Master Dashboard')) 
@section('content')  
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">  
            @if(Auth::user()->role == 'master') 
                @include('layouts.master-left-menu')
            @elseif(Auth::user()->role == 'agent') 
                @include('layouts.agent-left-menu')  
            @endif
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default pt-0">
                @include('agent.pay-menu') 
                <div class="panel-body">
                    <div class="table-responsive"> 
                        @if (count($receiveds)>0)
                            @include('agent.date-range')
                        @endif
                        <table class="table table-bordered table-data-div table-condensed table-striped table-hover" style="margin-top: 10px !important; ">
                            <thead>
                            <tr> 
                                <th scope="col">@lang('School')</th>
                                <th scope="col">@lang('Payment For')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('Paid')</th>
                                <th scope="col">@lang('Date')</th> 
                                <th scope="col">@lang('Trans_No')</th>
                                <th scope="col" class="textleft">@lang('Trans./Cheque_No')</th>  
                            </tr>
                            </thead>
                            <tbody>  
                            @if (count($receiveds)>0)
                                @foreach ($receiveds as $key=>$received)
                                <tr>  
                                    <td><code title="{{$received->school->name}}" class="popRight">{{ $received->school->short_name }}</code></td> 
                                    <td>{{pricingfor($received->purpose_id)}}</td> 
                                    <td>
                                        @if($received->currency=='bdt' || $received->currency=='BDT')
                                            ৳{{$received->amount}}
                                        @else
                                            ${{$received->amount}}
                                        @endif 
                                    </td> 
                                    <td> 
                                        <span title="{{$received->shareOf}}%" class="popRight">
                                            @if($received->currency=='bdt' || $received->currency=='BDT')
                                                ৳{{$received->percentTk}}
                                            @else
                                                ${{$received->percentTk}}
                                            @endif 
                                        </span>
                                    </td> 
                                    <td>{{ date('m-d-Y',strtotime($received->trans_date)) }}</td> 
                                    <td>{{ $received->trans_number }}</td> 
                                    <td class="textleft">
                                        @if(Auth::user()->role == 'master') 
                                            @php $sNote = $received->sNote; @endphp
                                        @else 
                                            @php $sNote = "Your transaction number with ".faAcademy()->short_name; @endphp  
                                        @endif
                                        <span title="{{$sNote}}" class="popTop">
                                        @if(!empty($received->tranCheque))
                                            {{$received->tranCheque}}
                                        @else
                                            ---
                                        @endif 
                                        </span>
                                    </td>   
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
