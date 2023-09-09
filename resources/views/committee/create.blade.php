@extends('layouts.app')

@section('title', __('Create'))
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
            @php $typename = ($type == 1 ? 'committee' : ($type == 2 ? 'member' : 'management')); @endphp
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('all_index',[Auth::user()->school->code,0,1]).'">'. trans('Human Resource').'</a> / <a href="'. route('academic.'.$typename.'.index').'">'. trans(ucfirst($typename)).'</a> / <b>'. trans('Add').'<b>'])
                @include('components.sectionbar.teacher-bar')
                <div class="panel panel-default">
                    <div class="panel-body pl-0">
                        {!! Form::open(array('route' => 'academic.committee.store', 'method' => 'POST', 'role' =>'form','enctype'=>'multipart/form-data', 'class' => 'needs-validation')) !!}
                        @include('committee.element')
                        <div class="col-md-2 text-center">
                            <button type="submit" id="admitButton" class="{{btnClass()}}">
                                @lang('Submit')
                            </button>
                        </div>
                        <div class="col-md-2 text-center">
                            <a href="{{route('academic.committee.index')}}" class="{{btnClass()}}">@lang('Cancel')</a>
                        </div>
                        <div class="clearhight50"></div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('.datepicker').datepicker({
                format: "dd-mm-yyyy",
                viewMode: "days",
                minViewMode: "days",
                autoclose: true
            });
        });
    </script>
    @component('components.cropper.element',['width'=>'300','height'=>'300','type'=>'square']) @endcomponent
    <style>
        #resizer .cr-boundary {
            height: 350px !important;
        }
    </style>
@endsection
