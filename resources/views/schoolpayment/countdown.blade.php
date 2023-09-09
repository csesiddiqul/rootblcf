@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/countdown.css')}}">
@endpush
<div class="countdown-main"> 
    <div class="subs-container"> 
        @if(!empty($schools->activeTill)) 
            @if(strtotime(now())>strtotime($schools->activeTill)) 
                @if(auth()->user()->role=='agent') 
                <div class="hidden-lg hidden-md hidden-sm visible-xs visi-xs">
                  <a href="{{ route('school.payments.subscriptionplan',$schools->code) }}" class="btn btn-block">Renew Now</a>
                </div>
                @endif
                <h2 class="subvals">@lang('Subscription expired in')</h2> 
            @else 
                <h2 class="subval">@lang('Subscription will expire in')</h2>  
            @endif
            <div class="countdown" id="subs-countup"> 
                <div id="day" class="days">000</div>
                <div id="hour" class="hours">00</div>
                <div id="minute" class="minutes">00</div>
                <div id="second" class="seconds">00</div>
                @if(auth()->user()->role=='agent')
                <div id="subsc-now"><a href="{{ route('school.payments.subscriptionplan',$schools->code) }}" class="btn btn-block">Renew Now</a></div>
                @endif
            </div>
        @else
            <h2 class="subvals">@lang('Have not subscribed yet')</h2> 
            <div class="countdown"> 
                <div id="day-not">000</div>
                <div id="hour-not">00</div>
                <div id="minute-not">00</div>
                <div id="second-not">00</div>
                @if(auth()->user()->role=='agent') 
                <div id="subsc-now"><a href="{{ route('school.payments.subscriptionplan',$schools->code) }}" class="btn btn-block">Subscribe Now</a></div>
                @endif
            </div>
        @endif   
    </div>
</div>
{{--Script Line --}}
@push('script')
<script> 
@if(!empty($schools->activeTill))
    @if(strtotime(now())>strtotime($schools->activeTill))   
        window.onload = function() { 
          countUpFromTime("{{$schools->activeTill}}", 'subs-countup'); 
        };
        function countUpFromTime(countFrom, id) {
          countFrom = new Date(countFrom).getTime();
          var now = new Date(),
              countFrom = new Date(countFrom),
              timeDifference = (now - countFrom);
            
          var secondsInADay = 60 * 60 * 1000 * 24,
              secondsInAHour = 60 * 60 * 1000;
            
          days = Math.floor(timeDifference / (secondsInADay) * 1);
          years = Math.floor(days / 365);
          if (years > 1){ days = days - (years * 365) }
          hours = Math.floor((timeDifference % (secondsInADay)) / (secondsInAHour) * 1);
          mins = Math.floor(((timeDifference % (secondsInADay)) % (secondsInAHour)) / (60 * 1000) * 1);
          secs = Math.floor((((timeDifference % (secondsInADay)) % (secondsInAHour)) % (60 * 1000)) / 1000 * 1);

          var idEl = document.getElementById(id); 
          idEl.getElementsByClassName('days')[0].innerHTML = days;
          idEl.getElementsByClassName('hours')[0].innerHTML = hours;
          idEl.getElementsByClassName('minutes')[0].innerHTML = mins;
          idEl.getElementsByClassName('seconds')[0].innerHTML = secs;

          clearTimeout(countUpFromTime.interval);
          countUpFromTime.interval = setTimeout(function(){ countUpFromTime(countFrom, id); }, 1000);
        } 
    @else 
        $('#subsc-now').css('display','none');
        @if(!empty($schools->activeTill)) 
            var countDate = new Date("{{$schools->activeTill}}").getTime(); 
        @else 
            var countDate = new Date().getTime(); 
        @endif 

        function newYear() {
          var now = new Date().getTime();
          gap = countDate - now;

          var second = 1000;
          var minute = second * 60;
          var hour = minute * 60;
          var day = hour * 24;

          var d = Math.floor(gap / day);
          var h = Math.floor((gap % day) / hour);
          var m = Math.floor((gap % hour) / minute);
          var s = Math.floor((gap % minute) / second);

          document.getElementById("day").innerText = d;
          document.getElementById("hour").innerText = h;
          document.getElementById("minute").innerText = m;
          document.getElementById("second").innerText = s;
        }

        setInterval(function () {
          newYear();
        }, 1000); 
    @endif 
@endif 
</script>
@endpush