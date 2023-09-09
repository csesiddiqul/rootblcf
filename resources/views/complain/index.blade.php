@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.contact.index').'">'. trans('Communicate').'</a>  / <b>'. trans('Feedback').'<b>'])
                @include('components.sectionbar.communicate-bar')
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if (count($complains)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Name')</th>
                                        <th scope="col">@lang('Contact Number')</th>
                                        <th scope="col">@lang('Email')</th>
                                        <th scope="col">@lang('Description')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        <th scope="col">@lang('Delete')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($complains as $key=>$complain)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td><small> {{$complain->name}}
                                                </small>
                                            </td>
                                            
                                            <td><small> {!! $complain->contactnumber !!}
                                                </small>
                                            </td>
                                            <td><small> {!! $complain->email !!}
                                                </small>
                                            </td>
                                           
                                            <td><small> {{\Illuminate\Support\Str::limit($complain->description,50)}}
                                                </small><a href="{{route('academic.complain.show',$complain->id)}}">readmore</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.complain.edit',$complain->id)}}">@lang('Edit')</a>
                                            </td>
 
                                            <td>
                                                <a class="btn btn-xs btn-danger"
                                                   onclick="confirm_delete('{{$complain->id}}')">@lang('Delete')</a>

                                                <form id="delete_form_{{$complain->id}}"
                                                      action="{{route('academic.complain.destroy',$complain->id)}}"
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

