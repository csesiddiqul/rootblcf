@extends('layouts.app')

@section('title', __('All Fees'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Fees').'<b>'])
                @include('components.sectionbar.accounts-bar')
                <div class="panel panel-default">
                    <div class="panel-body pad-top-0">
                        @component('components.fees-list',['fees'=>$fees])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection