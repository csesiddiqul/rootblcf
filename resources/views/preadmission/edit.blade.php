@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default">
                    @component('components.sectionbar.admission-bar')@endcomponent
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" id="registerForm"
                              action="{{ route('academic.preadmission.update',$preAdmission->id) }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                <label for="year" class="col-md-4 control-label">* @lang('Year')</label>
                                <div class="col-md-6">
                                    <input id="year" type="text" class="form-control" name="year"
                                           value="{{ $preAdmission->year }}">
                                    @if ($errors->has('year'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('year') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('shift') ? ' has-error' : '' }}">
                                <label for="shift" class="col-md-4 control-label">* @lang('Shift')</label>
                                <div class="col-md-6">
                                    <input id="shift" type="text" class="form-control" name="shift"
                                           value="{{ $preAdmission->shift }}">
                                    @if ($errors->has('shift'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('shift') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status" class="col-md-4 control-label">* @lang('Status')</label>
                                <div class="col-md-6">
                                    {!! Form::select('status', status() , $preAdmission->status , ['class' => 'form-control','id' => 'status']) !!}
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
                                    {!! Form::button(trans('Update'), array('class' => btnClass().' margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}

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
            $('#year').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years"
            });
        });
    </script>
@endsection