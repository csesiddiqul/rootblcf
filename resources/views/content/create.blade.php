@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <a href="'. route('academic.content.index').'">'.trans('Content') .'</a> / <b>'. trans('Add').'<b>'])
                @include('components.sectionbar.frontmanagement-bar')
                <div class="panel panel-default">
                    <div class="panel-body pl-0" style="padding-top: 0px !important; ">
                        {!! Form::open(['route' => 'academic.content.store', 'method' => 'post']) !!}
                        @include('content.element')
                        <div class="col-md-2 text-center">
                            <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                @lang('Save')
                            </button>
                        </div>
                        <div class="col-md-2 text-center">
                            <a href="{{route('academic.content.index')}}" class="{{btnClass()}}">@lang('Cancel')</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

