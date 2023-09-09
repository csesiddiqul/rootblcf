@extends('layouts.app')
@section('title', __('Due Reports'))
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
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Due Report').'<b>'])
                @include('components.sectionbar.reports-bar')
                <div class="panel-body">
                    <div class="col-md-12 pl-0">
                        {!! Form::open(array('route' => 'accounts.duereport', 'method' => 'POST', 'role' =>'form','enctype'=>'multipart/form-data', 'class' => 'needs-validation')) !!}
                        <div class="form-group col-md-3">
                            {!! Form::label('section', trans('Section'), ['class' => 'control-label']) !!}
                            {!! Form::select('section', $pluckSection , $section?? null , ['class' => 'select2 form-control','required','placeholder'=>'Choose']) !!}
                            @error('section')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3">
                            <label for="head">@lang('Head')</label>
                            {!! Form::select('type',$head,$type?? null, array('id' => 'type', 'class' => 'select2 form-control','required', 'placeholder' => trans('Choose'))) !!}
                            @error('type')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="date">@lang('From')</label>
                            {!! Form::text('from', $from ?? date('01-m-Y'), array('id' => 'date', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
                            @error('from')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2">
                            <label for="date">@lang('To')</label>
                            {!! Form::text('to', $to ?? date('t-m-Y'), array('id' => 'date', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
                            @error('to')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group col-md-2 mt-28 ">
                            <button type="submit" id="admitButton" class="{{btnClass()}}">
                                @lang('Search')
                            </button>
                        </div>
                        @if (isset($dues) && $dues->count())
                            <div class="col-md-1 mt-25">
                                <span class="btn btn-default btn-sm pull-right"
                                      onclick="printDiv()">@lang('Print')</span>
                            </div>
                        @endif
                        <div class="clearhight50"></div>
                        {!! Form::close() !!}
                    </div>
                    <div class="clearfix"></div>
                    @isset($dues)
                        <div id="printDiv">
                            @if($dues && $dues->count())
                            
                            <div class="clearfix"></div>
               
                           

                    



                            <center class="d-print-block ">
                                <!-- School Name -->
                                <div class="mydiv" id="datacenter" style="text-align:center; display:flex; ">
                                    <div class="logo" id="logodemo"  style="text-align:right; width: 30%; display:none;">
                                        @if (foqas_setting('logo_type') == 1)
                                            @php $logo = icpl_image(foqas_setting('express')); @endphp
                                            @empty($logo)
                                                @php $logo = 'https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/favicon.png'; @endphp
                                            @else
                                            @endempty
                                        @else
                                            @php $logo = icpl_image(foqas_setting('standard')); @endphp
                                            @empty($logo)
                                                @php $logo = 'https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/icpl.png'; @endphp
                                            @endempty
                                        @endif
                                        <img class="imgpri" style="width: 25% !important; margin-top:10px; margin-right:10px;" src="{{$logo}}" alt="Logo">
                                    </div>
                                
                                <div class="pppttt" id="schoolHeader"  style="text-align:left; display:none;">
                                    @php

                                            @endphp
                                    <h4 style="color: #079850!important; margin-bottom:6px;" class="namebn">বাংলাদেশ ল্যাংগুয়েজ এন্ড
                                        কালচারাল ফাউন্ডেশন</h4>

                                    <h4 class="nameen" id="schoolengName"  style="font-family: Myriad Pro;  margin-bottom:6px;  margin-top:3px; color: #079850 !important; font-size:17px; word-spacing: 4px;">
                                        Bangladesh Language and Cultural Foundation
                                    </h4>
                                    <p id="maincon" class="font_12" style="margin-bottom:6px; font-size:11px; word-spacing: -3.8px;">23 Chuan Terrace, Lorong Chuan, Singapore 558491 (UEN : T00SS0212J)</p>
                                    <p id="maincon2" style=" font-size:10px; word-spacing: -2.3px;" class="sans">Tel: {{foqas_setting('phone')}} Email: {{foqas_setting('email')}} Website: www.blcf.sg</p>
                                </div>
                            </center>

                                <p id="mymr" class="font_10 special-box-develop lucida"
                                       style="text-align: center; margin-bottom:6px !important; margin-top:40px; width:100%; font-size: 28px; text-transform: uppercase; border: 1px solid #e9e4e4; "><span class="lucida" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-weight:bold;">@lang('Due Report')</span><br>
                                </p>

                                <center style="margin-bottom:30px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                    <p>{{$from}} @lang('to') {{$to}}</p>
                                </center>
                                     <!-- School Name -->

                               
                                
                            
                            <div class="page-panel-title w-100" style="margin-bottom: 15px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                @foreach($dues as $due)
                                    <b>{{trans(school('country')->code == 'BD' ? 'Class' : 'Grade')}}</b>
                                    - {{$due->class->name}} &nbsp;
                                    <b>@lang('Section')</b>
                                    - {{$due->section->section_number}}
                                    @break($loop->first)
                                @endforeach
                            </div>
                                <div class="clearfix"></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered  table-striped" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>@lang('Head Name')</th>
                                            <th class="text-right">@lang('Total Due')</th>
                                            <th class="text-right">@lang('Paid')</th>
                                            <th class="text-right">@lang('Waiver')</th>
                                            <th class="text-right">@lang('Current Due')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($totalDue=$totalPaid=$totalWaiver=$currentDue=0)
                                        @foreach($dues as $due)
                                            <?php
                                            $this_total_due = $due->fee_sum($due->type, $due->section_id, $from, $to);
                                            $this_paid = $due->paid_sum($due->type, $due->section_id, $from, $to);
                                            $this_waiver = $due->waiver_sum($due->type, $due->section_id, $from, $to);
                                            $this_current_due = $this_total_due - ($this_paid + $this_waiver);
                                            $totalDue += $this_total_due;
                                            $totalPaid += $this_paid;
                                            $totalWaiver += $this_waiver;
                                            $currentDue += $this_current_due;
                                            ?>
                                            <tr>
                                                <td>{{$loop->index +1}}</td>
                                                <td>{{$due->name}}</td>
                                                <td class="text-right">{{number_format($this_total_due,2)}}</td>
                                                <td class="text-right">{{number_format($this_paid,2)}}</td>
                                                <td class="text-right">{{number_format($this_waiver,2)}}</td>
                                                <td class="text-right">{{number_format($this_current_due,2)}}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="text-right" colspan="2"><b>@lang('Total')</b></td>
                                            <td class="text-right"><b>{{number_format($totalDue,2)}}</b></td>
                                            <td class="text-right"><b>{{number_format($totalPaid,2)}}</b></td>
                                            <td class="text-right"><b>{{number_format($totalWaiver,2)}}</b></td>
                                            <td class="text-right"><b>{{number_format($currentDue,2)}}</b></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                @push('script')
                                    <script>
                                        function printDiv() {
                                            currentDateTime("printTime");
                                            var divToPrint = document.getElementById('printDiv');
                                            var newWin = window.open('', 'Print-Window');
                                            document.getElementById("schoolengName").style.cssText = `font-family: Myriad Pro;  margin-bottom:6px;  margin-top:3px; color: #079850 !important; font-size:18px; word-spacing: -0.6px !important;`;
                                            document.getElementById("maincon").style.cssText = `margin-bottom:6px; font-size:11px; word-spacing: -3px;`;
                                            document.getElementById("maincon2").style.cssText = `font-size:10px; word-spacing: -4.5px;`;
                                            document.getElementById("schoolHeader").style.cssText = `display:block; text-align:left;`;
                                            document.getElementById("logodemo").style.cssText = `display:block; text-align:right; width: 30%;`;
                                            document.getElementById("ipsita").style.cssText = `display:block; border: 1px solid #e9e4e4; font-size:10px; padding-top:5px; text-align:center;`;
                                            newWin.document.open();
                                            newWin.document.write('<html><title>Due Report {{ $from." to ".$to}}</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>@page {size: a4 portrait;}.label{border:none;}.clearhight50{clear:both;height:50px}</style>' + divToPrint.innerHTML + '</body></html>');
                                            newWin.document.close();
                                            setTimeout(function () {
                                                newWin.close();
                                            }, 100);
                                        }
                                    </script>
                                @endpush
                            @else
                                @lang('No Related Data Found.')
                            @endif
                            <div class="clearhight50"></div>
                            <div class="d-print-block d-none">
                                <div class="pull-left" align="center">
                                    ----------------------
                                    <div class="clearfix"></div>
                                    <span class="border_dot" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                        @lang('Accountant')
                                    </span>
                                </div>
                                <div class="pull-right" align="center">
                                    ----------------------
                                    <div class="clearfix"></div>
                                    <span class="border_dot" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                                        @lang('Head Teacher')
                                    </span>
                                </div>
                            </div>
                            <div class="clearhight50"></div>
                            <div class="mt-30 special-box-develop" id="ipsita"
                                 style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size:15px; text-align: center !important; margin-top: 30px; margin-left: 30px;  width: 90%;  border: 1px solid #e9e4e4; display:none;">
                                <p>Developed by:  IPSITA COMPUTERS PTE LTD <!--{{reseller()->name}}-->.</p>
                            </div>
                        </div>
                    @endisset
                </div>
            </div>

        </div>
    </div>

@endsection

@push('script')
    <script>
        $(function () {
            $('.datepicker').datepicker({
                format: "dd-mm-yyyy",
                viewMode: "days",
                minViewMode: "days",
                autoclose: true
            });
        });
    </script>
    <script>
        $(function () {
            $('.select2').select2();
        });
    </script>
@endpush