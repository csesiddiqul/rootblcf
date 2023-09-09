@extends('layouts.app')

@section('title', __('Students'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @php
                    $courseTN = trans(school('country')->code == 'BD' ? 'Subject' : 'Course');
                @endphp
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.class').'">'. trans('Academics').'</a>  / <b>'. trans(school('country')->code == 'BD' ? 'Class' : 'Grade').'<b>'])
                @include('components.sectionbar.academics-bar',['classes'=>$classes])
                <div class="panel panel-default">
                    <div id="sectionClass" class="{{count($classes)>0 ? 'd-none':''}}">
                        <div class="btn-group new_b" style="overflow: hidden;">
                            {{--<a href="{{route('academic.class')}}" class="btn {{route('academic.class')? 'active':''}}">{{school('country')->code == 'BD' ? 'Class list' : 'Grade list'}}</a>--}}
                        </div>
                    </div>
                    <div class="panel-body" style="padding-top: 0px !important; ">
                        @if (count($classes)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered  table-condensed table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th scope="col">{{trans(school('country')->code == 'BD' || 'SG' ? 'Class' : 'Grade')}}</th>
                                        <th scope="col">@lang('Group')</th>
                                        <th scope="col">{{trans(school('country')->code == 'SG' ? 'Level' : 'Section')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($classes as $key=> $class)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                <a title="@lang('Edit Class') {{$class->name}} <br> @lang('Status') : {{status($class->status)}}" class="popTop btn btn-xs {{$class->status == 1 ? 'btn-success' : 'btn-danger' }}"
                                                   href="{{route('school.class_edit',$class->id)}}">{{$class->name}}</a>
                                            </td>
                                            <td>{{$class->group ? $class->group : 'N/A'}}</td>
                                            <td width="50%">
                                                @php $sections = getSectionByClass($class->id);@endphp
                                                @if(count($sections)>0)
                                                    <table class="table-condensed">
                                                        @foreach($sections as $section)
                                                            <tr>
                                                                <td width="50%">
                                                                    <a title="@lang('Edit Section') {{$section->section_number}} <br> @lang('Status') : {{status($section->status)}}" class="popTop btn btn-xs {{$section->status == 1 ? 'btn-success' : 'btn-danger' }}" href="{{route('school.section.edit',[$section->class_id,$section->id])}}">{{$section->section_number}}</a>
                                                                </td>
                                                                @if(strtolower($section->section_number) == 'admission')
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                @else
                                                                    <td>
                                                                        <a role="button" class="btn btn-info btn-xs"
                                                                           href="{{url('courses/0/'.$section->id)}}">
                                                                            {{trans(school('country')->code == 'BD' ? 'Subjects' : 'Courses')}}
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <a role="button" class="btn btn-warning btn-xs"
                                                                           href="{{url('section/students/'.$section->id.'?section=1')}}"> @lang('Students')
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <a role="button" class="btn btn-primary btn-xs"
                                                                           href="{{url('academic/routine/'.$section->id)}}"> @lang('Routines')
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <a role="button" class="btn btn-info btn-xs"
                                                                           href="{{url('academic/syllabus/'.$class->id)}}"> @lang('Syllabus')
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-xs btn-info" role="button"
                                                                           href="{{url('school/promote-students/'.$section->id)}}" >@lang('Promotion')</a>
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                @else
                                                    N/A
                                                @endif
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
                                            var appendHtml = $("#sectionClass").html();
                                            $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
                                        }

                                        setTimeout(function () {
                                            appendFunction();
                                            $("#sectionClass").html('');
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
