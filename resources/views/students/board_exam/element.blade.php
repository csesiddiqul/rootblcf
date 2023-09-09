<div class="form-group{{ $errors->has('section') ? ' has-error' : '' }} col-md-4">
    {!! Form::label('section', trans('Section'), ['class' => 'control-label']) !!}
    {!! Form::select('section',$section, $studentBoardExam->student->section_id ?? null, array(('required'), 'class' => 'select2 form-control','onchange'=>'getStudentsBySection(this.value,0,1)', 'placeholder' => trans('Choose'))) !!}
    @error('section')
    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group{{ $errors->has('student_id') ? ' has-error' : '' }} col-md-4">
    {!! Form::label('student_id', trans('Student'), ['class' => 'control-label']) !!}
    {!! Form::select('student_id',$student ?? array(), null, array('id'=>'student','required', 'class' => 'select2 form-control')) !!}
    @error('student_id')
    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group{{ $errors->has('exam_name') ? '  has-error' : '' }} col-md-4">
    {!! Form::label('exam_name', trans('Exam Name'), ['class' => 'control-label']) !!}
    {!! Form::text('exam_name', NULL, array('required', 'class' => 'form-control')) !!}
    @error('exam_name')
    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group{{ $errors->has('group') ? '  has-error' : '' }} col-md-4">
    {!! Form::label('group', trans('Group'), ['class' => 'control-label']) !!}
    {!! Form::text('group', NULL, array('required', 'class' => 'form-control','placeholder'=>'N/A')) !!}
    @error('group')
    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group{{ $errors->has('roll') ? '  has-error' : '' }} col-md-4">
    {!! Form::label('roll', trans('Roll'), ['class' => 'control-label']) !!}
    {!! Form::number('roll', NULL, array('required', 'class' => 'form-control')) !!}
    @error('roll')
    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group{{ $errors->has('registration') ? '  has-error' : '' }} col-md-4">
    {!! Form::label('registration', trans('Registration'), ['class' => 'control-label']) !!}
    {!! Form::number('registration', NULL, array('required', 'class' => 'form-control')) !!}
    @error('registration')
    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group{{ $errors->has('session') ? '  has-error' : '' }} col-md-4">
    {!! Form::label('session', trans('Session'), ['class' => 'control-label']) !!}
    {!! Form::text('session', NULL, array('required', 'class' => 'form-control')) !!}
    @error('session')
    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group{{ $errors->has('board') ? '  has-error' : '' }} col-md-4">
    {!! Form::label('board', trans('Board'), ['class' => 'control-label']) !!}
    {!! Form::text('board', NULL, array('required', 'class' => 'form-control')) !!}
    @error('board')
    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group{{ $errors->has('passing_year') ? '  has-error' : '' }} col-md-4">
    {!! Form::label('passing_year', trans('Passing Year'), ['class' => 'control-label']) !!}
    {!! Form::text('passing_year', NULL, array('required', 'class' => 'form-control')) !!}
    @error('passing_year')
    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group{{ $errors->has('gpa') ? '  has-error' : '' }} col-md-4">
    {!! Form::label('gpa', trans('GPA'), ['class' => 'control-label']) !!}
    {!! Form::number('gpa', NULL, array('required', 'class' => 'form-control','step'=>'0.01')) !!}
    @error('gpa')
    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group{{ $errors->has('out_of_gpa') ? '  has-error' : '' }} col-md-4">
    {!! Form::label('out_of_gpa', trans('Out of GPA'), ['class' => 'control-label']) !!}
    {!! Form::number('out_of_gpa', NULL, array('required', 'class' => 'form-control','step'=>'0.01')) !!}
    @error('out_of_gpa')
    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group{{ $errors->has('institution_name') ? '  has-error' : '' }} col-md-4">
    {!! Form::label('institution_name', trans('Center Name'), ['class' => 'control-label']) !!}
    {!! Form::text('institution_name', NULL, array('required', 'class' => 'form-control')) !!}
    @error('institution_name')
    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>