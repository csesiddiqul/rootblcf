@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.class').'">'. trans('Academics').'</a>  / <b>'. trans('Session').'<b>'])
                @include('components.sectionbar.session-bar',['sessions'=>$sessions])
                <div class="col-md-4 pl-0 pr-0">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @isset($session)
                                {!! Form::model($session, ['id' => 'committee_form','method' => 'PATCH','route' => ['academic.session.update', $session->id]]) !!}
                                @method('PUT')
                            @else
                                {!! Form::open(['route' => 'academic.session.store', 'method' => 'post','autocomplete'=>'off']) !!}
                            @endisset
                            @include('session.element')
                            <div class="col-md-6 pl-0">
                                <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                    @isset($session)  @lang('Update') @else @lang('Save') @endisset
                                </button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-8 pr-0">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @if (count($sessions)>0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">@lang('Session')</th>
                                            <th scope="col">@lang('Start Time')</th>
                                            <th scope="col">@lang('End Time')</th>
                                            <th scope="col">@lang('Status')</th>
                                            <th scope="col">@lang('Edit')</th>
                                            @if(serverIsLocal())
                                                <th scope="col">@lang('Delete')</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($sessions as $key=>$session)
                                            <tr>
                                                <th scope="row">{{  $key + 1 }}</th>
                                                <td><small> {{$session->schoolyear}}
                                                    </small>
                                                </td>
                                                <td><small>{{$session->starttime}}
                                                    </small>
                                                </td>
                                                <td><small>{{$session->endtime}}
                                                    </small>
                                                </td>
                                                <td><small> {{status($session->status)}}
                                                    </small>
                                                </td>
                                                <td>
                                                    <a class="btn btn-xs btn-default"
                                                       href="{{route('academic.session.edit',$session->id)}}">@lang('Edit')</a>
                                                </td>
                                                @if(serverIsLocal())
                                                    <td>
                                                        <a class="btn btn-xs btn-danger"
                                                           onclick="confirm_delete('{{$session->id}}')">@lang('Delete')</a>
                                                        <form id="delete_form_{{$session->id}}"
                                                              action="{{route('academic.session.destroy',$session->id)}}"
                                                              method="POST" style="display: none;">
                                                            {{ csrf_field() }}
                                                            @method('DELETE')
                                                        </form>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @push('styles')
                                    <style>
                                        #sessionSection {
                                            display: none
                                        }
                                    </style>
                                @endpush
                            @else
                                @lang('No Related Data Found.')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            function appendFunction() {
                var appendHtml = $("#sessionSection").html();
                $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
            }

            setTimeout(function () {
                appendFunction();
            }, 1000);
        })
    </script>
@endpush



