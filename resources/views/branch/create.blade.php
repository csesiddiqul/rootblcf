@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10 " id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.branch.index').'">'. trans('Branch').'</a> /  <b>'. trans('Add').'<b>'])
                @include('components.sectionbar.branch')
                <div class="panel panel-default">
                    <div class="panel-body" style="padding-top: 0px !important; ">
                        <div class="col-md-6 pl-0">
                            {!! Form::open(['route' => 'academic.branch.store', 'method' => 'post','autocomplete'=>'off']) !!}
                            @include('branch.element')
                            <div class="col-md-4 pl-0">
                                <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                    @lang('Save')
                                </button>
                            </div>
                            <div class="col-md-4 text-center pl-0">
                                <a href="{{route('academic.branch.index')}}" class="{{btnClass()}}">@lang('Cancel')</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection