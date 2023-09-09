@if(Auth::user()->role == 'admin' || Auth::user()->role == 'accountant')
	<div class="panel-body pad-bot-top" >
		<div class="btn-group new_b pull-left" style="overflow: hidden; font-weight: bolder;">

			<a style="font-weight: bold" href="{{url('users/'.Auth::user()->school->code.'/accountant')}}" class="btn {{(\Request::url() == url('users/'.Auth::user()->school->code.'/accountant'))? 'active':''}}">@lang('Accountant List')</a>

			<a style="font-weight: bold" href="{{ route('accounts.financialyear.index') }}" class="btn {{(\Route::current()->getName() == 'accounts.financialyear.index')? 'active':''}}">@lang('Financial Year')</a>
			<a style="font-weight: bold" href="{{ url('accounts/ledger') }}" class="btn {{(\Request::url() == url('accounts/ledger'))? 'active':''}}">@lang('Ledger')</a>
			<a style="font-weight: bold" href="{{ url('accounts/sectors') }}" class="btn {{(\Request::url() == url('accounts/sectors'))? 'active':''}}">@lang('Accounts Head')</a>

			<a style="font-weight: bold" href="{{ route('fees.index') }}" class="btn {{(\Route::current()->getName() == 'fees.index') ? 'active':''}}">@lang('Fees')</a>
	<!--<a style="font-weight: bold" href="{{ route('fees.create') }}" class="btn {{(\Route::current()->getName() == 'fees.index') ? 'active':''}}">@lang('Add Fees')</a>-->

{{--			<a style="font-weight: bold" href="{{ route('accounts.committee_list.list') }}" class="btn {{(\Route::current()->getName() == 'accounts.committee_list.list') ? 'active':''}}">@lang('Collection')</a>--}}

			<a style="font-weight: bold" href="{{ route('accounts.moneyreceipt') }}" class="btn {{(\Route::current()->getName() == 'accounts.moneyreceipt')? 'active':''}}">@lang('Receive Status')</a>
			<a style="font-weight: bold" href="{{ route('accounts.income.index') }}" class="btn {{(\Route::current()->getName() == route('accounts.income.index'))? 'active':''}}">@lang('Income')</a>
			<a style="font-weight: bold" href="{{ route('accounts.expense.index') }}" class="btn {{(\Route::current()->getName() == route('accounts.expense.index'))? 'active':''}}">@lang('Expenses')</a>
			<a style="font-weight: bold" href="{{ route('accounts.student_payment_list') }}" class="btn {{(\Route::current()->getName() == route('accounts.student_payment_list'))? 'active':''}}">@lang('Student Payment')</a>
			<a style="font-weight: bold" href="{{ route('accounts.internal_transfer.index') }}" class="btn {{(\Route::current()->getName() == route('accounts.internal_transfer.index'))? 'active':''}}">@lang('Internal Transfer')</a>
			<a style="font-weight: bold" href="{{ route('accounts.duereport') }}" class="btn {{(\Route::current()->getName() == 'accounts.duereport')? 'active':''}}">@lang('All Reports')</a>
			<a style="font-weight: bold" href="{{ route('accounts.trial_balance') }}" class="btn {{(\Route::current()->getName() == 'accounts.trial_balance')? 'active':''}}">@lang('Trial Bl') </a>
			<a style="font-weight: bold" href="{{ route('accounts.fileManager') }}" target="_blank" class="btn {{(\Route::current()->getName() == 'accounts.fileManager')? 'active':''}}">@lang('File Manager') </a>

		</div>
		<div class="pull-right">
			@if(\Route::current()->getName() == 'fees.index')
				<a href="{{ route('fees.create')  }}" class="btn btn-sm foqas-btn pull-left">@lang('Add Fees')</a>
			@endif

			@if(\Route::current()->getName() == 'accounts.committee_list.list')
{{--					<a href="{{ route('accounts.committee_list.list')  }}" class="btn btn-sm foqas-btn pull-left">@lang('Add Fees')</a>--}}
			@endif
            @if (isset($fee))
				<div class="">
					<span class="btn btn-default btn-sm pull-right" onclick="printDiv()">@lang('Print')</span>
				</div>
            @endif

            @if(isset($expenses))
					<a href="{{ route('accounts.expense.create')  }}" class="btn btn-sm foqas-btn pull-left">@lang('Add Expense')</a>
            @endif

			@if(isset($income))
					<a href="{{ route('accounts.income.create')  }}" class="btn btn-sm foqas-btn pull-left">@lang('Add Income')</a>
			@endif
		</div>
	</div>
@endif
@push('script')
    <script>
		@if(request()->segment(2) != 'financialyear')
			@empty(current_financial_year())
			Swal.fire({
				title: 'There is no current financial year. Activate or create an financial year.',
				icon: 'info',
			  //  timer: 2000,
				showConfirmButton: true,
			 //   timerProgressBar: true
			});
			@endempty
		@endif
    </script>
@endpush
