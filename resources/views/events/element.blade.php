<div class="form-group col-md-4">
    <label for="n_title">@lang('Event Title')</label>
    {!! Form::text('title', NULL, array('id' => 'n_title','required', 'class' => 'form-control', 'placeholder' => trans('Enter Title'))) !!}
    <small class="form-text text-muted"></small>
</div>
@error('title')
<span class="help-block mtm-10">
                                <strong>{{ $message }}</strong>
                            </span>
@enderror
<div class="form-group col-md-4">
    <label for="n_title">@lang('Event Venue')</label>
    {!! Form::text('venue', NULL, array('id' => 'n_title', 'class' => 'form-control', 'placeholder' => trans('Enter Event Venue'))) !!}
    <small class="form-text text-muted"></small>
</div>
@error('venue')
<span class="help-block mtm-10">
                                <strong>{{ $message }}</strong>
                            </span>
@enderror
<div class="form-group  col-md-4">
    <label for="event_date">@lang('Event Date')</label>
    {!! Form::text('event_date', NULL, array('id' => 'event_date', 'class' => 'form-control', 'required')) !!}
</div>

<div class="form-group col-md-4">
    <label for="event_time">@lang('Event Time Start')</label>
    {!! Form::text('event_time', NULL, array('id' => 'event_time', 'class' => 'form-control', 'required')) !!}
</div>
<div class="form-group col-md-4 ">
    <label for="event_timend">@lang('Event Time End')</label>
    {!! Form::text('event_timend', NULL, array('id' => 'event_timend', 'class' => 'form-control', 'required')) !!}
</div>
<div class="col-md-4">
    <div class="image-upload form-group">
        <label class="control-label upperlabel">
            @lang('Upload File')
            <span id="deliMG" onclick="cancelUploadMulti('fileMulti');"
                  style="display: none;"
                  class="myspanRemove">@lang('Remove')</span>
        </label>
        <label class="btn btn-success btn-sm btn-block uploded-text"
               for="multiFileUp">@lang('Choose File')</label>
        <input type="file" name="file" class="file-upload form-control" id="multiFileUp">
    </div>
    @error('file')
    <span class="help-block mtm-10">
                                <strong>{{ $message }}</strong>
                            </span>
    @enderror
</div>
<div class="form-group col-md-12">
    <label for="n_description">@lang('Event Description')</label>
    {!! Form::textarea('description', NULL, array('id' => 'n_description','required','rows'=>5, 'class' => 'form-control rounded-0 ckeditor')) !!}
</div>
@error('description')
<span class="help-block mtm-10">
                                <strong>{{ $message }}</strong>
                            </span>
@enderror