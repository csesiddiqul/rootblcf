@if($breaking_newses->count() && foqas_setting('breaking_news') == 1)
    <div class="row" @if(foqas_setting('breaking_news_position') == 3) style="margin-left: 15px;margin-right: 15px;" @endif>
        @if(useragentMobile() == false)
            <div class="col-md-1 pull-left text-center height-30"
                 style="padding-top: 3px;background: {{foqas_setting('breaking_news_bg')}};color: {{foqas_setting('breaking_news_tc')}};">
                @lang('News') :
            </div>
        @endif
        <div class="col-md-10 pull-left height-30"
             style="padding-top: 3px;background: {{foqas_setting('breaking_news_bg')}};color: {{foqas_setting('breaking_news_tc')}};">
            <marquee onmouseover="this.stop();" onmouseout="this.start();">
                @foreach($breaking_newses as $news)
                    @if(isset($news->notice))
                        <a href="{{route('single.notice',$news->notice->slug)}}" target="_blank"
                           class="text-white btn-link">{{$news->title}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    @else
                        {{$news->title}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    @endif
                @endforeach
            </marquee>
        </div>
        @if(useragentMobile() == false)
            <div class="col-md-1 pull-left height-30"
                 style="background: {{foqas_setting('breaking_news_bg')}};color: {{foqas_setting('breaking_news_tc')}};"></div>
        @endif
    </div>
@endif