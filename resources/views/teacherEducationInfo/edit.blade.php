@foreach($teacherEducationInfos as $key => $teacherEducationInfo)
    @if(empty($key))
        @php $keyid = 999; @endphp
    @else
        @php $keyid = $key; @endphp
    @endif
    <div id="academicview{{$key+1}}">
        <table class="table table-bordered table-condensed table-striped table-hover widthtbletwo">
            <thead class="thead-light">
            <tr>
                <th colspan="2">
                    <em class="emfontsize"><b><u>Academic {{$key+1}}</u></b></em>
                    <label onclick="event.preventDefault(); if (confirm('Do you want to delete?')){document.getElementById('academicdelete-form{{$teacherEducationInfo->id}}').submit();} else {return false;}"
                           class="btn btn-xs btn-danger btn-xs-label">
                        <i class="material-icons">delete_forever</i><span> @lang('Delete')</span>

                        <form id="academicdelete-form{{$teacherEducationInfo->id}}"
                              action="{{ route('teacherEducationInfo.destroy',$teacherEducationInfo->id) }}"
                              method="POST" style="display: none;">
                            {{ csrf_field() }}
                            @method('delete')
                        </form>
                    </label>
                    <label onclick="academicviewedit('show',{{$key+1}})"
                           class="btn btn-xs btn-primary btn-xs-label">
                        <i class="material-icons">open_in_new </i><span> @lang('Edit')</span>
                    </label>
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
                    @error('exam_degree_title')
                    <span class="help-block">
                                                <strong>{{ $message }}</strong>
                                              </span>
                    @enderror
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
    <div class="row" id="academicedit{{$key+1}}"
         style="display:none;">
        <div class="clearfix"></div>
        <div class="col-sm-12">
            <hr class="mrgtopbot">
            <em id="academic"><b><u>@lang('Edit Academic') {{$key+1}}</u></b></em>
        </div>
        {!! Form::model($teacherEducationInfo, ['method' => 'PATCH','route' => ['teacherEducationInfo.update', $teacherEducationInfo->id],'autocomplete'=>'off']) !!}
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('level_of_education', 'Level of Education', array('class' => 'col-form-label control-label')); !!}
                {!! Form::select('level_of_education',levelofEducation(),null, array('id' => 'level_of_education'.$keyid, 'class' => 'form-control', 'placeholder' => trans('Choose'),'required','onchange'=>'ajaxExamDegreeTitle(this.value,'.$keyid.')')) !!}
            </div>
            @error('level_of_education')
            <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('exam_degree_title', 'Exam/Degree Title', array('class' => 'col-form-label control-label')); !!}
                <div id="textOrSelect{{$keyid}}">
                    {!! Form::select('exam_degree_title',levelofDegree($teacherEducationInfo->level_of_education),null, array('id' => 'exam_degree_title'.$keyid, 'class' => 'form-control', 'placeholder' => trans('Select'),'required')) !!}
                </div>
            </div>
            @error('exam_degree_title')
            <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        @if($teacherEducationInfo->exam_degree_title == 'Other' || $teacherEducationInfo->exam_degree_title == 'Others')
            @php
                $displayyesno = 'display:block;';
                $displayyesnovalue = $teacherEducationInfo->others;
            @endphp
        @else
            @php
                $displayyesno = 'display:none;';
                $displayyesnovalue = '';
            @endphp
        @endif
        <div class="col-sm-4" style="{{$displayyesno}}"
             id="otherHideShow{{$keyid}}">
            <div class="form-group">
                <label>@lang('Other Exam/Degree Title')</label>
                <input name="others" class="form-control"
                       id="others{{$keyid}}"
                       placeholder="Other Exam/Degree Title"
                       value="{{$displayyesnovalue}}">
            </div>
            @error('others')
            <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('group', 'Major/Group', array('class' => 'col-form-label control-label')); !!}
                {!! Form::text('group',null, array('id' => 'group'.$keyid, 'class' => 'form-control', 'placeholder' => trans('Major/Group'),'required')) !!}
            </div>
            @error('group')
            <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('result', 'Result', array('class' => 'col-form-label control-label')); !!}
                {!! Form::text('result',null, array('id' => 'result'.$keyid, 'class' => 'form-control', 'placeholder' => trans('Enter result'),'required')) !!}
            </div>
            @error('result')
            <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('year_of_passing', 'Year of Passing', array('class' => 'col-form-label control-label')); !!}
                {!! Form::selectRange('year_of_passing', date('Y'),1970,null, ['id' => 'year_of_passing'.$keyid,'class' => 'form-control','placeholder' => trans('Choose'),'required']) !!}
            </div>
            @error('year_of_passing')
            <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('duration', 'Duration (Years)', array('class' => 'col-form-label control-label')); !!}
                {!! Form::text('duration', null, array('id' => 'duration'.$keyid, 'class' => 'form-control', 'placeholder' => trans('Duration'),'required')) !!}
            </div>
            @error('duration')
            <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('institution', 'Institute Name', array('class' => 'col-form-label control-label')); !!}
                {!! Form::text('institution',null, array('id' => 'institution'.$keyid, 'class' => 'form-control', 'placeholder' => trans('Institution Name'),'required')) !!}
            </div>
            @error('institution')
            <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::button(trans('&nbsp; &nbsp; Update &nbsp; &nbsp;'), array('class' => 'btn btn-info btn-sm cloneRemove','type' =>'submit' )) !!}
                <spna onclick="academicviewedit('hide',{{$key+1}})"
                      class="btn btn-sm btn-warning cloneRemove">
                    &nbsp; &nbsp; Cancel &nbsp; &nbsp;
                </spna>
            </div>
        </div>
        <div class="clearfix"></div>
        {!! Form::close() !!}
    </div>
@endforeach
