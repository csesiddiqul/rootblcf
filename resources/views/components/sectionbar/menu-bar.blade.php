<div class="panel-body pull-left" id="menuSection" style="padding-top: 0px !important; ">
    <div class="btn-group new_b" style="overflow: hidden;">
        <a href="{{route('academic.menu.index')}}" class="btn {{(\Route::current()->getName() == 'academic.menu.index')? 'active':''}}"> @lang('Menu List')</a>
        <a href="{{route('academic.menu.create')}}" class="btn {{(\Route::current()->getName() == 'academic.menu.create')? 'active':''}}" id="changeGreen">@lang('Menu Add')</a>
        <a href="{{route('academic.content.index')}}" class="btn {{(\Route::current()->getName() == 'academic.content.index')? 'active':''}}" id="changeGreen"> @lang('Content List')</a>
        <a href="{{route('academic.content.create')}}" class="btn {{(\Route::current()->getName() == 'academic.content.create')? 'active':''}}" id="changeGreen"> @lang('Content Add')</a>
    </div>
</div>
<div class="clearfix"></div>