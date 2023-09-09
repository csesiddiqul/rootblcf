@extends('layouts.app')
@section('title', __('Ledger Sectors'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @if(!isset($financialYear))
                    @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Financial Years').'<b>'])
                @else
                    @include('components.pages-bar',['pageTitle' =>'<a href="'. route('accounts.financialyear.edit',$financialYear->id).'">'. trans('Manage Accounts').'</a> / <b>'.trans('Edit Financial Years').'<b>'])
                @endif
                @include('components.sectionbar.accounts-bar')
                <div class="col-md-4 pl-0">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form action="{{ $postUrl }}" method="post">
                                {{ csrf_field() }}
                                <div class="clearhight"></div>
                                <div class="form-group">
                                    <label for="upload-title">@lang('Financial Year') </label>
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ (isset($financialYear->name))?$financialYear->name:old('name') }}"
                                           placeholder="@lang('Financial Year')" required>
                                    @error('name')
                                    <span class="help-block help-cust">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="from_date">@lang('Start Date')</label>
                                    {!! Form::text('from_date', (isset($financialYear) ? date('d-m-Y',strtotime($financialYear->from_date)) :  NULL), array('id' => 'from_date',  'class' => 'form-control','autocomplete'=>'off','required')) !!}
                                    @error('from_date')
                                    <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="to_date">@lang('End Date')</label>
                                    {!! Form::text('to_date', (isset($financialYear) ? date('d-m-Y',strtotime($financialYear->to_date)) :  NULL), array('id' => 'to_date',  'class' => 'form-control','autocomplete'=>'off','required')) !!}
                                    @error('to_date')
                                    <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status">@lang('Status')</label>
                                    {!! Form::select('status',status(), (isset($financialYear) ? $financialYear->status :  NULL), array('id' => 'status', 'class' => 'form-control', 'placeholder' => trans('Choose'),'required')) !!}
                                    @error('status')
                                    <span class="help-block help-cust">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @isset($financialYear)
                                    <div class="form-group">
                                        <label for="is_close">@lang('To end the current Financial Year, please click on the checkbox')</label>
                                        <input {{$financialYear->is_close == 0 ? 'checked disabled':''}} onclick="return confirm('Are you sure close this financial year?')" name="is_close" type="checkbox" value="1">
                                        @error('is_close')
                                        <span class="help-block help-cust">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    @method('PATCH')
                                @endisset
                                <div class="col-md-6" style="margin-left: -15px">
                                    <button type="submit" id="registerBtn"
                                            class="{{btnClass()}}">
                                        @isset($financialYear)
                                            @lang('Update')
                                        @else
                                            @lang('Create')
                                        @endisset
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 pr-0 pl-0">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-data-div">
                                    <thead>
                                    <tr>
                                        <th>@lang('Financial Year')</th>
                                        <th>@lang('Start Date')</th>
                                        <th>@lang('End Date')</th>
                                        <th>@lang('Status')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($financial_years as $result)
                                        <tr class="{{$result->is_close == 1 ? 'text-success' : ''}}"
                                            title="{{$result->is_close == 1 ? 'Current Financial Year' : ''}}">
                                            <td>{{$result->name}}</td>
                                            <td>{{date('d M, Y',strtotime($result->from_date))}}</td>
                                            <td>{{date('d M, Y',strtotime($result->to_date))}}</td>
                                            <td>{{status($result->status)}}</td>
                                            <td>
                                                @if(auth()->user()->role == 'admin')
                                                <a href="{{route('accounts.financialyear.edit',$result->id)}}"
                                                   class="btn btn-xs btn-default" role="button">@lang('Edit') </a>
                                                    @if(serverIsLocal())
                                                    <a class="btn btn-xs btn-danger"
                                                       onclick="confirm_delete('{{$result->id}}')">@lang('Delete')</a>
                                                    <form id="delete_form_{{$result->id}}"
                                                          action="{{route('accounts.financialyear.destroy',$result->id)}}"
                                                          method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')
                                                    </form>
                                                    @endif
                                                @endif
                                            </td>
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
    </div>
    @push('script')
        <script>
            $(document).ready(function () {
                $('#from_date').datepicker({
                    format: "dd-mm-yyyy",
                    viewMode: "days",
                    minViewMode: "days",
                    autoclose: true,
                });
                $('#to_date').datepicker({
                    format: "dd-mm-yyyy",
                    viewMode: "days",
                    minViewMode: "days",
                    autoclose: true,
                });

                function appendFunction() {
                    var appendHtml = $("#sectorName").html();
                    $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
                }

                setTimeout(function () {
                    appendFunction();
                }, 1000);
            })
        </script>
    @endpush

@endsection
