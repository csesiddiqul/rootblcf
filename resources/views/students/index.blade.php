@extends('layouts.app')

@section('title', __('Students Info'))
@section('content')
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-2" id="side-navbar">
              @include('layouts.leftside-menubar')
          </div>
          <div class="col-md-10" id="main-container">
              <div class="panel panel-default">
                  <div class="page-panel-title">@lang('Students Info')</div>
                  @include('layouts.student.section-bar')
              </div>
          </div>
      </div>
  </div>
@endsection