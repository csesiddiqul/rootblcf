@extends('layouts.app')
@section('title', __('Students Info'))
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')
    @component('components.cropper.editelement',['width'=>'270','height'=>'270','type'=>'squre','table_name'=>'users','table_id'=>$agent->id,'table_field'=>'pic_path']) @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @if(Auth::user()->role == 'master')
                    @include('layouts.master-left-menu')
                @elseif(Auth::user()->role == 'agent')
                    @include('layouts.agent-left-menu')
                @endif
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default pt-0">
                    <div class="panel-heading">
                        @if(Auth::user()->role == 'master')
                            @if(str_replace(url('/'),'',url()->previous())=='/schoolpayments')
                                <a id="topback" href="{{route('schoolpayments.index')}}" class="">@lang('Payment Received')</a> / Agent
                            @else
                                <a id="topback" href="{{route('agents.index')}}" class="">@lang('Agents')</a> /
                            @endif
                        @endif
                        @lang('Profile')
                    </div>
                    <div class="panel-body content">
                        <div class="row">
                            <div class="col-md-3 pl-5">
                                <div class="box box-primary">
                                    <div class="box-body box-profile">
                                        @if(!empty($agent->pic_path))
                                            <img src="{{asset('img/proloading.gif')}}" data-src="{{url($agent->pic_path)}}"
                                                 class="profile-user-img img-circle img-responsive img-thumbnail"
                                                 id="my-profile" alt="Profile Picture" width="100%">
                                            @if(\Auth::user()->id == $agent->id)
                                            <div class="btn-group removeUpImage"
                                                 onclick="img_confirm_delete('users','{{$agent->id}}','pic_path','your Profile Photo')">
                                                <span class="btn btn-info btn-sm">Remove</span>
                                                <span class="btn btn-danger btn-sm">&times;</span>
                                            </div>
                                            @else
                                                <div class="clearhight"></div>
                                            @endif
                                        @else
                                            @if(\Auth::user()->id == $agent->id)
                                                <div class="image-upload">
                                                    <label for="file-upload">
                                                        <img src="{{asset('img/profile.png')}}" id="preview_image"
                                                             class="profile-user-img img-circle img-responsive">
                                                    </label>
                                                    <input type="file" value="" class="file-upload" id="file-upload"
                                                           accept="image/*">
                                                </div>
                                                <div style="clear:both;"></div>
                                            @else
                                                <img src="{{asset('img/proloading.gif')}}"
                                                 class="profile-user-img img-circle img-responsive img-thumbnail" alt="Profile Picture" width="100%">
                                            @endif
                                        @endif

                                        <h3 class="profile-username text-center">{{$agent->name}}</h3>

                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item listnoback text-center">
                                                <b class="">{{$agent->email}}</b>
                                            </li>
                                            <li class="list-group-item listnoback">
                                                <b>@lang('Agent No.')</b>
                                                <code class="pull-right">{{$agent->student_code}}</code>
                                            </li>
                                            <li class="list-group-item listnoback">
                                                <b>@lang('Phone No.')</b>
                                                <code class="pull-right">{{$agent->phone_number}}</code>
                                            </li>
                                            <li class="list-group-item listnoback">
                                                <b>@lang('Share(%)')</b>
                                                <code class="pull-right">{{$agent->agent->shareOf}}%</code>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="nav-tabs-custom theme-shadow">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#activity" data-toggle="tab" aria-expanded="false">@lang('Profile Details')</a>
                                        </li>
                                        @if(\Auth::user()->id == $agent->id)
                                            <li class="pull-right">
                                                <a href="{{url('user/config/change_password')}}"
                                                   class="schedule_modal text-green" data-toggle="tooltip"
                                                   data-placement="bottom" title="Change Password"><i class="fa fa-key"></i>
                                                </a>
                                            </li>
                                            <li class="pull-right">
                                                <a href="{{route('agent.profile.edit')}}" data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="fa fa-pencil"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ route('agent.unpaid',$agent->student_code) }}" class="right_a">@lang('Agent Payments')</a>
                                            </li>
                                            <li class="pull-right">
                                                <a href="{{ route('agent.index',$agent->student_code) }}" class="right_a">Payments</a>
                                            </li>
                                            <li class="pull-right">
                                                <a href="{{ route('agent.school.list',$agent->student_code) }}" class="right_a">Schools</a>
                                            </li>
                                        @endif
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="activity">
                                            <div class="tshadow mb25 bozero">
                                                <div class="table-responsive around10 pt0">
                                                    <table class="table table-hover table-striped tmb0">
                                                        <tbody>
                                                        <tr>
                                                            <td class="col-md-4">@lang('Nationality')</td>
                                                            <td class="col-md-8">{{ucfirst($agent->nationality)}}</td>
                                                        </tr>
                                                        @if($agent->nationality=='Bangladesh')
                                                        <tr>
                                                            <td class="col-md-4">@lang('Division')</td>
                                                            <td class="col-md-8">
                                                                {{getDivisionByDistrict($agent->agent->district_id)['name'] ??''}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-4">@lang('District')</td>
                                                            <td class="col-md-8">
                                                                {{getDistrictName($agent->agent->district_id)??''}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-4">@lang('NID Number')</td>
                                                            <td class="col-md-8">{{$agent->agent->nid}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-4">@lang('Picture of NID')</td>
                                                            <td class="col-md-8"><button type="button" data-toggle="modal" data-target="#imageShowFrame" class="btn btn-xs btn-warning">View</button>
                                                            </td>
                                                        </tr>
                                                        @elseif($agent->nationality=='United States')
                                                        <tr>
                                                            <td class="col-md-4">@lang('State')</td>
                                                            <td class="col-md-8">
                                                                {{getStateName($agent->agent->state_id)}}
                                                            </td>
                                                        </tr>
                                                        @else
                                                        <tr>
                                                            <td>@lang('City')</td>
                                                            <td>
                                                                {!!nl2br($agent->agent->city)!!}
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        <tr>
                                                            <td>@lang('Address')</td>
                                                            <td>
                                                                {!!nl2br($agent->address)!!}
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tshadow mb25 bozero">
                                                <h3 class="pagetitleh2">@lang('Bank Information') </h3>
                                                <div class="table-responsive around10 pt0">
                                                    <table class="table table-hover table-striped tmb0">
                                                        <tbody>
                                                        <tr>
                                                            <td class="col-md-4">
                                                                @lang('Bank Name')
                                                            </td>
                                                            <td class="col-md-8">
                                                                {!! $agent->agent->bank_name !!}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-4">
                                                                @lang('Ledger Name')
                                                            </td>
                                                            <td class="col-md-8">
                                                                {!! $agent->agent->ac_name !!}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-4">
                                                                @lang('Ledger Number')
                                                            </td>
                                                            <td class="col-md-8">
                                                                {!! $agent->agent->ac_number !!}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-4">
                                                                @lang('Branch Name')
                                                            </td>
                                                            <td class="col-md-8">
                                                                {!! $agent->agent->ac_branch !!}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-4">
                                                                @lang('Routing Number')
                                                            </td>
                                                            <td class="col-md-8">
                                                                {!! $agent->agent->ac_routing !!}
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tshadow mb25  bozero">
                                                <h3 class="pagetitleh2">@lang('About')</h3>
                                                <div class="table-responsive around10 pt0">
                                                    <table class="table table-hover table-striped tmb0">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    @if(!empty($agent->about))
                                                                        {{$agent->about}}
                                                                    @else
                                                                        ---
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="fee">
                                            Tab A
                                        </div>
                                        <div class="tab-pane" id="documents">
                                            Tab B
                                        </div>
                                        <div class="tab-pane" id="timelineh">
                                            Tab C
                                        </div>
                                        <div class="tab-pane" id="exam">
                                            Tab D
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @component('components.modal.element',['title'=>'Picture of NID','url'=>$agent->agent->nid_url])
    @endcomponent
@endsection
@push('styles')
    <style>
        .popover.fade {
            width: 100% !important;
        }
    </style>
@endpush
