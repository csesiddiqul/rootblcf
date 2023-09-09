@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.class').'">'. trans('Academics').'</a> / <a href="'. route('academic.session.index').'">'. trans('Session').'</a> / <b>'. trans('Edit').'<b>'])
                @include('components.sectionbar.session-bar')
                <div class="panel panel-default">
                    <div class="panel-body col-md-6 ">
                        {!! Form::model($session, ['id' => 'committee_form','method' => 'PATCH','route' => ['academic.session.update', $session->id]]) !!}
                        @include('session.element')
                        @method('PUT')
                        <div class="col-md-4 pl-0">
                            <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                @lang('Update')
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

