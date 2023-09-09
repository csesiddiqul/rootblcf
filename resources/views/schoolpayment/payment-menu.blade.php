<div class="panel-heading">  
    <a id="topback" href="{{route('schoolpayments.index')}}">@lang('Payment Received')</a> 
</div>
<div class="btn-group new_b fqsp" style="overflow: hidden;">
    <a href="{{route('schoolpayments.index')}}" class="btn {{(\Route::current()->getName() == 'schoolpayments.index')? 'active':''}}">@lang('Paid')</a> 
    <a href="{{route('index.payments.unpaid')}}" class="btn {{(\Route::current()->getName() == 'index.payments.unpaid')? 'active':''}}">@lang('Unpaid')</a> 
    <a href="{{route('index.payments.failed')}}" class="btn {{(\Route::current()->getName() == 'index.payments.failed')? 'active':''}}">@lang('Failed')</a> 
    <a class="btn">@lang('Start date')@lang(':')</a>  
    <a class="btn inp-btn"><input id="startdate" value="{{date('m-d-Y', mktime(0, 0, 0, date('m')-1, 1))}}" class="datepicker" autocomplete="off"></a>  
    <a class="btn">@lang('End date')@lang(':')</a>   
    <a class="btn inp-btn"><input id="enddate" value="{{date('m-d-Y',strtotime(now()))}}" class="datepicker" autocomplete="off"></a> 
    <a class="btn fltr-btn" id="filter">@lang('Filter')</a>   
    <a href="{{ route('schoolpayments.index') }}" class="btn fltr-btn">@lang('Refresh')</a>  
</div>