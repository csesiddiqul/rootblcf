@extends('layouts.app')

@section('title', __('Staffs'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            @include('components.pages-bar',['pageTitle' =>'<a href="'. route('all_index',[Auth::user()->school->code,0,1]).'">'. trans('Human Resource').'</a> / <b>'. trans('Staff').'<b>'])
            @include('components.sectionbar.teacher-bar',['users'=>$users])
            <div class="panel panel-default">
                @if(count($users) > 0)
                <div class="panel-body pad-top-0">
                    @component('components.human-tablebar',['users'=>$users])
                    @endcomponent
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
