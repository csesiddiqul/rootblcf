@extends('layouts.app')

@section('title', __('Students Info'))
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <style>
        li.right-li a {
            height: 29px;
            width: 30px;
            border-radius: 50%;
            border: 1px solid #2635CE;
            padding: 5px;
            line-height: 19px;
            text-align: center;
        }
        li.right-li a:hover {
            border: 1px solid #343c93;
        }
        li.right-li a:hover i {
            color: #000;
        }
    </style>
@endpush
@section('content')
    @component('components.cropper.editelement',['width'=>'270','height'=>'270','type'=>'squre','table_name'=>'users','table_id'=>$user->id,'table_field'=>'pic_path']) @endcomponent
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default pt-0">
                    <div class="panel-heading">
                        @php
                            $passcode = "/".($user->role=='student' ? 1:0)."/".($user->role=='teacher' ? 1: ($user->role=='student' ? 0:2));
                        @endphp
                        <a id="topback" href="{{ url('/users/'.Auth::user()->school->code.$passcode)}}"  class="">{{trans(ucfirst($user->role))}}</a> / @lang('Profile')
                    </div>
                    <div class="panel-body content" id="table-content">
                        <div class="row">
                            <div align="center" class="d-none d-print-block">
                                <div class="imga" style="display: inline-block;">
                                    <h2 class="font-Brush">
                                        &nbsp&nbsp&nbsp {{Auth::user()->school->name}}</h2>
                                    <h4 style="margin-top: -10px;"
                                        class="font-Brush">{{Auth::user()->school->address}}</h4>
                                    @if(foqas_setting('marksheet_established') == 1)
                                        <h4 style="margin-top: -10px;"
                                            class="font-Brush">@lang('Established')
                                            : {{school('established')}}</h4>
                                    @endif
                                    @php $logo = getLogo();
                                                 if (serverIsLocal())
                                                     $imageSize = array();
                                                else
                                                    $imageSize = getimagesize($logo);
                                    @endphp
                                    <img src="{{$logo}}"
                                         alt="{{Auth::user()->school->name}}"
                                         style="width: {{(isset($imageSize[0]) && $imageSize[0] == '80' && $imageSize[1] == '80') ? '20%' : '10%'}};margin-top: 5px;">
                                </div>
                                <h4 class="underline font-cursive">@lang('Student Profile')</h4>
                            </div>
                            <div class="clearhight15"></div>
                            <div class="col-md-3 pl-5">
                                <div class="box box-primary">
                                    <div class="box-body box-profile">
                                        @if(!empty($user->pic_path))
                                            <img data-src="{{asset('img/proloading.gif')}}"
                                                 src="{{url($user->pic_path)}}"
                                                 class="profile-user-img img-circle img-responsive img-thumbnail"
                                                 id="my-profile" alt="Profile Picture" width="100%">
                                            <div class="btn-group removeUpImage d-print-none"
                                                 onclick="img_confirm_delete('users','{{$user->id}}','pic_path','your Profile Photo')">
                                                <span class="btn btn-info btn-sm">@lang('Remove')</span>
                                                <span class="btn btn-danger btn-sm">&times;</span>
                                            </div>
                                        @else
                                            @if(\Auth::user()->role == 'admin' || \Auth::user()->id == $user->id)
                                                <div class="image-upload d-print-none">
                                                    <label for="file-upload">
                                                        <img src="{{asset('img/profile.png')}}" id="preview_image"
                                                             class="profile-user-img img-circle img-responsive">
                                                    </label>
                                                    <input type="file" value="" class="file-upload" id="file-upload"
                                                           accept="image/*">
                                                </div>
                                                <div style="clear:both;"></div>
                                            @endif
                                        @endif

                                        {{--<img class="profile-user-img img-responsive img-circle"
                                             src="https://demo.smart-school.in/uploads/student_images/1.jpg"
                                             alt="User profile picture">--}}

                                        <h3 class="profile-username text-center">{{$user->name}}</h3>

                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item listnoback">
                                                <b>@lang('Status')</b>
                                                {!! $user->active == 1 ? '<span class="btn btn-xs allButton pull-right">'.trans('Active').'</span>' : ($user->active == 2 ? '<span class="btn btn-xs btn-warning pull-right">'.trans('Pending').'</span>':'<span class="btn btn-xs btn-danger pull-right">'.trans('Inactive').'</span>') !!}

                                            </li>
                                            <li class="list-group-item listnoback">
                                                <b>@lang('Code')</b><a
                                                        class="pull-right text-aqua">{{$user->student_code}}</a>
                                            </li>
                                            @if ($user->role == 'student')
                                                {{--<li class="list-group-item listnoback">
                                                    <b>Admission No</b> <a class="pull-right text-aqua">18001</a>
                                                </li>--}}
                                                {{--
                                            <li class="list-group-item listnoback">
                                            <b>Roll Number</b> <a class="pull-right text-aqua">101</a>
                                            </li>--}}
                                                <li class="list-group-item listnoback">
                                                    <b>@lang('Class')</b> <a
                                                            class="pull-right text-aqua">{{$user->section->class->name}}</a>
                                                </li>
                                                <li class="list-group-item listnoback">
                                                    <b>@lang(school('country')->code == 'SG' ? 'Level' : 'Section')</b><a
                                                            class="pull-right text-aqua">{{$user->section->section_number}}</a>
                                                </li>
                                            @endif
                                            @if($user->role == "teacher")
                                                <li class="list-group-item listnoback">
                                                    <b>@lang('Designation')</b> <a
                                                            class="pull-right text-aqua"> {{$user->role_title}}</a>
                                                </li>
                                                <li class="list-group-item listnoback">
                                                    <b>@lang('Department')</b> <a
                                                            class="pull-right text-aqua"> {{get_department($user->department_id)->department_name}}</a>
                                                </li>
                                                <li class="list-group-item listnoback">
                                                    <b>@lang('Created Date')</b> <a class="pull-right text-aqua"> {{$user->created_at->format('d M, Y')}}</a>
                                                </li>
                                            @endif

                                            @if(school('country')->code == 'SG' && isset($user->employeeDetail))
                                                @if($user->role == "teacher" || $user->role == "admin" || $user->role == "accountant" || $user->role == "librarian" || $user->role == "staff")
                                                    <li class="list-group-item listnoback">
                                                        <b>@lang('Branch')</b> <a class="pull-right text-aqua"><b>{{ isset($user->employeeDetail->house) ? $user->employeeDetail->house->name : "N/A" }}</b></a>
                                                    </li>
                                                @endif
                                            @endif

                                            @if($user->role == "student")
                                                <li class="list-group-item listnoback">
                                                    <b>@lang('Session')</b> <a
                                                            class="pull-right text-aqua"> @isset($user->studentInfo['session'])  {{getSessionById($user->studentInfo['session'],'schoolyear')}}@endisset</a>
                                                </li>
                                                <li class="list-group-item listnoback">
                                                    @if(school('country')->code == 'SG')
                                                        <b>@lang('NRIC No')</b> <span
                                                                class="pull-right text-aqua">@isset($user->studentInfo['dob_no']){{$user->studentInfo['dob_no']}}@endisset </span>
                                                    @else
                                                        <b>@lang('Roll')</b> <span
                                                                class="pull-right text-aqua">@isset($user->studentInfo['class_roll']){{$user->studentInfo['class_roll']}}@endisset</span>
                                                    @endif
                                                </li>
                                                <li class="list-group-item listnoback">
                                                    <b>@lang(school('country')->code == 'SG' ? 'Section' : 'Group')</b>
                                                    <a
                                                            class="pull-right text-aqua">@isset($user->studentInfo['group']){{$user->studentInfo['group']}}@endisset</a>
                                                </li>
                                                <li class="list-group-item listnoback">
                                                    <b>@lang(school('country')->code == 'SG' ? 'NTIL' : 'Version')</b>
                                                    <span
                                                            class="pull-right text-aqua">@isset($user->studentInfo['version']){{$user->studentInfo['version']}}@endisset</span>
                                                </li>
                                                <li class="list-group-item listnoback">
                                                    <b>{{subjectOrCourseName()}}</b> <a
                                                            class="pull-right text-aqua popTop"
                                                            id="courseGroup">@isset($user->studentInfo['coursegroup_id']){{courseGroupById($user->studentInfo['coursegroup_id'],'name')??''}}@endisset</a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                {{--@if ($user->role == 'student')
                                    <div class="box box-primary">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">@lang('Sibling')</h3>
                                        </div>
                                        <!-- /.box-header -->

                                        <div class="box-body">
                                            <div class="box box-widget widget-user-2">
                                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                                <div class="siblingview">
                                                    <img class=""
                                                         src="https://demo.smart-school.in/uploads/student_images/9.jpg"
                                                         alt="User Avatar">
                                                    <h4><a href="https://demo.smart-school.in/student/view/9">Emma
                                                            Thomas</a>
                                                    </h4>
                                                </div>
                                                <div class="box-footer no-padding">
                                                    <ul class="list-group list-group-unbordered">
                                                        <li class="list-group-item">


                                                            <b>Admission No</b> <a class="pull-right text-aqua">18012</a>
                                                        </li>

                                                        <li class="list-group-item">
                                                            <b>Class</b> <a class="pull-right text-aqua">Class 2</a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Section</b> <a class="pull-right text-aqua">B</a>

                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>


                                        </div>
                                        <!-- /.box-body -->

                                    </div>
                                @endif--}}
                                @if($user->role == 'student')
                                    @foreach($user->studentFile as $studentFile)
                                        <button type="button" class="{{btnClass()}}"
                                                data-toggle="modal" data-target="#{{renderSlug($studentFile->name)}}">
                                            {{trans($studentFile->name)}}
                                        </button>
                                    @endforeach
                                @endif
                                @if($user->role == 'teacher')
                                    <button type="button" class="{{btnClass()}}"
                                            data-toggle="modal" data-target="#{{renderSlug($user->name)}}">
                                        @lang('Curriculum Vitae')
                                    </button>
                                @endif
                            </div>
                            <div class="col-md-9">

                                <div class="nav-tabs-custom theme-shadow">
                                    <ul class="nav nav-tabs d-print-none">
                                        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="false"
                                                              data-original-title="" title="">@lang('Profile')</a></li>
                                        @if(auth()->user()->role == 'admin' && $user->role == 'student')
                                            <li class="">
                                                <a href="#fee" data-toggle="tab" aria-expanded="false"
                                                   data-original-title=""
                                                   title="">
                                                    @if(school('country')->code == 'SG')
                                                        @lang('Payment History')
                                                    @else
                                                        @lang('Financial Statement')
                                                    @endif
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="#issue_book" data-toggle="tab" aria-expanded="false"
                                                   data-original-title="" title="">
                                                    @lang('Library History')
                                                </a>
                                            </li>
                                        @endif
                                        @if(auth()->user()->role == 'admin')
                                            @if($user->role == 'teacher')
                                                <li class="">
                                                    <a href="#EducationSummary" data-toggle="tab" aria-expanded="false" data-original-title="" title="">
                                                        @lang('Education Summary')
                                                    </a>
                                                </li>
                                            @endif

                                            <li class="">
                                                <a href="#documents" data-toggle="tab" aria-expanded="false"
                                                   data-original-title="" title="">Bank Information</a>
                                            </li>
                                        @endif



                                        {{--<li class="pull-right dropdown">
                                            <a href="#" class="dropdown-toggle" type="button" data-toggle="dropdown"
                                               data-original-title="" title="" aria-expanded="false"><i
                                                        class="fa fa-ellipsis-v"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a style="cursor: pointer;" onclick="send_password()"> Send Student
                                                        Password</a></li>
                                                <li><a style="cursor: pointer;" onclick="send_parent_password()"> Send
                                                        Parent Password</a></li>
                                            </ul>
                                        </li>--}}

                                        {{--<li class="pull-right">
                                            <a style="cursor: pointer;" onclick="disable_student('1')" class="text-red"
                                               data-toggle="tooltip" data-placement="bottom" title="Disable">
                                                <i class="fa fa-thumbs-o-down"></i> </a>
                                        </li>--}}

                                        @if(Auth::user()->role == 'admin')
                                            <li class="pull-right right-li">
                                                <a href="{{route('user.changePasswordById',$user->student_code)}}"
                                                   class="schedule_modal text-green" data-toggle="tooltip"
                                                   data-placement="bottom" title="@lang('Change Password')"><i
                                                            class="fa fa-key"></i>
                                                </a>
                                            </li>
                                            <li class="pull-right right-li">
                                                <a href="{{route('salary.information',$user->student_code)}}"
                                                   class="schedule_modal text-green" data-toggle="tooltip"
                                                   data-placement="bottom" title="@lang('Salary Information')"><i
                                                            class="fa fa-usd"></i>
                                                </a>
                                            </li>
                                        @endif
                                        @if(Auth::user()->role == 'admin' || auth()->user()->id == $user->id)
                                            @if(Auth::user()->role != 'student')
                                                <li class="pull-right right-li">
                                                    <a href="{{route('user.edit',$user->student_code)}}" class=""
                                                       data-toggle="tooltip" data-placement="bottom" title="@lang('Edit')"><i
                                                                class="fa fa-pencil"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        @endif
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="activity">
                                            <div class="tshadow mb25 bozero">
                                                <div class="table-responsive around10 pt0">
                                                    <table class="table table-hover table-striped tmb0">
                                                        <tbody>
                                                        {{--  @if(school('country')->code != 'BD')
                                                             @if(branch_permission())
                                                                 <tr>
                                                                     <td>@lang('Branch')</td>
                                                                     <td>@isset($user->studentInfo['branch_id']){{getSchool($user->studentInfo['branch_id'],'name')}}@endisset</td>
                                                                 </tr>
                                                             @endif
                                                         @endif--}}
                                                        <tr>
                                                            <td>@lang('Phone Number')</td>
                                                            <td>{{$user->phone_number}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Email')</td>
                                                            <td>{{$user->email}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="col-md-4">@lang('Gender')</td>
                                                            <td class="col-md-5">
                                                                @if(isset($user->gender))
                                                                    {{gender($user->gender,true)}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>@lang('Blood Group')</td>
                                                            <td>
                                                                @if(isset($user->blood_group))
                                                                    {{bloodgroup($user->blood_group,true)}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @if($user->role != 'student')
                                                            @isset($user->employeeDetail)
                                                                <tr>
                                                                    <td>@lang('Date of Joining')</td>
                                                                    <td>
                                                                        {{ !empty($user->employeeDetail->joindate) ? date('d M, Y',strtotime($user->employeeDetail->joindate)): " N/A " }}
                                                                    </td>
                                                                </tr>
                                                            @endisset
                                                            <tr>
                                                                <td>@lang('Address')</td>
                                                                <td>
                                                                    {{$user->address}}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <td>@lang('Nationality')</td>
                                                            <td>
                                                                @if(!empty($user->nationality))
                                                                    {{ucfirst(nationalityArray($user->nationality))}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @if($user->role == 'student')
                                                            <tr>
                                                                <td>@lang('Religion')</td>
                                                                <td>@isset($user->studentInfo['religion']){{religon($user->studentInfo['religion'],true)}}@endisset</td>
                                                            </tr>
                                                            @isset($user->studentInfo['height'])
                                                                <tr>
                                                                    <td>@lang('Height')</td>
                                                                    <td>{{$user->studentInfo['height']}}</td>
                                                                </tr>
                                                            @endisset
                                                            @isset($user->studentInfo['weight'])
                                                                <tr>
                                                                    <td>@lang('Weight')</td>
                                                                    <td>{{$user->studentInfo['weight']}}</td>
                                                                </tr>
                                                            @endisset
                                                            @isset($user->studentInfo->category->name)
                                                                <tr>
                                                                    <td>@lang('Category')</td>
                                                                    <td>{{$user->studentInfo->category->name}}</td>
                                                                </tr>
                                                            @endisset
                                                            @isset($user->studentInfo->house->name)
                                                                <tr>
                                                                    <td>@lang('House')</td>
                                                                    <td>{{$user->studentInfo->house->name}}</td>
                                                                </tr>
                                                            @endisset
                                                            @isset($user->studentInfo['birthday'])
                                                                <tr>
                                                                    <td>@lang('Date of Birth')</td>
                                                                    <td>{{Carbon\Carbon::parse($user->studentInfo['birthday'])->format('d/m/Y')}}
                                                                        <b>({{age_calculation($user->studentInfo['birthday'])}}
                                                                            )</b></td>
                                                                </tr>
                                                            @endisset
                                                            <tr>
                                                                <td>@lang('Place of Birth')</td>
                                                                <td>@isset($user->studentInfo['placeBirth']){{$user->studentInfo['placeBirth']}}@endisset</td>
                                                            </tr>
                                                            @if(school('country')->code == 'BD')
                                                                <tr>
                                                                    <td>@lang('Birth Certificate No')</td>
                                                                    <td>@isset($user->studentInfo['dob_no']){{$user->studentInfo['dob_no']}}@endisset</td>
                                                                </tr>
                                                                @php $previous_class = 'Previous Class'; @endphp
                                                            @else
                                                                @php $previous_class = 'Previous Grade'; @endphp
                                                            @endif
                                                            @if(school('country')->code == 'SG')
                                                                <tr>
                                                                    <td>@lang('Resident Status')</td>
                                                                    <td>@isset($user->studentInfo['singaporepr']){{residentstatus($user->studentInfo['singaporepr'],true)}}@endisset</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('Knowledge of Bengali Language')</td>
                                                                    <td>@isset($user->studentInfo['bengaliLang']){{$user->studentInfo['bengaliLang']}}@endisset</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('Admission in Bengali Class')</td>
                                                                    <td>@isset($user->studentInfo['admission_bengali_class']){{$user->studentInfo['admission_bengali_class']}}@endisset</td>
                                                                </tr>
                                                            @endif
                                                            <tr>
                                                                <td>@lang(school('country')->code == 'SG' ? 'School'  : 'Previous School')</td>
                                                                <td>@isset($user->studentInfo['main_school_name_address']){{$user->studentInfo['main_school_name_address']}}@endisset</td>
                                                            </tr>
                                                            <tr>
                                                                <td>@lang($previous_class)</td>
                                                                <td>@isset($user->studentInfo['previous_class']){{$user->studentInfo['previous_class']}}@endisset</td>
                                                            </tr>
                                                            @if(school('country')->code == 'BD')
                                                                <tr>
                                                                    <td>@lang('Last GPA')</td>
                                                                    <td>@isset($user->studentInfo['last_gpa']){{$user->studentInfo['last_gpa']}}@endisset</td>
                                                                </tr>
                                                            @endif
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @if($user->role == "student")
                                                <div class="tshadow mb25 bozero">
                                                    <h3 class="pagetitleh2">@lang('Address') </h3>
                                                    <div class="table-responsive around10 pt0">
                                                        <table class="table table-hover table-striped tmb0">
                                                            <tbody>
                                                            @if(school('country')->code == 'BD')
                                                                <tr>
                                                                    <td class="text-center" colspan="2">
                                                                        <b>@lang('Present Address')</b></td>
                                                                    <td class="text-center" colspan="2">
                                                                        <b>@lang('Permanent Address')</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('Village')</td>
                                                                    <td>{{$user->studentInfo['present_address']}}</td>
                                                                    <td>@lang('Village')</td>
                                                                    <td>{{$user->studentInfo['permanent_address']}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('Post Office')</td>
                                                                    <td>{{$user->studentInfo['present_post_office']}}</td>
                                                                    <td>@lang('Post Office')</td>
                                                                    <td>{{$user->studentInfo['permanent_post_office']}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('Post Code')</td>
                                                                    <td>{{$user->studentInfo['present_postcode']}}</td>
                                                                    <td>@lang('Post Code')</td>
                                                                    <td>{{$user->studentInfo['permanent_postcode']}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('Thana')</td>
                                                                    <td>{{getThanaName($user->studentInfo['present_thana'])}}</td>
                                                                    <td>@lang('Thana')</td>
                                                                    <td>{{getThanaName($user->studentInfo['permanent_thana'])}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('District')</td>
                                                                    <td>{{getDistrictName($user->studentInfo['present_district'])}}</td>
                                                                    <td>@lang('District')</td>
                                                                    <td>{{getDistrictName($user->studentInfo['permanent_district'])}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>@lang('Division')</td>
                                                                    <td>{{getDivisionName($user->studentInfo['present_division'])}}</td>
                                                                    <td>@lang('Division')</td>
                                                                    <td>{{getDivisionName($user->studentInfo['permanent_division'])}}</td>
                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td class="col-md-4">@lang('Street Address 1')</td>
                                                                    <td class="col-md-5">{{$user->studentInfo['street_address_1']}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4">@lang('Street Address 2')</td>
                                                                    <td class="col-md-5">{{$user->studentInfo['street_address_2']}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4">@lang('City')</td>
                                                                    <td class="col-md-5">{{$user->studentInfo['city']}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4">@lang('Zip Code')</td>
                                                                    <td class="col-md-5">{{$user->studentInfo['zipCode']}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4">@lang('State')</td>
                                                                    <td class="col-md-5">@isset($user->studentInfo['state']){{getStateName($user->studentInfo['state'])}}@endisset</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4">@lang('Country')</td>
                                                                    <td class="col-md-5">@isset($user->studentInfo['country']){{getCountryName($user->studentInfo['country'])}}@endisset</td>
                                                                </tr>
                                                            @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="tshadow mb25 bozero">
                                                    <h3 class="pagetitleh2">@lang('Guardian Details') </h3>
                                                    <div class="table-responsive around10 pt10">
                                                        <table class="table table-hover table-striped tmb0">
                                                            <tbody>
                                                            <tr>
                                                                <td class="text-center" colspan="2">
                                                                    <b>@lang('Father Information')</b></td>
                                                                <td class="text-center" colspan="2">
                                                                    <b>@lang('Mother Information')</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td>@lang('Name')</td>
                                                                <td>@isset($user->studentInfo['father_name']){{$user->studentInfo['father_name']}}@endisset</td>
                                                                <td>@lang('Name')</td>
                                                                <td>@isset($user->studentInfo['mother_name']){{$user->studentInfo['mother_name']}}@endisset</td>
                                                            </tr>
                                                            <tr>
                                                                <td>@lang('Phone Number')</td>
                                                                <td>@isset($user->studentInfo['father_phone_number']){{$user->studentInfo['father_phone_number']}}@endisset</td>
                                                                <td>@lang('Phone Number')</td>
                                                                <td>@isset($user->studentInfo['mother_phone_number']){{$user->studentInfo['mother_phone_number']}}@endisset</td>
                                                            </tr>
                                                            <tr>
                                                                <td>@lang('National ID')</td>
                                                                <td>@isset($user->studentInfo['father_national_id']){{$user->studentInfo['father_national_id']}}@endisset</td>
                                                                <td>@lang('National ID')</td>
                                                                <td>@isset($user->studentInfo['mother_national_id']){{$user->studentInfo['mother_national_id']}}@endisset</td>
                                                            </tr>
                                                            <tr>
                                                                <td>@lang('Occupation')</td>
                                                                <td>@isset($user->studentInfo['father_occupation']){{$user->studentInfo['father_occupation']}}@endisset</td>
                                                                <td>@lang('Occupation')</td>
                                                                <td>@isset($user->studentInfo['mother_occupation']){{$user->studentInfo['mother_occupation']}}@endisset</td>
                                                            </tr>
                                                            <tr>
                                                                <td>@lang('Designation')</td>
                                                                <td>@isset($user->studentInfo['father_designation']){{$user->studentInfo['father_designation']}}@endisset</td>
                                                                <td>@lang('Designation')</td>
                                                                <td>@isset($user->studentInfo['mother_designation']){{$user->studentInfo['mother_designation']}}@endisset</td>
                                                            </tr>
                                                            <tr>
                                                                <td>@lang(school('country')->code == 'SG' ? 'Office Address' : 'Annual Income')</td>
                                                                <td>@isset($user->studentInfo['father_annual_income']){{$user->studentInfo['father_annual_income']}}@endisset</td>
                                                                <td>@lang(school('country')->code == 'SG' ? 'Home Address' : 'Annual Income')</td>
                                                                <td>@isset($user->studentInfo['mother_annual_income']){{$user->studentInfo['mother_annual_income']}}@endisset</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                @if(isset($user->studentInfo['gName']) || isset($user->studentInfo['gEmail']) || isset($user->studentInfo['gMobile']))
                                                    <div class="tshadow mb25 bozero">
                                                        <h3 class="pagetitleh2">@lang('Particulars Of Parents/Guardian') </h3>
                                                        <div class="table-responsive around10 pt10">
                                                            <table class="table table-hover table-striped tmb0">
                                                                <tbody>
                                                                <tr>
                                                                    <td class="col-md-4">@lang('Name')</td>
                                                                    <td class="col-md-5">@isset($user->studentInfo['gName']){{$user->studentInfo['gName']}}@endisset</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4">@lang('E-mail')</td>
                                                                    <td class="col-md-5">@isset($user->studentInfo['gEmail']){{$user->studentInfo['gEmail']}}@endisset</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4">@lang('Mobile')</td>
                                                                    <td class="col-md-5">@isset($user->studentInfo['gMobile']){{$user->studentInfo['gMobile']}}@endisset</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4">@lang('Phone')</td>
                                                                    <td class="col-md-5">@isset($user->studentInfo['gPhone']){{$user->studentInfo['gPhone']}}@endisset</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4">@lang('Address')</td>
                                                                    <td class="col-md-5">@isset($user->studentInfo['gAddress']){{$user->studentInfo['gAddress']}}@endisset</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4">@lang('Nationality')</td>
                                                                    <td class="col-md-5">@isset($user->studentInfo['gNationality']){{nationalityArray($user->studentInfo['gNationality'])}}@endisset</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4">@lang('Occupation')</td>
                                                                    <td class="col-md-5">@isset($user->studentInfo['gOccupation']){{$user->studentInfo['gOccupation']}}@endisset</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="col-md-4">@lang('Date of Birth')</td>
                                                                    <td class="col-md-5">@isset($user->studentInfo['gdate']){{$user->studentInfo['gdate']}}@endisset</td>
                                                                </tr>
                                                                @if(school('country')->code == 'SG')
                                                                    <tr>
                                                                        <td class="col-md-4">@lang('NRIC No./Passport No')</td>
                                                                        <td class="col-md-5">@isset($user->studentInfo['gnric_no']){{$user->studentInfo['gnric_no']}}@endisset</td>
                                                                    </tr>
                                                                @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="tshadow mb25 bozero">
                                                    <h3 class="pagetitleh2">@lang('Emergency Contact Information') </h3>
                                                    <div class="table-responsive around10 pt10">
                                                        <table class="table table-hover table-striped tmb0">
                                                            <tbody>
                                                            <tr>
                                                                <td class="col-md-4">@lang('Name')</td>
                                                                <td class="col-md-5">@isset($user->studentInfo['contact_person']){{$user->studentInfo['contact_person']}}@endisset</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-4">@lang('Mobile')</td>
                                                                <td class="col-md-5">@isset($user->studentInfo['contact_person_mobile']){{$user->studentInfo['contact_person_mobile']}}@endisset</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-4">@lang('Relationship')</td>
                                                                <td class="col-md-5">@isset($user->studentInfo['relation_with_cperson']){{$user->studentInfo['relation_with_cperson']}}@endisset</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="col-md-4">@lang('Address')</td>
                                                                <td class="col-md-5">@isset($user->studentInfo['contact_person_email']){{$user->studentInfo['contact_person_email']}}@endisset</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="tshadow mb25  bozero">
                                                <h3 class="pagetitleh2">@lang('About')</h3>

                                                <div class="table-responsive around10 pt0">
                                                    <table class="table table-hover table-striped tmb0">
                                                        <tbody>
                                                        @if($user->role == "student")

                                                            <tr>
                                                                <td>{{$user->about}}</td>
                                                            </tr>
                                                        @endif
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                        @if(auth()->user()->role == 'admin' && $user->role == 'student')
                                            <div class="tab-pane" id="fee">
                                                @include('students.ac_element')
                                            </div>
                                            <div class="tab-pane" id="issue_book">
                                                @include('students.library_history')
                                            </div>
                                        @endif
                                        @if(auth()->user()->role == 'admin')
                                            @if($user->role == 'teacher')
                                                <!--<div class="tab-pane" id="EducationSummary">
                                                @if(isset($user->teacherEducationInfo) && $user->teacherEducationInfo->count() > 0)
                                                    @include('teacherEducationInfo.view')
                                                @else
                                                    <div style="margin-top: 15px;">
                                                        @lang('No Related Data Found.')
                                                    </div>
                                                @endif
                                                </div>-->
                                            @endif

                                            <div class="tab-pane" id="documents">
                                                @if(isset($user->employeeDetail))
                                                    <table class="table table-bordered table-striped table-hover">
                                                        <tbody>
                                                        <tr>
                                                            <td width="20%">Bank Name</td>
                                                            <td width="80%">{{ $user->employeeDetail->bank_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Account No.</td>
                                                            <td>{{ $user->employeeDetail->account_no }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <div style="margin-top: 15px;">
                                                        @lang('No Related Data Found.')
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
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
                newWin.document.write('<html><title>{{$user->student_code.'-'.$user->name}}</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}"><link rel="stylesheet" href="{{ asset('css/profile.css') }}"><link rel="stylesheet" type="text/css" href="{{ asset('css/application.css') }}"><body onload="window.print()"><style>#btnPrint{display:none}.d-print-none{display:none}.table-responsive { overflow-x: unset;}.clearhight50{clear:both;height:50px}.clearhight25 {clear: both;height: 25px;}.clearhight15 {clear: both}.print_style {border: 1px dashed;position: relative;overflow: auto;padding: 0px 10px;min-height:97%}.div_break{padding: 10px 0;page-break-before: always;}.custom-tabel{background-color: #f0f0f0 !important;}.pull-left{float:left}.col-md-6,.col-sm-6{width:50%;float:left}.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{border:none !important}.center{text-align: center}.col-sm-3{width:25%;float:left} .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{padding: 6px !important;    font-size: 13px;}.table{margin-bottom:0px !important}legend{margin-bottom: 4px !important}.d-print-block{display:block}.col-sm-2 {width: 16.66666667%;float:left}</style>' + divToPrint.innerHTML + '</body></html>');
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
    @if($user->role == 'student')
        @foreach($user->studentFile as $studentFile)
            <div class="modal fade" id="{{renderSlug($studentFile->name)}}" tabindex="-1" role="dialog"
                 aria-labelledby="{{renderSlug($studentFile->name)}}Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        @php
                            $extension = pathinfo($studentFile->file, PATHINFO_EXTENSION);
                        @endphp
                        <div class="modal-header">
                            <h5 class="modal-title pull-left"
                                id="{{renderSlug($studentFile->name)}}Label">{{trans($studentFile->name)}}</h5>
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
                                    <img src="{{url('/').'/'.$studentFile->file}}" alt="{{$studentFile->name}}" class="w-100"/>
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
    @endif
    @if($user->role == 'teacher')
        <div class="modal fade" id="{{renderSlug($user->name)}}" tabindex="-1" role="dialog"
             aria-labelledby="{{renderSlug($user->name)}}Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    @php
                        $extension = pathinfo($user->cv, PATHINFO_EXTENSION);
                    @endphp
                    <div class="modal-header">
                        <h5 class="modal-title pull-left"
                            id="{{renderSlug($user->name)}}Label">{{$user->name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        @if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg')
                            <button type="button"
                                    onclick="printDiv('img-{{renderSlug($user->name)}}'); return false;">
                                @lang('Print')
                            </button>
                        @endif
                    </div>
                    <div class="modal-body">
                        @if($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg')
                            <div id="img-{{renderSlug($user->name)}}">
                                <img src="{{$user->cv}}" alt="{{$user->name}}" class="w-100"/>
                            </div>
                        @elseif($extension == 'pdf')
                            <iframe src="{{$user->cv}}" style="width:100%; height:500px;" frameborder="0"
                                    allowfullscreen></iframe>
                        @elseif($extension == 'doc' || $extension == 'docx')
                            <div class="news-normal-block" style="cursor: pointer;     padding-bottom: 50px;">
                                <img style="width: 30%;" src="{{getIconByExtension($extension)}}" alt="doc">
                                <div class="news-btn mt-3">
                                    <a href="{{$user->cv}}" download
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
    @endif
@endsection
@push('styles')
    <style>
        .listnoback .popover.fade {
            width: 100% !important;
        }
    </style>
@endpush
@push('script')
    @isset($user->studentInfo['coursegroup_id'])
        <script>
            $(function () {
                $.post('{{url("/")}}/getCourseByGroup/{{$user->studentInfo["coursegroup_id"]}}', function (data) {
                    $("#courseGroup").attr('data-content', data);
                });
            });
        </script>
    @endisset
@endpush
