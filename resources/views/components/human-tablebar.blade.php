@isset($users)
    <div id="viewingData" class="{{$users->count() ? 'd-none': ''}}">
            <span style="float: left;margin-left: 15px;">@lang('Viewing')
                <select name="forma" class="form-control" onchange="location = this.value;">
                    @foreach ($users as $user)
                        @if($user->role == 'teacher')
                            <option value="{{route('all_index',[Auth::user()->school->code,0,1])}}" {{(\Route::current()->getName() == 'all_index')? (request()->route('teacher_code') == 1 ? 'selected':''):''}}>@lang('Active')</option>
                            <option value="{{url('employee/'.Auth::user()->school->code.'/2/1')}}" {{(\Route::current()->getName() == 'employee_index')? (request()->route('employee_status') == 2 ? 'selected':''):''}}>@lang('Pending')</option>
                            <option value="{{url('employee/'.Auth::user()->school->code.'/0/1')}}" {{(\Route::current()->getName() == 'employee_index')? (request()->route('employee_status') == 0 ? 'selected':''):''}}>@lang('Inactive')</option>
                        @elseif($user->role == 'student')
                            <option value="{{route('all_index',[Auth::user()->school->code,1,0])}}" {{(\Route::current()->getName() == 'all_index')? (request()->route('teacher_code') == 0 ? 'selected':''):''}}>@lang('Active')</option>
                            <option value="{{url('employee/'.Auth::user()->school->code.'/2/0')}}" {{(\Route::current()->getName() == 'employee_index')? (request()->route('employee_status') == 2 ? 'selected':''):''}}>@lang('Pending')</option>
                            <option value="{{url('employee/'.Auth::user()->school->code.'/0/0')}}" {{(\Route::current()->getName() == 'employee_index')? (request()->route('employee_status') == 0 ? 'selected':''):''}}>@lang('Inactive')</option>
                        @else
                            <option value="{{route('all_index',[Auth::user()->school->code,0,2])}}" {{(\Route::current()->getName() == 'all_index')? (request()->route('teacher_code') == 2 ? 'selected':''):''}}>@lang('Active')</option>
                            <option value="{{url('employee/'.Auth::user()->school->code.'/2/2')}}" {{(\Route::current()->getName() == 'employee_index')? (request()->route('employee_status') == 2 ? 'selected':''):''}}>@lang('Pending')</option>
                            <option value="{{url('employee/'.Auth::user()->school->code.'/0/2')}}" {{(\Route::current()->getName() == 'employee_index')? (request()->route('employee_status') == 0 ? 'selected':''):''}}>@lang('Inactive')</option>
                        @endif
                        @break($loop->first)
                    @endforeach
                </select>
        </span>
    </div>
@endisset
@push('script')
    <script>
        $(document).ready(function () {
            function appendFunction() {
                var appendHtml = $("#viewingData").html();
                $(".table-responsive div.row:first-child div.col-sm-6:first-child").append(appendHtml);
                $(".table-responsive div.row:first-child div.col-sm-6 .dataTables_length").addClass('pull-left');
            }

            setTimeout(function () {
                appendFunction();
                $("#viewingData").html('');
            }, 3000);
        })
    </script>
@endpush
