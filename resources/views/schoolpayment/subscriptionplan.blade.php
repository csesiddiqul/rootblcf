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
            <div class="panel panel-default col-sm-12"> 
                @include('schoolpayment.top-menu')
                <div class="panel-body p-0">  
                    <h5 class="m-0"><i><b>Select a plan for your subscription:</b></i></h5>
                    @if (count($pricings)>0)
                        @foreach ($pricings as $key=>$pricing)
                            @if($pricing->country=='Bangladesh')
                                @php $cs='৳'; @endphp
                            @else
                                @php $cs='$';@endphp
                            @endif 
                        <div class="col-md-3 col-sm-4">
                            <div class="pricing-table">
                                <h3 class="title">{{$pricing->title}}</h3>
                                <div class="price-value"> 
                                    <span class="price-title">{{subscription($pricing->subsMonth)}}</span> <span class="price"> <span class="currency">{{$cs}}</span> <span class="value">{{$pricing->price}}</span></span>
                                </div>
                                <ul class="pricing-content">
                                    <li class="li-details">{!!nl2br($pricing->details)!!}</li> 
                                </ul>
                                <a href="{{route('school.payments.subscription.plandetails',[$schools->code,$pricing->code])}}" class="pricing-table-button">Renew Now</a> 
                            </div>
                        </div>
                        @endforeach
                    @else  
                        @include('schoolpayment.countdown')
                    @endif
                </div>
            </div>   
        </div>
    </div>
</div>  
@push('script') 
    <script>
        var maxHeight = 0; 
        $(".li-details").each(function(){
           if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
        }); 
        $(".li-details").height(maxHeight);
    </script> 
@endpush
@endsection

