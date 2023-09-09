@extends('layouts.app')

@section('title', __('Student fee reports'))
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

        .table-responsive {
            margin-top: 32px;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="page-panel-title">@lang('') </div>
                <div class="col-md-12">
                    {!! Form::open(array('route' => 'accounts.feereport', 'method' => 'POST', 'role' =>'form','enctype'=>'multipart/form-data', 'class' => 'needs-validation')) !!}
                    <div class="form-group col-md-3">
                        {!! Form::label('section', trans('Section'), ['class' => 'control-label']) !!}
                        {!! Form::select('section', $pluckSection , null , ['class' => 'select2 form-control','required','placeholder'=>'Choose']) !!}
                        @error('section')
                        <span class="help-block">
                                            <strong>{{ trans($message) }}</strong>
                                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label for="head">@lang('Head')</label>
                        {!! Form::select('type',$head, old('type'), array('id' => 'type', 'class' => 'form-control','required', 'placeholder' => trans('Choose'))) !!}
                        @error('type')
                        <span class="help-block">
                                            <strong>{{ trans($message) }}</strong>
                                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label for="date">@lang('From')</label>
                        {!! Form::text('from', $date ?? date('d-m-Y'), array('id' => 'date', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
                        @error('from')
                        <span class="help-block">
                                            <strong>{{ trans($message) }}</strong>
                                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label for="date">@lang('To')</label>
                        {!! Form::text('to', $date ?? date('d-m-Y'), array('id' => 'date', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
                        @error('to')
                        <span class="help-block">
                                            <strong>{{ trans($message) }}</strong>
                                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-2 mt-28 ">
                        <button type="submit" id="admitButton" class="{{btnClass()}}">
                            @lang('Search')
                        </button>
                    </div>
                    <div class="clearhight50"></div>
                    {!! Form::close() !!}
                </div>
                <button class="printbtn btn btn-success pull-right mr-15"
                        onclick="printDiv('forPrint')" style="margin-top: 10px !important;"
                        role="button" id="btnPrint"><i class="fa fa-print"> @lang('Print')</i></button>
                <div class="clearfix"></div>
                @if(isset($report))
                    <div class="forSign col-md-12" id="forPrint">
                        <h3 style="text-align: center;">@lang('Students Payment Report')</h3>
                        <div style="text-align: center;">
                            Date: @if($from == $to) {{$from}} @else {{$from}} to {{$to}} @endif
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered  table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('Head')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Collected')</th>
                                    <th>@lang('Due')</th>
                                    <th>@lang('Waiver')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($report as $in)
                                    <tr>
                                        <td>{{$in->id}}</td>
                                        <td>{{$in->name}}</td>
                                        <td>{{$in->fee}}</td>
                                        <td>{{$in->amount}}</td>
                                        <td>{{$in->pdid}}</td>
                                        <td>{{$in->waiver}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="clearhight50"></div>
                        <div class="d-print-block">
                            <div class="pull-left mt-25 ml-10" align="center">
                                ----------------------
                                <div class="clearfix"></div>
                                <span class="border_dot">
                                    @lang('Cashier')
                                </span>
                            </div>
                            <div class="pull-right mt-25 ml-10" align="center">
                                ----------------------
                                <div class="clearfix"></div>
                                <span class="border_dot">
                                     @lang('Head Teacher')
                                 </span>
                            </div>
                        </div>
                        <div class="clearhight50"></div>
                        <div align="center" class="d-print-block d-none">Developed by : {{reseller()->name}}</div>
                    </div>
                @endif

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
        });

        function printDiv() {
            var divToPrint = document.getElementById('forPrint');
            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write('<html><title>Attendance Report Date </title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()" style="margin-top:189px;"><style>#pd-12{padding: 12px;font-size: 18px}.clearhight50{clear:both;height:50px}.table-responsive{margin-top: 32px;}</style>' + divToPrint.innerHTML + '</body></html>');
            newWin.document.close();
            setTimeout(function () {
                newWin.close();
            }, 100);
        }
    </script>
    <script>
        $(function () {
            $('.select2').select2();
        });
    </script>
@endpush