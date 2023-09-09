@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <a href="'. route('academic.content.index').'">'.trans('Content') .'</a> / <b>'. trans('Edit').'<b>'])
                @include('components.sectionbar.frontmanagement-bar')
                <div class="panel panel-default">
                    <div class="panel-body pl-0">
                        {!! Form::model($content, ['route' => ['academic.content.update', $content->id], 'method' => 'PATCH']) !!}
                        @include('content.element')
                        <div class="col-md-2 text-center">
                            <div class="form-group ">
                                {!! Form::button(trans('Update'), array('class' => btnClass(),'type' => 'submit' )) !!}
                            </div>
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

