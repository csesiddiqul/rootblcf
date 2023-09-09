@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/1/0').'">'. trans('Students').'</a> / <a href="'. route('academic.category.index').'">'.trans('Student ').(school('country')->code == 'SG' ? 'Race' : 'Categories') .'</a> / <b>'. trans('Edit').'<b>'])
                @component('components.sectionbar.category-bar')@endcomponent
                <div class="panel panel-default ptlb-515">
                    <div class="panel-body plt-07">
                        {!! Form::model($category, ['id' => 'committee_form','method' => 'PATCH','route' => ['academic.category.update', $category->id]]) !!}
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('name') ? '
                                    has-error' : '' }}">
                                <label for="name">* @lang('Name')</label>
                                {!! Form::text('name', NULL, array('id' => 'name','required', 'class' => 'form-control', 'placeholder' => trans('Name'))) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="onlyclear"></div>
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status">* @lang('Status')</label>{!! Form::select('status',status(), old('status'), array('id' => 'status', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="clearhight"></div>
                        @method('PUT')
                        <div class="col-md-2">
                            <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                @lang('Update')
                            </button>
                        </div>
                        <div class="col-md-2 text-center">
                            <a href="{{route('academic.category.index')}}" class="{{btnClass()}}">@lang('Cancel')</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

