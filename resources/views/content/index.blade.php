@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <b>'.trans('Content').'<b>'])
                @include('components.sectionbar.frontmanagement-bar',['contents'=>$contents])
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if (count($contents)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Image')</th>
                                        <th scope="col">@lang('Menu')</th>
                                        <th scope="col">@lang('Title')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        <th scope="col">@lang('Delete')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($contents as $key=>$content)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td><img src="{{asset($content->image)}}" width="80px">&nbsp;
                                            </td>
                                            <td><small> {{$content->menu['name']??''}}
                                                </small>
                                            </td>
                                            <td><small> {{$content->title}}
                                                </small>
                                            </td>

                                            <td>
                                                <a class="btn btn-xs  btn-default"
                                                   href="{{route('academic.content.edit',$content->id)}}">@lang('Edit')</a>
                                            </td>
                                            <td>
                                                @if($content->menu->slug == 'chairman-message' || $content->menu->slug == 'headteacher-message')
                                                @else
                                                    <a class="btn btn-xs btn-danger"
                                                       onclick="confirm_delete('{{$content->id}}')">@lang('Delete')</a>
                                                    <form id="delete_form_{{$content->id}}"
                                                          action="{{route('academic.content.destroy',$content->id)}}"
                                                          method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @push('styles')
                                <style>
                                    #menuSection {
                                        display: none
                                    }
                                </style>
                            @endpush
                            @push('script')
                                <script>
                                    $(document).ready(function () {
                                        function appendFunction() {
                                            var appendHtml = $("#menuSection").html();
                                            $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
                                        }

                                        setTimeout(function () {
                                            appendFunction();
                                            $("#menuSection").html('');
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

