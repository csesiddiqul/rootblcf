@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/1/0').'">'. trans('Students').'</a> / <a href="'. route('academic.category.index').'">'.trans('Student ').(school('country')->code == 'SG' ? 'Race' : 'Categories') .'</a> / <b>'. trans('Show').'<b>'])
                @component('components.sectionbar.category-bar')@endcomponent
                <div class="panel panel-default ptlb-515">
                    <div class="panel-body plt-07">
                        @if (count($category->studentInfo)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover"
                                       style="margin-top: 10px !important;">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Student Code')</th>
                                        <th scope="col">@lang('Name')</th>
                                        <th scope="col">@lang('Roll')</th>
                                        <th scope="col">@lang('Class')</th>
                                        <th scope="col">@lang('Section')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($category->studentInfo as $key=>$student_info)
                                        <tr>
                                            <td scope="row">{{  $key + 1 }}</td>
                                            <td>{{$student_info->student->student_code}}</td>
                                            <td>
                                                <a href="{{url('user/'.$student_info->student->student_code)}}">
                                                    {{$student_info->student->name}}</a>
                                            </td>
                                            <td>
                                                {{$student_info->class_roll}}
                                            </td>
                                            <td>
                                                {{$student_info->student->section->class->name}}
                                            </td>
                                            <td>
                                                {{$student_info->student->section->section_number}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="panel-body">
                                @lang('No student found in '.$category->name.' '.(school('country')->code == 'SG' ? 'Race' : 'Category'))
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

