<!DOCTYPE html>
<!-- saved from url=(0101)https://ipsitacomputers.com/accounts/studententries/printmoneyreceipt/13114/2021-01-24/1/202115-00006 -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>ICPL: Money Receipt</title>
    <link rel="stylesheet" media="print" href="{{asset('css/accounts-print.css')}}">
</head>
<body>

<style>

    * {
        margin: 0;
        padding: 0;
    }


    .full_con {
        display: inline-flex;
        list-style-type: none;
        margin: 0 auto;
    }

    .bor_r_d {
        border-right-style: dotted;
        border-right-width: thin;
        margin-right: 10px;
        padding-right: 10px;
    }

    #page {
        font-size: 12px;
        height: 624px;
        line-height: 18px;
        margin: 0 auto;
        width: 317px;

    }

    .con_margin {
        margin: 5px;
    }

    .font_10 {
        font-size: 10px;
    }

    .font_12 {
        font-size: 12px;
    }

    .font_13 {
        font-size: 14px;
    }

    .fl {
        float: left;
    }

    .fr {
        float: right;
    }

    .cb {
        clear: both;
    }

    .border_dot {
        border-bottom-style: dotted;
        border-bottom-width: thin;
        display: inline-block;
        width: 100%;
    }

    .input {
        border: 1px solid #000;
    }

    .table {
        border-collapse: collapse;
        width: 100%;
    }

    .table td:first-child {
        width: 10%;
    }


    .li li {
        list-style-type: none;
        margin-left: 2px;
    }

    .li div {
        display: inline-table;
        text-align: right;
        width: 15px;
    }

    .box1 {
        box-sizing: border-box;
        width: 33%;
        float: left;
        text-align: center;
    }

    .mar_top25 {
        margin-top: 25px;
    }

    .head_bac {
        background-color: #000;
        border-radius: 10px;
        color: #fff;
        font-weight: bold;
        width: 150px;
    }

    .con_margin td, .con_margin th {
        vertical-align: top;
        padding-left: 2px;
        padding-right: 2px;
    }

    .slip-logo {
        text-align: center !important;
        /*padding: 18px 10px 14px 14px !important;*/
    }

    .slip-content {
        /*float:left;
    */
        padding: 0px 0px 10px 0px !important;
        width: 200px;
    }

    .underline {
        text-decoration: underline;

    }


    .acno {
        border-collapse: collapse;
        border: 1px solid black;
    }

    .acno tr {
        border-collapse: collapse;
        border: 1px solid black;
    }

    .acno tr td {
        border-collapse: collapse;
        border: 1px solid black;
    }

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .bor_r_d:last-of-type {
        border-right-style: none !important;
    }

    .mt-60 {
        margin-top: 60px;
    }


</style>

