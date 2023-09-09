<div class="panel-body">
    <div class="btn-group new_b" style="overflow: hidden;">
        <a href="{{ url('grades/all-exams-grade') }}"><button class="btn {{(\Route::current()->getName() == 'all_index')? 'active':''}}">@lang('Students')</button></a>
        <a href="#"><button class="btn" id="changeGreen">@lang('Courses')</button></a>
        <a href="#"><button>@lang('GPA')</button></a>
    </div>
</div>