@extends('layouts.app')

@section('title', __('Register'))
@section('content')
    <style>
        h4 {
            font-size: 21px !important;
        }

        .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
            background-color: #ecf0f1 !important;
            opacity: 1 !important;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.contact.index').'">'. trans('Communicate').'</a>  / <a href="'. route('academic.complain.index').'">'. trans('Feedback').'</a>  / <b>'. trans('Edit').'<b>'])
                @include('components.sectionbar.communicate-bar')
                <div class="panel panel-default">
                    <div class="panel-body pl-0 pr-0">
                        <div class="col-md-12 pl-0">
                            {!! Form::model($complain, ['id' => 'committee_form','method' => 'PATCH','route' => ['academic.complain.update', $complain->id]]) !!}
                            <div class="form-group col-md-4">
                                <label for="name"> @lang('Name')</label>
                                {!! Form::text('name', NULL, array('id' => 'name','required', 'readonly', 'class' => 'form-control','autocomplete' => 'off')) !!}
                                @error('name')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror

                            </div>
                            <div class="form-group col-md-4">
                                <label for="phone"> @lang('Contact Number')</label>
                                {!! Form::text('contactnumber', NULL, array('id' => 'contactnumber','required', 'readonly', 'class' => 'form-control','autocomplete' => 'off')) !!}
                                @error('contactnumber')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email"> @lang('Email')</label>
                                {!! Form::email('email', NULL, array('id' => 'email','required', 'readonly','class' => 'form-control','autocomplete' => 'off')) !!}
                                @error('email')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>


                            <div class="form-group col-md-12">
                                <label for="message"> @lang('Description')</label>
                                {!! Form::textarea('description', NULL, array('rows' => '5','id' => 'description', 'readonly', 'class' => 'form-control','autocomplete' => 'off')) !!}
                                @error('description')
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
