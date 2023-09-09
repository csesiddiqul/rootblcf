<div class="btn-group new_b agent-menus" style="overflow: hidden;"> 
	@if(Auth::user()->role == 'master') 
        @php($code=$aguser->student_code)
    @else
        @php($code=auth()->user()->student_code)
    @endif
    <a href="{{ route('agent.index',$code) }}" class="btn {{(\Route::current()->getName() == 'agent.index')? 'active':''}}">@lang('Payment Received')</a>

    @if(Auth::user()->role == 'master')  
    	<a href="{{ route('agent.profile',$aguser->student_code) }}" class="btn btn-agent">{{$aguser->name}}</a> 
    @endif  
</div> 