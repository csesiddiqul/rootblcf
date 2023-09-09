<div class="panel-body pad-bot-top">
    <div class="btn-group new_b" style="overflow: hidden;"> 
        <a href="{{url('users/'.Auth::user()->school->code.'/0/2')}}" class="btn {{(\Route::current()->getName() == 'all_index')? (request()->route('teacher_code') == 2 ? 'active':''):''}}">@lang('Staff's List')</a>
        <a href="{{url('register/staff')}}" class="btn {{(\Route::current()->getName() == 'register')? (session('register_role', 'staff') =='staff'? 'active' : '') :''}}" id="changeGreen">@lang('Staff Add')</a>
        <a href="{{url('employee/'.Auth::user()->school->code.'/2/2')}}" class="btn {{(\Route::current()->getName() == 'employee_index')? (request()->route('employee_status') == 2 ? 'active':''):''}}">@lang('Pending Staff's')</a>
        <a href="{{url('employee/'.Auth::user()->school->code.'/0/2')}}" class="btn {{(\Route::current()->getName() == 'employee_index')? (request()->route('employee_status') == 0 ? 'active':''):''}}">@lang('Inactive Staff's')</a>  
    </div>
</div>