@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <b>'.trans('Testimonial').'<b>'])
                @include('components.sectionbar.frontmanagement-bar',['testimonials'=>$testimonials])
                <div class="panel panel-default">
                    <div class="panel-body" style="padding-top: 0px !important; ">
                          @if (count($testimonials)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover" style="margin-top: 10px !important; ">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Image')</th>
                                        <th scope="col">@lang('Title')</th>
                                        <th scope="col">@lang('Message')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        <th scope="col">@lang('Delete')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($testimonials as $key=>$testimonial)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td><img src="{{$testimonial->photo}}" width="50px">&nbsp</td>
                                            <td><small>{{$testimonial->title}}</small></td>
                                            <td><small>{!! \Illuminate\Support\Str::limit($testimonial->message,50) !!}</small></td>
                                            <td><small> <span class="label label-{{$testimonial->status ==1 ? 'success' : 'danger'}}">{{status($testimonial->status)}}</span></small></td>
                                            <td>
                                                <a class="btn btn-xs btn-default" href="{{route('academic.testimonial.edit',$testimonial->id)}}">@lang('Edit')</a>
                                            </td>
                                             <td>
                                                <a class="btn btn-xs btn-danger"
                                                   onclick="confirm_delete('{{$testimonial->id}}')">@lang('Delete')</a>

                                                <form id="delete_form_{{$testimonial->id}}"
                                                      action="{{route('academic.testimonial.destroy',$testimonial->id)}}"
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
                                    #testimonialSection {
                                        display: none
                                    }
                                </style>
                            @endpush
                            @push('script')
                                <script>
                                    $(document).ready(function () {
                                        function appendFunction() {
                                            var appendHtml = $("#testimonialSection").html();
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



