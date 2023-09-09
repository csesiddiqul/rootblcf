<div class="panel-title" id="sliderSection">
    <div class="btn-group new_b" style="overflow: hidden;">
        <a href="{{route('academic.slider.index')}}" class="btn {{(\Route::current()->getName() == 'academic.slider.index')? 'active':''}}"> @lang('Slider list')</a>
        <a href="{{route('academic.slider.create')}}" class="btn {{(\Route::current()->getName() == 'academic.slider.create')? 'active':''}}" id="changeGreen"> @lang('Add Slider')</a>
    </div>
</div>   