<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{$voucher->school['short_name']}} @lang('Money Receipt')</title>
    @empty(foqas_setting('icon'))
        @php $icon = 'storage/img/01/favicon.png'; @endphp
    @else
        @php $icon = foqas_setting('icon'); @endphp
    @endempty
    <link rel="shortcut icon" href="{{icpl_image($icon)}}">
    {{--    <link rel="stylesheet" media="print" href="{{asset('css/accounts-print.css')}}">--}}

</head>
<body>

<style>
    * {
        margin: 0;
        padding: 0;
    }


    .full_con {
        /*display: inline-flex;*/
        list-style-type: none;
        margin: 0 auto;
    }

    .float-left {
        float: left !important;
    }

    .bor_r_d {
        border-right-style: dotted;
        border-right-width: thin;
        margin-right: 10px;
        padding-right: 10px;
    }

    .bor_r_d:first-child {
        padding-right: 80px;
        margin-left: 20px;
    }

    .bor_r_d:last-child {
        margin-left: 80px;
    }

    #page {
        font-size: 15px;
        height: 624px;
        line-height: 18px;
        margin: 0 auto;
        /* width: 317px;*/
        width: 100%;

    }

    .con_margin {
        margin: 5px;
    }

    .con_margin1 {
        margin: 5px !important;

        padding-left: 0px !important;
        padding-right: 0px !important;
    }

    .font_10 {
        font-size: 20.9px;
        margin-top: 20px;
    }

    .font_12 {
        font-size: 8px;
    }
    .font_9_2{
        font-size: 19.2px;
        margin-bottom: 10px;
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
        text-align: right;
    }

    .input {
        border: 1px solid #000;
    }

    .table {
        border-collapse: collapse;
        width: 100%;
    }

    /*.table td:first-child {
        width: 10%;
    }*/
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

    .slip-logo {
        text-align: center !important;
        /*padding: 18px 10px 14px 14px !important;*/
    }

    .slip-content {
        /*float:left;
    */
        /* padding: 0px 0px 10px 0px !important;*/
        width: 100%;
        line-height: 25px;
        text-align: right;
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


    .mt-40 {
        margin-top: 40px;
    }

    .float-right {
        float: right !important;
    }

    .mb-20 {
        margin-bottom: 20px !important;
    }

    .mt-30 {
        margin-top: 30px !important;
    }

    .btn-info {
        background-color: #0077f7 !important;
        color: #fff !important;
    }

    .btn-sm {
        padding: 6px 9px;
        font-size: 13px;
        line-height: 1.5;
        border-radius: 3px;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-outline-primary {
        color: #007bff;
        background-color: transparent;
        background-image: none;
        border-color: #007bff;
    }

    .btn-outline-primary:hover {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-outline-success {
        color: #28a745;
        background-color: transparent;
        background-image: none;
        border-color: #28a745;
        border: 1px solid;
        margin-top: 10px !important;
    }

    .btn-outline-success:hover {
        color: #fff;
        background-color: #28a745;
        border-color: #28a745;
    }

    .namebn {

        font-family: sans-serif;
        color: #079850;
        font-size: 28px !important;
        margin-bottom: 6px;
        padding-top: 40px;
    }

    .namebn, .nameen {
        font-size: 13px;
    }

    .namebn > span {
        font-size: 1.7em;
        float: left;
    }

    .nameen > span {
        font-size: 1.5em;
        float: left;
    }

    @media screen {

        .note_div {
            margin-top: 15px;
        }

        .notes {
            width: 360px;
        }

        .con_margin td, .con_margin th {
            vertical-align: top;
            padding-left: 2px;
            padding-right: 2px;
        }

        .bor_r_d:last-of-type {
            border-right-style: none !important;
        }
    }

    .td_center {
        vertical-align: middle !important;
    }

    .special-box-develop {
        border: 1px solid #cccccc;
        padding: 5px 0px 3px 0px;
        font-weight: 600;
    }

    .pad_left_12 {
        padding-left: 12px;
    }


    .lucida {
        font-family: lucida sans-serif;
    }

    .sans {
        font-family: sans-serif;
    }
    .font_con_2{
        font-size: 31.4px;
        color: #079850;
    }
    a[href]:after {
        display: none;
        visibility: hidden;
    }
    .special-box {
        text-transform: uppercase;
        border: 1px solid #cccccc;
        padding: 5px 20px;
        font-weight: 600;
    }

    @media print {

        /*@page {*/
        /*    size: a4 portrait !important;*/
        /*    margin-top: 0;*/
        /*    margin-bottom: 0;*/

        /*}*/

        @page {
            size: auto;   /* auto is the initial value */
            margin: 5% 10%;
        }

        #btnPrint, .d-print-none {
            display: none !important;
        }
        #backid{
            display: none !important;
        }



    }
</style>

<div class="first_div" style="width: 1025px !important; margin: 0 auto !important;" id="SelectorToPrint">
    <a href="{{url()->previous()}}"
       class="btn btn-outline-success d-print-none float-right btn-sm " id="backid">@lang('Back')</a>
    <button class="printbtn btn  btn-outline-primary btn-sm float-left"
            onclick="window.print()" style="margin-top: 10px !important;"
            role="button" id="btnPrint"><i class="fa fa-print"></i> @lang('Print')
    </button>
    <ul class="full_con">

        <li class="bor_r_d">
            <div id="page">
                <header>
                    <div align="center" class="con_margin">
                        @if (foqas_setting('logo_type') == 1)
                            @php $logo = icpl_image(foqas_setting('express')); @endphp
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
                            @php $logo = icpl_image(foqas_setting('standard')); @endphp
                            @empty($logo)
                                @php $logo = 'https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/icpl.png'; @endphp
                            @endempty
                        @endif
                        <div class="slip-logo">
                            <img class="img-fluid" src="{{$logo}}"
                                 style="width: 16% !important;margin-top: 2px !important;float: left; margin-right: 15px;">
                        </div>
                        <div align="center" class="slip-content">
                            @php
                                $school_name = $voucher->school['name'];
                                $first_value = strtok($school_name," ");
                                $first_value = transMsgOnline($first_value,'bn');
                                $second_value = substr(strstr($school_name, " "), 1);
                            @endphp
                            <h4 class="namebn"> {{$first_value}} ল্যাংগুয়েজ এন্ড
                                কালচারাল ফাউন্ডেশন</h4>
                            @php
                                $school_name = $school_name;
                                $first_value = strtok($school_name," ");
                                $second_value = substr(strstr($school_name, " "), 1);
                            @endphp
                            <h4 class="font_con_2" style="font-family: Myriad Pro;">
                                {{$first_value}} {{$second_value}}</h4>
                            <p class="font_10"> {{$voucher->school['address']}}(UEN : T00SS0212J)</p>
                            <p></p>
                            <p class="font_9_2">Tel: {{foqas_setting('phone')}} Email: {{foqas_setting('email')}}Website: www.blcf.sg</p>
                            <p class="font_10 special-box lucida"
                               style="font-family: sans-serif !important;text-align:center !important;font-size: 18px !important; margin-bottom:8px !important;margin-top:110px !important; text-transform: uppercase;">Internal Transfer</p>
                        </div>
                    </div>
                    <div class="con_margin1">
                        <div class="col-md-12" style="float: left;width: 100%;">
                            <table class="table sans">

                                <tr>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>


                                <tr>
                                    <td width="25%" style="font-weight: bold;">@lang('Voucher No') <span
                                                class="float-right">: </span></td>
                                    <td width="40%" class="border_dot">{{$voucher->voucher_no}}</td>
                                    <td width="15%" style="font-weight: bold;" class="pad_left_12">@lang('Date') <span
                                                class="float-right">: </span></td>
                                    <td class="border_dot">{{date('d-m-Y',strtotime($voucher->date))}}</td>
                                </tr>


                                <tr>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>

                                <tr>
                                    <td width="25%" style="font-weight: bold;"  >@lang('Credit ') <span
                                                class="float-right">: </span></td>
                                    <td width="40%" class="border_dot" style='margin-top: 10px'>
                                        {{$voucher->ledgerCredit->name}}

                                    </td>

                                    <td width="15%" style="font-weight: bold;" class="pad_left_12">@lang('Debit ')
                                        <span class="float-right">: </span>
                                    </td>
                                    <td class="border_dot" style='margin-top: 10px'>
                                        {{$voucher->ledgerDebit->name}}

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>


                                <tr>
                                    <td width="25%" style="font-weight: bold;"  >@lang('Amount Out') <span
                                                class="float-right">: </span></td>
                                    <td width="40%" class="border_dot" style='margin-top: 10px'>
                                        S$ {{number_format($voucher->amount,2)}}
                                    </td>

                                    <td width="15%" style="font-weight: bold" class="pad_left_12">@lang('Amount In')
                                        <span class="float-right">: </span>
                                    </td>
                                    <td class="border_dot" style='margin-top: 10px'>

                                       S$ {{number_format($voucher->amount,2)}}
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>

                                <tr>
                                    <td width="25%" style="font-weight: bold;"  > <span
                                                class="float-right"> </span></td>
                                    <td width="40%"  style='margin-top: 10px'>
                                        &nbsp;
                                    </td>

                                    <td width="15%" style="font-weight: bold" class="pad_left_12">@lang('By')
                                        <span class="float-right">: </span>
                                    </td>
                                    <td class="border_dot" style='margin-top: 10px'>

                                        {{$voucher->user->name}}
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </header>
                <div class="clearfix" style="clear: both;height: 10px; font-size: 15px; margin: 20px 0;"></div>
{{--                <section>--}}
{{--                    <div class="con_margin">--}}
{{--                        <table class="table" border="1" style="font-family: sans-serif !important; font-size:15px;">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>--}}
{{--                                    <center> @lang('SL')</center>--}}
{{--                                </th>--}}

{{--                                <th class="text-right">  @lang('Amount') (S$) &nbsp;</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            <tr>--}}
{{--                                <td>1</td>--}}
{{--                                <td class="text-right">{{number_format($voucher->amount,2)}} &nbsp;</td>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                            <tfoot>--}}
{{--                            <tr>--}}
{{--                                <th class="text-right">@lang('Total :')</th>--}}
{{--                                <th class="text-right">{{number_format($voucher->amount,2)}} &nbsp;</th>--}}
{{--                            </tr>--}}
{{--                            </tfoot>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </section>--}}
                <footer>
                    <div class="con_margin">
{{--                        <div class="sans">--}}
{{--                            In Sum of SG--}}
{{--                            Dollar: {{convertNumber(number_format($voucher->amount,2))}}.--}}
{{--                            --}}{{-- <span style="width: 306px;" class="border_dot"></span>--}}
{{--                        </div>--}}
                        <div class="note_div sans">
                            <strong class="underline">Notes:</strong> <br> <p style="padding-top: 10px;">
                                {{$voucher->description}}
                            </p>
                        </div>
                        {{--<div>
                            Scroll No-
                            <input class="input" value="">
                        </div>
                        --}}
                        <div class="cb"></div>
                        <div class="mt-30 ">
                            @php
                                $headSign = url('img/blcf_stamp.jpg');
                                if (empty($headSign)){
                                    $pad = 0;
                                }else{
                                   $pad = '46px';
                                }
                            @endphp
                            {{--  <div class="float-left" align="center"
                                   style="width: 33%;float: left; padding-top: {{$pad}} !important;">
                                  ----------------------
                                  <div class="clearfix "></div>
                                  <span class="">
                                      @lang('Accountant')
                                  </span>
                              </div>--}}
                            <div class="float-right" align="center" style="width: 34%; float: left;">
                                <img width="50%"
                                     src="{{$headSign}}"
                                     alt="Head Of the Institute">
                                <div class="clearfix"></div>
                                -------------------------
                                <div class="clearfix cb"></div>
                                <span class="sans">
                                        @lang('Authorised Signature')
                                        <br>
                                        @lang('For BLCF')
                                    </span>
                            </div>
                        </div>
                        {{-- <div class= "mt-60">
                            <div class="box1">Student's Signature</div>
                            <div class="box1">Cashier</div>
                            <div class="box1">Officer</div>
                            <div class="cb"></div>
                        </div> --}}
                    </div>
                    <div class="cb"></div>
                    <div class="mt-30 special-box-develop"
                         style="font-family:sans-serif;font-size:12px; text-align: right !important; margin-top: 30px;">
                        <p>Developed by: {{reseller()->name}}. &nbsp;</p>
                    </div>
                </footer>
            </div>
        </li>

    </ul>
</div>
{{--<script type="text/javascript">
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>--}}

</body>
</html>
