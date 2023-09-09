@extends('layouts.app')
@section('title', __('Master Dashboard'))
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.agent-left-menu')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default col-sm-12">
                <div class="panel-heading">
                    <a id="topback" href="{{ route('agent.profile',auth()->user()->student_code) }}" class="">@lang('Profile')</a> / Edit
                </div>
                <div class="panel-body pt-5">
                    {!! Form::model($agent, ['method' => 'patch','class'=>'row','autocomplete'=>'off','route' => ['agent.profile.update']]) !!}
                    <h5 class="strong">Basic Information:</h5>
                    <div class="clearfix"></div>
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

                        @if($agent->nationality=='Bangladesh')
                            @php $mds = 6 ; @endphp
                        <div class="col-md-4 form-group{{ $errors->has('district_id') ? ' has-error' : '' }}">
                            <label for="district_id" class="control-label">* @lang('District')</label>
                            {!! Form::select('district_id',$district,$agent->agent->district_id, array('id' => 'district_id', 'class' => 'form-control select2', 'placeholder' => trans('Select District'),'required')) !!}
                            @if ($errors->has('district_id'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('district_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4 form-group {{ $errors->has('nid') ? ' has-error' : '' }}">
                            <label for="nid" class="control-label">* @lang('NID')</label>
                            <input id="nid" type="text" class="form-control" name="nid" value="{{ $agent->agent->nid }}"
                                   required>
                            @if ($errors->has('nid'))
                                <span class="help-block m-0">
                                <strong>{{ $errors->first('nid') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-4 form-group {{ $errors->has('nid_url') ? ' has-error' : '' }}">
                            <div class="image-upload">
                                <label class="control-label upperlabel">
                                    * @lang('Picture of NID (Both Sides)')
                                    <span id="deliMG" onclick="cancelUploadImg('unnamed2');" style="display: none;" class="myspanRemove">Remove</span>
                                </label>
                                <label class="btn btn-success btn-sm btn-block uploded-text" for="file-upload">Choose Picture</label>
                                <input type="file" value="" class="file-upload form-control" id="file-upload" accept="image/*">
                            </div>
                            <div style="clear:both;"></div>
                            <div id="uploaded_image_url"></div>
                        </div>
                        <div class="clearfix"></div>
                        @elseif($agent->nationality=='United States')
                            @php $mds = 4 ; @endphp
                        <div class="col-md-4 form-group{{ $errors->has('state_id') ? ' has-error' : '' }}">
                            <label for="state_id" class="control-label">* @lang('State')</label>
                            {!! Form::select('state_id',$state,$agent->agent->state_id, array('id' => 'state_id', 'class' => 'form-control select2', 'placeholder' => trans('Select State'),'required')) !!}
                            @if ($errors->has('state_id'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('state_id') }}</strong>
                                </span>
                            @endif
                        </div>
                        @else
                            @php $mds = 4 ; @endphp
                        <div class="col-md-4 form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="control-label">* @lang('City')</label>
                            <textarea style="line-height:22px;" id="city" class="form-control" name="city" required rows="2">{{ $agent->agent->city }}</textarea>
                            @if ($errors->has('city'))
                                <span class="help-block m-0">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                            @endif
                        </div>
                        @endif
                        <div class="col-md-{{$mds}} form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="control-label">*@lang('Address')</label>
                            <textarea style="line-height:22px;" id="address" class="form-control" name="address" required rows="2">{{ $agent->address }}</textarea>
                            @if ($errors->has('address'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-{{$mds}} form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="control-label">*@lang('About')</label>
                            <textarea style="line-height:22px;" id="about" class="form-control" name="about" required rows="2">{{ $agent->about }}</textarea>
                            @if ($errors->has('about'))
                                <span class="help-block m-0">
                                    <strong>{{ $errors->first('about') }}</strong>
                                </span>
                            @endif
                        </div>
                        <h5 class="strong">Bank Information:</h5>
                        <div class="col-md-4 form-group {{ $errors->has('bank_name') ? ' has-error' : '' }}">
                            <label for="bank_name" class="control-label">* @lang('Bank Name')</label>
                            <input id="bank_name" type="text" class="form-control" name="bank_name" value="{{ $agent->agent->bank_name }}"
                                   required>
                            @if ($errors->has('bank_name'))
                                <span class="help-block m-0">
                                <strong>{{ $errors->first('bank_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-4 form-group {{ $errors->has('ac_name') ? ' has-error' : '' }}">
                            <label for="ac_name" class="control-label">* @lang('Ledger Name')</label>
                            <input id="ac_name" type="text" class="form-control" name="ac_name" value="{{ $agent->agent->ac_name }}"
                                   required>
                            @if ($errors->has('ac_name'))
                                <span class="help-block m-0">
                                <strong>{{ $errors->first('ac_name') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-4 form-group {{ $errors->has('ac_number') ? ' has-error' : '' }}">
                            <label for="ac_number" class="control-label">* @lang('Ledger Number')</label>
                            <input id="ac_number" type="text" class="form-control" name="ac_number" value="{{ $agent->agent->ac_number }}"
                                   required>
                            @if ($errors->has('ac_number'))
                                <span class="help-block m-0">
                                <strong>{{ $errors->first('ac_number') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-4 form-group {{ $errors->has('ac_branch') ? ' has-error' : '' }}">
                            <label for="ac_branch" class="control-label">* @lang('Branch Name')</label>
                            <input id="ac_branch" type="text" class="form-control" name="ac_branch" value="{{ $agent->agent->ac_branch }}"
                                   required>
                            @if ($errors->has('ac_branch'))
                                <span class="help-block m-0">
                                <strong>{{ $errors->first('ac_branch') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="col-md-4 form-group {{ $errors->has('ac_routing') ? ' has-error' : '' }}">
                            <label for="ac_routing" class="control-label">* @lang('Routing Number')</label>
                            <input id="ac_routing" type="text" class="form-control" name="ac_routing" value="{{ $agent->agent->ac_routing }}"
                                   required>
                            @if ($errors->has('ac_routing'))
                                <span class="help-block m-0">
                                <strong>{{ $errors->first('ac_routing') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="clearhight"></div>
                        <div class="col-md-2 form-group">
                            <button type="submit" id="registerBtn" class="{{btnClass()}}">@lang('Update Now')</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    @component('components.cropper.element',['width'=>'600','height'=>'260','type'=>'square'])
    @endcomponent
</div>
@endsection
