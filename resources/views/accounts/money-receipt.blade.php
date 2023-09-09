@extends('layouts.app')
@section('title', __('Register'))
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
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Money Receipt').'<b>'])
                @include('components.sectionbar.accounts-bar')
                <div class="panel-body">

                    <div class="col-md-12 pl-0">


                        {!! Form::open(array('route' => 'accounts.moneyreceipt', 'method' => 'POST', 'role' =>'form','enctype'=>'multipart/form-data', 'class' => 'needs-validation')) !!}

                        <div class="form-group col-md-3">

                            <label for="studentId" style="font-weight: bold"> @lang('Student ID / Student Name')</label>
                            <input type="text" name="studentId" id="studentId" class="form-control" @if(isset($searchid)) value="{{$searchid}}" @endisset required>



                            {{--                            {!! Form::text('studentId', ($student_code?? $_GET['studentId'] ?? null), array('id' => 'studentId', 'required', 'class' => 'form-control','autocomplete' => 'off')) !!}--}}
                            @error('studentId')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="date" style="font-weight: bold; display: none" > @lang('Date'): {{  $date ?? date('d-m-Y') }}</label>
                            {!! Form::hidden('date', $date ?? date('d-m-Y'), array('id' => 'date', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
                            @error('date')
                            <span class="help-block">
                                <strong>{{ trans($message) }}</strong>
                            </span>
                            @enderror
                        </div>



                        <div class="form-group col-md-2 mt-28 ">
                            <button type="submit" id="admitButton" style="font-weight: bold; font-size: 15px" class="{{btnClass()}}">
                                @lang('Search')
                            </button>
                        </div>


                        <div class="clearhight50"></div>
                        {!! Form::close() !!}
                    </div>
                    @isset($stduntprment)
                        <table class="table table-bordered table-condensed table-striped table-hover" id="tbl">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="font-weight: bold; text-align: center; font-size: 15px">Name</th>
                                <th scope="col" style="font-weight: bold; text-align: center; font-size: 15px">Student Information</th>
                                <th scope="col" style="font-weight: bold; text-align: center; font-size: 15px">Action</th>
                            </tr>
                            </thead>
                            <tbody>



                            @foreach($stduntprment as $data)
                                <tr>
                                    <td scope="row">{{  $loop->index + 1 }}</td>
                                    {{--<td scope="row">{{  $data->id }}</td>--}}
                                    <td>
                                        <small style="font-size:14px; font-weight: bold">{{$data->name }}</small>
                                    </td>

                                    <td style="text-align: center; font-size:14px; font-weight: bold">
                                        <small class="bg-warning" style="font-size:14px; font-weight: bold"> @foreach($allsc as $sc){{$data->student_code ==  $sc->student_code ? $sc->name .'-'. $sc->section_number: ''}}@endforeach </small>
                                        {{$data->student_code}}
                                    </td>

                                    <td>
                                        <div class="text-center">
                                            <a href="{{route('accounts.ledger.searchdata',[$data->student_code , $search_date])}}" style="font-weight: bold; font-size: 15px" class="btn btn-sm foqas-btn">$ Money Receipt</a>
                                            <a href="{{url('fees/singale_create/'.$data->student_code)}}" style="font-weight: bold; font-size: 15px" class="btn btn-sm foqas-btn">Add Fees</a>
                                            <a  class="btn btn-sm foqas-btn" target="_blank" style="font-weight: bold; font-size: 15px" href="{{url('user/'.$data->student_code)}}">View Status</a>
                                        </div>
                                    </td>



                                </tr>
                            @endforeach

                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    @endisset
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('.datepicker').datepicker({
                format: "dd-mm-yyyy",
                viewMode: "days",
                minViewMode: "days",
                autoclose: true
            });
        });
        // Store
        // sessionStorage.setItem("total", {{$total ?? ''}});
        //alert(sessionStorage.getItem("total"));
        $('#checkall').change(function () {
            $('.checkSingle').prop('checked', this.checked);
            if ($(this).is(":checked")) {
                $(this).attr('checked', true);
                $(".removeDisable").prop('disabled', false);
            } else {
                $(this).attr('checked', false);
                $(".waiverCheck").attr('checked', false);
            }
            total();
        });

        $('.waiverCheck').change(function () {
            var id = $(this).attr('id');
            id = (id).replace(/[^\d.]/g, '');
            if ($(this).is(":checked")) {
                var amount = $(this).attr('data-check');
                $(this).attr('checked', true);
                $("#waiver" + id).val(amount).attr('disabled', false);
            } else {
                $(this).attr('checked', false);
                $("#waiver" + id).val('').attr('disabled', true);
            }
            total();
        });

        $('.checkSingle').change(function () {
            var id = $(this).attr('id');
            id = (id).replace(/[^\d.]/g, '');
            if ($('.checkSingle:checked').length == $('.checkSingle').length) {
                $('#checkall').prop('checked', true);
            } else {
                $('#checkall').prop('checked', false);
            }
            if ($(this).is(":checked")) {
                $(this).attr('checked', true);
                $("#amount" + id).attr('disabled', false);
                $("#waiverCheck" + id).attr('disabled', false);
                $("#waiver" + id).val(0).attr('disabled', false);
            } else {
                $(this).attr('checked', false);
                $("#amount" + id).attr('disabled', true);
                $("#waiverCheck" + id).attr('disabled', true);
                $("#waiver" + id).attr('disabled', true).val(0);
            }
            total();
        });

        function total() {
            var arr = document.getElementsByName('amount[]');
            var waiver = document.getElementsByName('waiver[]');
            var tot = 0;
            var waivertot = 0;
            for (var i = 0; i < arr.length; i++) {
                var id = (arr[i].id).replace(/[^\d.]/g, '');
                if (document.getElementById("student" + id).checked) {
                    if (parseInt(arr[i].value))
                        tot += parseFloat(arr[i].value);
                }
                if (document.getElementById("student" + id).checked) {
                    if (parseInt(waiver[i].value))
                        tot += -parseFloat(waiver[i].value);
                }
                if (parseInt(waiver[i].value))
                    waivertot += parseFloat(waiver[i].value);
            }
            if (!isNaN(tot)) {
                document.getElementById('receivedID').innerHTML = tot.toFixed(2);
            }
            if (!isNaN(waivertot)) {
                document.getElementById('waivertotal').innerHTML = waivertot.toFixed(2);
            }
        }

        function confirmSubmit() {
            Swal.fire({
                title: "Confirmation",
                text: "Are you sure you want to received amount?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Ok, Received",
                cancelButtonText: "Check again!"
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('moneyreceivedForm').submit();
                }
            })
        }

        @if(isset($_GET['studentId']))
        $("#admitButton").trigger('click');
        @endisset
    </script>
@endsection
