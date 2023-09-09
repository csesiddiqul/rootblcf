<div class="form-group{{ $errors->has('schoolyear') ? 'has-error' : '' }}">
    <label for="schoolyear">@lang('Session') *</label>
    {!! Form::text('schoolyear', NULL, array('id' => 'schoolyear','required', 'class' => 'form-control','autocomplete'=>'off')) !!}
    @if ($errors->has('schoolyear'))
        <span class="help-block">
            <strong>{{ $errors->first('schoolyear') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('starttime') ? ' has-error' : '' }}">
    <label for="starttime">@lang('Start time') *</label>
    {!! Form::text('starttime', NULL, array('id' => 'starttime',  'class' => 'form-control','autocomplete'=>'off')) !!}
    @if ($errors->has('starttime'))
        <span class="help-block">
            <strong>{{ $errors->first('starttime') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('endtime') ? ' has-error' : '' }}">
    <label for="endtime">@lang('End time') *</label>
    {!! Form::text('endtime', NULL, array('id' => 'endtime',  'class' => 'form-control', 'autocomplete'=>'off')) !!}
    @if ($errors->has('endtime'))
        <span class="help-block">
            <strong>{{ $errors->first('endtime') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
    <label for="status">@lang('Status') *</label>
    {!! Form::select('status',status(), old('status'), array('id' => 'status', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
    @if ($errors->has('status'))
        <span class="help-block">
            <strong>{{ $errors->first('status') }}</strong>
        </span>
    @endif
</div>
@push('script')
    <script>
        $(function () {
            $('#starttime').datepicker({
                format: "dd-mm-yyyy",
                viewMode: "days",
                minViewMode: "days",
                autoclose: true,
            });
            $('#endtime').datepicker({
                format: "dd-mm-yyyy",
                viewMode: "days",
                minViewMode: "days",
                autoclose: true,
            });
        });
    </script>
@endpush
