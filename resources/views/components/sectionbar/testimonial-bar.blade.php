<div class="panel-title" id="testimonialSection" style="padding-top: 0px !important; ">
    <div class="btn-group new_b" style="overflow: hidden;">
        <a href="{{route('academic.testimonial.index')}}" class="btn {{(\Route::current()->getName() == 'academic.testimonial.index')? 'active':''}}"> @lang('Testimonial')</a>
        <a href="{{route('academic.testimonial.create')}}" class="btn {{(\Route::current()->getName() == 'academic.testimonial.create')? 'active':''}}" id="changeGreen"> @lang('Add Testimonial')</a>
    </div>
</div> 