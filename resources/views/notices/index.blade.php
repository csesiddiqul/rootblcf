@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <b>'.trans('Notice').'<b>'])
                @include('components.sectionbar.frontmanagement-bar',['notices'=>$notices])
                <div class="panel panel-default">
                    <div class="panel-body " style="padding-top: 0px !important; ">
                        @if (count($notices) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover"
                                       style="margin-top: 10px !important; ">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Notice Title')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        <th scope="col">@lang('Status')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($notices as $key => $notice)
                                        <tr id="{{$notice->id}}">
                                            <th scope="row">{{$key+1}}</th>
                                            <td>
                                                <a href="{{route('single.notice',$notice->slug)}}"
                                                   target="_blank"><small>{{$notice->title}}</small></a></td>
                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.notice.edit',$notice->id)}}">@lang('Edit')</a>

                                            </td>
                                            <td class="width-100">
                                                <a class="btn btn-xs btn-block btn-{{$notice->active == 0 ? 'danger' : 'success'}}"
                                                   href="javascript:void(0)"
                                                   onclick="confirmStatus('{{$notice->id}}','{{$notice->active == 0 ? 'published?' : 'unpublished?'}}')">@lang($notice->active == 1 ? 'Published' : 'Unpublished')</a>

                                                <form id="confirm_form_{{$notice->id}}"
                                                      action="{{route('academic.remove.notice',[$notice->id,($notice->active == 1 ? 1 : 0)])}}"
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
                                    #NoticeSection {
                                        display: none
                                    }
                                </style>
                            @endpush
                            @push('script')
                                <script>
                                    $(document).ready(function () {
                                        function appendFunction() {
                                            var appendHtml = $("#NoticeSection").html();
                                            $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
                                        }

                                        setTimeout(function () {
                                            appendFunction();
                                            $("#NoticeSection").html('');
                                        }, 1000);
                                    })
                                </script>
                            @endpush
                        @else
                            <div class="" style="clear: both;"></div>
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