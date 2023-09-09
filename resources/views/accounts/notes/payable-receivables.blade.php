@extends('layouts.app')
@section('title', __('Ledger Sectors'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @if(\Request::url() == url('accounts/ledger'))
                    @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Ledger').'<b>'])
                @else
                    @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Edit Ledger').'<b>'])
                @endif
                    @include('components.sectionbar.reports-bar')
                <div class="col-md-4 pl-0">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form action="" method="post">
                                {{ csrf_field() }}
                                {{--  @isset($sector->type)
                                      <h3 class="pl-0 mt-0">@lang('Edit Sectors')</h3>
                                  @else
                                      <h3 class="pl-0 mt-0">@lang('Add Sectors')</h3>
                                  @endif--}}
                                <div class="clearhight"></div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="upload-title">@lang('Group Name'): </label>--}}
{{--                                    <input id="ac_group" type="text" class="form-control" name="py_group">--}}
{{--                                    @error('py_group')--}}
{{--                                    <span class="help-block help-cust">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label for="upload-title">@lang('Name'): </label>
                                    <input id="name" type="text" class="form-control" name="name" required>
                                    @error('name')
                                    <span class="help-block help-cust">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                @if(!isset($ledger))
                                    <div class="form-group">
                                        <label for="current_balance">@lang('Balance'): </label>
                                        <input id="current_balance" type="number" class="form-control" name="balance">
                                        @error('current_balance')
                                        <span class="help-block help-cust">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="upload-title">@lang('date'): </label>
                                    <input id="date" type="date" class="form-control" name="date" required>
                                    @error('date')
                                    <span class="help-block help-cust">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6" style="margin-left: -15px">
                                    <button type="submit" id="registerBtn"
                                            class="{{btnClass()}}">
                                            Create
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
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Amount S$')</th>

                                        <th style="float: right">@lang('Action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($payrecevs as $key => $payrecev)

{{--                                            @if(!empty($key))--}}
{{--                                                <tr>--}}
{{--                                                    <td colspan="2"><b>{{$key}}</b></td>--}}
{{--                                                </tr>--}}
{{--                                            @endif--}}

                                            <tr class="popTop" title="<p>Current Balance : {{$payrecev->amount}}</p>">
                                                <td>
                                                    {{$payrecev->name}}
                                                </td>
                                                <td>
                                                    {{$payrecev->amount}}
                                                </td>
                                                <td style="float:right;">
                                                    <a href="{{route('accounts.pay_receive.edit',[$payrecev->id])}}"
                                                       class="btn btn-xs btn-default" role="button">@lang('Edit')</a>

{{--                                                    <a class="btn btn-xs btn-danger"--}}
{{--                                                       onclick="confirm_delete('')">@lang('Delete')</a>--}}
{{--                                                    <form id="delete_form_"--}}
{{--                                                          action="{{route('accounts.pay_receive.destroy'}}"--}}
{{--                                                          method="POST" style="display: none;">--}}
{{--                                                        {{ csrf_field() }}--}}
{{--                                                    </form>--}}

                                                </td>
                                            </tr>
                                        @endforeach






                                            <tr class="popTop text-info" title="<p>Current Balance : </p>">
{{--                                                <td>--}}
{{--                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a--}}
{{--                                                            href="{{route('accounts.ledger.show')}}" style="text-decoration: none;"></a></td>--}}
{{--                                                <td>--}}
{{--                                                    <a href="{{route('accounts.ledger.edit')}}"--}}
{{--                                                       class="btn btn-xs btn-default" role="button">@lang('Edit')</a>--}}

{{--                                                        <a class="btn btn-xs btn-danger"--}}
{{--                                                           onclick="confirm_delete('')">@lang('Delete')</a>--}}
{{--                                                        <form id="delete_form_"--}}
{{--                                                              action="{{route('accounts.ledger.destroy'}}"--}}
{{--                                                              method="POST" style="display: none;">--}}
{{--                                                            {{ csrf_field() }}--}}
{{--                                                        </form>--}}

{{--                                                </td>--}}
                                            </tr>


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
