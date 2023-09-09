@extends('layouts.app')
@section('title', __('Ledger Sectors'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <a href="'. route('accounts.sectors.index').'">'. trans('Account Head').'</a> / <b>'.$sector->name.'<b>'])
                @include('components.sectionbar.accounts-bar')
                <div class="panel panel-default pt-0">
                    <div class="form-group col-md-12">
                        <label for="account_head">@lang('Account Head')</label>
                        <select id="account_head" class="form-control select2" name="account_head" onchange="if (this.value) window.location.href=this.value">
                            @foreach ($accountHeads as $key => $value)
                                <optgroup label="{{ucfirst($key)}}">
                                    @foreach ($value->sortBy('name') as $head)
                                        <option value="{{$head->id}}" {{$head->id == $sector->id ? 'selected' : ''}}>{{$head->name}}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('account_head')
                        <span class="help-block">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="panel-heading" style="background-color: #fafadf">
                        <h5>Ledger statement for {{$sector->name}}
                            from {{date('Y-M-d',strtotime($results[0]->op_date))}}
                            to {{date('Y-M-d',strtotime($results[count($results)-1]->op_date))}}</h5>
                        <table class="table stripped table-bordered">
                            <tbody>
                            <tr>
                                <td>Opening balance as on {{date('Y-M-d',strtotime($results[0]->op_date))}}</td>
                                <td>{{number_format($results[0]->op_balance,2)}}</td>
                            </tr>
                            <tr>
                                <td>Closing balance as
                                    on {{date('Y-M-d',strtotime($results[count($results)-1]->op_date))}}</td>
                                <td>{{number_format($closing_balance,2)}}</td>
                                {{--<td>{{number_format($results[count($results)-1]->op_balance,2)}}</td>--}}
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-data-div">
                                <thead>
                                <tr>
                                    <th>@lang('Si')</th>
                                    <th>@lang('Date')</th>
                                    <th>@lang('Opening Balance')</th>
                                    <th>@lang('Closing Balance')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($results as $key => $result)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{date('Y-M-d',strtotime($result->op_date))}}</td>
                                        <td>{{number_format($result->op_balance,2)}}</td>
                                        <td>{{number_format($result->cl_balance,2)}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
