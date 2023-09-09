<div class="panel-title" id="gallerySection" style="padding-top: 0px !important;">
    <div class="btn-group new_b" style="overflow: hidden;">
        <a href="{{route('academic.gallery.index')}}" class="btn {{(\Route::current()->getName() == 'academic.gallery.index')? 'active':''}}"> @lang('Gallery List')</a>
        <a href="{{route('academic.gallery.create')}}" class="btn {{(\Route::current()->getName() == 'academic.gallery.create')? 'active':''}}" id="changeGreen">@lang('Add Gallery')</a>
    </div>
</div> 