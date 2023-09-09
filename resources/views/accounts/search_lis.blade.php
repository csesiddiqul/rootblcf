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
                            <label for="date" style="font-weight: bold; font-size: 15px"> @lang('Date'): {{  $date ?? date('d-m-Y') }}</label>
                            {!! Form::text('date', $date ?? date('d-m-Y'), array('id' => 'date', 'class' => 'form-control datepicker','autocomplete' => 'off', "onchange='myFunction(this)'")) !!}
                            @error('date')
                            <span class="help-block">
                                <strong>{{ trans($message) }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group col-md-3">
                            <label for="studentId" style="font-weight: bold; font-size: 15px"> @lang('Student ID / Student Name')</label>
                            {{--                            <input type="text" name="studentId" id="studentId" class="from-control" @if(isset($id)) value="{{$id}}" @endisset required>--}}
                            {!! Form::text('studentId', ($student_code?? $_GET['studentId'] ?? null), array('id' => 'studentId', 'required', 'class' => 'form-control','autocomplete' => 'off')) !!}
                            @error('studentId')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group col-md-3 mt-28 ">
                            <button type="submit" id="admitButton" style="font-weight: bold; font-size: 15px" class="{{btnClass()}}">
                                @lang('Search')
                            </button>
                        </div>

                        <div class="form-group col-md-3">
                            <a class="{{btnClass()}} mt-28" style="font-weight: bold; font-size: 15px" href="{{url('fees/singale_create/'.$student_code)}}">Add Fees</a>
                        </div>

                        <div class="form-group col-md-3">
                            <a class="{{btnClass()}} mt-28" style="font-weight: bold; font-size: 15px" href="{{route('accounts.ledger.editdue',[$student_code , date('y-m-d')])}}">Edit due</a>
                        </div>

                        <div class="form-group col-md-3">
                            <a class="{{btnClass()}} mt-28" target="_blank" style="font-weight: bold; font-size: 15px"href="{{url('user/'.$student_code)}}">View Status</a>
                        </div>

                        <div class="clearhight50"></div>
                        {!! Form::close() !!}
                    </div>

                    @isset($dues)
                        @if ($dues->count())
                            <div class="row">
                                <div class="col-md-12">
                                    @foreach($dues as $due)
                                        <div class=" form-group col-md-6">
                                            <h5><b>@lang('Student Name') : </b><span>{{$due->name}}</span></h5>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h5><b>@lang('Student Id') : </b><span>{{$due->student_code}}</span></h5>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h5><b>@lang('Class')
                                                    : </b><span>{{ \App\Myclass::findOrFail($due->class_id)->name }}</span>
                                            </h5>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <h5><b>@lang('Section')
                                                    : </b><span>{{\App\Section::findOrFail($due->section_id)->section_number}}</span>
                                            </h5>
                                        </div>
                                        @break($loop->first)
                                    @endforeach
                                    <div class="clearfix"></div>
                                    <div class="col-md-9 table-responsive">
                                        {!! Form::open(['route' => ['accounts.moneyreceived',$student_code], 'method' => 'post','id'=>'moneyreceivedForm']) !!}
                                        {!! Form::hidden('date', $date ?? date('d-m-Y'), array( 'id'=>'serdate' ,'class' => 'form-control','autocomplete' => 'off')) !!}
                                        @error('date')
                                        <span class="help-block">
                                            <strong>{{ trans($message) }}</strong>
                                        </span>
                                        @enderror
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <label>
                                                        {!! Form::checkbox('all', '1', null,  ['id' => 'checkall']) !!}
                                                        @lang('Select')
                                                    </label>
                                                </th>
                                                <th>@lang('Created Date')</th>
                                                <th>@lang('Sector Name')</th>
                                                <th>@lang('Payable Amount')</th>
                                                <th>@lang('Paid Amount')</th>
                                                <th>@lang('Waiver')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach($dues->sortBy('created_at') as $due)
                                                @php
                                                    $total += $due->due;
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <label>
                                                            {!! Form::checkbox('type[]', $due->id, null,  ['id' => 'student'.$due->id,'class'=>'checkSingle']) !!}
                                                        </label>
                                                    </td>
                                                    <td>{{date("F d, Y",strtotime($due->created_at))}}</td>
                                                    <td>{{$due->account_sectors}}</td>
                                                    <td>{{$due->due}}</td>
                                                    <td>{!! Form::number('amount[]', $due->due, ['class' => 'form-control removeDisable width-100 ','id'=>'amount'.$due->id,'disabled'=>'true','oninput'=>'total()', 'max' => $due->due]) !!}</td>
                                                    <td>
                                                        <table>
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    {!! Form::number('waiver[]', 0, ['class' => 'form-control  vnull removeDisable width-100','id'=>'waiver'.$due->id,'oninput'=>'total()','disabled'=>'true',  'max' => $due->due]) !!}
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td>@lang('Total Amount')</td>
                                                <td colspan="4" class="text-right">{{number_format($total,2)}}</td>
                                                <td id="waivertotal" class="text-center"></td>
                                            </tr>
                                            <tr>
                                                <td>@lang('Received Amount')</td>
                                                <td colspan="4" class="text-right" id="receivedID">0</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('Notes')</td>
                                                <td colspan="4">
                                                    <textarea name="remark" class="form-control" id="remark" cols="30" rows="1"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>@lang('Ledger')</td>
                                                <td colspan="4">
                                                    <select class="form-control" id="ledger_id" required name="ledger_id">
                                                        @foreach ($ledgers as $key => $value)
                                                            <optgroup label="{{$key}}">
                                                                @foreach ($value->sortBy('name') as $ledger)
                                                                    <option value="{{$ledger->id}}" {{$ledger->id = 2 ? 'selected' : ''}}>{{$ledger->name}}</option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach
                                                    </select>
                                                    @error('ledger_id')
                                                    <span class="help-block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <div class="col-md-3">
                                            {!! Form::button(trans('Submit'), ['class' => btnClass(),'onclick'=>'confirmSubmit()']) !!}
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        @else
                            @lang('No Related Data Found.')
                        @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
    <script>

        function myFunction(element) {
            var x = element.value;
            $("#serdate").val(x);
        }

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
