@php
    $school = \Auth::user()->school;
    $courseTN = school('country')->code == 'BD' ? 'Subject' : 'Course';
@endphp
<div class="form-group">
    {!! Form::label('name', trans($courseTN.' Name'), ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control','required','placeholder'=>trans($courseTN.' Name')]) !!}
    @error ('name')
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('code', trans($courseTN.' Code'), ['class' => 'control-label']) !!}
    {!! Form::text('code', null, ['class' => 'form-control','required','placeholder'=>trans($courseTN.' Code')]) !!}
    @error ('code')
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
{{-- <div class="form-group">
     <label for="class_id"
            class="control-label">@lang('For '.(school('country')->code == 'BD' ? 'Class' : 'Grade'))
     </label> <label for="for_all" class="pull-right"><input type="checkbox"
                                                             name="for_all" id="for_all"> @lang('All Classes')</label>
     {!! Form::select('class_id',$classes, old('class_id'), array('id' => 'class_id', 'class' => 'select2 form-control', 'multiple')) !!}
     @error ('class_id')
     <span class="help-block">
         <strong>{{ $message }}</strong>
     </span>
     @enderror
 </div>--}}
{{--<div class="form-group">
    <label for="teacherDepartment"
           class="control-label">@lang('Teacher Department')</label>
    <select class="form-control" id="teacherDepartment" name="teacher_department">
        <option value="0" selected disabled>@lang('Select Department')</option>
        @if(count($departments) > 0)
            @php
                $departments_of_this_school = $departments->filter(function ($department) use ($school){
                  return $department->school_id == $school->id;
                });
            @endphp
            @foreach ($departments_of_this_school as $d)
                <option value="{{$d->department_name}}">{{$d->department_name}}</option>
            @endforeach
        @endif
    </select>
</div>--}}
{{-- <div class="form-group">
     <label for="teacher_id"
            class="control-label">@lang('Assign '.$courseTN.' Teacher')</label>
     {!! Form::select('teacher_id',$teachers, old('teacher_id'), array('id' => 'teacher_id', 'required','class' => 'select2 form-control','placeholder'=>'Choose')) !!}
 </div>
 --}}
<div class="form-group">
    {!! Form::label('type', trans($courseTN.' Type'), ['class' => 'control-label']) !!}
    {!! Form::select('type', courseType() , null , ['class' => 'form-control','required']) !!}
    @error ('type')
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('status', trans($courseTN.' Status'), ['class' => 'control-label']) !!}
    {!! Form::select('status', status() , null , ['class' => 'form-control','required']) !!}
    @error ('status')
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
@push('script')
    <script>
        $(function () {
            $('.select2').select2();
        });
    </script>
@endpush