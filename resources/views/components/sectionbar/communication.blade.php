<div class="panel-body pull-left" id="NoticeSection" style="padding-top: 0px !important; ">
    <div class="btn-group new_b" style="overflow: hidden;">
        <a href="{{url('academic/notice')}}"
           class="btn {{(\Route::current()->getName() == 'academic.notice')? 'active':''}}"> @lang('Notice')</a>
           <a href="{{route('academic.notice.create')}}"
           class="btn {{(\Route::current()->getName() == 'academic.notice.create')? 'active':''}}">  @lang('Notice Add') </a>
       
    </div>
</div>