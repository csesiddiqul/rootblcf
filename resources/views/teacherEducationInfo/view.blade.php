@foreach($user->teacherEducationInfo as $key => $teacherEducationInfo)
    @if(empty($key))
        @php $keyid = 999; @endphp
    @else
        @php $keyid = $key; @endphp
    @endif
    <div id="academicview{{$key+1}}">
        <table class="table table-bordered table-condensed table-striped table-hover">
            <thead class="thead-light">
            <tr>
                <th colspan="2">
                    <em class="emfontsize"><b><u>Academic {{$key+1}}</u></b></em> 
                </th>
            </tr>
            </thead>
            <tbody id="academicview{{$key+1}}">
            <tr>
                <td>@lang('Level of Education')</td>
                <td>
                    {{levelofEducation($teacherEducationInfo->level_of_education)}}
                </td>
            </tr>
            <tr>
                <td>@lang('Exam/Degree Title')</td>
                <td>
                    @if($teacherEducationInfo->exam_degree_title == 'Other' || $teacherEducationInfo->exam_degree_title == 'Others')
                        {{$teacherEducationInfo->others}}
                    @else
                        {{$teacherEducationInfo->exam_degree_title}}
                    @endif 
                </td>
            </tr>
            <tr>
                <td>@lang('Major/Group')</td>
                <td>{{$teacherEducationInfo->group}}</td>
            </tr>
            <tr>
                <td>@lang('Result')</td>
                <td>{{$teacherEducationInfo->result}}</td>
            </tr>
            <tr>
                <td>@lang('Year of Passing')</td>
                <td>{{$teacherEducationInfo->year_of_passing}}</td>
            </tr>
            <tr>
                <td>Duration (Years)</td>
                <td>{{$teacherEducationInfo->duration}}</td>
            </tr>
            <tr>
                <td>@lang('Institute Name')</td>
                <td>{{$teacherEducationInfo->institution}}</td>
            </tr>
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div> 
@endforeach
