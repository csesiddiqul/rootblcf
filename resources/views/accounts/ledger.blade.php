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
                @include('components.sectionbar.accounts-bar')
                <div class="col-md-4 pl-0">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form action="{{route('accounts.ledger.store')}}" method="post">
                                {{ csrf_field() }}
                                {{--  @isset($sector->type)
                                      <h3 class="pl-0 mt-0">@lang('Edit Sectors')</h3>
                                  @else
                                      <h3 class="pl-0 mt-0">@lang('Add Sectors')</h3>
                                  @endif--}}
                                <div class="clearhight"></div>
                                <div class="form-group">
                                    <label for="upload-title">@lang('Group Name'): </label>
                                    <input id="ac_group" type="text" class="form-control" name="ac_group"
                                           value="{{ (!empty($ledger->ac_group))?$ledger->ac_group:old('ac_group') }}">
                                    @error('ac_group')
                                    <span class="help-block help-cust">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="upload-title">@lang('Ledger Name'): </label>
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ (!empty($ledger->name))?$ledger->name:old('name') }}" required>
                                    @error('name')
                                    <span class="help-block help-cust">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                 @if(!isset($ledger))
                                <div class="form-group">
                                    <label for="current_balance">@lang('Current Balance'): </label>
                                    <input id="current_balance" type="number" class="form-control" name="current_balance" min="0"
                                           value="{{ (!empty($ledger->current_balance))?$ledger->current_balance:old('current_balance')  }}" >
                                    @error('current_balance')
                                    <span class="help-block help-cust">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @endif
                               <!--  <div class="form-group">
                                    <label for="current_balance">@lang('Current Balance'): </label>
                                    <input id="current_balance" type="number" class="form-control" name="current_balance" min="0"
                                           value="{{ (!empty($ledger->current_balance))?$ledger->current_balance:old('current_balance')  }}" >
                                    @error('current_balance')
                                    <span class="help-block help-cust">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> -->
                                <div class="form-group">
                                    <label for="description">@lang('Description')</label>
                                    <textarea name="description" id="description" class="form-control" cols="10"
                                              rows="3">{{ (!empty($ledger->description))?$ledger->description:old('description') }}</textarea>
                                    @error('description')
                                    <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6" style="margin-left: -15px">
                                    <button type="submit" id="registerBtn"
                                            class="{{btnClass()}}">
                                        @isset($ledger->name)
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
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>@lang('Ledger Name')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($ledgers as $key => $value)
                                        @if(!empty($key))
                                            <tr>
                                                <td colspan="2"><b>{{$key}}</b></td>
                                            </tr>
                                        @endif
                                        @foreach ($value->sortBy('name') as $ledger)
                                            <tr class="popTop text-info" title="<p>Current Balance : {{number_format($ledger->current_balance,2)}}</p>">
                                                <td>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
                                                            href="{{route('accounts.ledger.show',$ledger->id)}}" style="text-decoration: none;">{{$ledger->name}}</a></td>
                                                <td>
                                                    <a href="{{route('accounts.ledger.edit',$ledger->id)}}"
                                                       class="btn btn-xs btn-default" role="button">@lang('Edit')</a>
                                                    @if(serverIsLocal())
                                                        <a class="btn btn-xs btn-danger"
                                                           onclick="confirm_delete('{{$ledger->id}}')">@lang('Delete')</a>
                                                        <form id="delete_form_{{$ledger->id}}"
                                                              action="{{route('accounts.ledger.destroy',$ledger->id)}}"
                                                              method="POST" style="display: none;">
                                                            {{ csrf_field() }}
                                                        </form>
                                                    @endif
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
