<div class="panel-body pull-left" id="divisionSection">
    <div class="btn-group new_b" style="overflow: hidden;">
        <a href="{{route('academic.division.index')}}" class="btn {{(\Route::current()->getName() == 'academic.division.index')? 'active':''}}">@lang('Division List')</a>
        <a href="{{route('academic.division.create')}}" class="btn {{(\Route::current()->getName() == 'academic.division.create')? 'active':''}}" id="changeGreen"> @lang('Division Add')</a>
    </div>
</div>
<div class="clearfix"></div>