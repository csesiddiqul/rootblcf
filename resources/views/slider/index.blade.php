@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <b>'.trans('Slider').'<b>'])
                @include('components.sectionbar.frontmanagement-bar',['slider'=>$slider])
                <div class="panel panel-default">
                    <div class="panel-body" style="padding-top: 0px !important; ">
                        @if (count($slider)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover"
                                       style="margin-top: 10px !important; ">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Image')</th>
                                        <th scope="col">@lang('Title')</th>
                                        <th scope="col">@lang('Link')</th>
                                        <th scope="col">@lang('Short Description')</th>
                                        <th scope="col">@lang('Priority')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        <th scope="col">@lang('Delete')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($slider as $key=>$sli)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td><img src="{{$sli->image}}" width="200px">&nbsp</td>
                                            <td><small> {{$sli->title}}</small></td>
                                            <td><small> {{$sli->link}}</small></td>
                                            <td><small> {{$sli->shortdrc}}</small></td>
                                            <td><small> {{$sli->priority}}</small></td>
                                            <td><small> <span
                                                            class="label label-{{$sli->status ==1 ? 'success' : 'danger'}}">{{status($sli->status)}}</span></small>
                                            </td>

                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.slider.edit',$sli->id)}}">@lang('Edit')</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-danger"
                                                   onclick="confirm_delete('{{$sli->id}}')">@lang('Delete')</a>

                                                <form id="delete_form_{{$sli->id}}"
                                                      action="{{route('academic.slider.destroy',$sli->id)}}"
                                                      method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    @method('DELETE')
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @push('script')
                                <script>
                                    $(document).ready(function () {
                                        function appendFunction() {
                                            var appendHtml = $("#sliderSection").html();
                                            $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
                                        }

                                        setTimeout(function () {
                                            appendFunction();
                                            $("#sliderSection").html('');
                                        }, 1000);
                                    })
                                </script>
                            @endpush
                            @push('styles')
                                <style>
                                    #sliderSection {
                                        display: none
                                    }
                                </style>
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