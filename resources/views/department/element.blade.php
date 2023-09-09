<div class="form-group">
    {!! Form::label('department_name', trans('Department Name'), ['class' => 'control-label']) !!}
    {!! Form::text('department_name', null, ['class' => 'form-control','required','placeholder'=>trans('Department Name')]) !!}
    @error ('department_name')
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
    {!! Form::select('status', status() , null , ['class' => 'form-control','required']) !!}
    @error ('status')
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>