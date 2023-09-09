@extends('layouts.app')

@section('title', __('Accountants'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Accountant List').'<b>'])
                @include('components.sectionbar.accounts-bar',['users'=>$users])
                <div class="panel panel-default">
                    @if(count($users) > 0)
                        <div class="panel-body">
                            @component('components.users-list',['users'=>$users])
                            @endcomponent
                        </div>
                    @else
                        <div class="panel-body">
                            @lang('No Related Data Found.')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection