@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <b>'.trans('Gallery').'<b>'])
                @include('components.sectionbar.frontmanagement-bar',['gallerys'=>$gallerys])
                <div class="panel panel-default">
                    <div class="panel-body" style="padding-top: 0px !important; ">
                        @if (count($gallerys)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover"
                                       style="margin-top: 10px !important; ">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Image')</th>
                                        <th scope="col">@lang('Title')</th>
                                        <th scope="col">@lang('Description')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        <th scope="col">@lang('Delete')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($gallerys as $key=>$gallery)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td><img src="{{$gallery->photo}}" width="50px"></td>
                                            <td><small> {{$gallery->title}}</small></td>
                                            <td>
                                                <small>{!! \Illuminate\Support\Str::limit($gallery->description,50) !!}</small>
                                            </td>
                                            <td><small> <span
                                                            class="label label-{{$gallery->status ==1 ? 'success' : 'danger'}}">{{status($gallery->status)}}</span></small>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.gallery.edit',$gallery->id)}}">@lang('Edit')</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-danger"
                                                   onclick="confirm_delete('{{$gallery->id}}')">@lang('Delete')</a>

                                                <form id="delete_form_{{$gallery->id}}"
                                                      action="{{route('academic.gallery.destroy',$gallery->id)}}"
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
                            @push('styles')
                                <style>
                                    #gallerySection {
                                        display: none
                                    }
                                </style>
                            @endpush
                            @push('script')
                                <script>
                                    $(document).ready(function () {
                                        function appendFunction() {
                                            var appendHtml = $("#gallerySection").html();
                                            $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
                                        }

                                        setTimeout(function () {
                                            appendFunction();
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
