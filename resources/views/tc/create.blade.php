@extends('layouts.app')
@section('title', __('TC Create'))
@section('content')
    @php
        $section = (new App\Section())->getSection(true, true, true,'classes.name');
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.certificate.create').'">'. trans('Certificate').'</a> / <a href="'. route('academic.tc.create').'">'. trans('TC').'</a> / <b>'.trans('Add').'<b>'])
                @include('components.sectionbar.certificate-bar')
                <div class="clearfix"></div>
                <div class="panel panel-default">
                    <div class="panel-body pad-top-0">
                        <form method="POST" id=" " action="{{ route('academic.tc.store') }}" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group{{ $errors->has('section') ? ' has-error' : '' }}">
                                        {!! Form::label('section', trans('Section'), ['class' => 'control-label']) !!}
                                        {!! Form::select('section',$section, null, array('required', 'class' => 'select2 form-control','id'=>'section', 'placeholder' => trans('Choose'),'onchange'=>'getStudentsSessionSection()')) !!}
                                        @error('section')
                                        <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tc_admissionid"> @lang('Student  Code')</label>
                                        <input type="text" class="form-control" id="tc_admissionid"
                                               name="tc_admissionid" id="tc_admissionid" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="tc_fname"> @lang('Father Name')</label>
                                        <input type="text" class="form-control" id="tc_fname" name="tc_fname" readonly>
                                    </div>
                                    
                                   
                                    <div class="form-group">
                                        <label for="tc_dob"> @lang('Date of Birth')</label>
                                        <input type="text" class="form-control" id="tc_dob"
                                               name="tc_dob" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="reason"> @lang('Reasons for leaving the school')</label>
                                        <input type="text" class="form-control" id="reason" name="reason">
                                    </div>
                                   
                                    <div class="form-group">
                                        <label for="date"> @lang('Date')</label>
                                        <input type="text" class="form-control" id="date" name="date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class=" form-group{{ $errors->has('session') ? ' has-error' : '' }}">
                                        {!! Form::label('session', trans('Session'), ['class' => 'control-label']) !!}
                                        {!! Form::select('session', schoolSession(1, true),null, ['class' => 'select2 form-control','id'=>'session','required','onchange'=>'getStudentsSessionSection()','placeholder'=>'Choose']) !!}
                                        @if ($errors->has('session'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('session') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="studentname"> @lang('Student Name')</label>
                                        <input type="text" class="form-control" id="studentname" name="studentname" id="studentname" readonly>
                                    </div>
                                    
                                     <div class="form-group">
                                        <label for="tc_mname"> @lang('Mother Name')</label>
                                        <input type="text" class="form-control" id="tc_mname" name="tc_mname" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="date_lastclass"> @lang('Date of last class in the school')</label>
                                        {!! Form::text('date_lastclass', NULL, array('id' => 'date_lastclass', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="remark"> @lang('Any other remarks')</label>
                                        {!! Form::text('remark', NULL, array('id' => 'remark', 'class' => 'form-control', 'autocomplete'=>'off')) !!}
                                    </div>
                                     
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="student">@lang('Student Name')</label>
                                        {!! Form::select('student', array(), null, array('id' => 'student', 'class' => 'form-control select2','required','onchange'=>'getStudentInfo(this.value)','placeholder' =>trans('Choose'))) !!}
                                        @error('student')
                                        <span class="help-block">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                     <div class="form-group">
                                        <label for="first_ad_class"> @lang('First admission class in the school')</label>
                                        <input type="text" class="form-control" id="first_ad_class" name="first_ad_class">
                                    </div>
                                    <div class="form-group">
                                        <label for="laststudied"> @lang('Class in which student last studied')</label>
                                        <input type="text" class="form-control" id="laststudied"
                                               name="laststudied">
                                    </div>
                                    <div class="form-group">
                                        <label for="dues"> @lang('School dues paid or not')</label>
                                        <input type="text" class="form-control" id="dues" name="dues">
                                    </div>
                                    <div class="form-group">
                                        <label for="behaviour"> @lang('Behaviour of the student')</label>
                                        <input type="text" class="form-control" id="behaviour" name="behaviour">
                                    </div>
                                </div>
                                <div class="clearfix" style="clear: both;"></div>
                                <div class="col-md-4">
                                    <h4>@lang('Present Address'): </h4>
                                </div>
                                <div class="clearfix" style="clear: both;"></div>
                                <div class="form-group col-md-4">
                                    <label for="tc_previllage"> @lang('Village')</label>
                                    <input type="text" class="form-control" id="tc_previllage" name="tc_previllage"
                                           readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tc_prepost"> @lang('Post Office')</label>
                                    <input type="text" class="form-control" id="tc_prepost" name="tc_prepost" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tc_prepostcode"> @lang('Post Code')</label>
                                    <input type="text" class="form-control" id="tc_prepostcode" name="tc_prepostcode"
                                           readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tc_prethana"> @lang('Thana')</label>
                                    <input type="text" class="form-control" id="tc_prethana" name="tc_prethana"
                                           readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tc_predistrict"> @lang('District')</label>
                                    <input type="text" class="form-control" id="tc_predistrict" name="tc_predistrict"
                                           readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tc_predivision"> @lang('Division')</label>
                                    <input type="text" class="form-control" id="tc_predivision" name="tc_predivision"
                                           readonly>
                                </div>
                                <div class="clearfix" style="clear: both;"></div>
                                <div class="col-md-4">
                                    <h4>@lang('Permanent Address'): </h4>
                                </div>
                                <div class="clearfix" style="clear: both;"></div>
                                <div class="form-group col-md-4">
                                    <label for="tc_postvillage"> @lang('Village')</label>
                                    <input type="text" class="form-control" id="tc_postvillage" name="tc_postvillage"
                                           readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tc_postpost"> @lang('Post Office')</label>
                                    <input type="text" class="form-control" id="tc_postpost" name="tc_postpost"
                                           readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tc_postpostcode"> @lang('Post Code')</label>
                                    <input type="text" class="form-control" id="tc_postpostcode" name="tc_postpostcode"
                                           readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tc_postthana"> @lang('Thana')</label>
                                    <input type="text" class="form-control" id="tc_postthana" name="tc_postthana"
                                           readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tc_postdistrict"> @lang('District')</label>
                                    <input type="text" class="form-control" id="tc_postdistrict" name="tc_postdistrict"
                                           readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tc_postdivision"> @lang('Division')</label>
                                    <input type="text" class="form-control" id="tc_postdivision" name="tc_postdivision"
                                           readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <button type="submit" id="admitButton " class=" allButton {{btnClass()}}">
                                        @lang('Submit')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            function getStudentInfo(value) {
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: "{{url('/getStudentsInfo')}}",
                    async: false,
                    data: {student_id: value},
                    success: function (data) {
                        const student = data['student'];
                        document.getElementById('tc_admissionid').value = student['student_code'];
                        document.getElementById('studentname').value = student['name'];
                        document.getElementById('tc_fname').value = student['father_name'];
                        document.getElementById('tc_dob').value = student['birthday'];
                        document.getElementById('tc_mname').value = student['mother_name'];
                        document.getElementById('tc_previllage').value = student['present_address'];
                        document.getElementById('tc_prepost').value = student['present_post_office'];
                        document.getElementById('tc_prepostcode').value = student['present_postcode'];
                        document.getElementById('tc_prethana').value = student['present_thana'];
                        document.getElementById('tc_predistrict').value = student['present_district'];
                        document.getElementById('tc_predivision').value = student['present_division'];
                        document.getElementById('tc_postvillage').value = student['permanent_address'];
                        document.getElementById('tc_postpost').value = student['permanent_post_office'];
                        document.getElementById('tc_postpostcode').value = student['permanent_postcode'];
                        document.getElementById('tc_postthana').value = student['permanent_thana'];
                        document.getElementById('tc_postdistrict').value = student['permanent_district'];
                        document.getElementById('tc_postdivision').value = student['permanent_division'];
                        document.getElementById('tc_fname').value = student['father_name'];
                       // console.log(student);
                    }, error: function (xhr, textStatus, thrownError) {
                        console.log("Something error!!!!")
                    },
                })
            }

            $(function () {
                
                $('#tc_firstadmission').datepicker({
                    format: "dd-mm-yyyy",
                    viewMode: "days",
                    minViewMode: "days",
                    autoclose: true,
                });
                $('#date_lastclass').datepicker({
                    format: "dd-mm-yyyy",
                    viewMode: "days",
                    minViewMode: "days",
                    autoclose: true,
                });
                $('#date').datepicker({
                    format: "dd-mm-yyyy",
                    viewMode: "days",
                    minViewMode: "days",
                    autoclose: true,
                });
            })
        </script>
    @endpush
@endsection