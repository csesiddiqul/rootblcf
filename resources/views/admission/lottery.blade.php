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
                    <div class="panel-body pad-top-0 pl-0">
                        @if(preAdmissionId())
                            {!! Form::open(['route'=>'academic.admission.lottery','method' => 'post', 'id' => 'getStudentLottery']) !!}
                            <div class="col-sm-12 pl-0">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="class_id">@lang('Select Class')</label>
                                        {!! Form::select('class_id',admissionClass(),$class_id ?? null, array('id' => 'class_id','required'=>true, 'class' => 'form-control', 'placeholder' => trans('Select Class'))) !!}
                                        @error('class_id')
                                        <span class="help-block text-danger">
                                           <strong>{{$message}}</strong>
                                         </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="lottery_in_total">@lang('Lottery In Total')</label>
                                        {!! Form::number('lottery_in_total',null, array('id' => 'lottery_in_total','readonly', 'class' => 'form-control', 'placeholder' => trans('0'))) !!}
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="generate_in">@lang('Generate In')</label>
                                        {!! Form::select('generate_in',['1'=>trans('Once Times'),'2'=>trans('Twice Times'),'3'=>trans('Thrice Times')],null, array('id' => 'generate_in','required'=>true, 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                                        @error('generate_in')
                                        <span class="help-block text-danger">
                                           <strong>{{$message}}</strong>
                                         </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group mt-28">
                                        <input name="student_for" id="student_for" type="checkbox">
                                        <label for="student_for">@lang('All')</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group mt-28">
                                        {!! Form::button(trans('Generate'), array('class' => btnClass(),'id'=>'confirmButton','onClick'=>'confirmSubmit()')) !!}
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}

                            @if(isset($students))
                                @php
                                    $className = school('country')->code == 'BD' ? 'Class' : 'Grade';
                                @endphp
                                <span class="pull-left">
                                    <button class="btn btn-xs btn-success d-print-none" role="button" id="btnPrint"
                                            style="    margin-left: 10px;"
                                            onclick="printDiv()"><i class="fa fa-print"></i> @lang('Print')
                                    </button>
                                    @foreach ($students as $key=>$student)
                                        <form class="pull-left d-print-none" id="sms_submit_form"
                                              action="{{route('academic.admission.lottery_sms',[$student->section_id,$student->preadmission_id])}}"
                                              method="post">
                                            <a href="javascript:void(0);" class="btn foqas-btn btn-xs"
                                               onclick="confirmSubmitSMS()">@lang('Send SMS')</a>
                                            @csrf
                                        </form>
                                        @break
                                    @endforeach
                                </span>
                                <div class="clearfix"></div>
                                <div id="table-content">
                                    <div align="center">
                                        <div class="imga" style="display: inline-block;">
                                            <h2 class="headname">
                                                &nbsp&nbsp&nbsp {{Auth::user()->school->name}}</h2>
                                        </div>
                                        <h4 style="margin-top: -10px;">{{Auth::user()->school->address}}</h4>
                                        <img class="" src="{{getLogo()}}"
                                             alt="{{Auth::user()->school->name}}"
                                             style="width: 10%;margin-top: 5px;">
                                        <p class="margin">{{school('country')->code == 'BD' ? trans('Admission Class') : trans('Enroll In')}}
                                            : {{$class_name}}</p>
                                        <h4>@lang('Generate Lottery')</h4>
                                    </div>
                                    <div class="clearfix"></div>
                                    @if (count($students)>0)
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-condensed table-striped table-hover">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">@lang('Admission Roll')</th>
                                                    <th scope="col">@lang('Student Name')</th>
                                                    <th scope="col">@lang('Father Name')</th>
                                                    <th scope="col">@lang('Mobile')</th>
                                                    <th scope="col"> {{trans(school('country')->code == 'BD' ? 'Class' : 'Grade')}}</th>
                                                    <th scope="col">@lang('Gender')</th>
                                                    @php $isMark = false; @endphp
                                                    @foreach ($students as $key=>$student)
                                                        @if($student->mark)
                                                            @php $isMark = true; @endphp
                                                        @endif
                                                    @endforeach
                                                    @if($isMark && $lottery_on_mark == 1)
                                                        <th scope="col"
                                                            style="text-align:center!important">@lang('Marks')</th>
                                                    @endif
                                                    <th scope="col">@lang('Position')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($students as $key=>$student)
                                                    <tr>
                                                        <th scope="row">{{  $key + 1 }}</th>
                                                        <td>{{$student->roll}}</td>
                                                        <td>
                                                            <small> {{$student->name}} </small>
                                                        </td>
                                                        <td><small> {{$student->father_name}} </small></td>
                                                        <td><small> {{$student->mobile}} </small></td>
                                                        <td><small> {{$student->class['name']??''}} </small></td>
                                                        <td><small> {{gender($student->gender)}} </small></td>
                                                        @if($isMark && $lottery_on_mark == 1)
                                                            <td class="text-center">
                                                                {{$student->mark}}
                                                            </td>
                                                        @endif
                                                        <td><small> {{convert_ordinary($student->merit)}} </small></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                    <div class="clearhight50"></div>
                                    <div align="center" class="d-print-block d-none"> Developed by
                                        : {{school('reseller')->name}}
                                    </div>
                                    <div style="page-break-before: always;"></div>
                                </div>
                            @endif
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
            $("#class_id").change(function () {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "/getAdmissionTotalBySection/" + id,
                    success: function (data) {
                        $("#lottery_in_total").val(data.total);
                    },
                    error: function (xhr, textStatus, thrownError, jqXHR) {
                    },
                });
            })
        })

        function confirmSubmit() {
            Swal.fire({
                title: "Confirmation!",
                text: "Are you sure you want to Generate Lottery",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Confirm!'
            }).then((result) => {
                if (result.value) {
                    $('#getStudentLottery').submit();
                }
            })
        }

        function confirmSubmitSMS() {
            Swal.fire({
                title: "Confirmation!",
                text: "Are you sure you want to send message all selected Students",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Confirm!'
            }).then((result) => {
                if (result.value) {
                    $('#sms_submit_form').submit();
                }
            })
        }

        function printDiv() {
            var divToPrint = document.getElementById('table-content');
            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write('<html><title>@lang("Merit List")</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>#btnPrint{display:none}.d-print-none{display:none}.gradeTable{width:25% !important;top:55px !important;right:10px !important}.clearhight50{clear:both;height:50px}.clearhight25 {clear: both;height: 25px;}.clearhight15 {clear: both}.print_style {border: 1px dashed;position: relative;overflow: auto;padding: 0px 10px;min-height:97%}.div_break{padding: 10px 0;page-break-before: always;}.custom-tabel{background-color: #f0f0f0 !important;} .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{font-size:11px; border: 1px solid #000;padding: 2.5px;}.table-borderless > thead > tr > th, .table-borderless > tbody > tr > th, .table-borderless > tfoot > tr > th, .table-borderless > thead > tr > td, .table-borderless > tbody > tr > td, .table-borderless > tfoot > tr > td{border: none !important;}.headname{font-size:26px}  </style>' + divToPrint.innerHTML + '</body></html>');
            newWin.document.close();
            setTimeout(function () {
                newWin.close();
            }, 1000);
        }

        jQuery(document).bind("keyup keydown", function (e) {
            if (e.ctrlKey && e.keyCode == 80) {
                printDiv();
                return false;
            }
        });
    </script>
@endpush