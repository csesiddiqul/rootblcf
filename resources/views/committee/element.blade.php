{!! Form::hidden('type', $type, array('id' => 'type','required', 'class' => 'form-control','autocomplete' => 'off')) !!}
<div class="form-group col-md-4">
    <label for="name"> @lang('Name') <code>*</code></label>
    {!! Form::text('name', NULL, array('id' => 'name','required', 'class' => 'form-control','autocomplete' => 'off')) !!}
    @error('name')
    <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
    @enderror
</div>
<div class="form-group col-md-4">
    <label for="priority"> @lang('Priority')</label>
    {!! Form::number('priority', NULL, array('id' => 'priority', 'class' => 'form-control','autocomplete' => 'off')) !!}
</div>
<div class="form-group col-md-4">
    <label for="email"> @lang('Email') <code>*</code></label>
    {!! Form::text('email', NULL, array('id' => 'email', 'required','class' => 'form-control','autocomplete' => 'off')) !!}
    @error('email')
    <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
    @enderror
</div>
<div class="form-group col-md-4">
    <label for="mobile"> @lang('Mobile') <code>*</code></label>
    {!! Form::text('mobile', NULL, array('id' => 'mobile', 'class' => 'form-control','autocomplete' => 'off','required')) !!}
    @error('mobile')
    <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
    @enderror
</div>
<div class="form-group col-md-4">
    <label for="dob"> @lang('Date of Birth')</label>
    {!! Form::text('dob', NULL, array('id' => 'dob', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
</div>
<div class="form-group col-md-4">
    <label for="place_of_birth"> @lang('Place of Birth')</label>
    {!! Form::text('place_of_birth', NULL, array('id' => 'place_of_birth', 'class' => 'form-control','autocomplete' => 'off')) !!}
</div>
<div class="form-group col-md-4">
    <label for="gender"> @lang('Gender')</label>
    {!! Form::select('gender',gender(), old('gender'), array('id' => 'gender', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
</div>
<div class="form-group col-md-4">
    <label for="religon"> @lang('Religion')</label>
    {!! Form::select('religon',religon(), old('religon'), array('id' => 'religon', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
</div>
<div class="form-group col-md-4">
    <label for="bloodgroup"> @lang('Blood Group')</label>
    {!! Form::select('bloodgroup',bloodgroup(), old('bloodgroup'), array('id' => 'bloodgroup', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
</div>
<div class="form-group col-md-4">
    <label for="marritalstatus"> @lang('Marital Status')</label>
    {!! Form::select('marritalstatus',marritalstatus(), old('marritalstatus'), array('id' => 'marritalstatus', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
</div>
<div class="form-group col-md-4">
    <label for="nid"> @lang(school('country')->code == 'SG' ? 'Passport/NRIC No' : 'NID')</label>
    {!! Form::text('nid', NULL, array('id' => 'nid', 'class' => 'form-control','autocomplete' => 'off')) !!}
</div>
<div class="form-group col-md-4">
    <label for="education"> @lang('Education')</label>
    {!! Form::text('education', NULL, array('id' => 'education', 'class' => 'form-control','autocomplete' => 'off')) !!}
</div>
<div class="form-group col-md-4">
    <label for="profession"> @lang('Profession')</label>
    {!! Form::text('profession', NULL, array('id' => 'profession', 'class' => 'form-control','autocomplete' => 'off')) !!}
</div>
<div class="form-group col-md-4">
    <label for="designation"> @lang('Designations')</label>
    {!! Form::select('designation',designation(), old('designation'), array('id' => 'designation', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
</div>
<div class="form-group col-md-4">
    <label for="father_name"> @lang('Father Name')</label>
    {!! Form::text('father_name', NULL, array('id' => 'father_name', 'class' => 'form-control','autocomplete' => 'off')) !!}
</div>
<div class="form-group col-md-4">
    <label for="mother_name"> @lang('Mother Name')</label>
    {!! Form::text('mother_name', NULL, array('id' => 'mother_name', 'class' => 'form-control','autocomplete' => 'off')) !!}
</div>
<div class="form-group col-md-4">
    <label for="address"> @lang(school('country')->code == 'SG' ? 'Mailing address' : 'Address')<code>*</code></label>
    {!! Form::text('address', NULL, array('id' => 'address', 'required','class' => 'form-control','autocomplete' => 'off')) !!}
    @error('address')
    <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
    @enderror
</div>
<div class="form-group col-md-4">
    <label for="address"> @lang('Office Address')</label>
    {!! Form::text('office_address', NULL, array('id' => 'office_address','class' => 'form-control','autocomplete' => 'off')) !!}
</div>
<div class="form-group col-md-4">
    <label for="startdate"> @lang('Start date')</label>
    {!! Form::text('startdate', NULL, array('id' => 'startdate', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
</div>
<div class="form-group col-md-4">
    <label for="enddate"> @lang('End date')</label>
    {!! Form::text('enddate', NULL, array('id' => 'enddate', 'class' => 'form-control datepicker','autocomplete' => 'off')) !!}
</div>
<div class="form-group col-md-4">
    <label for="status"> @lang('Status')</label>
    {!! Form::select('status',status(), old('status'), array('id' => 'status', 'class' => 'form-control')) !!}
</div>
<div class="form-group col-md-4">
    <label for="nationality"> @lang('Nationality') <code>*</code></label>
    {!! Form::select('nationality',nationalityPluck(), old('nationality'), array('id' => 'nationality','required',  'class' => 'select2 form-control','required', 'placeholder' => trans('Choose'))) !!}
    @error('nationality')
    <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
    @enderror
</div>
<div class="col-md-4 form-group">
    <div class="image-upload">
        <label class="control-label upperlabel">
            @lang('Upload Profile Picture')
            <span id="deliMG" onclick="cancelUploadImg('unnamed2');" style="display: none;"
                  class="myspanRemove">@lang('Remove')</span>
        </label>
        <label class="btn btn-success btn-sm btn-block uploded-text"
               for="file-upload">@lang('Choose Picture')</label>
        <input type="file" value="" class="file-upload form-control" id="file-upload"
               accept="image/*">
    </div>
    <div style="clear:both;"></div>
    <div id="uploaded_image_url"></div>
</div>
<div class="clearhight"></div>