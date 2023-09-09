<!-- Why Choose Us Start-->
<div class="rs-why-choose sec-spacer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="sec-title mb-40">
                    <h2>@lang(foqas_setting('home_atitle'))</h2>
                </div>
                @empty(!foqas_setting('about_pic'))
                    <div class="choose-img pull-right" style="    padding: 0 15px 0;">
                        <img src="{{foqas_setting('about_pic')}}" style="border-radius: 5px;"
                             alt="{{foqas_setting('home_atitle')}}">
                    </div>
                @endempty
                <div class="choose-desc text-justify">
                    {!! \Illuminate\Support\Str::limit(nl2br(school('about')),1500) !!}
                    @if(strlen(nl2br(school('about'))) > 1500)
                        <a class="text-center small d-block blue-text pb-2 pull-right"
                           href="{{url('/about')}}"><i class="fa fa-arrow-right"></i>  @lang('See more') </a>
                    @endif
                </div>
                {{--<div class="row choose-list mt-50">
                    <div class="col-md-4">
                        <div class="choose-item rs-animation-hover">
                            <i class="flaticon-book-1 rs-animation-scale-up"></i>
                            <h3 class="choose-title">Experienced Faculty</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="choose-item rs-animation-hover">
                            <i class="flaticon-tool-1 rs-animation-scale-up"></i>
                            <h3 class="choose-title">Popular Courses</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="choose-item rs-animation-hover">
                            <i class="flaticon-document rs-animation-scale-up"></i>
                            <h3 class="choose-title">Guaranteed Career</h3>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
</div>
<!-- Why Choose Us End -->