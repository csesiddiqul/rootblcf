<div class="panel-body pad-bot-top pl-0 pr-0">
    <div class="btn-group new_b pull-left" style="overflow: hidden;"> 
       <a href="{{route('academic.branch.index')}}" class="btn {{(\Route::current()->getName() == 'academic.branch.index')? 'active':''}}">@lang('Branch List')</a>
	</div>
    @isset($branchs)
        <div class="pull-right">
            <a href="{{route('academic.branch.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Branch')</a>
        </div>
    @endisset
</div>
<div class="clearfix"></div>
  