<div class="panel-heading"> 
    @if(Auth::user()->role == 'master') 
        <a id="topback" href="{{ route('agent.profile',$aguser->student_code) }}">@lang('Agent Payments')</a> <strong> ( {{$aguser->agent->shareOf}}% )</strong>
    @else
    	<a id="topback" href="#">@lang('My Payments')</a>
    @endif   
</div>
<div class="btn-group new_b agent-menus" style="overflow: hidden;"> 
    <a href="{{ route('agent.unpaid',$aguser->student_code) }}" class="btn {{(\Route::current()->getName() == 'agent.unpaid')? 'active':''}}">@lang('Unpaid')</a> 
    <a href="{{ route('agent.paid',$aguser->student_code) }}" class="btn {{(\Route::current()->getName() == 'agent.paid')? 'active':''}}">@lang('Paid')</a> 
    @if(Auth::user()->role == 'master')  
        <a href="{{ route('agent.profile',$aguser->student_code) }}" class="btn btn-agent">{{$aguser->name}}</a> 
    @endif 
</div>