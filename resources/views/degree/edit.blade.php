@extends('layouts.app') 
@section('title', __('Degree')) 
@section('content')  
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')

        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default">  
                <div class="panel-body"> 
                    <div class="btn-group new_b" style="overflow: hidden;">
                        <a class="btn" href="{{route('academic.degree.index')}}">@lang('Degree List')</a>
                        <a class="btn active" href="{{route('academic.degree.create')}}">@lang('Add Exam/Degree')</a>
                    </div> 
                    <div class="clearhight"></div> 
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {!! Form::model($degree, ['method' => 'PATCH','route' => ['academic.degree.update', $degree->id],'class' =>'form-horizontal','autocomplete'=>'off']) !!}
                        <div class="form-group">
                            <label for="level_of_education" class="col-md-2 control-label">@lang('Level of Education')</label> 
                            <div class="col-md-5">
                                {!! Form::select('level_of_education',levelofEducation(),null, array('id' => 'level_of_education', 'class' =>'form-control','required', 'placeholder' => trans('Select'))) !!} 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exam_degree_title" class="col-md-2 control-label">@lang('Exam/Degree Title')</label> 
                            <div class="col-md-5">
                                {!! Form::text('exam_degree_title',null,array('id' => 'exam_degree_title', 'class' =>'form-control','required', 'placeholder' => trans('Write Exam/Degree Title'))) !!}  
                            </div>
                        </div> 
                        <div class="form-group">
                            <div class="col-md-5 col-md-offset-2">
                                {!! Form::button(trans('Submit'), array('class' => 'btn btn-primary btn-sm','type' =>'submit' )) !!}
                            </div>
                        </div> 
                    {!! Form::close() !!}
                </div>
            </div>
         </div>
    </div>
</div>

@endsection