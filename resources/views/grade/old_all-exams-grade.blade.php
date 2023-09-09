@extends('layouts.app')

@section('title', __('Grade'))

@section('content')
    <style>
        .head h2 {
            margin-left: 30px !important;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10 head" id="main-container">
                <div class="page-panel-title" style="margin-left: 5px;">
                    <a href="{{ route('exams.index') }}">@lang('Examinations')</a><span> / </span><span><b>@lang('Grades')</b></span>
                </div>
                <div class="clearfix"></div>
                @include('components.sectionbar.examination-bar')
                <div class="panel panel-default">
                    @if (count($classes)>0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-condensed">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('Class')</th>
                                    <th scope="col" width="20%">@lang('Section')</th>
                                    <th scope="col">@lang('View Each Student\'s Grade History')</th>
                                    <th scope="col">@lang('View all Students Marks under this Section')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($classes as $key=>$class)
                                    <tr>
                                        <th scope="row">{{  $key + 1 }}</th>
                                        <td><small>
                                                {{$class->name}} @if($class->group)({{$class->group}})@endif
                                            </small>
                                        </td>
                                        <td colspan="3">
                                            <table class="w-100 table">
                                                <tbody>
                                                @foreach($sections as $section)
                                                    @if($class->id == $section->class_id && $section->section_number != 'Admission')
                                                        <tr>
                                                            <td width="25%">{{$section->section_number}}</td>
                                                            <td>
                                                                <a href="{{url('section/students/'.$section->id)}}"
                                                                   class="btn btn-info btn-xs">
                                                                    <i class="fa fa-eye"></i> @lang('View Each Student\'s Grade History')
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <small>
                                                                    <a href="{{url('grades/section/'.$section->id)}}"
                                                                       role="button" class="btn btn-xs btn-danger">
                                                                        <i class="fa fa-eye"></i> @lang('View all Students Marks under this Section')
                                                                    </a>
                                                                </small>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="panel-body">
                            @lang('No Related Data Found.')
                        </div>
                    @endif
                        {{--    @if(count($classes) > 0)
                                <div class="panel-body">
                                    @include('components.sectionbar.grade-bar')
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                @foreach($classes as $class)
                                    <div class="panel panel-default">
                                        <div class="page-panel-title" role="tab" id="heading{{$class->id}}">
                                            <a class="panel-title collapsed" role="button" data-toggle="collapse"
                                               data-parent="#accordion" href="#collapse{{$class->id}}"
                                               aria-expanded="false" aria-controls="collapse{{$class->id}}">
                                                <h5>
                                                    {{$class->class_number}} {{$class->group}} <span class="pull-right"><b>@lang('Click to view all Sections under this Class')+</b></span>
                                                </h5>
                                            </a>
                                        </div>
                                        <div id="collapse{{$class->id}}" class="panel-collapse collapse" role="tabpanel"
                                             aria-labelledby="heading{{$class->id}}">
                                            <div class="panel-body">
                                                <table class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th scope="col">@lang('Section Name')</th>
                                                        <th scope="col">@lang('View Each Student\'s Grade History')</th>
                                                        <th scope="col">@lang('View all Students Marks under this Section')</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($sections as $section)
                                                        @if($class->id == $section->class_id)
                                                            <tr>
                                                                <td>
                                                                    <a href="{{url('grades/section/'.$section->id)}}">{{$section->section_number}}</a>
                                                                </td>
                                                                <td>
                                                                    <a href="{{url('section/students/'.$section->id)}}"
                                                                       class="btn btn-info btn-xs"><i
                                                                                class="material-icons">visibility</i> @lang('View Each Student\'s Grade History')
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="{{url('grades/section/'.$section->id)}}"
                                                                       role="button" class="btn btn-xs btn-danger"><i
                                                                                class="material-icons">visibility</i> @lang('View all Students Marks under this Section')
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="panel-body">
                            @lang('No Related Data Found.')
                        </div>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
@endsection
