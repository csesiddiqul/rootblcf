@extends('layouts.app')
@section('title', __('Showing Application'))
@section('content')
    <style>
        h4 {
            font-size: 21px !important;
        }

        .table > tbody > tr:first-child > td:first-child {
            width: 60%
        }

        .table > tbody > tr:first-child > td:last-child {
            width: 40%
        }

        .table > tbody > tr > td {
            border-top: none !important;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-sm-10" id="main-container">
                @include('components.sectionbar.admission-bar')
                <div class="panel panel-default" id="table-content">
                    <div class="panel-body pl-0 pr-0">
                        <div class="col-sm-12 d-print-none">
                            <button class="printbtn btn btn-sm btn-success pull-center d-print-none"
                                    onclick="printDiv()" style="margin-top: 10px;"
                                    role="button" id="btnPrint"><i class="fa fa-print"></i> @lang('Print Profile')
                            </button>
                            <a href="{{route('academic.admission.edit',$admission->id)}}" style="margin-top: 10px;"
                               class="btn btn-sm btn-default d-print-none"><i class="fa fa-edit"></i> @lang('Edit')</a>
                            <button onclick="history.back()" style="margin-top: 10px;"
                                    class="btn btn-sm btn-info d-print-none"><i class="fa fa-reply"></i> @lang('Back')
                            </button>
                            @foreach($admission->studentFile as $studentFile)
                                <button type="button" class="btn btn-primary btn-sm pull-right" style="margin-left: 5px"
                                        data-toggle="modal" data-target="#{{renderSlug($studentFile->name)}}">
                                    {{$studentFile->name}}
                                </button>
                            @endforeach
                        </div>
                        <div class="clearfix"></div>
                        @if (foqas_setting('logo_type') == 1)
                            @php $logo = foqas_setting('express'); @endphp
                            @empty($logo)
                                @php $logo = 'https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/favicon.png'; @endphp
                            @endempty
                        @else
                            @php $logo = foqas_setting('standard'); @endphp
                            @empty($logo)
                                @php $logo = 'https://foqasacademy.s3.us-east-2.amazonaws.com/img/01/icpl.png'; @endphp
                            @endempty
                        @endif
                        <div class="col-sm-2 pull-left center" align="center">
                            <img src="{{$logo}}"
                                 class="profile-user-img img-responsive img-thumbnail float-right"
                                 id="my-profile" alt="Profile Picture" width="100%"
                                 style="margin-top: 20px; width:110px;height:110px;">
                        </div>
                        <div class="col-sm-8 pull-left center" align="center">
                            @if(strlen(school('name')) > 34)
                                <h4 class="margin">{{school('name')}}</h4>
                            @else
                                <h3 class="margin">{{school('name')}}</h3>
                            @endif
                            <h5 class="margin">{{school('address')}}</h5>
                            <p class="margin">{{school('country')->code == 'BD' || 'SG' ? trans('Admission Class') : trans('Enroll In')}}
                                : {{$admission->class->name}}</p>
                            <p><b>@lang('Application ID:') {{$admission->roll}}</b></p>
                        </div>
                        <div class="col-sm-2 pull-left center" align="center">
                            <img src="{{$admission->photo}}" data-src="" class="img-thumbnail"
                                 id="my-profile" alt="@lang('Profile Picture')"
                                 style="margin-top: 20px; width:110px;height:110px;">
                        </div>
                        <div class="clearhight15"></div>
                        <img src="{{$logo}}"
                             class="watermark d-print-block d-none " alt="Profile Picture" width="100%"
                             style="margin-top: 20px; width:140px;height:140px;">
                        <div class="col-sm-12 ">
                            <fieldset class="scheduler-border col-md-12">
                                <legend class="scheduler-border">@lang('Student Personal Information')</legend>
                                <div class="col-sm-6 print_left_50">
                                    <table class="table for_pad1 ">
                                        <tr>
                                            <td style="width: 62%;">@lang('Name as in the Birth Certificate') <span
                                                        class="pull-right">:</span></td>
                                            <td style="width: 32%">{{$admission->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Father Name') <span class="pull-right">:</span></td>
                                            <td>{{$admission->father_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Mother Name') <span class="pull-right">:</span></td>
                                            <td>{{$admission->mother_name}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Place of Birth') <span class="pull-right">:</span></td>
                                            <td>{{$admission->placeBirth}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Date of Birth') <span class="pull-right">:</span></td>
                                            <td>{{$admission->dob}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Mobile') <span class="pull-right">:</span></td>
                                            <td>{{$admission->mobile}}</td>
                                        </tr>
                                        @if(school('country')->code == 'BD')
                                            @php $previous_class = 'Previous Class'; @endphp
                                        @elseif(school('country')->code == 'SG')
                                            @php $previous_class = 'Level'; @endphp
                                        @else
                                            @php $previous_class = 'Previous Grade'; @endphp
                                        @endif
                                        @if(school('country')->code == 'SG')
                                            <tr>
                                                <td>@lang('Name and Address of Main School') <span
                                                            class="pull-right">:</span>
                                                </td>
                                                <td>{{$admission->nameAddressofmainSchool}}</td>
                                            </tr>
                                            {{--<tr>
                                                <td>@lang($previous_class) <span
                                                            class="pull-right">:</span>
                                                </td>
                                                <td>{{$admission->previous_class}}</td>
                                            </tr>--}}
                                            <tr>
                                                <td>@lang('Admission in Bengali Class') <span
                                                            class="pull-right">:</span>
                                                </td>
                                                <td>{{$admission->admissioninbengaliClass}}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                                <div class="col-sm-6 print_left_50">
                                    <table class="table">
                                        @if(school('country')->code == 'SG')
                                            <tr>
                                                <td>@lang('Branch') <span
                                                            class="pull-right">:</span>
                                                </td>
                                                <td>{{$admission->house->name}}</td>
                                            </tr>
                                        @else
                                            @if(school('country')->code != 'BD')
                                                @if(branch_permission())
                                                    <tr>
                                                        <td style="width: 62%;"> @lang('Branch')
                                                            <span class="pull-right">:</span>
                                                        </td>
                                                        <td style="width: 32%;">{{$admission->branch['name'] ?? ''}}</td>
                                                    </tr>
                                                @endif
                                            @endif
                                        @endif
                                        <tr>
                                            <td style="width: 62%;">
                                                {{school('country')->code == 'BD' || 'SG' ? 'Class' : 'Enroll In'}}<span
                                                        class="pull-right">:</span>
                                            </td>
                                            <td style="width: 32%;">{{$admission->class['name']}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Gender') <span class="pull-right">:</span></td>
                                            <td>{{gender($admission->gender)}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Religon') <span class="pull-right">:</span></td>
                                            <td>{{religon($admission->religon,true)}}</td>
                                        </tr>
                                        @if(school('country')->code == 'BD')
                                            @php $birthcertificateNo = 'Birth Certificate No'; @endphp
                                        @elseif(school('country')->code == 'SG')
                                            @php $birthcertificateNo = 'Birth Certificate No/NRIC No/Passport No'; @endphp
                                        @else
                                            @php $birthcertificateNo = 'NRIC No/Passport No'; @endphp
                                        @endif
                                        <tr>
                                            <td>@lang($birthcertificateNo) <span
                                                        class="pull-right">:</span>
                                            </td>
                                            <td>{{$admission->birthcertificateNo}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Blood group') <span class="pull-right">:</span></td>
                                            <td>{{bloodgroup($admission->bloodgroup,true)}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Nationality') <span class="pull-right">:</span></td>
                                            <td>
                                                {!!nationalityArray($admission->nationality) !!}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Email') <span class="pull-right">:</span></td>
                                            <td>{{$admission->email}}</td>
                                        </tr>
                                        @if(school('country')->code == 'SG')
                                            <tr>
                                                <td>@lang('Resident status') <span class="pull-right">:</span></td>
                                                <td>{{residentstatus($admission->singaporepr,true)}}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </fieldset>
                        </div>
                        @if(school('country')->code != 'SG')
                            <div class="col-sm-12">
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">@lang('Student Previous History')</legend>
                                    <div class="col-sm-6">
                                        <table class="table">
                                            <tr>
                                                <td style="width: 62%;">@lang('Previous School Name') <span
                                                            class="pull-right">:</span></td>
                                                <td style="width: 38%;">{{$admission->nameAddressofmainSchool}}</td>
                                            </tr>
                                            @if(school('country')->code == 'BD')
                                                <tr>
                                                    <td>@lang('Last GPA') <span class="pull-right">:</span></td>
                                                    <td>
                                                        {!! $admission->last_gpa !!}
                                                    </td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>
                                    <div class="col-sm-6">
                                        <table class="table">
                                            <tr>
                                                <td>@lang($previous_class) <span class="pull-right">:</span></td>
                                                <td>{{$admission->previous_class}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </fieldset>
                            </div>
                        @endif
                        <div class="col-sm-12">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">@lang('Particulars Of Parents/Guardian')</legend>
                                <div class="col-sm-6">
                                    <table class="table">
                                        <tr>
                                            <td style="width: 62%;">@lang('Name') <span class="pull-right">:</span></td>
                                            <td style="width: 38%;">{{$admission->gName}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Nationality') <span class="pull-right">:</span></td>
                                            <td>
                                                {!! nationalityArray($admission->gNationality) !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Occupation.') <span class="pull-right">:</span></td>
                                            <td>{{$admission->gOccupation}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Address') <span class="pull-right">:</span></td>
                                            <td>{{$admission->gAddress}}</td>
                                        </tr>
                                        @if(school('country')->code == 'SG')
                                            <tr>
                                                <td>@lang('NRIC No./Passport No.') <span class="pull-right">:</span>
                                                </td>
                                                <td>{{$admission->gnrcNo}}</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                                <div class="col-sm-6">
                                    <table class="table">
                                        <tr>
                                            <td>@lang('E-mail') <span class="pull-right">:</span></td>
                                            <td>{{$admission->gEmail}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Mobile') <span class="pull-right">:</span></td>
                                            <td>{{$admission->gMobile}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Phone') <span class="pull-right">:</span></td>
                                            <td>{{$admission->gPhone}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Date of Birth') <span class="pull-right">:</span></td>
                                            <td>{{$admission->gdate}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </fieldset>
                        </div>
                        <div class="col-sm-12">
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">@lang('Emergency Contact Information')</legend>
                                <div class="col-sm-6">
                                    <table class="table">
                                        <tr>
                                            <td>@lang('Name') <span class="pull-right">:</span></td>
                                            <td>{{$admission->contactperson}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Relationship') <span class="pull-right">:</span></td>
                                            <td>{{$admission->realation}}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-6">
                                    <table class="table">
                                        {{--<tr>
                                            <td>@lang('E-mail') <span class="pull-right">:</span></td>
                                            <td>{{$admission->gEmail}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Date') <span class="pull-right">:</span></td>
                                            <td>{{$admission->gdate}}</td>
                                        </tr>--}}
                                        <tr>
                                            <td>@lang('Mobile') <span class="pull-right">:</span></td>
                                            <td>{{$admission->contactpersonmobile}}</td>
                                        </tr>
                                        <tr>
                                            <td>@lang('Address') <span class="pull-right">:</span></td>
                                            <td>{{$admission->cemail}}</td>
                                        </tr>

                                    </table>
                                </div>
                            </fieldset>
                        </div>
                        <div class="clearfix"></div>
                        @if(school('country')->code == 'BD')
                            <div class="col-sm-12  ">
                                <div class="col-sm-6 print_left_50 tdSpeace ppr0 pl-0 {{useragentMobile() ? 'pr-0' : ''}}">
                                    <fieldset class="scheduler-border ">
                                        <legend class="scheduler-border">@lang('Present Address')</legend>
                                        <table class="table">
                                            <tr>
                                                <td>@lang('Village') <span class="pull-right">:</span></td>
                                                <td>{{$admission->presentAddress}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('Post Code') <span class="pull-right">:</span></td>
                                                <td>{{$admission->perpostcode}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('Post Office') <span class="pull-right">:</span></td>
                                                <td>{{$admission->perpostoffice}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('Thana') <span class="pull-right">:</span></td>
                                                <td>{{getThanaName($admission->preThana)}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('District') <span class="pull-right">:</span></td>
                                                <td>{{getDistrictName($admission->preDistrict)}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('Division') <span class="pull-right">:</span></td>
                                                <td>{{getDivisionName($admission->preDivision)}}</td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </div>
                                <div class="col-sm-6 print_right_50 tdSpeace ppr0  pr-0  {{useragentMobile() ? 'pl-0' : ''}}">
                                    <fieldset class="scheduler-border">
                                        <legend class="scheduler-border">@lang('Permanent Address')  </legend>
                                        <table class="table">
                                            <tr>
                                                <td>@lang('Village') <span class="pull-right">:</span></td>
                                                <td>{{$admission->pastAddress}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('Post Code') <span class="pull-right">:</span></td>
                                                <td>{{$admission->pastpostcode}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('Post Office') <span class="pull-right">:</span></td>
                                                <td>{{$admission->pastpostoffice}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('Thana') <span class="pull-right">:</span></td>
                                                <td>{{getThanaName($admission->pastThana )}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('District') <span class="pull-right">:</span></td>
                                                <td>{{getDistrictName($admission->pastDistrict)}}</td>
                                            </tr>
                                            <tr>
                                                <td>@lang('Division') <span class="pull-right">:</span></td>
                                                <td>{{getDivisionName($admission->pastDivision)}}</td>
                                            </tr>
                                        </table>
                                    </fieldset>
                                </div>
                            </div>
                        @else
                            @if(school('country')->code != 'SG')
                                <div class="col-sm-12">
                                    <fieldset class="scheduler-border">
                                        <legend class="scheduler-border">@lang('USA Address Information')</legend>
                                        <div class="col-sm-6 print_left_50 tdSpeace ppr0">
                                            <table class="table">
                                                <tr>
                                                    <td>@lang('Street Address') <span class="pull-right">:</span></td>
                                                    <td>{{$admission->streetAddress_1}}</td>
                                                </tr>
                                                <tr>
                                                    <td>@lang('Street Address 2') <span class="pull-right">:</span></td>
                                                    <td>{{$admission->streetAddress_2}}</td>
                                                </tr>
                                                <tr>
                                                    <td>@lang('Country') <span class="pull-right">:</span></td>
                                                    <td>{{getCountryName($admission->country)}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-sm-6 print_right_50 tdSpeace ppr0">
                                            <table class="table">
                                                <tr>
                                                    <td>@lang('State') <span class="pull-right">:</span></td>
                                                    <td>{{getStateName($admission->state )}}</td>
                                                </tr>
                                                <tr>
                                                    <td>@lang('City') <span class="pull-right">:</span></td>
                                                    <td>{{$admission->city}}</td>
                                                </tr>
                                                <tr>
                                                    <td>@lang('Zip Code') <span class="pull-right">:</span></td>
                                                    <td>{{$admission->zipCode}}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </fieldset>
                                </div>
                            @endif
                        @endif
                        <div class="clearhight15"></div>
                        <div align="center" class="d-print-block d-none ">Developed by
                            : {{school('reseller')->name}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            function printDiv(id = 'table-content') {
                var divToPrint = document.getElementById(id);
                var newWin = window.open('', 'Print-Window');
                newWin.document.open();
                newWin.document.write('<html><title>@lang("Admission Show")</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}"><link rel="stylesheet" type="text/css" href="{{ asset('css/application.css') }}"><body onload="window.print()"><style>#btnPrint{display:none}.d-print-none{display:none}.table-responsive { overflow-x: unset;}.clearhight50{clear:both;height:50px}.clearhight25 {clear: both;height: 25px;}.clearhight15 {clear: both}.print_style {border: 1px dashed;position: relative;overflow: auto;padding: 0px 10px;min-height:97%}.div_break{padding: 10px 0;page-break-before: always;}.custom-tabel{background-color: #f0f0f0 !important;}.pull-left{float:left}.col-md-6,.col-sm-6{width:50%;float:left}.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{border:none !important}.center{text-align: center}.col-sm-3{width:25%;float:left} .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{padding: 6px !important;    font-size: 13px;}.table{margin-bottom:0px !important}legend{margin-bottom: 4px !important}.d-print-block{display:block}.col-sm-2 {width: 16.66666667%;float:left}</style>' + divToPrint.innerHTML + '</body></html>');
                newWin.document.close();
                setTimeout(function () {
                    newWin.close();
                }, 1000);
            }

            jQuery(document).bind("keyup keydown", function (e) {
                if (e.ctrlKey && e.keyCode == 80) {
                    printDiv();
                    return false;
                }
            });
        </script>
    @endpush
    @foreach($admission->studentFile as $studentFile)
        <div class="modal fade" id="{{renderSlug($studentFile->name)}}" tabindex="-1" role="dialog"
             aria-labelledby="{{renderSlug($studentFile->name)}}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    @php
                        $extension = pathinfo($studentFile->file, PATHINFO_EXTENSION);
                    @endphp
                    <div class="modal-header">
                        <h5 class="modal-title pull-left"
                            id="{{renderSlug($studentFile->name)}}Label">{{$studentFile->name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        @if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg')
                            <button type="button"
                                    onclick="printDiv('img-{{renderSlug($studentFile->name)}}'); return false;">
                                @lang('Print')
                            </button>
                        @endif
                    </div>
                    <div class="modal-body">
                        @if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg')
                            <div id="img-{{renderSlug($studentFile->name)}}">
                                <img src="{{$studentFile->file}}" alt="{{$studentFile->name}}" class="w-100"/>
                            </div>
                        @elseif($extension == 'pdf')
                            <iframe src="{{$studentFile->file}}" style="width:100%; height:500px;" frameborder="0"
                                    allowfullscreen></iframe>
                        @elseif($extension == 'doc' || $extension == 'docx')
                            <div class="news-normal-block" style="cursor: pointer;     padding-bottom: 50px;">
                                <img style="width: 30%;" src="{{getIconByExtension($extension)}}" alt="doc">
                                <div class="news-btn mt-3">
                                    <a href="{{$studentFile->file}}" download
                                       style="font-size: 20px;">@lang('Download Here')</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm"
                                data-dismiss="modal">@lang('Close')</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
