@extends('layouts.app')

@section('title', __('Department'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.class').'">'. trans('Academics').'</a>  / <b>'. trans('Department').'<b>'])
                @include('components.sectionbar.course-bar',['departments'=>$departments])
                <div class="panel panel-default">
                    <div class="panel-title">
                    </div>
                    <div class="panel-body">
                        @if ($departments->count())
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Name')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        {{--<th scope="col">@lang('Delete')</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($departments as $department)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>
                                                <small>{{$department->department_name}}</small>
                                             </td>
                                            <td>
                                                <small>
                                                    <span class="label label-{{$department->status ==1 ? 'success' : 'danger'}}">{{status($department->status)}}</span>
                                                </small>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.department.edit',$department->id)}}">@lang('Edit')</a>
                                            </td>
                                             {{-- <td>
                                                 <a class="btn btn-xs btn-danger"
                                                    onclick="confirm_delete('{{$department->id}}')">@lang('Delete')</a>

                                                 <form id="delete_form_{{$department->id}}"
                                                       action="{{route('academic.department.destroy',$department->id)}}"
                                                       method="POST" style="display: none;">
                                                     {{ csrf_field() }}
                                                     @method('DELETE')
                                                 </form>
                                             </td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            @lang('No Related Data Found.')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection