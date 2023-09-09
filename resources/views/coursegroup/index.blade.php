@extends('layouts.app')

@section('title', __(school('country')->code == 'BD' ? 'Subject' : 'Course'. ' Group'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                 @php
                $courseTN = school('country')->code == 'BD' ? 'Subject' : 'Course';
                @endphp
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.class').'">'. trans('Academics').'</a> / <b>'. transMsg($courseTN.' Group').'<b>'])
                @include('components.sectionbar.course-bar',['courseGroup'=>$courseGroup])
                <div class="panel panel-default">
                    <div class="panel-title">
                    </div>
                    <div class="panel-body">
                        @if ($courseGroup->count())
                            @php $cName = school('country')->code == 'BD' ? 'Subjects' : 'Courses'; @endphp
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Name')</th>
                                        <th scope="col">@lang($cName)</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        {{--<th scope="col">@lang('Delete')</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($courseGroup as $courseG)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>
                                                <span data-toggle="popover" data-content="{!! $courseG->description??transMsg('No Description') !!}" data-placement="right">{{transMsg($courseG->name)}}</span>
                                            </td>
                                            <td>
                                                @php
                                                    $courses = \App\Course::whereIn('id',explode(',',$courseG->course))->get();
                                                @endphp
                                                @if ($courses->count())
                                                    <table class="w-100">
                                                        <tbody>
                                                        @foreach ($courses as $course)
                                                            <tr>
                                                                <td class="pull-left">{{transMsg($course->name)}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                @endif
                                            </td>
                                            <td>
                                                <small>
                                                    <span class="label label-{{$courseG->status ==1 ? 'success' : 'danger'}}">{{status($courseG->status)}}</span>
                                                </small>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.coursegroup.edit',$courseG->id)}}">@lang('Edit')</a>
                                            </td>
                                            {{-- <td>
                                                 <a class="btn btn-xs btn-danger"
                                                    onclick="confirm_delete('{{$courseG->id}}')">@lang('Delete')</a>

                                                 <form id="delete_form_{{$courseG->id}}"
                                                       action="{{route('academic.coursegroup.destroy',$courseG->id)}}"
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