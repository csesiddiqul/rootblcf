@extends('layouts.app')

@section('title', __('Students'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @php
                    $courseTN = school('country')->code == 'BD' ? 'Subject' : 'Course';
                @endphp
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.class').'">'. trans('Academics').'</a>  / <a href="'. route('academic.class').'">'. trans(school('country')->code == 'BD' ? 'Class' : 'Grade').'</a>  / <b>'. trans('Edit').'<b>'])
                @include('components.sectionbar.academics-bar')

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-sm-5 pl-0">
                            <form action="{{route('school.class_update',$class->id)}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="className{{$school->id}}"
                                           class="control-label">{{trans(school('country')->code == 'BD' ? 'Class Name' : 'Grade Name ')}}</label>
                                    <input type="text" name="name" class="form-control" value="{{$class->name}}"
                                           id="className{{$school->id}}"
                                           placeholder="{{school('country')->code == 'BD' ? 'Class Name' : 'Grade Name '}}"
                                           required>
                                    @error('name')
                                    <span class="help-block text-danger">
                                       <strong>{{$message}}</strong>
                                     </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="classNumber{{$school->id}}"
                                           class="control-label">@lang('Numeric Value')</label>
                                    <input type="number" min="0" name="class_number" class="form-control"
                                           value="{{$class->class_number}}" id="classNumber{{$school->id}}"
                                           placeholder="@lang('Numeric Value')" required>
                                    @error('class_number')
                                    <span class="help-block text-danger">
                                       <strong>{{$message}}</strong>
                                     </span>
                                    @enderror
                                </div>
                                {{--<div class="form-group">
                                  <label for="classRoomNumber{{$school->id}}" class="col-sm-4 control-label">{{school('country')->code == 'BD' ? 'Class Room  Number' : 'Grade Room Number '}}</label>
                                  <div class="col-sm-8">
                                    <input type="number" class="form-control" id="classRoomNumber{{$school->id}}" placeholder="{{school('country')->code == 'BD' ? 'Class Room  Number' : 'Grade Room Number '}}">
                                  </div>
                                </div>
                                --}}
                                <div class="form-group">
                                    <label for="classRoomNumber{{$school->id}}"
                                           class="control-label">{{trans(school('country')->code == 'BD' ? 'Class Group (If Any)' : 'Grade Group (If Any) ')}}</label>
                                    <input type="text" class="form-control" value="{{$class->group}}" name="group"
                                           id="classRoomNumber{{$school->id}}"
                                           placeholder="@lang('Science, Commerce, Arts, etc.')">
                                    <span id="helpBlock"
                                          class="help-block" style="margin-left: 15px">{{school('country')->code == 'BD' ? 'Leave Empty if this Class belongs to no Group' : 'Leave Empty if this Grade belongs to no Group '}}
                            </span>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="control-label">@lang('Status')</label>
                                    {!! Form::select('status',status(),$class->status,array('id' => 'status', 'class' => 'form-control', 'placeholder' => trans('Select'),'required')) !!}
                                </div>
                                <div class="form-group col-md-4 pl-0">
                                    <button type="submit" class="{{btnClass()}}">@lang('Update')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection