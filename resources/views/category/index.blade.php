@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/1/0').'">'. trans('Students').'</a> / <b>'.trans('Student ').(school('country')->code == 'SG' ? 'Race' : 'Categories').'<b>'])
                @include('components.sectionbar.category-bar',['categories'=>$categories])
                <div class="panel panel-default">
                    <div class="panel-body" style="padding-top: 0px !important;">
                        @if (count($categories)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover"
                                       style="margin-top: 10px !important;">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Name')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        <th scope="col">@lang('Delete')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($categories as $key=>$category)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td>
                                                <a href="{{route('academic.category.show',$category->id)}}"><small> {{$category->name}}
                                                    </small></a>
                                            </td>
                                            <td><small> {{status($category->status)}}
                                                </small>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.category.edit',$category->id)}}">@lang('Edit')</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-danger"
                                                   onclick="confirm_delete('{{$category->id}}')">@lang('Delete')</a>
                                                <form id="delete_form_{{$category->id}}"
                                                      action="{{route('academic.category.destroy',$category->id)}}"
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


