@extends('layouts.app')

@section('title', __('Edit Application'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.sectionbar.admission-bar')
                <div class="clearfix"></div>
                <div class="panel panel-default">
                    <div class="panel-body pad-top-0">
                        {!! Form::model($admission, ['id' => 'admission_form','method' => 'PATCH','route' => ['academic.admission.update', $admission->id],'enctype'=>'multipart/form-data']) !!}
                        @include('admission.element')
                        @method('PUT')
                        <div class="form-group col-md-2">
                            {!! Form::button(trans('Update'), array('class' => btnClass(),'type' => 'submit' )) !!}
                        </div>
                        <div class="form-group col-md-2">
                            <a href="{{route('academic.admission.show',$admission->id)}}"
                               class="{{btnClass()}}">@lang('Cancel')</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection