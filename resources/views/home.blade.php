@extends('layouts.app')

@section('content')
    <style>
        .panel {
            background: none !important;
        }

        #main-container .panel.panel-default {
            margin-top: 0px;
            padding-top: 0px;
        }

        .card-body {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-body .d-ico {
            padding: 5px;
            width: 80px;
            height: 80px;
            border-radius: 10px;
            background-color: rgba(185, 255, 255, 0.3);
        }

        .card-body .d-con {
            padding: 10px;
        }

        .card {
            height: 140px !important;
        }

        .home-row {
            padding-bottom: 30px;
        }

        .cardFSU {
            font-size: 16px !important;
            font-weight: bold !important;
        }

        .cardFSD {
            font-size: 13px;
            font-weight: bold !important;
        }

        .brush {
            width: 277px;
            height: 53px;
            transform: rotate(187deg);
            position: absolute;
        }

        .tt {
            position: relative;
            top: 4px;
            left: 25px;
            margin-bottom: 40px !important;
        }

        .noticesB {
            box-shadow: 0px 0px 32px 0px #00000027;
        }

        .noticesB strong {
            font-size: 17px;
        }

        .noticesB .n-card {
            padding: 5px 10px 0px 10px;
        }

        .noticesB .n-title {
            display: flex;
            justify-content: start;
        }

        .list-group-item-heading {
            font-weight: bold !important;
        }

        .chartsCon {
            padding: 50px;
            background: #ffffff;
            border-radius: 10px;
            margin-bottom: 70px;
            box-shadow: 0px 0px 32px 0px #00000027;
        }

        h3 {
            margin-bottom: 8px !important;
        }

        b {
            font-size: 21px;
        }

        #main-container {
            height: 100% !important;
        }

        h4 {
            font-weight: bold;
            margin-left: 15px;
        }

        a:hover {
            text-decoration: none;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10 pdlr-6" id="main-container">
                <div class="panel panel-default" style="border-top: 0px;">
                    <div class="panel-body pt-0">
                        @if (Auth::user()->role == 'admin')
                            <div class="row home-row">
                                @include('components.pages-bar', ['pageTitle' => 'Dashboard'])
                                <img class="brush" src="{{ asset('image/brush2.png') }}" alt="section photo"
                                     srcset="">
                                <h4 class="tt">@lang('School Management')</h4>
                                <div class="col-sm-3">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            {{-- <i class="fas fa-graduation-cap bg-primary"></i> --}}
                                            <img class="d-ico" src="{{ asset('image/student.svg') }}" alt="student photo"
                                                 srcset="">
                                            <div class="clearfix"></div>
                                            <div class="d-con">
                                                <span class="cardFSU">@lang('Students')</span>
                                                <h3><b>{{ $totalStudents-13 }}</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            {{-- <i class="fas fa-laptop bg-success text-white"></i> --}}
                                            <img class="d-ico" src="{{ asset('image/teacherM.png') }}" alt="teacher photo"
                                                 srcset="">
                                            <div class="clearfix"></div>
                                            <div class="d-con">
                                                <span class="cardFSU">@lang('Teachers')</span>
                                                <h3><b>{{ $totalTeachers }}</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            {{-- <i class="fas fa-list bg-danger text-white"></i> --}}
                                            <img class="d-ico" src="{{ asset('image/class.png') }}" alt="class photo"
                                                 srcset="">
                                            <div class="clearfix"></div>
                                            <div class="d-con">
                                                <span class="cardFSU">@lang('Classes')</span>
                                                <h3><b>{{ $totalClasses }}</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <img class="d-ico" src="{{ asset('image/section.png') }}" alt="section photo"
                                                 srcset="">
                                            <div class="clearfix"></div>
                                            <div class="d-con">
                                                <span class="cardFSU">@lang('Sections')</span>
                                                <h3><b>{{ $totalSections }}</b></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row home-row">
                                <img class="brush" style="opacity: 0.7;" src="{{ asset('image/brush.png') }}"
                                     alt="brush" srcset="">
                                <h4 class="tt">@lang('Financial Management')</h4>
                                <div class="col-sm-3">
                                    <a href="{{ route('fees.create') }}">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <img class="d-ico" src="{{ asset('image/tution.png') }}"
                                                     alt="Tution photo" srcset="">
                                                <div class="clearfix"></div>
                                                <div class="d-con">
                                                    <strong class="cardFSU">@lang('Tution Fee')</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('payroll.index.process', 'first') }}">
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <img class="d-ico" src="{{ asset('image/payroll.png') }}"
                                                     alt="Payroll photo" srcset="">
                                                <div class="clearfix"></div>
                                                <div class="d-con">
                                                    <strong class="cardFSU">@lang('Payroll')</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('accounts.income.index') }}">
                                        <div class="card mb-3">
                                            <div class="card-body" style="padding-left: 45px;">
                                                <img class="d-ico" src="{{ asset('image/account.png') }}"
                                                     alt="account photo" srcset="">
                                                <div class="clearfix"></div>
                                                <div class="d-con">
                                                    <strong class="cardFSU">Add Income </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-3">
                                    <a href="{{ route('accounts.expense.index')}}">
                                        <div class="card mb-3">
                                            <div class="card-body" style="padding-left: 45px;">
                                                <img class="d-ico" src="{{ asset('image/bale.png') }}"
                                                     alt="Balance photo" srcset="">
                                                <div class="clearfix"></div>
                                                <div class="d-con">
                                                    <strong class="cardFSU">@lang('Add Expense')</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-3">
                                    <a href="">
                                        <div class="card mb-3">
                                            <div class="card-body" style="padding-left: 45px;">
                                                <img class="d-ico" src="{{ asset('image/doller.png') }}"
                                                     alt="Cash + Bank photo" srcset="">
                                                <div class="clearfix"></div>
                                                <div class="d-con">
                                                    <span class="cardFSU">
                                                        @lang('S$ Avail.')
                                                    </span>
                                                    <h3>
                                                        <b>
                                                            {{ number_format($all_amount, 2) }}
                                                        </b>
                                                    </h3>
                                                    <span class="cardFSD">@lang('Cash + Bank')</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-3">
                                    <a href="">
                                        <div class="card mb-3">
                                            <div class="card-body" style="padding-left: 45px;">
                                                <img class="d-ico" src="{{ asset('image/minus.png') }}"
                                                     alt="Expense photo" srcset="">
                                                <div class="clearfix"></div>
                                                <div class="d-con">
                                                    <span class="cardFSU">
                                                        @lang('Expense')
                                                    </span>
                                                    <h3>
                                                        <b>
                                                            {{ number_format($current_expense, 2) }}
                                                        </b>
                                                    </h3>
                                                    <span class="cardFSD">@lang('Current Month')</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-3">
                                    <a href="">
                                        <div class="card mb-3">
                                            <div class="card-body" style="padding-left: 45px;">
                                                <img class="d-ico" src="{{ asset('image/add.png') }}"
                                                     alt="Income photo" srcset="">
                                                <div class="clearfix"></div>
                                                <div class="d-con">
                                                    <span class="cardFSU">
                                                        @lang('Income')
                                                    </span>
                                                    <h3>
                                                        <b>
                                                            {{ number_format($current_income, 2) }}
                                                        </b>
                                                    </h3>
                                                    <span class="cardFSD">@lang('Current Month')</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-sm-3">
                                    <a href="">
                                        <div class="card mb-3">
                                            <div class="card-body" style="padding-left: 45px;">
                                                <img class="d-ico"
                                                     src="{{ $current_income - $current_expense > 0 ? asset('image/profit.png') : asset('image/loss.png') }}"
                                                     alt="section photo" srcset="">
                                                <div class="clearfix"></div>
                                                <div class="d-con">
                                                    <span class="cardFSU"
                                                          style="{{ $current_income - $current_expense > 0 ? 'color:green;' : 'color:red;' }}font-size: 18px;">{{ $current_income - $current_expense > 0 ? 'Profit' : 'Loss' }}</span>
                                                    <h3>
                                                        <b
                                                                style="{{ $current_income - $current_expense > 0 ? 'color:green;' : 'color:red;' }}">
                                                            {{ number_format($current_income - $current_expense, 2) }}
                                                        </b>
                                                    </h3>
                                                    <span class="cardFSD">
                                                        @lang('Current Month')
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12 all-chart">
                                <div class="chartsCon">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4>Revenue Chart {{ now()->year }}</h4>
                                            <div id="chart1"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a href="{{ route('accounts.incomeexpense') }}">
                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <img class="d-ico" src="{{ asset('image/add.png') }}"
                                                                     alt="Income photo" srcset="">
                                                                <div class="clearfix"></div>
                                                                <div class="d-con">
                                                                    <span class="cardFSU">
                                                                        @lang('Yearly Income')
                                                                    </span>
                                                                    <h3>
                                                                        <b>
                                                                            {{ number_format($current_year_income, 2) }}
                                                                        </b>
                                                                    </h3>
                                                                    <span class="cardFSD">@lang('Current Year')</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-md-12">
                                                    <a href="{{ route('accounts.incomeexpense') }}">
                                                        <div class="card mb-3">
                                                            <div class="card-body">
                                                                <img class="d-ico" src="{{ asset('image/minus.png') }}"
                                                                     alt="Expense photo" srcset="">
                                                                <div class="clearfix"></div>
                                                                <div class="d-con">
                                                                    <span class="cardFSU">
                                                                        @lang('Yearly Expense')
                                                                    </span>
                                                                    <h3>
                                                                        <b>
                                                                            {{ number_format($current_year_expense, 2) }}
                                                                        </b>
                                                                    </h3>
                                                                    <span class="cardFSD">@lang('Current Year')</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="panel panel-default custom-panel noticesB">
                                    <div class="n-card">
                                        <div style="display: flex;">
                                            <div class="page-panel-title font-14-5 btnn n-title">
                                                <img style="width: 10%; margin-right: 10px;"
                                                     src="{{ asset('image/notices.png') }}" alt="Notices"
                                                     srcset="">
                                                <strong>@lang('Notices')</strong>
                                            </div>
                                            <div>
                                                @if (Auth::user()->role == 'admin')
                                                    <a href="{{ route('academic.notice.create') }}"
                                                       class="btn btn-link pull-right font-14-5 btnns"><strong>@lang('Add New')</strong></a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="panel-body {{ count($notices) > 0 ? 'pre-scrollable' : '' }}">
                                        @if (count($notices) > 0)
                                            <div class="list-group">
                                                @foreach ($notices as $notice)
                                                    <a href="{{ url($notice->file_path) }}"
                                                       class="list-group-item border-b" download>
                                                        <i class="badge badge-download material-icons">
                                                            get_app
                                                        </i>
                                                        <h5 class="list-group-item-heading">{{ $notice->title }}</h5>
                                                        <p class="list-group-item-text">@lang('Published at'):
                                                            {{ $notice->created_at->format('M d Y h:i:sa') }}</p>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @else
                                            <div style="padding-left: 6px;text-align: center;margin-top: 20%;">
                                                @lang('No New Notice')
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="panel panel-default">
                                    <div class="page-panel-title">@lang('Active Exams')</div>
                                    <div class="panel-body">
                                        @if (count($exams) > 0)
                                            <table class="table">
                                                <tr>
                                                    <th>@lang('Exam Name')</th>
                                                    <th>@lang('Notice Published')</th>
                                                    <th>@lang('Result Published')</th>
                                                </tr>
                                                @foreach ($exams as $exam)
                                                    <tr>
                                                        <td>{{$exam->exam_name}}</td>
                                                        <td>{{($exam->notice_published === 1)?__('Yes'):__('No')}}</td>
                                                        <td>{{($exam->result_published === 1)?__('Yes'):__('No')}}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        @else
                                            @lang('No Active Examination')
                                        @endif
                                    </div>
                                </div> --}}
                            </div>
                            <div class="col-sm-6">
                                <div class="panel panel-default custom-panel noticesB">
                                    <div class="n-card">
                                        <div style="display: flex;">
                                            <div class="page-panel-title font-14-5 btnn n-title">
                                                <img style="width: 10%; margin-right: 10px;"
                                                     src="{{ asset('image/notices.png') }}" alt="Events"
                                                     srcset="">
                                                <strong>@lang('Events')</strong>
                                            </div>
                                            <div>
                                                @if (Auth::user()->role == 'admin')
                                                    <a href="{{ route('academic.event.create') }}"
                                                       class="btn btn-link pull-right font-14-5 btnns"><strong>@lang('Add New')</strong></a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="panel-body {{ count($events) > 0 ? 'pre-scrollable' : '' }}">
                                        @if (count($events) > 0)
                                            <div class="list-group">
                                                @foreach ($events as $event)
                                                    <a href="{{ url($event->file_path ?? '') }}"
                                                       class="list-group-item border-b" download>
                                                        <i class="badge badge-download material-icons">
                                                            get_app
                                                        </i>
                                                        <h5 class="list-group-item-heading">{{ $event->title }}</h5>
                                                        <p class="list-group-item-text">@lang('Published at'):
                                                            {{ $event->created_at->format('M d Y') }}</p>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @else
                                            <div style="padding-left: 6px;text-align: center;margin-top: 20%;">
                                                @lang('No New Event')
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="panel panel-default custom-panel noticesB">
                                    <div class="n-card">
                                        <div style="display: flex;">
                                            <div class="page-panel-title font-14-5 btnn n-title">
                                                <img style="width: 10%; margin-right: 10px;"
                                                     src="{{ asset('image/notices.png') }}" alt="Routines"
                                                     srcset="">
                                                <strong>@lang('Routines')</strong>
                                            </div>
                                            <div>
                                                @if (Auth::user()->role == 'admin')
                                                    <a href="{{ route('academic.routine.index') }}"
                                                       class="btn btn-link pull-right font-14-5 btnns"><strong>@lang('Add New')</strong></a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="panel-body {{ count($routines) > 0 ? 'pre-scrollable' : '' }}">
                                        @if (count($routines) > 0)
                                            <div class="list-group">
                                                @foreach ($routines as $routine)
                                                    <a href="{{ url($routine->file_path) }}"
                                                       class="list-group-item border-b" download>
                                                        <i class="badge badge-download material-icons">
                                                            get_app
                                                        </i>
                                                        <h5 class="list-group-item-heading">{{ $routine->title }}</h5>
                                                        <p class="list-group-item-text">@lang('Published at'):
                                                            {{ $routine->created_at->format('M d Y') }}</p>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @else
                                            <div style="padding-left: 6px;text-align: center;margin-top: 20%;">
                                                @lang('No New Routine')
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="panel panel-default custom-panel noticesB">
                                    <div class="n-card">
                                        <div style="display: flex;">
                                            <div class="page-panel-title font-14-5 btnn n-title">
                                                <img style="width: 10%; margin-right: 10px;"
                                                     src="{{ asset('image/notices.png') }}" alt="Syllabus"
                                                     srcset="">
                                                <strong>@lang('Syllabus')</strong>
                                            </div>
                                            <div>
                                                @if (Auth::user()->role == 'admin')
                                                    <a href="{{ route('academic.syllabus.index') }}"
                                                       class="btn btn-link pull-right font-14-5 btnns"><strong>@lang('Add New')</strong></a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="panel-body {{ count($syllabuses) > 0 ? 'pre-scrollable' : '' }}">
                                        @if (count($syllabuses) > 0)
                                            <div class="list-group">
                                                @foreach ($syllabuses as $syllabus)
                                                    <a href="{{ url($syllabus->file_path) }}"
                                                       class="list-group-item border-b" download>
                                                        <i class="badge badge-download material-icons">
                                                            get_app
                                                        </i>
                                                        <h5 class="list-group-item-heading">{{ $syllabus->title }}</h5>
                                                        <p class="list-group-item-text">@lang('Published at'):
                                                            {{ $syllabus->created_at->format('M d Y') }}</p>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @else
                                            <div style="padding-left: 6px;text-align: center;margin-top: 20%;">
                                                @lang('No New Syllabus')
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app2.min.js') }}"></script>
    <script src="{{ asset('js/apexcharts.min.js') }}"></script>
