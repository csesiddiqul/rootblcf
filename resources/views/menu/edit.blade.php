@extends('layouts.app')

@section('title', __('Menu Edit'))
@section('content')
    <style>
        h4 {
            font-size: 21px !important;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <a href="'. route('academic.menu.index').'">'.trans('Menus list') .'</a> / <b>'. trans('Edit').'<b>'])
                @include('components.sectionbar.frontmanagement-bar')
                <div class="panel panel-default">
                    <div class="panel-body pl-0 pr-0" style="padding-top: 0px !important; ">
                        {!! Form::model($menu, ['id' => 'committee_form','method' => 'PATCH','route' => ['academic.menu.update', $menu->id]]) !!}
                        @include('menu.element')
                        @method('PUT')
                        <div class="col-md-2 text-center">
                            <button type="submit" id="admitButton" class="{{btnClass()}}">
                                @lang('Update')
                            </button>
                        </div>
                        <div class="col-md-2 text-center">
                            <a href="{{route('academic.menu.index')}}" class="{{btnClass()}}">@lang('Cancel')</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection