@extends('layouts.app')
@section('title', __('Edit Breaking News'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <a href="'. route('academic.breaking_news.index').'">'.trans('Breaking News') .'</a> / <b>'. trans('Edit').'<b>'])
                @include('components.sectionbar.frontmanagement-bar')
                <div class="panel panel-default">
                    <div class="panel-body pl-0 pr-0">
                        <div class="col-md-6">
                            {!! Form::model($breakingNews, ['method' => 'PATCH','route' => ['academic.breaking_news.update', $breakingNews->id]]) !!}
                            @include('breakingNews.element')
                            <div class="col-md-4 pl-0">
                                <button type="submit" class="{{btnClass()}}">@lang('Update')</button>
                            </div>
                            <div class="col-md-4 text-center pl-0">
                                <a href="{{route('academic.breaking_news.index')}}" class="{{btnClass()}}">@lang('Cancel')</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection