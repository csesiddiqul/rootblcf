@if(count($exams) > 0)
    @foreach($exams as $exam)
        <h3>{{$exam->exam_name}}<span class="pull-right"><button class="btn btn-xs btn-success" role="button"
                                                                 id="btnPrint{{$exam->id}}"
                                                                 onclick="printDiv({{$exam->id}})"><i
                            class="material-icons">print</i> @lang('Print Result')</button></span>
        </h3>
        <div class="visible-print-block" id="table-content{{$exam->id}}">
             <span class="pull-left d-print-block d-none">
                @lang('Print Date :')
                <span id="printTime"></span>
            </span>
            <div class="clearfix"></div>
            <div align="center" class="d-print-block d-none">
                <h3>{{school('name')}}</h3>
                <h5>{{school('address')}}</h5>
                <h4 style="text-align:center;">@lang("Result Card")</h4><h4>@lang("Student Name"): {{$studentName}}</h4>
                <h4>@lang("Class"): {{$classNumber}} <span>@lang("Section"): {{$sectionNumber}}</span></h4>
                <h3>@lang("Exam Name"): {{$exam->exam_name}}</h3>
                <div class="clearhight50"></div>
            </div>
            <table class="table table-bordered" style="font-size: 10px;">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">@lang('Course')</th>
                    <th scope="col">@lang('Attendance')</th>
                    @for($i=1;$i<=5;$i++)
                        <th scope="col">@lang('Quiz') {{$i}}</th>
                    @endfor
                    @for($i=1;$i<=3;$i++)
                        <th scope="col">@lang('Assignment') {{$i}}</th>
                    @endfor
                    @for($i=1;$i<=5;$i++)
                        <th scope="col">@lang('CT') {{$i}}</th>
                    @endfor
                    @if($grade->course_config->final_exam_percent > 0)
                        <th scope="col">@lang('Written')</th>
                        <th scope="col">@lang('Mcq')</th>
                    @endif
                    @if($grade->course_config->practical_percent > 0)
                        <th scope="col">@lang('Practical')</th>
                    @endif
                    <th scope="col">@lang('Total Marks')</th>
                    <th scope="col">@lang('Grade')</th>
                    <th scope="col">@lang('Course Teacher')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($grades as $grade)
                    <tr>
                        <th scope="row">{{($loop->index + 1)}}</th>
                        <td>{{$grade->course_config->course->name}}</td>
                        <td>{{$grade->attendance}}</td>
                        @for($i=1;$i<=5;$i++)
                            <td>{{$grade['quiz'.$i]}}</td>
                        @endfor
                        @for($i=1;$i<=3;$i++)
                            <td>{{$grade['assignment'.$i]}}</td>
                        @endfor
                        @for($i=1;$i<=5;$i++)
                            <td>{{$grade['ct'.$i]}}</td>
                        @endfor
                        @if($grade->course_config->final_exam_percent > 0)
                            <td>{{$grade->written}}</td>
                            <td>{{$grade->mcq}}</td>
                        @endif
                        @if($grade->course_config->practical_percent > 0)
                            <td>{{$grade->practical}}</td>
                        @endif
                        <td>{{$grade->marks}}</td>
                        <td>
                            @php
                                $gradesystemsMany = $grade->course_config->gradeSystemMany($grade->course_config->id);
                            @endphp
                            @foreach($gradesystemsMany as $gs)
                                @if($grade->marks >= $gs->from_mark && $grade->marks <= $gs->to_mark)
                                    <b>{{$gs->grade}}</b>
                                    @break
                                @endif
                            @endforeach
                        </td>
                        <td>{{$grade->teacher->name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="clearhight50"></div>
            <div class="d-print-block d-none">
                <div class="pull-left" align="center">
                    ----------------------
                    <div class="clearfix"></div>
                    <span class="border_dot">
                        @lang('Class Teacher')
                    </span>
                </div>
                <div class="pull-right" align="center">
                    ----------------------
                    <div class="clearfix"></div>
                    <span class="border_dot">
                        @lang('Head Teacher')
                    </span>
                </div>
            </div>
            <div class="clearhight50"></div>
            <div align="center" class="d-print-block d-none">Developed by : IPSITA COMPUTERS PTE LTD
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">@lang('Course')</th>
                    <th scope="col">@lang('Total Marks')</th>
                    <th scope="col">@lang('Grade')</th>
                    <!--<th scope="col">GPA</th>-->
                    <th scope="col">@lang('Course Teacher')</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($grades as $grade)
                    @if($grade->exam->id == $exam->id)
                        <tr id="heading{{($loop->index + 1)}}">
                            <th scope="row">{{($loop->index + 1)}}</th>
                            <td>{{$grade->course_config->course->name}}</td>
                            <td><b>{{$grade->marks}}</b>
                                <a class="btn btn-xs btn-danger pull-right"
                                   href="#collapse{{($loop->index + 1)}}"
                                   role="button" data-toggle="collapse" aria-expanded="false"
                                   aria-controls="collapse{{($loop->index + 1)}}"> @lang('View Details')</a>
                            </td>
                            <td>
                                @foreach($gradesystems as $gs)
                                    @if($grade->marks >= $gs->from_mark && $grade->marks <= $gs->to_mark)
                                        <b>{{$gs->grade}}</b>
                                        @break
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                <a href="{{url('user/'.$grade->teacher->student_code)}}">{{$grade->teacher->name}}</a>
                            </td>
                        </tr>
                        <tr class="collapse" id="collapse{{($loop->index + 1)}}"
                            aria-labelledby="heading{{($loop->index + 1)}}" aria-expanded="false">
                            <td colspan="7">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">@lang('Attendance')</th>
                                            @for($i=1;$i<=5;$i++)
                                                <th scope="col">@lang('Quiz') {{$i}}</th>
                                            @endfor
                                            @for($i=1;$i<=3;$i++)
                                                <th scope="col">@lang('Assignment') {{$i}}</th>
                                            @endfor
                                            @for($i=1;$i<=5;$i++)
                                                <th scope="col">@lang('CT') {{$i}}</th>
                                            @endfor
                                            @if($grade->course_config->final_exam_percent > 0)
                                                <th scope="col">@lang('Written')</th>
                                                <th scope="col">@lang('Mcq')</th>
                                            @endif
                                            @if($grade->course_config->practical_percent > 0)
                                                <th scope="col">@lang('Practical')</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{$grade->attendance}}</td>
                                            @for($i=1;$i<=5;$i++)
                                                <td>{{$grade['quiz'.$i]}}</td>
                                            @endfor
                                            @for($i=1;$i<=3;$i++)
                                                <td>{{$grade['assignment'.$i]}}</td>
                                            @endfor
                                            @for($i=1;$i<=5;$i++)
                                                <td>{{$grade['ct'.$i]}}</td>
                                            @endfor
                                            @if($grade->course_config->final_exam_percent > 0)
                                                <td>{{$grade->written}}</td>
                                                <td>{{$grade->mcq}}</td>
                                            @endif
                                            @if($grade->course_config->practical_percent > 0)
                                                <td>{{$grade->practical}}</td>
                                            @endif
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
    @push('script')
        <script>
            function printDiv(id) {
                currentDateTime("printTime");
                var divToPrint = document.getElementById('table-content' + id);
                var newWin = window.open('', 'Print-Window');
                newWin.document.open();
                newWin.document.write('<html><title>@lang("Result Card")</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>@page {size: a4 landscape;}.clearhight50{clear:both;height:50px}.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{font-size:9px;padding:6px}</style>' + divToPrint.innerHTML + '</body></html>');
                newWin.document.close();
                setTimeout(function () {
                    newWin.close();
                }, 100);
            }
        </script>
    @endpush
@else
    @lang('No Related Data Found.')
@endif
