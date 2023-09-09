@extends('layouts.app')

@section('title', __('Student Edit'))

@section('content')
    <style>
        .form-horizontal .form-group {
            margin-left: 0px !important;
            margin-right: 0px !important;
        }

        .edit_header {
            margin-top: 0px;
            margin-bottom: 15px;
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

    <div class="container{{ (\Auth::user()->role == 'master')? '' : '-fluid' }}">
        <div class="row">
            @if(\Auth::user()->role != 'master')
                <div class="col-md-2" id="side-navbar">
                    @include('layouts.leftside-menubar')
                </div>
            @endif
            <div class="col-md-{{ (\Auth::user()->role == 'master')? 12 : 10 }}" id="main-container">
                <div class="panel panel-default ">
                    <div class="panel-body pad-top-0">
                        {!! Form::model($user, ['route' => ['user.update', $user->student_code], 'method' => 'post','autocomplete'=>'off' ,'enctype'=>"multipart/form-data"]) !!}
                        {!! Form::hidden('id', null, ['id' => 'id']) !!}
                        {!! Form::hidden('user_role', $user->role, ['id' => 'user_role']) !!}
                        @if($user->role == 'student')
                            <div class="col-md-12">
                                <h4 class="edit_header">@lang('Student Information'):</h4>
                            </div>
                            {{--     <div class="col-md-4 form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                     {!! Form::label('code', 'Code', ['class' => 'control-label']) !!}
                                     {!! Form::text('code', $user->student_code, ['class' => 'form-control','required','readonly']) !!}
                                     @error('code')
                                     <span class="help-block">
                                     <strong>{{ $message }}</strong>
                                 </span>
                                     @enderror
                                 </div> --}}

                            <div class="col-md-4 form-group{{ $errors->has('class_roll') ? ' has-error' : '' }}">
                                {!! Form::label('class_roll', trans('Class Roll'), ['class' => 'control-label']) !!}
                                {!! Form::text('class_roll', $user->studentInfo['class_roll']??null, ['class' => 'form-control','id'=>'class_roll']) !!}
                                @if ($errors->has('class_roll'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('class_roll') }}</strong>
                                </span>
                                @endif
                            </div>

                        @endif

                        <div class="col-md-4 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name', trans($user->role == 'student' ? 'Student Name' : 'Name'), ['class' => 'control-label']) !!}
                            {!! Form::text('name', null, ['class' => 'form-control','id' => 'name','required']) !!}
                            @error('name')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-4 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email', trans('E-Mail Address'), ['class' => 'control-label']) !!}
                            {!! Form::email('email', null, ['class' => 'form-control','id'=>'email']) !!}
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-4 form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            {!! Form::label('phone_number', trans('Phone number'), ['class' => 'control-label']) !!}
                            {!! Form::tel('phone_number', null, ['class' => 'form-control','id'=>'phone_number']) !!}
                            @if ($errors->has('phone_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </span>
                            @endif
                        </div>
                        @if($user->role != 'student')
                            <div class="col-md-4 form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                {!! Form::label('address', trans('Address'), ['class' => 'control-label']) !!}
                                {!! Form::text('address', null, ['class' => 'form-control','id' => 'address','required']) !!}
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        @endif
                        @php
                            $cName = school('country')->code == 'BD' ? 'Subjects' : 'Courses';
                            $className = school('country')->code == 'BD' ? 'Class' : 'Grade';
                        @endphp
                        <div class="col-md-4 form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            {!! Form::label('gender', trans('Gender'), ['class' => 'control-label']) !!}
                            {!! Form::select('gender',gender(), null, array('id' => 'gender', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                            @error('gender')
                            <span class="help-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-4 form-group{{ $errors->has('blood_group') ? ' has-error' : '' }}">
                            {!! Form::label('blood_group', trans('Blood Group'), ['class' => 'control-label']) !!}
                            {!!Form::select('blood_group',bloodgroup(), null, array('id' => 'blood_group', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                            @error('blood_group')
                            <span class="help-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @if($user->role == 'student')
                            <div class="col-md-4 form-group{{ $errors->has('placeBirth') ? ' has-error' : '' }}">
                                <label for="placeBirth">@lang('Place of Birth')</label>
                                {!! Form::text('placeBirth', $user->studentInfo['placeBirth'] ?? null, array('id' => 'placeBirth', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                {!! Form::label('birthday', trans('Date of Birth'), ['class' => 'control-label']) !!}
                                {!! Form::text('birthday',Carbon\Carbon::parse($user->studentInfo['birthday'])->format('Y-m-d') ?? null , ['class' => 'form-control','id' => 'birthday','required']) !!}

                                @error('birthday')
                                <span class="help-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @if(school('country')->code == 'BD')
                                @php $birthcertificateNo = 'Birth Certificate No'; @endphp
                            @elseif(school('country')->code == 'SG')
                                @php $birthcertificateNo = 'NRIC No/Passport No'; @endphp
                            @else
                                @php $birthcertificateNo = 'NRIC No/Passport No'; @endphp
                            @endif
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="dob_no">@lang($birthcertificateNo)</label>
                                    {!! Form::text('dob_no',$user->studentInfo['dob_no'] ?? null, array('id' => 'dob_no', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                </div>
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('session') ? ' has-error' : '' }}">
                                {!! Form::label('session', trans('Session'), ['class' => 'control-label']) !!}
                                {!! Form::select('session', schoolSession(1, true),$user->studentInfo['session'] ?? null, ['class' => 'select2 form-control','id'=>'session','required','placeholder'=>'Choose']) !!}
                                @if ($errors->has('session'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('session') }}</strong>
                                    </span>
                                @endif
                            </div>
                            {{--  <div class="col-md-4 form-group{{ $errors->has('section_id') ? ' has-error' : '' }}">
                                  {!! Form::label('section_id', trans($className.' - Section'), ['class' => 'control-label']) !!}
                                  {!! Form::select('section_id', getSectionAndClassPluck(),null, ['class' => 'select2 form-control','required','placeholder'=>'Choose']) !!}
                                  @error('section_id')
                                  <span class="help-block">
                                      <strong>{{ $message}}</strong>
                                  </span>
                                  @enderror
                              </div>--}}
                            <div class="col-md-4 form-group{{ $errors->has('religion') ? ' has-error' : '' }}">
                                {!! Form::label('religion', trans('Religion'), ['class' => 'control-label']) !!}
                                {!! Form::select('religion',religon(), $user->studentInfo['religion'] ?? null, array('id' => 'religion', 'class' => 'form-control', 'placeholder' => trans('Choose'),'required')) !!}
                                @if ($errors->has('religion'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('religion') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('coursegroup_id') ? ' has-error' : '' }}">
                                {!! Form::label('coursegroup_id', trans($cName.' Group'), ['class' => 'control-label']) !!}
                                @php $activeCourseGroup = schoolCourseGroup(1, true); @endphp
                                {!! Form::select('coursegroup_id', $activeCourseGroup,$user->studentInfo['coursegroup_id'] ?? null, ['class' => 'popTop form-control','id'=>'coursegroup_id','required','placeholder'=>'Choose']) !!}
                                @error('coursegroup_id')
                                <span class="help-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @if (schoolCourseGroup()->count() == 0)
                                    <code><i><b>@lang('Note'):</b> @lang('There is no '. $cName .' group'). <a
                                                    style="text-decoration: underline"
                                                    href="{{route('academic.coursegroup.create')}}"
                                                    target="_blank">@lang('First create an '.$cName.' group.')</a></i></code>
                                @endif
                                @if ($activeCourseGroup->count() == 0 && schoolCourseGroup(2)->count())
                                    <code><i><b>@lang('Note'):</b> @lang('There are all '.$cName.' group Inactive.') <a
                                                    style="text-decoration: underline"
                                                    href="{{route('academic.coursegroup.index')}}" target="_blank">
                                                @lang('First active '.$cName.' group.')</a></i></code>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                                {!! Form::label('group', trans('Group'), ['class' => 'control-label']) !!}
                                {!! Form::text('group', $user->studentInfo['group']??null, ['class' => 'form-control','placeholder'=>'Science, Arts, Commerce,etc.','id'=>'group']) !!}
                                @if ($errors->has('group'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('group') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('nationality') ? ' has-error' : '' }}">
                                <label for="nationality">@lang('Nationality')</label>
                                {!! Form::select('nationality',nationalityArray(), null, array('id' => 'nationality', 'class' => 'form-control select2', 'placeholder' => trans('Choose'))) !!}

                                @if ($errors->has('nationality'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('nationality') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('version') ? ' has-error' : '' }}">
                                {!! Form::label('version', transMsg(school('country')->code == 'SG' ? 'NTIL' : 'Version'), ['class' => 'control-label']) !!}
                                {!! Form::select('version', pluckVersion() , $user->studentInfo['version']?? school('medium') , ['class' => 'form-control','placeholder'=>'Choose']) !!}
                                @error('version')
                                <span class="help-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                                {!! Form::label('category_id', transMsg(school('country')->code == 'SG' ? 'Race' : 'Category'), ['class' => 'control-label']) !!}
                                {!! Form::select('category_id', $categories , $user->studentInfo['category_id']?? school('medium') , ['class' => 'form-control','placeholder'=>'Choose']) !!}
                                @error('category_id')
                                <span class="help-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('house_id') ? ' has-error' : '' }}">
                                {!! Form::label('house_id', transMsg('Branch'), ['class' => 'control-label']) !!}
                                {!! Form::select('house_id', $houses , $user->studentInfo['house_id']?? school('medium') , ['class' => 'form-control','placeholder'=>'Choose']) !!}
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
                            @else
                                @php $previous_school_name = 'Previous School Name'; @endphp
                            @endif
                            <div class="col-md-4 form-group{{ $errors->has('main_school_name_address') ? ' has-error' : '' }}">
                                <label for="main_school_name_address">@lang($previous_school_name) </label>
                                {!! Form::text('main_school_name_address',  $user->studentInfo['main_school_name_address'] ?? '', array('id' => 'main_school_name_address', 'class' => 'form-control','autocomplete' => 'off')) !!}
                                @if ($errors->has('main_school_name_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('main_school_name_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                            @if(school('country')->code != 'SG')
                                @if(school('country')->code == 'BD')
                                    @php $previous_class = 'Previous Class'; @endphp
                                @else
                                    @php $previous_class = 'Previous Grade'; @endphp
                                @endif
                                <div class="col-md-4 form-group{{ $errors->has('previous_class') ? ' has-error' : '' }}">
                                    <label for="previous_class">@lang($previous_class)</label>
                                    {!! Form::text('previous_class' ,$user->studentInfo['previous_class'] ?? '', array('id' => 'previous_class', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                </div>
                            @endif
                            @if(school('country')->code == 'BD')
                                <div class="col-md-4 form-group{{ $errors->has('last_gpa') ? ' has-error' : '' }}">
                                    <label for="last_gpa">@lang('Last GPA')</label>
                                    {!! Form::text('last_gpa' ,$user->studentInfo['last_gpa'] ?? '', array('id' => 'last_gpa', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                </div>
                            @endif
                            @if(school('country')->code == 'SG')
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="singaporepr"> @lang('Resident Status')</label>
{{--                                    {!! Form::select('singaporepr',residentstatus(), old('singaporepr'), array('id' => 'singaporepr', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}--}}
                                    {!! Form::select('singaporepr' ,residentstatus() ,$user->studentInfo['singaporepr'] ?? null, array('id' => 'stream', 'class' => 'form-control','autocomplete'=>'off')) !!}

                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('stream') ? ' has-error' : '' }}">
                                    <label for="stream">@lang('Stream')</label>
                                    {!! Form::text('stream' ,$user->studentInfo['stream'] ?? null, array('id' => 'stream', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                </div>
                                <div class="col-md-4 form-group{{ $errors->has('weekEnd') ? ' has-error' : '' }}">
                                    <label for="weekEnd">@lang('WeekEnd / ISPP')</label>
                                    {!! Form::text('weekEnd' ,$user->studentInfo['weekEnd'] ?? null, array('id' => 'weekEnd', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                </div>
                            @endif
                            <div class="col-md-12">
                                <h4 class="edit_header"> @lang('Guardian Information'):</h4>
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('father_name') ? ' has-error' : '' }}">
                                <label for="father_name">@lang('Father\'s Name') </label>
                                {!! Form::text('father_name', $user->studentInfo['father_name'] ?? null, ['class' => 'form-control','required','id'=>'father_name']) !!}
                                @if ($errors->has('father_name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('father_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('father_national_id') ? ' has-error' : '' }}">
                                <label for="father_national_id">@lang('Father\'s National ID')</label>
                                {!! Form::text('father_national_id', $user->studentInfo['father_national_id'] ?? null, ['class' => 'form-control','id'=>'father_national_id']) !!}
                                @if ($errors->has('father_national_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('father_national_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('father_phone_number') ? ' has-error' : '' }}">
                                <label for="father_phone_number">@lang('Father\'s Phone Number')</label>
                                {!! Form::text('father_phone_number', $user->studentInfo['father_phone_number'] ?? null, ['class' => 'form-control','id'=>'father_phone_number']) !!}
                                @if ($errors->has('father_phone_number'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('father_phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('father_annual_income') ? ' has-error' : '' }}">
                                {!! Form::label('father_annual_income', trans('Father\'s Annual Income'), ['class' => 'control-label']) !!}
                                {!! Form::text('father_annual_income', $user->studentInfo['father_annual_income'] ?? null, ['class' => 'form-control']) !!}
                                @if ($errors->has('father_annual_income'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('father_annual_income') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group{{ $errors->has('father_occupation') ? ' has-error' : '' }}">
                                <label for="father_occupation">@lang('Father\'s Occupation')</label>
                                <input id="father_occupation" type="text" class="form-control"
                                       name="father_occupation"
                                       value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['father_occupation'];} @endphp">
                                @if ($errors->has('father_occupation'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('father_occupation') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('father_designation') ? ' has-error' : '' }}">
                                <label for="father_designation">@lang('Father\'s Designation')</label>
                                <input id="father_designation" type="text" class="form-control"
                                       name="father_designation"
                                       value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['father_designation'];} @endphp">
                                @if ($errors->has('father_designation'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('father_designation') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('mother_name') ? ' has-error' : '' }}">
                                <label for="mother_name"> @lang('Mother\'s Name')</label>
                                {!! Form::text('mother_name', $user->studentInfo['mother_name'] ?? null, ['class' => 'form-control','required','id'=>'mother_name']) !!}
                                @if ($errors->has('mother_name'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('mother_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('mother_national_id') ? ' has-error' : '' }}">
                                <label for="mother_national_id">@lang('Mother\'s National ID')</label>
                                {!! Form::text('mother_national_id', $user->studentInfo['mother_national_id'] ?? null, ['class' => 'form-control','id'=>'mother_national_id']) !!}
                                @if ($errors->has('mother_national_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('mother_national_id') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('mother_phone_number') ? ' has-error' : '' }}">
                                <label for="mother_phone_number">@lang('Mother\'s Phone Number')</label>
                                <input id="mother_phone_number" type="text" class="form-control"
                                       name="mother_phone_number"
                                       value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['mother_phone_number'];} @endphp">
                                @if ($errors->has('mother_phone_number'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('mother_phone_number') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('mother_annual_income') ? ' has-error' : '' }}">
                                <label for="mother_annual_income">@lang('Mother\'s Annual Income')</label>
                                <input id="mother_annual_income" type="text" class="form-control"
                                       name="mother_annual_income"
                                       value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['mother_annual_income'];} @endphp">
                                @if ($errors->has('mother_annual_income'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('mother_annual_income') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('mother_occupation') ? ' has-error' : '' }}">
                                <label for="mother_occupation">@lang('Mother\'s Occupation')</label>
                                <input id="mother_occupation" type="text" class="form-control"
                                       name="mother_occupation"
                                       value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['mother_occupation'];} @endphp">
                                @if ($errors->has('mother_occupation'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('mother_occupation') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('mother_designation') ? ' has-error' : '' }}">
                                <label for="mother_designation"
                                >@lang('Mother\'s Designation')</label>
                                <input id="mother_designation" type="text" class="form-control"
                                       name="mother_designation"
                                       value="@php if(isset($user->studentInfo['group'])){echo $user->studentInfo['mother_designation'];} @endphp">
                                @if ($errors->has('mother_designation'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('mother_designation') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <h4 class="edit_header"> @lang('Emergency Contact Information'):</h4>
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('contact_person') ? ' has-error' : '' }}">
                                <label for="contact_person">@lang('Name')</label>
                                {!! Form::text('contact_person',$user->studentInfo['contact_person'] ?? '', array('id' => 'contact_person', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('contact_person_mobile') ? ' has-error' : '' }}">
                                <label for="contact_person_mobile">@lang('Mobile')</label>
                                {!! Form::text('contact_person_mobile', $user->studentInfo['contact_person_mobile'] ?? '', array('id' => 'contact_person_mobile', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('contact_person_email') ? ' has-error' : '' }}">
                                <label for="contact_person_email">@lang('Address')</label>
                                {!! Form::text('contact_person_email', $user->studentInfo['contact_person_email'] ?? '', array('id' => 'contact_person_email', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
                            </div>
                            <div class="col-md-4 form-group{{ $errors->has('relation_with_cperson') ? ' has-error' : '' }}">
                                <label for="relation_with_cperson">@lang('Relationship')</label>
                                {!! Form::text('relation_with_cperson', $user->studentInfo['relation_with_cperson'] ?? '', array('id' => 'relation_with_cperson', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
                            </div>
                            @if(school('country')->code == 'BD')
                                <div class="col-md-12">
                                    <h4 class="edit_header"> @lang('Present Address'):</h4>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="presentAddress">@lang('Village')</label>
                                    {!! Form::text('present_address', $user->studentInfo['present_address'] ?? '', array('id' => 'presentAddress', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="perpostoffice">@lang('Post Office')</label>
                                    {!! Form::text('present_post_office', $user->studentInfo['present_post_office'] ?? '', array('id' => 'perpostoffice', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="perpostcode">@lang('Post Code')</label>
                                    {!! Form::text('present_postcode', $user->studentInfo['present_postcode'] ?? '', array('id' => 'perpostcode', 'class' => 'popTop form-control', 'placeholder' => trans(''),'autocomplete'=>'off','pattern' => '[0-9]*','title'=>'Please enter number only','maxlength'=>4,'minlength'=>4)) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="preDivision">@lang('Division')</label>
                                    {!! Form::select('present_division',$division, $user->studentInfo['present_division'] ?? null, array('id' => 'preDivision', 'class' => 'form-control', 'onchange'=>'getPersentDistrict(this.value)', 'placeholder' => trans('Choose'))) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="preDistrict">@lang('District')</label>
                                    {!! Form::select('present_district',array(), $user->studentInfo['present_district'], array('id' => 'preDistrict', 'class' => 'form-control', 'onchange'=>'getPersentThana(this.value)', 'placeholder' => trans('Choose'))) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="preThana">@lang('Thana')</label>
                                    {!! Form::select('present_thana', array(),$user->studentInfo['present_thana'] ?? null, array('id' => 'preThana', 'class' => 'form-control',  'placeholder' => trans('Choose'))) !!}
                                </div>
                                <div class="col-md-12">
                                    <h4 class="edit_header"> @lang('Permanent Address'):</h4>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pastAddress">@lang('Village')</label>
                                    {!! Form::text('permanent_address', $user->studentInfo['permanent_address'] ?? '', array('id' => 'pastAddress', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pastpostoffice">@lang('Post Office')</label>
                                    {!! Form::text('permanent_post_office', $user->studentInfo['permanent_post_office'] ?? '', array('id' => 'pastpostoffice', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pastpostcode">@lang('Post Code')</label>
                                    {!! Form::text('permanent_postcode', $user->studentInfo['permanent_postcode'] ?? '', array('id' => 'pastpostcode', 'class' => 'popTop form-control', 'placeholder' => trans(''),'autocomplete'=>'off','pattern' => '[0-9]*','title'=>'Please enter number only','maxlength'=>4,'minlength'=>4)) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pastDivision">@lang('Division')</label>
                                    {!! Form::select('permanent_division',$division, $user->studentInfo['permanent_division'] ?? null, array('id' => 'pastDivision', 'class' => 'form-control', 'onchange'=>'getPermanentDistrict(this.value)', 'placeholder' => trans('Choose'))) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pastDistrict">@lang('District')</label>
                                    {!! Form::select('permanent_district',array(), $user->studentInfo['permanent_district'] ?? null, array('id' => 'pastDistrict', 'class' => 'form-control', 'onchange'=>'getPermanentThana(this.value)', 'placeholder' => trans('Choose'))) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pastThana">@lang('Thana')</label>
                                    {!! Form::select('permanent_thana', array(),$user->studentInfo['permanent_thana']?? null, array('id' => 'pastThana', 'class' => 'form-control',  'placeholder' => trans('Choose'))) !!}
                                </div>
                            @else
                                <div class="col-md-12">
                                    <h4 class="edit_header"> @lang('Address Information'):</h4>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="streetAddress_1">@lang('Street Address 1')</label>
                                    {!! Form::text('street_address_1', $user->studentInfo['street_address_1'] ?? '', array('id' => 'streetAddress_1', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="streetAddress_2">@lang('Street Address 2')</label>
                                    {!! Form::text('street_address_2', $user->studentInfo['street_address_2'] ?? '', array('id' => 'streetAddress_2', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="country">@lang('Country')</label>
                                    {!! Form::select('country',$country, $user->studentInfo['country'] ?? null, array('id' => 'country', 'class' => 'form-control', 'onchange'=>'getPersentstate(this.value)', 'placeholder' => trans('Choose'))) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="state">@lang('State')</label>
                                    {!! Form::select('state', array(),$user->studentInfo['state'] ?? null, array('id' => 'state', 'class' => 'form-control',  'placeholder' => trans('Choose'))) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="city">@lang('City')</label>
                                    {!! Form::text('city', $user->studentInfo['city'] ?? '', array('id' => 'city', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="zipCode">@lang('Zip Code')</label>
                                    {!! Form::text('zipCode', $user->studentInfo['zipCode'] ?? '', array('id' => 'zipCode', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                </div>


                                @php
                                    if (foqas_setting('admission_additional_file') != '')
                                        $additional_files = explode(',',foqas_setting('admission_additional_file'));
                                    else
                                        $additional_files = [];
                                @endphp
                                @if($user->role == 'student')
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

                            @endif
                        @endif

                        @if($user->role == 'staff')
                            <div class="col-md-4 form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                <label for="role" class="control-label">@lang('Role')</label>
                                {!! Form::select('role',role(), old('role'), array('id' => 'role', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                                @error('role')
                                <span class="help-block">
                                            <strong>{{ $message  }}</strong>
                                        </span>
                                @enderror
                            </div>
                        @endif
                        @if($user->role == 'teacher' || $user->role == 'staff' || $user->role == 'librarian' || $user->role == 'accountant')
                            <div class="col-md-4 form-group{{ $errors->has('role_title') ? ' has-error' : '' }}">
                                <label for="role_title" class="control-label">@lang('Designation')</label>
                                {!! Form::text('role_title', NULL, array('id' => 'role_title', 'class' => 'form-control','autocomplete' => 'off')) !!}
                                @error('role_title')
                                <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                            @if(school('country')->code == 'SG')
                                @php
                                    $houses = \App\House::bySchool(Auth::user()->school_id)->status()->pluck('name', 'id');
                                    $houseid = isset($user->employeeDetail->house_id) ? $user->employeeDetail->house_id : '';
                                    $joindate = isset($user->employeeDetail->joindate) ? date('Y-m-d',strtotime($user->employeeDetail->joindate)) : '';
                                @endphp

                                <div class="col-md-4 form-group{{ $errors->has('house_id') ? ' has-error' : '' }}">
                                    {!! Form::label('house_id','Branch', ['class' => 'control-label']) !!}
                                    {!! Form::select('house_id', $houses , $houseid , ['class' => 'form-control','placeholder'=>'Choose']) !!}
                                    @error('house_id')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            @endif
                            <div class="col-md-4 form-group{{ $errors->has('joindate') ? ' has-error' : '' }}">
                                <label for="joindate" class="control-label">@lang('Date of Joining')</label>
                                {!! Form::text('joindate', $joindate, array('id' => 'joindate', 'class' => 'form-control','autocomplete' => 'off')) !!}
                                @if ($errors->has('joindate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('joindate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        @endif
                        @if(auth()->user()->role == 'admin' && $user->role == 'teacher')
                            <div class="col-md-4 form-group{{ $errors->has('class_teacher') ? ' has-error' : '' }}">
                                <label for="class_teacher_section_id">@lang('Class Teacher')</label>
                                {!! Form::select('class_teacher_section_id', getSectionAndClassPluck(),$user->section_id, ['class' => 'select2 form-control','id'=>'class_teacher_section_id','placeholder'=>'Choose']) !!}
                                @if ($errors->has('class_teacher_section_id'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('class_teacher_section_id') }}</strong>
                                        </span>
                                @endif
                            </div>
                        @endif
                        @if($user->role == 'teacher')
                            <div class="col-md-4 form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                                <label for="department" class="control-label">@lang('Department')</label>
                                <select id="department" class="form-control" name="department_id">
                                    @if (count($departments)) > 0)
                                    @foreach ($departments as $d)
                                        <option value="{{$d->id}}"
                                                @if ($d->id == old('department_id', $user->department_id))
                                                selected="selected"
                                                @endif
                                        >{{$d->department_name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('department'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('department') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label upperlabel">@lang('Upload CV')</label>
                                <div class="button-wrapper">
                                    <span class="label"> @lang('Choose File') </span>
                                    <input type="file" name="teacher_cv" id="cv" class="form-control upload-box" accept="image/*" placeholder="@lang('Upload File')">
                                </div>
                                <div style="clear: both;height:5px;"></div>
                            </div>
                        @endif
                        @if($user->role == 'teacher' || $user->role == 'staff' || $user->role == 'librarian' || $user->role == 'accountant' )
                            <div class="col-md-4 form-group{{ $errors->has('nationality') ? ' has-error' : '' }}">
                                <label for="nationality">@lang('Nationality')</label>
                                {!! Form::select('nationality',nationalityArray(), null, array('id' => 'nationality', 'class' => 'form-control select2', 'placeholder' => trans('Choose'))) !!}
                                @if ($errors->has('nationality'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nationality') }}</strong>
                                    </span>
                                @endif
                            </div>
                        @endif
                        <div class="col-md-12 form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                            {!! Form::label('about', transMsg('About'), ['class' => 'control-label']) !!}
                            {!! Form::textarea('about', null, ['class' => 'form-control','rows'=>3]) !!}
                            @if ($errors->has('about'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('about') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="col-md-2">
                                @if ($user->school->parent_id == Auth::user()->school_id && $user->role == 'admin')
                                    <a href="{{route('school.show',$user->code)}}"
                                       class="{{btnClass()}}">@lang('Cancel')</a>
                                @elseif (Auth::user()->role == 'master')
                                    <a href="{{route('school.show',$user->code)}}" class="{{btnClass()}} "
                                       style="margin-right: 2%;"
                                       role="button">@lang('Cancel')</a>
                                @else
                                    <a href="{{url('user/'.$user->student_code)}}" class="{{btnClass()}} "
                                       style="margin-right: 2%;"
                                       role="button">@lang('Cancel')</a>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input type="submit" role="button" class="{{btnClass()}}" value="@lang('Update')">
                            </div>
                            @if ($user->school->parent_id == Auth::user()->school_id && $user->role == 'admin' || auth()->user()->hasRole('master'))
                                <div class="col-md-2">
                                    <a href="{{route('user.changePasswordById',$user->student_code)}}"
                                       class="{{btnClass()}}">@lang('Change password')</a>
                                </div>
                            @endif
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"
          rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(function () {
            $('#birthday, #joindate').datepicker({
                format: "yyyy-mm-dd",
                viewMode: "days",
                minViewMode: "days",
                autoclose: true
            });
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
            @if(school('country')->code == 'BD')
            @if(!empty($user->studentInfo->present_division) && !empty($user->studentInfo->present_district))
            getAjaxDistrict('preDistrict', {{$user->studentInfo->present_division ?? ''}}, {{$user->studentInfo->present_district ?? ''}});
            @endif
            @if(!empty($user->studentInfo->present_district) && !empty($user->studentInfo->present_thana))
            getAjaxThana('preThana', {{$user->studentInfo->present_district ?? ''}}, {{$user->studentInfo->present_thana ?? ''}});
            @endif
            @if(!empty($user->studentInfo->permanent_division) && !empty($user->studentInfo->permanent_district))
            getAjaxDistrict('pastDistrict', {{$user->studentInfo->permanent_division ?? ''}}, {{$user->studentInfo->permanent_district ?? ''}});
            @endif
            @if(!empty($user->studentInfo->permanent_district) && !empty($user->studentInfo->permanent_thana))
            getAjaxThana('pastThana', {{$user->studentInfo->permanent_district ?? ''}}, {{$user->studentInfo->permanent_thana ?? ''}});
            @endif
            @endif
        });
    </script>
@endsection