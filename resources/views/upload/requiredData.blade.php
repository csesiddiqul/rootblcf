@extends('layouts.app')

@section('title', __('Upload'))
@section('content')
    <div class="container{{ (\Auth::user()->role == 'master')? '' : '-fluid' }}">
        <div class="row">
            @if(\Auth::user()->role != 'master')
                <div class="col-md-2" id="side-navbar">
                    @include('layouts.leftside-menubar')
                </div>
            @endif
            <div class="col-md-10" id="main-container">
                @include('components.sectionbar.student-bar')
                @php
                    $courseTN = trans(school('country')->code == 'BD' ? 'Subject' : 'Course');
                @endphp
                <div class="panel ">
                    <div class="panel-body" style="padding-top: 0px !important; " id="table-content">
                        <h4 >@lang('Required excel data')</h4>
                        <span class="pull-right">
                            <button class="btn btn-xs btn-success d-print-none" role="button" id="btnPrint"
                                    onclick="printDiv()"><i class="fa fa-print"></i> @lang('Print')
                            </button>
                        </span>
                        <div class="col-md-6">
                            <h5>{{trans(school('country')->code == 'BD' ? 'Class' : 'Grade')}} & @lang('Section')</h5>
                            @if (count($classes)>0)
                                <div class="table-responsive" id="table1">
                                    <table class="table table-bordered  table-condensed table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th scope="col">{{trans(school('country')->code == 'BD' ? 'Class Name' : 'Grade')}}</th>
                                            <th scope="col">@lang('Group')</th>
                                            <th scope="col">@lang('Section')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($classes as $key=> $class)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$class->name}}</td>
                                                <td>{{$class->group ? $class->group : 'N/A'}}</td>
                                                <td width="50%">
                                                    @php $sections = $class->sections;@endphp
                                                    @if(count($sections)>0)
                                                        <table class="table-condensed">
                                                            @foreach($sections as $section)
                                                                @if(strtolower($section->section_number) != 'admission')
                                                                    <tr>
                                                                        <td width="50%">
                                                                            {{$section->section_number}}
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </table>
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                @lang('There is no '.trans(school('country')->code == 'BD' ? 'Class' : 'Grade'))
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h5>{{$courseTN}} @lang('Group')</h5>
                            @if (count($course_groups)>0)
                                <div class="table-responsive">
                                    <table class="table table-bordered  table-condensed table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th scope="col">{{$courseTN.' Group'}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($course_groups as $key=> $course_group)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$course_group->name}} ({{$course_group->id}})</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                @lang('There is no '.$courseTN.' Group')
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h5>@lang('Blood Group')</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered  table-condensed table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th scope="col">@lang('Blood Group')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(bloodgroup() as $key=> $bg)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$bg}} ({{$key}})</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>@lang('Religion')</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered  table-condensed table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th scope="col">@lang('Religion')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(religon() as $key=> $bg)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$bg}} ({{$key}})</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>@lang('Gender')</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered  table-condensed table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th scope="col">@lang('Gender')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(gender() as $key=> $bg)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$bg}} ({{$key}})</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            function printDiv() {
                var divToPrint = document.getElementById('table-content');
                var newWin = window.open('', 'Print-Window');
                newWin.document.open();
                newWin.document.write('<html><title>@lang("Required excel data")</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>#btnPrint{display:none}.d-print-none{display:none}.table-responsive { overflow-x: unset;}.gradeTable{width:25% !important;top:55px !important;right:10px !important}.clearhight50{clear:both;height:50px}.clearhight25 {clear: both;height: 25px;}.clearhight15 {clear: both}.col-md-6{width:50%;float:left}.print_style {border: 1px dashed;position: relative;overflow: auto;padding: 0px 10px;min-height:97%}.div_break{padding: 10px 0;page-break-before: always;}.custom-tabel{background-color: #f0f0f0 !important;} .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{font-size:11px; border: 1px solid #000;padding: 2.5px;}.table-borderless > thead > tr > th, .table-borderless > tbody > tr > th, .table-borderless > tfoot > tr > th, .table-borderless > thead > tr > td, .table-borderless > tbody > tr > td, .table-borderless > tfoot > tr > td{border: none !important;}</style>' + divToPrint.innerHTML + '</body></html>');
                newWin.document.close();
                setTimeout(function () {
                    newWin.close();
                }, 100);
            }
        </script>
    @endpush
@endsection
