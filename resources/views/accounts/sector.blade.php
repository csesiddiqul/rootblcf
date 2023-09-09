@extends('layouts.app')
@section('title', __('Ledger Sectors'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @if(\Request::url() == url('accounts/sectors'))
                    @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Account Head').'<b>'])
                @else
                    @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Edit Account Head').'<b>'])
                @endif
                @include('components.sectionbar.accounts-bar')
                <div class="col-md-4 pl-0">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form action="{{ $postUrl }}" method="post">
                                {{ csrf_field() }}
                                {{--  @isset($sector->type)
                                      <h3 class="pl-0 mt-0">@lang('Edit Sectors')</h3>
                                  @else
                                      <h3 class="pl-0 mt-0">@lang('Add Sectors')</h3>
                                  @endif--}}
                                <div class="clearhight"></div>
                                <div class="form-group">
                                    <label for="upload-title">@lang('Account Head Name'): </label>
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ (!empty($sector->name))?$sector->name:old('name') }}" required>
                                    @error('name')
                                    <span class="help-block help-cust">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sections">@lang('Type')</label>
                                    <select class="form-control" name="type">
                                        <option value="income" {{isset($sector->type) ? ($sector->type == 'income'? 'selected' : ''):''}}>@lang('Income')</option>
                                        <option value="expense" {{isset($sector->type) ? ($sector->type == 'expense'? 'selected' : ''):''}} >@lang('Expense')</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                @isset($sector->type)
                                    @method('PATCH')
                                @else
                                    <div class="form-group">
                                        <label for="opening_balance">@lang('Opening Balance')</label>
                                        <input type="number" name="op_balance" class="form-control" min="0" value="0">
                                        @error('opening_balance')
                                        <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="ledger_id">@lang('Ledger')</label>
                                        <select class="form-control" id="ledger_id" required name="ledger_id">
                                            <option value="" selected>@lang('Choose')</option>
                                            @foreach ($ledgers as $key => $value)
                                                <optgroup label="{{$key}}">
                                                    @foreach ($value->sortBy('name') as $ledger)
                                                        <option value="{{$ledger->id}}">{{$ledger->name}}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                        @error('ledger_id')
                                        <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                @endisset
                                <div class="col-md-6" style="margin-left: -15px">
                                    <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                        @isset($sector->type)
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
                                        <th>@lang('Si')</th>
                                        <th>@lang('Account Head Name')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($sectors as $key => $value)
                                        @if(!empty($key))
                                            <tr>
                                                <td></td>
                                                <td colspan="2"><b>{{ucfirst($key)}}</b></td>
                                            </tr>
                                        @endif
                                        @foreach ($value->sortBy('name') as $sector)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                                                            href="{{route('accounts.sectors.show',$sector->id)}}" style="text-decoration: none;">{{$sector->name}}</a></td>
                                                <td>
                                                    <a href="{{url('accounts/edit-sector/'.$sector->id)}}"
                                                       class="btn btn-xs btn-default" role="button">@lang('Edit')</a>
                                                </td>
                                            </tr>
                                        @endforeach
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
    @push('script-no')
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
            $.extend(true, $.fn.dataTable.defaults, {
                "bFilter": true,
                initComplete: function () {
                    this.api().column(1).every(function () {
                        var column = this;
                        var select = $('<select><option value="">@lang('Type')</option></select>')
                            .appendTo($(column.header()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });
                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    });
                },
            });
        </script>
    @endpush
@endsection
