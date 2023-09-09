@extends('layouts.app')
@section('title', __('Add GPA System'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('exams').'">'. trans('Exams').'</a>  / <a href="'. route('gpa.index').'">'. trans('Grade System').'</a>  / <b>'. trans('Add').'<b>'])
                @include('components.sectionbar.examination-bar')
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-5 pl-0">
                        <form action="{{route('gpa.store')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('grade_system_name') ? ' has-error' : '' }}">
                                <label for="grade_system_name"
                                       class="control-label">@lang('Grade System Name')</label>
                                <input id="grade_system_name" type="text" class="form-control"
                                       name="grade_system_name" value="{{ old('grade_system_name') }}"
                                       placeholder="@lang('Grade System Name')" required>

                                @if ($errors->has('grade_system_name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('grade_system_name') }}</strong>
                                  </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('grade') ? ' has-error' : '' }}">
                                <label for="grade" class="control-label">@lang('Grade')</label>
                                <input id="grade" type="text" class="form-control" name="grade"
                                       value="{{ old('grade') }}" placeholder="A+, A, A-, B+, ..." required>

                                @if ($errors->has('grade'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('grade') }}</strong>
                                  </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('point') ? ' has-error' : '' }}">
                                <label for="point" class="control-label">@lang('Grade Point')</label>
                                <input id="point" type="text" class="form-control" name="point"
                                       value="{{ old('point') }}" placeholder="5.00, 4.50, ..." required>

                                @if ($errors->has('point'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('point') }}</strong>
                                  </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('from_mark') ? ' has-error' : '' }}">
                                <label for="from_mark" class="control-label">@lang('From Mark')</label>
                                <input id="from_mark" type="text" class="form-control" name="from_mark"
                                       value="{{ old('from_mark') }}" placeholder="@lang('Example: 80')" required>

                                @if ($errors->has('from_mark'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('from_mark') }}</strong>
                                  </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('to_mark') ? ' has-error' : '' }}">
                                <label for="to_mark" class="control-label">@lang('To Mark')</label>
                                <input id="to_mark" type="text" class="form-control" name="to_mark"
                                       value="{{ old('to_mark') }}" placeholder="@lang('Example: 90')" required>

                                @if ($errors->has('to_mark'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('to_mark') }}</strong>
                                  </span>
                                @endif
                            </div>
                            <div class="col-md-5 pl-0">
                                <button type="submit" class="{{btnClass()}}">@lang('Save')</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
