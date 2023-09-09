@extends('layouts.app')

@section('title', __('Admit Card'))
@section('content')
    @component('components.cropper.template',['type'=>'squre','table_name'=>'templete_designs','table_id'=>'add']) @endcomponent
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('exams').'">'. trans('Exams').'</a>  / <b>'. trans('Template Design').'<b>'])
                @include('components.sectionbar.examination-bar')

                <div class="col-md-6 pl-0">
                    <div class="panel panel-default pt-0">
                        <div class="panel-heading">@lang('Arrange a new template')</div>
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
                            <div class="">
                                @isset($template->id)
                                    {!! Form::model($template, ['route' => ['academic.template.update', $template->id], 'method' => 'patch','enctype'=>'multipart/form-data','class'=>'form1']) !!}
                                @else
                                    {!! Form::open(['route' => 'academic.template.store', 'method' => 'post','enctype'=>'multipart/form-data','class'=>'form1','autocomplete'=>'off']) !!}
                                @endisset
                                @include('admitcard.element')
                                <div class="">
                                    <button type="submit" class="{{btnClass()}}">
                                        @isset($template->id)
                                            @lang('Update')
                                        @else
                                            @lang('Save')
                                        @endisset
                                    </button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 p-0">
                    <div class="panel panel-default pt-0">
                        <div class="panel-heading">@lang('Template List')</div>
                        <div class="panel-body">
                            <div class="">
                                <div class="table-responsive mailbox-messages">
                                    <div class="download_label"> @lang('Template List')</div>
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                                        <!--                                    <div class="dt-buttons btn-group btn-group2">
                                                                                <a class="btn btn-default dt-button buttons-copy buttons-html5" tabindex="0"
                                                                                   aria-controls="DataTables_Table_0" href="#" title="Copy"><span><i
                                                                                                class="fa fa-files-o"></i></span></a>

                                                                                <a class="btn btn-default dt-button buttons-excel buttons-html5" tabindex="0"
                                                                                   aria-controls="DataTables_Table_0" href="#" title="Excel"><span><i
                                                                                                class="fa fa-file-excel-o"></i></span></a>

                                                                                <a class="btn btn-default dt-button buttons-csv buttons-html5" tabindex="0"
                                                                                   aria-controls="DataTables_Table_0" href="#" title="CSV"><span><i
                                                                                                class="fa fa-file-text-o"></i></span></a>

                                                                                <a class="btn btn-default dt-button buttons-pdf buttons-html5" tabindex="0"
                                                                                   aria-controls="DataTables_Table_0" href="#" title="PDF"><span><i
                                                                                                class="fa fa-file-pdf-o"></i></span></a>

                                                                                <a class="btn btn-default dt-button buttons-print" tabindex="0"
                                                                                   aria-controls="DataTables_Table_0" href="#" title="Print"><span><i
                                                                                                class="fa fa-print"></i></span></a>

                                                                                <a class="btn btn-default dt-button buttons-collection buttons-colvis"
                                                                                   tabindex="0" aria-controls="DataTables_Table_0" href="#"
                                                                                   title="Columns"><span><i class="fa fa-columns"></i></span></a>
                                                                            </div>
                                                                            <div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input
                                                                                            type="search" class="" placeholder="Search..."
                                                                                            aria-controls="DataTables_Table_0"></label>
                                                                            </div>-->
                                        @if (count($templetes)>0)
                                            <div class="table-responsive">
                                                <table class="table-bordered table-data-div table-condensed table-striped table-hover">
                                                    <thead>
                                                    <tr role="row">
                                                        <th class="sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Certificate Name: activate to sort column ascending"
                                                            style="width: 256px;">#
                                                        </th>
                                                        <th class="sorting_asc" tabindex="0"
                                                            aria-controls="DataTables_Table_0"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Background Image: activate to sort column descending"
                                                            style="width: 281px;"
                                                            aria-sort="ascending">@lang('Template Name')
                                                        </th>
                                                        <th class="sorting_asc" tabindex="0"
                                                            aria-controls="DataTables_Table_0"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Background Image: activate to sort column descending"
                                                            style="width: 281px;" aria-sort="ascending">@lang('Status')
                                                        </th>
                                                        <th class="sorting_asc" tabindex="0"
                                                            aria-controls="DataTables_Table_0"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Background Image: activate to sort column descending"
                                                            style="width: 281px;"
                                                            aria-sort="ascending">@lang('Template Type')
                                                        </th>

                                                        <th class="text-right sorting" tabindex="0"
                                                            aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                            aria-label="Action: activate to sort column ascending"
                                                            style="width: 157px;">@lang('Action')
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($templetes as $key=>$result)
                                                        <tr role="row" class="odd">
                                                            <th scope="row">{{  $key + 1 }}</th>
                                                            <td class="mailbox-name">
                                                                <a style="cursor: pointer;" target="_blank"
                                                                   href="{{route('academic.template.show',[$result->id,renderSlug($result->name)])}}"
                                                                   class="view_data" id="4" title="">{{$result->name}}
                                                                </a>
                                                            </td>
                                                            <td class="mailbox-name">
                                                                <small>
                                                                    {{$result->status == 1 ? 'Active' : 'Inactive'}}
                                                                </small>
                                                            </td>
                                                            <td class="mailbox-name">
                                                                <small>
                                                                    {{$result->type == 1 ? 'Admission' : ( $result->type == 2 ? 'Examination ' : 'Marksheet' ) }}
                                                                </small>
                                                            </td>
                                                            <td class="mailbox-date text-right no-print">
                                                                {{--
                                                                <a id="4" class="btn btn-default btn-xs view_data" title="View">
                                                                    <i class="fa fa-reorder"></i>
                                                                </a>
                                                                --}}
                                                                <a class="btn btn-xs foqas-btn"
                                                                   href="{{route('academic.template.edit',$result->id)}}"><i
                                                                            class="fa fa-pencil"></i></a>

                                                                <a class="btn btn-xs btn-danger"
                                                                   onclick="confirm_delete('{{$result->id}}')"><i
                                                                            class="fa fa-trash"></i></a>

                                                                <form id="delete_form_{{$result->id}}"
                                                                      action="{{route('academic.template.destroy',$result->id)}}"
                                                                      method="POST" style="display: none;">
                                                                    {{ csrf_field() }}
                                                                    @method('DELETE')
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status"
                                                 aria-live="polite"></div>
                                        @else
                                            <div class="panel-body">
                                                @lang('No Related Data Found.')
                                            </div>
                                        @endif
                                    </div><!-- /.table -->
                                </div><!-- /.mail-box-messages -->
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#examdate').datepicker({
                format: "dd-mm-yyyy",
                viewMode: "days",
                minViewMode: "days",
                autoclose: true,
            });

        });
        /* $(function () {
             $('#date').datepicker({
                 format: "dd-mm-yyyy",
                 viewMode: "days",
                 minViewMode: "days",
                 autoclose: true,
             });

         });
 */
        $(function () {
            $("#lsign_title").click(function () {
                if ($(this).is(":checked")) {
                    $("#lsign1").show();
                    $("#lsign_titletxt").prop("disabled", false);

                } else {
                    $("#lsign1").hide();
                    $("#lsign_titletxt").prop("disabled", true);

                }
            });
            $("#msign_title").click(function () {
                if ($(this).is(":checked")) {
                    $("#lsign2").show();
                    $("#msign_titletxt").prop("disabled", false);

                } else {
                    $("#lsign2").hide();

                    $("#msign_titletxt").prop("disabled", true);
                }
            });
            $("#rsign_title").click(function () {
                if ($(this).is(":checked")) {
                    $("#lsign3").show();
                    $("#rsign_titletxt").prop("disabled", false);

                } else {
                    $("#lsign3").hide();
                    $("#rsign_titletxt").prop("disabled", true);

                }
            });
        });
        /*function changeFunc() {
             var type = document.getElementById("type");
             var selectedValue = type.options[type.selectedIndex].value;
             if (selectedValue == 4){

               $('#div2').hide();
               $('#div4').hide();
               $('#div5').hide();
               $('#div7').hide();
               $('#div8').hide();
               $('#div9').hide();
               $('#div10').hide();
               $('#div12').hide();
               $('#div15').hide();
               $('#div18').hide();
               $('#div20').hide();
               $('#div21').hide();
               $('#div22').hide();

                 $('#div1').show();
                 $('#div6').show();
                 $('#div11').show();
                 $('#div13').show();
                 $('#div14').show();
                 $('#div16').show();
                 $('#div17').show();
                 $('#div19').show();

             }else{
               $('#div6').hide();
               $('#div1').show();
               $('#div2').show();
               $('#div4').show();
               $('#div5').show();
               $('#div7').show();
               $('#div8').show();
               $('#div9').show();
               $('#div10').show();
               $('#div12').show();
               $('#div15').show();
               $('#div18').show();
               $('#div20').show();
               $('#div21').show();
               $('#div22').show();
               $('#div11').show();
               $('#div13').show();
               $('#div14').show();
               $('#div16').show();
               $('#div17').show();
               $('#div19').show();


             }
         }
 */


    </script>
    <script src="{{ asset('additional/moment.min.js')}}"></script>
    <script src="{{ asset('additional/bootstrap-datetimepicker.css')}}"></script>
    <script src="{{ asset('additional/bootstrap-datetimepicker.min.js')}}"></script>
@endsection 



