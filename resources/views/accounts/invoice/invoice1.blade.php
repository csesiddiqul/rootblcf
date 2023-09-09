<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>{{$invoice->school['short_name']}} @lang('')</title>
    {{--    <link rel="stylesheet" media="print" href="{{asset('css/accounts-print.css')}}">--}}
</head>
<body>

<style>
    @media print {
        /*@page {*/
        /*    size: A4 portrait!important;*/
        /*    padding-top:210px;*/
        /*    padd-bottom: 210px;*/
        /*}*/

        @page {
            size:  A4 portrait;   /* auto is the initial value */
            margin: auto;
        }



    }

    * {
        margin: 0;
        padding: 0;
    }


    .full_con {

        list-style-type: none;
        margin: 0 auto;
    }

    .float-left {
        float: left !important;
    }

    .bor_r_d {

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
        height: 520px;
        line-height: 18px;
        margin: 0 auto;
        /* width: 317px;*/
        width: 100%;

    }

    .con_margin {
        margin: 25px 0;
    }

    .con_margin1 {
        margin: 5px !important;

        padding-left: 0px !important;
        padding-right: 0px !important;
    }

    .font_10 {
        font-size: 10px;
    }

    .font_con_2 {
        font-size: 20.9px;
        margin-top: 20px;

    }
    .font_con {
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
        width: 104%;
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
        padding-right:4px !important ;
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
        font-family:sans-serif;
        color: #079850;
        font-size: 28px !important;
        margin-bottom: 6px;
        padding-top: 40px;
    }

    .namebn, .nameen {
        font-size: 31.5px;
        color: #079850;
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
        .special-box {
            text-transform: uppercase;
            /*border: 1px solid #cccccc;*/
            padding: 5px 20px;
            font-weight: 600;
            width: 100% !important;
        }

        .note_div {
            margin-top: 15px;
        }

        .notes {
            width: 360px;
        }

        .con_margin td, .con_margin th {
            vertical-align: top;
            padding-left: 2px;
            padding-right: 2px !important;
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
        font-family:sans-serif ;
    }

    .sans {
        font-family: sans-serif;
    }
</style>
{{--<link href="https://fonts.maateen.me/adorsho-lipi/font.css" rel="stylesheet">--}}
<div class="first_div" style="width: 1050px !important; margin:0 auto;" >
    <div id="SelectorToPrint" style="margin-right: 70px;">
        <div id ='backid'>
            @auth
                <a href="{{url()->previous()}}"
                   class="btn btn-outline-success d-print-none float-right btn-sm ">@lang('Back')</a>
            @else
                <a href="{{route('pay_online')}}"
                   class="btn btn-outline-success d-print-none float-right btn-sm ">@lang('Back')</a>
            @endauth
        </div>
        <button class="printbtn btn  btn-outline-primary btn-sm float-left"
                onclick="myFunction()" style="margin-top: 10px !important;"
                role="button" id="btnPrint"><i class="fa fa-print"></i> @lang('Print')
        </button>
        <ul class="full_con">
            @for($j = 0;$j< foqas_setting('invoice_copy');$j++)
                <li class="bor_r_d">

                    <header>
                        <div id="page">

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

                                <div style="display:flex; margin-left: 35px;">
                                    <div class="slip-logo" style="justify-content:right; width:15%; margin-top: 32px;">
                                        <img class="img-fluid" src="{{$logo}}"
                                             style="width: 70% !important; margin-left: 40px; margin-top: 3px;">
                                    </div>
                                    <div style="justify-content: left; width:85%; line-height: 24px;" class="slip-content">
                                        @php
                                            $school_name = $invoice->school['name'];
                                            $first_value = strtok($school_name," ");
                                            $first_value = transMsgOnline($first_value,'bn');
                                            $second_value = substr(strstr($school_name, " "), 1);
                                        @endphp
                                        <h4 class="namebn">{{$first_value}} ল্যাংগুয়েজ এন্ড
                                            কালচারাল ফাউন্ডেশন<i class="fa fa-map-marker" aria-hidden="true"></i></h4>
                                        @php
                                            $school_name = $school_name;
                                            $first_value = strtok($school_name," ");
                                            $second_value = substr(strstr($school_name, " "), 1);
                                        @endphp
                                        <h4 class="nameen" style="font-family: Myriad Pro;">
                                            {{$first_value}} {{$second_value}}</h4>
                                        <p class="font_con_2">{{$invoice->school['address']}}(UEN : T00SS0212J)</p>
                                        <p class="font_con">Tel:{{foqas_setting('phone')}} Email: {{foqas_setting('email')}}
                                            Website: www.blcf.sg </p>


                                    </div>
                                </div>
                                <p id="mymr" class="font_10 special-box-develop lucida"
                                   style="text-align: center; margin-bottom:8px !important; margin-left:28px; width:100%; margin-top: 110px !important; font-size: 28px; text-transform: uppercase; "><span class="lucida" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:bold;">Money Receipt</span><br>
                                    <!--<span style="font-size: 10px">({{$invoiceType[$j]}}
                                    )</span>-->
                                </p>
                            </div>
                            <div class="con_margin1" >
                                <div class="col-md-12" style="float: left; width: 100%;  margin-left:25px; ">
                                    <table class="table sans" style="font-size: 20px; line-height: 26px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                        <tr>
                                            <td width="25%">@lang('MR No') <span
                                                        class="float-right">: </span></td>
                                            <td width="40%" class="border_dot">{{$invoice->reciept_number}}</td>
                                            <td width="20%" class="" style="padding-left: 75px;">@lang('Date') <span
                                                        class="float-right">: </span></td>
                                            <td class="border_dot">{{date('d-m-Y',strtotime($invoice->trans_date))}}</td>
                                        </tr>
                                        @if($invoice->student->role == 'student')
                                            <tr>
                                                <td style="">@lang('Student ID') <span
                                                            class="float-right">: </span></td>
                                                <td class="border_dot">{{$invoice->student['student_code']}}</td>
                                                <td class=""  style="padding-left: 75px;">@lang('Session') <span
                                                            class="float-right">: </span></td>
                                                <td class="border_dot">@isset($invoice->student->studentInfo)
                                                     {{getSessionById($invoice->student->studentInfo['session'],'schoolyear')}}

                                                   {{--        {{\Illuminate\Support\Str::limit($invoice->reciept_number,4)}}--}}


                                                    @endisset</td>
                                            </tr>
                                            @php $cName = school('country')->code == 'SG' ? 'Class' : 'Grade'; @endphp
                                            <tr>
                                                <td>@lang($cName) <span
                                                            class="float-right"> : </span></td>
                                                <td class="border_dot">{{$invoice->student->section->class['name']}} - {{$invoice->student->section['section_number']}}</td>

                                                <td class=""  style="padding-left: 75px;">@lang('Roll') <span
                                                            class="float-right">: </span></td>
                                                <td class="border_dot">{{$invoice->student->studentInfo['class_roll']}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('Status') <span
                                                            class="float-right"> : </span></td>
                                                <td colspan="3" class="border_dot">{!! residentstatus($invoice->student->studentInfo['singaporepr'],true) !!}</td>

                                                <td class=""  style="padding-left: 75px;">@lang('Branch') <span
                                                            class="float-right">: </span></td>

                                                <td class="border_dot">{{$invoice->student->studentInfo->house['name'] ?? 'N/A'}}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>@lang('Received From')
                                                <span class="float-right">: </span></td>
                                            <td class="border_dot"  style="text-transform: uppercase; font-size: 14px" colspan="3"><b>{{$invoice->student['name']}}</b></td>
                                        </tr>
                                    </table>
                                </div>
                                {{--   <div class="col-md-4 float-right">

                                       <table class="table  ">
                                           <tr>
                                               <td>@lang('Date') <span
                                                           class="float-right">: </span></td>
                                               <td class="border_dot">{{date('d-m-Y',strtotime($invoice->trans_date))}}</td>
                                           </tr>
                                           <tr>
                                               <td>@lang('Session') <span
                                                           class="float-right">: </span></td>
                                               <td class="border_dot">@isset($invoice->student->studentInfo)
                                                       {{getSessionById($invoice->student->studentInfo['session'],'schoolyear')}}
                                                   @endisset</td>
                                           </tr>
                                           <tr>
                                               <td>@lang('Roll') <span
                                                           class="float-right">: </span></td>
                                               <td class="border_dot">{{$invoice->student->studentInfo['class_roll']}}</td>
                                           </tr>
                                           <tr>
                                               <td>@lang('Status') <span
                                                           class="float-right">: </span></td>
                                               <td colspan="3" class="border_dot">{!! residentstatus($invoice->student->studentInfo['singaporepr'],true) !!}</td>
                                           </tr>
                                       </table>
                                   </div>--}}
                            </div>
                    </header>
                    <div class="clearfix" style="clear: both;height: 10px"></div>
                    <section>
                        <div class="con_margin my-5">
                            <table class="table" border="1" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:18px; margin-left:28px; line-height: 30px;">
                                <thead>
                                <tr>
                                    <th>
                                        <center> @lang('SL')</center>
                                    </th>
                                    <th>
                                        <center> @lang('DESCRIPTION')</center>
                                    </th>
                                    @foreach($invoice->paymentDetail as $in)
                                        @if(str_replace(' ','',strtolower($in->due->fee->account_sector["name"])) ==  'tuitionfees' || 'tuitionfee' || 'tuitionad')
                                            <th>
                                                <center> @lang('MONTHS')</center>
                                            </th>
                                            @break
                                        @endif
                                    @endforeach
                                    <th>
                                        <center> @lang('RATE (S$)')</center>
                                    </th>
                                    <th>
                                        <center> @lang('WAIVER')</center>
                                    </th>
                                    <th>
                                        <center> @lang('TOTAL (S$)')</center>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;$isTuitionFee = false;$isTuitionCount = $tuitionAm = $tuitionWv = $tuitionTotal = 0;$headArray = [] ?>
                                @foreach($invoice->paymentDetail as $in)
                                    @php $tuitionHead = str_replace(' ','',strtolower($in->due->fee->account_sector["name"])); @endphp
                                    @if($tuitionHead ==  'tuitionfees' || $tuitionHead == 'tuitionfee' || $tuitionHead == 'tuitionad')
                                        @php $tuitionAm+= $in->amount+$in->waiver; $tuitionWv+= $in->waiver; $tuitionTotal =$tuitionAm-$tuitionWv @endphp
                                    @endif
                                @endforeach
                                @foreach($invoice->paymentDetail as $in)
                                    @php $tuitionHead = str_replace(' ','',strtolower($in->due->fee->account_sector["name"])); @endphp
                                    @if($tuitionHead ==  'tuitionfees'|| $tuitionHead == 'tuitionfee'||  $tuitionHead == 'tuitionad')
                                        @php $isTuitionFee=true;$isTuitionCount+=1; @endphp
                                    @else
                                        @php $isTuitionFee=false;$isTuitionCount = 0 @endphp
                                    @endif
                                    @if(!in_array($tuitionHead,$headArray))
                                        @php array_push($headArray,$tuitionHead) @endphp

                                        <tr>
                                            <td @if($isTuitionFee) rowspan="2" class="td_center text-center"
                                                @else class="text-center" @endif>{{$i++}}</td>
                                            <td @if($isTuitionFee) rowspan="2" class="td_center pl-1"
                                                @else colspan="2" @endif>&nbsp;{{$in->due->fee->account_sector["name"]}}</td>
                                            @if($isTuitionFee)
                                                <td class="text-center">

                                                    @if($in->month == 1)
                                                        {{$in->month}} Month
                                                    @else
                                                        {{$in->month}} Months
                                                    @endif
                                                </td>

                                            @endif
                                            <td @if($isTuitionFee) rowspan="2" class="td_center text-right mr-3"
                                                @else class="text-right" @endif>{{number_format( $in["amount"],2)}} @if($isTuitionFee) * @endif {{$in->month}} </td>



                                            <td class="{{number_format($isTuitionFee ? $tuitionWv : $in["waiver"],2) == 0?'text-center':'text-right'}}" @if($isTuitionFee) rowspan="2" class="td_center text-right" @else class="text-right" @endif>

                                                @if(number_format($isTuitionFee ? $tuitionWv : $in["waiver"],2) == 0)
                                                    <span>
                                                            {{'--'}}
                                                      </span>
                                                @else
                                                    <span>
                                                            {{number_format($isTuitionFee ? $tuitionWv : $in["waiver"],2)}}
                                                        </span>

                                                @endif
                                            </td>


                                            <td @if($isTuitionFee) rowspan="2" class="td_center text-right"
                                                @else class="text-right" @endif>{{number_format($isTuitionFee ? $tuitionTotal : ($in["amount"]),2)}}</td>
                                        </tr>
                                        @if($isTuitionFee)
                                            <tr>
                                                <td class="text-center">
                                                    {{--                                                    @php--}}
                                                    {{--                                                        $dates = explode('-',$in->month_des);--}}
                                                    {{--                                                        print_r($dates);--}}
                                                    {{--                                                    @endphp--}}
                                                    {{$in->month_des}}
                                                    <br>


                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-right">@lang('Sub Total : ')</td>
                                    <td class="text-right">{{number_format($invoice->total,2)}}</td>

                                    @if(number_format($invoice->waiver,2) == 0)
                                        <td class="text-center">
                                            {{'--'}}
                                        </td>
                                    @else
                                        <td class="text-right">
                                            {{number_format($invoice->waiver,2)}}
                                        </td>
                                    @endif

                                    <td class="text-right">{{number_format($invoice->total-$invoice->waiver,2)}}</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">@lang('Grand Total : ')</th>
                                    <th colspan="3"
                                        class="text-right">S${{number_format($invoice->total-$invoice->waiver,2)}}</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </section>
                    <footer>
                        <div class="con_margin">
                            <div class="sans" style="margin-left: 30px; font-size: 20px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; text-transform: capitalize">
                                In Sum of S$ :
                                {{convertNumberNEW(number_format($invoice->total-$invoice->waiver,2))}} {{convertdesi(extractFraction($invoice->total-$invoice->waiver))}} Only.

                                {{-- <span style="width: 306px;" class="border_dot"></span>--}}
                            </div>
                            <div class="note_div sans" style="margin-left: 30px; font-size: 20px; margin-top: 35px;">
                                <strong class="underline">Notes:</strong><br> <p style="margin-top: 15px">
                                    {{$invoice->remark}}
                                </p>
                            </div>
                            {{--<div>
                                Scroll No-
                                <input class="input" value="">
                            </div>
                            --}}
                            <div class="cb"></div>
                            <div class="mt-30 " style="margin-left: 30px; margin-left: 30px; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
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
                                <div class="float-right" align="center" style="width: 34%; float: left; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                    <img width="50%"
                                         src="{{$headSign}}"
                                         alt="Head Of the Institute">
                                    <div class="clearfix"></div>
                                    -------------------------
                                    <div class="clearfix cb"></div>
                                    <span class="sans" style="font-size: 18px;">
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
                             style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:15px; text-align: left !important; margin-top: 30px; margin-left: 30px;  width: 100%;">
                            <p>Developed by:  IPSITA COMPUTERS PTE LTD <!--{{reseller()->name}}-->.</p>
                        </div>
                    </footer>
    </div>
    </li>
    @endfor
    </ul>
</div>
</div>
{{--<script type="text/javascript">--}}
{{--    function printDiv(divName) {--}}
{{--        var printContents = document.getElementById(divName).innerHTML;--}}
{{--        var originalContents = document.body.innerHTML;--}}
{{--        document.body.innerHTML = printContents;--}}
{{--        window.print();--}}
{{--        document.body.innerHTML = originalContents;--}}
{{--    }--}}
{{--</script>--}}

<script>

    //print script//

    function myFunction() {

        const myElement = document.getElementById("btnPrint");
        myElement.style.display = "none";
        const myElemen = document.getElementById("mymr");
        myElemen.style.textTransform = "uppercase";
        const myEleme = document.getElementById("backid");
        myEleme.style.display = "none";

        window.print()
    }


</script>

</body>
</html>
