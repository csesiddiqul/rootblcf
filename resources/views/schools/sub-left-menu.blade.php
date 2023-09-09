<div class="btn-group new_b" style="overflow: hidden;">
    <a href="{{route('school.subscription')}}" class="btn {{(\Route::current()->getName() == 'school.subscription')? 'active':''}}">@lang('Subscription')</a>
    <a href="{{route('school.subscription.plans')}}" class="btn {{(\Route::current()->getName() == 'school.subscription.plans')? 'active':''}}">@lang('Plans')</a> 
</div>  