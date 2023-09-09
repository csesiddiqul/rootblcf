@extends('layouts.app')

@section('title', __('Students'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/1/0').'">'. trans('Students').'</a> / <b>'.trans('Student\'s List').'<b>'])
                @php($users ?? array())
                @include('components.sectionbar.student-bar',['users'=>$users])
                <div class="panel panel-default">
                    @if(count($users) > 0)
                        @foreach ($users as $user)
                            @if (Session::has('section-attendance'))
                                <ol class="breadcrumb" style="margin-top: 3%;">
                                    <li><a href="{{url('school/sections?att=1')}}"
                                           style="color:#3b80ef;">@lang('Classes &amp; Sections')</a></li>
                                    <li class="active">{{transMsg(ucfirst($user->role).'s)')}}</li>
                                </ol>
                            @endif
                            @break($loop->first)
                        @endforeach
                        <div class="panel-body pad-top-0 appendHtml">
                            @if(\Route::current()->getName() == 'employee_index')
                            @component('components.users-list',['users'=>$users])
                            @endcomponent
                            @else
                            <div align="center">
                                <img src="{{asset('image/loader1.gif')}}" alt="">
                            </div>
                            @endif
                        </div>

                        @push('script')
                            <script type="text/javascript">
                                @if(\Route::current()->getName() != 'employee_index')
                                $(document).ready(function () {
                                    $.ajax({
                                        type: "POST",
                                        cache: false,
                                        dataType: 'html',
                                        url: '{{url('users/'.Auth::user()->school->code.'/1/0')}}',
                                        async: false,
                                        success: function (data) {
                                            $(".appendHtml").html(data);
                                        }, error: function (xhr, textStatus, thrownError) {
                                            console.log("Something error!!!!")
                                        },
                                    });
                                })
                                @endif
                                $.extend(true, $.fn.dataTable.defaults, {
                                    "bFilter": true,
                                    initComplete: function () {
                                        @if(school('country')->code == 'SG')
                                            this.api().column(4).every(function () {
                                            var column = this;
                                            var select = $('<select><option value="">{{transMsg('Level')}}</option></select>')
                                                .appendTo($(column.header()).empty())
                                                .on('change', function () {
                                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                                });
                                            column.data().unique().sort().each(function (d, j) {
                                                select.append('<option value="' + d + '">' + d + '</option>')
                                            });
                                        });
                                        this.api().column(6).every(function () {
                                            var column = this;
                                            var select = $('<select><option value="">{{transMsg('Nationality')}}</option></select>')
                                                .appendTo($(column.header()).empty())
                                                .on('change', function () {
                                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                                });
                                            column.data().unique().sort().each(function (d, j) {
                                                select.append('<option value="' + d + '">' + d + '</option>')
                                            });
                                        });
                                        this.api().column(11).every(function () {
                                            var column = this;
                                            var select = $('<select><option value="">{{transMsg(school('country')->code == 'BD' || 'SG' ? 'Class' : 'Grade')}}</option></select>')
                                                .appendTo($(column.header()).empty())
                                                .on('change', function () {
                                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                                });
                                            column.data().unique().sort().each(function (d, j) {
                                                select.append('<option value="' + d + '">' + d + '</option>')
                                            });
                                        });
                                        @else
                                            this.api().column(5).every(function () {
                                            var column = this;
                                            var select = $('<select><option value="">{{transMsg(school('country')->code == 'BD' || 'SG' ? 'Class' : 'Grade')}}</option></select>')
                                                .appendTo($(column.header()).empty())
                                                .on('change', function () {
                                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                                });
                                            column.data().unique().sort().each(function (d, j) {
                                                select.append('<option value="' + d + '">' + d + '</option>')
                                            });
                                        });
                                        this.api().column(7).every(function () {
                                            var column = this;
                                            var select = $('<select><option value="">@lang('Section')</option></select>')
                                                .appendTo($(column.header()).empty())
                                                .on('change', function () {
                                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                                });
                                            column.data().unique().sort().each(function (d, j) {
                                                select.append('<option value="' + d + '">' + d + '</option>')
                                            });
                                        });
                                        this.api().column(8).every(function () {
                                            var column = this;
                                            var select = $('<select><option value="">@lang('Gender')</option></select>')
                                                .appendTo($(column.header()).empty())
                                                .on('change', function () {
                                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                                    column.search(val ? '^' + val + '$' : '', true, false).draw();
                                                });
                                            column.data().unique().sort().each(function (d, j) {
                                                select.append('<option value="' + d + '">' + d + '</option>')
                                            });
                                        });
                                        @endif
                                    },
                                });

                            </script>
                        @endpush

                        @component('components.human-tablebar',['users'=>$users])
                        @endcomponent
                    @else
                        <div class="panel-body">
                            @lang('No Related Data Found.')
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
