@php
    $course = (new App\Course())->getCourse(true, true, 'name');
    $teacher = (new App\User())->getUsersPluck('teacher', true);
    $exam = (new App\Exam())->getExam(true, true);
    $section = (new App\Section())->getSection(true, true, true,'classes.name');
    $gradeSystem = (new App\Gradesystem())->getGradeSysName(true);
@endphp
@isset($assignTeacher)
    {!! Form::model($assignTeacher, ['route' => ['academic.course_config.update',$assignTeacher->id], 'method' => 'PATCH']) !!}
@else
    {!! Form::open(['route' => 'academic.course_config.store', 'method' => 'post']) !!}
@endisset
<div class="form-group{{ $errors->has('course_id') ? ' has-error' : '' }}">
    {!! Form::label('course_id', trans(subjectOrCourseName()), ['class' => 'control-label']) !!}
    {!! Form::select('course_id',$course, null, array('required','class' => 'select2 form-control', 'placeholder' => trans('Choose'))) !!}
    @error('course_id')
    <span class="help-block">
                <strong>{{ $message }}</strong>
            </span>
    @enderror
</div>
<div class="form-group{{ $errors->has('section_id') ? ' has-error' : '' }}">
    {!! Form::label('section_id', trans('Section'), ['class' => 'control-label']) !!}
    {!! Form::select('section_id',$section, null, array('required', 'class' => 'select2 form-control', 'placeholder' => trans('Choose'))) !!}
    @error('section_id')
    <span class="help-block">
                <strong>{{ $message }}</strong>
            </span>
    @enderror
</div>
<div class="form-group{{ $errors->has('teacher_id') ? ' has-error' : '' }}">
    {!! Form::label('teacher_id', trans('Teacher'), ['class' => 'control-label']) !!}
    {!! Form::select('teacher_id',$teacher, null, array('required', 'class' => 'select2 form-control', 'placeholder' => trans('Choose'))) !!}
    @error('teacher_id')
    <span class="help-block">
                <strong>{{ $message }}</strong>
            </span>
    @enderror
</div>
<div class="form-group{{ $errors->has('exam_id') ? ' has-error' : '' }}">
    {!! Form::label('exam_id', trans('Exam'), ['class' => 'control-label']) !!}
    {!! Form::select('exam_id',$exam, null, array('required', 'class' => 'select2 form-control', 'placeholder' => trans('Choose'))) !!}
    @error('exam_id')
    <span class="help-block">
                <strong>{{ $message }}</strong>
            </span>
    @enderror
</div>
<div class="form-group{{ $errors->has('grade_system') ? ' has-error' : '' }}">
    {!! Form::label('grade_system', trans('Grade System'), ['class' => 'control-label']) !!}
    {!! Form::select('grade_system',$gradeSystem,$assignTeacher->grade_system_name ?? null, array('required', 'class' => 'select2 form-control', 'placeholder' => trans('Choose'))) !!}
    @error('exam_id')
    <span class="help-block">
                <strong>{{ $message }}</strong>
            </span>
    @enderror
</div>
<div class="col-md-6 pl-0">
    <button type="submit" id="registerBtn" class="{{btnClass()}}">
        @isset($assignTeacher)
            @lang('Update')
        @else
            @lang('Save')
        @endisset
    </button>
</div>
{!! Form::close() !!}