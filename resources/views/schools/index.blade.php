@extends('layouts.app')

@section('title', __('Manage Schools'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.master-left-menu')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default pt-0 ">
                    @include('schools.form')
                    <div class="panel-body p-0 table-responsive">
                        <table class="table table-data-div table-condensed">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Code')</th>
                                <th scope="col">@lang('SMS')</th>
                                <th scope="col">@lang('Edit')</th>
                                <th scope="col">@lang('Payments')</th>
                                <th scope="col">+@lang('Admins')</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($schools as $key=>$school)
                                <tr>
                                    <td>{{($key + 1)}}</td>
                                    <td>
                                        @if(isset($school->letsEncript->domain))
                                            <a href="{{'https://'.$school->letsEncript->domain}}"
                                               target="_blank"><small>{{$school->name.' ('.$school->short_name.')'}}</small></a>
                                        @else
                                            <small>{{$school->name.' ('.$school->short_name.')'}}</small>
                                        @endif
                                    </td>
                                    <td><small>{{$school->code}}</small></td>
                                    <td><small>{{$school->sms_count}}</small></td>
                                    <td>
                                        <a class="btn btn-info btn-xs btn-block" role="button"
                                           href="{{ route('schools.edit', $school) }}" dusk="edit-school-link">
                                            <small>@lang('Edit')</small>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning btn-xs btn-block" role="button"
                                           href="{{route('school.payments.indexlist',$school->code)}}">
                                            <small>@lang('Payment')</small>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger btn-xs btn-block" role="button"
                                           href="{{url('register/admin/'.$school->id.'/'.$school->code)}}">
                                            <small>+ @lang('Create')</small>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-success btn-xs btn-block" role="button"
                                           href="{{route('school.show',$school->code)}}">
                                            <small>@lang('View')</small>
                                        </a>
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
@endsection
