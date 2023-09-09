@extends('layouts.app')
@section('title', __('Student Payment Report'))
@section('content')
    <style>
        h4 {
            font-size: 21px !important;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        #printhis {
            width: 100%;
            height: 200px;
            overflow: auto;
        }

        .mt-28 {
            margin-top: 28px;
        }

        .txt {
            display: none;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Student Payment Reports').'<b>'])
                @include('components.sectionbar.reports-bar')
                <div class="panel-body pl-0 pr-0">
                    <div class="col-md-12 pl-0">
                        {!! Form::open(array('route' => 'accounts.studentpaymentreport', 'method' => 'POST', 'role' =>'form','enctype'=>'multipart/form-data', 'class' => 'needs-validation')) !!}
                        <div class="form-group col-md-2">
                            {!! Form::label('section', trans('Section'), ['class' => 'control-label']) !!}
                            {!! Form::select('section', $pluckSection , $section?? null , ['class' => 'select2 form-control','required','onchange'=>'getStudentsBySection(this.value,1)','placeholder'=>trans('Choose')]) !!}
                            @error('section')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="student">@lang('Student')</label>
                            {!! Form::select('student',$pluckStudent ?? array(), $student?? null, array('id' => 'student', 'class' => 'form-control select2','required')) !!}
                            @error('student')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-2">
                            <label for="head">@lang('Head')</label>
                            {!! Form::select('type',$head,$type?? null, array('id' => 'type', 'class' => 'select2 form-control','required', 'placeholder' => trans('Choose'))) !!}
                            @error('type')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="date">@lang('From')</label>
                            {!! Form::text('from', $from ?? date('01-m-Y'), array('id' => 'date', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
                            @error('from')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="date">@lang('To')</label>
                            {!! Form::text('to', $to ?? date('t-m-Y'), array('id' => 'date', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
                            @error('to')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-2 mt-28 ">
                            <button type="submit" id="admitButton" class="{{btnClass()}}">
                                @lang('Search')
                            </button>
                        </div>
                        {{--@if (isset($payments) && $payments->count())

                            <div class="col-md-1 mt-28">
                            <span class="btn btn-default btn-sm pull-right" onclick="Export()">@lang('Download ')</span>

                            </div>
                        @endif--}}
                        <div class="clearhight50"></div>
                        {!! Form::close() !!}
                    </div>
                    <div class="clearfix"></div>
                    @isset($payments)
                        <div id="printDiv1">
                        <span class="pull-left print-block d-none margin-top ml-1">@lang('Print Date') : <span
                                    id="printTime"></span></span>
                            <div class="clearfix"></div>
                            <div align="center" class="d-none print-block">
                                <h3>{{school('name')}}</h3>
                                <h5>{{school('address')}}</h5>
                                <div class="clearhight50"></div>
                            </div>
                            @php($section = App\Section::find($section))
                            <div class="page-panel-title w-100 pl">
                                <b>@lang('Section')</b>
                                {{$section->class->name .' - '. $section->section_number}}
                                &nbsp;
                                <b>@lang('Student') - </b>
                                @if ($student == 'all')
                                    @lang('All')
                                @else
                                    @php($student = (new App\User)->getUser($student))
                                    {{$student->name}}
                                @endif
                                <b>@lang('Head') - </b>
                                @if ($type == 'all')
                                    @lang('All')
                                @else
                                    @php($head = \App\AccountSector::find($type))
                                    {{$head->name}}
                                @endif
                                <span class="pull-right"><b>@lang('Payment Report') {{$from}} @lang('to') {{$to}}</b></span>
                            </div>
                            @if($payments->count())
                                <div class="clearfix"></div>
                                <div class="table-responsive pl" id="fullTable">
                                    <table class="table table-bordered table-condensed table-striped" cellpadding="0"
                                           cellspacing="0" align="center" id="tbl">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            @foreach($payments as $key=> $payment)
                                                @foreach($payment as $field=> $value)
                                                    <th>{{$field}}</th>
                                                @endforeach
                                                @break($loop->first)
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($receivable=$waiver=$received=0)
                                        @foreach($payments as $key=> $payment)
                                            <tr>
                                                <td>{{$loop->index +1}}</td>
                                                @foreach($payment as $field=> $value)
                                                    @if ($field == 'Receivable')
                                                        @php($receivable +=$value)
                                                    @endif
                                                    @if ($field == 'Waiver')
                                                        @php($waiver +=$value)
                                                    @endif
                                                    @if ($field == 'Received')
                                                        @php($received +=$value)
                                                    @endif
                                                    @if ($field == 'Money Receipt')
                                                            <td><a href="{{route('invoice',$value)}}" target="_blank">{{$value}}</a></td>
                                                        @else
                                                            <td>{{$value ?? 0}}</td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="6">Total</td>
                                            @foreach ($totalSums as $headTotal)

                                                <td>{{number_format($headTotal->total,2)}}</td>
                                            @endforeach

                                            <td>{{number_format($receivable,2)}}</td>
                                            <td>{{number_format($waiver,2)}}</td>
                                            <td>{{number_format($received,2)}}</td>
                                            <td colspan="2"></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                @lang('No Related Data Found.')
                            @endif
                            <div class="clearhight50"></div>
                            <div class="print-block d-none">
                                <div class="pull-left ml-1" align="center">
                                    ----------------------
                                    <div class="clearfix"></div>
                                    <span class="border_dot">
                                        @lang('Accountant')
                                    </span>
                                </div>
                                <div class="pull-right mr-1" align="center">
                                    ----------------------
                                    <div class="clearfix"></div>
                                    <span class="border_dot">
                                        @lang('Head Of the Institue')
                                    </span>
                                </div>
                            </div>
                            <div class="clearhight25"></div>
                            <div align="center" class="print-block d-none">Developed by : {{reseller()->name}} </div>
                        </div>
                    @endisset
                </div>
            </div>

        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function () {
            $('.datepicker').datepicker({
                format: "dd-mm-yyyy",
                viewMode: "days",
                minViewMode: "days",
                autoclose: true
            });
            $('.select2').select2();
        });
    </script>


    <script>
        $(function () {
            var tables = $("#tbl").tableExport({
                bootstrap: true,
                headings: true,
                footers: true,
                formats: ["xlsx", "xls", "csv", "txt"],
                fileName: "MyExcel",
                position: "top",
                ignoreRows: null,
                ignoreCols: null,
                ignoreCSS: ".tableexport-ignore",
                emptyCSS: ".tableexport-empty",
                trimWhitespace: false
            });
        });
    </script>
@endpush

