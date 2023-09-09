@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.branch.index').'">'. trans('Branch').'</a> /  <b>'. trans('List').'<b>'])
                @include('components.sectionbar.branch',['branchs'=>$branchs])
                <div class="panel panel-default">
                    <div class="panel-body" style="padding-top: 0px !important; ">
                        @if (count($branchs)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Name')</th>
                                        <th scope="col">@lang('Short Name')</th>
                                        <th scope="col">@lang('Code')</th>
                                        <th scope="col">@lang('Established')</th>
                                        <th scope="col">@lang('Address')</th>
                                        @if(Auth::user()->role == 'admin')
                                            <th scope="col">@lang('Edit')</th>
                                            <th scope="col">@lang('Delete')</th>
                                            <th scope="col">+@lang('Admin')</th>
                                            <th scope="col">@lang('View Admins')</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($branchs as $key=>$branch)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td><small>
                                                    {{$branch->name}}
                                                </small>
                                            </td>
                                            <td>
                                                <small>
                                                    {{$branch->short_name}}
                                                </small>
                                            </td>
                                            <td>
                                                <small>
                                                    {{$branch->branch_code}}
                                                </small>
                                            </td>
                                            <td>
                                                <small>
                                                    {{$branch->established}}
                                                </small>
                                            </td>
                                            <td>
                                                <small>
                                                    {{$branch->address}}
                                                </small>
                                            </td>
                                            @if(Auth::user()->role == 'admin')
                                                <td>
                                                    <a class="btn btn-xs btn-default"
                                                       href="{{route('academic.branch.edit',$branch->code)}}">@lang('Edit')</a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger"
                                                       onclick="confirm_delete('{{$branch->code}}')"
                                                       href="javascript:void(0)">@lang('Delete')</a>

                                                    <form id="delete_form_{{$branch->code}}"
                                                          action="{{route('academic.branch.destroy',$branch->code)}}"
                                                          method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                                <td>
                                                    <a class="btn btn-danger btn-xs" role="button"
                                                       href="{{route('branch.admin.create',['id'=>$branch->id,'code'=>$branch->code])}}">
                                                        <small>+ @lang('Create Admin')</small>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-success btn-xs" role="button"
                                                       href="{{route('school.show',$branch->code)}}">
                                                        <small>@lang('View Admins')</small>
                                                    </a>
                                                </td>
                                            @endif
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