
<div class="panel-body pull-left" id="committeeSection" style="padding-left: 5px !important; padding-top: 0px !important; ">
    <div class="btn-group new_b" style="overflow: hidden;">
        <a href="{{route('academic.committee.index')}}" class="btn {{(\Route::current()->getName() == 'academic.committee.index')? 'active':''}}">@lang(' Committee Member list')</a>
        <a href="{{route('academic.committee.create')}}" class="btn {{(\Route::current()->getName() == 'academic.committee.create')? 'active':''}}" id="changeGreen"> @lang('Committee Member Add')</a>
    </div>
</div>
<div class="clearfix"></div>