@endsection
@section('after_scripts')
    <script>
        "use strict";

        $(function() {
            chart1();

            // select all on checkbox click
            $("[data-checkboxes]").each(function() {
                var me = $(this),
                    group = me.data('checkboxes'),
                    role = me.data('checkbox-role');

                me.change(function() {
                    var all = $('[data-checkboxes="' + group +
                            '"]:not([data-checkbox-role="dad"])'),
                        checked = $('[data-checkboxes="' + group +
                            '"]:not([data-checkbox-role="dad"]):checked'),
                        dad = $('[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'),
                        total = all.length,
                        checked_length = checked.length;

                    if (role == 'dad') {
                        if (me.is(':checked')) {
                            all.prop('checked', true);
                        } else {
                            all.prop('checked', false);
                        }
                    } else {
                        if (checked_length >= total) {
                            dad.prop('checked', true);
                        } else {
                            dad.prop('checked', false);
                        }
                    }
                });
            });



        });



        function chart1() {
            var options = {
                chart: {
                    height: 230,
                    type: "line",
                    shadow: {
                        enabled: true,
                        color: "#000",
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 1
                    },
                    toolbar: {
                        show: false
                    }
                },
                colors: ["#e74c3c", "#2ecc71","#f1c40f"],
                dataLabels: {
                    enabled: true
                },
                stroke: {
                    curve: "smooth"
                },
                series: [{
                    name: "Expense",
                    data: [<?php echo $expenseport; ?>]
                },
                    {
                        name: "Income : Student ",
                        data: [<?php echo $all_payments; ?>]
                    },
                    {
                        name: "Income : Other",
                        data: [<?php echo $all_incomes; ?>]
                    }
                ],
                grid: {
                    borderColor: "#e7e7e7",
                    row: {
                        colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
                        opacity: 0.0
                    }
                },
                markers: {
                    size: 6
                },
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",  "Aug", "Sep", "Oct","Nov", "Dec"],

                    labels: {
                        style: {
                            colors: "#9aa0ac"
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: "Income & Expense"
                    },
                    labels: {
                        style: {
                            color: "#9aa0ac"
                        }
                    },
                    min: 1000,
                    max: 50000
                },
                legend: {
                    position: "top",
                    horizontalAlign: "right",
                    floating: true,
                    offsetY: -25,
                    offsetX: -5
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart1"), options);

            chart.render();
        }
    </script>
@endsection