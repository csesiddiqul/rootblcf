<div class="panel-body pull-left" id="districtSection">
    <div class="btn-group new_b" style="overflow: hidden;">
        <a href="{{route('academic.district.index')}}" class="btn {{(\Route::current()->getName() == 'academic.district.index')? 'active':''}}"> @lang('District list')</a>
        <a href="{{route('academic.district.create')}}" class="btn {{(\Route::current()->getName() == 'academic.district.create')? 'active':''}}" id="changeGreen">@lang('District Add')</a>
    </div>
</div>
<div class="clearfix"></div>