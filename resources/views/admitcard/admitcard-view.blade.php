@extends('layouts.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/print.css')}}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('exams').'">'. trans('Exams').'</a>  / <b>'. trans('Admit Card').'<b>'])
                @include('components.sectionbar.examination-bar')
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::open(['route' => 'exams.admitcard.view', 'method' => 'post']) !!}
                        <div class="col-md-3 pl-0">
                            <div class="form-group{{ $errors->has('exam') ? ' has-error' : '' }}">
                                {!! Form::label('exam', trans('Exam'), ['class' => 'control-label']) !!}
                                {!! Form::select('exam',$exam_array, $request_exam ?? null, array('required', 'class' => 'select2 form-control','placeholder'=>trans('Choose'))) !!}
                                @error('exam')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group{{ $errors->has('section') ? ' has-error' : '' }} ">
                                {!! Form::label('section', trans('Section'), ['class' => 'control-label']) !!}
                                {!! Form::select('section',$section, $request_section ?? null, array('required', 'class' => 'select2 form-control','onchange'=>'getStudentsBySection(this.value,1)', 'placeholder' => trans('Choose'))) !!}
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
                                {!! Form::select('student[]',array(), null, array('id' => 'student','required', 'class' => 'select2 form-control', 'multiple')) !!}
                                @error('student')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3 pl-0">
                            <div class="form-group{{ $errors->has('template') ? ' has-error' : '' }}">
                                {!! Form::label('template', trans('Admit Template'), ['class' => 'control-label']) !!}
                                {!! Form::select('template',$admitCardPluck, null, array('id' => 'template','required','placeholder'=>transMsg('Choose'), 'class' => 'select2 form-control')) !!}
                                @error('template')
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
                        @if (empty($session))
                            <div class="clearfix"></div>
                            <code><i><b>*@lang('Note')
                                        :</b> @lang('There has no session active now.') <a
                                            href="{{route('academic.session.index')}}"
                                            target="_blank">@lang('Please active an session first.')</a></i></code>
                        @endif
                    </div>
                    @if(isset($admitTemplete))
                        <div class="clearfix"></div>
                        <hr>
                        @if($students->count())
                            <section id="table-content">
                            <span class="pull-left">
                                <button class="btn btn-xs btn-success d-print-none" role="button" id="btnPrint"
                                        onclick="printDiv()"><i class="fa fa-print"></i> @lang('Print')
                                </button>
                            </span>
                                <div class="clearfix"></div>
                                @foreach($students as $users)
                                    <div class="admit-card1 div_break" id="SelectorToPrint">
                                        <div class="admit-card2">
                                            <div class="BoxA  padding mar-bot">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <!--  left logo start  Design 1-->
                                                            @if(strlen($admitTemplete->llogo)>4)
                                                                <div class="col-sm-3">
                                                                    <div class="logo pull-left ">
                                                                        <img src="{{ $admitTemplete->llogo }}" alt=""
                                                                             width="100">
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="col-sm-3"></div>
                                                            @endif
                                                        <!--  left logo end  -->
                                                            <!--  middle start -->
                                                            <div class="col-sm-6 text-center">
                                                                <div class="text-center">
                                                                    <h3 class="margin">{{school('name')}}</h3>
                                                                    <h5 class="margin">{{school('address')}}</h5>
                                                                    @if(strlen($admitTemplete->mlogo)>4)
                                                                        <div class="logo margin text-center ">
                                                                            <img src="{{ $admitTemplete->mlogo }}"
                                                                                 alt=""
                                                                                 width="100">
                                                                            <div class="clearfix"></div>
                                                                        </div>
                                                                    @endif
                                                                    <h4 class="margin">{{$find_exam->exam_name ?? $admitTemplete->examname}}</h4>
                                                                    <h4 class="margin">{{$admitTemplete->heading}}</h4>
                                                                </div>
                                                            </div>
                                                            <!--  middle end -->
                                                            <!--  right image start -->
                                                            @if(strlen($admitTemplete->rlogo)>4)
                                                                <div class="col-sm-3">
                                                                    <div class="logo pull-right ">
                                                                        <img src="{{ $admitTemplete->rlogo }}" alt=""
                                                                             width="100">
                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                            @elseif($admitTemplete->photo_position == '1' && strlen($users->pic_path)>4 && $admitTemplete->is_photo == '1')
                                                                <div class="col-sm-3 flx mt-3" style="margin-top: 5px;">
                                                                    <div class="pull-right profile_image">
                                                                        <img src="{{$users->pic_path}}" width="100px;"/>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if($admitTemplete->photo_position == '2' && strlen($users->pic_path)>4 && strlen($admitTemplete->rlogo)>4 && $admitTemplete->is_photo == '1')
                                                                <div class="col-sm-3 offset-sm-9 mt-3">
                                                                    <div class="pull-right profile_image">
                                                                        <img src="{{$users->pic_path}}" width="100px;"/>
                                                                    </div>
                                                                </div>
                                                        @endif
                                                        <!--  right image end -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($admitTemplete->info_position == '1')
                                                <div class="BoxD  mar-bot">
                                                    <div class="row">
                                                        <div class="col-sm-6 width-50">
                                                            <table class="table table-borderless">
                                                                <tbody>
                                                                @if($admitTemplete->is_name == '1')
                                                                    <tr>
                                                                        <td width="30%"><b>@lang('Student Name')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->name}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($admitTemplete->is_admission_id == '1')
                                                                    <tr>
                                                                        <td><b>@lang('Student ID')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->student_code}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($admitTemplete->is_class == '1')
                                                                    <tr>
                                                                        <td>
                                                                            <b>{{transMsg(school('country')->code == 'BD' ? 'Class' : 'Grade')}}
                                                                                <span class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->section->class->name}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($admitTemplete->is_section == '1')
                                                                    <tr>
                                                                        <td><b>@lang('Section')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->section->section_number}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($admitTemplete->is_session == '1')
                                                                    <tr>
                                                                        <td><b>@lang('Session')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->studentInfo->sessions->schoolyear ?? ''}}</td>
                                                                    </tr>
                                                                @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-sm-6 width-50">
                                                            <table class="table ">
                                                                <tbody>
                                                                @if($admitTemplete->is_fname == '1')
                                                                    <tr>
                                                                        <td width="30%"><b>@lang('Father Name')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->studentInfo->father_name??''}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($admitTemplete->is_mname == '1')
                                                                    <tr>
                                                                        <td><b>@lang('Mother Name')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->studentInfo->mother_name??''}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($admitTemplete->is_email == '1')
                                                                    <tr>
                                                                        <td><b>@lang('Email')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->email}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($admitTemplete->is_phone == '1')
                                                                    <tr>
                                                                        <td><b>@lang('Mobile')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->phone_number}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($admitTemplete->is_address == '1')
                                                                    <tr>
                                                                        <td><b>@lang('Address')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->address}}</td>
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
                                                        <div class="col-sm-12 padding_bottom">
                                                            <table class="table width_line">
                                                                <tbody>
                                                                @if($admitTemplete->is_name == '1')
                                                                    <tr>
                                                                        <td width="30%"><b>@lang('Student Name') <span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->name}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($admitTemplete->is_admission_id == '1')
                                                                    <tr>
                                                                        <td><b>@lang('Student ID')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->student_code}}</td>
                                                                    </tr>
                                                                @endif

                                                                @if($admitTemplete->is_class == '1')
                                                                    <tr>
                                                                        <td>
                                                                            <b>{{transMsg(school('country')->code == 'BD' ? 'Class' : 'Grade')}}
                                                                                <span class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->section->class->name}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($admitTemplete->is_section == '1')
                                                                    <tr>
                                                                        <td><b>@lang('Section')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->section->section_number}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($admitTemplete->is_session == '1')
                                                                    <tr>
                                                                        <td><b>@lang('Session')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->studentInfo->session->schoolyear??''}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($admitTemplete->is_fname == '1')
                                                                    <tr>
                                                                        <td width="30%"><b>@lang('Father Name')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->studentInfo->father_name??''}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($admitTemplete->is_mname == '1')
                                                                    <tr>
                                                                        <td><b>@lang('Mother Name')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->studentInfo->mother_name??''}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($admitTemplete->is_email == '1')
                                                                    <tr>
                                                                        <td><b>@lang('Email')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->email}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($admitTemplete->is_phone == '1')
                                                                    <tr>
                                                                        <td><b>@lang('Mobile')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->phone_number}}</td>
                                                                    </tr>
                                                                @endif
                                                                @if($admitTemplete->is_address == '1')
                                                                    <tr>
                                                                        <td><b>@lang('Address')<span
                                                                                        class="pull-right">:</span></b>
                                                                        </td>
                                                                        <td>{{$users->address}}</td>
                                                                    </tr>
                                                                @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="BoxE" style="padding-left: 10px">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h5 class="margin">@lang('Examination Center'): <span
                                                                    class="font">{{$admitTemplete->examcenter}}</span>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="BoxF  padding mar-bot ">
                                                <div class="row">
                                                    <div class="col-sm-12 text-justify">
                                                        <h5 class="margin">@lang('General Instructions'):</h5>
                                                        <span class=" instruction">{!!$admitTemplete->bodyText!!}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="BoxF  padding mar-bot" style="margin-top: 20px;">
                                                <div class="row">
                                                    @if(strlen($admitTemplete->lsign)>4 && strlen($admitTemplete->lsign_title)>4)
                                                        <div class="col-sm-4">
                                                            <div class="signature float-left" style=" width: 220px;">
                                                                <img style="width: 170px;margin-bottom: 10px; "
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
                                                        <div class="col-sm-4"></div>
                                                    @endif
                                                    @if(strlen($admitTemplete->msign)>4 && strlen($admitTemplete->msign_title)>4)
                                                        <div class="col-sm-4" align="center">
                                                            <div class="signature text-center"
                                                                 style="display: inline-grid;">
                                                                <img style="text-align: center; width: 170px;margin-bottom: 10px; "
                                                                     src="{{ $admitTemplete->msign }}" width="100px">
                                                                <div class="sign float-right"
                                                                     style="display: inline-block;">{!!nl2br($admitTemplete->msign_title)!!}
                                                                    gfgdfgdf
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @elseif( strlen($admitTemplete->msign_title)>4)
                                                        <div class="col-sm-4 d-flex align-items-end justify-content-center"
                                                             align="center">
                                                            <div class="signature " style=" width: 170px;">
                                                                <div class="sign ">{!!nl2br($admitTemplete->msign_title)!!}</div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-sm-4"></div>
                                                    @endif
                                                    @if(strlen($admitTemplete->rsign)>4 && strlen($admitTemplete->rsign_title)>4)
                                                        <div class="col-sm-4 lign-items-end justify-content-end pull-right">
                                                            <div class="signature pull-right">
                                                                <img style="width: 170px;margin-bottom: 10px; "
                                                                     src="{{ $admitTemplete->rsign }}" width="100px">
                                                                <div class="rsign float-right">{!!nl2br($admitTemplete->rsign_title)!!}</div>
                                                            </div>
                                                        </div>
                                                    @elseif( strlen($admitTemplete->rsign_title)>4)
                                                        <div class="col-sm-4 d-flex align-items-end justify-content-end">
                                                            <div class="signature pull-right" style=" width: 220px;">
                                                                <div class="rsign pull-right">{!!nl2br($admitTemplete->rsign_title)!!}</div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <footer class="txt-center ftr">
                                                <p class="margin">{!!$admitTemplete->footerText!!}</p>
                                            </footer>
                                        </div>
                                        <div align="center" style="font-size: 8px;margin-bottom: -7px;"
                                             class="d-print-block d-none">
                                            Developed by : {{reseller()->name}}
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                @endforeach
                            </section>
                            @push('script')
                                @if($admitTemplete->page == 'a4')
                                    @php $pageCss = asset("public/css/pagesizea4.css") @endphp
                                @else
                                    @php $pageCss = asset("public/css/pagesizea5.css") @endphp
                                @endif
                                <link rel="stylesheet" type="text/css" href="{{$pageCss}}">
                                <script>
                                    function printDiv() {
                                        var divToPrint = document.getElementById('table-content');
                                        var newWin = window.open('', 'Print-Window');
                                        newWin.document.open();
                                        newWin.document.write('<html><title>@lang("Admit Card")</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><link rel="stylesheet" type="text/css" href="{{asset('public/css/print.css')}}"><link rel="stylesheet" type="text/css" href="{{$pageCss}}"><body onload="window.print()"><style>#btnPrint{display:none}.d-print-none{display:none}.clearhight50{clear:both;height:50px}.clearhight25 {clear: both;height: 25px;}.clearhight15 {clear: both}.print_style {border: 1px dashed;position: relative;overflow: auto;padding: 0px 10px;min-height:97%}.div_break{padding: 10px 0;page-break-before: always;}.custom-tabel{background-color: #f0f0f0 !important;} .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{font-size:12px; border: none;padding: 2.5px;}.table-borderless > thead > tr > th, .table-borderless > tbody > tr > th, .table-borderless > tfoot > tr > th, .table-borderless > thead > tr > td, .table-borderless > tbody > tr > td, .table-borderless > tfoot > tr > td{border: none !important;} .width-50{width:50%;position: relative;min-height: 1px;padding-left: 17px;padding-right: 17px;float:left}.instruction {font-size: 14px !important;}.col-sm-3 {width: 25%;float:left}.col-sm-6{width: 50%;float:left}.admit-card1{ margin: 7px;}</style>' + divToPrint.innerHTML + '</body></html>');
                                        newWin.document.close();
                                        setTimeout(function () {
                                            newWin.close();
                                        }, 5000);
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
                            <span>@lang('Student not found') </span>
                        @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
    <style>
        .instruction {
            font-size: 14px !important;
        }

        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            border: none !important;
        }
    </style>
@endsection
