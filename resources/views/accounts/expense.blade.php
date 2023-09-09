@extends('layouts.app')
@section('title', __('Add New Expense'))
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
              <div class="page-panel-title" style="margin-left: 5px;">
              <a href="{{url('users/'.Auth::user()->school->code.'/accountant')}}">@lang('Manage Accounts')</a><span> / </span><span><a href="{{ url('accounts/expense') }}"><b>@lang('Add New Expense')</b></a></span>
                </div>
                        <div class="clearfix"></div>
                 @include('components.sectionbar.accounts-bar')
            <div class="panel panel-default ptlb-515">

                <div class="panel-body plt-07">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="row" method="POST" id="registerForm" action="{{url('accounts/create-expense')}}">
                      {{ csrf_field() }}
                      <div class="col-md-6">
                       <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name">@lang('Sector Name')</label>
                              <select  class="form-control" name="account_sector_id">
                                <option>Choose</option>
                                @foreach($sectors as $sector)
                                  <option value="{{$sector->id}}">{{$sector->name}}</option>
                                @endforeach
                              </select>

                              @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="onlyclear"></div>
                      <div class="col-md-6">
                         <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                          <label for="amount">@lang('Amount')</label>

                          
                              <input id="amount" type="number" class="form-control" name="amount" value="{{ old('amount') }}" placeholder="@lang('Amount')" required>

                              @if ($errors->has('amount'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('amount') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="onlyclear"></div>
                      <div class="col-md-6">
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                          <label for="description">@lang('Description')</label>

                          
                              <textarea rows="3" id="description" class="form-control" name="description" placeholder="@lang('Description')" required>{{ old('description') }}</textarea>

                              @if ($errors->has('description'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('description') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="clearhight"></div> 
                        <div class="col-md-2">
                          <button type="submit" id="registerBtn" class="{{btnClass()}}">
                            @lang('Save')
                          </button>
                        </div>
                       <div class="clearhight50"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
