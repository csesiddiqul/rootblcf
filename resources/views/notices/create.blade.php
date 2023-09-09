@extends('layouts.app')

@section('title', __('Add Notice'))
@section('content')
    @include('components.cropper.multifile_js')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <a href="'. route('academic.notice.index').'">'.trans('Notice') .'</a> / <b>'. trans('Add').'<b>'])
                @include('components.sectionbar.frontmanagement-bar')
                <div class="panel panel-default">
                    <div class="panel-body pl-0 pr-0">
                            <form method="POST" id="registerForm"
                                  action="{{route('academic.notice.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group col-md-6">
                                    <label for="title">@lang('Notice Title')</label>
                                    <input type="text" name="title" class="form-control" id="n_title"
                                           placeholder="Enter Title" required>
                                    @error('title')
                                    <span class="help-block mtm-10">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="image-upload form-group">
                                        <label class="control-label upperlabel">
                                            @lang('Upload File')
                                            <span id="deliMG" onclick="cancelUploadMulti('fileMulti');"
                                                  style="display: none;"
                                                  class="myspanRemove">@lang('Remove')</span>
                                        </label>
                                        <label class="btn btn-success btn-sm btn-block uploded-text"
                                               for="multiFileUp">@lang('Choose File')</label>
                                        <input type="file" name="file" class="file-upload form-control"
                                               id="multiFileUp">
                                    </div>
                                    @error('file')
                                    <span class="help-block mtm-10">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="description">@lang('Notice Description')</label>
                                    <textarea name="description" class="form-control rounded-0 ckeditor"
                                              id="n_description"
                                              rows="5"></textarea>

                                    @error('description')
                                    <span class="help-block mtm-10">
                                  <strong>{{ $message }}</strong>
                              </span>
                                    @enderror
                                </div>
                                <div class="clearhight"></div>
                                <div class="col-md-2" >
                                    <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                        @lang('Submit')
                                    </button>
                                </div>
                                <div class="col-md-2 text-center">
                                    <a href="{{route('academic.notice.index')}}"
                                       class="{{btnClass()}}">@lang('Cancel')</a>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        #NoticeSection {
            display: block;
        }
    </style>
    @component('components.cropper.element',['width'=>'300','height'=>'300','type'=>'square']) @endcomponent
@endsection 