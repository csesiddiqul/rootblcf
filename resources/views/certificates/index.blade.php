@extends('layouts.app')

@section('title', 'My Certificates')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="page-panel-title">@lang('My Certificates')</div>
                <div class="clearfix"></div>
                <div class="panel-body">
                    @component('components.certificate-list',['files'=>$certificates])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@endsection