<div class="panel-body" id="feeSection">
    <div class="btn-group new_b" style="overflow: hidden;">
        <a href="{{ route('fees.create') }}" class="btn {{(\Route::current()->getName() == 'fees/create')? 'active':''}}"> @lang('Add Fee') </a>
        <a href="{{ route('fees.index') }}" class="btn {{(\Route::current()->getName() =='fees.index')? 'active':''}}" id="changeGreen">@lang('Fee All')</a>
    </div>
</div>
<div class="clearfix"></div>