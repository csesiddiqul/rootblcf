@extends('layouts.app')

@section('title', __('Department edit'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.class').'">'. trans('Academics').'</a> / <a href="'. route('academic.department.index').'">'. trans('Department').'</a> / <b>'. trans('Edit').'<b>'])
                @include('components.sectionbar.course-bar')
                <div class="panel panel-default">
                    <div class="panel-title">
                    </div>
                    <div class="panel-body pl-0">
                        <div class="col-md-5">
                            {!! Form::model($department, ['method' => 'PATCH','route' => ['academic.department.update', $department->id]]) !!}
                            @include('department.element')
                            <div class="col-md-5 pl-0">
                                <button type="submit" class="{{btnClass()}}">@lang('Update')</button>
                            </div>
                            <div class="col-md-5 text-center pl-0">
                                <a href="{{route('academic.department.index')}}" class="{{btnClass()}}">@lang('Cancel')</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection