@extends('layouts.app')
@section('title', __('Salary Process'))
@push('styles')
<style>
    a.help-block {
        text-decoration: none!important;
        font-size: 13px!important;
        margin-top: 2px!important;
        margin-bottom: 0px!important;
    }
    a.help-block:hover {
        color: #597ea2!important;
    }
    input:read-only {
        background-color: #ecf0f1 !important;
    }
    #remarks {
        line-height: 28px;
    }
    .table-bordered>tbody>tr>td {
        font-size: 14px!important;
    }
</style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.sectionbar.payrolls-bar')
                <div class="panel panel-default pt-0">
                    @include('components.sectionbar.payroll-set')
                    <div class="panel-body">
                        @if(!empty($firstEmployee))
                        <form action="{{route('payroll.store') }}" method="post" class="form-inline w-100" autocomplete="off">
                            {{ csrf_field() }}
                            <div class="table-responsive">
                                <input type="hidden" name="employee_id" value="{{ $firstEmployee->id }}">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>
                                            <b>{{ $schData->payFor == 1 ? "Teacher Name: " : "Employee Name: "  }}</b>
                                            <div style="clear:both;height:8px;"></div>
                                            {{ $firstEmployee->name }}
                                        </td>
                                        <td>
                                            <b>Weekly Scale:</b>
                                            <div style="clear: both;height:8px;"></div>
                                            @if (isset($firstEmployee->employeeDetail->payScale) && $firstEmployee->employeeDetail->payScale > 0)
                                                <input type="hidden" name="payScale" value="{{ $firstEmployee->employeeDetail->payScale }}" id="payScale">
                                                S$ <span id="payScalenumber">{{ $firstEmployee->employeeDetail->payScale }}</span>
                                            @else
                                                <input type="hidden" name="payScale" value="0.00" id="payScale">
                                                <a href="{{route('salary.information',$firstEmployee->student_code)}}" class="help-block text-danger">&nbsp;Set&nbsp;weekly&nbsp;scale.</a>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $myyear = $schData->payrollMonth ? date('Y',strtotime($schData->payrollMonth)) : date('Y');
                                                $mymonth = $schData->payrollMonth ? date('m',strtotime($schData->payrollMonth)) : date('m');
                                                $firstday = date("w", mktime(0, 0, 0, $mymonth, 1, $myyear));
                                                $lastday = date("t", mktime(0, 0, 0, $mymonth, 1, $myyear));
