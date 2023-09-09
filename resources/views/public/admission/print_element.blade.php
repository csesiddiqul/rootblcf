<div class="col-sm-12" id="main-container">
    <button class="printbtn btn  btn-success  "
            onclick="printDiv()" style="margin-top: 10px;"
            role="button" id="btnPrint"><i class="fa fa-print"></i> @lang('Print')
    </button>
    <div class="row">
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
        <div class="col-sm-2">
            <img src="{{$logo}}"
                 class="profile-user-img img-responsive img-thumbnail float-right"
                 id="my-profile" alt="Profile Picture" width="100%"
                 style="margin-top: 20px; width:110px;height:110px;">
        </div>
        <div class="col-sm-8" align="center">
            @if(strlen(school('name')) > 34)
                <h4 class="margin">{{school('name')}}</h4>
            @else
                <h3 class="margin">{{school('name')}}</h3>
            @endif
            <h5 class="margin">{{school('address')}}</h5>
            <p class="margin">{{school('country')->code == 'BD' || 'SG' ? trans('Admission Class') : trans('Enroll In')}}
                : {{getClass($input['class_id'],'name')}}</p>
            <span style="text-decoration: underline">@lang("Applicant's Copy")</span>
            <p><b>@lang('Application ID:') {{$input['roll']??''}}</b></p>
        </div>
        <div class="col-sm-2">
            <img src="{{$input['photo']??''}}"
                 class="profile-user-img img-responsive img-thumbnail float-right"
                 id="my-profile" alt="Profile Picture" width="100%"
                 style="margin-top: 20px; width:110px;height:110px;">
        </div>
        <div class="clearhight50"></div>
        <img src="{{$logo}}"
             class="watermark d-print-block d-none " alt="Profile Picture" width="100%"
             style="margin-top: 20px; width:140px;height:140px;">
        <fieldset class="scheduler-border col-md-12">
            <legend class="scheduler-border">@lang('Student Personal Information')</legend>
            <div class="row">
                <div class="col-sm-6 ">
                    <table class="table ">
                        <tbody>
                        <tr>
                            <td style="width:62%;">@lang('Name as in the Birth Certificate') <span
                                        class="float-right">:</span></td>
                            <td style="width:38%;">{{$input['name']??''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Father Name') <span class="float-right">:</span>
                            </td>
                            <td>{{$input['father_name']??''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Mother Name') <span class="float-right">:</span>
                            </td>
                            <td>{{$input['mother_name']??''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Place of Birth') <span
                                        class="float-right">:</span></td>
                            <td>{{$input['placeBirth']??''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Date of Birth') <span class="float-right">:</span>
                            </td>
                            <td>{{$input['dob']??''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Mobile') <span class="float-right">:</span>
                                @if(school('country')->code == 'BD')
                                    <br>
                                    <code>@lang('You will receive all SMS to this number')</code>
                                @endif
                            </td>
                            <td>{{$input['mobile']??''}}</td>
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
                                <td>@lang('Resident Status') <span
                                            class="float-right">:</span></td>
                                <td>{{residentstatus($input['singaporepr'],true)}}</td>
                            </tr>
                            <tr>
                                <td>@lang('Name and Address of Main School') <span
                                            class="float-right">:</span>
                                </td>
                                <td>{{$input['nameAddressofmainSchool']??''}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-6  ">
                    <table class="table">
                        @if(school('country')->code == 'SG')
                            @php $house = \App\House::find($input['previous_class']); @endphp
                            <tr>
                                <td>@lang($previous_class) <span
                                            class="float-right">:</span></td>
                                <td>{{$house->name}}</td>
                            </tr>
                        @else
                            @if(school('country')->code != 'BD')
                                @if(branch_permission())
                                    <tr>
                                        <td style="width: 62%;">@lang('Branch')
                                            <span class="float-right">:</span></td>
                                        <td style="width: 38%;">{{getSchool($input['branch_id'],'name')}}</td>
                                    </tr>
                                @endif
                            @endif
                        @endif
                        <tr>
                            <td style="width:62%;">
                                {{school('country')->code == 'BD' || 'SG' ? 'Class' : 'Enroll In'}}

                                <span class="float-right">:</span></td>
                            <td style="width:38%;">{{getClass($input['class_id'],'name')}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Gender') <span class="float-right">:</span></td>
                            <td>{{(isset($input['gender']))?gender($input['gender']):''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Religion') <span class="float-right">:</span></td>
                            <td>
                                @if($input['religon'])
                                    {{religon($input['religon'],true)}}
                                @endif
                            </td>
                        </tr>
                        @if(school('country')->code == 'BD')
                            @php $birthcertificateNo = 'Birth Certificate No'; @endphp
                        @elseif(school('country')->code == 'SG')
                            @php $birthcertificateNo = 'Birth Certificate No/NRIC No/Passport No'; @endphp
                        @else
                            @php $birthcertificateNo = 'NRIC No/Passport No'; @endphp
                        @endif
                        <tr>
                            <td>@lang($birthcertificateNo)
                                <span class="float-right">:</span>
                            </td>
                            <td>{{$input['birthcertificateNo']??''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Blood group') <span class="float-right">:</span>
                            </td>
                            <td>{{(isset($input['bloodgroup']))?bloodgroup($input['bloodgroup'],true):''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Nationality') <span class="float-right">:</span>
                            </td>
                            <td>{{nationalityArray($input['nationality'])??''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Email') <span class="float-right">:</span></td>
                            <td>{{$input['email']??''}}</td>
                        </tr>
                        @if(school('country')->code == 'SG')
                            <tr>
                                <td>@lang('Admission in Bengali Class') <span
                                            class="float-right">:</span></td>
                                <td>{{$input['admissioninbengaliClass']??''}}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </fieldset>
        @if(school('country')->code != 'SG')
            <fieldset class="scheduler-border col-md-12">
                <legend class="scheduler-border">@lang('Student Previous History')</legend>
                <div class="row">
                    <div class="col-sm-6 ">
                        <table class="table for_leftside">
                            <tbody>
                            <tr>
                                <td style="width: 62%;">@lang('Previous School Name') <span
                                            class="float-right">:</span>
                                </td>
                                <td style="width: 38%;">{{$input['nameAddressofmainSchool']??''}}</td>
                            </tr>
                            @if(school('country')->code == 'BD')
                                <tr>
                                    <td>@lang('Last GPA') <span
                                                class="float-right">:</span>
                                    </td>
                                    <td>{{$input['last_gpa']??''}}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6 ">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td style="width: 62%;">@lang($previous_class) <span
                                            class="float-right">:</span>
                                </td>
                                <td style="width: 38%;">{{$input['previous_class']??''}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </fieldset>
        @endif
        <fieldset class="scheduler-border col-md-12">
            <legend class="scheduler-border">@lang('Particulars Of Parents/Guardian')</legend>
            <div class="row">
                <div class="col-sm-6 ">
                    <table class="table for_leftside">
                        <tbody>
                        <tr>
                            <td style="width: 62%;">@lang('Name') <span class="float-right">:</span>
                            </td>
                            <td style="width: 38%;">{{$input['gName']??''}}</td>
                        </tr>
                        <tr>
                            <td style="width: 62%;">@lang('Nationality') <span
                                        class="float-right">:</span></td>
                            <td style="width: 38%;">{{nationalityArray($input['gNationality'])??''}}</td>
                        </tr>
                        <tr>
                            <td style="width: 62%;">@lang('Occupation') <span
                                        class="float-right">:</span></td>
                            <td style="width: 38%;">{{$input['gOccupation']??''}}</td>
                        </tr>
                        <tr>
                            <td style="width: 62%;">@lang('Address') <span
                                        class="float-right">:</span>
                            </td>
                            <td style="width: 38%;">{{$input['gAddress']??''}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-6">
                    <table class="table">
                        <tr>
                            <td style="width: 62%;">@lang('E-mail') <span
                                        class="float-right">:</span>
                            </td>
                            <td style="width: 38%;">{{$input['gEmail']??''}}</td>
                        </tr>
                        {{--  <tr>
                              <td style="width: 62%;">@lang('Date') <span class="float-right">:</span>
                              </td>
                              <td style="width: 38%;">{{$input['gdate']??''}}</td>

                          </tr>--}}
                        <tr>
                            <td style="width: 62%;">@lang('Mobile') <span
                                        class="float-right">:</span>
                            </td>
                            <td style="width: 38%;">{{$input['gMobile']??''}}</td>
                        </tr>
                        <tr>
                            <td style="width: 62%;">@lang('Phone') <span
                                        class="float-right">:</span>
                            </td>
                            <td style="width: 38%;">{{$input['gPhone']??''}}</td>

                        </tr>
                        @if(school('country')->code != 'BD')
                            <tr>
                                <td style="width: 62%;">@lang('NRIC No./Passport No.') <span
                                            class="float-right">:</span></td>
                                <td style="width: 38%;">{{$input['gnrcNo']??''}}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </fieldset>
        <fieldset class="scheduler-border col-md-12">
            <legend class="scheduler-border">@lang('Emergency Contact Information')</legend>
            <div class="row">
                <div class="col-sm-6 ">
                    <table class="table for_leftside">
                        <tr>
                            <td style="width: 62%;">@lang('Name') <span class="float-right">:</span>
                            </td>
                            <td style="width: 38%;">{{$input['contactperson']??''}}</td>

                        </tr>
                        <tr>
                            <td style="width: 62%;">@lang('Relationship') <span
                                        class="float-right">:</span>
                            </td>
                            <td style="width: 38%;">{{$input['realation']??''}}</td>

                        </tr>

                    </table>
                </div>
                <div class="col-sm-6 ">
                    <table class="table for_rightside">
                        <tr>
                            <td style="width: 62%;">@lang('Mobile') <span
                                        class="float-right">:</span>
                            </td>
                            <td style="width: 38%;">{{$input['contactpersonmobile']??''}}</td>
                        </tr>
                        <tr>
                            <td style="width: 62%;">@lang('Address') <span
                                        class="float-right">:</span>
                            </td>
                            <td style="width: 38%;">{{$input['cemail']??''}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </fieldset>
        @if(school('country')->code =='BD')
            @php
                $presentAddress = $input['presentAddress']??'';
                $perpostcode = $input['perpostcode']??'';
                $perpostoffice = $input['perpostoffice']??'';
                $preThana = (isset($input['preThana']))?getThanaName($input['preThana']):'';
                $preDistrict = (isset($input['preDistrict']))?getDistrictName($input['preDistrict']):'';
                $preDivision = (isset($input['preDivision']))?getDivisionName($input['preDivision']):'';

                 if(isset($input['persent_same']) && $input['persent_same'] == 1){
                     $pastAddress = $presentAddress;
                     $pastpostcode = $perpostcode;
                     $pastpostoffice = $perpostoffice;
                     $pastThana = $preThana;
                     $pastDistrict = $preDistrict;
                     $pastDivision = $preDivision;
                 }else{
                     $pastAddress =  $input['pastAddress']??'';
                     $pastpostcode =  $input['pastpostcode']??'';
                     $pastpostoffice =  $input['pastpostoffice']??'';
                     $pastThana =  (isset($input['pastThana']))?getThanaName($input['pastThana']):'';
                     $pastDistrict = (isset($input['pastDistrict']))?getDistrictName($input['pastDistrict']):'';
                    $pastDivision = (isset($input['pastDivision']))?getDivisionName($input['pastDivision']):'';
                 }
            @endphp
            <div class="col-md-6 print_left_50 tdSpeace ppr0 pl-0 {{useragentMobile() ? 'pr-0' : ''}}">
                <fieldset class="scheduler-border col-md-12">
                    <legend class="scheduler-border">@lang('Present Address')</legend>
                    <table class="table ">
                        <tr>
                            <td style="width:62%;">@lang('Village') <span class="float-right">:</span>
                            </td>
                            <td style="width:38%;">{{$presentAddress}}</td>
                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('Post Code') <span class="float-right">:</span>
                            </td>
                            <td style="width:38%;">{{$perpostcode}}</td>
                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('Post Office') <span
                                        class="float-right">:</span>
                            </td>
                            <td style="width:38%;">{{$perpostoffice}}</td>

                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('Thana') <span class="float-right">:</span>
                            </td>
                            <td style="width:38%;">{{$preThana}}</td>
                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('District') <span class="float-right">:</span>
                            </td>
                            <td style="width:38%;">{{$preDistrict}}</td>
                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('Division') <span class="float-right">:</span>
                            </td>
                            <td style="width:38%;">{{$preDivision}}</td>
                        </tr>
                    </table>
                </fieldset>
            </div>
            <div class="col-md-6 print_right_50 tdSpeace ppr0  pr-0  {{useragentMobile() ? 'pl-0' : ''}}">
                <fieldset class="scheduler-border col-md-12">
                    <legend class="scheduler-border">@lang('Permanent Address')</legend>
                    <table class="table ">
                        <tr>
                            <td>@lang('Village') <span class="float-right">:</span></td>
                            <td>{{$pastAddress}}</td>

                        </tr>
                        <tr>
                            <td style="width:60%;">@lang('Post Code') <span class="float-right">:</span>
                            </td>
                            <td style="width:38%;">{{$pastpostcode}}</td>

                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('Post Office') <span
                                        class="float-right">:</span>
                            </td>
                            <td style="width:38%;">{{$pastpostoffice}}</td>

                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('Thana') <span class="float-right">:</span>
                            </td>
                            <td style="width:38%;">{{$pastThana}}</td>
                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('District') <span class="float-right">:</span>
                            </td>
                            <td style="width:38%;">{{$pastDistrict}}</td>
                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('Division') <span class="float-right">:</span>
                            </td>
                            <td style="width:38%;">{{$pastDivision}}</td>
                        </tr>
                    </table>
                </fieldset>
            </div>
        @else
            @if(school('country')->code != 'SG')
                @php
                    $streetAddress_1 = $input['streetAddress_1']??'';
                    $streetAddress_2 = $input['streetAddress_2']??'';
                    $city = $input['city']??'';
                    $zipCode = $input['zipCode']??'';
                    $country = (isset($input['country']))?getCountryName($input['country']):'';
                    $state = (isset($input['state']))?getStateName($input['state']):'';
                @endphp
                <fieldset class="scheduler-border col-md-12">
                    <legend class="scheduler-border">@lang('USA Address Information')</legend>
                    <div class="row">
                        <div class="col-sm-6 ">
                            <table class="table for_leftside">
                                <tr>
                                    <td style="width: 62%;">@lang('Street Address 1') <span
                                                class="float-right">:</span>
                                    </td>
                                    <td style="width: 38%;">{{$streetAddress_1}}</td>

                                </tr>
                                <tr>
                                    <td style="width: 62%;">@lang('Street Address 2') <span
                                                class="float-right">:</span>
                                    </td>
                                    <td style="width: 38%;">{{$streetAddress_2}}</td>

                                </tr>
                                <tr>
                                    <td style="width: 62%;">@lang('Country') <span
                                                class="float-right">:</span>
                                    </td>
                                    <td style="width: 38%;">{{$country}}</td>

                                </tr>

                            </table>
                        </div>
                        <div class="col-sm-6 ">
                            <table class="table for_rightside">
                                <tr>
                                    <td style="width: 62%;">@lang('State') <span
                                                class="float-right">:</span>
                                    </td>
                                    <td style="width: 38%;">{{$state}}</td>

                                </tr>
                                <tr>
                                    <td style="width: 62%;">@lang('City') <span class="float-right">:</span>
                                    </td>
                                    <td style="width: 38%;">{{$city}}</td>

                                </tr>
                                <tr>
                                    <td style="width: 62%;">@lang('Zip Code') <span
                                                class="float-right">:</span>
                                    </td>
                                    <td style="width: 38%;">{{$zipCode}}</td>

                                </tr>
                            </table>
                        </div>
                    </div>
                </fieldset>
            @endif
        @endif
    </div>
    <div class="clearhight50"></div>
    <div align="center" class="d-print-block d-none ">Developed by : {{school('reseller')->name}}</div>
</div>
@push('script')
    <script>
        function printDiv() {
            var divToPrint = document.getElementById('print-container');
            var newWin = window.open('', 'Print-Window');
            newWin.document.open();
            newWin.document.write('<html><title>@lang("Admission Id")  {{$input['roll']??''}}</title><link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.min.css')}}"><link rel="stylesheet" type="text/css" href="{{asset('public/css/academy.css')}}"><body onload="window.print()"><style>.clearhight25 {clear: both;height: 25px;}.clearhight15 {clear: both}#btnPrint{display:none}.d-print-none{display:none}.badge-danger {color: #fff;background-color: #dc3545;}.badge {display: inline-block;padding: 0.25em 0.4em;font-size: 75%;font-weight: 700;line-height: 1;text-align: center;white-space: nowrap;vertical-align: baseline;border-radius: 0.25rem;}.badge-success {color: #fff;background-color: #28a745;} .d-print-block{display:block}</style>' + divToPrint.innerHTML + '</body></html>');
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
