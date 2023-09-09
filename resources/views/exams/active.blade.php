@extends('layouts.app')
@section('title', __('All Active Examinations'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('exams').'">'. trans('Exams').'</a>  / <b>'. trans('Active Exams').'<b>'])
                @include('components.sectionbar.examination-bar')
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            @if(count($exams) > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>@lang('Si')</th>
                                            <th>@lang('Exam Name')</th>
                                            <th>@lang('Start Date')</th>
                                            <th>@lang('End Date')</th>
                                            <th>@lang('Created at')</th>
                                            <th>@lang('Status')</th>
                                            <th>{{transMsg(school('country')->code == 'BD' ? 'View Subjects' : 'View Courses')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($exams as $exam)
                                            <tr>
                                                <td>{{$loop->index +1}}</td>
                                                <td>{{$exam->exam_name}}</td>
                                                <td>{{date('d-m-Y',strtotime($exam->start_date))}}</td>
                                                <td>{{date('d-m-Y',strtotime($exam->end_date))}}</td>
                                                <td>{{date('d-m-Y',strtotime($exam->created_at))}}</td>
                                                <td>
                                                    <span class="label label-{{$exam->active ==1 ? 'success' : 'danger'}}">{{status($exam->active)}}</span>
                                                </td>
                                                <td>
                                                    <span class="btn btn-sm btn-xs btn-info" data-toggle="modal"
                                                          data-target="#viewCourseM{{$exam->id}}"> {{transMsg(school('country')->code == 'BD' ? 'View Subjects' : 'View Courses')}} </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                @lang('No Related Data Found.')
                            @endif
                            {{--  @if(count($exams) > 0)
                                 @foreach($exams as $exam)
                                    @component('components.active-exams',['exam'=>$exam,'courses'=>$courses])
                                     @endcomponent
                                @endforeach
                            @endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('modalAppend')
        @if(count($exams) > 0)
            @foreach($exams as $exam)
                <div class="modal fade" id="viewCourseM{{$exam->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="viewCourseM{{$exam->id}}Label">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title"
                                    id="myModalLabel">{{transMsg(school('country')->code == 'BD' ? 'All Subjects under this Exam' : 'All Courses under this Exam')}}</h4>
                            </div>
                            <div class="modal-body">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>{{transMsg(school('country')->code == 'BD' ? 'Class' : 'Grade')}}</th>
                                            <th>{{transMsg(school('country')->code == 'BD' ? 'Subject Name' : 'Course Name')}}</th>
                                            <th>{{transMsg(school('country')->code == 'BD' ? 'Subject Type' : 'Course Type')}}</th>
                                            <th>{{transMsg(school('country')->code == 'BD' ? 'Subject Time' : 'Course Time')}}</th>
                                            <th>{{transMsg(school('country')->code == 'BD' ? 'Subject Teacher' : 'Course Teacher')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($courses as $course)
                                            @if($exam->id == $course->exam_id)
                                                <tr>
                                                    <td>{{$course->class->name}}</td>
                                                    <td>{{$course->course->name}}</td>
                                                    <td>{{courseType($course->course->type)}}</td>
                                                    <td>{{$course->course_time}}</td>
                                                    <td>
                                                        <a href="{{url('user/'.$course->teacher->student_code)}}">{{$course->teacher->name}}</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm"
                                        data-dismiss="modal">@lang('Close')</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endpush
@endsection
