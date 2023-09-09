<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    {!! Form::label('name', trans('Name'), ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
    @error('name'))
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
@isset($school->short_name)
<div class="form-group {{ $errors->has('short_name') ? 'has-error' : '' }}">
    {!! Form::label('short_name', trans('Short Name'), ['class' => 'control-label']) !!}
    {!! Form::text('short_name', null, ['class' => 'form-control']) !!}
    @error('short_name'))
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
@endisset
<div class="form-group {{ $errors->has('medium') ? 'has-error' : '' }}">
    {!! Form::label('medium', trans('Medium'), ['class' => 'control-label']) !!}
    {!! Form::select('medium', pluckVersion() , null , ['class' => 'form-control','required']) !!}
    @error('medium'))
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group {{ $errors->has('established') ? 'has-error' : '' }}">
    {!! Form::label('established', trans('Established'), ['class' => 'control-label']) !!}
    {!! Form::text('established', null, ['class' => 'form-control','required']) !!}
    @error('established'))
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group {{ $errors->has('branch_code') ? 'has-error' : '' }}">
    {!! Form::label('branch_code', trans('Code'), ['class' => 'control-label']) !!}
    {!! Form::text('branch_code', null, ['class' => 'form-control','required']) !!}
    @error('branch_code'))
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group {{ $errors->has('about') ? 'has-error' : '' }}">
    {!! Form::label('about', trans('About'), ['class' => 'control-label']) !!}
    {!! Form::textarea('about', null, ['class' => 'form-control','rows'=>3]) !!}
    @error('about'))
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
    {!! Form::label('address', trans('Address'), ['class' => 'control-label']) !!}
    {!! Form::text('address', null, ['class' => 'form-control','required']) !!}
    @error('address'))
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
    {!! Form::label('country_id', trans('Country'), ['class' => 'control-label']) !!}
    {!! Form::select('country_id',$country, old('country_id'), array('class' => 'form-control', 'onchange' => 'getState(this.value)', 'placeholder' => trans('Choose'))) !!}
    @error('country_id'))
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
@if (school('country')->code != 'BD')
<div class="stateForm form-group {{ $errors->has('state_id') ? 'has-error' : '' }}">
    {!! Form::label('state_id', trans('State'), ['class' => 'control-label']) !!}
    {!! Form::select('state_id',array(), old('state_id'), array('id' => 'state_id', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
    @error('state_id'))
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
@endif
@isset($school->status)
<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    {!! Form::label('status', trans('Status'), ['class' => 'control-label']) !!}
    {!! Form::select('status', status() , $school->status , ['class' => 'form-control','id' => 'status']) !!}
    @error('status'))
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
@endisset
@push('script')
    <script>
        $(function () {
            $('#established').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true,
            });
            $('#country_id').select2();
        });

        function getState(value) {
            $.post('/getState?value=' + value, function (data) {
                if (data['count'] > 0) {
                    $('#state_id').html(data.state).select2();
                    $(".stateForm").removeClass('d-none').addClass('d-block');
                    $(".stateForm .select2-container").css('width', '100%');
                } else {
                    $(".stateForm").removeClass('d-block').addClass('d-none');
                    $('#state_id').html('').select2();
                }
            })
        }
    </script>
@endpush