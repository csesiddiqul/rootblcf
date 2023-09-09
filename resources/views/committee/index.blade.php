@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            @php $typename = ($type == 1 ? 'committee' : ($type == 2 ? 'member' : 'management')); @endphp
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('all_index',[Auth::user()->school->code,0,1]).'">'. trans('Human Resource').'</a> / <b>'. trans(ucfirst($typename)).'<b>'])
                @include('components.sectionbar.teacher-bar',['committee'=>$committee])
                <div class="panel panel-default">
                    <div class="panel-body" style="padding-top: 0px !important; ">
                        @if (count($committee)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Name')</th>
                                        <th scope="col">@lang('Email')</th>
                                        <th scope="col">@lang('Phone')</th>
                                        <th scope="col">@lang('Designations')</th>
                                        <th scope="col">@lang('Gender')</th>
                                        <th scope="col">@lang('Priority')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($committee as $key=>$com)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td>
                                                <a href="{{route('academic.committee.edit',$com->id)}}?type={{$type}}">
                                                    <small> {{$com->name}} </small>
                                                </a>
                                            </td>
                                            <td><small> {{$com->email}} </small></td>
                                            <td><small> {{$com->mobile}} </small></td>
                                            <td><small> {{designation($com->designation,true)}}</small></td>
                                            <td><small> {{gender($com->gender,true)}} </small></td>
                                            <td><small> {{$com->priority}} </small></td>
                                            <td><small> {{status($com->status)}} </small></td>
                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.committee.edit',$com->id)}}?type={{$type}}"><i class="fa fa-pencil"></i>
                                                </a>
                                                <a class="btn btn-xs btn-danger"
                                                   onclick="confirm_delete('{{$com->id}}')"><i class="fa fa-trash"></i></a>
                                                <form id="delete_form_{{$com->id}}"
                                                      action="{{route('academic.committee.destroy',$com->id)}}"
                                                      method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    @method('DELETE')
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @push('styles')
                                <style>
                                    #committeeSection {
                                        display: none
                                    }
                                </style>
                            @endpush
                            @push('script')
                                <script>
                                    $(document).ready(function () {
                                        function appendFunction() {
                                            var appendHtml = $("#committeeSection").html();
                                            $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
                                        }

                                        setTimeout(function () {
                                            appendFunction();
                                            $("#committeeSection").html('');
                                        }, 1000);
                                    })
                                </script>
                            @endpush
                        @else
                            <div class="panel-body">
                                @lang('No Related Data Found.')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<style type="text/css">
        .swal2-validation-message::after {
            content: 'Please, Write the reason!';
        }
    </style>--}}
    {{--@component('components.committee-export',['type'=>'committees'])
    @endcomponent--}}
@endsection
