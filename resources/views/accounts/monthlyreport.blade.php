@extends('layouts.app')
@section('title', __('Monthly Report'))
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
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Monthly Report').'<b>'])
                @include('components.sectionbar.reports-bar')
                <div class="panel-body pl-0 pr-0">
                    <div class="col-md-12 pl-0">
                        {!! Form::open(array('route' => 'accounts.monthlyreport', 'method' => 'POST', 'role' =>'form','enctype'=>'multipart/form-data', 'class' => 'needs-validation')) !!}
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
                            <label for="year">@lang('Year')</label>
                            {!! Form::text('year', $year ?? date('Y'), array('id' => 'year', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
                            @error('year')
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
                                <span class="pull-right"><b>@lang('Payment Report Year') {{$year}} </b>&nbsp;</span>
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
                                            <th>@lang('Current Due')</th>
                                            @for($month=1;$month<=12;$month++)
                                                <th>{{date('F', mktime(0, 0, 0, $month, 10))}}</th>
                                            @endfor
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($total_due=$total_paid=0)
                                        @foreach($payments as $key=> $payment)
                                            <tr>
                                                <td>{{$loop->index +1}}</td>
                                                @foreach($payment as $field=> $value)
                                                    @if ($field == 'Total Due')
                                                        <?php $student_id = $value;$total_due = (new \App\Fee())->student_total_dues($student_id, $year);?>
                                                        <td>{{number_format($total_due,2)}}</td>
                                                    @elseif ($field == 'Total Paid')
                                                        <?php $total_paid = $value;?>
                                                        <td>{{number_format($value,2)}}</td>
                                                    @else
                                                        <td>{{$value ?? 0}}</td>
                                                    @endif
                                                @endforeach
                                                <td>{{number_format($total_due-$total_paid,2)}}</td>
                                                @for($month=1;$month<=12;$month++)
                                                    <?php $month_paid = (new \App\Payment())->student_month_payment($student_id, $year, $month);?>
                                                    <td class="text-right">{{$month_paid == 0 ? $month_paid : number_format($month_paid,2)}}</td>
                                                @endfor
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @push('script')
                                    <script>
                                        $(function () {
                                            var tables = $("#tbl").tableExport({
                                                bootstrap: true,
                                                headings: true,
                                                footers: true,
                                                formats: ["xlsx", "xls", "csv", "txt"],
                                                fileName: "monthly-report-{{$year}}",
                                                position: "top",
                                                ignoreRows: null,
                                                ignoreCols: null,
                                                ignoreCSS: ".tableexport-ignore",
                                                emptyCSS: ".tableexport-empty",
                                                trimWhitespace: true
                                            });
                                        });
                                    </script>
                                @endpush
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
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true
            });
            $('.select2').select2();
        });
    </script>
@endpush

