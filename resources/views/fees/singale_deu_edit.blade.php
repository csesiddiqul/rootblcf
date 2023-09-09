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
{{--                        {!! Form::open(array('route' => 'accounts.moneyreceipt', 'method' => 'POST', 'role' =>'form','enctype'=>'multipart/form-data', 'class' => 'needs-validation')) !!}--}}




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
                                        {!! Form::open(['route' => ['accounts.updatedue',$student_code], 'method' => 'post','id'=>'oo']) !!}
                                        {!! Form::hidden('date', $date ?? date('d-m-Y'), array( 'id'=>'serdate' ,'class' => 'form-control','autocomplete' => 'off')) !!}
                                        @error('date')
                                        <span class="help-block">
                                            <strong>{{ trans($message) }}</strong>
                                        </span>
                                        @enderror
                                        <table class="table">
                                            <thead>
                                            <tr>

{{--                                                <th>@lang('Created Date')</th>--}}
                                                <th>@lang('Sector Name')</th>
                                                <th>@lang('Payable Amount')</th>
{{--                                                <th>@lang('Action')</th>--}}
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

{{--                                                    <td>--}}
{{--                                                        {{date("F d, Y",strtotime($due->created_at))}}--}}

{{--                                                    </td>--}}
                                                    <td>
                                                        {{$due->account_sectors}}
                                                        {{$due->fee_id}}
                                                        {!! Form::number('fees_id[]', $due->fee_id, ['class' => 'form-control  width-100 d-none','id'=>'amount'.$due->fee_id]) !!}
                                                    </td>
                                                    <td>
{{--                                                        <input type="number" value="{{$due->due}}">--}}

                                                        {!! Form::number('amount[]', $due->due, ['class' => 'form-control  width-100 '.$due->fee_id , 'min' => 0 ,'step' => .5]) !!}

                                                    </td>
                                                    <td>
{{--                                                        <form action="{{ route('accounts.delete_due',$due->id) }}" method="POST">--}}
{{--                                                            @method('DELETE')--}}
{{--                                                            @csrf--}}


{{--                                                            <button type="submit" class="{{btnClass()}}">Delete</button>--}}
{{--                                                        </form>--}}

                                                        {{--=== dont use theis delete code this is humfull===--}}

{{--                                                        <a href="{{route('accounts.delete_due',[$due->id,$due->fee_id])}}" class="{{btnClass()}}" >Delete</a>--}}

                                                    </td>


                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                        <div class="col-md-3">


                                            <button type="submit" class="{{btnClass()}}">Update</button>
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
