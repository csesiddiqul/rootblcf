@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <b>'.trans('Event').'<b>'])
                @include('components.sectionbar.frontmanagement-bar',['events'=>$events])
                <div class="panel panel-default">
                    <div class="panel-body " style="padding-top: 0px !important; ">
                        @if (count($events) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover"
                                       style="margin-top: 10px !important; ">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Title')</th>
                                        <th scope="col">@lang('Venue')</th>
                                        <th scope="col">@lang('Date')</th>
                                        <th scope="col">@lang('Time Start')</th>
                                        <th scope="col">@lang('Time End')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        <th scope="col">@lang('Status')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($events as $key => $event)
                                        <tr id="tr{{$event->id}}">
                                            <th scope="row">{{$key+1}}</th>
                                            <td>
                                                <a href="{{route('event.show',$event->slug)}}"
                                                   target="_blank"><small>{{$event->title}}</small></a></td>
                                            <td><small>{{$event->venue}}</small>
                                            </td>
                                            <td><small>{{$event->event_date}}</small>
                                            </td>
                                            <td><small>{{$event->event_time}}</small>
                                            </td>
                                            <td><small>{{$event->event_timend}}</small>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.event.edit',$event->id)}}">@lang('Edit')</a>

                                            </td>
                                            <td class="width-100">
                                                <a class="btn btn-xs btn-block btn-{{$event->active == 0 ? 'danger' : 'success'}}"
                                                   href="javascript:void(0)"
                                                   onclick="confirmStatus('{{$event->id}}','{{$event->active == 0 ? 'published?' : 'unpublished?'}}')">@lang($event->active == 1 ? 'Published' : 'Unpublished')</a>

                                                <form id="confirm_form_{{$event->id}}"
                                                      action="{{route('academic.remove.event',[$event->id,($event->active == 1 ? 1 : 0)])}}"
                                                      method="POST"
                                                      style="display: none;">
                                                    {{ csrf_field() }}
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @push('styles')
                                <style>
                                    #EventSection {
                                        display: none
                                    }
                                </style>
                            @endpush
                            @push('script')
                                <script>
                                    $(document).ready(function () {
                                        function appendFunction() {
                                            var appendHtml = $("#EventSection").html();
                                            $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
                                        }

                                        setTimeout(function () {
                                            appendFunction();
                                            $("#EventSection").html('');
                                        }, 1000);
                                    })
                                </script>
                            @endpush
                        @else
                            <div class="panel-body">
                                @lang('No Related Data Found.')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection