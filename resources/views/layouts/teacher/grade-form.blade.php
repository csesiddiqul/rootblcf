<div class="clearfix"></div>
<div class="well" style="font-size: 15px;padding:5px">@lang('Choose Field to Display')</div>
<style>
    #grade-labels > .label {
        margin-right: 2%;
    }

    .radio input[type="radio"], .radio-inline input[type="radio"], .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"] {
        position: absolute;
        margin-left: -23px;
        margin-top: 0px;
    }
</style>
<div class="col-md-12" id="grade-labels">
    <label for="attendance_tr" class="label label-danger checkbox-inline">
        <input type="checkbox" id="attendance_tr" name="attendance" value="5"> @lang('Attendance')
    </label>
    <label for="quiz1" class="label label-primary checkbox-inline">
        <input type="checkbox" id="quiz1" name="quiz[]" value="6">@lang('Quiz') 1
    </label>
    <label class="label label-primary checkbox-inline">
        <input type="checkbox" name="quiz[]" value="7"> @lang('Quiz') 2
    </label>
    <label class="label label-primary checkbox-inline">
        <input type="checkbox" name="quiz[]" value="8"> @lang('Quiz') 3
    </label>
    <label class="label label-primary checkbox-inline">
        <input type="checkbox" name="quiz[]" value="9"> @lang('Quiz') 4
    </label>
    <label class="label label-primary checkbox-inline">
        <input type="checkbox" name="quiz[]" value="10"> @lang('Quiz') 5
    </label>
    <label class="label label-success checkbox-inline">
        <input type="checkbox" name="assignment[]" value="11"> @lang('Assignment') 1
    </label>
    <label class="label label-success checkbox-inline">
        <input type="checkbox" name="assignment[]" value="12"> @lang('Assignment') 2
    </label>
    <label class="label label-success checkbox-inline">
        <input type="checkbox" name="assignment[]" value="13"> @lang('Assignment') 3
    </label>
    <label class="label label-info checkbox-inline">
        <input type="checkbox" name="ct[]" value="14"> @lang('Class Test') 1
    </label>
    <label class="label label-info checkbox-inline">
        <input type="checkbox" name="ct[]" value="15"> @lang('Class Test') 2
    </label>
    <label class="label label-info checkbox-inline">
        <input type="checkbox" name="ct[]" value="16"> @lang('Class Test') 3
    </label>
    <label class="label label-info checkbox-inline">
        <input type="checkbox" name="ct[]" value="17"> @lang('Class Test') 4
    </label>
    <label class="label label-info checkbox-inline">
        <input type="checkbox" name="ct[]" value="18"> @lang('Class Test') 5
    </label>
    <label class="label label-default checkbox-inline">
        <input type="checkbox" name="few" value="19" checked>@lang('Final Exam Written')
    </label>
    <label class="label label-default checkbox-inline">
        <input type="checkbox" name="fem" value="20">@lang('Final Exam MCQ')
    </label>
    <label class="label label-warning checkbox-inline">
        <input type="checkbox" name="practical" value="21">@lang('Practical')
    </label>
