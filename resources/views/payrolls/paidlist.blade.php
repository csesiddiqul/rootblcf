@extends('layouts.app')
@section('title', __('Salary Statement'))
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
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.sectionbar.payrolls-bar')
                <div class="panel panel-default pt-0">
                    @include('components.sectionbar.payroll-paid')
                    <div class="panel-body pt-5" id="data">
                        <div class="container d-none" id="pview" >

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
                            <p id="p-title" style="display: inline-block">Payroll Statement &nbsp;&nbsp; </p>
                        </div>

                        <div class="table-responsive">
                            <table id="example" class="table datatable table-bordered table-condensed table-striped table-hover" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                <thead>
                                    <tr class="active">
                                        <th colspan="3" class="text-center f-600 v-middle">
                                            Salary Statement of {!! $ids == 1 ? "Teacher" : "Employee" !!}
                                        </th>
                                        <th colspan="6" class="text-center f-600 v-middle">
                                            For The Month Of
                                            {{ $form_val ? date('F, Y',strtotime($form_val)) : date('F, Y') }}

                                            @if(!empty($to_val) && date('Y-m',strtotime($form_val)) != date('Y-m',strtotime($to_val)))
                                                To {{ date('F, Y',strtotime($to_val)) }}
                                            @endif
                                        </th>
                                        <th colspan="3" class="text-left v-middle">
                                            @if ($paidlists->count() > 0)
                                                ----
                                            @else
                                                &nbsp;
                                            @endif
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>@lang('#')</th>
                                        <th>{!! $schData->payFor == 1 ? "Teacher&nbsp;Name&nbsp;&<hr style='margin: 1px 0px;'>Branch&nbsp;Name" : "Employee&nbsp;Name&nbsp;&<hr style='margin: 1px 0px;'>Branch&nbsp;Name" !!}</th>
                                        <th>
                                            Weekly
                                            <div style="clear: both;"></div>
                                            Scale(S$)
                                        </th>
                                        <th>
                                            Total
                                            <div style="clear: both;"></div>
                                            Weeks
                                        </th>
                                        <th>{!! ($schData->payFor == 1 ? 'Rate&nbsp;Per <div style="clear: both;"></div> Ex.&nbsp;Class(S$)' : 'Rate&nbsp;Per <div style="clear: both;"></div> Ex.&nbsp;Hour(S$)') !!}</th>
                                        <th>{!! ($schData->payFor == 1 ? 'Total&nbsp;Ex. <div style="clear: both;"></div> Classes' : 'Total&nbsp;Ex. <div style="clear: both;"></div> Hours') !!}</th>
                                        <th>@lang('Arrears')</th>
                                        <th>@lang('Bonus')</th>
                                        <th>
                                            Net
                                            <div style="clear: both;"></div>
                                            Payable&nbsp;(S$)
                                        </th>
                                        <th>
                                            Amount
                                            <div style="clear: both;"></div>
                                            Paid&nbsp;(S$)</th>
                                        <th>
                                            Amount
                                            <div style="clear: both;"></div>
                                            Due&nbsp;(S$)
                                        </th>
                                        <th class="text-left">
                                            Bank&nbsp;Name
                                            <hr style="margin: 1px 0px;">
                                            Account&nbsp;No.
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($paidlists as $key=>$result)
                                    <tr>
                                        <td class="v-middle" scope="row">{{ $key + 1 }}</td>
                                        <td class="v-middle" style="min-width: 200px;padding:0px;">
                                            <a title="View & Print Payslip" style="text-decoration: none;padding:5px 5px 0px 5px;display:block;" href="{{url('payroll/payslip/'.$result->id."-".$result->payrollUser->student_code)}}">
                                                {{$result->payrollUser->name}}
                                            </a>
                                            <hr style="margin: 1px 0px;border-color:#ddd;">
                                            <a style="text-decoration: none;padding:0px 5px 5px 5px;display:block;" href="{{url('payroll/payslip/'.$result->id."-".$result->payrollUser->student_code)}}" class="branchSmall" title="Branch Name">
                                                {!! isset($result->payrollUser->employeeDetail->house) ?$result->payrollUser->employeeDetail->house->name : "N/A" !!}
                                            </a>
                                        </td>
                                        <td class="v-middle">{{ $result->payScale}}</td>
                                        <td class="v-middle">{{ $result->weekNumber }}</td>
                                        <td class="v-middle">{{ $result->exScale}}</td>
                                        <td class="v-middle">{{ $result->exNumber }}</td>
                                        <td class="text-right v-middle">{{ $result->arrearsPay }}</td>
                                        <td class="text-right v-middle">{{ $result->bonus }}</td>
                                        <td class="text-right v-middle">{{ $result->netPayable }}</td>
                                        <td class="text-right v-middle">{{ $result->amountPaid }}</td>
                                        <td class="text-right v-middle">{{ $result->amountDue }}</td>
                                        <td style="min-width: 200px;">
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
                                        <td class="text-right f-600" colspan="8"></td>
                                        <td class="text-right f-600"></td>
                                        <td class="text-right f-600"></td>
                                        <td class="text-right f-600"></td>
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
                document.getElementById("example_filter").style.cssText = `display: none;`;
                    document.querySelectorAll('a[href]').forEach(function(a) {
    	a.removeAttribute("href");
    });
                document.getElementById("pview").style.cssText = `display: block; margin-top:50px;`;
                document.getElementById("pview2").style.cssText = `display: block;`;
                // document.getElementById("customid").style.cssText = `width:2%;`;
                document.getElementById("p-title").style.cssText = ` font-size: 20px; text-align: center; text-transform: uppercase; border: 1px solid #cccccc;  font-weight: 600; margin-top:20px;  width:90%; margin-left: 35px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:bold;`;
                document.getElementById("maincon").style.cssText = `margin-bottom:6px; font-size:10px; word-spacing: -3px;`;
                document.getElementById("maincon2").style.cssText = `font-size:9px; word-spacing: -1px;`;
                document.getElementById("logo-imgp").style.cssText = `display: inline-block;
                width: 25% !important; float: right; margin-right:10px; margin-top:10px;`;
                window.print();
                document.getElementById('body').innerHTML= body;
            }


        </script>
    @endpush

@endsection
