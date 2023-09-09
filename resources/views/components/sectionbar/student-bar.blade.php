
@if(Auth::user()->role == 'admin')
<div class="panel-body pad-bot-top">
    <div class="btn-group new_b pull-left" style="overflow: hidden;">
        <a href="{{url('users/'.Auth::user()->school->code.'/1/0')}}"  class="btn {{(\Route::current()->getName() == 'all_index')? 'active':''}}" id="atn">@lang('Student\'s List')</a>
		{{--
        <a href="{{route('academic.admission.pending')}}" class="btn {{(\Route::current()->getName() == 'academic.admission.index')? 'active':''}}" id="atn">Admission</a>
        --}}
        <a href="{{route('academic.category.index')}}"  class="btn {{(\Route::current()->getName() == 'academic.category.index')? 'active':''}}" id="atn">@lang('Student '.(school('country')->code == 'SG' ? 'Race' : 'Categories'))</a>
         <a href="{{route('academic.house.index')}}"  class="btn {{(\Route::current()->getName() == 'academic.house.index')? 'active':''}}" id="atn">@lang('Student '.(school('country')->code == 'SG' ? 'Branch' : 'House'))</a>
        <a href="{{route('academic.board_exam.index')}}"  class="btn {{(\Route::current()->getName() == 'academic.board_exam.index')? 'active':''}}">@lang('Board Exam')</a>
        {{--<a href="{{url('register/student')}}"  class="btn {{(\Route::current()->getName() == 'register')? 'active':''}}" id="changeGreen">Student Add </a>--}}
    </div>
    @if(\Route::current()->getName() == 'all_index')
     <div class="pull-right">
        <button type="button" class="btn foqas-btn btn-sm mr-15" data-toggle="modal" data-target="#myModal"><i class="fa fa-download"></i> @lang('Download')
            </button>
         <a href="{{url('register/student')}}" class="btn foqas-btn btn-sm">@lang('Add Student')</a>
    </div>
    @elseif(session('register_role', 'student') == 'student')
        @if(\Route::current()->getName() == 'upload.excel')
            <div class="col-md-2 pull-right">
                <a href="{{route('upload.required_data')}}" class="{{btnClass()}}">@lang('Required excel data')</a>
            </div>
            <div class="col-md-2 pull-right">
                <a href="{{asset('excel/students-upload.xlsx')}}" download class="{{btnClass()}}">@lang('Demo Excel file')</a>
            </div>
        @else
            <div class="col-md-2 pull-right">
                <a href="{{route('upload.excel','student')}}" class="{{btnClass()}}">@lang('Upload Excel')</a>
            </div>
        @endif

    @endif
</div>
<div class="clearfix"></div>
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
                        @if (request()->route('student_code') == 1)
                            @component('components.users-export',['type'=>'student'])
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