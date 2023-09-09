@extends('layouts.app')
@section('title', __('All GPA Systems'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('exams').'">'. trans('Exams').'</a>  / <b>'. trans('Grade System').'<b>'])
                @include('components.sectionbar.examination-bar')
                @php($gpaName = "")
                @php($count = 0)
                @foreach($gpas as $g)
                    @if ($g->grade_system_name != $gpaName)
                        @php($gpaName = $g->grade_system_name)
                        @php($count = 0)
                    @else
                        @continue
                    @endif
                    <div class="panel panel-default pt-0">
                        <div class="panel-body">
                            <h4 class="pt-0">{{$g->grade_system_name}}</h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Grade')</th>
                                        <th scope="col">@lang('Point')</th>
                                        <th scope="col">@lang('From Mark')</th>
                                        <th scope="col">@lang('To Mark')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        {{--<th scope="col">@lang('Delete')</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($gpas as $gpa)
                                        @if($gpa->grade_system_name != $gpaName)
                                            @continue
                                        @endif
                                        @php($count++)
                                        <tr>
                                            <td>{{$count}}</td>
                                            <td>{{$gpa->grade}}</td>
                                            <td>{{number_format($gpa->point,2)}}</td>
                                            <td>{{$gpa->from_mark}}</td>
                                            <td>{{$gpa->to_mark}}</td>
                                            <td><a href="{{route('gpa.edit',$gpa->id)}}"
                                                   class="btn btn-xs btn-info">@lang('Edit')</a></td>
                                            {{-- <td>
                                                <a class="btn btn-xs btn-danger"
                                                   onclick="confirm_delete('{{$gpa->id}}')">@lang('Delete')</a>

                                                <form id="delete_form_{{$gpa->id}}"
                                                      action="{{route('gpa.destroy',$gpa->id)}}"
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
                            @if ($gpaCount == ($loop->index))
                                @break
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
