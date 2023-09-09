<div class="rs-counter myClass {{count($importantLinks)>0 ? '' : ''}}"
     style="{{count($importantLinks)>0 ? '' : 'margin-bottom: 15px'}}">
    <div class="container" style="{{count($importantLinks)>0 ? 'max-width: 100%' : ''}}">
        <div class="row">
            <div class="col-md-12 p-0">
            <div class="sec-title white-text my-5">
                <h2 style="color:black;">@lang('HIGHLIGHTS')</h2>
                {{--<p>Fusce sem dolor, interdum in efficitur at, faucibus nec lorem. Sed nec molestie justo.</p>--}}
            </div>
        </div>
            <div class="{{count($importantLinks)>0 ? 'col-md-9 my-5  p-0' : 'col-md-12'}} pull-left">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="rs-counter-list">
                            <h2 class="counter-number plus">{{$count['teacher']}}</h2>
                            <h4 class="counter-desc">@lang('TEACHERS')</h4>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="rs-counter-list">
                            <h2 class="counter-number plus">{{$count['class']}}</h2>
                            <h4 class="counter-desc">@lang('Classes')</h4>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="rs-counter-list">
                            <h2 class="counter-number plus">{{$count['student']-13}}</h2>
                            <h4 class="counter-desc">@lang('STUDENTS')</h4>
                        </div>
                    </div>
                    {{--<div class="col-lg-3 col-md-6">
                        <div class="rs-counter-list">
                            <h2 class="counter-number plus">3675</h2>
                            <h4 class="counter-desc">@lang('Satisfied Client')</h4>
                        </div>
                    </div>--}}
                </div>
            </div>
            @if(count($importantLinks)>0)
                <div class="col-md-3 my-5 pull-left dece-head">
                    <div class="m-mt-2">
                        <h4 class="org-title text-center bg-black text-white py-1 px-1"> @lang('Important link') </h4>
                        <div class="text-left" style="border: 1px solid {{foqas_setting('theme_bg')}};padding: 14px!important;">
                            <ul class="list-unstyled">
                                @foreach($importantLinks as $importantLink)
                                    <li class="nav-item mb-2 border-bottom">
                                        <a class=" pl-0 " target="_blank" href="{{$importantLink->link}}">
                                            <i class="fa fa-chevron-circle-right text-primary  pl-1 pr-2"></i>
                                            <span> {{ucwords(transMsg($importantLink->name))}} </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
