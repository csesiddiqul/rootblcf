<style>
    .rollClass {
        border: none;
        cursor: auto
    }

    .rollClass:focus {
        border: none;
        background: #f9f9f9 !important
    }
</style>
<div class="clearfix"></div>
<div class="table-responsive">
    <form action="{{route('academic.admission.enrollPost',$preadmissionID)}}" autocomplete="off" method="post"
          id="enrollForm">
        {{ csrf_field() }}
        <input type="hidden" name="section_id" value="{{$section_id}}">

        @php $markIsTrue=false; @endphp
        @foreach ($students as $key=>$student)
            @if($student->mark)
                @php $markIsTrue=true; @endphp
                @break
            @endif
        @endforeach
        <table class="table table-bordered table-condensed table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('Admission Roll')</th>
                <th scope="col">@lang('Name')</th>
                <th scope="col">@lang('Father Name')</th>
                @if($markIsTrue)
                    <th scope="col">@lang('Marks')</th>
                @endif
                <th scope="col">@lang('To Session')</th>
                <th scope="col">@lang('To Section')</th>
                <th scope="col">@lang('To') @lang(subjectOrCourseName()) @lang('Group')</th>
                <th scope="col">@lang('Class Roll')</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($students as $key=>$student)
                <tr>
                    <th scope="row">{{ ($loop->index + 1) }}</th>
                    <td><input name="add_roll[]" hidden type="number" value="{{$student->roll}}">{{$student->roll}}</td>
                    <td>
                        <small><a target="_blank"
                                  href="{{route('academic.admission.show',$student->id)}}">{{$student->name}}</a></small>
                    </td>
                    <td>
                        <small>{{$student->father_name}}</small>
                    </td>
                    @if($markIsTrue)
                        <td>{{$student->mark}}</td>
                    @endif
                    <td>
                        {!! Form::select('to_session[]', schoolSession('1',true) , null , ['class' => 'form-control sessionChange','id' => 'to_session_'.$loop->index,'data-id' => $loop->index]) !!}
                    </td>
                    <td width="20%">
                        <select id="to_section_{{$loop->index}}" class="form-control  sectionChange" name="to_section[]"
                                data-id="{{$loop->index}}">
                            <option selected="selected" value="">@lang('Choose')</option>
                            @foreach($classes as $class)
                                @foreach($class->sections as $section)
                                    @if (strtolower(trim($section->section_number)) != 'admission')
                                        <option value="{{$section->id}}">
                                            @lang('Class'): {{$class->name}} -
                                            @lang('Section'): {{$section->section_number}}
                                        </option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </td>
                    <td>
                        {!! Form::select('coursegroup_id[]', schoolCourseGroup(1, true), null, ['class' => 'form-control courseChange','placeholder'=>transMsg('Choose'),'id' => 'coursegroup_id_'.$loop->index,'data-id' => $loop->index]) !!}
                    </td>
                    <td width="8%">
                        {!! Form::number('class_roll[]', $student->merit, ['class' => 'form-control','min'=>0]) !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div style="text-align:center;" class="col-md-offset-5 col-md-2">
            <input type="submit" class="{{btnClass()}}" value="@lang('Enroll Now')">
        </div>
    </form>
</div>

<script>
    $(".sessionChange,.sectionChange,.courseChange").change(function () {
        let value = $(this).val(), id = $(this).attr('data-id');
        setRequired(id, value);
    })

    function setRequired(id, required) {
        const session = $("#to_session_" + id), section = $("#to_section_" + id),
            course_group = $("#coursegroup_id_" + id);
        if (required) {
            required = true;
        } else {
            session.val('');
            section.val('');
            course_group.val('');
            required = false;
        }
        session.attr('required', required);
        section.attr('required', required);
        course_group.attr('required', required);
    }
</script>
<style>
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