</div>
<br/>
<br/>
<div class="clearfix"></div>
<form action="{{route('grades.update')}}" method="POST">
    {{csrf_field()}}
    <input type="hidden" name="section_id" value="{{$section_id}}">
    <input type="hidden" name="course_id" value="{{$course_id}}">
    <input type="hidden" name="course_config_id" value="{{$grades[0]->course_config_id}}">
    <input type="hidden" name="exam_id" value="{{$exam_id}}">
    <input type="hidden" name="teacher_id" value="{{$teacher_id}}">
    <div class="table-responsive">
        <table class="table table-condensed table-hover" id="marking-table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('Code')</th>
                <th scope="col">@lang('Name')</th>
                <th scope="col">@lang('Roll')</th>
                <th scope="col">@lang('Attendance')</th>
                <th scope="col">@lang('Quiz') 1</th>
                <th scope="col">@lang('Quiz') 2</th>
                <th scope="col">@lang('Quiz') 3</th>
                <th scope="col">@lang('Quiz') 4</th>
                <th scope="col">@lang('Quiz') 5</th>
                <th scope="col">@lang('Assignment') 1</th>
                <th scope="col">@lang('Assignment') 2</th>
                <th scope="col">@lang('Assignment') 3</th>
                <th scope="col">@lang('CT') 1</th>
                <th scope="col">@lang('CT') 2</th>
                <th scope="col">@lang('CT') 3</th>
                <th scope="col">@lang('CT') 4</th>
                <th scope="col">@lang('CT') 5</th>
                <th scope="col">@lang('Written')</th>
                <th scope="col">@lang('MCQ')</th>
                <th scope="col">@lang('Practical')</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($grades as $grade)
                <input type="hidden" name="grade_ids[]" value="{{$grade->id}}">
                <tr>
                    <td scope="row">{{($loop->index + 1)}}</td>
                    <td>{{$grade->student->student_code}}</td>
                    <td>{{$grade->student->name}}  </td>
                    <td> @isset($grade->student->studentInfo->class_roll) {{$grade->student->studentInfo->class_roll}} @endisset</td>
                    <td>
                        <input type="number" name="attendance[]" class="form-control input-sm"
                               placeholder="@lang('Attendance')" value="{{$grade->attendance}}">
                    </td>
                    <td>
                        <input type="number" name="quiz1[]" class="form-control input-sm"
                               value="{{$grade->quiz1}}"
                               placeholder="@lang('Qz 1')" max="20">
                    </td>
                    <td>
                        <input type="number" name="quiz2[]" class="form-control input-sm" value="{{$grade->quiz2}}"
                               placeholder="@lang('Qz 2')">
                    </td>
                    <td>
                        <input type="number" name="quiz3[]" class="form-control input-sm" value="{{$grade->quiz3}}"
                               placeholder="@lang('Qz 3')">
                    </td>
                    <td>
                        <input type="number" name="quiz4[]" class="form-control input-sm" value="{{$grade->quiz4}}"
                               placeholder="@lang('Qz 4')">
                    </td>
                    <td>
                        <input type="number" name="quiz5[]" class="form-control input-sm" value="{{$grade->quiz5}}"
                               placeholder="@lang('Qz 5')">
                    </td>
                    <td>
                        <input type="number" name="assign1[]" class="form-control input-sm"
                               placeholder="@lang('Assignment 1')" value="{{$grade->assignment1}}">
                    </td>
                    <td>
                        <input type="number" name="assign2[]" class="form-control input-sm"
                               placeholder="@lang('Assignment 2')" value="{{$grade->assignment2}}">
                    </td>
                    <td>
                        <input type="number" name="assign3[]" class="form-control input-sm"
                               placeholder="@lang('Assignment 3')" value="{{$grade->assignment3}}">
                    </td>
                    <td>
                        <input type="number" name="ct1[]" class="form-control input-sm" placeholder="@lang('CT 1')"
                               value="{{$grade->ct1}}">
                    </td>
                    <td>
                        <input type="number" name="ct2[]" class="form-control input-sm" placeholder="@lang('CT 2')"
                               value="{{$grade->ct2}}">
                    </td>
                    <td>
                        <input type="number" name="ct3[]" class="form-control input-sm" placeholder="@lang('CT 3')"
                               value="{{$grade->ct3}}">
                    </td>
                    <td>
                        <input type="number" name="ct4[]" class="form-control input-sm" placeholder="@lang('CT 4')"
                               value="{{$grade->ct4}}">
                    </td>
                    <td>
                        <input type="number" name="ct5[]" class="form-control input-sm" placeholder="@lang('CT 5')"
                               value="{{$grade->ct5}}">
                    </td>
                    <td>
                        <input type="number" name="written[]" class="form-control input-sm"
                               placeholder="@lang('Written')" value="{{$grade->written}}">
                    </td>
                    <td>
                        <input type="number" name="mcq[]" class="form-control input-sm" placeholder="@lang('Mcq')"
                               value="{{$grade->mcq}}">
                    </td>
                    <td>
                        <input type="number" name="practical[]" class="form-control input-sm"
                               placeholder="@lang('Practical')" value="{{$grade->practical}}">
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-2 pl-0" style="text-align:center;">
        <input type="submit" name="save" class="{{btnClass()}}" value="@lang('Submit Grade')">
    </div>
</form>

<script>
    $(function () {
        for (var i = 5; i < 22; i++) {
            // if (i == 10 || i == 13)
            if (i == 19)
                continue;
            $("#marking-table td:nth-child(" + i + "),#marking-table th:nth-child(" + i + ")").hide();
        }
        $(":checkbox").change(function () {
            if ($(this).is(':checked')) {
                $("#marking-table td:nth-child(" + $(this).val() + "),#marking-table th:nth-child(" + $(this).val() +
                    ")").show();
            } else {
                $("#marking-table td:nth-child(" + $(this).val() + "),#marking-table th:nth-child(" + $(this).val() +
                    ")").hide();
            }
        });
    });
</script>

{!! $grades->links() !!}