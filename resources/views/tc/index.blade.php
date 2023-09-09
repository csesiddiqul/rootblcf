@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.certificate.create').'">'. trans('Certificate').'</a> / <b>'.trans('TC').'<b>'])
                @include('components.sectionbar.certificate-bar')
                <div class="panel panel-default">
                    <div class="panel-body" style="padding-top: 0px !important;">
                        @if (count($tcs)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Code')</th>
                                        <th scope="col">@lang('Student Name')</th>
                                        <th scope="col">@lang('Date')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        <th scope="col">@lang('Delete')</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($tcs as $key=>$tc)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td><small> {{$tc->student->student_code}}
                                                </small>
                                            </td>
                                            <td>
                                            <a style="cursor: pointer;" target="_blank" href="{{route('academic.tc.show',[$tc->id,renderSlug($tc->student->name)])}}"class="view_data" title="">{{$tc->student->name}}
                                            </a>
                                             
                                            </td>
                                            <td><small> {{date('Y-m-d',strtotime($tc->date))}}
                                                </small>
                                            </td>

                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.tc.edit',$tc->id)}}">@lang('Edit')</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-danger"
                                                   onclick="confirm_delete('{{$tc->id}}')">@lang('Delete')</a>

                                                <form id="delete_form_{{$tc->id}}"
                                                      action="{{route('academic.tc.destroy',$tc->id)}}"
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
                                    #houseSection {
                                        display: none
                                    }
                                </style>
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
@endsection