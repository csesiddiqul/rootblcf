<div class="panel-body">
    <div class="btn-group new_b" style="overflow: hidden;">
        <a href="{{ url('gpa/all-gpa') }}" class="btn {{(\Request::url() == url('gpa/all-gpa'))? 'active':''}}"> @lang('All GPA') </a>
        <a href="{{ url('gpa/create-gpa') }}" class="btn {{(\Request::url() ==url('gpa/create-gpa'))? 'active':''}}" id="changeGreen"> @lang('New GPA Add') </a>
        
    </div>
</div>
<div class="clearfix"></div>