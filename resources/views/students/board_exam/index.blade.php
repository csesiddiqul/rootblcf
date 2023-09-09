@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/1/0').'">'. trans('Students').'</a> / <b>'. trans('Board Exam').'<b>'])
                @include('components.sectionbar.student_board_exam',['board_exams'=>$board_exams])
                <div class="panel panel-default">
                    <div class="panel-body" style="padding-top: 0px !important;">
                        @if (count($board_exams)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Student Id')</th>
                                        <th scope="col">@lang('Student Name')</th>
                                        <th scope="col">@lang('Group')</th>
                                        <th scope="col">@lang('Exam Name')</th>
                                        <th scope="col">@lang('Roll')</th>
                                        <th scope="col">@lang('Registration')</th>
                                        <th scope="col">@lang('Session')</th>
                                        <th scope="col">@lang('Passing Year')</th>
                                        <th scope="col">@lang('Gpa')</th>
                                        <th scope="col">@lang('Out of GPA')</th>
                                        <th scope="col">@lang('Board')</th>
                                        <th scope="col">@lang('Action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($board_exams as $key=>$item)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td><small> {{$item->student->student_code}}</small></td>
                                            <td><small> {{$item->student->name}}</small></td>
                                            <td><small> {{$item->group}}</small></td>
                                            <td><small> {{$item->exam_name}}</small></td>
                                            <td><small> {{$item->roll}}</small></td>
                                            <td><small> {{$item->registration}}</small></td>
                                            <td><small> {{$item->session}}</small></td>
                                            <td><small> {{$item->passing_year}}</small></td>
                                            <td><small> {{number_format($item->gpa,2)}}</small></td>
                                            <td><small> {{number_format($item->out_of_gpa,2)}}</small></td>
                                            <td><small> {{$item->board}}</small></td>
                                            <td>
                                                <a class="btn btn-xs btn-default pull-left"
                                                   href="{{route('academic.board_exam.edit',$item->id)}}">@lang('Edit')</a>
                                                <a class="btn btn-xs btn-danger pull-right"
                                                   onclick="confirm_delete('{{$item->id}}')">@lang('Delete')</a>

                                                <form id="delete_form_{{$item->id}}"
                                                      action="{{route('academic.board_exam.destroy',$item->id)}}"
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
@push('script')
    <script>
        $(document).ready(function () {
            function appendFunction() {
                var appendHtml = $("#houseSection").html();
                $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
            }
            setTimeout(function () {
                appendFunction();
            }, 1000);
        })
    </script>
@endpush


