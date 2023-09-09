<div class="panel-heading"> 
    @if(Auth::user()->role == 'master')
        <a id="topback" href="{{route('schools.index')}}" class="">@lang('Schools')</a> / 
    @else
    	<a id="topback" href="{{ route('agent.school.list',auth()->user()->student_code) }}" class="">@lang('Schools')</a> / 
    @endif
    {{$schools->name}}
</div>
<div class="btn-group new_b agent-menus" style="overflow: hidden;"> 
    <a href="{{ route('school.payments.indexlist',$schools->code) }}" class="btn {{(\Route::current()->getName() == 'school.payments.indexlist')? 'active':''}}">@lang('Payment Received')</a> 
    <a href="{{ route('school.payments.subscriptionlist',$schools->code) }}" class="btn {{(\Route::current()->getName() == 'school.payments.subscriptionlist')? 'active':''}}">@lang('Subscription')</a> 

    @if(auth()->user()->role=='agent')
    <a href="{{ route('school.payments.subscriptionplan',$schools->code) }}" class="btn {{(\Route::current()->getName() == 'school.payments.subscriptionplan'|| \Route::current()->getName() == 'school.payments.subscription.plandetails')? 'active':''}}">@lang('Plans')</a> 
    <a href="{{ route('school.make.payment.agent',$schools->code) }}" class="btn {{(\Route::current()->getName() == 'school.make.payment.agent')? 'active':''}}">@lang('Make a payment')</a> 
    @elseif(auth()->user()->role=='master')
    <a href="{{ route('school.make.payment.fa',$schools->code) }}" class="btn {{(\Route::current()->getName() == 'school.make.payment.fa')? 'active':''}}">@lang('Make a payment')</a> 
    <a href="{{ route('school.make.payment.fa',$schools->code) }}" class="btn {{(\Route::current()->getName() == 'school.make.payment.fa')? 'active':''}}">@lang('Payment Received By School')</a>
    @endif
</div>