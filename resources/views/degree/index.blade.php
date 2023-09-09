@extends('layouts.app')

 @section('title', __('Students')) 

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')

        </div>
        <div class="col-md-10" id="main-container">
            <div class="clearhight"></div>
            <div class="panel panel-default"> 
                <div class="panel-body"> 
                    <div class="btn-group new_b" style="overflow: hidden;">
                        <a class="btn active" href="{{route('academic.degree.index')}}">@lang('Degree List')</a>
                        <a class="btn" href="{{route('academic.degree.create')}}">@lang('Add Exam/Degree')</a>
                    </div> 
                    <div class="clearhight"></div>
                    <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                    	<thead>
                         <tr>
                    		<th>@lang('SL')</th>
                    		<th>@lang('Level of Education')</th>
                    		<th>@lang('Exam/Degree Title')</th>
                    		<th>@lang('Action')</th>
                    	</tr>
                    	</thead>
                    	<tbody>
                            @foreach($degree as $key => $value)
                            <tr>
                                <td>{{$key+1}}</td> 
                                <td>{{levelofEducation($value->level_of_education)}}</td>
                                <td>{{$value->exam_degree_title}}</td>
                                <td>
                                    <small> 
                                        <a href="{{route('academic.degree.edit',$value->id)}}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Edit"> Edit </a>
                                    </small>
                                </td>
                            </tr>
                        @endforeach
                    	</tbody>
                    </table>
                </div>
            </div>
         </div>
    </div>
</div>

@endsection