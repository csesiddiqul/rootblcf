@extends('layouts.app')
@section('title', __('Add Event'))
@section('content')
    @include('components.cropper.multifile_js')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">@lang('Add Marksheet')</h3>
                            </div><!-- /.box-header -->
                            {!! Form::model($template, ['route' => ['academic.template.update', $template->id], 'method' => 'post','enctype'=>'multipart/form-data','class'=>'form1']) !!}
                            @include('admitcard.element')
                            <div class="box-footer" style="padding: 10px;">
                                <button type="submit" class="btn btn-info ">Update</button>
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#examdate').datepicker({
                format: "dd-mm-yyyy",
                viewMode: "days",
                minViewMode: "days"
            });
        });
    </script>
    <script src="{{ asset('additional/moment.min.js')}}"></script>
    <script src="{{ asset('additional/bootstrap-datetimepicker.css')}}"></script>
    <script src="{{ asset('additional/bootstrap-datetimepicker.min.js')}}"></script>
@endsection