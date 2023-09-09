@extends('public.layout.public',['title' => transMsg($waitingMenu->name) ])
@section('sliderText')
    <h1 class="page-title">{!! transMsg($waitingMenu->name) !!}</h1>
@endsection
@section('content')
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <div id="table-content">
        <style>
            .underline {
                text-decoration: underline;
            }
        </style>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mt-2">
                    @if(foqas_setting('waiting'.$step.'_status') == 1)
                        <span class="pull-left mt-2 ml-2">
                                <button class="btn btn-sm btn-success d-print-none" role="button" id="btnPrint"
                                        onclick="printDiv()"><i class="fa fa-print"></i> @lang('Print')
                                </button>
                            </span>
                        <div class="clearfix"></div>
                        @foreach(admissionClass()->sort() as $key => $value)
                            @if (isset($results[$key]))
                                <div class="">
                                    <div align="center" class="d-print-block">
                                        <h3>{{school('name')}}</h3>
                                        <h5>{{school('address')}}</h5>
                                        @foreach ($results[$key] as $result)
                                            <h5>@lang('Admission Class') : {{$result->class->name}}</h5>
                                            @break
                                        @endforeach
                                        <h5 class="underline">{!! transMsg($waitingMenu->name) !!}</h5>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>@lang('Si')</th>
                                                <th>@lang('Admission Roll')</th>
                                                <th>@lang('Student Name')</th>
                                                <th>@lang("Father's Name")</th>
                                                <th>@lang("Phone")</th>
                                                @if (foqas_setting('admission_show_mark'))
                                                    <th>@lang('Mark')</th>
                                                @endif
                                                <th>@lang('Position')</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($results[$key] as $result)
                                                <tr>
                                                    <td>{{$loop->index+1}}</td>
                                                    <td>{{$result->roll}}</td>
                                                    <td>{{$result->name}}</td>
                                                    <td>{{$result->father_name}}</td>
                                                    <td>{{$result->mobile}}</td>
                                                    @if (foqas_setting('admission_show_mark'))
                                                        <td>{{$result->mark}}</td>
                                                    @endif
                                                    <td>{{convert_ordinary($loop->index+1)}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="clearhight50"></div>
                                <div align="center" class="d-print-block d-none"> Developed by
                                    : {{school('reseller')->name}}
                                </div>
                                <div style="page-break-before: always;"></div>
                            @endif
                        @endforeach
                    @else
                        <div class="alert alert-danger text-center">@lang('Waiting list not published yet')</div>
                    @endif
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
                newWin.document.write('<html><title>@lang("Merit List")</title><link rel="stylesheet" href="{{ asset("css/vendors.css") }}" id="bootswatch-print-id"><body onload="window.print()"><style>#btnPrint{display:none}.d-print-none{display:none}.gradeTable{width:25% !important;top:55px !important;right:10px !important}.clearhight50{clear:both;height:50px}.clearhight25 {clear: both;height: 25px;}.clearhight15 {clear: both}.print_style {border: 1px dashed;position: relative;overflow: auto;padding: 0px 10px;min-height:97%}.div_break{padding: 10px 0;page-break-before: always;}.custom-tabel{background-color: #f0f0f0 !important;} .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{font-size:11px; border: 1px solid #000;padding: 4px;}.table-borderless > thead > tr > th, .table-borderless > tbody > tr > th, .table-borderless > tfoot > tr > th, .table-borderless > thead > tr > td, .table-borderless > tbody > tr > td, .table-borderless > tfoot > tr > td{border: none !important;} </style>' + divToPrint.innerHTML + '</body></html>');
                newWin.document.close();
                setTimeout(function () {
                    newWin.close();
                }, 1000);
            }

            jQuery(document).bind("keyup keydown", function (e) {
                if (e.ctrlKey && e.keyCode == 80) {
                    printDiv();
                    return false;
                }
            });
        </script>
    @endpush
@endsection
