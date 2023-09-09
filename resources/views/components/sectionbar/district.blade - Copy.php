<div class="">
    <div class="btn-group new_b" style="overflow: hidden;">
        <a href="{{route('academic.thana.index')}}" class="btn {{(\Route::current()->getName() == 'academic.thana.index')? 'active':''}}">@lang('View Thana')</a>
        <a href="{{route('academic.thana.create')}}" class="btn {{(\Route::current()->getName() == 'academic.thana.create')? 'active':''}}" id="changeGreen">@lang('Add Thana')</a>
    </div>
</div>
<div class="clearfix"></div>