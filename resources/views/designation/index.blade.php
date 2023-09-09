@extends('layouts.app')

@section('title', __('Department'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.class').'">'. trans('Academics').'</a>  / <b>'. trans('Designation').'<b>'])
                @include('components.sectionbar.teacher-bar',['designations'=>$designations])
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if ($designations->count())
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
                                    @foreach($designations as $designation)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>
                                                <small>{{transMsg($designation->name)}}</small>
                                             </td>
                                            <td>
                                                <small>
                                                    <span class="label label-{{$designation->status ==1 ? 'success' : 'danger'}}">{{status($designation->status)}}</span>
                                                </small>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.designation.edit',$designation->id)}}">@lang('Edit')</a>
                                            </td>
                                             {{-- <td>
                                                 <a class="btn btn-xs btn-danger"
                                                    onclick="confirm_delete('{{$designation->id}}')">@lang('Delete')</a>

                                                 <form id="delete_form_{{$designation->id}}"
                                                       action="{{route('academic.designation.destroy',$designation->id)}}"
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