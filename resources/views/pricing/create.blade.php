@extends('layouts.app') 
@section('title', __('Master Dashboard')) 
@section('content')  
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.master-left-menu') 
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default col-sm-12">  
                <div class="panel-body p-0">
                    @include('pricing.pricing-menu')
                    {!! Form::open(array('route' =>'pricings.store','method' =>'POST','role' =>'form','autocomplete'=>'off','class'=>'row')) !!}  
                        <div class="col-md-3 form-group{{ $errors->has('price_type') ? ' has-error' : '' }}">
                            <label for="price_type" class="control-label">* @lang('Pricing For')</label>
                            {!! Form::select('price_type',pricingfor(),null, array('id' => 'price_type', 'class' => 'form-control select2', 'placeholder' => trans('Select'),'required','onChange'=>'pricingType(this.value)')) !!} 
                            @if ($errors->has('price_type'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('price_type') }}</strong>
                                </span>
                            @endif
                        </div> 
                        <div class="col-md-3 form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">* @lang('Title')</label>
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"
                                   required>
                            @if ($errors->has('title'))
                                <span class="help-block m-0">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-3 form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="control-label">* @lang('Price')</label>
                            <input id="price" type="text" class="form-control" name="price"
                                   value="{{ old('price') }}" required>
                            @if ($errors->has('price'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </span>
                            @endif
                        </div> 
                        <div class="col-md-3 form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label for="country" class="control-label">* @lang('Country')</label>
                            {!! Form::select('country',$country,null, array('id' => 'country', 'class' => 'form-control select2', 'placeholder' => trans('Select Country'),'required')) !!} 
                            @if ($errors->has('country'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            @endif
                        </div> 
                        <div class="clearfix"></div>
                        <div id="subsMonthDiv" class="col-md-3 form-group{{ $errors->has('subsMonth') ? ' has-error' : '' }}" style="display:none">
                            <label for="subsMonth" class="control-label">* @lang('Subscription With')</label>
                            {!! Form::select('subsMonth',subscription(),1, array('id' => 'subsMonth', 'class' => 'form-control select2', 'placeholder' => trans('Select Month'),'required')) !!} 
                            @if ($errors->has('subsMonth'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('subsMonth') }}</strong>
                                </span>
                            @endif
                        </div>  
                        <div id="perStudentDiv" class="col-md-3 form-group{{ $errors->has('perStudent') ? ' has-error' : '' }}" style="display:none">
                            <label for="perStudent" class="control-label">* @lang('Student Fee Per Month')</label>
                            <input id="perStudent" type="text" class="form-control" name="perStudent" value="{{ old('perStudent') }}">
                            @if ($errors->has('perStudent'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('perStudent') }}</strong>
                                </span>
                            @endif
                        </div> 
                        <div class="clearfix"></div>
                        <div class="col-md-12 form-group {{ $errors->has('details') ? ' has-error' : '' }}">
                            <label for="details" class="control-label">*@lang('Details')</label>
                            <textarea id="details" class="form-control f-address" name="details" required rows="4" placeholder="Write pricing details ...">{{ old('details') }}</textarea> 
                            @if ($errors->has('details'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('details') }}</strong>
                                </span>
                            @endif
                        </div>  
                        <div class="clearhight"></div>
                        <div class="col-md-2 form-group">
                            <button type="submit" id="registerBtn" class="btn btn-primary btn-sm btn-block">@lang('Submit Now')</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div> 
        </div>
    </div>
</div>  
@endsection
