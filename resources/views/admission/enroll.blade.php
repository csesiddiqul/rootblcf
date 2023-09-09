@extends('layouts.app')

@section('title', __('Enroll Admission Students'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.admission.pending').'">'. transMsg('Admission').'</a> / <b>'.transMsg('Enroll of Student').'<b>'])
                @include('components.sectionbar.admission-bar')
                <div class="panel panel-default">
                    @if($admissionyear)
                        <div class="col-sm-5">
                            {!! Form::open(['route' => ['academic.admission.enroll',[auth()->user()->school->code,$admissionyear->id,$admissionyear->year]], 'method' => 'post']) !!}
                            {!! Form::label('class_id',transMsg('Enroll In'),['class'=>'pull-left mr-2','style'=>'margin-top:8px;margin-right:5px']) !!}
                            {!! Form::select('class_id',admissionClass(),$class_id ?? null, array('required'=>true, 'class' => 'pull-left form-control w-40','onchange' => 'this.form.submit()', 'placeholder' => trans('Select Class'))) !!}
                            {!! Form::select('from_st',[1=>transMsg('Merit List'),2=>transMsg('First Waiting List'),3=>transMsg('Second Waiting List'),4=>transMsg('Third Waiting List')],$from_st ?? null, array('required'=>true, 'class' => 'pull-right form-control w-40','onchange' => 'this.form.submit()')) !!}
                            {!! Form::close() !!}
                        </div>
                    @endif
                    @if(isset($students) && count($students) > 0)
                        @foreach ($students as $student)
                            <div class="page-panel-title pull-right">
                                <b>@lang('Class')</b> - {{$student->section->class->name}} &nbsp;
                                <b>@lang('Section')</b> - {{ ucwords($student->section->section_number)}} &nbsp;
                                <span class="pull-right"><b>@lang('Current Date Time'):</b> &nbsp;{{ Carbon\Carbon::now()->format('h:i A d/m/Y')}}</span>
                            </div>
                            @php $section_id = $student->section->id @endphp
                            @break($loop->first)
                        @endforeach
                        <div class="panel-body">
                            @component('components.enroll-students',['students'=>$students,'classes'=>$classes,'section_id'=>$section_id,'preadmissionID'=>$admissionyear->id])
                            @endcomponent
                        </div>
                    @else
                        <div class="panel-body">
                            @if ($errors->any())
                                <div class="clearfix"></div>
                                <div class="alert alert-danger col-md-12">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div style="clear: both"></div>
                            <br>
                            <div class="col-md-12 pl-0">
                                @if($getmessage == 'FirstTime')
                                    <code><i><b>*@lang('Note'):</b> @lang('Please select an class').</i></code>
                                @else
                                    <code><i><b>*@lang('Note')
                                                :</b> @lang('Class') {{$getmessage}} @lang('has no available data')
                                            .</i></code>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
