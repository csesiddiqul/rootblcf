@extends('layouts.app')

 @section('title', __('Students')) 

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
</div>
@endsection