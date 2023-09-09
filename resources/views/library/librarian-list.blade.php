@extends('layouts.app')

@section('title', __('Librarians'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
              @include('components.sectionbar.teacher-bar')
              @if(count($users) > 0)
              @foreach ($users as $user)
                <div class="page-panel-title">@lang('List of all') {{__(ucfirst($user->role))}}s</div>
                 @break($loop->first)
              @endforeach
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
