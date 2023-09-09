<div class="panel-body">
    <div id="table-content">
                      <span class="pull-left">
                            <button class="btn btn-xs btn-success d-print-none" role="button" id="btnPrint"
                                    onclick="printDiv()"><i class="fa fa-print"></i> @lang('Print')
                            </button>
                        </span>
        <div class="clearfix"></div>
        <div align="center">
            <div class="imga" style="display: inline-block;">
                <h2 class="headname">
                    &nbsp&nbsp&nbsp {{Auth::user()->school->name}}</h2>
            </div>
            <h4 style="margin-top: -10px;">{{Auth::user()->school->address}}</h4>
            <img class="" src="{{getLogo()}}"
                 alt="{{Auth::user()->school->name}}"
                 style="width: 10%;margin-top: 5px;">
            <h4>@lang('Fail List')</h4>
            <hr>
        </div>
        @php
            $cName = subjectOrCourseNameWithOutS();
            $className = school('country')->code == 'BD' ? 'Class' : 'Grade';
        @endphp
        <div class="academic_info">
            <table class="table table-borderless" style="width:100%">
                <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{$className}}</td>
                        <td>:</td>
                        <td>{{$result->class_name}}</td>
                        <td>@lang('Section')</td>
                        <td>:</td>
                        <td>{{$result->section_number}}</td>
                        @if (!empty($result->group))
                            <td>@lang('Group')</td>
                            <td>:</td>
                            <td>{{$result->group}}</td>
                        @endif
                        <td>@lang('Exam')</td>
                        <td>:</td>
                        <td>{{$result->exam->exam_name}}</td>
                        <td>@lang('Session')</td>
                        <td>:</td>
                        <td>{{getSessionById($result->exam->session_id,'schoolyear')}}</td>
                    </tr>
                    @break
                @endforeach
                </tbody>
            </table>
            <div class="clearfix"></div>
            <table class="table table-responsive table-bordered">
                <thead>
                <tr>
                    <th>@lang('SI')</th>
                    <th>@lang('Student Code')</th>
                    <th>@lang('Name')</th>
                    <th>@lang("Father's Name")</th>
                    <th>@lang("Mother's Name")</th>
                    <th>@lang("Roll")</th>
                    <th>@lang("Subject")</th>
                    <th>@lang("Marks")</th>
                </tr>
                </thead>
                @foreach($positions as $step => $position)
                    @foreach($results as $result)
                        @if($result->student_code == $position['student_code'])
                            <tr>
                                <td>{{$step+1}}</td>
                                <td>{{$result->student_code}}</td>
                                <td>{{$result->name}}</td>
                                <td>{{$result->father_name}}</td>
                                <td>{{$result->mother_name}}</td>
                                <td>{{$result->class_roll}}</td>
                                <td>{{$position['fail']}}</td>
                                <td>{{$position['student_mark']}}</td>
                            </tr>
                            @break
                        @endif
                    @endforeach
                @endforeach
            </table>
        </div>
    </div>
</div>
