@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <a href="'. route('fees.index').'">'. trans('Fees').'</a> / <b>'.trans('Add').'<b>'])
                @include('components.sectionbar.accounts-bar')
                <div class="panel panel-default ptlb-515">
                    <div class="panel-body plt-07">
                        <form class="row" method="POST" id="feeCreateForm" action="{{url('fees/create')}}" autocomplete="off">
                            @csrf
                            <div class="col-md-4">
                                <div class="form-group{{ $errors->has('sections') ? ' has-error' : '' }}">
                                    <label for="sections">@lang('Class - Section')</label>
                                    {!! Form::select('sections',getSectionAndClassPluck(), null, array('id' => 'sections',  'class' => 'form-control select2','required','onchange'=> (school('country')->code != 'SG' ? 'getStudentsBySection(this.value,1)' : 'getStudentsByRSSection(this.value,1,"r_status")' ),'placeholder' =>trans('Choose'))) !!}
                                    @error('sections')
                                    <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @if(school('country')->code == 'SG')
                                    <div class="form-group{{ $errors->has('r_status') ? ' has-error' : '' }}">
                                        <label for="r_status">@lang('Resident Status')</label>
                                        {!! Form::select('r_status',residentstatus(), null, array('id' => 'r_status', 'class' => 'form-control','required','placeholder'=>transMsg('Choose'),'onchange'=> 'getStudentsBySectionRS(this.value,1,"sections")')) !!}
                                        @error('r_status')
                                        <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                @endif
                                <div class="form-group{{ $errors->has('student') ? ' has-error' : '' }}">
                                    <label for="student">@lang('Students')</label>
                                    {!! Form::select('student[]',array(), null, array('id' => 'student', 'class' => 'form-control select2','required','multiple')) !!}
                                    @error('student')
                                    <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group{{ $errors->has('cycle') ? '  has-error' : '' }}">
                                    <label for="cycle" style="font-weight: bold">@lang('Select Months  to Receive  Tuition Fees')</label>
                                    {!! Form::selectRange('cycle', 1,12,null, array('id' => 'cycle', 'class' => 'form-control')) !!}
                                    @error('cycle')
                                    <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="table-responsive-sm">
                                    <table class="table table-bordered text-center table-sm mrb-10 fee-create-table">
                                        <thead>
                                        <tr>
                                            <th>@lang('Type')</th>
                                            <th>@lang('Amount')</th>
                                            <th>@lang('Date')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td width="40%" class="text-left">
                                                {!! Form::select('type[]',$head, old('type'), array('id' => 'type', 'class' => 'form-control select2','required', 'placeholder' => trans('Choose'))) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('amount[]', NULL, array('id' => 'amount', 'class' => 'form-control', 'required','autocomplete' => 'off')) !!}
                                            </td>
                                            <td>
                                                {!! Form::text('date[]', date('01-m-Y'), array('id' => 'date', 'class' => 'form-control datepicker', 'required','autocomplete' => 'off')) !!}
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <span class="add-feeC-tr btn-xs btn btn-info pull-right"> @lang("Add More") </span>
                                </div>
                            </div>
                            <div class="clearhight"></div>
                            <div class="col-md-2">
                                <button type="button" id="feeSubmit" class="{{btnClass()}}">
                                    @lang('Create')
                                </button>
                            </div>
                            <div class="clearhight50"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <style>
        .error {
            color: red
        }
    </style>
    <script src="{{asset('additional/jquery-validate/jquery.validate.min.js')}}"></script>
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
        $(document).ready(function () {
            $(".add-feeC-tr").click(function () {
                const trCount = $("tr[class*='tr_countA']").length;
                const trCountAppend = 'datepicker' + trCount;
                const typeField = '{!! Form::select('type[]',$head, old('type'), array('id' => 'type', 'class' => 'form-control select2','required', 'placeholder' => trans('Choose'))) !!}';
                const amountField = '{!! Form::text('amount[]', NULL, array('id' => 'amount', 'class' => 'form-control', 'required','autocomplete' => 'off')) !!}';
                const dateField = "<input type=\"text\" name=\"date[]\" id='datepicker" + trCount + "'  class='form-control'>";
                const delete_tr = "<a href=\"#\"><i class='fa fa-times text-danger'></i></a>";
                const markup = "<tr class='tr_countA'>" +
                    "<td class='text-left'>" + typeField + "</td>" +
                    "<td>" + amountField + "</td>" +
                    "<td class='date'>" + dateField + "</td>" +
                    "<td>" + delete_tr + "</td>" +
                    "</tr>";
                $(".fee-create-table tbody").append(markup);
                $("#datepicker" + trCount).datepicker({
                    format: "dd-mm-yyyy",
                    viewMode: "days",
                    minViewMode: "days",
                    autoclose: true
                });
                $('.select2').select2();
            });
            $('.fee-create-table').on('click', 'tr a', function (e) {
                e.preventDefault();
                $(this).parents('tr').remove();
            });
            document.getElementById("feeSubmit").onclick = function () {
                let allAreFilled = true;
                document.getElementById("feeCreateForm").querySelectorAll("[required]").forEach(function (i) {
                    if (!allAreFilled) return;
                    if (!i.value) allAreFilled = false;
                    if (i.type === "radio") {
                        let radioValueCheck = false;
                        document.getElementById("feeCreateForm").querySelectorAll(`[name=${i.name}]`).forEach(function (r) {
                            if (r.checked) radioValueCheck = true;
                        })
                        allAreFilled = radioValueCheck;
                    }
                })
                if (allAreFilled) {
                    confirmSubmit();
                } else {
                    Swal.fire({
                        title: "Warning",
                        text: "Please fill in all the required fields.",
                        icon: 'question',
                        showCancelButton: false,
                        confirmButtonColor: '#d33',
                        confirmButtonText: "Ok"
                    })
                }
            };
        })

        function confirmSubmit() {
            Swal.fire({
                title: "Confirmation",
                text: "Are you sure you want to create fee?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Ok, Confirm"
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('feeCreateForm').submit();
                }
            })
        }
    </script>
@endpush