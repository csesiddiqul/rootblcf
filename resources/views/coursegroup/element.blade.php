<div class="col-md-5 pl-0">
    <div class="form-group">
        <label for="name" class="control-label">@lang('Name')</label>
        {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
        @error ('name')
        <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="description" class="control-label">@lang('Description')</label>
        {!! Form::textarea('description', null , ['class' => 'form-control','rows'=>3]) !!}
        @error ('description')
        <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="status" class="control-label">@lang('Status')</label>
        {!! Form::select('status', status() , null , ['class' => 'form-control','required']) !!}
        @error ('status')
        <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    @if (useragentMobile() == false)
        <div class="col-md-4 pl-0">
            <button type="submit" class="{{btnClass()}}">
                @isset($coursegroup)
                    @lang('Update')
                @else
                    @lang('Submit')
                @endisset
            </button>
        </div>
        <div class="col-md-4 text-center pl-0">
            <a href="{{route('academic.coursegroup.index')}}" class="{{btnClass()}}">@lang('Cancel')</a>
        </div>
    @endif
</div>
@php $cName = school('country')->code == 'BD' ? 'Subjects' : 'Courses'; @endphp
<div class="col-md-5 col-md-offset-1">
    <div class="form-group">
        <label for="course" class="control-label">@lang($cName)</label>
        @if ($courses->count())
            <table class="table table-responsive">
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>
                            @php
                                $courseCheck = isset($coursegroup->course) ? (in_array($course->id, explode(',', $coursegroup->course)) ? true : false) : false;
                            @endphp
                            <div class="checkbox">
                                <label>
                                    <input {{$courseCheck ? 'checked' : ''}} name="course[]"
                                           type="checkbox" onclick="courseType(this)" data-id="{{$course->id}}"
                                           value="{{$course->id}}">
                                    {{transMsg($course->name)}}
                                </label>
                            </div>
                        </td>
                        <td>
                            @if ($course->type == 2)
                                @php
                                    $courseTypeCheck = isset($coursegroup->optional) ? (in_array($course->id, explode(',', $coursegroup->optional)) ? true : false) : false;
                                @endphp
                                <div class="checkbox {{$courseTypeCheck && $courseCheck ? '' : 'd-none'}}"
                                     id="courseCheckType{{$course->id}}">
                                    <label>
                                        <input {{$courseTypeCheck && $courseCheck ? 'checked' : ''}} name="optional[]"
                                               type="checkbox" id="courseAddT{{$course->id}}" value="{{$course->id}}">
                                        @lang('Optional')
                                    </label>
                                </div>
                            @endif
                            @if ($course->type == 3)
                                @php
                                    $courseConCheck = isset($coursegroup->countiAss) ? (in_array($course->id, explode(',', $coursegroup->countiAss)) ? true : false) : false;
                                @endphp
                                <div class="checkbox {{$courseConCheck && $courseCheck ? '' : 'd-none'}}"
                                     id="courseContinuous{{$course->id}}">
                                    <label>
                                        <input {{$courseConCheck && $courseCheck ? 'checked' : ''}} name="countiAss[]"
                                               type="checkbox" id="courseContiAddT{{$course->id}}"
                                               value="{{$course->id}}">
                                        @lang('Continuous Assessment')
                                    </label>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="clearhight15"></div>
            <code><i><b>@lang('Note'):</b> @lang('There is no '.$cName). <a
                            style="text-decoration: underline"
                            href="{{route('academic.course.create')}}"
                            target="_blank"> @lang('First create an '.$cName)</a></i></code>
        @endif
        @error ('course')
        <span class="help-block">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
@if (useragentMobile())
    <div class="">
        <button type="submit" class="{{btnClass()}}">
            @isset($coursegroup)
                @lang('Update')
            @else
                @lang('Submit')
            @endisset
        </button>
    </div>
    <div style="margin-top: 10px;">
        <a href="{{route('academic.coursegroup.index')}}" class="{{btnClass()}}">@lang('Cancel')</a>
    </div>
@endif
@push('script')
    <script>
        $(function () {
            $('.select2').select2();
        });

        function courseType(element) {
            var id = $(element).data('id');
            if ($(element).is(":checked")) {
                $("#courseCheckType" + id).removeClass('d-none');
                $("#courseContinuous" + id).removeClass('d-none');
            } else {
                $("#courseCheckType" + id).addClass('d-none');
                $("#courseContinuous" + id).addClass('d-none');
                $("#courseAddT" + id).attr('checked', false);
                $("#courseContiAddT" + id).attr('checked', false);
            }
        }
    </script>
@endpush
@push('styles')
    <style>
        .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
            padding: 0px
        }
    </style>
@endpush