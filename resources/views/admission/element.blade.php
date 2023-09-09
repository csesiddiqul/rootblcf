@push('styles')
    <style>
        fieldset.scheduler-border {
            border: 1px groove #f9f9f985 !important;
        }

        .button-wrapper {
            text-align: center;
        }

        .button-wrapper span.label {
            display: inline-block;
            width: 100%;
            background: #0077f7;
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
@endpush
@if(foqas_setting('admission_loginInfo') == 1)
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">@lang('Login Information')</legend>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="email"> @lang('Email')</label>
                    {!! Form::email('email', NULL, array('id' => 'email', 'class' => 'popTop form-control','autocomplete' => 'off','pattern'=>'[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$','title'=>transMsg('Please type a valid email'))) !!}
                    @error('email')
                    <span class="help-block">
                <strong>{{ $message }}</strong>
            </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="password"> @lang('Password')</label>
                    {!! Form::password('password', array('id' => 'password', 'class' => 'popTop form-control','pattern'=>'.{8,}','title'=>transMsg('Password must eight or more characters'),'autocomplete'=>'off')) !!}
                    <span toggle="#password"
                          class="fa fa-fw fa-eye eye-field-icon toggle-password"></span>
                    @error('password')
                    <span class="help-block">
                  <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>
            @if(school('country')->code == 'SG')
                <div class="form-group col-md-4 col-sm-12">
                    <label for="mobile"> @lang('Mobile') <span class="text-danger">*</span></label>
                    {!! Form::text('mobile', NULL, array('id' => 'mobile', 'class' => 'form-control', 'autocomplete' => 'off')) !!}
                    @if(school('country')->code == 'BD')
                        <code>@lang('Student will receive all SMS to this number')</code>
                    @endif
                </div>
            @endif

        </div>
    </fieldset>
@endif
<fieldset class="scheduler-border">
    <legend class="scheduler-border">@lang('Student Personal Information')</legend>
    <div class="row">
        <div class="form-group col-md-4 col-sm-12">
            <label for="name">@lang('Name as in the Birth Certificate') <span class="text-danger">*</span></label>
            {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'autocomplete' => 'off')) !!}
            @error('name')
            <span class="help-block">
                                       <strong>{{ $message }}</strong>
                                   </span>
            @enderror
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="father_name"> @lang('Father Name') <span class="text-danger">*</span></label>
            {!! Form::text('father_name', NULL, array('id' => 'father_name', 'class' => 'form-control', 'autocomplete' => 'off')) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="mother_name"> @lang('Mother Name') <span class="text-danger">*</span></label>
            {!! Form::text('mother_name', NULL, array('id' => 'mother_name', 'class' => 'form-control', 'autocomplete' => 'off')) !!}
        </div>
        @if(school('country')->code == 'SG')
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="previous_class">@lang('Branch')</label>
                    {!! Form::select('previous_class' ,$housePluck,null, array('id' => 'previous_class', 'class' => 'form-control','autocomplete'=>'off')) !!}
                </div>
            </div>
        @else
            @if(school('country')->code != 'BD')
                @if(branch_permission())
                    <div class="form-group col-md-4 col-sm-12">
                        <label for="branch_id">@lang('Branch')</label>
                        {!! Form::select('branch_id' , $branchPluck, null, array('id' => 'branch_id', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                    </div>
                @endif
            @endif
        @endif
        <div class="form-group col-md-4 col-sm-12">
            <label for="class_id"> {{trans(school('country')->code == 'BD' || 'SG' ? 'Class' : 'Enroll In')}} <span
                        class="text-danger">*</span></label>
            {!! Form::select('class_id',admissionClass(), $admission->section_id ?? old('class_id'), array('id' => 'class_id', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
            @error('class_id')
            <span class="help-block">
                  <strong>{{ $message }}</strong>
               </span>
            @enderror
        </div>
        @if(school('country')->code == 'SG')
            <div class="form-group col-md-4 col-sm-12">
                <label for="admissioninbengaliClass"> @lang('Admission in Bengali Class')</label>
                {!! Form::text('admissioninbengaliClass', NULL, array('id' => 'admissioninbengaliClass', 'class' => 'form-control','autocomplete'=>'off')) !!}
            </div>
        @endif
        <div class="form-group col-md-4 col-sm-12">
            <label for="placeBirth"> @lang('Place of Birth') <span class="text-danger">*</span></label>
            {!! Form::text('placeBirth', NULL, array('id' => 'placeBirth', 'class' => 'form-control', 'autocomplete' => 'off')) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="dob"> @lang('Date of Birth') <span class="text-danger">*</span></label>
            {!! Form::text('dob', (isset($admission) ? date('d/m/Y',strtotime($admission->dob)) : NUll), array('id' => 'dob', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
        </div>
        @if(school('country')->code == 'BD')
            @php $birthcertificateNo = 'Birth Certificate No'; @endphp
        @elseif(school('country')->code == 'SG')
            @php $birthcertificateNo = 'Birth Certificate No/NRIC No/Passport No'; @endphp
        @else
            @php $birthcertificateNo = 'NRIC No/Passport No'; @endphp
        @endif
        @if(school('country')->code == 'BD')
            @php $previous_class = 'Previous Class'; @endphp
        @elseif(school('country')->code == 'SG')
            @php $previous_class = 'Level'; @endphp
        @else
            @php $previous_class = 'Previous Grade'; @endphp
        @endif
        <div class="form-group col-md-4 col-sm-12">
            <label for="birthcertificateNo"> @lang($birthcertificateNo)</label>
            {!! Form::text('birthcertificateNo', NULL, array('id' => 'birthcertificateNo', 'class' => 'form-control','autocomplete'=>'off')) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="gender"> @lang('Gender') <span class="text-danger">*</span></label>
            {!! Form::select('gender',gender(), old('gender'), array('id' => 'gender', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="bloodgroup"> @lang('Blood Group') <span class="text-danger">*</span></label>
            {!!Form::select('bloodgroup',bloodgroup(), old('bloodgroup'), array('id' => 'bloodgroup', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="religon"> @lang('Religion') <span class="text-danger">*</span></label>
            {!! Form::select('religon',religon(), old('religon'), array('id' => 'religon', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
        </div>
        @if(school('country')->code == 'SG')
            <div class="form-group col-md-4 col-sm-12">
                <label for="nameAddressofmainSchool"> @lang('Name and Address of Main School')</label>
                {!! Form::text('nameAddressofmainSchool', NULL, array('id' => 'nameAddressofmainSchool', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
            </div>
        <!--            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label for="previous_class">@lang($previous_class)</label>
                    {!! Form::text('previous_class' ,null, array('id' => 'previous_class', 'class' => 'form-control','autocomplete'=>'off')) !!}
                </div>
            </div>-->
            <div class="form-group col-md-4 col-sm-12">
                <label for="singaporepr"> @lang('Resident Status')</label>
                {!! Form::select('singaporepr',residentstatus(), old('singaporepr'), array('id' => 'singaporepr', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
            </div>
        @endif
        <div class="form-group col-md-4 col-sm-12">
            <label for="nationality"> @lang('Nationality')</label>
            {!! Form::select('nationality',nationalityArray(), (school('country')->code == 'BD' ? 14 : (school('country')->code == 'SG' ? 159 : 3)), array('id' => 'nationality', 'class' => 'form-control select2', 'placeholder' => trans('Choose'))) !!}
        </div>
        @if(school('country')->code != 'SG')
            <div class="form-group col-md-4 col-sm-12">
                <label for="mobile"> @lang('Mobile') <span class="text-danger">*</span></label>
                {!! Form::text('mobile', NULL, array('id' => 'mobile', 'class' => 'form-control', 'autocomplete' => 'off')) !!}
                @if(school('country')->code == 'BD')
                    <code>@lang('Student will receive all SMS to this number')</code>
                @endif
            </div>
        @endif
        @if(school('country')->code == 'SG')
            <div class="form-group col-md-8">
                <label for="radio"> @lang('Class presently enrolled In the main School Previous knowledge of Bengali Language')</label>
                <div class="onlyclear"></div>
                <label class="radio-inline">
                    <input id="bengaliLang" type="radio" value="Good" name="bengaliLang" {{$admission->bengaliLang == 'Good' ?'checked':''}}>@lang('Good')
                </label>
                <label class="radio-inline">
                    <input id="bengaliLang" type="radio" name="bengaliLang" value="Fair" {{$admission->bengaliLang == 'Fair' ?'checked':''}}>@lang('Fair')
                </label>
                <label class="radio-inline">
                    <input id="bengaliLang" type="radio" name="bengaliLang" value="Poor" {{$admission->bengaliLang == 'Poor' ?'checked':''}}>@lang('Poor')
                </label>
                <label class="radio-inline">
                    <input id="bengaliLang" type="radio" name="bengaliLang"  value="Nill" {{$admission->bengaliLang == 'Nill' ?'checked':''}}>@lang('Nill')
                </label>
            </div>
        @endif
        @php
            if (!empty(foqas_setting('admission_additional_file')))
                $additional_files = explode(',',foqas_setting('admission_additional_file'));
            else
                $additional_files = [];
        @endphp
        @if(count($additional_files)>0)
            @if(in_array(1,$additional_files))
                <div class="form-group col-md-4 col-sm-12">
                    <div class="image-upload">
                        <label class="control-label upperlabel ">
                            @lang('Upload Picture') <span class="text-danger">*</span>
                            <span id="deliMG" onclick="cancelUploadImg('unnamed2');" style="display: none;"
                                  class="myspanRemove">@lang('Remove')</span>
                        </label>
                        <label class="btn btn-success btn-sm btn-block uploded-text allButton"
                               for="file-upload">@lang('Choose Picture')</label>
                        <input type="file" value="" class="file-upload form-control" id="file-upload"
                               accept="image/*">
                    </div>
                    <div style="clear:both;"></div>
                    <div id="uploaded_image_url"></div>
                </div>
            @endif
            @foreach($additional_files as $key => $file)
                @if($file != 1)
                    @php $renderAddSlug = school('code').$file @endphp
                    <div class="col-md-4 col-sm-12">
                        <label class="control-label upperlabel">
                            {!! admission_additional_file($file) !!}</label>
                        <div class="button-wrapper">
                             <span class="label"> @lang('Choose File')</span>
                            <input type="file" name="{{$renderAddSlug}}" id="{{$renderAddSlug}}"
                                   class="form-control upload-box"
                                   accept="image/*" placeholder="@lang('Upload File')">
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
</fieldset>
@if(school('country')->code != 'SG')
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">@lang('Student Previous History')</legend>
        <div class="row">
            <div class="form-group col-md-4 col-sm-12">
                <label for="previous_school">@lang('Previous School Name')</label>
                {!! Form::text('nameAddressofmainSchool', null, array('id' => 'previous_school', 'class' => 'form-control','autocomplete' => 'off')) !!}
            </div>
            <div class="form-group col-md-4 col-sm-12">
                <label for="previous_class">@lang($previous_class)</label>
                {!! Form::text('previous_class' ,null, array('id' => 'previous_class', 'class' => 'form-control','autocomplete'=>'off')) !!}
            </div>
            @if(school('country')->code == 'BD')
                <div class="form-group col-md-4 col-sm-12">
                    <label for="last_gpa">@lang('Last GPA')</label>
                    {!! Form::text('last_gpa' ,null, array('id' => 'last_gpa', 'class' => 'form-control','autocomplete'=>'off')) !!}
                </div>
            @endif
        </div>
    </fieldset>
@endif
<fieldset class="scheduler-border">
    <legend class="scheduler-border">@lang('Particulars Of Parents/Guardian')</legend>
    <div class="row">
        <div class="form-group col-md-4 col-sm-12">
            <label for="gName"> @lang('Name')</label>
            {!! Form::text('gName', NULL, array('id' => 'gName', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="gEmail">@lang('E-mail')</label>
            {!! Form::text('gEmail', NULL, array('id' => 'gEmail', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="gAddress"> @lang('Address')</label>
            {!! Form::text('gAddress', NULL, array('id' => 'gAddress', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="gNationality"> @lang('Nationality')</label>
            {!! Form::select('gNationality',nationalityArray(), (school('country')->code == 'BD' ? 14 : (school('country')->code == 'SG' ? 159 : 3)), array('id' => 'gNationality', 'class' => 'form-control select2', 'placeholder' => trans('Choose'))) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="gOccupation">@lang('Occupation')</label>
            {!! Form::text('gOccupation', NULL, array('id' => 'gOccupation', 'class' =>'form-control','autocomplete'=>'off')) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="gMobile"> @lang('Mobile')</label>
            {!! Form::text('gMobile', NULL, array('id' => 'gMobile', 'class' => 'form-control','autocomplete'=>'off')) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="gPhone"> @lang('Phone')</label>
            {!! Form::tel('gPhone', NULL, array('id' => 'gPhone', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="gdate"> @lang('Date of Birth')</label>
            {!! Form::text('gdate',date('d/m/Y',strtotime($admission->gdate)) ?? NULL, array('id' => 'gdate', 'class' => 'form-control','autocomplete'=>'off')) !!}
        </div>
        @if(school('country')->code == 'SG')
            <div class="form-group col-md-4 col-sm-12">
                <label for="gnrcNo"> @lang('NRIC No./Passport No.')</label>
                {!! Form::text('gnrcNo', NULL, array('id' => 'gnrcNo', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
            </div>
        @endif
    </div>
</fieldset>
<fieldset class="scheduler-border col-md-12">
    <legend class="scheduler-border">@lang('Emergency Contact Information')</legend>
    <div class="row">
        <div class="form-group col-md-4 col-sm-12">
            <label for="contactperson"> @lang('Name') <span class="text-danger">*</span></label>
            {!! Form::text('contactperson', NULL, array('id' => 'contactperson', 'class' => 'form-control','autocomplete'=>'off')) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="cemail"> @lang('Address') <span class="text-danger">*</span></label>
            {!! Form::text('cemail', NULL, array('id' => 'cemail', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="contactpersonmobile"> @lang('Mobile') <span class="text-danger">*</span></label>
            {!! Form::text('contactpersonmobile', NULL, array('id' => 'contactpersonmobile', 'class' => 'form-control','autocomplete'=>'off')) !!}
        </div>
        <div class="form-group col-md-4 col-sm-12">
            <label for="realation"> @lang('Relationship') <span class="text-danger">*</span></label>
            {!! Form::text('realation', NULL, array('id' => 'realation', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
        </div>
    </div>
</fieldset>
@if(school('country')->code == 'BD')
    <fieldset class="scheduler-border col-md-12">
        <legend class="scheduler-border">@lang('Present Address')</legend>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="presentAddress"> @lang('Village')</label>
                    {!! Form::text('presentAddress', NULL, array('id' => 'presentAddress', 'class' => 'form-control','autocomplete'=>'off')) !!}
                </div>

                <div class="form-group">
                    <label for="preDivision"> @lang('Division')</label>
                    {!! Form::select('preDivision',$division, old('preDivision'), array('id' => 'preDivision', 'class' => 'form-control', 'onchange'=>'getPersentDistrict(this.value)', 'placeholder' => trans('Choose'))) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="perpostoffice"> @lang('Post Office')</label>
                    {!! Form::text('perpostoffice', NULL, array('id' => 'perpostoffice', 'class' => 'form-control','autocomplete'=>'off')) !!}
                </div>
                <div class="form-group">
                    <label for="preDistrict"> @lang('District')</label>
                    {!! Form::select('preDistrict',array(), old('preDistrict'), array('id' => 'preDistrict', 'class' => 'form-control', 'onchange'=>'getPersentThana(this.value)', 'placeholder' => trans('Choose'))) !!}
                </div>
            </div>
            {{-- Right Side Column Start--}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="perpostcode"> @lang('Post Code')</label>
                    {!! Form::text('perpostcode', NULL, array('id' => 'perpostcode', 'class' => 'popTop form-control','autocomplete'=>'off','pattern' => '[0-9]*','title'=>'Please enter number only','maxlength'=>4,'minlength'=>4 )) !!}
                </div>
                <div class="form-group">
                    <label for="preThana"> @lang('Thana')</label>
                    {!! Form::select('preThana', array(),old('preThana'), array('id' => 'preThana', 'class' => 'form-control',  'placeholder' => trans('Choose'))) !!}
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="scheduler-border col-md-12">
        <legend class="scheduler-border">@lang('Permanent Address')
            <label class="checkbox-inline">
                <input id="persent_same" name="persent_same" type="checkbox" value="1"
                       onclick="sametoPersent()"><code>@lang('Same as Present Address')</code>
            </label>
        </legend>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="pastAddress"> @lang('Village')</label>
                    {!! Form::text('pastAddress', NULL, array('id' => 'pastAddress', 'class' => 'form-control','autocomplete'=>'off')) !!}
                </div>
                <div class="form-group">
                    <label for="pastDivision"> @lang('Division')</label>
                    {!! Form::select('pastDivision',$division, old('pastDivision'), array('id' => 'pastDivision', 'class' => 'form-control', 'onchange'=>'getPermanentDistrict(this.value)', 'placeholder' => trans('Choose'))) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="pastpostoffice"> @lang('Post Office')</label>
                    {!! Form::text('pastpostoffice', NULL, array('id' => 'pastpostoffice', 'class' => 'form-control','autocomplete'=>'off')) !!}
                </div>
                <div class="form-group">
                    <label for="pastDistrict"> @lang('District')</label>
                    {!! Form::select('pastDistrict',array(), old('pastDistrict'), array('id' => 'pastDistrict', 'class' => 'form-control', 'onchange'=>'getPermanentThana(this.value)', 'placeholder' => trans('Choose'))) !!}
                </div>
            </div>
            {{-- Right Side Column Start--}}
            <div class="col-md-4">
                <div class="form-group">
                    <label for="pastpostcode"> @lang('Post Code')</label>
                    {!! Form::text('pastpostcode', NULL, array('id' => 'pastpostcode', 'class' => 'popTop form-control','pattern' => '[0-9]*','title'=>'Please enter number only','maxlength'=>4,'minlength'=>4)) !!}
                </div>
                <div class="form-group">
                    <label for="pastThana"> @lang('Thana')</label>
                    {!! Form::select('pastThana', array(),old('pastThana'), array('id' => 'pastThana', 'class' => 'form-control',  'placeholder' => trans('Choose'))) !!}
                </div>
            </div>
            {{-- Right Side Column End--}}
        </div>
    </fieldset>
@else
    @if(school('country')->code != 'SG')
        <fieldset class="scheduler-border col-md-12">
            <legend class="scheduler-border">@lang('Address Information')</legend>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="streetAddress_1"> @lang('Street Address 1')</label>
                        {!! Form::text('streetAddress_1', NULL, array('id' => 'streetAddress_1', 'class' => 'form-control','autocomplete'=>'off')) !!}
                    </div>
                    <div class="form-group" style=" ">
                        <label for="state"> @lang('State')</label>
                        {!! Form::select('state', array(),old('state'), array('id' => 'state', 'class' => 'form-control',  'placeholder' => trans('Choose'))) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="streetAddress_2"> @lang('Street Address 2')</label>
                        {!! Form::text('streetAddress_2', NULL, array('id' => 'streetAddress_2', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
                    </div>
                    <div class="form-group" style=" ">
                        <label for="city"> @lang('City')</label>
                        {!! Form::text('city', NULL, array('id' => 'city', 'class' => 'form-control','autocomplete'=>'off')) !!}
                    </div>
                </div>
                {{-- Right Side Column End--}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="country"> @lang('Country')</label>
                        {!! Form::select('country',$country, old('country'), array('id' => 'country', 'class' => 'form-control', 'onchange'=>'getPersentstate(this.value)', 'placeholder' => trans('Choose'))) !!}
                    </div>
                    <div class="form-group" style=" ">
                        <label for="zipCode"> @lang('Zip Code')</label>
                        {!! Form::text('zipCode', NULL, array('id' => 'zipCode', 'class' => 'form-control','autocomplete'=>'off')) !!}
                    </div>
                </div>
            </div>
        </fieldset>
    @endif
@endif
@push('script')
    @component('components.cropper.element',['width'=>'270','height'=>'270','type'=>'square']) @endcomponent
    <script>
        $(function () {
            $('#dob').datepicker({
                format: "dd-mm-yyyy",
                viewMode: "days",
                minViewMode: "days",
                autoclose: true,
            });
            $('#gdate').datepicker({
                format: "dd-mm-yyyy",
                viewMode: "days",
                minViewMode: "days",
                autoclose: true,
            });
            @isset($admission->preDivision)
            getAjaxDistrict('preDistrict', {{$admission->preDivision ?? ''}}, {{$admission->preDistrict ?? ''}});
            @endisset
            @isset($admission->preDistrict)
            getAjaxThana('preThana', {{$admission->preDistrict ?? ''}}, {{$admission->preThana ?? ''}});
            @endisset
            @isset($admission->preDivision)
            getAjaxDistrict('pastDistrict', {{$admission->preDivision ?? ''}}, {{$admission->preDistrict ?? ''}});
            @endisset
            @isset($admission->preDistrict)
            getAjaxThana('pastThana', {{$admission->preDistrict ?? ''}}, {{$admission->preThana ?? ''}});
            @endisset
            @isset($admission->persent_same)
            @if ($admission->persent_same == 1)
            $("#persent_same").attr("checked", "checked");
            setTimeout(function () {
                sametoPersent();
            }, 1000);
            @endif
            @endisset
        });

        $('#admission_form #status').on('change', function (e) {
            var status = e.target.value;
            if (status === '3') {
                $(".showRemark").css('display', 'block');
            } else {
                $(".showRemark").css('display', 'none');
            }
        })
        $("#admission_form #email").keyup(function () {
            var accountEmail = $(this).val();
            accountEmailCheck(accountEmail);
        }).keydown(function () {
            var accountEmail = $(this).val();
            accountEmailCheck(accountEmail);
        });
    </script>
@endpush
