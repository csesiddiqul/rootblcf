@extends('layouts.app')
@section('title', __('Add Examination'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('exams').'">'. trans('Exams').'</a>  / <b>'. trans('Add Examinations').'<b>'])
                @include('components.sectionbar.examination-bar')
                <div class="panel panel-default">
                    <div class="panel-body">
                        @component('components.add-exam-form',['classes'=>$classes,'assigned_classes'=>$already_assigned_classes,])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
