@extends('layouts.app') @section('content')
<style>
span.cls_002{font-family:Arial,serif !important;font-size:20.1px !important;color:rgb(0,0,0) !important;font-weight:bold !important;font-style:normal !important;text-decoration: none !important;}
div.cls_002{font-family:Arial,serif !important;font-size:20.1px !important;color:rgb(0,0,0) !important;font-weight:bold;font-style:normal !important;text-decoration: none !important;}
span.cls_003{font-family:"Century Schoolbook Bold",serif !important;font-size:20.1px !important;color:rgb(0,0,0) !important;font-weight:bold !important;font-style:normal !important;text-decoration: none !important;}
div.cls_003{font-family:"Century Schoolbook Bold",serif !important;font-size:20.1px !important;color:rgb(0,0,0) !important;font-weight:bold !important;font-style:normal !important;text-decoration: none !important;}
span.cls_004{font-family:"Century Schoolbook Bold",serif !important;font-size:12.1px !important;color:rgb(0,0,0) !important;font-weight:bold !important;font-style:normal !important;text-decoration: none !important}
div.cls_004{font-family:"Century Schoolbook Bold",serif !important;font-size:12.1px !important;color:rgb(0,0,0);font-weight:bold !important;font-style:normal !important;text-decoration: none !important}
span.cls_013{font-family:Times,serif !important;font-size:20.1px !important;color:rgb(0,0,0) !important;font-weight:bold !important;font-style:normal !important;text-decoration: underline !important}
div.cls_013{font-family:Times,serif 1 !important;font-size:15.1px 1 !important;color:rgb(0,0,0) 1 !important;font-weight:bold 1 !important;font-style:normal 1 !important;text-decoration: none 1 !important}
span.cls_014{font-family:Times,serif !important;font-size:10.0px !important;color:rgb(0,0,0) !important;font-weight:bold !important;font-style:normal  !important;text-decoration: underline !important}
div.cls_014{font-family:Times,serif !important;font-size:10.0px !important;color:rgb(0,0,0) !important;font-weight:bold !important;font-style:normal !important;text-decoration: none !important}
span.cls_005{font-family:Times,serif !important;font-size:12.1px !important;color:rgb(0,0,0) !important;font-weight:bold !important;font-style:normal !important;text-decoration: none !important}
div.cls_005{font-family:Times,serif !important;font-size:12.1px !important;color:rgb(0,0,0) !important;font-weight:bold !important;font-style:normal !important;text-decoration: none !important}
span.cls_009{font-family:Times,serif !important;font-size:14.1px !important;color:rgb(0,0,0) !important;font-weight:normal !important;font-style:normal !important;text-decoration: none !important}
div.cls_009{font-family:Times,serif !important;font-size:14.1px !important;color:rgb(0,0,0) !important;font-weight:normal !important;font-style:normal !important;text-decoration: none !important}
span.cls_012{font-family:"Comic Sans MS Bold",serif !important;font-size:12.1px !important;color:rgb(0,0,0) !important;font-weight:bold !important;font-style:normal !important;text-decoration: none !important}
div.cls_012{font-family:"Comic Sans MS Bold",serif !important;font-size:12.1px !important;color:rgb(0,0,0) !important;font-weight:bold !important;font-style:normal !important;text-decoration: none !important}
.imglogo img{
   width: 45% !important;
    margin-top: 57px !important;
    margin-left: 43px !important;
}
.cls_013{
    margin-top: 30px !important;
}
.dotted {
    border-bottom-style: dotted !important;
    border-bottom-width: thin !important;
    display: inline-block !important;
   
    
}
.heading h3{
    font-size: 20px !important;
    margin-top: 78px !important;
}

</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar"> 
        @include('layouts.leftside-menubar') 
       </div>
        <div class="col-md-10" id="main-container">
    
            <div class="page-panel-title" style="margin-left: 5px;"> <a>@lang('Certificate')</a><span> / </span> <span><b>@lang('TC')</b></span> </div>
            <div class="clearfix"></div> 
            @include('components.sectionbar.certificate-bar')
            <div class="clearfix" style="clear: both;"></div>
                        <button class="printbtn btn  btn-success  "
    onclick="printDiv()" style="margin-top: 10px !important;"
    role="button" id="btnPrint"><i class="fa fa-print"></i> @lang('Print')
