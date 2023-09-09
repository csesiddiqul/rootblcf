@extends('public.layout.public',['title' => transMsg('Review Admission') ])
@section('sliderText')
    <h1 class="page-title">@lang('Review Admission')</h1>
@endsection
@section('content')
@include('public.inc.pages-header')
@include('public.inc.pages-slider')
 
<div class="container">
    <div class="row">
        <div class="col-sm-12" id="main-container">
            <div class="row">
                <div class="col-sm-8 mt-3">
                    <div class="page-panel-title"></div>
                    {{--<button class="printbtn btn btn-xs btn-success pull-center " onclick="printDiv('main-container')" style="margin-top: 10px;"
                            role="button" id="btnPrint"><i class="fa fa-print"></i> @lang('Print Profile')
                    </button>--}}
                    
                </div>

                <div class="col-sm-4 d-flex justify-content-end">
                    <img src="http://192.168.0.109:8001/public/images/teachers/1.jpg" data-src="" class="img-thumbnail" id="my-profile" alt="Profile Picture" 
                    style="margin-top: 20px; width:140px;height:140px;">
                </div>
            </div>
         <form id="applyform" method="post" action="{{route('submit.admission')}}">
             @csrf
            <div class="row">
                <div class="col-sm-12 ">
                <div class="page-panel-title first_title"><b>@lang('Personal Information')</b></div>
                <div class="row">
                    <div class="col-sm-6 ">
                    <table class="table ">
                        <tbody>
                        <tr>
                            <td>@lang('Name as in the Birth Certificate') <span
                                        class="float-right">:</span></td>
                            <td class="">{{$input['name']??''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Place of Birth') <span class="float-right">:</span></td>
                            <td>{{$input['placeBirth']??''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Gender') <span class="float-right">:</span></td>
                            <td>{{(isset($input['gender']))?gender($input['gender']):''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Religon') <span class="float-right">:</span></td>
                            <td>
                            @if($input['religon'])
                                {{religon($input['religon'],true)}}
                            @endif
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('Mobile') <span class="float-right">:</span></td>
                            <td>{{$input['mobile']??''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Resident Status') <span class="float-right">:</span></td>
                            <td>{{(isset($input['singaporepr']))?residentstatus($input['singaporepr']):''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Name and Address of Main School') <span class="float-right">:</span></td>
                            <td>{{$input['nameAddressofmainSchool']??''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Father Name') <span class="float-right">:</span></td>
                            <td>{{$input['father_name']??''}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-6  ">
                    <table class="table">
                        <tr>
                            <td>@lang('Class') <span class="float-right">:</span></td>
                            <td>{{getClass($input['class_id'],'name')}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Date of Birth') <span class="float-right">:</span></td>
                            <td>{{$input['dob']??''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Birth Certificate No./IC No./Passport No') <span class="float-right">:</span>
                            </td>
                            <td>{{$input['birthcertificateNo']??''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Blood group') <span class="float-right">:</span></td>
                            <td>{{(isset($input['bloodgroup']))?bloodgroup($input['bloodgroup'],true):''}}</td>
                        </tr>
                        <tr>
                            <td>@lang('Email') <span class="float-right">:</span></td>
                            <td>{{$input['email']??''}}</td>

                        </tr>
                        <tr>
                            <td>@lang('Nationality') <span class="float-right">:</span></td>
                            <td>{{$input['nationality']??''}}</td>

                        </tr>
                        <tr>
                            <td>@lang('Admission in Bengali Class') <span class="float-right">:</span></td>
                            <td>{{$input['admissioninbengaliClass']??''}}</td>

                        </tr>
                        <tr>
                            <td>@lang('Mother Name') <span class="float-right">:</span></td>
                            <td>{{$input['mother_name']??''}}</td>

                        </tr>
                    </table>
                </div>
                </div>
            </div>
            </div>
           <div class="row">
                <div class="col-sm-12 tdSpeace print_left_50" >
                <div class="page-panel-title"><b>@lang('Particulars Of Parents/Guardian')</b></div>
           
                <div class="row">
                    <div class="col-sm-6 ">
                    <table class="table for_leftside">
                        <tbody>
                        <tr>
                            <td style="width: 62%;">@lang('Name') <span class="float-right">:</span></td>
                            <td style="width: 38%;">{{$input['gName']??''}}</td>

                        </tr>
                        <tr>
                            <td style="width: 62%;">@lang('Nationality') <span class="float-right">:</span></td>
                            <td style="width: 38%;">{{$input['gNationality']??''}}</td>

                        </tr>
                        <tr>
                            <td style="width: 62%;">@lang('Mobile') <span class="float-right">:</span></td>
                            <td style="width: 38%;">{{$input['gMobile']??''}}</td>

                        </tr>
                        <tr>
                            <td style="width: 62%;">@lang('Address') <span class="float-right">:</span></td>
                            <td style="width: 38%;">{{$input['gAddress']??''}}</td>

                        </tr>
                        </tbody>

                    </table>
                </div>
                <div class="col-sm-6">
                    <table class="table">
                        <tr>
                            <td style="width: 62%;">@lang('E-mail') <span class="float-right">:</span></td>
                            <td style="width: 38%;">{{$input['gEmail']??''}}</td>

                        </tr>
                        <tr>
                            <td style="width: 62%;">@lang('Date') <span class="float-right">:</span></td>
                            <td style="width: 38%;">{{$input['gdate']??''}}</td>

                        </tr>
                        <tr>
                            <td style="width: 62%;">@lang('NRIC No./Passport No.') <span class="float-right">:</span></td>
                            <td style="width: 38%;">{{$input['gnrcNo']??''}}</td>

                        </tr>
                        <tr>
                            <td style="width: 62%;">@lang('Occupation.') <span class="float-right">:</span></td>
                            <td style="width: 38%;">{{$input['gOccupation']??''}}</td>

                        </tr>
                    </table>
                </div>
                </div>
            </div>
           </div>
            <div class="row">
                <div class="col-sm-12 tdSpeace print_right_50 ">
                <div class="page-panel-title"><b>@lang('Emergency Information')</b></div>
             
               <div class="row">
                    <div class="col-sm-6 ">
                    <table class="table for_leftside">
                        <tr>
                            <td style="width: 62%;">@lang('Name') <span class="float-right">:</span></td>
                            <td style="width: 38%;">{{$input['contactperson']??''}}</td>

                        </tr>
                        <tr>
                            <td style="width: 62%;">@lang('Relationship') <span class="float-right">:</span></td>
                            <td style="width: 38%;">{{$input['realation']??''}}</td>

                        </tr>

                    </table>
                </div>
                <div class="col-sm-6 ">
                    <table class="table for_rightside">
                        <tr>
                            <td style="width: 62%;">@lang('E-mail') <span class="float-right">:</span></td>
                            <td style="width: 38%;">{{$input['gEmail']??''}}</td>

                        </tr>
                        <tr>
                            <td style="width: 62%;">@lang('Date') <span class="float-right">:</span></td>
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
                        <div class="col-md-6 print_left_50 tdSpeace ppr0  ">
                    <div class="page-panel-title pd" ><b>@lang('Present Address')</b></div>
                    <table class="table ">
                        <tr>
                            <td style="width:62%;">@lang('Village') <span class="float-right">:</span></td>
                            <td style="width:38%;">{{$presentAddress}}</td>
                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('Post Code') <span class="float-right">:</span></td>
                            <td style="width:38%;">{{$perpostcode}}</td>
                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('Post Office') <span class="float-right">:</span></td>
                            <td style="width:38%;">{{$perpostoffice}}</td>

                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('Thana') <span class="float-right">:</span></td>
                            <td style="width:38%;">{{$preThana}}</td>
                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('District') <span class="float-right">:</span></td>
                            <td style="width:38%;">{{$preDistrict}}</td>
                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('Division') <span class="float-right">:</span></td>
                            <td style="width:38%;">{{$preDivision}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6 print_right_50 tdSpeace ppr0  ">
                    <div class="page-panel-title" ><b>@lang('Permanent Address')</b></div>
                    <table class="table ">
                        <tr>
                            <td>@lang('Village') <span class="float-right">:</span></td>
                            <td>{{$pastAddress}}</td>

                        </tr>
                        <tr>
                            <td style="width:60%;">@lang('Post Code') <span class="float-right">:</span></td>
                            <td style="width:38%;">{{$pastpostcode}}</td>

                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('Post Office') <span class="float-right">:</span></td>
                            <td style="width:38%;">{{$pastpostoffice}}</td>

                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('Thana') <span class="float-right">:</span></td>
                            <td style="width:38%;">{{$pastThana}}</td>
                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('District') <span class="float-right">:</span></td>
                            <td style="width:38%;">{{$pastDistrict}}</td>
                        </tr>
                        <tr>
                            <td style="width:62%;">@lang('Division') <span class="float-right">:</span></td>
                            <td style="width:38%;">{{$pastDivision}}</td>
                        </tr>
                    </table>
                </div>
                 </div>
             </div>
             </div>
                    <div class="form-group  text-center">
                        
                        <a class="btn btn-primary" href="{{route('apply.admission')}}"> @lang('Back')</a>
                         <button class="btn  btn-primary" type="submit" >@lang('Submit')</button>

                    </div>

            </form>
         
        </div>
    </div>
</div>

 <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
