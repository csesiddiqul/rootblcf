@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <b>'.trans('Important Link').'<b>'])
                @include('components.sectionbar.frontmanagement-bar',['importantLinks'=>$importantLinks])
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if (count($importantLinks)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Link')</th>
                                        <th scope="col">@lang('Name')</th>
                                        <th scope="col">@lang('Priority')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        <th scope="col">@lang('Delete')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($importantLinks as $key=>$importantLink)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td><small> {{$importantLink->link}}
                                                </small>
                                            </td>
                                            <td><small>{{$importantLink->name}} 
                                                </small>
                                            </td>
                                            <td><small>{{$importantLink->parioty}} 
                                                </small>
                                            </td>  
                                            <td><small> {{status($importantLink->status)}}
                                                </small>
                                            </td>

                                                <td>
                                                    <a class="btn btn-xs btn-default" href="{{route('academic.importantLink.edit',$importantLink->id)}}">@lang('Edit')</a>
                                                </td>
                                              <td>
                                                <a class="btn btn-xs btn-danger"
                                                   onclick="confirm_delete('{{$importantLink->id}}')">@lang('Delete')</a>

                                                <form id="delete_form_{{$importantLink->id}}"
                                                      action="{{route('academic.importantLink.destroy',$importantLink->id)}}"
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
                                    #importantLinkSection {
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

