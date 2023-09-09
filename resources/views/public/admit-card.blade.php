@extends('public.layout.public',['title' => transMsg('Admit Card') ])

@section('content')

    <section>
        <div class="container ">
           <div class="admit-card1 " id="SelectorToPrint">
                <div class="admit-card2 " >
                <div class="BoxA  padding mar-bot">
                    <div class="row">
                        <div class="col-sm-12 ">
                            <div class="row">
                                <!--  left logo start  Design 1-->

                                @if(strlen($admitTemplete->llogo)>4)
                                    <div class="col-sm-3">
                                        <div class="logo float-left ">
                                            <img src="{{ $admitTemplete->llogo }}" alt="" width="100">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                @else
                                    <div class="offset-sm-3"></div>
                                @endif
                            <!--  left logo end  -->


                                <!--  middle start -->
                                <div class="col-sm-6 text-center">
                                    <div class="text-center">
                                        <h3 class="margin">{{school('name')}}</h3>
                                        <h5 class="margin">{{school('address')}}</h5>
                                        @if(strlen($admitTemplete->mlogo)>4)

                                            <div class="logo margin text-center ">
                                                <img src="{{ $admitTemplete->mlogo }}" alt="" width="100">
                                                <div class="clearfix"></div>
                                            </div>



                                        @endif
                                        <h4 class="margin">{{$admitTemplete->examname}}</h4>
                                        <h4 class="margin">{{$admitTemplete->heading}}</h4>

                                    </div>
                                </div>

                                <!--  middle end -->

                                <!--  right image start -->
                                @if(strlen($admitTemplete->rlogo)>4)
                                    <div class="col-sm-3">
                                        <div class="logo float-right ">
                                            <img src="{{ $admitTemplete->rlogo }}" alt="" width="100">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                @elseif($admitTemplete->photo_position == '1' && strlen($input->photo)>4 && $admitTemplete->is_photo == '1')
                                    <div class="col-sm-3 flx mt-3">
                                        <div class="float-right profile_image">
                                            <img src="{{$input->photo}}" width="100px;"/>
                                        </div>
                                    </div>
                                @endif
                                @if($admitTemplete->photo_position == '2' && strlen($input->photo)>4 && strlen($admitTemplete->rlogo)>4 && $admitTemplete->is_photo == '1')
                                    <div class="col-sm-3 offset-sm-9 mt-3">
                                        <div class="float-right profile_image">
                                            <img src="{{$input->photo}}" width="100px;"/>
                                        </div>
                                    </div>
                            @endif
                            <!--  right image end -->
                            </div>
                        </div>


                    </div>
                </div>
                @if($admitTemplete->info_position == '1')
                    <div class="BoxD   mar-bot">
                        <div class="row">
                            <div class="col-sm-6 padding_bottom">
                                <table class="table ">
                                    <tbody>
                                    @if($admitTemplete->is_name == '1')
                                        <tr>
                                            <td><b>@lang('Student Name') <span class="float-right">:</span></b></td>
                                            <td>{{$input['name']??''}}</td>
                                        </tr>
                                    @endif
                                    @if($admitTemplete->is_admission_id == '1')
                                        <tr>

                                            <td><b>@lang('Admission Roll')<span class="float-right">:</span></b></td>
                                            <td>{{$input['roll']??''}}</td>

                                        </tr>
                                    @endif

                                    @if($admitTemplete->is_class == '1')
                                        <tr>

                                            <td><b>{{school('country')->code == 'BD' ? 'Class' : 'Enroll In'}} <span
                                                            class="float-right">:</span></b></td>
                                            <td>
                                            
                                            {{getClassBySection($input['class_id'],'name')}}
                                        </td>
                                        </tr>
                                    @endif
                                    @if($admitTemplete->is_section == '1')
                                        <tr>


                                            <td><b>@lang('Section') <span class="float-right">:</span></b></td>
                                            <td>@lang('Morning')</td>
                                        </tr>
                                    @endif
                                    @if($admitTemplete->is_session == '1')
                                        <tr>

                                            <td><b>@lang('Session') <span class="float-right">:</span></b></td>
                                            <td>@lang('Morning')</td>
                                        </tr>
                                    @endif


                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6 padding_bottom">
                                <table class="table ">
                                    <tbody>
                                    @if($admitTemplete->is_fname == '1')
                                        <tr>
                                            <td><b>@lang('Father Name')<span class="float-right">:</span></b></td>
                                            <td>{{$input['father_name']??''}}</td>

                                        </tr>
                                    @endif
                                    @if($admitTemplete->is_mname == '1')
                                        <tr>
                                            <td><b>@lang('Mother Name')<span class="float-right">:</span></b></td>
                                            <td>{{$input['mother_name']??''}}</td>
                                        </tr>
                                    @endif

                                    @if($admitTemplete->is_email == '1')
                                        <tr>
                                            <td><b>@lang('Email')<span class="float-right">:</span></b></td>
                                            <td>{{$input['email']??''}}</td>
                                        </tr>
                                    @endif
                                    @if($admitTemplete->is_phone == '1')
                                        <tr>
                                            <td><b>@lang('Mobile')<span class="float-right">:</span></b></td>
                                            <td>{{$input['mobile']??''}}</td>
                                        </tr>
                                    @endif
                                    @if($admitTemplete->is_address == '1')
                                        <tr>
                                            <td><b>@lang('Address')<span class="float-right">:</span></b></td>
                                            <td><b>@lang('Nine')</b></td>
                                        </tr>
                                    @endif


                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                @endif
                @if($admitTemplete->info_position == '2')
                    <div class="BoxD   mar-bot ">
                        <div class="row">
                            <div class="col-sm-12 ">
                                <table class="table width_line">
                                    <tbody>
                                    @if($admitTemplete->is_name == '1')
                                        <tr>
                                            <td><b>@lang('Student Name') <span class="float-right">:</span></b></td>
                                            <td>{{$input['name']??''}}</td>
                                        </tr>
                                    @endif
                                    @if($admitTemplete->is_admission_id == '1')
                                        <tr>

                                            <td><b>@lang('Admission Roll')<span class="float-right">:</span></b></td>
                                            <td>{{$input['roll']??''}}</td>

                                        </tr>
                                    @endif

                                    @if($admitTemplete->is_class == '1')
                                        <tr>

                                            <td><b>{{school('country')->code == 'BD' ? 'Class' : 'Enroll In'}} <span
                                                            class="float-right">:</span></b></td>
                                            <td>
                                            {{getClassBySection($input['class_id'],'name')}}</td>
                                        </tr>
                                    @endif
                                    @if($admitTemplete->is_section == '1')
                                        <tr>


                                            <td><b>@lang('Section') <span class="float-right">:</span></b></td>
                                            <td>@lang('Morning')</td>
                                        </tr>
                                    @endif
                                    @if($admitTemplete->is_session == '1')
                                        <tr>

                                            <td><b>@lang('Session') <span class="float-right">:</span></b></td>
                                            <td>@lang('Morning')</td>
                                        </tr>
                                    @endif
                                    @if($admitTemplete->is_fname == '1')
                                        <tr>
                                            <td><b>@lang('Father Name')<span class="float-right">:</span></b></td>
                                            <td>{{$input['father_name']??''}}</td>

                                        </tr>
                                    @endif
                                    @if($admitTemplete->is_mname == '1')
                                        <tr>
                                            <td><b>@lang('Mother Name')<span class="float-right">:</span></b></td>
                                            <td>{{$input['mother_name']??''}}</td>
                                        </tr>
                                    @endif

                                    @if($admitTemplete->is_email == '1')
                                        <tr>
                                            <td><b>@lang('Email')<span class="float-right">:</span></b></td>
                                            <td>{{$input['email']??''}}</td>
                                        </tr>
                                    @endif
                                    @if($admitTemplete->is_phone == '1')
                                        <tr>
                                            <td><b>@lang('Mobile')<span class="float-right">:</span></b></td>
                                            <td>{{$input['mobile']??''}}</td>
                                        </tr>
                                    @endif
                                    @if($admitTemplete->is_address == '1')
                                        <tr>
                                            <td><b>@lang('Address')<span class="float-right">:</span></b></td>
                                            <td>@lang('Nine')</td>
                                        </tr>
                                    @endif


                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                @endif

                <div class="BoxF   mar-bot ">
                    <div class="col-sm-12 text-justify">
                        <h5 class="margin">@lang('Examination Center :') <span class="font">{{$admitTemplete->examcenter}}</span></h5>
                      
                    </div>
                </div>
 {{--
                <div class="BoxF  padding mar-bot txt-center">
                    <div class="row">
                        <div class="col-sm-12 ">
                            <table class="table ">
                                <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Subject/Paper</th>
                                    <th>Exam Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>English</td>
                                    <td>5 July 2019</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>English</td>
                                    <td>5 July 2019</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>English</td>
                                    <td>5 July 2019</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                --}}
                <div class="BoxF   mar-bot mt-3">
                    
                        <div class="col-sm-12 text-justify ">
                            <h5 class="margin mb-2">@lang('General Instructions:')</h5>
                            <span class=" instruction">{!!$admitTemplete->bodyText!!}</span>
                        </div>
                    
                </div>

                <div class="BoxF  padding mar-bot " style="margin-top: 20px;">
                    <div class="row">
                        @if(strlen($admitTemplete->lsign)>4 && strlen($admitTemplete->lsign_title)>4)
                            <div class="col-sm-4">
                                <div class="signature float-left" style=" width: 220px;">
                                    <img style="float: left;width: 170px;margin-bottom: 10px; "
                                         src="{{ $admitTemplete->lsign }}" width="100px">
                                    <div class="sign float-left">{!!nl2br($admitTemplete->lsign_title)!!}</div>
                                </div>
                            </div>
                        @elseif( strlen($admitTemplete->lsign_title)>4)
                        <div class="col-sm-4 d-flex align-items-end justify-content-start">
                                <div class="signature float-left" style=" width: 220px;">
                                    
                                    <div class="sign float-left">{!!nl2br($admitTemplete->lsign_title)!!}</div>
                                </div>
                            </div>
                        @else
                            <div class="offset-sm-4"></div>
                        @endif
                        @if(strlen($admitTemplete->msign)>4 && strlen($admitTemplete->msign_title)>4)
                            <div class="col-sm-4">
                                <div class="signature text-center" style=" ">
                                    <img style="text-align: center; width: 170px;margin-bottom: 10px; "
                                         src="{{ $admitTemplete->msign }}" width="100px">
                                    <div class="sign float-right">{!!nl2br($admitTemplete->msign_title)!!}</div>
                                </div>
                            </div>
                       @elseif( strlen($admitTemplete->msign_title)>4)
                        <div class="col-sm-4 d-flex align-items-end justify-content-center">
                                <div class="signature " style=" width: 170px;">
                                    
                                    <div class="sign ">{!!nl2br($admitTemplete->msign_title)!!}</div>
                                </div>
                            </div>
                        @else
                            <div class="offset-sm-4"></div>
                        @endif
                        @if(strlen($admitTemplete->rsign)>4 && strlen($admitTemplete->rsign_title)>4)
                            <div class="col-sm-4 lign-items-end justify-content-end">
                                <div class="signature float-right" style=" width: 220px;">
                                    <img style="float: right;width: 170px;margin-bottom: 10px; "
                                         src="{{ $admitTemplete->rsign }}" width="100px">
                                    <div class="rsign float-right">{!!nl2br($admitTemplete->rsign_title)!!}</div>
                                </div>
                            </div>
                       @elseif( strlen($admitTemplete->rsign_title)>4)
                        <div class="col-sm-4 d-flex align-items-end justify-content-end">
                                <div class="signature float-right" style=" width: 220px;">
                                    
                                    <div class="rsign float-right">{!!nl2br($admitTemplete->rsign_title)!!}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <footer class="txt-center ftr">
                    <p class="margin">{!!$admitTemplete->footerText!!}</p>
                </footer>

            </div>
           </div>
           {{--
            <div class="" style="margin-top: 20px;">
                <button class="printbtn btn  btn-success" onclick="PrintDoc()" style="margin-top: 10px;"
                        role="button" id="btnPrint"><i class="fa fa-print"></i> @lang('Print')
                </button>

            </div>
            --}}

        </div>

    </section>
@endsection
@push('script')
    @if($admitTemplete->page == 'a4')
        @php $pageCss = asset("public/css/pagesizea4.css") @endphp
    @else
        @php $pageCss = asset("public/css/pagesizea5.css") @endphp
    @endif

    <script>
        window.addEventListener('load', function () {
            window.print()
        })
    </script>
     <link rel="stylesheet" type="text/css" href="{{$pageCss}}">
@endpush
