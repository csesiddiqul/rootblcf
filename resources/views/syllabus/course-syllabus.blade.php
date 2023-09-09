@extends('layouts.app')

@section('title', __('Add Syllabus'))
<!-- Main Quill library -->
{{--<script src="//cdn.quilljs.com/1.3.5/quill.js"></script>--}}

<!-- Theme included stylesheets -->
{{--<link href="//cdn.quilljs.com/1.3.5/quill.snow.css" rel="stylesheet">--}}

@section('content')
@include('components.cropper.multifile_js') 
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.class').'">'. trans('Academics').'</a>  / <b>'. trans('Syllabus').'<b>'])
            @include('components.sectionbar.course-bar')
            <div class="panel panel-default">
                <div class="panel-body"> 

                    <div id="my_upload" class="row"> 
                        <form method="POST" id="registerForm" action="{{route('academic.syllabus.store')}}" enctype="multipart/form-data">
                            @csrf 
                        <div class="col-md-8">  
                            
                            <div class="clearhight"></div>
                            <label for="upload-title">@lang('File Title'): </label>
                            <input type="text" class="form-control" name="title" id="upload-title" placeholder="@lang('File title here...')" required>
                            @error('title')
                            <span class="help-block help-cust">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror 
                            <div class="clearhight"></div>
                            <label for="classes">@lang('Class')</label>
                            <select id="classes" class="form-control" name="classes" required>
                                @foreach($sections as $section)
                                    <option value="{{$section->id}}">
                                        @lang('Class'): {{$section->class->name}} -
                                        @lang('Section'): {{$section->section_number}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="clearhight"></div>
                        <div class="col-md-8"> 
                            <div class="image-upload">
                                <label class="control-label upperlabel">
                                    @lang('Upload File')
                                    <span id="deliMG" onclick="cancelUploadMulti('fileMulti');" style="display: none;" class="myspanRemove">@lang('Remove')</span>
                                </label>
                                <label class="btn btn-success btn-sm btn-block uploded-text" for="multiFileUp">@lang('Choose
                                    File')</label>
                                <input type="file" name="file" class="file-upload form-control" id="multiFileUp"> 
                            </div>
                            @error('file')
                            <span class="help-block help-cust">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="clearhight"></div>
                        <div class="col-md-2" style="display:none" id="fileSubmitBtns">
                            <button type="submit" id="registerBtn" class="{{btnClass()}}">
                             @lang('Submit')
                            </button>
                        </div> 
                        <div class="clearhight"></div> 
                        </form>
                    </div>  
                    @component('components.uploaded-files-list',['files'=>$files,'parent'=>($class_id !== 0)?'class':'','upload_type'=>'syllabus'])
                    @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@component('components.cropper.element',['width'=>'null','height'=>'null','type'=>'null']) @endcomponent 
@endsection
