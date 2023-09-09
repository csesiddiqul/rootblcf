@extends('layouts.app')
@section('title', __('Salary Approve'))
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
    .branchSmall {
        font-size: 12px!important;
        color: #10598b!important;
        font-weight: 600!important;
        cursor: pointer;
    }
    .v-middle {
        vertical-align: middle!important;
    }
    table.table-bordered.dataTable >tbody>tr>td.dataTables_empty {
        text-align: center!important;
    }
    table.table-bordered.dataTable td:last-child {
        text-align: left!important;
    }
    .f-600 {
        font-weight: 600!important;
    }

</style>
<link rel="stylesheet" href="{{asset('css/payslip.css')}}">
@endpush
@section('content')
    <div class="container-fluid" id="body">
        <div class="row" id="inner_body">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.sectionbar.payrolls-bar')
                <div class="panel panel-default pt-0">
                    @include('components.sectionbar.payroll-set')
                <div class="panel-body" id="data">

                <div class="container d-none" id="pview">
                    <div class="container">
                     </div>
                    <div style="text-align:center; display:flex; ">
                            <div  style="text-align:right; width: 30%;">
                                <img  id="logo-imgp" src="{{getLogo()}}" alt="{{school('title')}}">
                            </div>


                            <div class="pppttt"  style="text-align:left;">

                                <h4 style="color: #079850!important; margin-bottom:6px;" class="namebn">বাংলাদেশ ল্যাংগুয়েজ এন্ড
                                    কালচারাল ফাউন্ডেশন</h4>

                                <h4 class="nameen"  style="font-family: Myriad Pro;  margin-bottom:6px;  margin-top:3px; color: #079850 !important; font-size:17px; word-spacing: 5px;">
                                    Bangladesh Language and Cultural Foundation
                                </h4>
                                <p id="maincon" class="font_12" style="margin-bottom:6px; font-size:10px; word-spacing: 2px;">23 Chuan Terrace, Lorong Chuan, Singapore 558491 (UEN : TT00SS0212J)</p>
                                <p id="maincon2" style=" font-size:9px; word-spacing: 0.4px;" class="sans">Tel: {{foqas_setting('phone')}} Email: {{foqas_setting('email')}} Website: www.blcf.sg</p>
                            </div>
                        </div>
                    </div>

                        <div class="text-center d-none" id="pview2">
                            <p id="p-title" style="display: inline-block">Payroll For Approval &nbsp;&nbsp; </p>
                        </div>

                        @if(!empty($firstEmployee))
                        <form action="{{ route('payroll.update','approve') }}" method="post" class="form-inline w-100" autocomplete="off" id="form_custom">
                            {{ csrf_field() }}
                            <div class="table-responsive">
                                <input type="hidden" name="id" value="{{ $firstEmployee->employeePayroll->id }}">
                                <table class="table table-bordered" style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                    <tr>
                                        <td>
                                            <b>{{ $schData->payFor == 1 ? "Teacher Name: " : "Employee Name: "  }}</b>
                                            <div style="clear: both;height:8px;"></div>
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
                                                $count_weeks = 1 + ceil(($lastday-7+$firstday)/7);

                                                if($firstEmployee->employeePayroll->weekNumber){
                                                    $count_weeks = $firstEmployee->employeePayroll->weekNumber;
                                                }

                                                /* for total net payable */
                                                $netpayable = $wScale = $exScale = $exNum = $bonus = $arrPay = $bonusfield = 0;

                                                if (isset($firstEmployee->employeeDetail->payScale)) {
                                                    $wScale = $firstEmployee->employeeDetail->payScale;
                                                }

                                                if (isset($firstEmployee->employeeDetail->exScale)) {
                                                    $exScale = $firstEmployee->employeeDetail->exScale;
                                                }

                                                if($firstEmployee->employeePayroll->exNumber > 0){
                                                    $exNum = $firstEmployee->employeePayroll->exNumber;
                                                }

                                                if($firstEmployee->employeePayroll->bonus > 0){
                                                    $bonus = $firstEmployee->employeePayroll->bonus;
                                                    $bonusfield = 1;
                                                }else if($schData->bonus == 1){
                                                    $bonusfield = 1;
                                                }

                                                if($firstEmployee->employeePayroll->arrearsPay > 0){
                                                    $arrPay = $firstEmployee->employeePayroll->arrearsPay;
                                                }else if (isset($firstEmployee->employeeDetail->arrears) && $firstEmployee->employeeDetail->arrears > 0){
                                                    $arrPay = $firstEmployee->employeeDetail->arrears;
                                                }

                                                $netpayable = ($wScale * $count_weeks) + ($exScale * $exNum) + $bonus + $arrPay;
                                            @endphp

                                            <b>Total Weeks:</b>
                                            <div style="clear: both;"></div>
                                            <input type="number" name="weekNumber" value="{{ $count_weeks }}" class="form-control w-100 calculate" id="totalWeeks" placeholder="***" min="0" step="0.5" required>
                                        </td>
                                        <td>
                                            <b>Bonus (S$):</b>
                                            <div style="clear: both;"></div>
                                            <input type="number" name="bonus" value="{{ $bonus }}" {{$bonusfield == 1 ? 'required' : 'readonly'}} class="form-control w-100 calculate" id="bonus" placeholder="0.00" min="0" step="0.5">
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
                                            <input type="number" name="exNumber" value="{{ $exNum }}" class="form-control w-100 calculate" id="totalExclass" placeholder="***" min="0" step="0.5" required >
                                        </td>
                                        <td>
                                            <b>Arrears (S$):</b>
                                            <div style="clear: both;"></div>
                                            @if ($arrPay > 0 )
                                                <input type="hidden" name="arrears" value="{{ $firstEmployee->employeeDetail->arrears }}">
                                                <input type="number" name="arrearsPay" value="{{ $arrPay }}"  class="form-control w-100 calculate" id="arrearsPay" placeholder="0.00" min="0" step="0.5" max="" required>
                                            @else
                                                <input type="hidden" name="arrears" value="0">
                                                <input type="text" name="arrearsPay" value="0"  class="form-control w-100 calculate" id="arrearsPay" placeholder="0.00" readonly min="0" step="0.5" max="10000000">
                                            @endif
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
                                            <input type="number" name="amountPaid" value="{{ $firstEmployee->employeePayroll->amountPaid }}"  class="form-control w-100" id="amountPaid" placeholder="0.00" min="0.00" step="0.01" max="{{ $netpayable }}">
                                        </td>
                                        <td>
                                            <b>Amount Due (S$):</b>
                                            <div style="clear: both;"></div>
                                            <input type="number" name="amountDue" value="{{ $firstEmployee->employeePayroll->amountDue }}"  class="form-control w-100" id="amountDue" placeholder="0.00" readonly min="0" step="0.5">
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
                                            <textarea name="remarks" value="{{ $firstEmployee->employeePayroll->remarks }}" rows="1" class="form-control w-100" id="remarks" placeholder="Write here...">{{ $firstEmployee->employeePayroll->remarks }}</textarea>
                                        </td>
                                        <td id="statusOf">
                                            <b>Salary Status:</b>
                                            <div style="clear: both;height:8px;"></div>
                                            <label class="radio-inline">
                                                <input type="radio" name="status" id="status0" value="1" required>
                                                Approve
                                            </label>
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
                                            <div class="col-sm-offset-4 col-md-offset-4 col-sm-4 col-md-4">
                                                <div class="row">
                                                    <div class="col-sm-6 col-md-6">
                                                        <a href="{{ url('payroll/approve/first') }}" class="btn btn-danger btn-block btn-sm">Cancel</a>
                                                    </div>
                                                    <div class="col-sm-6 col-md-6">
                                                        @if (isset($firstEmployee->employeeDetail->payScale) && $firstEmployee->employeeDetail->payScale > 0 && isset($firstEmployee->employeeDetail->bank_name) && isset($firstEmployee->employeeDetail->account_no))
                                                            <button id="approveBtn" type="submit" class="{{btnClass()}}">@lang('Update') </button>
                                                        @else
                                                            <button id="approveBtn" onClick="confirm('Please Set Weekly Scale, Bank Name & Account No.')" type="button" class="btn btn-warning btn-block btn-sm">@lang('Update') </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                            @php
                                $markid = $firstEmployee->id;
                            @endphp
                        @else
                            @php
                                $markid = '';
                            @endphp
                            @if($pendings->count() < 1)
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ $schData->payFor == 1 ? "Teacher" : "Employee" }} salary statement  for the month of <strong>{{ $schData->payrollMonth ? date('F, Y',strtotime($schData->payrollMonth)) : date('F, Y') }} </strong> is empty!
                            </div>
                            @endif
                        @endif
                        <div class="clearhight"> </div>
                        <div class="table-responsive" id="ovr_cus">
                            @if ($pendings->count() > 0)
                            <button style="width:100px;" class="btn btn-sm btn-success" id="approve" onclick="confirmSubmit()">Approve</button>
                            <button style="width:100px;" onclick="printPage()" id="print" class="btn btn-sm btn-warning">Print</button>
                                @else
                                    &nbsp;
                                @endif
                            <table id="example" class="table datatable table-bordered table-condensed table-striped table-hover" style=" font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                <thead>
                                    <tr class="active" >
                                        <th colspan="6" class="text-center f-600 v-middle" id="cus_tc_name" style="font-size: 20px;">
                                            Salary Statement of {!! $schData->payFor == 1 ? "Teacher" : "Employee" !!}
                                        </th>
                                        <th colspan="6" class="text-center f-600 v-middle"  id="cus_tc_name2" style="font-size: 20px;">
                                            For The Month Of {{ $schData->payrollMonth ? date('F, Y',strtotime($schData->payrollMonth)) : date('F, Y') }}
                                        </th>
                                        {{-- <th colspan="3" class="text-left v-middle">

                                        </th> --}}
                                    </tr>
                                    <tr>
                                        <th>@lang('#')</th>
                                        <th id="cus_head1">{!! $schData->payFor == 1 ? "Teacher&nbsp;Name&nbsp;&<hr style='margin: 1px 0px;'>Branch&nbsp;Name" : "Employee&nbsp;Name&nbsp;&<hr style='margin: 1px 0px;'>Branch&nbsp;Name" !!}</th>
                                        <th id="cus_head2">
                                            Weekly
                                            <div style="clear: both;"></div>
                                            Scale(S$)
                                        </th>
                                        <th id="cus_head3">
                                            Total
                                            <div style="clear: both;"></div>
                                            Weeks
                                        </th>
                                        <th id="cus_head4">{!! ($schData->payFor == 1 ? 'Rate&nbsp;Per <div style="clear: both;"></div> Ex.&nbsp;Class(S$)' : 'Rate&nbsp;Per <div style="clear: both;"></div> Ex.&nbsp;Hour(S$)') !!}</th>
                                        <th id="cus_head5">{!! ($schData->payFor == 1 ? 'Total&nbsp;Ex. <div style="clear: both;"></div> Classes' : 'Total&nbsp;Ex. <div style="clear: both;"></div> Hours') !!}</th>
                                        <th id="cus_head6">@lang('Arrears')</th>
                                        <th id="cus_head7">@lang('Bonus')</th>
                                        <th id="cus_head8">
                                            Net
                                            <div style="clear: both;"></div>
                                            Payable&nbsp;(S$)
                                        </th>
                                        <th id="cus_head9">
                                            Amount
                                            <div style="clear: both;"></div>
                                            Paid&nbsp;(S$)</th>
                                        <th id="cus_head10">
                                            Amount
                                            <div style="clear: both;"></div>
                                            Due&nbsp;(S$)
                                        </th>
                                        <th class="text-left" id="cus_head11" style="min-width: 40px;">
                                            Bank&nbsp;Name
                                            <hr style="margin: 1px 0px;">
                                            Account&nbsp;No.
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($pendings as $key=>$result)
                                    <tr style="{{$result->employee_id == $markid ? 'background-color: #d5d582;' : ''}}">
                                        <td class="v-middle" id="customid" scope="row">{{ $key + 1 }}.</td>
                                        <td id="cus_td" class="v-middle" style="min-width: 130px;padding:0px;">
                                            <a  title="Click & Update/Approve" style="text-decoration: none;padding:5px 5px 0px 5px;display:block; font-size:12px;" href="{{url('payroll/approve/'.$result->payrollUser->student_code.'/'.$result->id)}}">
                                                {{$result->payrollUser->name}}

                                            </a>
                                            <hr style="margin: 1px 0px;border-color:#ddd;">
                                            <a  style="text-decoration: none;padding:0px 5px 5px 5px;display:block;" href="{{url('payroll/approve/'.$result->payrollUser->student_code.'/'.$result->id)}}" class="branchSmall" title="Branch Name">
                                                {!! isset($result->payrollUser->employeeDetail->house) ?$result->payrollUser->employeeDetail->house->name : "N/A" !!}
                                            </a> 
                                        </td>
                                        <td style="min-width: 40px; text-align:right;" class="v-middle">{{ $result->payScale }}</td>
                                        <td style="min-width: 10px; text-align:center;" class="v-middle">{{ $result->weekNumber }}</td>
                                        <td style=" text-align:right;" class="v-middle">{{ $result->exScale }}</td>
                                        <td style="min-width: 20px; text-align:center;" class="v-middle">{{ $result->exNumber }}</td>
                                        <td style="min-width: 40px; text-align:right;" class="text-right v-middle">{{ $result->arrearsPay }}</td>
                                        <td style="min-width: 40px; text-align:right;" class="text-right v-middle">{{ $result->bonus }}</td>
                                        <td style="min-width: 70px; text-align:right;" class="text-right v-middle">{{ $result->netPayable }}</td>
                                        <td style="min-width: 70px; text-align:right;" class="text-right v-middle">{{ $result->amountPaid }}</td>
                                        <td style="min-width: 50px; text-align:right;" class="text-right v-middle">{{ $result->amountDue }}</td>
                                        <td  style="min-width: 30px; text-align:right;">
                                            {{ $result->bank_name }}
                                            <hr style="margin: 1px 0px;">
                                            <small class="branchSmall" title="Account No">
                                                {{ $result->account_no }}
                                            </small>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-right f-600" colspan="8" id="cus_total1"></td>
                                        <td class="text-right f-600" id="cus_total2"></td>
                                        <td class="text-right f-600" id="cus_total3"></td>
                                        <td class="text-right f-600" id="cus_total4"></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
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

                //for data table & sum total
                var table = $('#example').DataTable({
                    'order': [],
                    "footerCallback": function ( row, data, start, end, display ) {
                        var api = this.api(), data;
                        var intVal = function ( i ) {
                            return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0;
                        };

                        var payables = api.column( 8 ).data().reduce( function (a, b) {
                                return intVal(a) + intVal(b);
                            }, 0 );

                        var paid = api.column( 9 ).data().reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                        var due = api.column( 10 ).data().reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                        var payableTotals = parseFloat(payables).toFixed(2);
                        var paidTotals = parseFloat(paid).toFixed(2);
                        var dueTotals = parseFloat(due).toFixed(2);
                        var currency = "S$";

                        $( api.column( 7 ).footer() ).html('Total&nbsp;=');
                        $( api.column( 8 ).footer() ).html(currency + ' '+ payableTotals);
                        $( api.column( 9 ).footer() ).html(currency + ' '+ paidTotals);
                        $( api.column( 10 ).footer() ).html(currency + ' '+ dueTotals);
                        $( api.column( 11 ).footer() ).html('&nbsp;');
                    },
                    paging: false,
                    autoWidth:true,
                    "bDestroy": true
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

            $("#statusOf input[name='status']").change(function(){
                $("#approveBtn").text('Update');
                if(this.value == 1){
                    $("#approveBtn").text('Approve');
                }
            });

            function confirmSubmit() {
                var url = '{{ route("payroll.index.approvenow") }}';
                Swal.fire({
                    title: "Confirmation",
                    text: "Are you sure you want to approve this statement?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "Ok, Approve",
                    cancelButtonText: "Check again!"
                }).then((result) => {
                    if (result.value) {
                        window.location.href = url;
                    }
                })
            }


            //print script//


            function printPage() {
                var body = document.getElementById('body').innerHTML;
                var data = document.getElementById('data').innerHTML;
                document.getElementById('body').innerHTML= data;
                document.getElementById("pview").style.cssText = `display: block; margin-top:50px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;`;
                document.getElementById("pview2").style.cssText = `display: block; margin-top:20px; text-align:center; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font_10 special-box-develop lucida`;
                document.getElementById("print").style.cssText = `display: none;`;
                document.getElementById("approve").style.cssText = `display: none;`;
                document.getElementById("example_filter").style.cssText = `display: none;`;
                document.getElementById("example_info").style.cssText = `display: none;`;
                document.getElementById("example").style.cssText = `font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;`;
                document.getElementById("customid").style.cssText = `width:3%;`;
                document.getElementById("cus_td").style.cssText = `font-size:12px !important; `;
                document.getElementById("cus_tc_name").style.cssText = `font-size:18px !important; font-weight:bold;`;
                document.getElementById("cus_tc_name2").style.cssText = `font-size:18px !important; font-weight:bold;`;
                document.getElementById("cus_head1").style.cssText = `font-size:10px !important; font-weight:bold;`;
                document.getElementById("cus_head2").style.cssText = `font-size:10px !important; font-weight:bold;`;
                document.getElementById("cus_head3").style.cssText = `font-size:10px !important; font-weight:bold;`;
                document.getElementById("cus_head4").style.cssText = `font-size:10px !important; font-weight:bold;`;
                document.getElementById("cus_head5").style.cssText = `font-size:10px !important; font-weight:bold;`;
                document.getElementById("cus_head6").style.cssText = `font-size:10px !important; font-weight:bold;`;
                document.getElementById("cus_head7").style.cssText = `font-size:10px !important; font-weight:bold;`;
                document.getElementById("cus_head8").style.cssText = `font-size:10px !important; font-weight:bold;`;
                document.getElementById("cus_head9").style.cssText = `font-size:10px !important; font-weight:bold;`;
                document.getElementById("cus_head10").style.cssText = `font-size:10px !important; font-weight:bold;`;
                document.getElementById("cus_head11").style.cssText = `font-size:10px !important; font-weight:bold;`;
                document.getElementById("cus_total1").style.cssText = `font-size:11px !important;`;
                document.getElementById("cus_total2").style.cssText = `font-size:11px !important;`;
                document.getElementById("cus_total3").style.cssText = `font-size:11px !important;`;
                document.getElementById("cus_total4").style.cssText = `font-size:11px !important;`;
                document.getElementById("maincon").style.cssText = `margin-bottom:6px; font-size:10px; word-spacing: 2px;`;
                document.getElementById("maincon2").style.cssText = `font-size:9px; word-spacing: 0.9px;`;
                document.getElementById("ovr_cus").style.cssText = `overflow:hidden;`;
                document.getElementById("p-title").style.cssText = ` font-size: 20px; text-align: center; text-transform: uppercase; border: 1px solid #cccccc;  font-weight: 600;  width:90%; margin-left: 50px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:bold;`;
                document.getElementById("logo-imgp").style.cssText = `display: inline-block;
                width: 25% !important; float: right; margin-right:10px; margin-top:10px;`;



                window.print();
                document.getElementById('body').innerHTML= body;
            }

        </script>
    @endpush

@endsection
