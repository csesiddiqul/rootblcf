@extends('layouts.app')

@section('title', 'Give Certificate')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>trans('Certificate').' / <b>'.trans('Generate Certificate').'</b>'])
                @include('components.sectionbar.certificate-bar')
                <div class="panel panel-default">
                    <div class="panel-body">
                        @component('components.file-uploader',['upload_type'=>'certificate'])
                        @endcomponent
                        @component('components.uploaded-files-list',['files'=>$certificates,'upload_type'=>'certificate'])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
