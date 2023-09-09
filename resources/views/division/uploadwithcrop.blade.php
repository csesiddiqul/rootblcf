@extends('layouts.app')
@section('content') 
@component('components.cropper.element',['width'=>'180','height'=>'180','type'=>'circle']) @endcomponent
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">
            @include('layouts.leftside-menubar')
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default"> 
                {!! Form::open(array('route' =>'division.upload','method' =>'POST','role' =>'form','autocomplete'=>'off','enctype'=>'multipart/form-data')) !!}
                <div class="panel-body"> 
                    @php print_r($division->url) @endphp
                    @if (!empty($division->url))
                        <img src="{{$division->url}}" class="col-md-4 col-sm-4 col-xs-12"/> 
                    @else
                        <div class="image-upload">
                            <label for="file-upload">
                                <img src="{{asset('additional/uploadcrop/unnamed2.png')}}" id="preview_image">
                            </label>    
                            <input type="file" value="" class="file-upload" id="file-upload" accept="image/*">
                        </div>                                                      
                        <div style="clear:both;"></div>
                        <div id="uploaded_image_url"></div> 
                    @endif 
                    <label id="deliMG" onclick="cancelUploadImg('unnamed2');" style="display: none; font-weight:normal;margin-top:7px;">Remove Image</label>
                </div>
                {!! Form::button(trans('Save'), array('class' => 'btn btn-primary btn-sm btn-block','type' =>'submit' )) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>  

@endsection