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
                    <h5 class="m-0"><i><b>Selected plan <code>{{$pricing->title}}</code> for your subscription.</b></i></h5>  
                    @if($pricing->country=='Bangladesh')
                        @php 
                            $cs='৳'; 
                            $total = $pricing->price / (1 - 0.025);
                            $amount = round($total, 2);
                            $tran_fee = round($total, 2) - $pricing->price;
                        @endphp
                    @else
                        @php 
                            $cs='$';
                            $total = ($pricing->price + 0.30) / (1 - 0.029);
                            $amount = round($total, 2);
                            $tran_fee = round($total, 2) - $pricing->price;
                        @endphp
                    @endif 
                    <div class="col-md-6 col-sm-6">
                        <div class="clearhight"></div>
                        <h5 class="h5_detail">
                            <strong>Subscription {{subscription($pricing->subsMonth).' '.$cs.' '.$pricing->price}} </strong>
                        </h5>
                        <h5 class="h5_detail"> 
                            <div class="checkbox {{Session::has('checked')?'form-group has-error':''}}"> 
                              <label><input type="checkbox" value="" name="percentage" id="percentage">Keep your percentage (<i>If you want to pay without your percentage.</i>)</label>
                            </div>  
                        </h5>
                        <div class="p_radio pr1">Payable Amount: {{$cs}} <span id="amount"> {{$pricing->price}} </span></div>
                        <div class="p_radio pr2">+ Transaction Fee: {{$cs}} <span id="tran_fee">{{$tran_fee}}</span></div>
                        <div class="p_radio pr4"><b>Total Amount To Be Paid: {{$cs}} <span id="total_amount"> {{$amount}} </span></b></div>
                        <div class="clearhight"></div>
                        @if($pricing->country == 'Bangladesh')
                            {!! Form::open(array('route' =>['school.renew.now',[$schools->code,$pricing->code]],'method' =>'POST','role' =>'form','autocomplete'=>'off','class'=>'stripe')) !!}
                                <div id="myPercent"></div>
                                <button class="plan-detail" type="submit">Pay Now</button>
                            {!! Form::close() !!}  
                        @else
                            {!! Form::open(array('route' =>['renew.now',[$schools->code,$pricing->code]],'method' =>'POST','role' =>'form','autocomplete'=>'off','class'=>'stripe')) !!}
                            <div id="myPercent"></div>
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
                        <a href="{{ route('school.payments.subscriptionplan',$schools->code) }}" class="plan-detail href">Cancel</a>
                    </div> 
                </div>
            </div>   
        </div>
    </div>
</div>  
@push('script')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $(document).on("change", "#percentage", function() {
            if(this.checked) { 
                var disc = "{{getAgentByCode($schools->agentcode)->agent->shareOf}}";
                $('#myPercent').html("<input value='1' name='mypercent' id='percent' style='display:none'>");
            }else{ 
                var disc = 0;  
                $('#percent').remove(); 
            } 
            var main = "{{$pricing->price}}";
            var dec = disc / 100; 
            var mult = (main * dec).toFixed(2);
            var amount = main - mult;

            var country = "{{$pricing->country}}";
            if (country=='Bangladesh') {
                var total = amount / (1 - 0.025);
            }else{
                var total = (amount + 0.30) / (1 - 0.029);
            }; 

            var tran_fee = parseFloat(total - amount).toFixed(2); 

            $('#amount').text(amount);
            $('#tran_fee').text(tran_fee);
            var total_amount = parseFloat(amount) + parseFloat(tran_fee);
            $('#total_amount').text(total_amount);
        }); 
    </script> 
@endpush
@endsection

