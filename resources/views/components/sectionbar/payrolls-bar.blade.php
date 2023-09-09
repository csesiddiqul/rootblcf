@if(Auth::user()->role == 'admin' || Auth::user()->role == 'accountant') 
	@php
		if(isset(request()->ids)){
			$pass = request()->ids;
		}else{
			$pass = '';
		}

		if((\Request::url() == url('payroll/paidlist/'.$pass)) || (\Request::url() == url('payroll/payslip/'.$pass))){
			$isactive = 'active';
		}else{
			$isactive = '';
		}
	@endphp
	
	<div class="panel-body pad-bot-top" >
		<div class="btn-group new_b pull-left" style="overflow: hidden; font-weight: bolder;"> 
			<a style="font-weight: bold" href="{{ url('payroll/process/first') }}" class="btn {{(\Request::url() == url('payroll/process/'.$pass))? 'active':''}}">@lang('Payroll Process')</a>
			<a style="font-weight: bold" href="{{ url('payroll/pending/first') }}" class="btn {{(\Request::url() == url('payroll/pending/'.$pass))? 'active':''}}">@lang('Payroll Pending List')</a>
			<a style="font-weight: bold" href="{{ url('payroll/approve/first') }}" class="btn {{(\Request::url() == url('payroll/approve/'.$pass))? 'active':''}}">@lang('Payroll Processed List')</a> 
			<a style="font-weight: bold" href="{{ url('payroll/paidlist/1') }}" class="btn {{ $isactive }}">@lang('Payroll Statement')</a> 
		</div>
		<div class="pull-right">
			{{-- @if(\Route::current()->getName() == 'fees.index')
				<a href="{{ route('fees.create')  }}" class="btn btn-sm foqas-btn pull-left">@lang('Add Fees')</a>
			@endif
            @if (isset($fee))
				<div class="">
					<span class="btn btn-default btn-sm pull-right" onclick="printDiv()">@lang('Print')</span>
				</div>
            @endif
            @if (isset($expenses))
					<a href="{{ route('accounts.expense.create')  }}" class="btn btn-sm foqas-btn pull-left">@lang('Add Expense')</a>
            @endif --}}
		</div>
	</div>
@endif

