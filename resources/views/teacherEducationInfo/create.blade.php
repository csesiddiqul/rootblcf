@extends('layouts.app')
@section('title', __('Degree'))
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')

        </div>
        <div class="col-md-10" id="main-container">
            <div class="clearhight"></div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a id="topback" href="{{ url('/users/'.Auth::user()->school->code.'/0/1')}}" class="">@lang('Teacher')</a> / @lang('Education Summary')
                    <a href="{{ route('academic.degree.index')}}" class="btn foqas-btn btn-xs pull-right">@lang('Degree')</a>
                </div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-12">
                        @if(!empty($teacherEducationInfos))
                            @php $counter = count($teacherEducationInfos) @endphp
                            @include('teacherEducationInfo.edit')
                        @else
                            @php $counter = 0 @endphp
                        @endif
                        </div>

                        {!! Form::open(array('route' =>'teacherEducationInfo.store','method' =>'POST','role' =>'form','autocomplete'=>'off')) !!}
                        <div class="process_input" id="process_operands">
                            <div class="clearfix"></div>
                            <div class="col-sm-12">
                                <hr class="mrgtopbot">
                                <em id="academic"><b><u>@lang('Academic') {{$counter+1}}</u></b></em>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    {!! Form::label('level_of_education', 'Level of Education', array('class' => 'col-form-label control-label')); !!}
                                    {!! Form::select('level_of_education[]',levelofEducation(),NULL, array('id' => 'level_of_education', 'class' => 'form-control', 'placeholder' => trans('Choose'),'required','onchange'=>'ajaxExamDegreeTitle(this.value,0)')) !!}
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
                                   <div id="textOrSelect">
                                         {!! Form::select('exam_degree_title[]',array(),NULL, array('id' => 'exam_degree_title', 'class' => 'form-control', 'placeholder' => trans('Select'),'required')) !!}
                                   </div>
                                </div>
                                @error('exam_degree_title')
                                <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-4" style="display:none;" id="otherHideShow">
                                <div class="form-group">
                                    <label>@lang('Other Exam/Degree Title')</label>
                                    <input name="others[]" class="form-control" id="others" placeholder="Other Exam/Degree Title">
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
                                    {!! Form::text('group[]', NULL, array('id' => 'group', 'class' => 'form-control', 'placeholder' => trans('Major/Group'),'required')) !!}
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
                                    {!! Form::text('result[]', NULL, array('id' => 'result', 'class' => 'form-control', 'placeholder' => trans('Enter result'),'required')) !!}
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
                                    {!! Form::selectRange('year_of_passing[]', date('Y'),1970, null , ['id' => 'year_of_passing','class' => 'form-control','placeholder' => trans('Choose'),'required']) !!}
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
                                    {!! Form::text('duration[]', NULL, array('id' => 'duration', 'class' => 'form-control', 'placeholder' => trans('Duration'),'required')) !!}
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
                                    {!! Form::text('institution[]', NULL, array('id' => 'institution', 'class' => 'form-control', 'placeholder' => trans('Institution Name'),'required')) !!}
                                </div>
                                @error('institution')
                                <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div id="appendData"></div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <div class="col-md-2">
                                {!! Form::button(trans('Save'), array('class' => 'btn btn-primary btn-sm btn-block','type' =>'submit' )) !!}
                            </div>
                            <div class="col-md-10">
                                <spna class="add_More btn btn-default btn-sm">@lang('Add Education') (If Required)</spna>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <div class="clearhight"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
         </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        // Cloned elements count
        var counter = "{{$counter}}";
        $(".add_More").click(function(){
            // Increment the cloned element count
            counter++;
            // Clone the element and assign it to a variable
            var clone = $("#process_operands").clone(true)
                .append($('<div class="col-sm-4"><a class="delete btn btn-danger btn-sm cloneRemove" href="#">Remove</a></div>'))
                .appendTo("#appendData");

            // Modify cloned element, using the counter variable
            clone.find('#level_of_education').attr('onchange','ajaxExamDegreeTitle(this.value,'+counter+')');
            clone.find('#level_of_education').attr('id', 'level_of_education'+counter);
            clone.find('#textOrSelect').attr('id', 'textOrSelect'+counter);
            clone.find('#exam_degree_title').attr('id', 'exam_degree_title'+counter);
            clone.find('#otherHideShow').attr('id', 'otherHideShow'+counter);
            clone.find('#others').attr('id', 'others'+counter);

            clone.find('#group').attr('id', 'group'+counter);
            clone.find('#result').attr('id', 'result'+counter);
            clone.find('#year_of_passing').attr('id', 'year_of_passing'+counter);
            clone.find('#duration').attr('id', 'duration'+counter);
            clone.find('#institution').attr('id', 'institution'+counter);
            clone.find('#academic').html('<b><u>Academic '+parseInt(counter+1)+'</u></b>');

        });

        $("body").on('click',".delete", function() {
            $(this).closest(".process_input").remove();
            counter--; // Modify the counter
        });
    });
</script>
@endsection
