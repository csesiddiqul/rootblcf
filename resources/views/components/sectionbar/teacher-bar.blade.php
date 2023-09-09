@if(Auth::user()->role == 'admin')
<div class="panel-body pad-bot-top" >
    <div class="btn-group new_b pull-left" style="overflow: hidden;">
        <a href="{{route('all_index',[Auth::user()->school->code,0,1])}}" class="btn {{(\Route::current()->getName() == 'all_index')? (request()->route('teacher_code') == 1 ? 'active':''):''}}">@lang('Teachers')</a>
        <a href="{{route('all_index',[Auth::user()->school->code,0,2])}}" class="btn {{(\Route::current()->getName() == 'all_index')? (request()->route('teacher_code') == 2 ? 'active':''):''}}">@lang('Staff')</a>
        <a href="{{ route('academic.committee.index') }}" class="btn {{(\Route::current()->getName() == 'academic.committee.index')? 'active':''}}">@lang('Committee')</a>
        @if(school('country')->code == 'SG')
        <a href="{{ route('academic.member.index') }}" class="btn {{(\Route::current()->getName() == 'academic.member.index')? 'active':''}}">@lang('Member')</a>
        <a href="{{ route('academic.management.index') }}" class="btn {{(\Route::current()->getName() == 'academic.management.index')? 'active':''}}">@lang('Management')</a>
        @endif
        <a href="{{ route('academic.designation.index') }}" class="btn {{(\Route::current()->getName() == 'academic.designation.index')? 'active':''}}">@lang('Designation')</a>
  </div>
    <div class="pull-right">
        @if(isset($users))
            <button type="button" class="btn btn-sm foqas-btn pull-left mr-15" data-toggle="modal" data-target="#myModal"><i class="fa fa-download"></i> @lang('Download')
            </button>
                @if(\Route::current()->getName() == 'all_index' && request()->route('teacher_code') == 1)
                    <a href="{{url('register/teacher')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Teacher')</a>
                @elseif(\Route::current()->getName() == 'all_index' && request()->route('teacher_code') == 2)
                    <a href="{{url('register/staff')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Staff')</a>
                @endif
        @elseif(isset($type) && $type == 1)
            <a href="{{route('academic.committee.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Committee')</a>
        @elseif(isset($type) && $type == 2)
            <a href="{{route('academic.member.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Member')</a>
        @elseif(isset($type) && $type == 3)
            <a href="{{route('academic.management.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Management')</a>
        @elseif(isset($designations))
            <a href="{{route('academic.designation.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Designation')</a>
        @elseif(session('register_role', 'teacher') == 'teacher')
            @if(\Route::current()->getName() == 'upload.excel')
                    <a href="{{asset('excel/teachers-upload.xlsx')}}" download class="{{btnClass()}}">@lang('Demo Excel file')</a>
            @else
                <a href="{{route('upload.excel','teacher')}}" class="{{btnClass()}}">@lang('Upload Excel')</a>
            @endif
        @endif
    </div>
</div>
@endif
@push('modalAppend')
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">@lang('Select Year')</h4>
                </div>
                <div class="modal-body">
                    @if (\Route::current()->getName() == 'all_index')
                        @if (request()->route('teacher_code') == 1)
                            @component('components.users-export',['type'=>'teacher'])
                            @endcomponent
                        @else
                            @component('components.users-export',['type'=>'staff'])
                            @endcomponent
                        @endif
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">@lang('Close')</button>
                </div>
            </div>

        </div>
    </div>
@endpush
