<div class="form-group">
    {!! Form::label('notice_id', trans('Notice'), ['class' => 'control-label']) !!}
    {!! Form::select('notice_id', $notice , null , ['class' => 'form-control select2','placeholder'=>'Choose']) !!}
    @error ('notice_id')
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group">
    {!! Form::label('title', trans('Title'), ['class' => 'control-label']) !!}
    {!! Form::text('title', null, ['class' => 'form-control','placeholder'=>trans('Title'),'required']) !!}
    @error ('title')
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>priority
    @enderror
</div>
<div class="form-group">
    {!! Form::label('priority', trans('Priority'), ['class' => 'control-label']) !!}
    {!! Form::number('priority', null, ['class' => 'form-control','placeholder'=>trans('Priority'),'required']) !!}
    @error ('priority')
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
@push('script')
    <script>
        $("#notice_id").change(function () {
            $("#title").val($('#notice_id option:selected').text());
        })
    </script>
@endpush