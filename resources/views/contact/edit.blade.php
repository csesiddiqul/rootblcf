@extends('layouts.app')

@section('title', __('Register'))
@section('content')
    <style>
        h4 {
            font-size: 21px !important;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.contact.index').'">'. trans('Communicate').'</a>  / <a href="'. route('academic.contact.index').'">'. trans('Contact').'</a>  / <b>'. trans('Edit').'<b>'])
                @include('components.sectionbar.communicate-bar')
                <div class="panel panel-default">
                    <div class="panel-body pl-0 pr-0">
                        <div class="col-md-12 pl-0">
                            {!! Form::model($contact, ['id' => 'committee_form','method' => 'PATCH','route' => ['academic.contact.update', $contact->id]]) !!}

                            <div class="form-group col-md-6">
                                <label for="name"> @lang('Name')</label>
                                {!! Form::text('name', NULL, array('id' => 'name','required', 'class' => 'form-control','autocomplete' => 'off')) !!}
                                @error('name')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror

                            </div>
                            <div class="form-group col-md-6">
                                <label for="email"> @lang('Email')</label>
                                {!! Form::email('email', NULL, array('id' => 'email','required', 'class' => 'form-control','autocomplete' => 'off')) !!}
                                @error('email')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone"> @lang('Phone')</label>
                                {!! Form::text('phone', NULL, array('id' => 'phone','required', 'class' => 'form-control','autocomplete' => 'off')) !!}
                                @error('phone')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subject"> @lang('Subject')</label>
                                {!! Form::text('subject', NULL, array('id' => 'subject', 'class' => 'form-control','autocomplete' => 'off')) !!}
                                @error('subject')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="message"> @lang('Message')</label>
                                {!! Form::textarea('message', NULL, array('rows' => '5','id' => 'message', 'class' => 'form-control','autocomplete' => 'off')) !!}
                                @error('message')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="remark"> @lang('Remark')</label>
                                {!! Form::textarea('remark', NULL, array('rows' => '2','id' => 'remark', 'class' => 'form-control','autocomplete' => 'off')) !!}
                                @error('remark')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>

                            <div class="clearhight"></div>
                            @method('PUT')
                            <div class="col-md-2 text-center">
                                <button type="submit" id="admitButton" class="{{btnClass()}}">
                                    @lang('Updated')
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
