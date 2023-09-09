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
                    <div class="clearfix"></div>
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
                                @if($pricing->country == 'Bangladesh') 

                                    <a href="{{route('school.renew.now',[auth()->user()->code,$pricing->code])}}" class="pricing-table-button">Renew Now</a> 

                                @else 
                                    {!! Form::open(array('route' =>['renew.now',[auth()->user()->code,$pricing->code]],'method' =>'POST','role' =>'form','autocomplete'=>'off')) !!}
                                    <script
                                        src="https://checkout.stripe.com/checkout.js" class="stripe-button" 
                                        data-key="{{stripe_secretKey()}}" 
                                        data-currency="usd"
                                        data-name="{{auth()->user()->school->name}}"
                                        data-email="{{auth()->user()->email}}"
                                        data-allow-remember-me="true"
                                        data-description="Renew Subscription"
                                        data-image="https://www.foqas.com/img/title_icon.png"
                                        data-locale="auto"
                                        data-panel-label="Pay Now"
                                        data-label="Renew Now"
                                        data-zip-code="true">
                                    </script>
                                    {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @else  
                        @include('schools.countdown')
                    @endif
                </div>
            </div>  
        </div>
    </div>
</div>  
@push('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var maxHeight = 0; 
        $(".li-details").each(function(){
           if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
        }); 
        $(".li-details").height(maxHeight);
    </script> 
@endpush
@endsection

