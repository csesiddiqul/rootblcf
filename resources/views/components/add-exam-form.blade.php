<div class="col-md-6 pl-0">
    <form action="{{route('exams.store')}}" method="post" autocomplete="off">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('term') ? ' has-error' : '' }}">
            <label for="term" class="control-label">@lang('Terms')</label>
            <select id="term" class="form-control" name="term">
                <option value="1">@lang('1st Term')</option>
                <option value="2">@lang('2nd Term')</option>
                <option value="3">@lang('3rd Term')</option>
            </select>
            @if ($errors->has('term'))
                <span class="help-block">
                    <strong>{{ $errors->first('term') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('exam_name') ? ' has-error' : '' }}">
            <label for="exam_name" class="control-label">@lang('Examination Name')</label>
            <input id="exam_name" type="text" class="form-control" name="exam_name" value="{{ old('exam_name') }}"
                   placeholder="@lang('Semester 1 Exam 2018, Final Exam 2019, ...')" required>

            @if ($errors->has('exam_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('exam_name') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group {{ $errors->has('start_date') ? ' has-error' : '' }} col-md-6 pl-0 mr-0">
            <label for="start_date" class="control-label">@lang('Start Date')</label>
            <input id="start_date" type="text" class="form-control datepicker" name="start_date" value="{{ old('start_date') }}"
                   placeholder="DD-MM-YYYY" required>

            @if ($errors->has('start_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('start_date') }}</strong>
                </span>
            @endif
        </div>
        <div class="{{ $errors->has('end_date') ? ' has-error' : '' }} col-md-6 pr-0">
            <label for="end_date" class="control-label">@lang('End Date')</label>
            <input id="end_date" type="text" class="form-control datepicker" name="end_date" value="{{ old('end_date') }}"
                   placeholder="DD-MM-YYYY" required>
            @if ($errors->has('end_date'))
                <span class="help-block">
                    <strong>{{ $errors->first('end_date') }}</strong>
                </span>
            @endif
        </div>
        <div class="clearfix"></div>
        <div class="form-group{{ $errors->has('classes') ? ' has-error' : '' }}">
            <label for="classes" class="control-label">@lang('For Class')</label>
            @foreach ($classes as $class)
                @if(in_array($class->id, $assigned_classes->pluck('class_id')->toArray()))
                    <div class="checkbox">
                        {{$class->name}} @lang('already assigned to Exam') <b>
                            @foreach($assigned_classes as $assigned_class)
                                @if($assigned_class->class_id == $class->id)
                                    {{$assigned_class->exam_name}}
                                    @break
                                @endif
                            @endforeach
                        </b>
                    </div>
                @else
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="classes[]" value="{{$class->id}}"> {{$class->name}}
                        </label>
                    </div>
                @endif
            @endforeach
            @if ($errors->has('classes'))
                <span class="help-block">
                    <strong>{{ $errors->first('classes') }}</strong>
                </span>
            @endif
        </div>
        <div class="col-md-4 pl-0">
            <a href="javascript:history.back()" class="{{btnClass()}}" style="margin-right: 2%;"
               role="button">@lang('Cancel')</a></div>
        <div class="col-md-4">
            <button type="submit" class="{{btnClass()}} col-md-4">@lang('Save')</button>
        </div>
    </form>
</div>
@push('script')
<script>
    $(function () {
        $('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            viewMode: "days",
            minViewMode: "days",
            autoclose: true
        });
    });
</script>
@endpush