</button>
<div class="clearfix" style="clear: both;"></div>
           
             
              <div class="firstclass" style="position:relative !important;left:50% !important;margin-left:-306px !important;top:0px !important;width:712px !important;height:892px !important;overflow:hidden !important;" id="printDiv">
        <div style="position:absolute;left:0px;top:0px">
            <img src="{{asset('image/bal3.jpg')}}" width=712 height=892>
           </div>
           <div class="col-md-3" >
                 <div class="imglogo" style="position: absolute;" >
                    <img src="{{asset('image/demo.png')}}" alt="demo"> 
                     
               </div>
           </div>
           <div class="clearfix" style="clear: both;"></div>
           <div class="col-md-12" style=" ">
            <div class="heading text-center">
                   
                     <h3 class="margin">{{school('name')}}</h3>
                     <h5 class="margin">{{school('address')}}</h5>
                      
                                    
               </div>
              
           </div>
           <div class="clearfix" style="clear: both;"></div>
           <div class="col-md-12">
               <div style="" class="cls_013 text-center"><span class="cls_013">TRANSFER CERTIFICATE</span></div>
           </div>
            
           
            
          
            <div style="position:absolute;left: 435.87px;top: 238.72px;" class="cls_005"><span class="cls_005">Student Code: <span class="dotted">{{$tc->student->student_code}} </span> </span></div>
            <div style="position:absolute;left: 70.82px;top: 215.72px;" class="cls_005"><span class="cls_005">SL. NO. : <span class="dotted">{{school('code').$tc->id}} </span> </span></div>
           
            <div style="position:absolute;left: 435.87px;top: 215.72px;" class="cls_005"><span class="cls_005">Admission No. : <span class="dotted">{{$admission['roll']??''}}</span></span></div>
            

            <div style="position:absolute;left:64.82px;top:265.61px" class="cls_009"><span class="cls_009">1.</span></div>
            <div style="position:absolute;left:82.82px;top:265.61px" class="cls_009"><span class="cls_009">@lang('Name of the students') : <span class="dotted">{{$tc->student->name}}</span></span></div>
            <div style="position:absolute;left:64.82px;top:292.25px" class="cls_009"><span class="cls_009">2.</span></div>
            <div style="position:absolute;left:82.82px;top:292.25px" class="cls_009"><span class="cls_009">@lang('Father’s Name') : <span class="dotted">{{$tc->student->studentInfo->father_name}}</span></span></div>
            <div style="position:absolute;left:64.82px;top:318.89px" class="cls_009"><span class="cls_009">3.</span></div>
            <div style="position:absolute;left:82.82px;top:318.89px" class="cls_009"><span class="cls_009">@lang('Mother’s Name') : <span class="dotted">{{$tc->student->studentInfo->mother_name}}</span></span></div>
            <div style="position:absolute;left:64.82px;top:345.65px" class="cls_009"><span class="cls_009">4.</span></div>
            <div style="position:absolute;left:82.82px;top:345.65px" class="cls_009"><span class="cls_009">@lang('First admission class in the school') : <span class="dotted">{{$tc->first_ad_class}}</span></span></div>
            <div style="position:absolute;left:64.82px;top:372.29px" class="cls_009"><span class="cls_009">5.</span></div>
            <div style="position:absolute;left:82.82px;top:372.29px" class="cls_009"><span class="cls_009">@lang('Date of birth') : <span class="dotted">{{$tc->student->studentInfo->birthday}}</span></span></div>
            <div style="position:absolute;left:64.82px;top:399.05px" class="cls_009"><span class="cls_009">6.</span></div>

            <div style="position:absolute;left:82.82px;top:399.05px" class="cls_009"><span class="cls_009">@lang('Present Address') : Village <span class="dotted">{{$tc->student->studentInfo->present_address}}&nbsp&nbsp</span>Post Office <span class="dotted">{{$tc->student->studentInfo->present_post_office}}&nbsp&nbsp</span>Post Code <span class="dotted">{{$tc->student->studentInfo->present_postcode}}&nbsp&nbsp</span>Thana <span class="dotted">{{getThanaName($tc->student->studentInfo->present_thana)}}&nbsp&nbsp</span></span></div>
            <div style="position:absolute;left:82.82px;top:425.81px" class="cls_009">District <span class="dotted">{{getDistrictName($tc->student->studentInfo->present_district)}}&nbsp&nbsp</span>Division <span class="dotted">{{getDivisionName($tc->student->studentInfo->present_division)}}</span></div>

             <div style="position:absolute;left:64.82px;top:450.81px" class="cls_009"><span class="cls_009">7.</span></div>

            <div style="position:absolute;left:82.82px;top:450.81px" class="cls_009"><span class="cls_009">@lang('Permanent Address') : Village <span class="dotted">{{$tc->student->studentInfo->permanent_address}}&nbsp&nbsp</span>Post Office <span class="dotted">{{$tc->student->studentInfo->permanent_post_office}}&nbsp&nbsp</span>Post Code <span class="dotted">{{$tc->student->studentInfo->permanent_postcode}}&nbsp&nbsp</span>Thana <span class="dotted">{{getThanaName($tc->student->studentInfo->permanent_thana)}}</span></span></div>

            <div style="position:absolute;left:82.82px;top:485.81px" class="cls_009">District <span class="dotted">{{getDistrictName($tc->student->studentInfo->permanent_district)}}&nbsp&nbsp</span>Division <span class="dotted">{{getDivisionName($tc->student->studentInfo->present_division)}}</span></div>

             <div style="position:absolute;left:64.82px;top:515.57px" class="cls_009"><span class="cls_009">8.</span></div>

            <div style="position:absolute;left:82.82px;;top:515.57px" class="cls_009"><span class="cls_009">@lang('Class in which student last studied') : <span class="dotted">{{$tc->laststudied}}</span></span></span></div>

    

            <div style="position:absolute;left:64.82px;top:545.33px" class="cls_009"><span class="cls_009">9.</span></div>

            <div style="position:absolute;left:82.82px;top:545.33px" class="cls_009"><span class="cls_009">@lang('Date of last class in the school') : <span class="dotted">{{$tc->date_lastclass}}</span></span></span> </div>

            <div style="position:absolute;left:58.82px;top:575.09px" class="cls_009"><span class="cls_009">10.</span></div>

            <div style="position:absolute;left:82.82px;top:575.09px" class="cls_009"><span class="cls_009">@lang('School dues paid or not') : <span class="dotted">{{$tc->dues}}</span></span></div>

             <div style="position:absolute;left:58.82px;top:605.85px" class="cls_009"><span class="cls_009">11.</span></div>

            <div style="position:absolute;left:82.82px;top:605.85px" class="cls_009"><span class="cls_009">@lang('Reasons for leaving the school') : <span class="dotted">{{$tc->reason}}</span></span></div>

            <div style="position:absolute;left:58.82px;top:630.61px" class="cls_009"><span class="cls_009">12.</span></div>

            <div style="position:absolute;left:82.82px;top:630.61px" class="cls_009"> <span class="cls_009">@lang('Any other remarks') : <span class="dotted">{{$tc->remark}}</span></span></div>

             <div style="position:absolute;left:58.82px;top:670.61px" class="cls_009"><span class="cls_009">13.</span></div>

            <div style="position:absolute;left:82.82px;top:670.61px" class="cls_009"> <span class="cls_009">@lang('Behaviour of the student') : <span class="dotted">{{$tc->behaviour}}</span></span></div>

            

            <div style="position:absolute;left: 82.82px;top: 750.44px;" class="cls_005">
            <span class="cls_005">{{date('Y-m-d',strtotime($tc->date))}}</span></div>

            <div style="position:absolute;left: 82.82px;top: 760.44px;" class="cls_005">
            <span class="cls_005">--------------------</span></div>

            <div style="position:absolute;left: 108.82px;top: 776.44px;" class="cls_005">
            <span class="cls_005">Date</span></div>

            <div style="position:absolute;left: 542.9px;top: 760.44px;" class="cls_005"><span class="cls_005">--------------------</span></div>
            <div style="position:absolute;left: 559.9px;top: 776.44px;" class="cls_005"><span class="cls_005">Principal </span></div>
            
             
           
        </div>
             
           
        </div>
    </div>
</div>
<script>
                                    function printDiv() {
                                        currentDateTime("printTime");
                                        var divToPrint = document.getElementById('printDiv');
                                        var newWin = window.open('', 'Print-Window');
                                        newWin.document.open();
                                        newWin.document.write('<html><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>@page {size: a4 portrait;}.label{border:none;}.clearhight50{clear:both;height:50px}.heading h3{font-size: 20px !important;margin-top: 78px !important;}.imglogo img{width: 45% !important;margin-top: 57px !important;margin-left: 43px !important;}.cls_013{margin-top: 30px !important;}.clearfix{clear: both !important;}span.cls_002{font-family:Arial,serif !important;font-size:20.1px !important;color:rgb(0,0,0) !important;font-weight:bold !important;font-style:normal !important;text-decoration: none !important;}div.cls_002{font-family:Arial,serif !important;font-size:20.1px !important;color:rgb(0,0,0) !important;font-weight:bold;font-style:normal !important;text-decoration: none !important;}</style>' + divToPrint.innerHTML + '</body></html>');
                                        newWin.document.close();
                                        setTimeout(function () {
                                            newWin.close();
                                        }, 100);
                                    }
                                </script>

@endsection