@extends('layouts.app')

@section('title', (school('country')->code == 'BD' ? 'Subject' : 'Course'. ' list'))

@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @php
                    $courseTN = school('country')->code == 'BD' ? transMsg('Subject') : transMsg('Course');
                @endphp
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.class').'">'. trans('Academics').'</a>  / <b>'. $courseTN.'<b>'])
                @include('components.sectionbar.course-bar',['courses'=>$courses])
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if ($courses->count())
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Name')</th>
                                        <th scope="col">@lang('Code')</th>
                                        <th scope="col">@lang('Type')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Action')</th>
                                        {{--<th scope="col">@lang('Delete')</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($courses as $course)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{transMsg($course->name)}}</td>
                                            <td>{{transMsg($course->code)}}</td>
                                            <td>{{transMsg($course->type == 1 ? 'Mandatory':'Optional')}}</td>
                                            <td>
                                                <small>
                                                    <span class="label label-{{$course->status ==1 ? 'success' : 'danger'}}">{{status($course->status)}}</span>
                                                </small>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.course.edit',$course->id)}}">@lang('Edit')</a>
                                            </td>
                                            {{-- <td>
                                                <a class="btn btn-xs btn-danger"
                                                   onclick="confirm_delete('{{$course->id}}')">@lang('Delete')</a>
                                                <form id="delete_form_{{$course->id}}"
                                                      action="{{route('academic.course.destroy',$course->id)}}"
                                                      method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    @method('DELETE')
                                                </form>
                                            </td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @push('styles')
                                <style>
                                    #courceSection {
                                        display: none
                                    }
                                </style>
                            @endpush
                            @push('script')
                                <script>
                                    $(document).ready(function () {
                                        function appendFunction() {
                                            var appendHtml = $("#courceSection").html();
                                            $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
                                        }

                                        setTimeout(function () {
                                            appendFunction();
                                            $("#courceSection").html('');
                                        }, 1000);
                                    })
                                </script>
                            @endpush
                        @else
                            @lang('No Related Data Found.')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection