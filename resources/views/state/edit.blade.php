@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default">
                    <div class="panel panel-default">
                   @component('components.sectionbar.state-bar')@endcomponent
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" id="registerForm"
                              action="{{ route('academic.state.update',$state->id) }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">* @lang('Country Name')</label>
                                <div class="col-md-6">
                                    {!! Form::select('country_id',$country, $state->country_id , ['class' => 'form-control','id' => 'country_id']) !!}
                                    @if ($errors->has('country_id'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('country_id') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">* @lang('State Name')</label>
                                <div class="col-md-6">
                                    {!! Form::text('name', $state->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('State Name '))) !!}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">* @lang('Status')</label>
                                <div class="col-md-6">

                                    {!! Form::select('status', status() , $state->status , ['class' => 'form-control','id' => 'status']) !!}
                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            @method('PUT')
                            <div class="form-group">
                                <div class="col-md-2 col-md-offset-4">
                                    {!! Form::button(trans('Update'), array('class' =>btnClass(),'type' => 'submit' )) !!}

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection