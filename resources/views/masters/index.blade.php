@extends('layouts.app') 
@section('title', __('Master Dashboard')) 
@section('content')  
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.master-left-menu') 
        </div>
        <div class="col-md-10" id="main-container">
            <div class="col-sm-4">
                <div class="panel-body p-0">
                    <a class="btn btn-danger btn-sm btn-block" href="{{ route('schools.index') }}" role="button">
                        @lang('Manage Schools')
                    </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel-body p-0">
                    <a class="btn btn-warning btn-sm btn-block" href="{{ route('schoolpayments.index') }}" role="button">
                        @lang('School Payments')
                    </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel-body p-0">
                    <a class="btn btn-info btn-sm btn-block" href="{{ route('agents.index') }}" role="button">
                        @lang('Agents')
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
