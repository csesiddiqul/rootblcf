@extends('layouts.app')

@section('title', __('Edit School'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.master-left-menu')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default pt-0">
                    <div class="panel-heading">
                        <a id="topback" href="{{ route('schools.index') }}">@lang('Manage Schools')</a> / @lang('Edit')
                    </div>
                    <div class="panel-body p-0">
                        <div class="col-md-12">
                            {!! Form::open(['route' => ['schools.update', $school], 'method' => 'PUT','autocomplete'=>'off','class'=>'row']) !!}
                            <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="control-label">@lang('School Name')</label>
                                <input id="name" type="text" class="form-control" name="name"
                                       value="{{ $school->name }}" placeholder="@lang('School Name')" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-md-6  {{ $errors->has('country_id') ? 'has-error' : '' }}">
                                {!! Form::label('country_id', trans('Country'), ['class' => 'control-label']) !!}
                                {!! Form::select('country_id',$country, $school->country_id, array('class' => 'form-control select2','id'=>'country_id', 'placeholder' => trans('Choose'),'required')) !!}
                                @error('country_id'))
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="clearhight"></div>
                            <div class="col-md-6 form-group{{ $errors->has('perStudent') ? ' has-error' : '' }}">
                                <label for="perStudent"
                                       class="control-label">@lang('Student Fee Per Month') @if($school->country->code=='BD') {{"(৳)"}} @else {{"($)"}} @endif</label>
                                <input id="perStudent" type="text" class="form-control" name="perStudent"
                                       value="{{ $school->perStudent }}" placeholder="@lang('00.00')" required>

                                @if ($errors->has('perStudent'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('perStudent') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-md-6  {{ $errors->has('agentcode') ? 'has-error' : '' }}">
                                {!! Form::label('agentcode', trans('Agent'), ['class' => 'control-label']) !!}
                                {!! Form::select('agentcode',$agents, $school->agentcode, array('class' => 'form-control select2','id'=>'agentcode', 'placeholder' => trans('Choose'))) !!}
                                @error('agentcode'))
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="clearhight"></div>
                            <div class="form-group col-md-6 {{ $errors->has('reseller_id') ? 'has-error' : '' }}">
                                {!! Form::label('reseller_id', trans('Reseller'), ['class' => 'control-label']) !!}
                                {!! Form::select('reseller_id', $reseller , $school->reseller_id , ['class' => 'form-control']) !!}
                                @error('reseller_id'))
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="clearhight"></div>
                            <div class="form-group col-md-6 {{ $errors->has('branch_per') ? 'has-error' : '' }}">
                                {!! Form::label('branch_per', trans('Branch Permission'), ['class' => 'control-label']) !!}
                                {!! Form::select('branch_per', ['1'=>transMsg('Yes'),'0'=>transMsg('No')], $school->branch_per , ['class' => 'form-control']) !!}
                                @error('branch_per'))
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="clearhight"></div>
                            <div class="form-group col-md-6 {{ $errors->has('sms_count') ? 'has-error' : '' }}">
                                {!! Form::label('sms_count', trans('Total SMS Count'), ['class' => 'control-label']) !!}
                                {!! Form::select('sms_count', ['1'=>transMsg('Reset'),'0'=>transMsg('Do not Reset')], 0 , ['class' => 'form-control']) !!}
                                @error('sms_count'))
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="clearhight"></div>
                            <div class="form-group col-md-6 {{ $errors->has('expense_edit') ? 'has-error' : '' }}">
                                {!! Form::label('expense_edit', trans('Expense Edit'), ['class' => 'control-label']) !!}
                                {!! Form::select('expense_edit', ['1'=>transMsg('Yes'),'0'=>transMsg('No')], $school->expense_edit , ['class' => 'form-control']) !!}
                                @error('expense_edit'))
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="clearhight"></div>
                            <div class="form-group col-md-6 {{ $errors->has('status') ? 'has-error' : '' }}">
                                {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
                                {!! Form::select('status', status() + ['3' => transMsg('Expired')] , $school->status , ['class' => 'form-control']) !!}
                                @error('status'))
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="clearhight"></div>
                            <div class="col-md-6 form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                                <label for="about" class="control-label">@lang('About School')</label>
                                <textarea id="about" type="text" class="form-control" name="about"
                                          placeholder="@lang('About School')" required>{{ $school->about }}</textarea>

                                @if ($errors->has('about'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('about') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-2 form-group">
                                <button type="submit" id="registerBtn"
                                        class="btn btn-primary btn-sm btn-block">@lang('Update')</button>
                            </div>
                            <div class="col-md-2 form-group">
                                <a href="{{ route('schools.index') }}"
                                   class="btn btn-default btn-sm btn-block">@lang('Cancel')</a>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
