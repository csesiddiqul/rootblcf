@extends('layouts.app')
@section('title', __('Edit Expense'))
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default ptlb-515">

                <div class="panel-body plt-07">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="row" method="POST" id="registerForm" action="{{url('/accounts/update-expense')}}">
                      {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{$expense->id}}">
                      <div class="col-md-6"> 
                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <label for="name">@lang('Sector Name')</label>

                          
                              <input id="name" type="text" class="form-control" name="name" value="{{$expense->name}}" placeholder="@lang('Sector Name')" required>

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

                          
                              <input id="amount" type="text" class="form-control" name="amount" value="{{$expense->amount}}" placeholder="@lang('Amount')" required>

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

                          
                              <textarea id="description" class="form-control"
                                rows="3"
                               name="description" placeholder="@lang('Description')" required>{{$expense->description}}</textarea>

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
