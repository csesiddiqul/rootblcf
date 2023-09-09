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
                    <a id="topback" href="{{ route('pricings.index') }}" class="">@lang('Pricings')</a> / Edit
                </div> 
                <div class="panel-body pt-5">  
                    {!! Form::model($pricing, ['id' => 'pricing_form','class'=>'row','autocomplete'=>'off','method' => 'PATCH','route' => ['pricings.update', $pricing->id]]) !!} 
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
                            {!! Form::text('title', NULL, array('id' => 'title','required', 'class' => 'form-control', 'placeholder' => trans('Title'))) !!} 
                            @if ($errors->has('title'))
                                <span class="help-block m-0">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-3 form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price" class="control-label">* @lang('Price')</label>
                            {!! Form::text('price', NULL, array('id' => 'price','required', 'class' => 'form-control', 'placeholder' => trans('00.00'))) !!} 
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
                        @if($pricing->price_type==1 || $pricing->price_type==3)
                            @php $display="display:block"; $reque="required"; @endphp
                        @else
                            @php $display="display:none"; $reque=""; @endphp
                        @endif
                        <div id="subsMonthDiv" class="col-md-3 form-group{{ $errors->has('subsMonth') ? ' has-error' : '' }}" style="{{$display}}">
                            <label for="subsMonth" class="control-label">* @lang('Subscription With')</label>
                            {!! Form::select('subsMonth',subscription(),null, array('id' => 'subsMonth', 'class' => 'form-control select2', 'placeholder' => trans('Select Month'),$reque)) !!} 
                            @if ($errors->has('subsMonth'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('subsMonth') }}</strong>
                                </span>
                            @endif
                        </div> 
                        @if($pricing->price_type==1)
                            @php $displays="display:block"; $reques="required"; @endphp
                        @else
                            @php $displays="display:none"; $reques=""; @endphp
                        @endif
                        <div id="perStudentDiv" class="col-md-3 form-group{{ $errors->has('perStudent') ? ' has-error' : '' }}" style="{{$displays}}">
                            <label for="perStudent" class="control-label">* @lang('Student Fee Per Month')</label>
                            {!! Form::text('perStudent', NULL, array('id' => 'perStudent',$reques, 'class' => 'form-control', 'placeholder' => trans('0.0'))) !!} 
                            @if ($errors->has('perStudent'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('perStudent') }}</strong>
                                </span>
                            @endif 
                        </div> 
                        <div class="clearfix"></div>
                        <div class="col-md-12 form-group {{ $errors->has('details') ? ' has-error' : '' }}">
                            <label for="details" class="control-label">*@lang('Details')</label>
                            {!! Form::textarea('details', NULL, array('id' => 'details','required', 'class' => 'form-control f-address', 'placeholder' => trans('Write pricing details ...'),'rows'=>'5')) !!} 
                            @if ($errors->has('details'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('details') }}</strong>
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
