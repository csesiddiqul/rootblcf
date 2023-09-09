e@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/testimonials.css')}}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10 firstDiv1" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.certificate.create').'">'. trans('Certificate').'</a> / <b>'.trans('Testimonials').'<b>'])
                @include('components.sectionbar.certificate-bar')
                <div class="clearfix"></div>
                <div class="panel panel-default">
                    <div class="panel-body pl-0">
                        {!! Form::open(['route' => 'academic.testimonials', 'method' => 'post']) !!}
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('section') ? ' has-error' : '' }} ">
                                {!! Form::label('section', trans('Section'), ['class' => 'control-label']) !!}
                                {!! Form::select('section',$section, $request_section ?? null, array('required', 'class' => 'select2 form-control','onchange'=>'getStudentsBySection(this.value,0,1)', 'placeholder' => trans('Choose'))) !!}
                                @error('section')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 pl-0">
                            <div class="form-group{{ $errors->has('student') ? ' has-error' : '' }}">
                                {!! Form::label('student', trans('Student'), ['class' => 'control-label']) !!}
                                {!! Form::select('student',array(), null, array('id' => 'student','required', 'class' => 'select2 form-control','onchange'=>'getBoardExamByStudent(this.value)')) !!}
                                @error('student')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 pl-0">
                            <div class="form-group{{ $errors->has('board_exam') ? ' has-error' : '' }}">
                                {!! Form::label('board_exam', trans('Board Exam'), ['class' => 'control-label']) !!}
                                {!! Form::select('board_exam',array(), null, array('id'=>'board_exam','required', 'class' => 'select2 form-control')) !!}
                                @error('board_exam')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" id="registerBtn" class="{{btnClass()}}"
                                    @if (!useragentMobile()) style="margin-top:27px"@endif>
                                @lang('Get')
                            </button>
                        </div>
                        {!! Form::close() !!}


                        @if(isset($student->id))
                            <span class="pull-right mt-4" style="margin-top: 30px;">
                                <button class="btn btn-sm btn-success d-print-none" role="button" id="btnPrint"
                                        onclick="printDiv()"><i class="fa fa-print"></i> @lang('Print')
                                </button>
                            </span>
                        @endif
                        <div class="clearfix"></div>
                        <div class="col-md-12">
                            @if(isset($student->id))
                                <div class="clearfix"></div>
                                <div class="design" id="SelectorToPrint">
                                    <div class="bg">
                                        <img class="design2" src="{{asset('certificate_image/c14.jpg')}}"
                                             alt="certification"
                                             border="0">
                                    </div>
                                    <div class="centered col-md-12">
                                        <div class="col-md-4 pr-0 img1" style="float: left;">
                                            <img src="{{asset('image/demo.png')}}" alt="demo">
                                        </div>
                                        <div class="col-md-8 text-center" style="float: left;">
                                            <div class="div2" style="">
                                                <h3 class="thirdDiv3" style="">{{school('name')}}</h3>
                                                <span class="forthDiv4" style="">{{school('address')}}</span>
                                            <!-- <img src="{{asset('image/demo.png')}}" alt="demo" style="width: 16%; margin-top: 10px ;"> </br> -->
                                                {{--<div style="font-size:30px; font-weight:bold; margin-top: 40px ;">Testimonial</div>--}}
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-6 two-div">
                                            {{-- <div class="div pull-right" style="">
                                                 <span style="font-size:16px; font-weight:400;">Serial No:<span class="spn">1555155220</span>
                                               </span>
                                                     </div>
                                              <div class="div pull-left fifthDiv5" style=" ">
                                                      <span class="sixthDiv6" style="">Serial No:<span class="spn">1555155220</span>
                                                    </span>
                                              </div>--}}
                                        </div>
                                        <div class="col-md-6 two-div">
                                            <!-- <div class="div pull-left" style=" ">
                                             <span style="font-size:16px; font-weight:400;">Serial No:<span class="spn">1555155220</span>
                                           </span>
                                                 </div> -->
                                            <div class="div pull-right seventhDiv7" style="">
                                            <span class="eighthDiv8" style="">
                                                Serial No:<span class="spn"> {{date('ymdhm')}}</span>
                                          </span>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-md-12 text-center">
                                            <div class="ninethDiv9" style="">Testimonial</div>
                                        </div>
                                        <div class="col-sm-12 two-div">
                                            <p class="p-for text-justify l-hight25">
                                                This is to certify that
                                                <span class="spn"> {{$student->name}}  </span>Son/Daughter of<span
                                                        class="spn"> {{$student->studentInfo->father_name}} </span>
                                                and <span
                                                        class="spn">{{$student->studentInfo->mother_name}} </span><span> , </span>Village
                                                -
                                                <span class="spn"> {{$student->studentInfo->permanent_address}} </span>
                                                Post office : <span
                                                        class="spn"> {{$student->studentInfo->permanent_post_office}} </span>
                                                Thana - <span
                                                        class="spn"> {{getThanaName($student->studentInfo->permanent_thana)}} </span>
                                                District - <span
                                                        class="spn"> {{getDistrictName($student->studentInfo->permanent_district)}} </span>Passed
                                                the <span
                                                        class="spn"> {{$board_exam->exam_name ?? ''}}   </span>
                                                from {{school('name')}} under the Board of
                                                Intermediate and Secondary
                                                Education, {{$board_exam->board ?? ''}}. His Board Exam
                                                Center - <span
                                                        class="spn">{{$board_exam->institution_name ?? ''}}</span>
                                                Roll No- <span
                                                        class="spn"> {{$board_exam->roll ?? ''}}  </span>
                                                Registration No: <span
                                                        class="spn"> {{$board_exam->registration ?? ''}} </span>
                                                Passing year - <span
                                                        class="spn"> {{$board_exam->passing_year ?? ''}} </span>.
                                                Institute admission follow with his record date of birth <span
                                                        class="spn">{{date('Y-m-d',strtotime($student->studentInfo->birthday))}} </span>
                                                Session of <span
                                                        class="spn">{{$board_exam->session ?? ''}} </span>his
                                                Grade Point Average (GPA) is
                                                <span class="spn"> {{number_format($board_exam->gpa,2) ?? ''}} </span>on
                                                a scale of {{number_format($board_exam->out_of_gpa,2) ?? ''}}.
                                            </p>
                                            <p class=" text-justify f-size16">
                                                His/her conduct and character were satisfactory. He/she was not found to
                                                take
                                                part in any activity subversive of the state or of discipline during
                                                his/her
                                                stay in the institution.
                                            </p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="col-sm-6 two-div tbl">
                                            <p class=" float-left f-size16">I wish him/her all success in life.</p>
                                            {{--   <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td class="p-5 pl-0 b-none"><b><span class="f-size16">Student Id</span>
                                                            <span class="pull-right">:</span></b></td>
                                                    <td class="p-5 f-size16 b-none">
                                                        <span class="f-size16">{{$student->student_code}}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="p-5 pl-0 f-size16 b-none"><b>
                                                            <span class="f-size16">Remarks</span>
                                                            <span class="pull-right">:</span></b>
                                                    </td>
                                                    <td class="p-5 f-size16 b-none"><span class="f-size16"> </span></td>
                                                </tr>
                                                </tbody>
                                            </table>--}}
                                        </div>
                                        {{--    <div class="col-md-6 text-center">

                                             <div class="d-print-block ">
                                                   <div class="pull-left teacherl">
                                                       ----------------------
                                                       <div class="clearfix"></div>
                                                       <span class="border_dot">
                                                               @lang('Principal Signature<br>
                                           Ranirbandar,Chirirbandar,<br>Dinajpur')
                                                     </span>
                                                   </div>

                                               </div>

                                        </div>--}}
                                        <div class="col-md-6">
                                            <div class="pull-right teacherR" align="center">
                                                ----------------------
                                                <div class="clearfix"></div>
                                                <span class="border_dot">
                                        @lang('Head Teacher')<br>
                                            {{school('name')}} <br>
                                            {{school('address')}}
                                      </span>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                @push('script')
                                    <script>
                                        function printDiv() {
                                            var divToPrint = document.getElementById('SelectorToPrint');
                                            var newWin = window.open('', 'Print-Window');
                                            newWin.document.open();
                                            newWin.document.write('<html><title>@lang("Testimonials")</title><link rel="stylesheet" type="text/css" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><link rel="stylesheet" type="text/css" href="{{asset('public/css/print.css')}}"><link rel="stylesheet" type="text/css" href="{{asset('css/certificate.css')}}"><link rel="stylesheet" type="text/css" href="{{asset('css/testimonials.css')}}"><body onload="window.print()"><style>#btnPrint{display:none}.d-print-none{display:none}.clearhight50{clear:both;height:50px}.clearhight25 {clear: both;height: 25px;}.clearhight15 {clear: both}.print_style {border: 1px dashed;position: relative;overflow: auto;padding: 0px 10px;min-height:97%}.div_break{padding: 10px 0;page-break-before: always;}.custom-tabel{background-color: #f0f0f0 !important;} .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{font-size:12px; border: none;padding: 2.5px;}.table-borderless > thead > tr > th, .table-borderless > tbody > tr > th, .table-borderless > tfoot > tr > th, .table-borderless > thead > tr > td, .table-borderless > tbody > tr > td, .table-borderless > tfoot > tr > td{border: none !important;} .width-50{width:50%;position: relative;min-height: 1px;padding-left: 17px;padding-right: 17px;float:left}.instruction {font-size: 14px !important;}.col-sm-3 {width: 25%;float:left}.col-sm-6{width: 50%;float:left}.admit-card1{ margin: 7px;}</style>' + divToPrint.innerHTML + '</body></html>');
                                            newWin.document.close();
                                            setTimeout(function () {
                                                newWin.close();
                                            }, 100);
                                        }

                                        jQuery(document).bind("keyup keydown", function (e) {
                                            if (e.ctrlKey && e.keyCode == 80) {
                                                printDiv();
                                                return false;
                                            }
                                        });
                                    </script>
                                @endpush
                            @else
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 

