@if(Auth::user()->role == 'admin')
<div class="panel-body pad-bot-top">
    <div class="btn-group new_b pull-left" style="overflow: hidden;">
        <a href="{{url('users/'.Auth::user()->school->code.'/1/0')}}"  class="btn {{(\Route::current()->getName() == 'all_index')? 'active':''}}">
        @lang("Student's list")</a>
        <a href="{{route('academic.category.index')}}"  class="btn {{(\Route::current()->getName() == 'academic.category.index')? 'active':''}}">@lang('Student '.(school('country')->code == 'SG' ? 'Race' : 'Categories'))</a>
         <a href="{{route('academic.house.index')}}"  class="btn {{(\Route::current()->getName() == 'academic.house.index')? 'active':''}}">@lang('Student '.(school('country')->code == 'SG' ? 'Branch' : 'House'))</a>
        <a href="{{route('academic.board_exam.index')}}"  class="btn {{(\Route::current()->getName() == 'academic.board_exam.index')? 'active':''}}">@lang('Board Exam')</a>
    </div>
     <div class="pull-right">
        @if(isset($categories))
                    <a href="{{route('academic.category.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add '.(school('country')->code == 'SG' ? 'Race' : 'Categories'))</a>
        @endif
    </div>
</div>
<div class="clearfix"></div>
@endif
