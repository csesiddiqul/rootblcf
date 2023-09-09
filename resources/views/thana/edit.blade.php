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
                        @component('components.sectionbar.thana')@endcomponent
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" id="registerForm" action="{{ route('academic.thana.update',$thana->id) }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">* @lang('Division Name')</label>
                                <div class="col-md-6">
                                    {!! Form::select('division_id',$division, $thana->division_id , ['class' => 'form-control','id' => 'division_id']) !!}
                                    @if ($errors->has('division_id'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('division_id') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">* @lang('Division Name')</label>
                                <div class="col-md-6">
                                    {!! Form::select('district_id',$district, $thana->district_id , ['class' => 'form-control','id' => 'district_id']) !!}
                                    @if ($errors->has('district_id'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('district_id') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">* @lang('Thana Name')</label>
                                <div class="col-md-6">
                                    {!! Form::text('name', $thana->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('Thana Name '))) !!}
                                     @if ($errors->has('name'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">* @lang('Thana Name Bangla')</label>
                                <div class="col-md-6">
                                    {!! Form::text('namebn', $thana->namebn, array('id' => 'namebn', 'class' => 'form-control', 'placeholder' => trans('Thana Name Bangla '))) !!}
                                     @if ($errors->has('namebn'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('namebn') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">* @lang('Status')</label>
                                <div class="col-md-6">
                                    
                                     {!! Form::select('status', ['1'=>'Active','2'=>'De-Active'] , $thana->status , ['class' => 'form-control','id' => 'status']) !!}
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
                                    {!! Form::button(trans('Update'), array('class' => btnClass(),'type' => 'submit' )) !!}
                                   
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('#established').datepicker({
                format: "dd-mm-yyyy",
                viewMode: "days",
                minViewMode: "days"
            });
        });
    </script>
@endsection