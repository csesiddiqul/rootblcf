@extends('public.layout.public',['title' => transMsg($applyMenu->name) ])
@section('sliderText')
    <h1 class="page-title">{!! transMsg($applyMenu->name) !!}</h1>
@endsection
@section('content')
    <style type="text/css">
        .form-control:disabled, .form-control[readonly] {
            background-color: #e9ecef !important;
            opacity: 1;
        }
    </style>
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <div class="contact-page-section sec-spacer">
        <div class="container">
            <div class="contact-comment-section">
                @if(!empty(foqas_setting('form_link')))
                    <a class="btn btn-sm btn-success pull-right" href="{{foqas_setting('form_link')}}"
                       target="_blank">@lang('Download Admission Form')</a>
                    <div class="clearfix"></div>
                @endif
                @if(!empty(foqas_setting('instruction_title')) || !empty(foqas_setting('instruction_description')))
                    <fieldset class="scheduler-border col-md-12">
                        @if(!empty(foqas_setting('instruction_title')))
                            <legend class="scheduler-border">@lang(foqas_setting('instruction_title'))</legend>
                        @endif
                        <div class="row">
                            <div class="col-md-12"> {!! foqas_setting('instruction_description') !!}</div>
                        </div>
                    </fieldset>
                @endif
                @if (foqas_setting('admission_form') == 1)
                    <div id="form-messages"></div>
                    <form id="admission_form" method="post" action="javascript:void(0)" enctype="multipart/form-data">
                        @csrf
                        <fieldset>
                            @php
                                $input = session('applicationVal');
                            @endphp
                            @if(school('country')->code == 'BD')
                                @php $previous_class = 'Previous Class'; @endphp
                            @elseif(school('country')->code == 'SG')
                                @php $previous_class = 'Level'; @endphp
                            @else
                                @php $previous_class = 'Previous Grade'; @endphp
                            @endif
                            @if(foqas_setting('admission_loginInfo') == 1)
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">@lang('Login Information')</legend>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="email">@lang('Email')</label>
                                                {!! Form::email('email', $input['email'] ?? '', array('id' => 'email', 'class' => 'popTop form-control','autocomplete' => 'off','pattern'=>'[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$','title'=>'Please type a valid email')) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="password">@lang('Password')</label>
                                                {!! Form::password('password' , array('id' => 'password', 'class' => 'popTop form-control','autocomplete'=>'off','pattern'=>'.{8,}','title'=>'Password must eight or more characters','autocomplete'=>'off')) !!}
                                            </div>
                                        </div>
                                        @if(school('country')->code == 'SG')
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="mobile">@lang('Mobile') <code></code></label>
                                                    {!! Form::tel('mobile', $input['mobile'] ?? '', array('id' => 'mobile', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                </fieldset>
                            @endif
                            <fieldset class="scheduler-border col-md-12">
                                <legend class="scheduler-border">@lang('Student Personal Information')</legend>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="name">@lang('Name as in the Birth Certificate')
                                                <code>*</code></label>
                                            {!! Form::text('name', $input['name'] ?? '' , array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="father_name">@lang('Father Name') <code></code></label>
                                            {!! Form::text('father_name', $input['father_name'] ?? '', array('id' => 'father_name', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="mother_name">@lang('Mother Name') <code></code></label>
                                            {!! Form::text('mother_name', $input['mother_name'] ?? '', array('id' => 'mother_name', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                    </div>
                                    @if(school('country')->code != 'BD')
                                        @if(branch_permission())
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="branch_id">@lang('Branch')</label>
                                                    {!! Form::select('branch_id' , $branchPluck, $input['branch_id'] ?? null, array('id' => 'branch_id', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            @if(school('country')->code =='BD' || school('country')->code =='SG')
                                                <label for="class_id">@lang('Class') <code>*</code></label>
                                            @else
                                                <label for="class_id">@lang('Enroll In') <code>*</code></label>
                                            @endif
                                            {!! Form::select('class_id' , admissionClass(), $input['class_id'] ?? null, array('id' => 'class_id', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                                        </div>
                                    </div>
                                    @if(school('country')->code == 'SG')
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="admissioninbengaliClass">@lang('Admission in Bengali Class')</label>
                                                {!! Form::text('admissioninbengaliClass', $input['admissioninbengaliClass'] ?? '', array('id' => 'admissioninbengaliClass', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="placeBirth">@lang('Place of Birth') <code>*</code></label>
                                            {!! Form::text('placeBirth', $input['placeBirth'] ?? '', array('id' => 'placeBirth', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group ">
                                            <label for="dob">@lang('Date of Birth') <code>*</code></label>
                                            {!! Form::text('dob',  $input['dob'] ?? '', array('id' => 'dob', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off','readonly')) !!}
                                        </div>
                                    </div>
                                    @if(school('country')->code == 'BD')
                                        @php $birthcertificateNo = 'Birth Certificate No'; @endphp
                                    @elseif(school('country')->code == 'SG')
                                        @php $birthcertificateNo = 'Birth Certificate No/NRIC No/Passport No'; @endphp
                                    @else
                                        @php $birthcertificateNo = 'NRIC No/Passport No'; @endphp
                                    @endif
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="birthcertificateNo">@lang($birthcertificateNo)</label>
                                            {!! Form::text('birthcertificateNo', $input['birthcertificateNo'] ?? '', array('id' => 'birthcertificateNo', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="gender">@lang('Gender') <code>*</code></label>
                                            {!! Form::select('gender',gender(), $input['gender'] ?? null, array('id' => 'gender', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}

                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="bloodgroup">@lang('Blood Group') <code>*</code></label>
                                            {!!Form::select('bloodgroup',bloodgroup(), $input['bloodgroup'] ?? 9, array('id' => 'bloodgroup', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="religon">@lang('Religion') <code>*</code></label>
                                            {!! Form::select('religon',religon(), $input['religon'] ?? 5, array('id' => 'religon', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                                        </div>
                                    </div>
                                    @if(school('country')->code == 'SG')
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="nameAddressofmainSchool">@lang('Name and Address of Main School')</label>
                                                {!! Form::text('nameAddressofmainSchool',  $input['nameAddressofmainSchool'] ?? '', array('id' => 'nameAddressofmainSchool', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                            </div>
                                        </div>
                                        @if(school('country')->code == 'SG')
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="previous_class">@lang('Branch')</label>
                                                    {!! Form::select('previous_class' ,$housePluck,null, array('id' => 'previous_class', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="previous_class">@lang($previous_class)</label>
                                                    {!! Form::text('previous_class' ,null, array('id' => 'previous_class', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="nationality">@lang('Nationality')</label>
                                            {!! Form::select('nationality',nationalityArray(), $input['nationality'] ?? (school('country')->code == 'BD' ? 14 : (school('country')->code == 'SG' ? 159 : 3)), array('id' => 'nationality', 'class' => 'form-control select2', 'placeholder' => trans('Choose'))) !!}
                                        </div>
                                    </div>
                                    @if(school('country')->code != 'SG')
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="mobile">@lang('Mobile') <code>*</code></label>
                                                {!! Form::tel('mobile', $input['mobile'] ?? '', array('id' => 'mobile', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                                @if(school('country')->code == 'BD')
                                                    <code>@lang('You will receive all SMS to this number')</code>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    @if(school('country')->code == 'SG')
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="singaporepr">@lang('Resident status')</label>
                                                {!! Form::select('singaporepr',residentstatus(), $input['singaporepr'] ?? null, array('id' => 'singaporepr', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                                            </div>
                                        </div>
                                    @endif
                                    @if(school('country')->code == 'SG')
                                        <div class="col-md-8 col-sm-12">
                                            <div class="form-group ">
                                                <label for="">@lang('Class presently enrolled In the main School Previous knowledge of Bengali Language')</label>
                                                <div class="clearfix"></div>
                                                <div class="form-check form-check-inline form-control p-0 height38">

                                                    <input class="form-check-input ml-2" type="radio" name="bengaliLang"
                                                           id="bengaliLangGood" value="Good" checked>

                                                    <label class="form-check-label"
                                                           for="bengaliLangGood">@lang('Good') </label>

                                                    <input class="form-check-input ml-2" type="radio" name="bengaliLang"
                                                           id="bengaliLangFair"
                                                           value="Fair">

                                                    <label class="form-check-label"
                                                           for="bengaliLangFair">@lang('Fair') </label>

                                                    <input class="form-check-input ml-2" type="radio" name="bengaliLang"
                                                           id="bengaliLangPoor"
                                                           value="Poor">

                                                    <label class="form-check-label"
                                                           for="bengaliLangPoor">@lang('Poor')</label>
                                                    <input class="form-check-input ml-2" type="radio" name="bengaliLang"
                                                           id="bengaliLang"
                                                           value="Nill">

                                                    <label class="form-check-label"
                                                           for="bengaliLang">@lang('Nill')</label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @php
                                        if (foqas_setting('admission_additional_file') != '')
                                            $additional_files = explode(',',foqas_setting('admission_additional_file'));
                                        else
                                            $additional_files = [];
                                    @endphp
                                    @if(in_array(1,$additional_files))
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <div class="image-upload">
                                                    <label class="control-label upperlabel">
                                                        @lang('Upload Picture') <code>*</code>
                                                        <span id="deliMG" onclick="cancelUploadImg('unnamed2');"
                                                              style="display: none;"
                                                              class="myspanRemove">@lang('Remove')</span>
                                                    </label>
                                                    <label class="btn theme_bg btn-sm btn-block uploded-text form-group-btn"
                                                           for="file-upload">@lang('Choose Picture')</label>
                                                    <input type="file" value="" class="file-upload form-control"
                                                           id="file-upload"
                                                           accept="image/*">
                                                </div>
                                                <div style="clear:both;"></div>
                                                <div id="uploaded_image_url"></div>
                                            </div>
                                        </div>
                                    @endif
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
                                </div>
                            </fieldset>
                            @if(school('country')->code != 'SG')
                                <fieldset class="scheduler-border">
                                    <legend class="scheduler-border">@lang('Student Previous History')</legend>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="previous_school">@lang('Previous School Name')</label>
                                                {!! Form::text('nameAddressofmainSchool', $input['nameAddressofmainSchool'] ?? '', array('id' => 'previous_school', 'class' => 'form-control','autocomplete' => 'off')) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="previous_class">@lang($previous_class)</label>
                                                {!! Form::text('previous_class' ,null, array('id' => 'previous_class', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                            </div>
                                        </div>
                                        @if(school('country')->code == 'BD')
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="last_gpa">@lang('Last GPA')</label>
                                                    {!! Form::text('last_gpa' ,null, array('id' => 'last_gpa', 'class' => 'form-control','autocomplete'=>'off')) !!}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </fieldset>
                            @endif
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">@lang('Particulars Of Parents/Guardian')</legend>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="gName">@lang('Name')</label>
                                            {!! Form::text('gName', $input['gName'] ?? '', array('id' => 'gName', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="gEmail">@lang('E-mail')</label>
                                            {!! Form::text('gEmail',  $input['gEmail'] ?? '', array('id' => 'gEmail', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="gAddress">@lang('Address')</label>
                                            {!! Form::text('gAddress', $input['gAddress'] ?? '', array('id' => 'gAddress', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="gNationality">@lang('Nationality')</label>
                                            {!! Form::select('gNationality',nationalityArray(), $input['gNationality'] ?? (school('country')->code == 'BD' ? 14 : (school('country')->code == 'SG' ? 159 : 3)), array('id' => 'gNationality', 'class' => 'form-control select2', 'placeholder' => trans('Choose'))) !!}
                                        </div>
                                    </div>
                                    {{--  <div class="col-md-4 col-sm-12">
                                           <div class="form-group">
                                               <label for="gdate">@lang('Date')</label>
                                               {!! Form::text('gdate', $input['gdate'] ?? '', array('id' => 'gdate', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                           </div>
                                       </div> --}}
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="gOccupation">@lang('Occupation')</label>
                                            {!! Form::text('gOccupation', $input['gOccupation'] ?? '', array('id' => 'gOccupation', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="gMobile">@lang('Mobile')</label>
                                            {!! Form::text('gMobile', $input['gMobile'] ?? '', array('id' => 'gMobile', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                    </div>
                                    @if(school('country')->code == 'SG')
                                        <div class="col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="gnrcNo">@lang('NRIC No./Passport No.')</label>
                                                {!! Form::text('gnrcNo', $input['gnrcNo'] ?? '', array('id' => 'gnrcNo', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="gPhone">@lang('Phone')</label>
                                            {!! Form::text('gPhone', $input['gPhone'] ?? '', array('id' => 'gPhone', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="scheduler-border">
                                <legend class="scheduler-border">@lang('Emergency Contact Information')</legend>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="contactperson">@lang('Name') <code>*</code></label>
                                            {!! Form::text('contactperson', $input['contactperson'] ?? '', array('id' => 'contactperson', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="cemail">@lang('Address') <code>*</code></label>
                                            {!! Form::text('cemail', $input['cemail'] ?? '', array('id' => 'cemail', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="contactpersonmobile">@lang('Mobile') <code>*</code></label>
                                            {!! Form::text('contactpersonmobile', $input['contactpersonmobile'] ?? '', array('id' => 'contactpersonmobile', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="form-group">
                                            <label for="realation">@lang('Relationship') <code>*</code></label>
                                            {!! Form::text('realation', $input['realation'] ?? '', array('id' => 'realation', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            @if (school('country')->code == 'BD')
                                <div class="col-md-6 pull-left pl-0 {{useragentMobile() ? 'pr-0' : ''}}">
                                    <fieldset class="scheduler-border ">
                                        <legend class="scheduler-border">@lang('Present Address')</legend>
                                        <div class="form-group">
                                            <label for="presentAddress">@lang('Village') <code>*</code></label>
                                            {!! Form::text('presentAddress', $input['presentAddress'] ?? '', array('id' => 'presentAddress', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="preDivision">@lang('Division') <code>*</code></label>
                                            {!! Form::select('preDivision',$division, $input['preDivision'] ?? null, array('id' => 'preDivision', 'class' => 'form-control', 'onchange'=>'getPersentDistrict(this.value)', 'placeholder' => trans('Choose'))) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="preDistrict">@lang('District') <code>*</code></label>
                                            {!! Form::select('preDistrict',array(), '', array('id' => 'preDistrict', 'class' => 'form-control', 'onchange'=>'getPersentThana(this.value)', 'placeholder' => trans('Choose'))) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="preThana">@lang('Thana') <code>*</code></label>
                                            {!! Form::select('preThana', array(),$input['preThana'] ?? null, array('id' => 'preThana', 'class' => 'form-control',  'placeholder' => trans('Choose'))) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="perpostoffice">@lang('Post Office') <code>*</code></label>
                                            {!! Form::text('perpostoffice', $input['perpostoffice'] ?? '', array('id' => 'perpostoffice', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="perpostcode">@lang('Post Code') <code>*</code></label>
                                            {!! Form::text('perpostcode', $input['perpostcode'] ?? '', array('id' => 'perpostcode', 'class' => 'popTop form-control', 'placeholder' => trans(''),'autocomplete'=>'off','pattern' => '[0-9]*','title'=>'Please enter number only','maxlength'=>4,'minlength'=>4)) !!}
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-6 pull-left pr-0  {{useragentMobile() ? 'pl-0' : ''}}">
                                    <fieldset class="scheduler-border">
                                        <legend class="scheduler-border">@lang('Permanent Address')
                                            @if(useragentMobile() == false)
                                                @if(session('localLang') == 'en') &nbsp;&nbsp; @endif
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label" for="persent_same">
                                                        <input class="form-check-input" type="checkbox"
                                                               id="persent_same"
                                                               name="persent_same" onclick="sametoPersent()" value="1">
                                                        @lang('Same as Present Address')</label>
                                                </div>
                                            @endif
                                        </legend>
                                        @if(useragentMobile())
                                            <div class="form-check form-check-inline pull-right">
                                                <label class="form-check-label" for="persent_same">
                                                    <input class="form-check-input" type="checkbox"
                                                           id="persent_same"
                                                           name="persent_same" onclick="sametoPersent()" value="1">
                                                    @lang('Same as Present Address')</label>
                                            </div>
                                            <div class="clearfix"></div>
                                        @endif
                                        <div class="form-group required">
                                            <label for="pastAddress">@lang('Village') <code>*</code></label>
                                            {!! Form::text('pastAddress', $input['pastAddress'] ?? '', array('id' => 'pastAddress', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="pastDivision">@lang('Division') <code>*</code></label>
                                            {!! Form::select('pastDivision',$division, $input['pastDivision'] ?? null, array('id' => 'pastDivision', 'class' => 'form-control', 'onchange'=>'getPermanentDistrict(this.value)', 'placeholder' => trans('Choose'))) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="pastDistrict">@lang('District') <code>*</code></label>
                                            {!! Form::select('pastDistrict',array(), $input['pastDistrict'] ?? null, array('id' => 'pastDistrict', 'class' => 'form-control', 'onchange'=>'getPermanentThana(this.value)', 'placeholder' => trans('Choose'))) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="pastThana">@lang('Thana') <code>*</code></label>
                                            {!! Form::select('pastThana', array(),$input['pastThana'] ?? null, array('id' => 'pastThana', 'class' => 'form-control',  'placeholder' => trans('Choose'))) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="pastpostoffice">@lang('Post Office')
                                                <code>*</code></label>
                                            {!! Form::text('pastpostoffice', $input['pastpostoffice'] ?? '', array('id' => 'pastpostoffice', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                        </div>
                                        <div class="form-group">
                                            <label for="pastpostcode">@lang('Post Code') <code>*</code></label>
                                            {!! Form::text('pastpostcode', $input['pastpostcode'] ?? '', array('id' => 'pastpostcode', 'class' => 'popTop form-control', 'placeholder' => trans(''),'autocomplete'=>'off','pattern' => '[0-9]*','title'=>'Please enter number only','maxlength'=>4,'minlength'=>4)) !!}
                                        </div>
                                    </fieldset>
                                </div>
                            @else
                                @if(school('country')->code != 'SG')
                                    <fieldset class="scheduler-border">
                                        <legend class="scheduler-border">@lang('Address Information')</legend>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="streetAddress_1">@lang('Street Address 1')</label>
                                                    {!! Form::text('streetAddress_1', $input['streetAddress_1'] ?? '', array('id' => 'streetAddress_1', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="streetAddress_2">@lang('Street Address 2')</label>
                                                    {!! Form::text('streetAddress_2', $input['streetAddress_2'] ?? '', array('id' => 'streetAddress_2', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="country">@lang('Country')</label>
                                                    {!! Form::select('country',$country, $input['country'] ?? null, array('id' => 'country', 'class' => 'form-control', 'onchange'=>'getPersentstate(this.value)', 'placeholder' => trans('Choose'))) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="state">@lang('State')</label>
                                                    {!! Form::select('state', array(),$input['state'] ?? null, array('id' => 'state', 'class' => 'form-control',  'placeholder' => trans('Choose'))) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="city">@lang('City')</label>
                                                    {!! Form::text('city', $input['city'] ?? '', array('id' => 'city', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="zipCode">@lang('Zip Code')</label>
                                                    {!! Form::text('zipCode', $input['zipCode'] ?? '', array('id' => 'zipCode', 'class' => 'form-control', 'placeholder' => trans(''),'autocomplete'=>'off')) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                @endif
                            @endif
                            <div class="clearfix"></div>
                            <div class="form-group mb-0 text-center">
                                <a href="{{route('public.index')}}" class="btn btn-primary">@lang('Cancel')</a>
                                <button class="btn btnSubmit btn-primary">@lang('Next & Review')</button>
                            </div>
                        </fieldset>
                    </form>
                    @push('modalss')
                        <div class="modal fade" id="previewModal" tabindex="-1" role="dialog"
                             aria-labelledby="PreviewTitle" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="PreviewTitle">@lang('Application preview')</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body append">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">@lang('Close')
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endpush
                    @push('script')
                        <script>
                            $(document).ready(function () {
                                $('#dob').datepicker({
                                    clearBtn: true,
                                    format: "dd/mm/yyyy",
                                    autoclose: true
                                });
                                $('#gdate').datepicker({
                                    clearBtn: true,
                                    format: "dd/mm/yyyy",
                                    autoclose: true
                                });
                                $("#admission_form #email").keyup(function () {
                                    var accountEmail = $(this).val();
                                    accountEmailCheck(accountEmail);
                                }).keydown(function () {
                                    var accountEmail = $(this).val();
                                    accountEmailCheck(accountEmail);
                                });
                                @isset($input['preDivision'])
                                getPersentDistrict({{$input['preDivision'] ?? ''}}, {{$input['preDistrict'] ?? ''}});
                                @endisset
                                @isset($input['preDistrict'])
                                getPersentThana({{$input['preDistrict'] ?? ''}}, {{$input['preThana'] ?? ''}});
                                @endisset
                                @isset($input['persent_same'])
                                @if($input['persent_same'] === '1')
                                $("#persent_same").attr("checked", "checked");
                                sametoPersent();
                                @endif
                                @endisset
                            });
                        </script>
                            <script>
                                @foreach(admissionClass() as $key => $class)
                                @if($class == 'To be Assigned')
                                $( "#class_id" ).val({{$key}}).change();
                                @endif
                                @endforeach
                            </script>
                    @endpush
                @else
                    <div class="alert alert-danger text-center">
                        {{transMsg('Admission form not published yet')}}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @component('components.cropper.element',['width'=>'270','height'=>'270','type'=>'square']) @endcomponent
    <style>
        .button-wrapper {
            text-align: center;
        }

        .button-wrapper span.label {
            display: inline-block;
            width: 100%;
            background: {{foqas_setting('theme_bg')}};
            cursor: pointer;
            color: {{foqas_setting('theme_color')}};
            padding: 6px 0;
            font-size: .875rem;
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
            color: {{foqas_setting('theme_color')}};
            background-color: {{foqas_setting('theme_bg')}};
            border-color: {{foqas_setting('theme_bg')}};
        }

        .theme_bg {
            background: {{foqas_setting('theme_bg')}};
            color: {{foqas_setting('theme_color')}}       !important;
        }
    </style>
@endsection
