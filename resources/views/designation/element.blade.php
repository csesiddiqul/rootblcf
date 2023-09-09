<div class="form-group">
    {!! Form::label('name', trans('Designation Name'), ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control','required','placeholder'=>trans('Designation Name')]) !!}
    @error ('name')
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