//                                                $count_weeks = 1 + ceil(($lastday-7+$firstday)/7);
                                                $count_weeks = 1;

                                                /* for total net payable */
                                                $netpayable = $wScale = $arrPay = 0;

                                                if (isset($firstEmployee->employeeDetail->payScale)) {
                                                    $wScale = $firstEmployee->employeeDetail->payScale;
                                                }

                                                if (isset($firstEmployee->employeeDetail->arrears) && $firstEmployee->employeeDetail->arrears > 0){
                                                    $arrPay = $firstEmployee->employeeDetail->arrears;
                                                }
                                                $netpayable = ($wScale * $count_weeks) + $arrPay;
                                            @endphp

                                            <b>Total Weeks:</b>
                                            <div style="clear: both;"></div>
                                            <input type="number" name="weekNumber" value="{{ $count_weeks }}" class="form-control w-100 calculate" id="totalWeeks" placeholder="***" min="0" step="0.5" required>
                                        </td>
                                        <td>
                                            <b>Bonus (S$):</b>
                                            <div style="clear: both;"></div>
                                            <input type="number" name="bonus" value="0" {{$schData->bonus == 1 ? 'required' : 'readonly'}} class="form-control w-100 calculate" id="bonus" placeholder="0.00" min="0" step="0.5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Email:</b>
                                            <div style="clear: both;height:8px;"></div>
                                            {{ $firstEmployee->email }}
                                        </td>
                                        <td>
                                            <b>{{ ($schData->payFor == 1 ? 'Rate Per Extra Class:' : 'Rate Per Extra Hour:') }}</b>
                                            <div style="clear: both;height:8px;"></div>
                                            @if (isset($firstEmployee->employeeDetail->exScale))
                                                <input type="hidden" name="exScale" value="{{ $firstEmployee->employeeDetail->exScale }}" id="exScale">
                                                S$ <span id="exScalenumber">{{ $firstEmployee->employeeDetail->exScale }}</span>
                                            @else
                                                <input type="hidden" name="exScale" value="0.00" id="exScale">
                                                S$ <span id="exScalenumber">0.00</span>
                                            @endif
                                        </td>
                                        <td>
                                            <b>{{ ($schData->payFor == 1 ? 'Total Extra Classes:' : 'Total Extra Hours:') }}</b>
                                            <div style="clear: both;"></div>
                                            <input type="number" name="exNumber" value="0" class="form-control w-100 calculate" id="totalExclass" placeholder="***" min="0" step="0.5" required >
                                        </td>
{{--                                        <td>--}}
{{--                                            <b>Arrears (S$):</b>--}}
{{--                                            <div style="clear: both;"></div>--}}
{{--                                            @if (isset($firstEmployee->employeeDetail->arrears) && $firstEmployee->employeeDetail->arrears > 0)--}}
{{--                                                <input type="hidden" name="arrears" value="{{ $firstEmployee->employeeDetail->arrears }}">--}}
{{--                                                <input type="number" name="arrearsPay" value="{{ $firstEmployee->employeeDetail->arrears }}"  class="form-control w-100 calculate" id="arrearsPay" placeholder="0.00" min="0" step="0.5" max="{{ $firstEmployee->employeeDetail->arrears }}">--}}
{{--                                            @else--}}
{{--                                                <input type="hidden" name="arrears" value="0">--}}
{{--                                                <input type="text" name="arrearsPay" value="0"  class="form-control w-100 calculate" id="arrearsPay" placeholder="0.00" readonly min="0" step="0.5" max="10000000">--}}
{{--                                            @endif--}}
{{--                                        </td>--}}


                                        <td>
                                            <b>Arrears (S$):</b>
                                            <div style="clear: both;"></div>
                                            <input type="number" name="arrearsPay" value="{{ $firstEmployee->employeeDetail->arrears }}"  class="form-control w-100 calculate" id="arrearsPay" placeholder="0.00" min="0" step="0.5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Date of Joining:</b>
                                            {{ isset($firstEmployee->employeeDetail->joindate) ? date('d M, Y', strtotime($firstEmployee->employeeDetail->joindate)) : "N/A" }}
                                            <div style="clear: both;height:8px;"></div>
                                            <b>Branch:</b>
                                            {{ isset($firstEmployee->employeeDetail->house) ? $firstEmployee->employeeDetail->house->name : "N/A" }}
                                        </td>
                                        <td>
                                            <b>Net Payable (S$):</b>
                                            <div style="clear: both;"></div>
                                            <input type="number" name="netPayable" value="{{ $netpayable }}"  class="form-control w-100" id="netPayable" placeholder="***" readonly min="0" step="0.01">
                                        </td>
                                        <td>
                                            <b>Amount Paid (S$):</b>
                                            <div style="clear: both;"></div>
                                            <input type="number" name="amountPaid" value="{{ $netpayable }}"  class="form-control w-100" id="amountPaid" placeholder="0.00" min="0.00" step="0.01" max="{{ $netpayable }}">
                                        </td>
                                        <td>
                                            <b>Amount Due (S$):</b>
                                            <div style="clear: both;"></div>
                                            <input type="number" name="amountDue" value="0"  class="form-control w-100" id="amountDue" placeholder="0.00" readonly min="0" step="0.5">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <b>Bank Name:</b>
                                            @if (isset($firstEmployee->employeeDetail->bank_name))
                                                <input type="hidden" name="bank_name" value="{{ $firstEmployee->employeeDetail->bank_name }}" id="bank_name">
                                                {{ $firstEmployee->employeeDetail->bank_name }}
                                            @else
                                                <input type="hidden" name="bank_name" value="0.00" id="bank_name">
                                                <a href="{{route('salary.information',$firstEmployee->student_code)}}" class="help-block text-danger">&nbsp;Set&nbsp;bank&nbsp;name.</a>
                                            @endif
                                            <div style="clear: both;height:8px;"></div>
                                            <b>Account No:</b>
                                            @if (isset($firstEmployee->employeeDetail->account_no))
                                                <input type="hidden" name="account_no" value="{{ $firstEmployee->employeeDetail->account_no }}" id="account_no">
                                                {{ $firstEmployee->employeeDetail->account_no }}
                                            @else
                                                <input type="hidden" name="account_no" value="0.00" id="account_no">
                                                <a href="{{route('salary.information',$firstEmployee->student_code)}}" class="help-block text-danger">&nbsp;Set&nbsp;account&nbsp;no.</a>
                                            @endif
                                        </td>
                                        <td colspan="2">
                                            <b>Remarks:</b>
                                            <div style="clear: both;"></div>
                                            <textarea name="remarks" rows="1" class="form-control w-100" id="remarks" placeholder="Write here..."></textarea>
                                        </td>
                                        <td>
                                            <b>Salary Status:</b>
                                            <div style="clear: both;height:8px;"></div>
                                            <label class="radio-inline">
                                                <input type="radio" name="status" id="status1" value="0" checked required>
                                                Process
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="status" id="status2" value="2" required>
                                                Pending
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            @if (isset($firstEmployee->employeeDetail->payScale) && $firstEmployee->employeeDetail->payScale > 0 && isset($firstEmployee->employeeDetail->bank_name) && isset($firstEmployee->employeeDetail->account_no))
                                                <button style="display: inline-block;width:200px;" type="submit" class="{{btnClass()}}">@lang('Submit') </button>
                                            @else
                                                <button onClick="confirm('Please Set Weekly Scale, Bank Name & Account No.')" style="display: inline-block;width:200px;" type="button" class="btn btn-warning btn-block btn-sm">@lang('Submit') </button>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                        @else
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ $schData->payFor == 1 ? "Teacher" : "Employee" }} salary process completed in <strong>{{ $schData->payrollMonth ? date('F, Y',strtotime($schData->payrollMonth)) : date('F, Y') }} </strong>
                        </div>
                        @endif
                        <div class="clearhight"> </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-data-div">
                                <thead>
                                <tr>
                                    <th>@lang('#')</th>
                                    <th>{{ $schData->payFor == 1 ? "Teacher Name" : "Employee Name" }}</th>
                                    <th>@lang('Branch')</th>
                                    <th>@lang('Email')</th>
                                    <th>@lang('Date of Joining')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($employee as $key=>$result)
                                    <tr style="{{$result->id == $firstEmployee->id ? 'background-color: #d5d582;' : ''}}">
                                        <td scope="row">{{ $key + 1 }}</td>
                                        <td>
                                            <small>
                                                @if(!empty($result->pic_path))
                                                    @if (file_exists($result->pic_path))
                                                        <img data-src="{{asset('01-progress.gif')}}" src="{{url($result->pic_path)}}"
                                                             style="border-radius: 50%;" width="25px" height="25px">
                                                    @else
                                                        @if($result->gender == 1)
                                                            <img data-src="https://img.icons8.com/color/48/000000/guest-male--v1.png"
                                                                 src="https://img.icons8.com/color/48/000000/guest-male--v1.png"
                                                                 style="border-radius: 50%;" width="25px" height="25px">&nbsp;
                                                        @else
                                                            <img data-src="https://img.icons8.com/color/48/000000/businesswoman.png"
                                                                 src="https://img.icons8.com/color/48/000000/businesswoman.png"
                                                                 style="border-radius: 50%;" width="25px" height="25px">&nbsp;
                                                        @endif
                                                    @endif
                                                @else
                                                    @if($result->gender == 1)
                                                        <img data-src="https://img.icons8.com/color/48/000000/guest-male--v1.png"
                                                             src="https://img.icons8.com/color/48/000000/guest-male--v1.png"
                                                             style="border-radius: 50%;" width="25px" height="25px">&nbsp;
                                                    @else
                                                        <img data-src="https://img.icons8.com/color/48/000000/businesswoman.png"
                                                             src="https://img.icons8.com/color/48/000000/businesswoman.png"
                                                             style="border-radius: 50%;" width="25px" height="25px">&nbsp;
                                                    @endif
                                                @endif
                                                <a href="{{url('payroll/process/'.$result->student_code)}}">
                                                    {{$result->name}}</a>
                                            </small>
                                        </td>
                                        <td>{{ isset($result->employeeDetail->house) ? $result->employeeDetail->house->name : "N/A" }}</td>
                                        <td>{{ $result->email }}</td>
                                        <td>
                                            {{ isset($result->employeeDetail->joindate) ? date('d M, Y', strtotime($result->employeeDetail->joindate)) : "N/A" }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {
                $(".calculate").on("keydown keyup change", function() {
                    var mul_a = 0;
                    var mul_b = 0;
                    var tot_val = 0;
                    var sum = 0;
                    var var_e = 0;
                    var var_f = 0;
                    var max_f = 0;

                    calculateSum();

                    var var_a = $('#payScale').val();
                    var var_b = $('#totalWeeks').val();
                        mul_a = parseFloat((var_a * var_b).toFixed(2));

                    var var_c = $('#exScale').val();
                    var var_d = $('#totalExclass').val();
                        mul_b = parseFloat((var_c * var_d).toFixed(2));
                        tot_val = mul_a + mul_b;

                    if($(this).attr('id') == 'bonus' && $(this).val() == ''){
                        var_e = 0.00;
                    }else{
                        var_e = $('#bonus').val();

                        if(var_e == ''){
                            var_e = 0.00;
                        }
                    }

                    if($(this).attr('id') == 'arrearsPay' && $(this).val() == ''){
                        var_f = 0.00;
                    }else{
                        var_f = $('#arrearsPay').val();
                        max_f = parseFloat($('#arrearsPay').attr('max'));

                        if(var_f == ''){
                            var_f = 0.00;
                        }else if(var_f > max_f){
                            var_f = max_f;
                        }
                    }


                    sum = parseFloat(tot_val) + parseFloat(var_e) + parseFloat(var_f);
                    var total = Number(sum).toFixed(2);

                    $('#netPayable').val(total);
                    $('#amountPaid').val(total).attr('max',total);

                });

                $("#amountPaid").on("keydown keyup change", function() {
                    var max = parseFloat($(this).attr('max'));
                    var min = parseFloat($(this).attr('min'));

                    if ($(this).val() > max) {
                        alert('You cannot pay more than the net payable = S$' + max);
                        $(this).val(max.toFixed(2)).css("border-color", "rgb(231, 76, 60)");
                        $('#amountDue').val(0).css("border-color", "rgb(0 119 247)");
                    }else if ($(this).val() < min) {
                        alert('You cannot use minus values.');
                        $(this).val(min).css("border-color", "rgb(231, 76, 60)");
                        $('#amountDue').val(max.toFixed(2)).css("border-color", "rgb(0 119 247)");
                    }else if (!isNaN($(this).val()) && $(this).val().length != 0){
                        var paid = parseFloat($(this).val());
                        var due = (max - paid).toFixed(2);

                        $('#amountDue').val(due).css("border-color", "rgb(0 119 247)");
                        $(this).css("border-color", "rgb(0 119 247)");
                    }else if($(this).val() == ''){
                        $('#amountDue').val(max.toFixed(2)).css("border-color", "rgb(0 119 247)");
                    }
                });

                $("#arrearsPay").on("keydown keyup change", function() {
                    var max = parseFloat($(this).attr('max'));
                    var min = parseFloat($(this).attr('min'));

                    if ($(this).val() > max) {
                        alert('You cannot pay more than the payable arrears = S$' + max.toFixed(2));
                        $(this).val(max.toFixed(2)).css("border-color", "rgb(0 119 247)");
                    }else if ($(this).val() < min) {
                        alert('You cannot use minus values.');
                        $(this).val(min).css("border-color", "rgb(231, 76, 60)");
                    }
                });
            });

            function calculateSum() {
                $(".calculate").each(function() {
                    if (!isNaN(this.value) && this.value < 0 ){
                        alert('You cannot use minus values.');
                        $(this).val(0).css("border-color", "rgb(231, 76, 60)");
                    }else if (!isNaN(this.value) && this.value.length != 0) {
                        $(this).css("border-color", "rgb(0 119 247)");
                    }else if (this.value.length != 0){
                        alert('Please use only number.');
                        $(this).val(0).css("border-color", "rgb(231, 76, 60)");
                    }
                });
                $('#amountDue').val(0).css("border-color", "#dce4ec");
            }
        </script>
    @endpush

@endsection
