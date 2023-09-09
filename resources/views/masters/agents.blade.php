@extends('layouts.app') 
@section('title', __('Master Dashboard')) 
@section('content')  
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.master-left-menu') 
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default col-sm-12"> 
                <div class="panel-body p-0"> 
                    @include('masters.agent-menu') 
                    <div class="table-responsive">
                        <table class="table table-bordered table-data-div table-condensed table-striped table-hover" style="margin-top: 10px !important; ">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">@lang('Agent Number')</th>
                                <th scope="col">@lang('Name')</th>
                                <th scope="col">@lang('Email')</th>
                                <th scope="col">@lang('Phone')</th>
                                <th scope="col">@lang('Country')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($agents)>0)
                                @foreach ($agents as $key=>$agent)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th> 
                                    <td><code>{{ $agent->student_code }}</code></td>
                                    <td>
                                        <a class="a-href" href="{{route('agent.profile',$agent->student_code)}}">{{ $agent->name }}</a>
                                    </td>  
                                    <td>{{ $agent->email }}</td>
                                    <td>{{ $agent->phone_number }}</td>
                                    <td>{{ $agent->nationality }}</td>
                                    <td>
                                        <small @if(Auth::user()->role == 'master') onclick="activeInactiveUser({{$agent->id.','.$agent->active}})" @endif>
                                            {!! $agent->active == 1 ? '<span class="btn btn-xs allButton btn-block">Active</span>' : ($agent->active == 2 ? '<span class="btn btn-xs btn-warning btn-block"> Pending</span>':'<span class="btn btn-xs btn-danger btn-block"> Inactive</span>') !!}
                                        </small>
                                    </td> 
                                    <td>
                                        <a class="btn btn-xs btn-warning" href="{{route('agent.edit',$agent->student_code)}}">@lang(' Edit ')</a>
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
@push('script')
    <script>
        $(document).ready(function () {
            function appendFunction() { 
                $(".table-responsive div.row:first-child div.col-sm-6:first-child").html('<h5>Agents List</h5>');
            } 
            setTimeout(function () {
                appendFunction();
                $("#EventSection").html('');
            }, 1000);
        })
    </script>
@endpush
@endsection
