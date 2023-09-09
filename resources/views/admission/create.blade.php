@extends('layouts.app')
@section('title', __('Register'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.admission.pending').'">'. transMsg('Admission').'</a> / <b>'.transMsg('Applications Form').'<b>'])
                @include('components.sectionbar.admission-bar')
                <div class="clearfix"></div>
                <div class="panel panel-default">
                    <div class="panel-body pad-top-0">
                        <form method="POST" id="admission_form" action="{{ route('academic.admission.store') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @include('admission.element')
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <button type="submit" id="admitButton " class=" allButton {{btnClass()}}">
                                        @lang('Submit')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        @foreach(admissionClass() as $key => $class)
        @if($class == 'To be Assigned')
        $( "#class_id" ).val({{$key}}).change();
        @endif
        @endforeach
    </script>
@endsection
