@extends('layouts.app')
@section('title', __('Breaking News'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <b>'.trans('Breaking News').'<b>'])
                @include('components.sectionbar.frontmanagement-bar',['breaking_newses'=>$breaking_newses])
                <div class="panel panel-default">
                    <div class="panel-body " style="padding-top: 0px !important; ">
                        @if (count($breaking_newses) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover"
                                       style="margin-top: 10px !important; ">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Title')</th>
                                        <th scope="col">@lang('Type From')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        <th scope="col">@lang('Delete')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($breaking_newses as $key => $news)
                                        <tr id="{{$news->id}}">
                                            <th scope="row">{{$key+1}}</th>
                                            <td>
                                                @if(isset($news->notice))
                                                    <a href="{{route('single.notice',$news->notice->slug)}}"
                                                       target="_blank"><small>{{$news->title}}</small></a>
                                                @else
                                                    {{$news->title}}
                                                @endif
                                            </td>
                                            <td>
                                                {{isset($news->notice_id) ? transMsg('Notice') : transMsg('Breaking New')}}
                                            </td>
                                            <td class="width-100">
                                                <span class="label label-{{$news->status == 1 ? 'success' : 'danger'}}">
                                                    @lang($news->status == 1 ? 'Active' : 'Inactive')</span>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.breaking_news.edit',$news->id)}}">@lang('Edit')</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-danger"
                                                   href="javascript:void(0)" onclick="confirm_delete('{{$news->id}}')">@lang('Delete')</a>
                                                <form id="delete_form_{{$news->id}}"
                                                      action="{{route('academic.breaking_news.destroy',[$news->id])}}"
                                                      method="POST" style="display: none;">
                                                    @method('Delete')
                                                    @csrf
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