<div class="first_div" style="width: 1025px !important; margin: 0 auto !important;" id="SelectorToPrint">
    <button class="printbtn btn  btn-success  "
            onclick="printDiv('SelectorToPrint')" style="margin-top: 10px !important;"
            role="button" id="btnPrint"><i class="fa fa-print"></i> @lang('Print')
    </button>
    <ul class="full_con">
        @for($j = 0;$j< foqas_setting('invoice_copy');$j++)
            <li class="bor_r_d">
                <div id="page">
                    <header>
                        <div align="center" class="con_margin">
                            @if (foqas_setting('logo_type') == 1)
                                @php $logo = foqas_setting('express'); @endphp
                                @empty($logo)
                                    @php $logo = 'https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/favicon.png'; @endphp
                                @else
                                    <style>
                                        .img-fluid {
                                            width: 70% !important;
                                        }
                                    </style>
                                @endempty
                            @else
                                <style>
                                    .imga {
                                        width: 210px
                                    }

                                    .img-fluid {
                                        width: 100% !important;
                                        height: 40px;
                                    }
                                </style>
                                @php $logo = foqas_setting('standard'); @endphp
                                @empty($logo)
                                    @php $logo = 'https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/icpl.png'; @endphp
                                @endempty
                            @endif
                            <div class="slip-logo">
                                <img class="img-fluid" src="{{$logo}}"
                                     style="width: 20% !important;margin-top: 2px !important;">
                            </div>
                            <div align="center" class="slip-content">
                                <p class="font_10"
                                   style="font-size: 14px !important; margin-bottom:8px !important;">{{$invoiceType[$j]}}</p>
                                <h3 style="font-family: Myriad Pro;"><b>{{$invoice->school['name']}}</b></h3>
                                <p class="font_12 underline"><b>{{$invoice->school['address']}}</b></p>
                            </div>

                        </div>
                        <div class="con_margin">
                            <!--<div>
                                Student Name:
                                <span style="width: 202px;" class="border_dot">UMME AFSANA TURNA </span>
                            </div>
                            -->
                            <div>
                                <div class="fl">
                                    Date:
                                    <span class="border_dot date_width"
                                          style="width: 103px;">{{$invoice->created_at->format('d-m-Y')}} </span>
                                </div>
                                <div class="fl">
                                    MR: <span class="reciept_width border_dot"
                                              style="width: 103px;">{{$invoice->reciept_number}}</span>
                                </div>

                                <div class="cb"></div>
                            </div>
                            <div>
                                <div class="fl">
                                    <span class="nms_width" style="width: 80px; display: block; float:left;"> @lang('Student Name'): </span>
                                    <span class="stdnt_name border_dot"
                                          style="width: 202px;">{{$invoice->student['name']}}</span>
                                </div>
                                <div class="fl">
                                    <span class="nms_width"
                                          style="width: 80px; display: block; float:left;"> @lang('Class'): </span>
                                    <span class="class_name border_dot"
                                          style="width: 61px;">{{$invoice->student->section->class['name']}}</span>
                                </div>
                                <div class="fl">
                                    <span class="nms_width"
                                          style="width: 80px; display: block; float:left;"> @lang('Section'): </span>
                                    <span class="section_width border_dot"
                                          style="width: 200px;">{{$invoice->student->section['section_number']}} </span>
                                </div>
                                <div class="fl">
                                    Student ID:
                                    <span class="stdnt_code border_dot"
                                          style="width: 100px;">{{$invoice->student['student_code']}}</span>
                                </div>
                                <div class="fl">
                                    Session:
                                    <span class="session_width border_dot" style="width: 65px;">
							@isset($invoice->student->studentInfo)
                                            {{getSessionById($invoice->student->studentInfo['session'],'schoolyear')}}
                                        @endisset
						</span>
                                </div>
                                <div class="cb"></div>
                            </div>
                            <div>
                                {{--<div class="fl">
                                    Shift:
                                    <span style="width: 144px;" class="border_dot"></span>
                                </div>
                                --><!--<div class="fl">
							Date:
							<span style="width: 103px;" class="border_dot">2021-01-24</span>
						</div>
						--}}
                                <div class="cb"></div>
                            </div>
                            <div>
                                <br>
                            </div>
                            {{--<div>
                                <b>Savings Ledger No- </b>
                                <input class="input" value="">
                            </div>
                        --}}</div>
                    </header>
                    <section>
                        <div class="con_margin">
                            <table class="table" border="1" style="font-family:Lucida sans;font-size:12px;">
                                <thead>
                                <tr>
                                    <th>
                                        <center> @lang('SL')</center>
                                    </th>
                                    <th>
                                        <center> @lang('Description')</center>
                                    </th>
                                    <th>
                                        <center> @lang('Taka')</center>
                                    </th>
                                    <th>
                                        <center> @lang('Waiver')</center>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; ?>
                                @foreach($invoice->paymentDetail as $in)
                                    <tr>
                                        <td class="text-center">{{$i++}}</td>
                                        <td>{{$in->due->fee->account_sector["name"]}}</td>
                                        <td class="text-right">{{number_format($in["amount"],2)}}</td>
                                        <td class="text-right">{{number_format($in["waiver"],2)}}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2">@lang('Sub Total')</td>
                                    <td class="text-right">{{number_format($invoice->total-$invoice->waiver,2)}}</td>
                                    <td class="text-right">{{number_format($invoice->waiver,2)}}</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="2">@lang('Total Paid')</th>
                                    <th colspan="2"
                                        class="text-right">{{number_format($invoice->total-$invoice->waiver,2)}}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </section>
                    <footer>
                        <div class="con_margin">
                            <div>
                                In Words: {{convertNumber($invoice->total-$invoice->waiver.'.00')}}. <span
                                        style="width: 256px;" class="border_dot"></span>
                            </div>
                            <!--<div>
                                Scroll No-
                                <input class="input" value="">
                            </div>
                            -->
                            <div class="mt-60">
                                <div class="box1">@lang("Student's Signature")</div>
                                <div class="box1">@lang('Cashier')</div>
                                <div class="box1">@lang('Officer')</div>
                                <div class="cb"></div>
                            </div>
                        </div>
                        <div style="font-family:Lucida sans;font-size:10px; text-align: center !important;">
                            <p>Developed by: {{reseller()->name}}</p>
                        </div>
                    </footer>
                </div>
            </li>
        @endfor

    </ul>
</div>

<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
</body>
</html>


