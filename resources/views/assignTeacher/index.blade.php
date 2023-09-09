@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.class').'">'. trans('Academics').'</a>  / <b>'. trans('Assign Teacher').'<b>'])
                @include('components.sectionbar.course-bar',['cloneAssignTeacher'=>true])

                <div class="col-md-4 pl-0  pr-0">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @include('assignTeacher.create')
                        </div>
                    </div>
                </div>
                <div class="col-md-8 pr-0">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @if (count($results)>0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">@lang('Course')</th>
                                            <th scope="col">@lang('Section')</th>
                                            <th scope="col">@lang('Teacher')</th>
                                            <th scope="col">@lang('Exam')</th>
                                            <th scope="col">@lang('Grade System')</th>
                                            <th scope="col">@lang('Action')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($results as $result)
                                            <tr>
                                                <th scope="row">{{  $loop->index + 1 }}</th>
                                                <td><small>{{$result->course['name']}}</small>
                                                </td>
                                                <td>
                                                    {{$result->class['name'].' - '.$result->section['section_number']}}
                                                </td>
                                                <td><small> {{$result->teacher['name']}}
                                                    </small>
                                                </td>
                                                <td>{{$result->exam['exam_name']}}
                                                </td>
                                                <td><small> {{$result->grade_system_name}}
                                                    </small>
                                                </td>
                                                <td>
                                                    <a class="btn btn-xs  btn-info"
                                                       href="{{route('academic.course_config.edit',$result->id)}}"><i
                                                                class="fa fa-pencil"></i></a>
                                                    <a class="btn btn-xs btn-danger"
                                                       onclick="confirm_delete('{{$result->id}}')"><i
                                                                class="fa fa-trash"></i></a>

                                                    <form id="delete_form_{{$result->id}}"
                                                          action="{{route('academic.course_config.destroy',$result->id)}}"
                                                          method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @push('script')
                                    <script>
                                        $.extend(true, $.fn.dataTable.defaults, {
                                            "bFilter": true,
                                            initComplete: function () {
                                                this.api().column(2).every(function () {
                                                    var column = this;
                                                    var select = $('<select><option value="">{{transMsg('Section')}}</option></select>')
                                                        .appendTo($(column.header()).empty())
                                                        .on('change', function () {
                                                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                                                        });
                                                    column.data().unique().sort().each(function (d, j) {
                                                        select.append('<option value="' + d + '">' + d + '</option>')
                                                    });
                                                });
                                                this.api().column(4).every(function () {
                                                    var column = this;
                                                    var select = $('<select><option value="">{{transMsg('Exam')}}</option></select>')
                                                        .appendTo($(column.header()).empty())
                                                        .on('change', function () {
                                                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                                                        });
                                                    column.data().unique().sort().each(function (d, j) {
                                                        select.append('<option value="' + d + '">' + d + '</option>')
                                                    });
                                                });
                                            },
                                        });
                                    </script>
                                @endpush
                                @push('styles')
                                    <style>
                                        @media (min-width: 576px) {
                                            .modal-dialog-centered {
                                                min-height: calc(100% - (1.75rem * 2));
                                            }
                                        }

                                        .modal-dialog-centered {
                                            display: -webkit-box;
                                            display: -ms-flexbox;
                                            display: flex;
                                            -webkit-box-align: center;
                                            -ms-flex-align: center;
                                            align-items: center;
                                            min-height: calc(100% - (0.5rem * 2));
                                        }
                                        .error{color: red}
                                    </style>
                                @endpush
                                @push('modalAppend')
                                <!-- Modal -->
                                    <div class="modal fade" id="cloneAssignTeacher" tabindex="-1" role="dialog"
                                         aria-labelledby="cloneAssignTeacherTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title pull-left"
                                                        id="cloneAssignTeacherTitle">@lang('Clone Assigned Teacher')</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <code>@lang('N:B: If your all assign teachers matches the previous exam, then just select the new exam and get the previous assign teachers in the new exam.')</code>
                                                    <form method="POST" action="javascript:void(0)" accept-charset="UTF-8" id="cloneAtForm">
                                                        @php $exam = (new App\Exam())->getExam(false, true); @endphp
                                                        <div class="form-group{{ $errors->has('previous_exam') ? ' has-error' : '' }}">
                                                            {!! Form::label('previous_exam', trans('Previous Exam'), ['class' => 'control-label']) !!}
                                                            {!! Form::select('previous_exam',$exam, null, array('required', 'class' => ' form-control', 'placeholder' => trans('Choose'))) !!}
                                                        </div>
                                                        <div class="form-group{{ $errors->has('new_exam') ? ' has-error' : '' }}">
                                                            {!! Form::label('new_exam', trans('Select New Exam'), ['class' => 'control-label']) !!}
                                                            {!! Form::select('new_exam',$exam, null, array('required', 'class' => ' form-control', 'placeholder' => trans('Choose'))) !!}
                                                        </div>
                                                        <div class="col-md-2 pl-0">
                                                            <button type="submit" class="{{btnClass()}}">@lang('Clone')</button>
                                                        </div>
                                                    </form>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="col-md-2 pull-right">
                                                        <button type="button" class="btn btn-default btn-block btn-sm"
                                                                data-dismiss="modal">@lang('Close')
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
    </div>
    <script src="{{asset('additional/jquery-validate/jquery.validate.min.js')}}"></script>
@endsection