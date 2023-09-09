<div class="table-responsive">
  <table class="table table-bordered table-striped  table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">{{transMsg(school('country')->code == 'BD' ? 'Subject Name ' : 'Course Name ')}}</th>
      <th scope="col">{{transMsg(school('country')->code == 'BD' ? 'Subject Time ' : 'Course Time ')}}</th>
      <th scope="col">@lang('Room Number')</th>
      @if($student)
        <th scope="col">@lang('Course Teacher')</th>
      @endif
      @if(!$student)
        <th scope="col">{{transMsg(school('country')->code == 'BD' ? 'Class Number ' : 'Grade Number ')}}</th>
        <th scope="col">@lang('Section Number')</th>
        <th scope="col">@lang('All Students')</th>
        <th scope="col">@lang('Action')</th>
      @endif
      @foreach ($courses as $course)
        @if(!$student && ($course->teacher_id == Auth::user()->id || Auth::user()->role == 'admin') && $course->exam_id != 0)
          <th scope="col">@lang('Give Marks')</th>
          <th scope="col">@lang('View Marks')</th>
        @endif
        @break
      @endforeach
      @if(Auth::user()->role == 'admin')
        {{-- <th scope="col">@lang('Action')</th>
        <th scope="col">@lang('Action')</th> --}}
        <th scope="col">@lang('Edit')</th>
      @endif
    </tr>
  </thead>
  <tbody>
    @foreach ($courses as $course)
    <tr>
      <th scope="row">{{($loop->index + 1)}}</th>
      <td>
        {{transMsg($course->course->name)}}
      </td>

      <td><small>{{$course->course_time}}</small></td>

      <td>{{$course->section->room_number}}</td>

      @if($student)
        <td>
          <a href="{{route('user.show',$course->teacher->student_code)}}">{{$course->teacher->name}}</a>
        </td>
      @endif

      @if(!$student)
        <td>{{$course->section->class->name}}</td>
        <td>{{$course->section->section_number}}</td>

        @if($course->exam_id != 0)
          <td>
            <a href="{{url('course/students/'.$course->teacher_id.'/'.$course->id.'/'.$course->exam_id.'/'.$course->section->id)}}" role="button" class="btn btn-info btn-xs"><i class="fal fa-sms"></i> @lang('Message Students')</a>
          </td>
        @else
          <td><small>@lang('Save under Exam to Add Student')</small></td>
        @endif

        @if(!$student && ($course->teacher_id == Auth::user()->id || Auth::user()->role == 'admin') && $course->exam_id != 0)
          <td>
            <a href="{{url('attendances/students/'.$course->teacher_id.'/'.$course->id.'/'.$course->exam_id.'/'.$course->section->id)}}" role="button" class="btn btn-primary btn-xs"><i class="fad fa-calendar-alt"></i> @lang('Take Attendance')</a>
          </td>
        @else
          <td><small>@lang('Save under Exam to Take Attendance')</small></td>
        @endif

      @endif
      @if(!$student && ($course->teacher_id == Auth::user()->id || Auth::user()->role == 'admin') && $course->exam_id != 0)
        <td>
          <a href="{{url('grades/c/'.$course->teacher_id.'/'.$course->id.'/'.$course->exam_id.'/'.$course->section->id)}}" role="button" class="btn btn-danger btn-xs"><i class="fal fa-chart-bar"></i> @lang('Submit Grade')</a>
        </td>
        <td>
          <a href="{{url('grades/t/'.$course->teacher_id.'/'.$course->id.'/'.$course->exam_id.'/'.$course->section->id)}}" role="button" class="btn btn-success btn-xs"><i class="fal fa-signal-alt"></i> @lang('View Marks')</a>
        </td>
      @endif
      @if(Auth::user()->role == 'admin')
        <td>
          <a href="{{route('academic.course.edit',$course->course->id)}}" class="btn btn-xs btn-danger"><i class="fal fa-edit"></i> @lang('Edit')</a>
        </td>
      @endif
    </tr>
    @endforeach
  </tbody>
</table>
</div>
