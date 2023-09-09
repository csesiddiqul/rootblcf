@extends('layouts.app') 
@section('title', __('Master Dashboard')) 
@section('content')    
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar"> 
            @include('layouts.leftside-menubar')   
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="panel-heading"> 
                    @lang('Make a Payment')
                </div>
                <div class="panel-body p-0">  
                    <h5 class="">
                        <i><b>Your service charge has been paid till 
                            <code>
                                @if(!empty($schools->lastCharged))
                                    {{date('F, Y', strtotime($schools->lastCharged))}}
                                @else
                                    &#9745; Service charge not paid yet.
                                @endif
                            </code>
                        </b></i>
                    </h5>
                    <div class="col-md-6 col-sm-6 box_detail">
                        @php
                            $lastCharged = $schools->lastCharged;
                            if(empty($lastCharged)){
                                $createday = date('d',strtotime($schools->created_at));
                                $createdmy = strtotime($schools->created_at);
                                if($createday>=16){
                                    if($createday>28){
                                        $lastCharged = date('Y-m-d H:i:s', strtotime('-3 day',$createdmy));  
                                    }else{
                                        $lastCharged = date('Y-m-d H:i:s', strtotime($schools->created_at));  
                                    } 
                                }else{ 
                                    $lastCharged = date('Y-m-d H:i:s', strtotime('-1 month', $createdmy)); 
                                } 
                            }

                            $paidtill = strtotime($lastCharged);
                            $prev_date = date('Y-m',strtotime($lastCharged));
                            $current_ym = date('Y-m');
                            $current_str = strtotime($current_ym);
                            $today = date('d'); 
                            $months = $totla_stdnt = 0;
                            $checked = '';  

                            if($today>=21){
                                $pr_month = date('Y-m', strtotime('+1 month', $current_str)); 
                                $current_date = strtotime($pr_month);   
                            }else{
                                $current_date = $current_str;
                            }

                            $diff = $current_date - strtotime($prev_date);
                            $months = floor(floatval($diff) / (60 * 60 * 24 * 365 / 12)); 
                            echo '<label class="m-0">Pay service charge till:</label>';
                            for($i=1; $i <=$months; $i++)
                            {
                                ${"payable_months".$i} = date('F, y',strtotime("+$i Months",$paidtill));
                                echo '<div class="radio mtb-5"><label>';
                                if($i==$months){
                                    $checked = 'checked';
                                }
                                echo '<input value="'.$i.'" id="ra_'.$i.'" type="radio" name="tillmonth"'.$checked.' >'.${"payable_months".$i};
                                echo '</label></div>';
                            } 

                            $totla_stdnt = total_student_current_school();
                            $per_stdnt = $schools->perStudent;
                            $total_amount = ($totla_stdnt*$per_stdnt)*$months;
                            $total_chage = round($total_amount, 2);
                            $mnts = ' Months';
                            $country = $schools->country->code; 

                            if($months==1){
                                $mnts = ' Month';
                            }

                            if($country=='BD'){
                                $cny = '৳';
                                $total = $total_chage / (1 - 0.025); 
                                $tran_fee = round($total, 2) - $total_chage; 
                                $amount = round($total, 2);
                            }else{
                                $cny = '$';
                                $total = ($total_chage + 0.30) / (1 - 0.029); 
                                $tran_fee = round($total, 2) - $total_chage;
                                $amount = round($total, 2);
                            }
                        @endphp
                        <div class="p_radio pr1">Total Students: <span>{{$totla_stdnt}}</span></div>
                        <div class="p_radio pr2">Per Student: <span>{{$cny.$per_stdnt}}</span></div>
                        <div class="p_radio pr3">Total Month: <span>{{$months.$mnts}}</span></div>
                        <div class="p_radio pr4">Total Service Charge: {{$cny}}<span>{{$total_chage}}</span></div>
                        <div class="p_radio pr5">+ Transaction Fee: {{$cny}}<span>{{$tran_fee}}</span></div>
                        <div class="p_radio pr6">Total Amount To Be Paid: {{$cny}}<span>{{$amount}}</span></div>
                    </div>
                    <div class="clearhight"></div>
                    <div class="col-md-6 col-sm-6">
                        @if($country=='BD' && $amount >= 10)  
                            {!! Form::open(array('route' =>['school.service.charge',$schools->code],'method' =>'POST','role' =>'form','autocomplete'=>'off','class'=>'stripe')) !!}
                                <input name="month_of" type="hidden" value="{{$months}}" id="month_of" required>
                                <button class="plan-detail" type="submit">Pay Charge</button>
                            {!! Form::close() !!}  
                        @elseif($amount >= 1) 
                            {!! Form::open(array('route' =>['school.services.charge',$schools->code],'method' =>'POST','role' =>'form','autocomplete'=>'off','class'=>'stripe')) !!}
                            <input name="month_of" type="hidden" value="{{$months}}" id="month_of" required>
                            <script
                                src="https://checkout.stripe.com/checkout.js" class="stripe-button" 
                                data-key="{{stripe_secretKey()}}" 
                                data-currency="usd"
                                data-name="{{auth()->user()->school->name}}"
                                data-email="{{auth()->user()->email}}"
                                data-allow-remember-me="true"
                                data-description="Service Charge"
                                data-image="https://www.foqas.com/img/title_icon.png"
                                data-locale="auto"
                                data-panel-label="Pay Now"
                                data-label="Pay Charge"
                                data-zip-code="true">
                            </script>
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
@push('script')
    <script> 
        $('input[name="tillmonth"]').change(function(){  
            var totla_stdnt = '{{$totla_stdnt}}';
            var per_stdnt = '{{$per_stdnt}}';
            if( $(this).is(":checked") ){ 
                var months = $(this).val(); 
            }else{
                var months = '{{$months}}';
            }
            if (months>1) {
                var mnts = ' Months';
            }else{
                var mnts = ' Month';
            }

            var total_amount = (totla_stdnt*per_stdnt)*months;
            var total_chage = parseFloat(total_amount).toFixed(2);
            $('.pr3 span').text(months+mnts);
            $('.pr4 span').text(total_chage);
            $('#month_of').val(months);
            
            if ('{{$country}}'=='BD') {
                var total = total_chage / (1 - 0.025); 
            }else{
                var total = parseFloat(total_amount + 0.30) / parseFloat(1 - 0.029); 
            }; 

            var tran_fee = parseFloat(total - total_amount).toFixed(2);
            var total_pay = parseFloat(parseFloat(total_amount) + parseFloat(tran_fee)).toFixed(2);
            $('.pr5 span').text(tran_fee);
            $('.pr6 span').text(total_pay); 
        });
    </script>
@endpush
@endsection