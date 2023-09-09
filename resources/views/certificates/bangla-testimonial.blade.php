@extends('layouts.app')

@section('content')

<style>
	.spn{
		border-bottom: 1px dashed #000000;
		padding-bottom: 2px;
	}
	.two-div {
    padding-left: 25px!important;
    padding-right: 25px!important;
    margin-top: 5px!important;
}
.p-for{
	margin-top: 35px!important;
}

.float-left{
	float: left!important;
}
.p-0{
	padding: 0!important;
}
</style>
<div class="col-md-2"></div>
<div class="col-md-10" style="width: 78%;">
<div class="design ">
	<img src="{{asset('certificate_image/c14.jpg')}}" alt="certification" border="0">  
	
		<div class="centered col-md-12">
			<div class="col-md-3 pr-0">
				<div class="forImg">
					<img src="{{asset('image/demo.png')}}" alt="demo" style="width: 29%; float:right;">
				</div>
			</div>
			 <div class="col-md-9 text-center">
				<div class="div2" style=" float: left; ">
					<!-- <h3 style=" font-size:20px; font-weight:bold;  margin-bottom: 5px; margin-top: 0px;"> Bangladesh language and cultural foundation</h3> -->

					<h3 style="margin-top: 25px; font-size:20px; font-weight:bold;  margin-bottom: 5px;"> Bangladesh language and cultural foundation</h3>

					<span style="font-size:18px; font-weight:400;">{{school('address')}}</span></br>
					<!-- <img src="{{asset('image/demo.png')}}" alt="demo" style="width: 16%; margin-top: 10px ;"> </br> -->
					{{--<div style="font-size:30px; font-weight:bold; margin-top: 40px ;">Testimonial</div>--}}
					
		
				</div>
		
			 </div>

			<div class="col-md-6 two-div">
     <!-- 	<div class="div pull-left" style=" ">
            <span style="font-size:16px; font-weight:400;">@lang('ক্রমিক নং- :')<span class="spn">1555155220</span>
          </span>
					
				</div>  -->

				<div class="div pull-left" style="margin-left: 26px; margin-top: 26px; ">
            <span style="font-size:16px; font-weight:400;">@lang('ক্রমিক নং- ')<span class="spn">1555155220</span>
          </span>
					
				</div> 
      </div>	
      <div class="col-md-6 two-div">
     	<!-- <div class="div pull-right" style="">
            <span style="font-size:16px; font-weight:400;">@lang('তারিখঃ ')<span class="spn">1555155220</span>
          </span>
					
				</div>  -->

				<div class="div pull-right" style="margin-right: 26px; margin-top: 26px; ">
            <span style="font-size:16px; font-weight:400;">@lang('তারিখঃ ')<span class="spn">1555155220</span>
          </span>
					
				</div> 
      </div>
      <div class="col-md-12 text-center">
      	<div style="font-size:30px; font-weight:bold; margin-top: 20px ;"> প্রশংসাপত্র </div>
      </div>
			<div class="col-sm-12 two-div"> 
				<p class="p-for text-justify l-hight25">

					এই মর্মে প্রশংসা পত্র প্রদান করা যাচ্ছে যে<span class="spn"> চিরিরবন্দর </span>
					পিতাঃ <span class="spn"> চিরিরবন্দর </span> মাতাঃ <span class="spn">চিরিরবন্দর </span>
					গ্রামঃ <span class="spn"> চিরিরবন্দর </span>
					ডাকঘরঃ <span class="spn"> চিরিরবন্দর </span>
					উপজেলাঃ <span class="spn"> চিরিরবন্দর </span>
					জেলাঃ <span class="spn"> বাঞ্ছারামপুর </span>
					অত্র বিদ্যালয় হতে <span class="spn"> 2020 </span> সনে মাধ্যমিক ও উচ্চ মাধ্যমিক শিক্ষা বোর্ড, <span class="spn"> 2020 </span> এর অধীন অনুষ্ঠিত <span class="spn"> চিরিরবন্দর </span> বিভাগ হতে গ্রেড পয়েন্ট গড় <span class="spn">  </span>  পেয়ে উত্তীর্ণ হয়েছে ।  তার বোর্ড পরীক্ষার সেন্টারঃ  <span class="spn">  </span> বোর্ড রোলঃ <span class="spn"> </span> রেজিঃ <span class="spn">  </span> পাশের সন : <span class="spn">  </span>. বিদ্যালয়ের  ভর্তিবহি অনুযায়ী তার জন্ম তারিখ  <span class="spn"> ২০১১-০৪-০৫ </span>ইং।
					

				</p>
				<p class="p-for text-justify">
					বিদ্যালয়ের পাঠ্যাবস্থায় সে বিদ্যালয়ে বা রাষ্ট্র বিরোধী কোনো কাজে অংশ গ্রহণ করেনি ।আমার জানামতে তার আচরণ প্রশংসনীয় এবং সে উত্তম ও নৈতিক চরিত্রের  অধিকারী ।
				</p> 
			</div>
   <div class="clearfix"></div>
   <div class="col-sm-6 two-div ">
				<p class=" float-left">আমি তার সার্বিক উন্নতি কামনা করি ।</p>
				<table class="table">
					<tbody> 
					<tr>
						<td class="p-5 "><b>শিক্ষার্থীর আইডি নং <span class="pull-right">:</span></b></td>
						<td class="p-5">Asif shihab protik</td>
					</tr>
					<tr>
						<td class="p-5 "><b>শিক্ষার্থীর মন্তব্য <span class="pull-right">:</span></b></td>
						<td class="p-5">Asif shihab protik</td>
					</tr>
				</tbody>
			</table> 
			</div>
			
			<div class="col-md-6 two-div"></div>
  <div class="clearfix"></div>
      <div class="col-md-6 text-center">
       
       <div class="d-print-block ">
        <div class="pull-left teacherl" >
          ----------------------
          <div class="clearfix"></div>
          <span class="border_dot">
                    @lang('প্রধান শিক্ষক<br>
চিরিরবন্দর, চিরিরবন্দর, চিরিরবন্দর<br>বাঞ্ছারামপুর')
          </span>
        </div>

      </div>
     
    </div>
    <div class="col-md-6">

     <div class="pull-right teacherR" align="center">
      ----------------------
      <div class="clearfix"></div>
       <span class="border_dot">
                    @lang('প্রধান শিক্ষক<br>
চিরিরবন্দর, চিরিরবন্দর, চিরিরবন্দর<br>বাঞ্ছারামপুর')
          </span>
    </div>
 
      </div>

	</div>
	
	</div>
</div>


@endsection 

