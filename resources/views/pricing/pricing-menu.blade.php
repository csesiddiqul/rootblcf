<div class="btn-group new_b" style="overflow: hidden;">
    <a href="{{route('pricings.index')}}" class="btn {{(\Route::current()->getName() == 'pricings.index')? 'active':''}}">@lang('Pricings')</a>
    <a href="{{route('pricings.create')}}" class="btn {{(\Route::current()->getName() == 'pricings.create')? 'active':''}}">@lang('Add a Price')</a> 
</div>