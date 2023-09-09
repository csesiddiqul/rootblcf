@extends('layouts.app')
<style>
    .sp-card {
        border: 1px dashed #000000;
        padding: 5px;
        min-height: 255px;
    }

    .m-card {
        float: left;
        margin-bottom: 15px;
        padding-left: 0px !important;
    }

    .hding-one {
        /*font-family: fantasy;*/
        font-weight: 600;
        letter-spacing: -0.5;
        text-align: center;
        margin-bottom: 5px;
        margin-top: 5px;
        font-size: 14px !important;
    }

    .hding-two {
        font-family: -webkit-body;
        text-align: center;
        font-size: 12px !important;
        margin-bottom: 5px;
        margin-top: 1px;
        font-weight: 400;
    }

    .hding-three {
        text-align: center;
        margin-bottom: 5px;
        margin-top: 1px;
        font-size: 22px !important;
    }

    .sp-card table tr td:nth-child(1) {
        width: 40%;
        padding-left: 7px;
        padding-right: 4px;
        vertical-align: top;
    }

    .sp-card table tr td {
        font-size: 14px;
    }

    .table-bordered, td, th {
        border-radius: 0 !important;
    }

    td, th {
        padding: 0;
    }

    .sp-card table tr td:nth-child(2) {
        width: 55%;
        vertical-align: top;
    }

    .sp-card table tr td:nth-child(3) {
        width: 30%;
        text-align: center;
    }

    .c-roll {
        font-family: fantasy;
        font-size: 24px !important;
    }

    .n-number {
        margin: 0 auto;
        line-height: 50px;
        height: 50px;
        width: 50px;
        border-radius: 50%;
        border: 1px solid #000;
    }

    .margin-top {
        margin-top: 20px;
    }

    .pd-top {
        padding-top: 15px !important;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('exams').'">'. trans('Exams').'</a>  / <b>'. trans('Seat Plan').'<b>'])
                @include('components.sectionbar.examination-bar')
                <div class="panel panel-default">
                    <div class="panel-body pad-top-0">
                        {!! Form::open(['method' => 'post','autocomplete'=>'off']) !!}
                        <div class="form-group pl-0 col-md-3{{ $errors->has('section') ? ' has-error' : '' }}">
                            {!! Form::label('section', trans('Section'), ['class' => 'control-label']) !!}
                            {!! Form::select('section',$pluckSection ?? array(), $section ?? null, array('id' => 'sections',  'class' => 'select2 form-control','required','placeholder' =>trans('Choose'))) !!}
                            @error('section')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-3{{ $errors->has('exam') ? ' has-error' : '' }}">
                            {!! Form::label('exam', trans('Exam'), ['class' => 'control-label']) !!}
                            {!! Form::select('exam', $pluckExam ?? array() , $exam_id?? null , ['class' => 'select2 form-control','required','placeholder'=>trans('Choose')]) !!}
                            @error('exam')
                            <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-2 mt-25">
                            <button type="submit" class="{{btnClass()}}"
                                    style="height: 38px">@lang('Submit')</button>
                        </div>
                        {!! Form::close() !!}

                        @if (isset($students) && $students->count())
                            <div class="col-md-1 mt-10" style="    margin-top: 10px;padding-left: 0px;">
                                <span class="btn btn-default btn-sm " onclick="printDiv('main')">@lang('Print')</span>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12 pd-top" id="main">
                                @foreach($students as $student)
                                    <div class="col-sm-4 m-card">
                                        <div class="col-sm-12 sp-card">
                                            <h2 class="hding-one">{{school('name')}}</h2>
                                            <h4 class="hding-two">{{school('address')}}</h4>
                                            <h3 class="hding-three">{{$exam->exam_name}}</h3>
                                            <table>
                                                <tbody>
                                                <tr>
                                                    <td>@lang('Student Id') <b style="float: right;"> : </b></td>
                                                    <td> {{$student->student_code}}</td>

                                                </tr>
                                                <tr>
                                                    <td>@lang('Name') <b style="float: right;"> : </b></td>
                                                    <td colspan="2">{{$student->name}}</td>
                                                </tr>

                                                <tr>
                                                    <td>@lang('Class') <b style="float: right;"> : </b></td>
                                                    <td>{{$student->section->class->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>@lang('Section') <b style="float: right;"> : </b></td>
                                                    <td>{{$student->section->section_number}}</td>
                                                </tr>
                                                <tr>
                                                    <td>@lang('Group') <b style="float: right;"> : </b></td>
                                                    <td>{{$student->section->class->group}}</td>
                                                </tr>
                                                <tr>
                                                    <td>@lang('Session') <b style="float: right;"> : </b></td>
                                                    <td>{{getSessionById($student->session,'schoolyear')}}</td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @else

                            <div class="clearfix"></div>
                            <div class="panel-body">
                                @lang('No Related Data Found.')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection



{{--


        /*The window.onload function will run as  
        soon as the window loads in the browser */
        window.onload = function () { 
  
            /* This method returns the html element that 
                has the ID attribute with the specified 
                value. */
            let canvas = document.getElementById("canv"); 
  
            /* This method returns a drawing context 
                on the canvas, or null if the context 
                identified is not supported. */
            let context = canvas.getContext("2d"); 
  
            /* It will change the style and appearance  
                of the text to make it look more geeky. */
            context.font = "50px serif"; 
            context.fillStyle = "green"; 
            context.textAlign = "center"; 
  
            let string = "{{school('name')}}"; 
  
            let angle = Math.PI * 0.6; // in radians 
            let radius = 200; 
  
  
            context.translate(300, 300); 
            context.rotate(-1 * angle / 2); 
  
            for (let i = 0; i < string.length; i++) { 
  
                /* It is worth noting that we are not 
                    rotating the text,here the whole 
                    context is being rotated and 
                    translated, and the letters are just 
                    filled in it. */
                context.rotate(angle / string.length); 
                context.save(); 
                context.translate(0, -1 * radius); 
                context.fillText(string[i], 0, 0); 
                context.restore(); 
            } 
        }; 
    
    --}}