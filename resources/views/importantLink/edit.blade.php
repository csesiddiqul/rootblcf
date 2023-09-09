@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <a href="'. route('academic.importantLink.index').'">'.trans('Important Link') .'</a> / <b>'. trans('Edit').'<b>'])
                @include('components.sectionbar.frontmanagement-bar')
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-6">
                            {!! Form::model($importantLink, ['id' => 'committee_form','method' => 'PATCH','route' => ['academic.importantLink.update', $importantLink->id]]) !!}
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('link') ? '
                                    has-error' : '' }}">
                                <label for="link">@lang('Link')</label>
                                {!! Form::text('link', NULL, array('id' => 'link','required', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                @if ($errors->has('link'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('link') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">@lang('Name')</label>{!! Form::text('name', NULL, array('id' => 'name','required', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('parioty') ? ' has-error' : '' }}">
                                <label for="parioty">@lang('Priority')</label>{!!Form::number('parioty', NULL, array('id' => 'parioty','required', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                @if ($errors->has('endtime'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('endtime') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="status">@lang('Status')</label>{!! Form::select('status',status(), old('status'), array('id' => 'status', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="clearhight"></div>
                            @method('PUT')
                            <div class="col-md-4 pl-0">
                                <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                    @lang('Update')
                                </button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

