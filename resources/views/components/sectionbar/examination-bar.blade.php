<div class="panel-body pad-bot-top">
    <div class="btn-group new_b pull-left" style="overflow: hidden;">
        <a href="{{ url('exams') }}" class="btn {{(\Request::url() == url('exams'))? 'active':''}}">@lang('Manage Examinations')</a>
        <a href="{{ url('exams/active') }}" class="btn {{(\Request::url() == url('exams/active'))? 'active':''}}">@lang('Active Exams')</a>
         <a href="{{ route('gpa.index') }}" class="btn {{(\Route::current()->getName() == 'gpa.index')? 'active':''}}">@lang('Grade System')</a>
         <a href="{{route('academic.template.index')}}" class="btn {{(\Route::current()->getName() == 'academic.template.index')? 'active':''}}"> @lang('Template Design')</a>
         <a href="{{route('exams.admitcard.view')}}" class="btn {{(\Route::current()->getName() == 'exams.admitcard.view')? 'active':''}}">@lang('Admit Card')</a>
         <a href="{{route('academic.seatplan')}}" class="btn {{(\Route::current()->getName() == 'academic.seatplan')? 'active':''}}">@lang('Seat Plan')</a>
        <a href="{{ url('grades/all-exams-grade') }}" class="btn {{(\Request::url() == url('grades/all-exams-grade'))? 'active':''}}">@lang('Grades')</a>
        <a href="{{route('exams.report')}}" class="btn {{(\Route::current()->getName() == 'exams.report')? 'active':''}}">@lang('Report Card')</a>
        {{--<a href="{{route('exams.signature')}}" class="btn {{(\Route::current()->getName() == 'exams.signature')? 'active':''}}">@lang('Signature Sheet')</a>--}}

    </div>
        <div class="pull-right">
        	@if(\Route::current()->getName() == 'exams.index')
            <a href="{{ url('exams/create') }}" class="btn btn-sm foqas-btn pull-left mr-15">@lang('Add Examination')</a>
            @endif
            @if(\Route::current()->getName() == 'gpa.index')
            <a href="{{ route('gpa.create') }}" class="btn btn-sm foqas-btn pull-left mr-15">@lang('Add GPA')</a>
            @endif
		</div>
</div>
<div class="clearfix"></div>


