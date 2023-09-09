<div class="panel-body pull-left" id="importantLinkSection">
    <div class="btn-group new_b" style="overflow: hidden;">
        <a href="{{route('academic.importantLink.index')}}" class="btn {{(\Route::current()->getName() == 'academic.importantLink.index')? 'active':''}}"> @lang('Important Link List')</a>
        <a href="{{route('academic.importantLink.create')}}" class="btn {{(\Route::current()->getName() == 'academic.importantLink.create')? 'active':''}}" id="changeGreen"> @lang('Important Link Add')</a>
    </div>
</div>
<div class="clearfix"></div>