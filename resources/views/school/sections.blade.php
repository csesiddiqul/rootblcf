@extends('layouts.app')

@section('title', __('All Classes and Sections'))

@section('content')
    <style>
        #cls-sec .panel {
            margin-bottom: 0%;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <ol class="breadcrumb">
                    <li><a href="{{route('academic.class')}}" style="color:#3b80ef;">@lang('Academics')</a></li>
                    <li class="active">{{transMsg(school('country')->code == 'BD' ? 'All Classes' : 'All Grade')}} &amp; @lang('Sections')</li>
                </ol>
                <div class="panel panel-default" id="cls-sec">
                    @if(count($classes) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-condensed">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('Class')</th>
                                    <th scope="col">@lang('Section')</th>
                                    @if(isset($_GET['att']) && $_GET['att'] == 1)
                                        <th>@lang('View Today\'s Attendance')</th>
                                        <th>@lang('View Each Student\'s Attendance')</th>
                                        <th>@lang('Give Attendance')</th>
                                    @endif
                                    @if(isset($_GET['course']) && $_GET['course'] == 1)
                                        <th scope="col">@lang('View Courses')</th>
                                        <th scope="col">@lang('View Students')</th>
                                        <th scope="col">@lang('View Routines')</th>
                                        <th scope="col">@lang('View Syllabus')</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sections as $key => $section)
                                    @if($section->section_number != 'Admission')
                                        @php($class = $section->class)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td><small>
                                                    {{$class->name}} @if($class->group)({{$class->group}})@endif
                                                </small>
                                            </td>
                                            <td>
                                                <a href="{{route('course.index',[0,$section->id])}}">{{$section->section_number}}</a>
                                            </td>
                                            @if(isset($_GET['att']) && $_GET['att'] == 1)
                                                @foreach ($exams as $ex)
                                                    @if ($ex->class_id == $class->id)
                                                        <td>
                                                            <a role="button" class="btn btn-primary btn-xs"
                                                               href="{{url('attendances/'.$section->id.'/0/'.$ex->exam_id)}}">
                                                                <i class="fa fa-eye"></i> @lang('View Today\'s Attendance')
                                                            </a>
                                                        </td>
                                                    @endif
                                                @endforeach
                                                <td>
                                                    <a role="button" class="btn btn-danger btn-xs"
                                                       href="{{url('attendances/'.$section->id)}}"> <i
                                                                class="fa fa-eye"></i> @lang('View Each Student\'s Attendance')
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php
                                                    $ce = 0;
                                                    ?>
                                                    @foreach ($exams as $ex)
                                                        @if ($ex->class_id == $class->id)
                                                            <?php
                                                            $ce = 1;
                                                            ?>
                                                            <a role="button" class="btn btn-info btn-xs"
                                                               href="{{url('attendances/'.$section->id.'/0/'.$ex->exam_id)}}">
                                                                <i class="fa fa-eye"></i> @lang('Take Attendance')
                                                            </a>
                                                        @endif
                                                    @endforeach
                                                    @if($ce == 0)
                                                        @lang('Assign Class Under Exam')
                                                    @endif
                                                </td>
                                            @endif
                                            @if(isset($_GET['course']) && $_GET['course'] == 1)
                                                <td>
                                                    <a role="button" class="btn btn-info btn-xs"
                                                       href="{{url('courses/0/'.$section->id)}}"> <i
                                                                class="fa fa-eye"></i> @lang('View Courses')
                                                    </a>
                                                </td>
                                                <td>
                                                    <a role="button" class="btn btn-danger btn-xs"
                                                       href="{{url('section/students/'.$section->id.'?section=1')}}"> <i
                                                                class="fa fa-eye"></i> @lang('View Students')
                                                    </a>
                                                </td>
                                                <td>
                                                    <a role="button" class="btn btn-primary btn-xs"
                                                       href="{{url('academic/routine/'.$section->id)}}"> <i
                                                                class="fa fa-eye"></i> @lang('View Routines')
                                                    </a>
                                                </td>
                                                <td>
                                                    <a role="button" class="btn btn-info btn-xs"
                                                       href="{{url('academic/syllabus/'.$class->id)}}"><i
                                                                class="fa fa-eye"></i> @lang('View Syllabus')
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="panel-body">
                            @lang('No Related Data Found.')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
