<div class="form-group col-md-4">
    <label for="title"> @lang('Title')</label>
    {!! Form::text('title', NULL, array('id' => 'title', 'class' => 'form-control','autocomplete' => 'off')) !!}
</div>
<div class="form-group col-md-4">
    <label for="link"> @lang('Link')</label>
    {!! Form::text('link', NULL, array('id' => 'link', 'class' => 'form-control','autocomplete' => 'off')) !!}
</div>
<div class="form-group col-md-4">
    <label for="shortdrc"> @lang('Short Description')</label>
    {!! Form::text('shortdrc', NULL, array('id' => 'shortdrc', 'class' => 'form-control','autocomplete' => 'off')) !!}

</div>
<div class="clearfix"></div>
<div class="form-group col-md-4">
    <label for="priority"> @lang('Priority')</label>
    {!! Form::number('priority', NULL, array('id' => 'priority', 'class' => 'form-control','autocomplete' => 'off')) !!}
</div>
<div class="form-group col-md-4">
    <label for="status"> @lang('Status')</label>
    {!! Form::select('status',status(), old('status'), array('id' => 'status','required', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
    @error('status')
    <span class="help-block">
                                    <strong>{{ $message }}</strong>
                                </span>
    @enderror
</div>
<div class="col-md-4 form-group">
    <div class="image-upload">
        <label class="control-label upperlabel">
            @lang('Upload Picture')
            <span id="deliMG" onclick="cancelUploadImg('unnamed2');" style="display: none;"
                  class="myspanRemove">@lang('Remove')</span>
        </label>
        <label class="btn btn-success btn-sm btn-block uploded-text" for="file-upload">@lang('Choose Picture')</label>
        <input type="file" value="" class="file-upload form-control" id="file-upload"
               accept="image/*">
    </div>
    <div style="clear:both;"></div>
    <div id="uploaded_image_url"></div>
    @error('url')
    <span class="help-block">
                                    <strong>{{ $message }}</strong>
                                </span>
    @enderror
</div>
<div class="clearhight"></div>
<div class="clearfix"></div>