@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.branch.index').'">'. trans('Branch').'</a> /  <b>'. trans('Edit').'<b>'])
                @include('components.sectionbar.branch')
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-6 pl-0">
                            {!! Form::model($school, ['route' => ['academic.branch.update', $school->code], 'method' => 'post','autocomplete'=>'off']) !!}
                            @include('branch.element')
                            <div class="col-md-4 pl-0">
                                <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                    @lang('Update')
                                </button>
                            </div>
                            <div class="col-md-4 text-center pl-0">
                                <a href="{{route('academic.branch.index')}}" class="{{btnClass()}}">@lang('Cancel')</a>
                            </div>
                            @method('PUT')
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection