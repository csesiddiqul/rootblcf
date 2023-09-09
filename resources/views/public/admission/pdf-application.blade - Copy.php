<style>
    
.for_pdf_left{
    width: 50%;
    float: left !important;
}
.for_pdf_right{
    width: 50%;
     float: right !important;
}

.for_colon{
       float: right !important;
}


</style> 

   <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-8 mt-3">
                        <div class="page-panel-title"></div>
                        
                    </div>

                    <div class="col-sm-4 d-flex justify-content-end">
                        <img src="http://192.168.0.109:8001/public/images/teachers/1.jpg" data-src=""
                             class="img-thumbnail" id="my-profile" alt="Profile Picture"
                             style="margin-top: 20px; width:140px;height:140px;">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="page-panel-title first_title" style="margin-top: 30px;"><b>Personal Information</b></div>
                        <div class="row">
                            <div class="col-sm-6 for_pdf_left">
                                <table class="table ">
                                    <tbody>
                                    
                                    <tr>
                                        <td style="width:62%;">@lang('Name as in the Birth Certificate') <span
                                                    class="for_colon">:</span></td>
                                        <td style="width:38%;">{{$input['name']??''}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Place of Birth') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{$input['placeBirth']??''}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Gender') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{(isset($input['gender']))?gender($input['gender']):''}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Religon') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">
                                            @if($input['religon'])
                                                {{religon($input['religon'],true)}}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Mobile') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{$input['mobile']??''}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Singapore') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{(isset($input['singaporepr']))?singaporepr($input['singaporepr']):''}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Name and Address of Main School') <span class="for_colon">:</span>
                                        </td>
                                        <td style="width:38%;">{{$input['nameAddressofmainSchool']??''}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Father Name') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{$input['father_name']??''}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6 for_pdf_right ">
                                <table class="table">
                                    <tr>
                                        <td style="width:62%;">@lang('Class') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{getClass($input['class_id'],'name')}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Date of Birth') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{$input['dob']??''}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Birth Certificate No./IC No./Passport No') <span class="for_colon">:</span>
                                        </td>
                                        <td style="width:38%;">{{$input['birthcertificateNo']??''}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Blood group') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{(isset($input['bloodgroup']))?bloodgroup($input['bloodgroup'],true):''}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Email') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{$input['email']??''}}</td>

                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Nationality') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{$input['nationality']??''}}</td>

                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Admission in Bengali Class') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{$input['admissioninbengaliClass']??''}}</td>

                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Mother Name') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{$input['mother_name']??''}}</td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="" style="clear: both;"></div>
                <div class="row">
                    <div class="col-sm-12 ">
                        <div class="page-panel-title" style=""><b>Particulars Of Parents/Guardian</b></div>

                        <div class="row">
                            <div class="col-sm-6 for_pdf_left">
                                <table class="table ">
                                    <tbody>
                                    <tr>
                                        <td style="width: 62%;">@lang('Name') <span class="for_colon">:</span></td>
                                        <td style="width: 38%;">{{$input['gName']??''}}</td>

                                    </tr>
                                    <tr>
                                        <td style="width: 62%;">@lang('Nationality') <span class="for_colon">:</span>
                                        </td>
                                        <td style="width: 38%;">{{$input['gNationality']??''}}</td>

                                    </tr>
                                    <tr>
                                        <td style="width: 62%;">@lang('Mobile') <span class="for_colon">:</span></td>
                                        <td style="width: 38%;">{{$input['gMobile']??''}}</td>

                                    </tr>
                                    <tr>
                                        <td style="width: 62%;">@lang('Address') <span class="for_colon">:</span></td>
                                        <td style="width: 38%;">{{$input['gAddress']??''}}</td>

                                    </tr>
                                    </tbody>

                                </table>
                            </div>
                            <div class="col-sm-6 for_pdf_right">
                                <table class="table">
                                    <tr>
                                        <td style="width: 62%;">@lang('E-mail') <span class="for_colon">:</span></td>
                                        <td style="width: 38%;">{{$input['gEmail']??''}}</td>

                                    </tr>
                                    <tr>
                                        <td style="width: 62%;">@lang('Date') <span class="for_colon">:</span></td>
                                        <td style="width: 38%;">{{$input['gdate']??''}}</td>

                                    </tr>
                                    <tr>
                                        <td style="width: 62%;">@lang('NRIC No./Passport No.') <span
                                                    class="for_colon">:</span></td>
                                        <td style="width: 38%;">{{$input['gnrcNo']??''}}</td>

                                    </tr>
                                    <tr>
                                        <td style="width: 62%;">@lang('Occupation.') <span class="for_colon">:</span>
                                        </td>
                                        <td style="width: 38%;">{{$input['gOccupation']??''}}</td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="row">
                    <div class="col-sm-12 tdSpeace print_right_50 ">
                        <div class="page-panel-title" style=""><b>Emergency Information</b></div>

                        <div class="row">
                            <div class="col-sm-6 for_pdf_left">
                                <table class="table ">
                                    <tr>
                                        <td style="width: 62%;">@lang('Name') <span class="for_colon">:</span></td>
                                        <td style="width: 38%;">{{$input['contactperson']??''}}</td>

                                    </tr>
                                    <tr>
                                        <td style="width: 62%;">@lang('Relationship') <span class="for_colon">:</span>
                                        </td>
                                        <td style="width: 38%;">{{$input['realation']??''}}</td>

                                    </tr>

                                </table>
                            </div>
                            <div class="col-sm-6 for_pdf_right">
                                <table class="table ">
                                    <tr>
                                        <td style="width: 62%;">@lang('E-mail') <span class="for_colon">:</span></td>
                                        <td style="width: 38%;">{{$input['gEmail']??''}}</td>

                                    </tr>
                                    <tr>
                                        <td style="width: 62%;">@lang('Date') <span class="for_colon">:</span></td>
                                        <td style="width: 38%;">{{$input['gdate']??''}}</td>

                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

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

              
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-6  for_pdf_left ">
                                <div class="page-panel-title " ><b>Present Address</b></div>
                                <table class="table ">
                                    <tr>
                                        <td style="width:62%;">@lang('Village') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{$presentAddress}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Post Code') <span class="for_colon">:</span>
                                        </td>
                                        <td style="width:38%;">{{$perpostcode}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Post Office') <span class="for_colon">:</span>
                                        </td>
                                        <td style="width:38%;">{{$perpostoffice}}</td>

                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Thana') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{$preThana}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('District') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{$preDistrict}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Division') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{$preDivision}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6  for_pdf_right">
                                <div class="page-panel-title"><b>Permanent Address</b></div>
                                <table class="table ">
                                    <tr>
                                        <td>@lang('Village') <span class="for_colon">:</span></td>
                                        <td>{{$pastAddress}}</td>

                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Post Code') <span class="for_colon">:</span>
                                        </td>
                                        <td style="width:38%;">{{$pastpostcode}}</td>

                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Post Office') <span class="for_colon">:</span>
                                        </td>
                                        <td style="width:38%;">{{$pastpostoffice}}</td>

                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Thana') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{$pastThana}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('District') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{$pastDistrict}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width:62%;">@lang('Division') <span class="for_colon">:</span></td>
                                        <td style="width:38%;">{{$pastDivision}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
 