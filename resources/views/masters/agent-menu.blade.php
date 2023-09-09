<div class="btn-group new_b" style="overflow: hidden;">
    <a href="{{route('agents.index')}}" class="btn {{(\Route::current()->getName() == 'agents.index')? 'active':''}}">@lang('Agents')</a>
    <a href="{{route('agents.create')}}" class="btn {{(\Route::current()->getName() == 'agents.create')? 'active':''}}">@lang('Add an Agent')</a> 
</div>