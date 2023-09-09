<style>
	

</style>

<div class="panel-body pad-bot-top pr-0">
    <div class="btn-group new_b pull-left" style="overflow: hidden;"> 
       <a href="{{route('attendance.index',auth()->user()->school->code)}}" class=" btn {{(\Route::current()->getName() == 'attendance.index')? 'active':''}}" id="atn">@lang('Take Attendances')</a>
        <a href="{{route('attendance.reportByDate',auth()->user()->school->code)}}" class=" btn {{(\Route::current()->getName() == 'attendance.reportByDate')? 'active':''}}" id="atn">@lang('Report By Date')</a>
        <a href="{{route('attendance.reportByMonth',auth()->user()->school->code)}}" class=" btn {{(\Route::current()->getName() == 'attendance.reportByMonth')? 'active':''}}" id="atn">@lang('Report By Month')</a>
	</div>
    
</div>
<div class="clearfix"></div>
