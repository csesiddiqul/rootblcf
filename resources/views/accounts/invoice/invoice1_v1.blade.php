<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>@lang('Money Receipt')</title>
    <link rel="stylesheet" media="print" href="">
</head>
<body>

<style>
    .w-10 {
        width: 10%;
    }

    .w-20 {
        width: 20%;
    }

    .w-30 {
        width: 30%;
    }

    .w-40 {
        width: 40%;
    }

    .w-50 {
        width: 50%;
    }

    .w-60 {
        width: 60%;
    }

    .w-70 {
        width: 70%;
    }

    .w-80 {
        width: 80%;
    }

    .w-90 {
        width: 90%;
    }

    .w-100 {
        width: 100%;
    }

    .float-left {
        float: left;
    }

    .float-right {
        float: right;
    }

    .header img {
        float: left;
        margin-right: 5%;
    }

    .header .address h5, .header .address h6 {
        margin: 0px;
    }

    .header .address h5:first-child {
        font-family: 'AdorshoLipi', sans-serif;
        letter-spacing: 1.7px;
    }

    .header .address h5 > span {
        font-size: 1.7em;
        font-style: oblique;
        text-transform: uppercase;
    }

    .header-right {
        margin-top: 15px;
    }

    .header-right span:first-child {
        text-transform: uppercase;
        border: 1px solid #cccccc;
        padding: 5px 20px;
        font-weight: 600;
        float: right;
    }

    .header-sub {
        margin-top: 10px;
    }

    .receipt_number {
        float: right;
        margin-top: 20px;
    }

    .receipt_number strong, .receipt_date strong, .receipt_status strong, .receipt_class strong, .receipt_branch strong {
        border: 1px solid #cccccc;
        padding: 5px 20px;
    }

    .receipt_status {
        margin-right: 30px
    }

    .receipt_branch {
        margin-right: 50px
    }

    .receipt_status::before {
        content: "Status";
        position: absolute;
        margin-top: 23px;
        margin-left: 14px;
        font-style: italic;
    }

    .receipt_class::before {
        content: "Class";
        position: absolute;
        margin-top: 23px;
        margin-left: 14px;
        font-style: italic;
    }

    .receipt_branch::before {
        content: "Branch";
        position: absolute;
        margin-top: 23px;
        margin-left: 14px;
        font-style: italic;
    }

    .main-body table {
        width: 100%;
        border-collapse: collapse;
    }

    .border-bottom-solid {
        border-bottom: 1px solid #000000;
    }

    .border-solid {
        border: 1px solid #000000;
    }

    .td-style {
        text-align: center;
        vertical-align: middle;
    }

    .footer {
        margin-top: 20px;
        display: flow-root;
    }

    .receipt_sign span {
        border-top: 1px solid #000000;
    }

    @media screen {
        .main_div {
            width: 17.5cm;
            margin: 5% 22% 0% 22% !important;
            border: 1px solid #cccccc;
            padding: 2%;
            /* position: absolute;*/
        }
    }

    @media print {
        /* @page {size: portrait}*/
        .main_div {
            width: 17.5cm;
            border: 1px solid #cccccc;
            padding: 2%;
            /*position: absolute;*/
        }

    }
    @page {
        size: A4 portrait!important;
    }
</style>
<link href="https://fonts.maateen.me/adorsho-lipi/font.css" rel="stylesheet">

