@extends('layouts.app')

@section('title', __('Students'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.class').'">'. trans('Academics').'</a>  / <a href="'. route('academic.class').'">'. trans('Section').'</a>  / <b>'. trans('Edit').'<b>'])
                @include('components.sectionbar.academics-bar')
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="{{route('school.section.update',[$section->class_id,$section->id])}}"
                              method="post">
                            {{csrf_field()}}
                            <div class="form-group col-sm-4">
                                <label for="section_number{{$class->class_number}}"
                                       class="control-label">@lang('Section Name')</label>
                                <input type="text" class="form-control" id="section_number{{$class->class_number}}"
                                       name="section_number" value="{{$section->section_number}}"
                                       placeholder="@lang('A, B, C, etc..')">
                                @error('section_number')
                                <span class="help-block text-danger">
                                   <strong>{{$message}}</strong>
                                 </span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="room_number{{$class->class_number}}"
                                       class="control-label">@lang('Room Number')</label>
                                <input type="number" class="form-control" id="room_number{{$class->class_number}}"
                                       name="room_number" value="{{$section->room_number}}"
                                       placeholder="@lang('Room Number')">
                                @error('room_number')
                                <span class="help-block text-danger">
                                   <strong>{{$message}}</strong>
                                 </span>
                                @enderror
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="status" class="control-label">@lang('Status')</label>
                                {!! Form::select('status',status(),$section->status,array('id' => 'status', 'class' => 'form-control', 'placeholder' => trans('Select'),'required')) !!}
                            </div>
                            @if(strtolower($section->section_number) == 'admission')
                                <div class="form-group col-sm-4">
                                    <label for="add_total"
                                           class="control-label">@lang('Admission Total Student')</label>
                                    {!! Form::number('add_total',$section->add_total ?? null,array('id' => 'add_total', 'class' => 'form-control','min'=>0)) !!}
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="add_amount" class="control-label">@lang('Admission Amount')</label>
                                    {!! Form::number('add_amount',$section->add_amount ?? null,array('id' => 'add_amount', 'class' => 'form-control','min'=>0)) !!}
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="lottery_on_mark" class="control-label">@lang('Lottery Base')</label>
                                    {!! Form::select('lottery_on_mark',['0'=>'Base on without Mark','1'=>'Base on with Mark'],$section->lottery_on_mark ?? null,array('id' => 'lottery_on_mark', 'class' => 'form-control')) !!}
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="waiting_1" class="control-label">@lang('First Waiting Total')</label>
                                    {!! Form::number('waiting_1',$section->waiting_1 ?? null,array('id' => 'waiting_1', 'class' => 'form-control','min'=>0)) !!}
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="waiting_2" class="control-label">@lang('Second Waiting Total')</label>
                                    {!! Form::number('waiting_2',$section->waiting_2 ?? null,array('id' => 'waiting_2', 'class' => 'form-control','min'=>0)) !!}
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="waiting_3" class="control-label">@lang('Third Waiting Total')</label>
                                    {!! Form::number('waiting_3',$section->waiting_3 ?? null,array('id' => 'waiting_3', 'class' => 'form-control','min'=>0)) !!}
                                </div>
                            @endif
                            <div class="form-group">
                                <div class="col-sm-2">
                                    <button type="submit" class="{{btnClass()}}">@lang('Update')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection