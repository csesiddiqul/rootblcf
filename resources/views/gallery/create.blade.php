@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <a href="'. route('academic.gallery.index').'">'.trans('Gallery') .'</a> / <b>'. trans('Add').'<b>'])
                @include('components.sectionbar.frontmanagement-bar')
                <div class="panel panel-default ptlb-515">
                    <div class="panel-body plt-07">
                        <form class="row" method="POST" id="registerForm"
                              action="{{ route('academic.gallery.store') }}">
                            {{ csrf_field() }}
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                    <label for="title">@lang('Title')</label>
                                    {!! Form::text('title', NULL, array('id' => 'title','required', 'class' => 'form-control', 'placeholder' => trans('Title'))) !!}
                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="onlyclear"></div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="description">@lang('Description')</label>{!! Form::textarea('description', NULL, array('rows' => '5','id' => 'description', 'required', 'class' => 'form-control', 'placeholder' => trans('Description'))) !!}
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="onlyclear"></div>
                            <div class="col-md-6">
                                <div class="image-upload">
                                    <label class="control-label upperlabel">
                                        @lang('Upload Picture')
                                        <span id="deliMG" onclick="cancelUploadImg('unnamed2');" style="display: none;"
                                              class="myspanRemove">@lang('Remove')</span>
                                    </label>
                                    <label class="btn btn-success btn-sm btn-block uploded-text" for="file-upload">@lang('Choose Picture')</label>
                                    <input type="file" value="" class="file-upload form-control" id="file-upload"
                                           accept="image/*">
                                </div>
                                <div style="clear:both;"></div>
                                <div id="uploaded_image_url"></div>
                            </div>
                            <div class="clearhight"></div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label for="status">@lang('Status')</label>{!! Form::select('status',status(), old('status'), array('id' => 'status', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="clearhight"></div>
                            <div class="col-md-2">
                                <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                    @lang('Save')
                                </button>
                            </div>
                            <div class="col-md-2 text-center">
                                <a href="{{route('academic.gallery.index')}}" class="{{btnClass()}}">@lang('Cancel')</a>
                            </div>
                            <div class="clearhight50"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @component('components.cropper.element',['width'=>'380','height'=>'366','type'=>'square']) @endcomponent
    <script>
        $(document).ready(function () {
            $("#imageFrame .modal-dialog").addClass('modal-lg');
        })
    </script>
    <style>
        #resizer .cr-boundary {
            height: 400px !important;
        }
    </style>
@endsection

