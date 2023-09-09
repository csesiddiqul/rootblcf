@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/1/0').'">'. trans('Students').'</a> / <a href="'. route('academic.house.index').'">'.trans('Student '.(school('country')->code == 'SG' ? 'Branch' : 'House')) .'</a> / <b>'. trans('Edit').'<b>'])
                @component('components.sectionbar.house-bar')@endcomponent
                <div class="panel panel-default">

                    <div class="panel-body">
                        {!! Form::model($house, ['method' => 'PATCH','route' => ['academic.house.update', $house->id]]) !!}
                        {{ csrf_field() }}
                        <div class="col-md-5 pl-0">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">@lang('Name')</label>
                                {!! Form::text('name', NULL, array('id' => 'name','required', 'class' => 'form-control', 'placeholder' => trans('Name'))) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description">@lang('Description')</label>
                                {!! Form::textarea('description', NULL, array('rows' => '5','id' => 'description', 'required', 'class' => 'form-control', 'placeholder' => trans('Description'))) !!}
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status">@lang('Status')</label>
                                {!! Form::select('status',status(), old('status'), array('id' => 'status', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="clearhight"></div>
                        @method('PUT')
                        <div class="col-md-2 text-center pl-0">
                            <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                @lang('Update')
                            </button>
                        </div>
                        <div class="col-md-2 text-center pl-0">
                            <a href="{{route('academic.house.index')}}" class="{{btnClass()}}">@lang('Cancel')</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

