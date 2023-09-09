@extends('layouts.app') 
@section('title', __('Master Dashboard')) 
@section('content')  
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
                        <a id="topback" href="{{route('agent.profile',Request::route('code'))}}" class="">@lang('Agents')</a> / 
                    @endif
                    @lang('Schools') 
                </div>
                <div class="panel-body">
                    <div class="clearhight"></div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-data-div table-condensed table-striped table-hover" style="margin-top: 10px !important; ">
                            <thead>
                            <tr>
                                <th scope="col">#</th> 
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Email')</th>
                                <th scope="col">@lang('Phone')</th>
                                <th scope="col">@lang('Location')</th>
                                <th scope="col">@lang('Created')</th>
                                <th scope="col">@lang('Status')</th>  
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($schools)>0)
                                @foreach ($schools as $key=>$school)
                                    @if($school->country->code=='BD')
                                        @php($format = 'd-m-Y h:i A')
                                    @else
                                        @php($format = 'm-d-Y H:i')
                                    @endif
                                <tr> 
                                    <th scope="row">{{ $key + 1 }}</th> 
                                    <td><a href="{{route('school.payments.indexlist',$school->code)}}" class="href"><code>{{ $school->name.'('.$school->short_name.')' }}</code></a></td>
                                    <td>{{ $school->setting->email }}</td>  
                                    <td><small> {{$school->setting->phone ?? $school->setting->telephone}}</td>
                                    <td> 
                                        @if($school->country->code=='BD')
                                            {{ getDistrictName($school->district_id) }}
                                        @elseif($school->country->code=='US')
                                            {{getStateName($school->state_id)}}
                                        @else
                                            {{$school->city}}
                                        @endif
                                    </td>
                                    <td>{{ date($format,strtotime($school->created_at)) }}</td>
                                    <td> 
                                        <small>
                                            {!! $school->status == 1 ? '<span class="btn btn-xs allButton btn-block">'.trans('Active: ').date($format,strtotime($school->activeTill)).'</span>':'<span class="btn btn-xs btn-danger btn-block">' .trans('Inactive').'</span>' !!}
                                        </small>
                                    </td>  
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="6" class="text-center text-danger">@lang('No Related Data Found.')</td>
                                    <td>&nbsp;</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>  
@endsection