<div class="main_div" id="SelectorToPrint">
    <div class="w-70 float-left header">
        <img src="{{foqas_setting('express')}}" width="15%" alt="">
        <div class="address">
            @php
                $school_name = school('name');
                $first_value = strtok($school_name," ");
                $first_value = transMsgOnline($first_value,'bn');
                $second_value = substr(strstr($school_name, " "), 1);
            @endphp
            <h5><span>{{$first_value}}</span>&nbsp;&nbsp;&nbsp;&nbsp;ল্যাংগুয়েজে এন্ড কালচারাল ফাউন্ডেশন</h5>
            @php
                $school_name = school('name');
                $first_value = strtok($school_name," ");
                $second_value = substr(strstr($school_name, " "), 1);
            @endphp
            <h5><span>{{$first_value}}</span> {{$second_value}}</h5>
            <h6>{{school('address')}} <em style="font-style: italic;">(UEN : TOO5502I2J)</em></h6>
            <h6>Tel: {{foqas_setting('phone')}}</h6>
            <h6>Email: {{foqas_setting('email')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Website:
                www.blcf.sg</h6>
        </div>
    </div>
    <div class="w-30 float-right header-right">
        <span>Official Receipt</span>
        <br>
        <span class="receipt_number"><b>No.</b><strong>{{date('Ym')}}-0001</strong></span>
    </div>
    <div style="clear: both"></div>
    <div class="w-100 header-sub">
        <span class="receipt_date float-right"><b>Date.</b><strong>{{date('d-m-Y')}}</strong></span>
        <span class="receipt_status float-right"><strong>SC</strong></span>
        <span class="receipt_class float-right"><strong>One</strong></span>
        <span class="receipt_branch float-right"><strong>PPS</strong></span>
    </div>
    <div style="clear: both;height: 40px"></div>
    <div class="w-100 main-body">
        <table cellpadding="4">
            <tr>
                <td width="25%" style="padding-top: 0;">Received From</td>
                <td width="75%" class="border-bottom-solid" colspan="8"
                    style="padding-left: 0;padding-right: 0;padding-top: 0;">
                    <p style="border-bottom: 1px solid; margin-bottom: 0;">Shihab Uddin</p>
                </td>
            </tr>
            <tr>
                <td>Being Payment for</td>
                <td class="border-solid td-style">Members</td>
                <td class="border-solid td-style">$</td>
                <td class="border-solid td-style">Reg Fee</td>
                <td class="border-solid td-style">$</td>
                <td class="border-solid td-style">Books</td>
                <td class="border-solid td-style">$</td>
                <td class="border-solid td-style">Exam Fee</td>
                <td class="border-solid td-style">$125</td>
            </tr>

            <tr>
                <td rowspan="2">Tuition Fee</td>
                <td class="" colspan="8" style="padding-left: 0;">Jan-Apr 2022</td>
            </tr>
            <tr>
                <td class="border-solid td-style">Total Mths</td>
                <td class="border-solid td-style" colspan="2">4</td>
                <td class="border-solid td-style">Per Month</td>
                <td class="border-solid td-style" colspan="2">$ 20</td>
                <td class="border-solid td-style" colspan="2">$ 80</td>
            </tr>
            <tr>
                <td>TOTAL</td>
                <td class="border-bottom-solid" colspan="8">$ 1000</td>
            </tr>
            <tr>
                <td>The Sum of Dollars</td>
                <td class="border-bottom-solid" colspan="8">One thousand dollers only</td>
            </tr>
            <tr>
                <td>Notes</td>
                <td class="border-bottom-solid" colspan="8"></td>
            </tr>
        </table>
        <div class="w-100 footer" align="center">
            <span class="receipt_sign float-right">
                <img src="{{foqas_setting('head_signature')}}" alt="" width="60%">
                <div style="clear: both;height: 10px"></div>
                <span><b>Authorised Signature</b></span>
            </span>
        </div>
    </div>
</div>
<div style="clear: both;height: 40px"></div>
<div class="main_div" id="SelectorToPrint">
    <div class="w-70 float-left header">
        <img src="{{foqas_setting('express')}}" width="15%" alt="">
        <div class="address">
            @php
                $school_name = school('name');
                $first_value = strtok($school_name," ");
                $first_value = transMsgOnline($first_value,'bn');
                $second_value = substr(strstr($school_name, " "), 1);
            @endphp
            <h5><span>{{$first_value}}</span>&nbsp;&nbsp;&nbsp;&nbsp;ল্যাংগুয়েজে এন্ড কালচারাল ফাউন্ডেশন</h5>
            @php
                $school_name = school('name');
                $first_value = strtok($school_name," ");
                $second_value = substr(strstr($school_name, " "), 1);
            @endphp
            <h5><span>{{$first_value}}</span> {{$second_value}}</h5>
            <h6>{{school('address')}} <em style="font-style: italic;">(UEN : TOO5502I2J)</em></h6>
            <h6>Tel: {{foqas_setting('phone')}}</h6>
            <h6>Email: {{foqas_setting('email')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Website:
                www.blcf.sg</h6>
        </div>
    </div>
    <div class="w-30 float-right header-right">
        <span>Official Receipt</span>
        <br>
        <span class="receipt_number"><b>No.</b><strong>{{date('Ym')}}-0001</strong></span>
    </div>
    <div style="clear: both"></div>
    <div class="w-100 header-sub">
        <span class="receipt_date float-right"><b>Date.</b><strong>{{date('d-m-Y')}}</strong></span>
        <span class="receipt_status float-right"><strong>SC</strong></span>
        <span class="receipt_class float-right"><strong>One</strong></span>
        <span class="receipt_branch float-right"><strong>PPS</strong></span>
    </div>
    <div style="clear: both;height: 40px"></div>
    <div class="w-100 main-body">
        <table cellpadding="4">
            <tr>
                <td width="25%" style="padding-top: 0;">Received From</td>
                <td width="75%" class="border-bottom-solid" colspan="8"
                    style="padding-left: 0;padding-right: 0;padding-top: 0;">
                    <p style="border-bottom: 1px solid; margin-bottom: 0;">Shihab Uddin</p>
                </td>
            </tr>
            <tr>
                <td>Being Payment for</td>
                <td class="border-solid td-style">Members</td>
                <td class="border-solid td-style">$</td>
                <td class="border-solid td-style">Reg Fee</td>
                <td class="border-solid td-style">$</td>
                <td class="border-solid td-style">Books</td>
                <td class="border-solid td-style">$</td>
                <td class="border-solid td-style">Exam Fee</td>
                <td class="border-solid td-style">$125</td>
            </tr>

            <tr>
                <td rowspan="2">Tuition Fee</td>
                <td class="" colspan="8" style="padding-left: 0;">Jan-Apr 2022</td>
            </tr>
            <tr>
                <td class="border-solid td-style">Total Mths</td>
                <td class="border-solid td-style" colspan="2">4</td>
                <td class="border-solid td-style">Per Month</td>
                <td class="border-solid td-style" colspan="2">$ 20</td>
                <td class="border-solid td-style" colspan="2">$ 80</td>
            </tr>
            <tr>
                <td>TOTAL</td>
                <td class="border-bottom-solid" colspan="8">$ 1000</td>
            </tr>
            <tr>
                <td>The Sum of Dollars</td>
                <td class="border-bottom-solid" colspan="8">One thousand dollers only</td>
            </tr>
            <tr>
                <td>Notes</td>
                <td class="border-bottom-solid" colspan="8"></td>
            </tr>
        </table>
        <div class="w-100 footer" align="center">
            <span class="receipt_sign float-right">
                <img src="{{foqas_setting('head_signature')}}" alt="" width="60%">
                <div style="clear: both;height: 10px"></div>
                <span><b>Authorised Signature</b></span>
            </span>
        </div>
    </div>
</div>

</body>
</html>


