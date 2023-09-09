<div class="panel-heading">
    <a id="topback" href="#">@lang('Manage Schools')</a>
</div>
<div class="btn-group new_b agent-menus" style="overflow: hidden;">
    <a href="{{ route('schools.index') }}"
       class="btn {{(\Route::current()->getName() == 'schools.index')? 'active':''}}">@lang('Schools List')</a>
    <a data-toggle="modal" data-target="#schoolModal" dusk="create-school-button"
       class="btn btn-agent">+ @lang('Create School')</a>
</div>
<!-- Modal -->
<div class="modal fade" id="schoolModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form class="form-horizontal" autocomplete="off" method="POST" action="{{ route('schools.store') }}">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">@lang('Create School')</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('school_name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-3 control-label">@lang('Name')</label>
                        <div class="col-md-9">
                            {!! Form::text('name', null , ['id'=>'name','class' => 'form-control','placeholder'=>'School Name','required']) !!}
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('medium') ? ' has-error' : '' }}">
                        <label for="medium" class="col-md-3 control-label">@lang('Medium')</label>
                        <div class="col-md-9">
                            {!! Form::select('medium', pluckVersion() , null , ['id'=>'medium','class' => 'form-control','placeholder'=>'Choose']) !!}
                            @if ($errors->has('medium'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('medium') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('established') ? ' has-error' : '' }}">
                        <label for="established" class="col-md-3 control-label">@lang('Established')</label>
                        <div class="col-md-9">
                            {!! Form::text('name', null , ['id'=>'established','class' => 'form-control','placeholder'=>'School Established','required']) !!}
                            @if ($errors->has('established'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('established') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
                        {!! Form::label('country_id', trans('Country'), ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::select('country_id',$country, old('country_id'), array('class' => 'form-control w-100','id'=>'country_id', 'placeholder' => trans('Choose'),'required')) !!}
                            @error('country_id'))
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                        <label for="about" class="col-md-3 control-label">@lang('About')</label>
                        <div class="col-md-9">
                            {!! Form::textarea('about', null , ['rows'=>3,'id'=>'about','class' => 'form-control','placeholder'=>'About School','required']) !!}
                            @if ($errors->has('about'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('about') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-danger btn-sm btn-block"
                                data-dismiss="modal">@lang('Close')</button>
                    </div>
                    <div class="col-md-4 pull-right">
                        <button type="submit" class="btn btn-primary btn-sm btn-block">@lang('Save changes')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@push('script')
    <style>
        .select2-container {
            width: 100% !important;
            padding: 0;
        }
    </style>
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
        @if ($errors->any())
        $("#schoolModal").modal("show");
        @endif
    </script>
@endpush
