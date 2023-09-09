
<div class="panel-body pad-bot-top">
    <div class="btn-group new_b pull-left" style="overflow: hidden;"> 
      
        <a href="{{ url('academic/certificate') }}" class="btn {{(\Route::current()->getName() == 'academic.certificate.create')? 'active':''}}">@lang('Generate Certificate')</a> 

        <a href="#" class="btn">@lang('Generate Id Card')</a>

        <a href="{{route('academic.testimonials')}}" class="btn {{(\Route::current()->getName() == 'academic.testimonials')? 'active':''}}">@lang('Testimonials')</a>

        <a href="{{route('academic.tc.index')}}" class="btn {{(\Route::current()->getName() == 'academic.tc')? 'active':''}}">@lang('TC')</a>

    </div>
      <div class="pull-right">
       	@if(\Route::current()->getName() == 'academic.tc.index')
         <a href="{{route('academic.tc.create')}}" class="btn btn-sm foqas-btn pull-left">@lang('Add TC')</a>
       	@endif
    </div>
</div>
<div class="clearfix"></div>

