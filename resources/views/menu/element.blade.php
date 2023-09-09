<div class="form-group col-md-4">
    <label for="parent"> @lang('Parent Menu')</label>
    {!! Form::select('parent',$parent, old('parent'), array('id' => 'parent', 'class' => 'select2 form-control', 'placeholder' => trans('Choose'))) !!}
    @error('parent')
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group col-md-4">
    <label for="name"> @lang('Name')</label>
    {!! Form::text('name', NULL, array('id' => 'name','required', 'class' => 'form-control','autocomplete' => 'off')) !!}
    @error('name')
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group col-md-4">
    <label for="url"> @lang('Page/Dropdown')</label>
    {!! Form::select('url', ['1'=>'Page','2'=>'Dropdown'] , null , ['class' => 'form-control','id' => 'url']) !!}
    @error('url')
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>

<div class="clearfix"></div>
<div class="form-group col-md-4">
    <label for="slug"> @lang('Slug')</label>
    {!! Form::text('slug', NULL, array('id' => 'slug', 'class' => 'form-control','autocomplete' => 'off',(isset($menu->type) ? ($menu->type == 1 ? 'readonly' : '') : ''))) !!}
    @error('slug')
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
<div class="form-group col-md-4">
    <label for="priority"> @lang('Priority')</label>
    {!! Form::number('priority', NULL, array('id' => 'priority', 'class' => 'form-control','autocomplete' => 'off')) !!}
    @error('priority')
    <span class="help-block">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
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
<div class="clearhight"></div>