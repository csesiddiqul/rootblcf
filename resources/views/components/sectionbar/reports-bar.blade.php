 @if(Auth::user()->role == 'admin' || Auth::user()->role == 'accountant')
<div class="panel-body pad-bot-top" >
    <div class="btn-group new_b pull-left" style="overflow: hidden;">
 		<a style="font-weight: bold" href="{{ route('accounts.duereport') }}" class="btn {{(\Route::current()->getName() == 'accounts.duereport')? 'active':''}}">@lang('Due Report')</a>

 		<a style="font-weight: bold" href="{{ route('accounts.studentfeereport') }}" class="btn {{(\Route::current()->getName() == 'accounts.studentfeereport')? 'active':''}}">@lang('Student Due Report')</a>

 		<a style="font-weight: bold" href="{{ route('accounts.studentpaymentreport') }}" class="btn {{(\Route::current()->getName() == 'accounts.studentpaymentreport')? 'active':''}}">@lang('Student Payment Report')</a>

    	<a style="font-weight: bold" href="{{ route('accounts.monthlyreport') }}" class="btn {{(\Route::current()->getName() == 'accounts.monthlyreport')? 'active':''}}">@lang('Monthly Report')</a>
    	<a style="font-weight: bold" href="{{ route('accounts.expensereport') }}" class="btn {{(\Route::current()->getName() == 'accounts.expensereport')? 'active':''}}">@lang('Expense Report')</a>

    	<a style="font-weight: bold" href="{{ route('accounts.incomeexpense') }}" class="btn {{(\Route::current()->getName() == 'accounts.incomeexpense')? 'active':''}}">@lang('Income Expense Report')</a>

		<a style="font-weight: bold" href="{{ route('accounts.set_notes.edit',$id = 1) }}" class="btn {{(\Route::current()->getName() == 'accounts.set_notes.edit')? 'active':''}}">@lang('Balance Sheet Notes')</a>

		<a style="font-weight: bold" href="{{ route('accounts.pay_receive.index') }}" class="btn {{(\Route::current()->getName() == 'accounts.pay_receive.index')? 'active':''}}">@lang('Payable Receivables')</a>

		<a style="font-weight: bold" href="{{ route('accounts.adjustmentReport') }}" class="btn {{(\Route::current()->getName() == 'accounts.adjustmentReport')? 'active':''}}">@lang('Adjustment RP') </a>

	</div>
</div>
@endif
