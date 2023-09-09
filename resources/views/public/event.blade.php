@extends('public.layout.public',['title' => transMsg('Event') ])

@section('sliderText')
    <h1 class="page-title">@lang('EVENT')</h1>
@endsection
@section('content')
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <div class="rs-events-2 sec-spacer">
        <div class="container">
            @if (count($events) > 0)
                <div class="row space-bt30">
                    @foreach($events as $event)
                        <div class="col-lg-6 col-md-12" style="padding-top: 15px;">
                            <div class="event-item">
                                <div class="row rs-vertical-middle">
                                    <div class="col-md-6" style="max-width: 35% !important;">
                                        <div class="event-img">
                                            <img src="{{getIconByExtension(pathinfo($event->file_path, PATHINFO_EXTENSION))}}" alt="events Images"
                                                 style="height: 125px;"/>
                                            {{--  <a class="image-link"
                                               href="{{route('event.show',$event->slug)}}"
                                               title="{{$event->title}}">
                                                <i class="fa fa-link"></i>
                                            </a> --}}
                                        </div>
                                    </div>
                                    <div class="col-md-6" style="max-width: 45% !important;">
                                        <div class="event-content">
                                            <div class="event-meta">
                                                <div class="event-date">
                                                    <i class="fa fa-calendar"></i>
                                                    <span>{{$event->event_date}}</span>
                                                </div>
                                                <div class="event-time">
                                                    <i class="fa fa-clock-o"></i>
                                                    <span>{{$event->event_time}}-{{$event->event_timend}}</span>
                                                </div>
                                            </div>
                                            <h3 class="event-title"><a
                                                        href="{{route('event.show',$event->slug)}}">{{$event->title}}</a>
                                            </h3>
                                            <div class="event-location">
                                                <i class="fa fa-map-marker"></i>
                                                <span>@lang('Venue'): {{$event->venue}}</span>
                                            </div>
                                            {{--<div class="event-desc">
                                                <p>
                                                    {!! \Illuminate\Support\Str::limit($event->description,15) !!}
                                                </p>
                                            </div>--}}
                                            <div class="event-btn ">
                                                <a href="{{route('event.show',$event->slug)}}">@lang('Event Details')</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <nav aria-label="Page navigation example">
                    {{$events->links()}}
                </nav>
            @else
                <div class="alert alert-danger text-center">
                    @lang('data not found')
                </div>
            @endif
        </div>
    </div>
@endsection