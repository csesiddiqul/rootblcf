@php
    $courseTN = school('country')->code == 'BD' ? transMsg('Subject') : transMsg('Course');
@endphp
<div class="panel-body pad-bot-top">
    <div class="btn-group new_b pull-left" style="overflow: hidden;">
        <a href="{{route('academic.session.index')}}" class="btn {{(\Route::current()->getName() == 'academic.session.index')? 'active':''}}"> @lang('Session')</a>
        <a href="{{route('academic.class')}}" class="btn {{route('academic.class')? '':''}}">{{school('country')->code == 'BD' ? trans('Class') : 'Grade'}}</a>
		<a href="{{route('academic.course.index')}}" class="btn {{(\Route::current()->getName() == 'academic.course.index')? 'active':''}}">{{$courseTN}}</a>

        <a href="{{route('academic.coursegroup.index')}}" class="btn {{(\Route::current()->getName() == 'academic.coursegroup.index')? 'active':''}}" id="changeGreen">{{$courseTN}} @lang('Group')</a>
        <a href="{{ route('academic.course_config.index') }}" class="btn {{(\Route::current()->getName() == 'academic.course_config.index')? 'active':''}}"> @lang('Assign Teacher')</a>

        <a href="{{ route('academic.routine.index') }}" class="btn {{(\Route::current()->getName() == 'academic.routine.index')? 'active':''}}"> @lang('Class Routine')</a>
        <a href="{{ route('academic.syllabus.index') }}" class="btn {{(\Route::current()->getName() == 'academic.syllabus.index')? 'active':''}}">@lang('Syllabus')</a>
        <a href="{{ route('academic.department.index') }}" class="btn {{(\Route::current()->getName() == 'academic.department.index')? 'active':''}}">@lang('Department')</a>
    </div>
     <div class="pull-right">
         @if(isset($courses))
          <a href="{{route('academic.course.create')}}" class="btn btn-sm foqas-btn pull-left" style="margin-right: ">@lang('Add') {{$courseTN}}</a>
         @elseif(isset($courseGroup))
            <a href="{{route('academic.coursegroup.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add '){{$courseTN}} @lang('Group')</a>
         @elseif(isset($departments))
            <a href="{{route('academic.department.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Department')</a>
         @elseif(isset($cloneAssignTeacher))
             <button type="button" class="{{btnClass()}}" data-toggle="modal" data-target="#cloneAssignTeacher">
                 @lang('Clone Assigned Teacher')
             </button>
         @endif
    </div>
</div>
<div class="clearfix"></div>


