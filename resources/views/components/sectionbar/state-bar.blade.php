<div class="panel-body pull-left" id="stateSection">
    <div class="btn-group new_b" style="overflow: hidden;">
        <a href="{{route('academic.state.index')}}" class="btn {{(\Route::current()->getName() == 'academic.state.index')? 'active':''}}">@lang('State List')</a>
        <a href="{{route('academic.state.create')}}" class="btn {{(\Route::current()->getName() == 'academic.state.create')? 'active':''}}" id="changeGreen">@lang('State Add')</a>
    </div>
</div>
<div class="clearfix"></div>