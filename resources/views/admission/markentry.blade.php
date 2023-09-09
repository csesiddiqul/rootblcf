@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.admission.pending').'">'. transMsg('Admission').'</a> / <b>'.transMsg('Marks Entry').'<b>'])
                @include('components.sectionbar.admission-bar')
                <div class="panel panel-default">
                    <div class="panel-body pad-top-0">
                        @if($admissionyear)
                            <div class="col-sm-12 p-0 {{(isset($students) && count($students)>0) ? 'd-none': ''}}"
                                 id="addClassGet">
                                {!! Form::open(['route' => ['academic.admission.markEntry',[auth()->user()->school->code,$admissionyear->id,$admissionyear->year]], 'method' => 'post', 'id' => 'getStudentEntry']) !!}
                                <label for="markEntryId">
                                    {!! Form::select('class_id',admissionClass(),$class_id ?? null, array('id' => 'markEntryId','required'=>true, 'class' => ((isset($students) && count($students)>0) ? 'form-control': ''),'onchange' => 'this.form.submit()', 'placeholder' => trans('Select Class'))) !!}
                                </label>
                                {!! Form::close() !!}
                            </div>
                        @endif
                        @if (isset($students) && count($students)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Admission Roll')</th>
                                        <th scope="col">@lang('Student Name')</th>
                                        <th scope="col">@lang('Father Name')</th>
                                        <th scope="col"> {{trans(school('country')->code == 'BD' ? 'Class' : 'Grade')}}</th>
                                        <th scope="col">@lang('Gender')</th>
                                        <th scope="col" style="text-align:center!important">@lang('Marks')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($students as $key=>$student)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td>{{$student->roll}}</td>
                                            <td>
                                                <a href="{{route('academic.admission.show',$student->id)}}">
                                                    <small> {{$student->name}} </small>
                                                </a>
                                            </td>
                                            <td><small> {{$student->father_name}} </small></td>
                                            <td><small> {{$student->class['name']??''}} </small></td>
                                            <td><small> {{gender($student->gender)}} </small></td>
                                            <td class="text-center">
                                                @if(empty($student->mark))
                                                    @php $value = 0; @endphp
                                                @else
                                                    @php $value = $student->mark; @endphp
                                                @endif
                                                <div id="{{$student->id}}" class="fcw-100" contenteditable="true"
                                                     onBlur="saveToDatabase(this,'{{$student->id}}')"
                                                     onClick="editMarkRow({{$student->id}});">{{$value}}</div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @push('script')
                                <script>
                                    $(".fcw-100").keypress(function (e) {
                                        if (e.which == 13) {
                                            jQuery(this).blur();
                                            return false;
                                        }
                                    });

                                    $(document).ready(function () {
                                        function appendFunction() {
                                            var appendHtml = $("#addClassGet").html();
                                            $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
                                        }

                                        setTimeout(function () {
                                            appendFunction();
                                        }, 1000);
                                    })
                                </script>
                            @endpush
                        @else
                            @if($getmessage == 'FirstTime')
                                <code><i><b>*@lang('Note')
                                        :</b> @lang('Click on mark field for insert mark. Give mark and leave the field, mark will saved').</i>
                                </code>
                            @else
                                <code><i><b>*@lang('Note'):</b> @lang('Class') {{$getmessage}} @lang('has no available data').</i></code>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .swal2-validation-message::after {
            content: 'Please, Write the reason!';
        }
    </style>
@endsection