@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default ptlb-515">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="sfborder">
                                <div class="col-md-2">
                                    @if(!empty($user->pic_path))
                                    <img class="profile-user-img img-responsive img-circle"
                                         src="{{url($user->pic_path)}}"
                                         alt="User profile picture">
                                    @else
                                    <img class="profile-user-img img-responsive img-circle"
                                         src="{{asset('img/profile.png')}}"
                                         alt="User profile picture">
                                    @endif
                                </div>
                                <div class="col-md-10">
                                    <div class="row">

                                        <table class="table table-striped mb0 font13">
                                            <tbody>
                                            <tr>
                                                <th class="bozero">@lang('Name')</th>
                                                <td class="bozero">{{$user->name}}</td>

                                                <th class="bozero">@lang('Class')-@lang('Section')</th>
                                                <td class="bozero">{{$user->section->class->name}} - {{$user->section->section_number}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('Father Name')</th>
                                                <td>{{$user->studentInfo['father_name']}}</td>

                                                <th>@lang('Mother Name')</th>
                                                <td>{{$user->studentInfo['mother_name']}}</td>

                                            </tr>
                                            <tr>
                                                <th>@lang('Mobile Number')</th>
                                                <td>{{$user->phone_number}}</td>
                                                <th>@lang('Roll Number')</th>
                                                <td>{{$user->studentInfo['class_roll']}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('Blood Group')</th>
                                                <td>
                                                    @if(isset($user->blood_group))
                                                        {{bloodgroup($user->blood_group,true)}}
                                                    @endif
                                                </td>
                                                <th>@lang('Session')</th>
                                                <td> @isset($user->studentInfo['session'])  {{getSessionById($user->studentInfo['session'],'schoolyear')}}@endisset </td>
                                            </tr>

                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div style="background: #dadada; height: 1px; width: 100%; clear: both; margin-bottom: 10px;"></div>
                        </div>
                        <div class="col-md-12">
                            @include('students.ac_element')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .profile-user-img {
            margin: 5px auto;
            width: 100px;
            padding: 3px;
            border: 3px solid #d2d6de;
        }
    </style>
@endsection

