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
                <h2 class="pull-left headname"> {{Auth::user()->school->name}}</h2>
            </div>
            <h4 style="margin-top: -10px;">{{Auth::user()->school->address}}</h4>
            <img src="{{getLogo()}}" alt="{{Auth::user()->school->name}}"
                 style="width: 10%;margin-top: 5px;">
            <h4>@lang('Tabulation Sheet')</h4>
        </div>
        @php
            $cName = subjectOrCourseNameWithOutS();
            $className = school('country')->code == 'BD' ? transMsg('Class') : transMsg('Grade');
            $old_course_code = '';
            $code_array=[101,102,107,108];
            $agreecolspan = $highcolspan =5;
        @endphp
        <div class="academic_info">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>{{$className}}</th>
                    <th>@lang('Section')</th>
                    <th>@lang('Group')</th>
                    <th>@lang('Exam')</th>
                    <th>@lang('Session')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                    <tr>
                        <td>{{$result->class_name}}</td>
                        <td>{{$result->section_number}}</td>
                        <td>{{$result->group}}</td>
                        <td>{{$result->exam->exam_name}}</td>
                        <td> @php
                                $currentSession = currentSession();
                            @endphp
                            {{$currentSession->schoolyear}}
                        </td>
                    </tr>
                    @break
                @endforeach
                </tbody>
            </table>
            <div class="clearfix"></div>
            <div class="table-responsive">
                <table class="table table-bordered" style="text-align: center">
                    <thead>
                    <tr>
                        <th rowspan="2"
                            style="text-align:center;vertical-align : middle;">@lang('SI')</th>
                        <th rowspan="2"
                            style="text-align:center;vertical-align : middle;">@lang('Student Code')</th>
                        <th rowspan="2"
                            style="text-align:center;vertical-align : middle;">@lang('Roll')</th>
                        <th rowspan="2"
                            style="text-align:center;vertical-align : middle;">@lang('Name')</th>
                        @foreach($courses as $course)
                            <th colspan="6" id="course_{{$course->id}}"
                                style="text-align:center">{{$course->name}}</th>
                        @endforeach
                        <th colspan="4" style="text-align:center">@lang('Final')</th>
                    </tr>
                    <tr>
                        @foreach($courses as $course)
                            <th id="ca_{{$course->id}}">@lang('CA')</th>
                            <th>@lang('CQ')</th>
                            <th id="mcq_{{$course->id}}">@lang('MCQ')</th>
                            <th id="practical_{{$course->id}}">@lang('P')</th>
                            <th id="mark_{{$course->id}}">@lang('Total')</th>
                            <th id="lg_{{$course->id}}">@lang('LG')</th>
                            @if($old_course_code == $course->code && $result->comorsep == 1 && in_array($course->code,$code_array))
                                <th>@lang('S Total')</th>
                                <th>@lang('LG')</th>
                            @else
                                @php $old_course_code = $course->code+1; @endphp
                            @endif
                        @endforeach
                        <th>@lang('Total')</th>
                        <th>@lang('GPA')</th>
                        <th>@lang('LG')</th>
                        <th>@lang('Merit')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $pre_stu=null;$student_array=array();$key=1;$td_ca =$td_mcq=$td_practical= false;$tdcount=5 @endphp
                    @foreach($results as $result)
                        @if (!in_array($result->student_code,$student_array))
                            @php array_push($student_array,$result->student_code);$pre_stu=$result->student_code;$sub_total=$sub_gpa=$subject_count=$optional_grade=$com_total=0;$optional=$fail=$optional_fail=false;$print_text='';$com_start=true;$com_count=1;$course_next_code = '';$studentgpa=0 @endphp
                            <tr>
                                <td>{{$key++}}</td>
                                <td>{{$result->student_code}}</td>
                                <td>{{$result->class_roll}}</td>
                                <td>{{$result->student_name}}</td>
                                @foreach($courses as $course)
                                    @php $course_colspan=0;$mcq_written_fail = false; @endphp
                                    @if(in_array($course->id,explode(',',$result->course_groups)))
                                        @if($course->code == '134')
                                            @php  $agreecolspan =5 @endphp
                                        @endif
                                        @if($course->code == '126')
                                            @php  $highcolspan =5 @endphp
                                        @endif
                                        @foreach($results as $t_result)
                                            @if($t_result->course_id == $course->id && $pre_stu == $t_result->student_code)
                                                @if(!in_array($course->id,explode(',',$t_result->countiAss)))
                                                    @php $sub_total += round($t_result->marks); @endphp
                                                @endif
                                                @if ($t_result->ca)
                                                    @php ${"ca" . $course->id} = true; $td_ca = true;@endphp
                                                    <td>{{round($t_result->ca)}}</td>
                                                @else
                                                    @if (!isset(${"ca" . $course->id}))
                                                        @php $course_colspan +=1 @endphp
                                                        @push('script')
                                                            <script>
                                                                $("#ca_" + {{$course->id}}).css('display', 'none');
                                                            </script>
                                                        @endpush
                                                        @php $print_text= $print_text.'#ca_'.$course->id.'{display: none;}'@endphp
                                                    @elseif(isset(${"ca" . $course->id}) && $td_ca)
                                                        <td>0</td>
                                                    @endif
                                                @endif
                                                @php
                                                    $writtenfail = $mcqfail = false;
                                                    if($t_result->written_mcq_marge == 2){
                                                        if($t_result->written_pass_mark > $t_result->written){
                                                            $writtenfail = true;$mcq_written_fail = true;
                                                            if($t_result->optional == 0)
                                                                $fail = true;
                                                        }
                                                        if($t_result->mcq_pass_mark > $t_result->mcq){
                                                            $mcqfail = true;$mcq_written_fail = true;
                                                            if($t_result->optional == 0)
                                                                $fail = true;
                                                        }
                                                    }

                                                @endphp
                                                <td class="{{$writtenfail  ? 'text-danger' : ''}}">{{round($t_result->written)}}</td>
                                                @if ($t_result->mcq)
                                                    @php ${"mcq" . $course->id} = true;$td_mcq = true; @endphp
                                                    <td class="{{$mcqfail ? 'text-danger' : ''}}">{{round($t_result->mcq)}}</td>
                                                @else
                                                    @if (!isset(${"mcq" . $course->id}))
                                                        @php $course_colspan +=1 @endphp
                                                        @push('script')
                                                            <script>
                                                                $("#mcq_" + {{$course->id}}).css('display', 'none');
                                                            </script>
                                                        @endpush
                                                        @php $print_text= $print_text.'#mcq_'.$course->id.'{display: none;}'@endphp
                                                    @elseif(isset(${"mcq" . $course->id}) && $td_mcq)
                                                        <td>0</td>
                                                    @endif
                                                @endif
                                                @if ($t_result->practical)
                                                    @php ${"practical" . $course->id} = true;$td_practical = true;@endphp
                                                    <td>{{round($t_result->practical)}}</td>
                                                @else
                                                    @if (!isset(${"practical" . $course->id}))
                                                        @if($course->code == '134')
                                                            @php  $agreecolspan -=1 @endphp
                                                        @endif
                                                        @if($course->code == '126')
                                                            @php  $highcolspan -=1 @endphp
                                                        @endif
                                                        @php $course_colspan +=1 @endphp
                                                        @push('script')
                                                            <script>
                                                                $("#practical_" + {{$course->id}}).css('display', 'none');
                                                            </script>
                                                        @endpush
                                                        @php $print_text= $print_text.'#practical_'.$course->id.'{display: none;}'@endphp
                                                    @elseif(isset(${"practical" . $course->id}) && $td_practical)
                                                        <td>0</td>
                                                    @endif
                                                @endif
                                                <td>
                                                    {{round($t_result->marks)}}
                                                </td>
                                                @if($result->comorsep == 1 && in_array($course->code,$code_array))
                                                    @if($com_count == 2)
                                                        @if($course_next_code == $course->code)
                                                            @php $com_count  = 1;$com_total += round($t_result->marks);$course_colspan -=1;$subject_count++; @endphp
                                                            <td>{{$com_total}}</td>
                                                            <td class="{{$mcq_written_fail  ? 'text-danger' : ''}}">
                                                                @foreach(get_combined_grade($result->combined_grade) as $grade_sys)
                                                                    @if(round($com_total) >= $grade_sys->from_mark && round($com_total) <= $grade_sys->to_mark)
                                                                        @php $sub_gpa +=$grade_sys->point;@endphp
                                                                        @if (strtolower($grade_sys->grade) == 'f')
                                                                            @php $fail=true; @endphp
                                                                        @endif
                                                                        {{$mcq_written_fail ? 'F' : $grade_sys->grade}}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            @php $com_total =0;  @endphp
                                                            @push('script')
                                                                <script>
                                                                    $("#lg_" + {{$course->id}}).css('display', 'none');
                                                                </script>
                                                            @endpush
                                                        @else
                                                            <td class="{{$mcq_written_fail  ? 'text-danger' : ''}}">
                                                                @php
                                                                    $gradesystemsMany = (new \App\CourseConfig())->gradeSystemMany($t_result->course_config_id);
                                                                @endphp
                                                                @foreach($gradesystemsMany as $gs)
                                                                    @if(round($t_result->marks) >= $gs->from_mark && round($t_result->marks) <= $gs->to_mark)
                                                                        <b class="{{strtolower($gs->grade) == 'f' ? 'text-danger' : ''}}">
                                                                            {{$mcq_written_fail ? 'F' : $gs->grade}}
                                                                            @if(!in_array($course->id,explode(',',$t_result->countiAss)))
                                                                                @php  $sub_gpa +=$gs->point;$subject_count++; @endphp
                                                                            @endif
                                                                            @if (strtolower($gs->grade) == 'f' && $t_result->optional != 1)
                                                                                @php $fail=true; @endphp
                                                                            @endif
                                                                        </b>
                                                                        @break
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        @endif
                                                    @else
                                                        @php $course_colspan +=1;$com_total += round($t_result->marks);$com_count++;$course_next_code = $course->code +1 @endphp
                                                        @push('script')
                                                            <script>
                                                                $("#lg_" + {{$course->id}}).css('display', 'none');
                                                            </script>
                                                        @endpush
                                                    @endif
                                                @else
                                                    @push('script')
                                                        <script>
                                                            $("#tmark_" + {{$course->id}}).css('display', 'none');
                                                        </script>
                                                    @endpush
                                                    <td class="{{$mcq_written_fail  ? 'text-danger' : ''}}">
                                                        @php
                                                            $gradesystemsMany = (new \App\CourseConfig())->gradeSystemMany($t_result->course_config_id);
                                                        @endphp
                                                        @foreach($gradesystemsMany as $gs)
                                                            @if(round($t_result->marks) >= $gs->from_mark && round($t_result->marks) <= $gs->to_mark)
                                                                <b class="{{strtolower($gs->grade) == 'f' ? 'text-danger' : ''}}">
                                                                    {{$mcq_written_fail ? 'F' : $gs->grade}}
                                                                    @if(!in_array($course->id,explode(',',$t_result->countiAss)))
                                                                        @php  $sub_gpa +=$gs->point;$subject_count++; @endphp
                                                                    @endif
                                                                    @if (strtolower($gs->grade) == 'f' && $t_result->optional != 1)
                                                                        @php $fail=true; @endphp
                                                                    @endif
                                                                </b>
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endif
                                                @if ($optional == false && $t_result->optional == 1)
                                                    @php $optional=true; $optional_grade=$t_result->gpa; @endphp
                                                @endif
                                                @break
                                            @endif
                                        @endforeach
                                        @push('script')
                                            <script>
                                                $(document).ready(function () {
                                                    $("#course_" + {{$course->id}}).attr('colspan', {{6-$course_colspan}});
                                                })
                                            </script>
                                        @endpush
                                    @else
                                        @if($course->code == '134')
                                            @php $tdcount= $agreecolspan  @endphp
                                        @elseif($course->code == '126')
                                            @php $tdcount=  $highcolspan @endphp
                                        @endif
                                        @for($td=0;$td<$tdcount;$td++)
                                            <td></td>
                                        @endfor
                                    @endif
                                @endforeach
                                <td>{{round($sub_total)}}</td>
                                <td>
                                    @php
                                        if($optional){
                                                $subject_count = $subject_count -1 ;
                                               if ($optional_grade >= 2) {
                                                   $optional_minus = 2;
                                               }elseif ($optional_grade >= 1) {
                                                    $optional_minus = 1;
                                               }else{
                                                    $optional_minus = 0;
                                               }
                                                $sub_gpa = $sub_gpa - $optional_minus;
                                        }
                                        $gpa = $sub_gpa / $subject_count;

                                        if ($gpa > 5) {
                                            $gpa = 5;
                                        }
                                        if ($fail)
                                           echo '0.00';
                                        else
                                            echo number_format($gpa,2);
                                    @endphp
                                </td>
                                <td>
                                    @foreach(get_static_grade_system() as $gs)
                                        @if($gpa >= $gs['point'])
                                            <b class="{{$fail  ? 'text-danger' : ''}}">
                                                @if ($fail)
                                                    F
                                                @else
                                                    {{$gs['grade']}}
                                                @endif
                                            </b>
                                            @break
                                        @endif
                                    @endforeach
                                </td>
                                <td class="{{$fail  ? 'text-danger' : ''}}">
                                    @if ($fail)
                                        <b>F</b>
                                    @else
                                        @foreach($positions as $step => $position)
                                            @if ($position && $position['student_code'] == $result->student_code)
                                                {{convert_ordinary($step+1)}}
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
