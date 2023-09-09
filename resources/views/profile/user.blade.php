@extends('layouts.app')

@if(count(array($user)) > 0)
  @section('title', $user->name)
@endif 
@section('content')
@component('components.cropper.editelement',['width'=>'270','height'=>'270','type'=>'squre','table_name'=>'users','table_id'=>$user->id,'table_field'=>'pic_path']) @endcomponent
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">
                <div class="clearhight"></div>
                <div class="panel-heading"> 
                    @php
                        $passcode = "/".($user->role=='student' ? 1:0)."/".($user->role=='teacher' ? 1: ($user->role=='student' ? 0:2));
                    @endphp
                    <a id="topback" href="{{ url('/users/'.Auth::user()->school->code.$passcode)}}" class="">{{ucfirst($user->role)}}</a> / @lang('Profile')
                </div>
                @if(count(array($user)) > 0)
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @component('components.user-profile',['user'=>$user])
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
