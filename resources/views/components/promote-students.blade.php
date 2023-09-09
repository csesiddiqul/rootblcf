<div class="clearfix"></div>
<div class="table-responsive">
    <form action="{{url('school/promote-students')}}" id="promotionForm" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="section_id" value="{{$section_id}}">
        <div>
            <table class="table table-bordered table-condensed table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">@lang('Code')</th>
                    <th scope="col">@lang('Name')</th>
                    <th scope="col">@lang('From Roll')</th>
                    <th scope="col">@lang('Action')</th>
                    <th scope="col">@lang('From Session')</th>
                    <th scope="col">@lang('From Section')</th>
                    <th scope="col">@lang('To Session')</th>
                    <th scope="col">@lang('To Section')</th>
                    <th scope="col">@lang('To') @lang(subjectOrCourseName()) @lang('Group')</th>
                    <th scope="col">@lang('To Roll')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($students as $key=>$student)
                    <tr>
                        <th scope="row">{{ ($loop->index + 1) }}</th>
                        <td><small>{{$student->student_code}}</small></td>
                        <td>
                            <small><a href="{{url('student/'.$student->student_code)}}">{{$student->name}}</a></small>
                        </td>
                        <td>
                            <small>{{$student->class_roll}}</small>
                        </td>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="left_school{{$loop->index}}"> @lang('Left')
                                </label>

                            </div>
                        </td>
                        <td>
                            <small>
                                {{getSessionById($student->session,'schoolyear')}}
                                @if(getSessionById($student->session,'schoolyear') == currentSession()->schoolyear)
                                    <span class="label label-success">@lang('Promoted/New')</span>
                                @else
                                    <span class="label label-danger">@lang('Not Promoted')</span>
                                @endif
                            </small>
                        </td>
                        <td style="text-align: center;">
                            <small>{{$student->section->class->name}} -
                                {{$student->section->section_number}}</small>
                        </td>
                        <td width="10%">

                            {!! Form::select('to_session[]', schoolSession(false,true) , $student->session , ['class' => 'form-control sessionChange','id' => 'to_session_'.$loop->index,'data-id' => $loop->index,'placeholder'=>transMsg('Choose')]) !!}
                        </td>
                        <td width="18%">
                            <select id="to_section{{$loop->index}}" class="form-control select2" name="to_section[]"
                                    required>
                                <option value="" selected>@lang('Choose')</option>
                                @foreach($classes as $class)
                                    @foreach($class->sections as $section)
                                        @if(strtolower($section->section_number) != 'admission')
                                            <option value="{{$section->id}}" {{$section_id == $section->id ? 'selected':''}}>
                                                {{$class->name}} -
                                                {{$section->section_number}}
                                            </option>

{{--                                            <option selected value="{{$section_id}}">--}}
{{--                                                {{$student->section->class->name}} ---}}
{{--                                                {{$student->section->section_number}}--}}
{{--                                            </option>--}}
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                        </td>
                        <td>
                            {!! Form::select('coursegroup_id[]', schoolCourseGroup(1, true),$student->coursegroup_id, ['class' => 'form-control courseChange','placeholder'=>transMsg('Choose'),'id' => 'coursegroup_id_'.$loop->index,'data-id' => $loop->index]) !!}
                        </td>
                        <td width="7%">
                            {!! Form::number('class_roll[]', null, ['class' => 'form-control','min'=>0]) !!}
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
        <div style="text-align:center;" class="col-md-offset-5 col-md-2">
            <button type="button" class="{{btnClass()}}" onclick="confirmSubmit()">@lang('Submit')</button>
        </div>
    </form>
</div>

<script>



    $(function () {
        $('.datepicker').datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years"
        });

        $('.select2').select2();
    })

    function confirmSubmit() {
        Swal.fire({
            title: "Confirmation!",
            text: "Are you sure you want to Promotion",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Confirm!'
        }).then((result) => {
            if (result.value) {
                $('#promotionForm').submit();
            }
        })
    }
</script>
<style>
    .select2 {
        width: 100% !important;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>