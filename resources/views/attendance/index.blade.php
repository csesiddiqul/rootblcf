@extends('layouts.app')

@section('title', __('Attendance'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('attendance.index',auth()->user()->school->code).'">'. trans('Attendance').'</a>  / <b>'. trans('Take Attendances').'<b>'])
                @include('components.sectionbar.attendance')
                <div class="panel panel-default">
                    <div class="panel-body pad-top-0">
                        {!! Form::open(['method' => 'post','autocomplete'=>'off']) !!}
                        <div class="form-group pl-0 col-md-3 {{ $errors->has('section') ? ' has-error' : '' }}" id="atn-15">
                            {!! Form::label('section', trans('Section'), ['class' => 'control-label']) !!}
                            {!! Form::select('section', $pluckSection , $section?? null , ['class' => 'select2 form-control','required','placeholder'=>'Choose']) !!}
                            @error('section')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3 {{ $errors->has('exam') ? ' has-error' : '' }}" id="atn-15">
                            {!! Form::label('exam', trans('Exam'), ['class' => 'control-label']) !!}
                            {!! Form::select('exam', $pluckExam , $exam?? null , ['class' => 'select2 form-control','required','placeholder'=>'Choose']) !!}
                            @error('exam')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3 {{ $errors->has('date') ? ' has-error' : '' }}" id="atn-15">
                            {!! Form::label('date', trans('Date'), ['class' => 'control-label']) !!}
                            {!! Form::text('date', $date ?? date('d-m-Y') , ['class' => 'form-control','required','readonly']) !!}
                            @error('date')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2 mt-25" id="atn-15">
                            <button type="submit" class="{{btnClass()}}"
                                    style="height: 38px">@lang('Take Attendances')</button>
                        </div>
                        {!! Form::close() !!}
                        <div class="clearfix"></div>
                        @isset($students)
                            <div class="page-panel-title w-100">
                                @php $update= false; @endphp
                                @foreach ($students as $student)
                                    <b>{{trans(school('country')->code == 'BD' ? 'Class' : 'Grade')}}</b>
                                    - {{$student->section->class->name}}  &nbsp; <b>@lang('Section')</b>
                                    - {{ $student->section->section_number}}
                                    <span class="pull-right"><b>@lang('Attendance Date'):</b> &nbsp;{{ $date}}</span>
                                    @break($loop->first)
                                @endforeach
                            </div>
                            @foreach ($students as $student)
                                @foreach ($student->attendance as $attendance)
                                    @if ($attendance->present == 1 || $attendance->present == 0)
                                        @php $update= true; @endphp
                                        @break
                                    @endif
                                @endforeach
                            @endforeach
                            <div class="clearfix"></div>
                            @if ($students->count())
                                @if ($update)
                                    <div class="col-md-12 text-right">
                                        <div class="text-success">@lang('Attendance Already Submitted,Now can edit Attendance')
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-4 col-md-offset-8 attrCheckNone">
                                        <div class="TriSea-technologies-Switch pull-left ml-25">
                                            {!! Form::checkbox('attrCheckAll',1,null,  ['class'=>'','id'=>'attrCheckAll']) !!}
                                            <label for="attrCheckAll" class="label-success"></label>
                                        </div>
                                        <label for="attrCheckAll"
                                               class="control-label ml-5 cursorP">@lang('Checked All')</label>
                                    </div>
                                @endif
                                <div class="clearfix"></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@lang('Student ID')</th>
                                            <th>@lang('Name')</th>
                                            <th>@lang('Attendance')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            @php $checked = false;$attrId=0;@endphp
                                            @foreach ($student->attendance as $attendance)
                                                @if ($attendance->present == 1)
                                                    @php $checked = true;$attrId = $attendance->id;$remark = $attendance->remark ; @endphp
                                                @endif
                                            @endforeach
                                            <tr>
                                                <td>{{$loop->index +1}}</td>
                                                <td>{{$student->student_code}}</td>
                                                <td><a href="{{route('user.show',$student->student_code)}}"
                                                       target="_blank">{{$student->name}}</a></td>
                                                <td width="30%">
                                                    @if ($update)
                                                        <div class="TriSea-technologies-Switch pull-left">
                                                            {!! Form::checkbox('adjustAtt',$checked ? 1 : '', null,  ['class'=>'adjustAtt','checked'=>$checked,'id' => $student->student_code]) !!}
                                                            <label for="{{$student->student_code}}"
                                                                   class="label-success"></label>
                                                        </div>
                                                        <div class="pull-right">
                                                            {!! Form::text('adjustAttRemark', null,  ['class'=>'adjustAttR d-none form-control popTop','id' => 'adjustAtt'.$student->student_code,'data-attr'=>$attrId,'data-id' => $student->student_code,'title'=>'Correction remark','onblur'=>'adjustAttRemark(this)']) !!}
                                                        </div>
                                                    @else
                                                        <div class="TriSea-technologies-Switch">
                                                            {!! Form::checkbox('attendance', '1', null,  ['class'=>'takeAttendance','id' => $student->student_code]) !!}
                                                            <label for="{{$student->student_code}}"
                                                                   class="label-success"></label>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                @lang('No Related Data Found.')
                            @endif
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function () {
            $('#date').datepicker({
                format: "dd-mm-yyyy",
                autoclose: true,
                endDate: "today",
                maxDate: 'today',
            });
        })
    </script>
@endpush