@php
    $courseTN = trans(school('country')->code == 'BD' ? 'Subject' : 'Course');
@endphp
<div class="panel-body pad-bot-top">
    <div class="btn-group new_b pull-left" style="overflow: hidden;">
        <a href="{{route('academic.session.index')}}" class="btn {{(\Route::current()->getName() == 'academic.session.index')? 'active':''}}"> @lang('Session')</a>
        <a href="{{route('academic.class')}}" class="btn {{route('academic.class')? 'active':''}}">{{trans(school('country')->code == 'BD' ? 'Class' : 'Grade')}}</a>
		<a href="{{route('academic.course.index')}}" class="btn {{(\Route::current()->getName() == 'academic.course.index')? 'active':''}}">{{$courseTN}}</a>

        <a href="{{route('academic.coursegroup.index')}}" class="btn {{(\Route::current()->getName() == 'academic.coursegroup.index')? 'active':''}}" id="changeGreen">{{$courseTN.' ' .trans('Group')}}</a>
        <a href="{{ route('academic.course_config.index') }}" class="btn {{(\Route::current()->getName() == 'academic.course_config.index')? 'active':''}}">@lang('Assign Teacher')</a>

        <a href="{{ route('academic.routine.index') }}" class="btn {{(\Route::current()->getName() == 'academic.routine.index')? 'active':''}}"> @lang('Class Routine')</a>
        <a href="{{ route('academic.syllabus.index') }}" class="btn {{(\Route::current()->getName() == 'academic.syllabus.index')? 'active':''}}">@lang('Syllabus')</a>
        <a href="{{ route('academic.department.index') }}" class="btn {{(\Route::current()->getName() == 'academic.department.index')? 'active':''}}">@lang('Department')</a>


    </div>
     <div class="pull-right">
        @isset($classes)
         @include('layouts.master.add-class-form')
         @include('layouts.master.create-section-allClass')
       @endisset
    </div>
</div>
<div class="clearfix"></div>


