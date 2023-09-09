<div class="panel-body pad-bot-top">
    <div class="btn-group new_b pull-left" style="overflow: hidden;">
		<a href="{{route('academic.menu.index')}}" class="btn {{(\Route::current()->getName() == 'academic.menu.index')? 'active':''}}">@lang('Menus list')</a>
        <a href="{{route('academic.content.index')}}" class="btn {{(\Route::current()->getName() == 'academic.content.index')? 'active':''}}" id="changeGreen">@lang('Content')</a>
        <a href="{{route('academic.slider.index') }}" class="btn {{(\Route::current()->getName() == 'academic.slider.index')? 'active':''}}">@lang('Slider')</a>
        <a href="{{route('academic.notice.index')}}" class="btn {{(\Route::current()->getName() == 'academic.notice.index')? 'active':''}}">@lang('Notice')</a>
        <a href="{{route('academic.breaking_news.index')}}" class="btn {{(\Route::current()->getName() == 'academic.breaking_news.index')? 'active':''}}">@lang('Breaking News')</a>
        <a href="{{route('academic.event.index')}}" class="btn {{(\Route::current()->getName() == 'academic.event.index')? 'active':''}}">@lang('Event')</a>
        <a href="{{route('academic.testimonial.index')}}" class="btn {{(\Route::current()->getName() == 'academic.testimonial.index')? 'active':''}}">@lang('Testimonial')</a>
        <a href="{{route('academic.gallery.index')}}" class="btn {{(\Route::current()->getName() == 'academic.gallery.index')? 'active':''}}">@lang('Gallery')</a>
        <a href="{{route('academic.importantLink.index')}}" class="btn {{(\Route::current()->getName() == 'academic.importantLink.index')? 'active':''}}">@lang('Important Link')</a>
    </div>
     <div class="pull-right">
        @if(isset($menus))
        <a href="{{route('academic.menu.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Menu')</a>
        @elseif(isset($contents))
        <a href="{{route('academic.content.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Content')</a>
        @elseif(isset($slider))
        <a href="{{route('academic.slider.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Slider')</a>
        @elseif(isset($notices))
         @if(Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
        <a href="{{route('academic.notice.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Notice')</a>
        @endif
        @elseif(isset($events))
        <a href="{{route('academic.event.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Event')</a>
        @elseif(isset($testimonials))
        <a href="{{route('academic.testimonial.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Testimonial')</a>
        @elseif(isset($gallerys))
        <a href="{{route('academic.gallery.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Gallery')</a>
        @elseif(isset($breaking_newses))
        <a href="{{route('academic.breaking_news.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Breaking News')</a>
        @elseif(isset($importantLinks))
        <a href="{{route('academic.importantLink.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add Important Link')</a>
       @endif
    </div>
</div>
<div class="clearfix"></div>


