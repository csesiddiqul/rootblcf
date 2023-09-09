@extends('layouts.app',['title' => transMsg('Register') ])
@section('content')
    @component('components.cropper.element',['width'=>'270','height'=>'270','type'=>'square']) @endcomponent
    <style>
        .red {
            color: red;
        }

        @media (min-width: 768px) {
            .form-horizontal .form-group {
                margin-left: 0px !important;
                margin-right: 0px !important;
            }
        }

        .button-wrapper {
            text-align: center;
        }

        .button-wrapper span.label {
            display: inline-block;
            width: 100%;
            background: #18bc9c;
            cursor: pointer;
            color: #fff;
            padding: 12px 0;
            font-size: 1.2rem;
            border-radius: .2rem;
        }

        .upload-box {
            display: inline-block;
            position: absolute;
            z-index: 1;
            width: 100%;
            height: 50px;
            top: 20px;
            left: 0;
            opacity: 0;
            cursor: pointer;
        }

        .button-wrapper span.label:hover {
            color: #fff;
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
          rel="stylesheet">
    <div class="container-fluid">
        <div class="row">
            @if(\Auth::user()->role == 'master')
                <div class="col-md-2" id="side-navbar">
                    @include('layouts.master-left-menu')
                </div>
            @else
                <div class="col-md-2" id="side-navbar">
                    @include('layouts.leftside-menubar')
                </div>
            @endif
            @php
                $cName = school('country')->code == 'BD' ? 'Subjects' : 'Courses';
            @endphp
            <div class="col-md-10" id="main-container">
                @if(session('register_role', 'student') == 'student')
                    @php
                        $cancelBtnLink = url('users/'.Auth::user()->school->code.'/1/0');
                        $categories= \App\Category::bySchool(Auth::user()->school_id)->status()->pluck('name', 'id');
                        $houses = \App\House::bySchool(Auth::user()->school_id)->status()->pluck('name', 'id');
                        if (school('country')->code == 'BD'){
                            $division = (new \App\Division())->pluckDivision();
                        }else{
                        $country = \App\Country::pluck('name', 'id');
                        }
                    @endphp
                    @include('components.pages-bar',['pageTitle' =>'<a href="'. route('all_index',[Auth::user()->school->code,1,0]).'">'. trans('Students').'</a> / <b>'. trans('Add').'<b>'])
                    @include('components.sectionbar.student-bar')
                @endif
                @if(session('register_role', 'teacher') == 'teacher')
                    @php $cancelBtnLink = route('all_index',[Auth::user()->school->code,0,1]); @endphp
                    @include('components.pages-bar',['pageTitle' =>'<a href="'. route('all_index',[Auth::user()->school->code,0,1]).'">'. trans('Human Resource').'</a> / <a href="'. route('all_index',[Auth::user()->school->code,0,1]).'">'.trans('Teachers') .'</a> / <b>'. trans('Add').'<b>'])
                    @include('components.sectionbar.teacher-bar')
                @endif
                @if(session('register_role', 'staff') == 'staff')
                    @php $cancelBtnLink = route('all_index',[Auth::user()->school->code,0,2]); @endphp
                    @include('components.pages-bar',['pageTitle' =>'<a href="'. route('all_index',[Auth::user()->school->code,0,1]).'">'. trans('Human Resource').'</a> / <a href="'. route('all_index',[Auth::user()->school->code,0,2]).'">'.trans('Staff') .'</a> / <b>'. trans('Add').'<b>'])
                    @include('components.sectionbar.teacher-bar')
                @endif
                @if(session('register_role', 'accountant') == 'accountant')
                    @include('components.sectionbar.teacher-bar')
                @endif
                @if(session('register_role', 'librarian') == 'librarian')
                    @include('components.sectionbar.teacher-bar')
                @endif
                <div class="panel panel-default">
                    <div class="panel-body pad-bottom-10 pl-0 pr-0" style="padding-top: 0px !important;">
                        @if (session('register_school_code') && auth()->user()->role == 'admin')
                            <div class="panel-body pad-bot-top">
                                <div class="btn-group new_b pull-left" style="overflow: hidden;">
                                    <a href="{{ route('school.show' , session('register_school_code')) }}"
                                       class="btn">@lang('View Admins')</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="panel-body pad-top-0 pl-0 pr-0">
                        <form class="form-horizontal" method="POST" id="registerForm" autocomplete="off"
                              action="{{ url('register/'.session('register_role')) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @if(session('register_role', 'student') == 'student')
                                <div class="col-md-12">
                                    <h4 style="margin-bottom: 20px; font-weight: 600; ">@lang('Student Information')
                                        <span>@lang(':')</span></h4>
                                </div>
                                @if(school('country')->code == 'BD')
                                    <div class="col-md-4 form-group {{ $errors->has('class_roll') ? ' has-error' : '' }}">
                                        <label for="class_roll" class="control-label">@lang('Class Roll')</label>
                                        <input id="class_roll" type="text" class="form-control" name="class_roll"
                                               value="{{ old('class_roll') }}">
                                        @if ($errors->has('class_roll'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('class_roll') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            @endif
                            @if(\Auth::user()->role == 'master')
                                @php $cancelBtnLink = route('schools.index'); @endphp
                                <div class="form-group col-md-4 {{ $errors->has('isSuper') ? 'has-error' : '' }}">
                                    {!! Form::label('isSuper', trans('Super Admin'), ['class' => 'control-label']) !!}
                                    <span
                                            class="red">*</span>
                                    {!! Form::select('isSuper', ['1'=>transMsg('Yes'),'0'=>transMsg('No')] , 0, ['class' => 'form-control','id' => 'isSuper']) !!}
                                    @error('isSuper'))
                                    <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                            @endif
                            @if(session('register_role', 'staff') == 'staff' || \Auth::user()->role == 'master')
                                <div class="col-md-4 form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                    <label for="role" class="control-label">@lang('Role')</label>
                                    {!! Form::select('role',role(), old('role'), array('id' => 'role', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                                    @error('role')
                                    <span class="help-block">
                                            <strong>{{ $message  }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('role_title') ? ' has-error' : '' }}">
                                    <label for="role_title" class="control-label">@lang('Title')</label>
                                    {!! Form::text('role_title', NULL, array('id' => 'role_title', 'class' => 'form-control','autocomplete' => 'off')) !!}
                                    @error('role_title')
                                    <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endif
                            <div class="col-md-4 form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="control-label">@lang('Full Name') <span
                                            class="red">*</span></label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                       required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                <label for="phone_number" class="control-label">@lang('Phone Number') <span class="red">*</span></label>
                                <input id="phone_number" type="text" class="form-control" name="phone_number"
                                       value="{{ old('phone_number') }}">
                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label">@lang('E-Mail Address')
                                    @if(session('register_role', 'student') != 'student') <span
                                            class="red">*</span> @endif</label>
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" {{session('register_role', 'student') == 'student' ? '' : 'required'}} >
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4  form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label">@lang('Password')
                                    @if(session('register_role', 'student') != 'student')<span
                                            class="red">*</span>@endif
                                </label>
<!--                                <span class="pull-right">
                                    <input type="checkbox" id="showPassword" onclick="ShowPassword()">
                                    <label style="margin-bottom: 0px" for="showPassword">@lang('Show Password')</label>
                                </span>-->
                                <input id="password" type="password" class="form-control"
                                       name="password" {{session('register_role', 'student') == 'student' ? '' : 'required'}}>
                                <span toggle="#password"
                                      class="fa fa-fw fa-eye eye-field-icon toggle-password"></span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="password-confirm" class="control-label">@lang('Confirm Password')
                                    @if(session('register_role', 'student') != 'student')<span
                                            class="red">*</span>@endif
                                </label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation"
                                        {{session('register_role', 'student') == 'student' ? '' : 'required'}}>
                                <span toggle="#password-confirm"
                                      class="fa fa-fw fa-eye eye-field-icon toggle-password"></span>
                            </div>
                            @if(session('register_role', 'student') == 'student')
                                <div class="col-md-4 form-group{{ $errors->has('placeBirth') ? ' has-error' : '' }}">
                                    <label for="placeBirth">@lang('Place of Birth')</label>
                                    {!! Form::text('placeBirth', null, array('id' => 'placeBirth', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                    <label for="birthday" class="control-label">@lang('Date of Birth') <span
                                                class="red">*</span></label>
                                    <input id="birthday" type="text" class="form-control" name="birthday"
                                           value="{{ old('birthday') }}"
                                           required>
                                    @if ($errors->has('birthday'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('birthday') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                @if(school('country')->code == 'BD')
                                    @php $birthcertificateNo = 'Birth Certificate No'; @endphp
                                @elseif(school('country')->code == 'SG')
                                    @php $birthcertificateNo = 'NRIC No/Passport No'; @endphp
                                @else
                                    @php $birthcertificateNo = 'NRIC No/Passport No'; @endphp
                                @endif
                                <div class="col-md-4 form-group{{ $errors->has('dob_no') ? ' has-error' : '' }}">
                                    <div class="form-group">
                                        <label for="dob_no">@lang($birthcertificateNo)</label>
                                        {!! Form::text('dob_no', null, array('id' => 'dob_no', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                    </div>
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('section') ? ' has-error' : '' }}">
                                    <label for="section" class="control-label">@lang('Section & Class') <span
                                                class="red">*</span></label>
                                    {!! Form::select('section', getSectionAndClassPluck(),null, ['class' => 'select2 form-control','id'=>'section','placeholder'=>'Choose','required']) !!}
                                    @if ($errors->has('section'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('section') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('session') ? ' has-error' : '' }}">
                                    <label for="session" class="control-label">@lang('Session') <span
                                                class="red">*</span></label>
                                    {!! Form::select('session', schoolSession(1, true), null, ['class' => 'select2 form-control','id'=>'session','required','placeholder'=>'Choose']) !!}
                                    @if ($errors->has('session'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('session') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('coursegroup_id') ? ' has-error' : '' }}">
                                    {!! Form::label('coursegroup_id', trans($cName.' Group'), ['class' => 'control-label']) !!}
                                    <span class="red">*</span>
                                    @php $activeCourseGroup = schoolCourseGroup(1, true); @endphp
                                    {!! Form::select('coursegroup_id', $activeCourseGroup, null, ['class' => 'popTop form-control','id'=>'coursegroup_id','required','placeholder'=>'Choose']) !!}
                                    @error('coursegroup_id')
                                    <span class="help-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                    @if (schoolCourseGroup()->count() == 0)
                                        <code><i><b>@lang('Note'):</b>{{transMsg('There is no ' .$cName. ' group')}} <a
                                                        style="text-decoration: underline"
                                                        href="{{route('academic.coursegroup.create')}}"
                                                        target="_blank">{{transMsg('First create an '.$cName.' group')}}</a></i></code>
                                    @endif
                                    @if ($activeCourseGroup->count() == 0 && schoolCourseGroup(2)->count())
                                        <code><i><b>@lang('Note')
                                                    :</b>{{transMsg('There are all '.$cName.' group Inactive')}} <a
                                                        style="text-decoration: underline"
                                                        href="{{route('academic.coursegroup.index')}}"
                                                        target="_blank">{{transMsg('First active '.$cName.' group')}}</a></i></code>
                                    @endif
                                </div>
                            @endif
                            @if(session('register_role', 'teacher') == 'teacher')
                                <div class="col-md-4 form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                    <label for="department" class="control-label">@lang('Department') <span class="red">*</span></label>
                                    <select id="department" class="form-control" name="department_id" required>
                                        @if (count(session('departments')) > 0)
                                            @foreach (session('departments') as $d)
                                                <option value="{{$d->id}}">{{$d->department_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('department'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('department') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('class_teacher') ? ' has-error' : '' }}">
                                    <label for="class_teacher" class="control-label">@lang('Class Teacher')</label>
                                    {!! Form::select('class_teacher_section_id', getSectionAndClassPluck()->prepend('Not Class Teacher','0'),null, ['class' => 'select2 form-control','id'=>'class_teacher_section_id']) !!}
                                    @if ($errors->has('class_teacher'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('class_teacher') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            @endif
                            <div class="col-md-4 form-group{{ $errors->has('nationality') ? ' has-error' : '' }}">
                                <label for="nationality" class="control-label">@lang('Nationality') <span
                                            class="red">*</span></label>
                                {!! Form::select('nationality',nationalityArray(), (school('country')->code == 'BD' ? 14 : (school('country')->code == 'SG' ? 159 : 3)), array('id' => 'nationality','required', 'class' => 'form-control select2', 'placeholder' => trans('Choose'))) !!}
                                @if ($errors->has('nationality'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('nationality') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender" class="control-label">@lang('Gender') <span
                                            class="red">*</span></label>
                                {!! Form::select('gender',gender(), null, array('id' => 'gender', 'class' => 'form-control','required','placeholder'=>transMsg('Choose'))) !!}
                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('blood_group') ? ' has-error' : '' }}">
                                <label for="blood_group" class="control-label">@lang('Blood Group')
                                    <span class="red"></span></label>


                                {!!Form::select('blood_group',bloodgroup(), null, array('id' => 'blood_group', 'class' => 'form-control','placeholder'=>transMsg('N/C'))) !!}
                                @if ($errors->has('blood_group'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('blood_group') }}</strong>
                                    </span>
                                @endif
                            </div>


                            @if(session('register_role', 'staff') == 'staff' || session('register_role', 'teacher') == 'teacher')
                                @if(school('country')->code == 'SG')
                                    @php
                                        $houses = \App\House::bySchool(Auth::user()->school_id)->status()->pluck('name', 'id');
                                    @endphp

                                    <div class="col-md-4 form-group{{ $errors->has('house_id') ? ' has-error' : '' }}">
                                        {!! Form::label('house_id','Branch', ['class' => 'control-label']) !!}
                                        {!! Form::select('house_id', $houses , null , ['class' => 'form-control','placeholder'=>'Choose']) !!}
                                        @error('house_id')
                                        <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                @endif
                                <div class="col-md-4 form-group{{ $errors->has('joindate') ? ' has-error' : '' }}">
                                    <label for="joindate" class="control-label">@lang('Date of Joining')</label>
                                    <input id="joindate" type="text" class="form-control" name="joindate"
                                           value="{{ old('joindate') }}">
                                    @if ($errors->has('joindate'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('joindate') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            @endif
                            @if(session('register_role', 'student') == 'student')
                                <div class="col-md-4 form-group{{ $errors->has('religion') ? ' has-error' : '' }}">
                                    <label for="religion" class="control-label">@lang('Religion') <span
                                                class="red"></span></label>
                                    {!! Form::select('religion',religon(), null, array('id' => 'religion', 'class' => 'form-control', 'placeholder' => trans('N/C'))) !!}

                                    @if ($errors->has('religion'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('religion') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('version') ? ' has-error' : '' }}">
                                    {!! Form::label('version', trans(school('country')->code == 'SG' ? 'NTIL' : 'Version'), ['class' => 'control-label']) !!}
                                    {!! Form::select('version', pluckVersion() , null , ['class' => 'form-control','placeholder'=>'Choose']) !!}
                                    @if ($errors->has('version'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('version') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                                    <label for="group"
                                           class="control-label">@lang(school('country')->code == 'SG' ? 'Section' : 'Group')</label>
                                    <input id="group" type="text" class="form-control" name="group"
                                           value="{{ old('group') }}"
                                           placeholder="@lang('Science, Arts, Commerce,etc.')">
                                    @if ($errors->has('group'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('group') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                {{-- <div class="col-md-4 form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address" class="control-label">@lang('Address') <span
                                                class="red">*</span></label>
                                    <input id="address" type="text" class="form-control" name="address"
                                           value="{{ old('address') }}" required>
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                    @endif
                                </div>--}}

                                <div class="col-md-4 form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                    {!! Form::label('category_id', (school('country')->code == 'SG' ?  'Race' : 'Category'), ['class' => 'control-label']) !!}
                                    {!! Form::select('category_id', $categories , null , ['class' => 'form-control','placeholder'=>'Choose']) !!}
                                    @error('category_id')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('house_id') ? ' has-error' : '' }}">
                                    {!! Form::label('house_id', (school('country')->code == 'SG' ?  'Branch' : 'House'), ['class' => 'control-label']) !!}
                                    {!! Form::select('house_id', $houses , null , ['class' => 'form-control','placeholder'=>'Choose']) !!}
                                    @error('house_id')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @if(school('country')->code == 'BD')
                                    @php $previous_school_name = 'Previous School Name'; @endphp
                                @elseif(school('country')->code == 'SG')
                                    @php $previous_school_name = 'Name and Address of Main School'; @endphp
                                    <div class="form-group col-md-4">
                                        <label for="singaporepr"> @lang('Resident Status')</label>
                                        {!! Form::select('singaporepr',residentstatus(), null, array('id' => 'singaporepr', 'class' => 'form-control','required', 'placeholder' => trans('Choose'))) !!}
                                    </div>
                                @else
                                    @php $previous_school_name = 'Previous School Name'; @endphp
                                @endif
                                <div class="col-md-4 form-group{{ $errors->has('main_school_name_address') ? ' has-error' : '' }}">
                                    <label for="main_school_name_address">@lang($previous_school_name) </label>
                                    {!! Form::text('main_school_name_address',  null, array('id' => 'main_school_name_address', 'class' => 'form-control','autocomplete' => 'off')) !!}
                                    @if ($errors->has('main_school_name_address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('main_school_name_address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                @if(school('country')->code == 'BD')
                                    @php $previous_class = 'Previous Class'; @endphp
                                    <div class="col-md-4 form-group{{ $errors->has('previous_class') ? ' has-error' : '' }}">
                                        <label for="previous_class">@lang($previous_class)</label>
                                        {!! Form::text('previous_class' ,null, array('id' => 'previous_class', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                    </div>
                                    <div class="col-md-4 form-group{{ $errors->has('last_gpa') ? ' has-error' : '' }}">
                                        <label for="last_gpa">@lang('Last GPA')</label>
                                        {!! Form::text('last_gpa' ,null, array('id' => 'last_gpa', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                    </div>
                                @endif
                                @if(school('country')->code == 'SG')
                                    <div class="col-md-4 form-group{{ $errors->has('stream') ? ' has-error' : '' }}">
                                        <label for="stream">@lang('Stream')</label>
                                        {!! Form::text('stream' ,null, array('id' => 'stream', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                    </div>
                                    <div class="col-md-4 form-group{{ $errors->has('weekEnd') ? ' has-error' : '' }}">
                                        <label for="weekEnd">@lang('WeekEnd / ISPP')</label>
                                        {!! Form::text('weekEnd' ,null, array('id' => 'weekEnd', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <h4 style="margin-bottom: 20px; font-weight: 600; ">@lang('Guardian Information')
                                        <span>@lang(':')</span></h4>
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('father_name') ? ' has-error' : '' }}">
                                    <label for="father_name" class="control-label">@lang('Father\'s Name') <span
                                                class="red"></span></label>
                                    <input id="father_name" type="text" class="form-control" name="father_name"
                                           value="{{ old('father_name') }}" >
                                    @if ($errors->has('father_name'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('father_name') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('father_phone_number') ? ' has-error' : '' }}">
                                    <label for="father_phone_number"
                                           class="control-label">@lang('Father\'s Phone Number')</label>
                                    <input id="father_phone_number" type="text" class="form-control"
                                           name="father_phone_number"
                                           value="{{ old('father_phone_number') }}">
                                    @if ($errors->has('father_phone_number'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('father_phone_number') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('father_national_id') ? ' has-error' : '' }}">
                                    <label for="father_national_id"
                                           class="control-label">@lang('Father\'s National ID')</label>
                                    <input id="father_national_id" type="text" class="form-control"
                                           name="father_national_id"
                                           value="{{ old('father_national_id') }}">

                                    @if ($errors->has('father_national_id'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('father_national_id') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('father_occupation') ? ' has-error' : '' }}">
                                    <label for="father_occupation"
                                           class="control-label">@lang('Father\'s Occupation')</label>
                                    <input id="father_occupation" type="text" class="form-control"
                                           name="father_occupation"
                                           value="{{ old('father_occupation') }}">

                                    @if ($errors->has('father_occupation'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('father_occupation') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('father_designation') ? ' has-error' : '' }}">
                                    <label for="father_designation"
                                           class="control-label">@lang('Father\'s Designation')</label>
                                    <input id="father_designation" type="text" class="form-control"
                                           name="father_designation"
                                           value="{{ old('father_designation') }}">

                                    @if ($errors->has('father_designation'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('father_designation') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('father_annual_income') ? ' has-error' : '' }}">
                                    <label for="father_annual_income"
                                           class="control-label">@lang((school('country')->code == 'SG' ?  'Father\'s office Address' : 'Father\'s Annual Income'))</label>
                                    <input id="father_annual_income" type="text" class="form-control"
                                           name="father_annual_income" value="{{ old('father_annual_income') }}">

                                    @if ($errors->has('father_annual_income'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('father_annual_income') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('mother_name') ? ' has-error' : '' }}">
                                    <label for="mother_name" class="control-label">@lang('Mother\'s Name') <span
                                                class="red"></span></label>
                                    <input id="mother_name" type="text" class="form-control" name="mother_name"
                                           value="{{ old('mother_name') }}" >
                                    @if ($errors->has('mother_name'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('mother_name') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('mother_phone_number') ? ' has-error' : '' }}">
                                    <label for="mother_phone_number"
                                           class="control-label">@lang('Mother\'s Phone Number')</label>
                                    <input id="mother_phone_number" type="text" class="form-control"
                                           name="mother_phone_number"
                                           value="{{ old('mother_phone_number') }}">

                                    @if ($errors->has('mother_phone_number'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('mother_phone_number') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('mother_national_id') ? ' has-error' : '' }}">
                                    <label for="mother_national_id"
                                           class="control-label">@lang('Mother\'s National ID')</label>
                                    <input id="mother_national_id" type="text" class="form-control"
                                           name="mother_national_id"
                                           value="{{ old('mother_national_id') }}">

                                    @if ($errors->has('mother_national_id'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('mother_national_id') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('mother_occupation') ? ' has-error' : '' }}">
                                    <label for="mother_occupation"
                                           class="control-label">@lang('Mother\'s Occupation')</label>
                                    <input id="mother_occupation" type="text" class="form-control"
                                           name="mother_occupation"
                                           value="{{ old('mother_occupation') }}">

                                    @if ($errors->has('mother_occupation'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('mother_occupation') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('mother_designation') ? ' has-error' : '' }}">
                                    <label for="mother_designation"
                                           class="control-label">@lang('Mother\'s Designation')</label>
                                    <input id="mother_designation" type="text" class="form-control"
                                           name="mother_designation"
                                           value="{{ old('mother_designation') }}">

                                    @if ($errors->has('mother_designation'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('mother_designation') }}</strong>
                                            </span>
                                    @endif
                                </div>

                                <div class="col-md-4 form-group{{ $errors->has('mother_annual_income') ? ' has-error' : '' }}">
                                    <label for="mother_annual_income"
                                           class="control-label">@lang('Mother\'s Annual Income')</label>
                                    <input id="mother_annual_income" type="text" class="form-control"
                                           name="mother_annual_income"
                                           value="{{ old('mother_annual_income') }}">
                                    @if ($errors->has('mother_annual_income'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('mother_annual_income') }}</strong>
                                            </span>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <h4 class="edit_header"> @lang('Emergency Contact Information'):</h4>
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('contact_person') ? ' has-error' : '' }}">
                                    <label for="contact_person">@lang('Name')</label>
                                    {!! Form::text('contact_person',null, array('id' => 'contact_person', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('contact_person_mobile') ? ' has-error' : '' }}">
                                    <label for="contact_person_mobile">@lang('Mobile')</label>
                                    {!! Form::text('contact_person_mobile', null, array('id' => 'contact_person_mobile', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('contact_person_email') ? ' has-error' : '' }}">
                                    <label for="contact_person_email">@lang('Address')</label>
                                    {!! Form::text('contact_person_email', null, array('id' => 'contact_person_email', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('relation_with_cperson') ? ' has-error' : '' }}">
                                    <label for="relation_with_cperson">@lang('Relationship')</label>
                                    {!! Form::text('relation_with_cperson', null, array('id' => 'relation_with_cperson', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
                                </div>
                                @if(school('country')->code == 'BD')
                                    <div class="col-md-12">
                                        <h4 class="edit_header"> @lang('Present Address'):</h4>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="presentAddress">@lang('Village')</label>
                                        {!! Form::text('present_address', null, array('id' => 'presentAddress', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="perpostoffice">@lang('Post Office')</label>
                                        {!! Form::text('present_post_office',null, array('id' => 'perpostoffice', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="perpostcode">@lang('Post Code')</label>
                                        {!! Form::text('present_postcode', null, array('id' => 'perpostcode', 'class' => 'popTop form-control', 'autocomplete'=>'off','pattern' => '[0-9]*','title'=>'Please enter number only','maxlength'=>4,'minlength'=>4)) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="preDivision">@lang('Division')</label>
                                        {!! Form::select('present_division',$division, null, array('id' => 'preDivision', 'class' => 'form-control', 'onchange'=>'getPersentDistrict(this.value)', 'placeholder' => trans('Choose'))) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="preDistrict">@lang('District')</label>
                                        {!! Form::select('present_district',array(), null, array('id' => 'preDistrict', 'class' => 'form-control', 'onchange'=>'getPersentThana(this.value)', 'placeholder' => trans('Choose'))) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="preThana">@lang('Thana')</label>
                                        {!! Form::select('present_thana', array(),null, array('id' => 'preThana', 'class' => 'form-control',  'placeholder' => trans('Choose'))) !!}
                                    </div>
                                    <div class="col-md-12">
                                        <h4 class="edit_header"> @lang('Permanent Address'):</h4>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="pastAddress">@lang('Village')</label>
                                        {!! Form::text('permanent_address', null, array('id' => 'pastAddress', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="pastpostoffice">@lang('Post Office')</label>
                                        {!! Form::text('permanent_post_office', null, array('id' => 'pastpostoffice', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="pastpostcode">@lang('Post Code')</label>
                                        {!! Form::text('permanent_postcode',null, array('id' => 'pastpostcode', 'class' => 'popTop form-control', 'placeholder' => trans(''),'autocomplete'=>'off','pattern' => '[0-9]*','title'=>'Please enter number only','maxlength'=>4,'minlength'=>4)) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="pastDivision">@lang('Division')</label>
                                        {!! Form::select('permanent_division',$division,  null, array('id' => 'pastDivision', 'class' => 'form-control', 'onchange'=>'getPermanentDistrict(this.value)', 'placeholder' => trans('Choose'))) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="pastDistrict">@lang('District')</label>
                                        {!! Form::select('permanent_district',array(), null, array('id' => 'pastDistrict', 'class' => 'form-control', 'onchange'=>'getPermanentThana(this.value)', 'placeholder' => trans('Choose'))) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="pastThana">@lang('Thana')</label>
                                        {!! Form::select('permanent_thana', array(),null, array('id' => 'pastThana', 'class' => 'form-control',  'placeholder' => trans('Choose'))) !!}
                                    </div>
                                @else
                                    <div class="col-md-12">
                                        <h4 class="edit_header"> @lang('Address Information'):</h4>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="streetAddress_1">@lang('Street Address 1')</label>
                                        {!! Form::text('street_address_1', null, array('id' => 'streetAddress_1', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="streetAddress_2">@lang('Street Address 2')</label>
                                        {!! Form::text('street_address_2', null, array('id' => 'streetAddress_2', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="country">@lang('Country')</label>
                                        {!! Form::select('country',$country,  null, array('id' => 'country', 'class' => 'form-control', 'onchange'=>'getPersentstate(this.value)', 'placeholder' => trans('Choose'))) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="state">@lang('State')</label>
                                        {!! Form::select('state',array(), null, array('id' => 'state', 'class' => 'form-control',  'placeholder' => trans('Choose'))) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="city">@lang('City')</label>
                                        {!! Form::text('city', null, array('id' => 'city', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="zipCode">@lang('Zip Code')</label>
                                        {!! Form::text('zipCode', null, array('id' => 'zipCode', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                    </div>
                                @endif
                                <div class="col-md-8 form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                                    <label for="about" class="control-label">@lang('About')</label>
                                    <textarea id="about" class="form-control" rows="2"
                                              name="about">{{ old('about') }}</textarea>

                                    @if ($errors->has('about'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('about') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            @endif

                            <div class="col-md-4 form-group">
                                <div class="image-upload">
                                    <label class="control-label upperlabel">
                                        @lang('Upload Profile Picture')
                                        <span id="deliMG" onclick="cancelUploadImg('unnamed2');" style="display: none;"
                                              class="myspanRemove">@lang('Remove')</span>
                                    </label>
                                    <label class="btn btn-success btn-sm btn-block uploded-text"
                                           for="file-upload">@lang('Choose Picture') </label>
                                    <input type="file" value="" class="file-upload form-control" id="file-upload"
                                           accept="image/*">
                                </div>
                                <div style="clear:both;"></div>
                                <div id="uploaded_image_url"></div>
                            </div>
                                   @php
                                        if (foqas_setting('admission_additional_file') != '')
                                            $additional_files = explode(',',foqas_setting('admission_additional_file'));
                                        else
                                            $additional_files = [];
                                    @endphp
                            @if(session('register_role', 'student') == 'student')
                             @foreach($additional_files as $key => $file)
                                        @if($file != 1)
                                            @php $renderAddSlug = school('code').$file @endphp
                                            <div class="col-md-4 col-sm-12">
                                                <label class="control-label upperlabel">
                                                    {!! admission_additional_file($file) !!}</label>
                                                <div class="button-wrapper">
                                                  <span class="label">
                                                   @lang('Choose File')
                                                  </span>
                                                    <input type="file" name="{{$renderAddSlug}}" id="{{$renderAddSlug}}"
                                                           class="form-control upload-box"
                                                           accept="image/*" placeholder="@lang('Upload File')">
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    @endif
                            @if(session('register_role', 'teacher') == 'teacher')
                                <div class="col-md-4 form-group">
                                    <label class="control-label upperlabel">@lang('Upload CV')</label>
                                    <div class="button-wrapper">
                                                  <span class="label">
                                                   @lang('Choose File')
                                                  </span>
                                        <input type="file" name="teacher_cv" id="cv"
                                               class="form-control upload-box"
                                               accept="image/*" placeholder="@lang('Upload File')">
                                    </div>
                                </div>
                            @endif
                            <div class="clearhight"></div>
                            <div class="col-md-2 form-group">
                                <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                    @lang('Save')
                                </button>
                            </div>
                            @if(session('register_role', 'teacher') == 'teacher' || auth()->user()->hasRole('master'))
                                <div class="col-md-2 form-group">
                                    <input type="checkbox" class="d-none" name="sendEmail" id="sendEmail">
                                    <label for="sendEmail" class="{{btnClass()}}"> @lang('Save & Email')</label>
                                </div>
                                @push('script')
                                    <script>
                                        $("#sendEmail").click(function () {
                                            $("#registerForm").submit();
                                        })
                                    </script>
                                @endpush
                            @endif
                            @if(isset($cancelBtnLink))
                                <div class="col-md-2 text-center">
                                    <a href="{{$cancelBtnLink}}" class="{{btnClass()}}">@lang('Cancel')</a>
                                </div>
                            @elseif(session('register_branch_admin'))
                                <div class="col-md-2 text-center">
                                    <a href="{{route('academic.branch.index')}}"
                                       class="{{btnClass()}}">@lang('Cancel')</a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#birthday, #joindate').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true
            });
            @if(session('register_role', 'student') == 'student')
            $("#coursegroup_id").change(function () {
                var id = $(this).val();
                if (isEmpty(id)) {
                    $("#coursegroup_id").attr('data-content', 'Please select an {{$cName}} group').popover('show');
                } else {
                    $.post('{{url("/")}}/getCourseByGroup/' + id, function (data) {
                        $("#coursegroup_id").attr('data-content', data).popover('show');
                        setTimeout(function () {
                            $("#coursegroup_id").popover('hide');
                        }, 2000);
                    });
                }
            });
            @endif
        });
    </script>
@endsection