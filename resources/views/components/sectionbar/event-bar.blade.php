<div class="panel-body pull-left" id="EventSection" style="padding-top: 0px !important; ">
    <div class="btn-group new_b" style="overflow: hidden;">
        <a href="{{url('academic/event')}}"
           class="btn {{(\Route::current()->getName() == 'academic.event')? 'active':''}}" id="changeGreen">@lang('List Event')</a>
        <a href="{{route('academic.event.create')}}"
           class="btn {{(\Route::current()->getName() == 'academic.event.create')? 'active':''}}" id="changeGreen">@lang('Add Event')</a>
    </div>
</div>
<div class="clearfix"></div>