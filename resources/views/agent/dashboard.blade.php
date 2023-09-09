@extends('layouts.app')

@section('content')
    <style>
        .badge-download {
            background-color: transparent !important;
            color: #464443 !important;
        }

        .list-group-item-text {
            font-size: 12px;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.agent-left-menu')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default" style="border-top: 0px;">
                    <div class="panel-body pt-0">
                        <div class="row">
                            @include('components.pages-bar',['pageTitle' =>'Dashboard'])
                        </div>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
