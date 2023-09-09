@php
    $courseTN = school('country')->code == 'BD' ? trans('Subject') : 'Course';
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
    </div>
</div>
<div class="clearfix"></div>


