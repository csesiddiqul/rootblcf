@extends('layouts.app')

@section('title', __('Register'))
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
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <a href="'. route('academic.slider.index').'">'.trans('Slider') .'</a> / <b>'. trans('Edit').'<b>'])
                @include('components.sectionbar.frontmanagement-bar')
                <div class="panel panel-default ptlb-515">
                    <div class="clearhight15"></div>
                    <div class="panel-body pl-0">
                        {!! Form::model($slider, ['id' => 'committee_form','class'=>'row','method' => 'PATCH','route' => ['academic.slider.update', $slider->id]]) !!}
                        @include('slider.element')
                        @method('PUT')
                        <div class="col-md-2 text-center">
                            <button type="submit" id="admitButton" class="{{btnClass()}}">
                                @lang('Update')
                            </button>
                        </div>
                        <div class="col-md-2 text-center">
                            <a href="{{route('academic.slider.index')}}" class="{{btnClass()}}">@lang('Cancel')</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @component('components.cropper.element',['width'=>'700','height'=>'298','type'=>'square'])
    @endcomponent
    <script>
        $(document).ready(function () {
            $("#imageFrame .modal-dialog").addClass('modal-lg');
        })
    </script>
    <style>
        #resizer .cr-boundary {
            height: 400px !important;
        }
    </style>
@endsection