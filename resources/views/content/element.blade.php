<div class="col-md-4 ">
    <div class="form-group{{ $errors->has('menu_id') ? ' has-error' : '' }}">
        <label for="menu_id">@lang('Menu') *</label>
        {!! Form::select('menu_id',$menu, old('menu_id'), array('id' => 'menu_id', 'required', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
        @if ($errors->has('menu_id'))
            <span class="help-block">
                <strong>{{ $errors->first('menu_id') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="col-md-4" style="padding-right: 0;">
    <div class="{{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="title">@lang('Title') *</label>
        {!! Form::text('title', NULL, array('id' => 'title','required', 'class' => 'form-control', 'placeholder' => trans('Title'))) !!}
        @if ($errors->has('title'))
            <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
            </span>
        @endif
    </div>
</div>
<div class="col-md-4 " style="padding-right: 0;">
    <div class="image-upload">
        <label>
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
    @if ($errors->has('url'))
        <span class="help-block">
                <strong>{{ $errors->first('url') }}</strong>
            </span>
    @endif
</div>

<div class="col-md-12">
    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="name">@lang('Description') *</label>
        {!! Form::textarea('description', NULL, array('id' => 'description', 'required', 'class' => 'form-control ckeditor ', 'placeholder' => trans('Description'))) !!}
        @if ($errors->has('description'))
            <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="clearhight"></div>
@push('script')
    @if(isset($content->menu))
        @if ($content->menu->slug == 'chairman-message' || $content->menu->slug == 'headteacher-message')
            @component('components.cropper.element',['width'=>'600','height'=>'350','type'=>'square']) @endcomponent
        @else
            @component('components.cropper.element',['width'=>'640','height'=>'272','type'=>'square']) @endcomponent
        @endif
    @else
        @component('components.cropper.element',['width'=>'640','height'=>'272','type'=>'square']) @endcomponent
    @endif
    <script>
        $(document).ready(function () {
            $("#imageFrame .modal-dialog").addClass('modal-lg');
        })
    </script>
    <style>
        #resizer .cr-boundary {
            height: 400px !important;
        }
    </style>
@endpush