@extends('layouts.app') 
@section('title', __('Master Dashboard')) 
@section('content')  
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.master-left-menu') 
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default pt-0">
                <div class="panel-heading"> 
                    <a id="topback" href="{{ route('agents.index') }}">@lang('Agents')</a> / @lang('Edit')
                </div> 
                <div class="panel-body">  
                    {!! Form::model($agent, ['method' => 'POST','class'=>'row','autocomplete'=>'off','route' => ['agent.store', ['id'=>$agent->id]]]) !!} 
                        <div class="col-md-4 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="control-label">* @lang('Full Name')</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $agent->name }}"
                                   required>
                            @if ($errors->has('name'))
                                <span class="help-block m-0">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-4 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">* @lang('E-mail')</label>
                            <input id="email" type="email" class="form-control" name="email"
                                   value="{{ $agent->email }}" required>
                            @if ($errors->has('email'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4 form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number" class="control-label">* @lang('Phone')</label>
                            <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ $agent->phone_number }}">
                            @if ($errors->has('phone_number'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="clearfix"></div>  
                        <div class="col-md-4 form-group{{ $errors->has('nationality') ? ' has-error' : '' }}">
                            <label for="nationality" class="control-label">* @lang('Nationality')</label>
                            {!! Form::select('nationality',$country,$agent->nationality, array('id' => 'nationality', 'class' => 'form-control select2', 'placeholder' => trans('Select Country'),'required')) !!} 
                            @if ($errors->has('nationality'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('nationality') }}</strong>
                                </span>
                            @endif
                        </div> 
                        <div class="col-md-4 form-group{{ $errors->has('shareOf') ? ' has-error' : '' }}">
                            <label for="shareOf" class="control-label">* @lang('Share of percentage(%)')</label>
                            <input id="shareOf" type="number" step="any" class="form-control" name="shareOf" value="{{ $agent->agent->shareOf }}" required min="1" max="50">
                            @if ($errors->has('shareOf'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('shareOf') }}</strong>
                                </span>
                            @endif 
                        </div>
                        <div class="col-md-4 form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="control-label">*@lang('Address')</label>
                            <textarea id="address" class="form-control f-address" name="address" required rows="1">{{ $agent->address }}</textarea> 
                            @if ($errors->has('address'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>  
                        <div class="clearhight"></div>
                        <div class="col-md-2 form-group">
                            <button type="submit" id="registerBtn" class="btn btn-primary btn-sm btn-block">@lang('Update Now')</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div> 
        </div>
    </div>
</div>  
@endsection
