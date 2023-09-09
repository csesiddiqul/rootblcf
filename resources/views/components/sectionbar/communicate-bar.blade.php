<div class="panel-body pad-bot-top">
    <div class="btn-group new_b pull-left" style="overflow: hidden;"> 
        
		<a href="{{route('academic.contact.index')}}" class="btn {{(\Route::current()->getName() == 'academic.contact.index')? 'active':''}}" id="changeGreen">@lang('Contact')</a>

        <a href="{{route('academic.complain.index') }}" class="btn {{(\Route::current()->getName() == 'academic.complain.index')? 'active':''}}">@lang('Feedback')</a>
  @if(Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
        <a href="{{route('academic.send_sms')}}" class="btn {{(\Route::current()->getName() == 'academic.send_sms')? 'active':''}}">@lang('Send SMS')
        </a>

        <a href="{{route('academic.send_email')}}" class="btn {{(\Route::current()->getName() == 'academic.send_email')? 'active':''}}">@lang('Send E-mail')</a>
	@endif
    </div>
 </div>
<div class="clearfix"></div>


