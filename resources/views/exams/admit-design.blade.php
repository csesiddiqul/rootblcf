@extends('layouts.app')

@section('title', __('Add Event'))
@section('content')
<style>
    .TriSea-technologies-Switch > input[type="checkbox"] {
    display: none;   
}

.TriSea-technologies-Switch > label {
    cursor: pointer;
    height: 0px;
    position: relative; 
    width: 40px;  
}

.TriSea-technologies-Switch > label::before {
    background: rgb(0, 0, 0);
    box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
    border-radius: 8px;
    content: '';
    height: 16px;
    margin-top: -8px;
    position:absolute;
    opacity: 0.3;
    transition: all 0.4s ease-in-out;
    width: 40px;
}
.TriSea-technologies-Switch > label::after {
    background: rgb(255, 255, 255);
    border-radius: 16px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
    content: '';
    height: 24px;
    left: -4px;
    margin-top: -8px;
    position: absolute;
    top: -4px;
    transition: all 0.3s ease-in-out;
    width: 24px;
}
.TriSea-technologies-Switch > input[type="checkbox"]:checked + label::before {
    background: inherit;
    opacity: 0.5;
}
.TriSea-technologies-Switch > input[type="checkbox"]:checked + label::after {
    background: inherit;
    left: 20px;
}
    .box {
    position: relative !important;
    border-radius: 3px !important;
    background: #ffffff !important;
    border-top: 3px solid #d2d6de !important;
    margin-bottom: 10px !important;
    width: 100% !important;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1) !important;
}
.box.box-primary {
 
    box-shadow: 0 1px 3px rgba(0,0,0,.12), 0 1px 2px rgba(0,0,0,.24) !important;
}
.ptbnull {
    border-bottom: 1px solid #f4f4f4 !important;
}
.table button.btn-default, .table a.btn-default, .dtr-details a.btn-default, .table button.add-teacher, .table .mailbox-date a.btn-default, .table .pull-right a.btn-default {
    background-color: #fff !important;
    border-radius: 0px !important;
    color: #444 !important;
    outline: none !important;
    border: 0 !important;
}
.skin-blue .main-header .logo, .dropdown-menu>li>a, .btn-default, .sidebar a, .btn-default, .sidebar a, .btn, .btn {
    position: relative;
    overflow: hidden;
}
.table .btn-group-xs>.btn, .btn-xs {
    line-height: 1.3;
}
.box-header {
    color: #444 !important;
    display: block !important;
    padding: 10px !important;
    position: relative !important;
}
.box-header>.fa, .box-header>.glyphicon, .box-header>.ion, .box-header .box-title {
    display: inline-block !important;
    font-size: 18px !important;
    margin: 0 !important;
    line-height: 1 !important;
}
.box-body {
    border-top-left-radius: 0 !important;
    border-top-right-radius: 0 !important;
    border-bottom-right-radius: 3px !important;
    border-bottom-left-radius: 3px !important;
    padding: 10px !important;
}
.download_label {
    display: none !important;
}
.dataTables_wrapper {
    position: relative !important;
    clear: both !important;
    *zoom: 1 !important;
    zoom: 1 !important;
}
div.dt-buttons {
    position: relative !important;

}
div.dt-buttons {
    margin-bottom: 10px !important;
}
.btn-group2 {
   
    z-index: 1 !important;
    padding-left: 10px !important;
    float: right !important !important;
}
.buttons-html5, .buttons-print, .buttons-colvis {
    padding: 2px 8px !important;
}
.btn {

    box-shadow: none !important;
    border: 1px solid transparent !important;
}
button.dt-button, div.dt-button, a.dt-button {
    /*position: relative;*/
    /* float: none !important; */
    display: inline-block !important;
    box-sizing: border-box !important;
    /* margin-right: 0.333em; */
    padding: 2px 6.2px !important;
    /* border: 1px solid #ddd; */
    border-radius: 0px !important;
    cursor: pointer !important;
    font-size: 14px !important;
    color: #444 !important;
    white-space: nowrap !important;
    overflow: hidden !important;
    background-color: #fff !important;
    /*-webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;*/
    user-select: none !important;
    text-decoration: none !important;
    outline: none !important;
    border-top: 0 !important;
    border-left: 0 !important;
    border-right: 0 !important;
    border-bottom: 1px solid #ddd !important;
}
div.dataTables_wrapper div.dataTables_filter {
    text-align: right !important;
}
table.dataTable.no-footer {
    border-bottom: 1px solid #f4f4f4;
}
table.dataTable {
    clear: both;
    margin-top: 6px !important;
    margin-bottom: 6px !important;
    max-width: none !important;
    /* border-collapse: separate !important; */
}
table.dataTable {
    width: 100% !important;
    margin: 0 auto !important;
    clear: both !important;
    /* border-collapse: separate; */
    border-spacing: 0 !important;
}
table.dataTable {
    width: 100% !important;
}
.table-bordered {
    border: 0px solid #e7e7ec !important;
}
div.dt-buttons {
    margin-bottom: 10px;
}
div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
}
div.dt-buttons {
    position: relative;
    float: left;
}
table {
    empty-cells: hide !important;
    color: #444 !important;
}
.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
    border-top: 1px solid #f4f4f4 !important;
}
table.table-bordered.dataTable th:last-child, table.table-bordered.dataTable th:last-child, table.table-bordered.dataTable td:last-child, table.table-bordered.dataTable td:last-child {
    text-align: right !important;
}

.nav-tabs>li.active>a:after, .sidebar a:after, .btn-default:after {
    content: "";
    display: block;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
    
    background-repeat: no-repeat;
    background-position: 50%;
    transform: scale(10, 10);
    opacity: 0;
    transition: transform .5s, opacity 1s;
}
.table .btn-group-xs>.btn, .btn-xs {
    line-height: 1.3;
}
#main-container {
    min-height: 250px;
    padding: 10px;
    margin-right: auto;
    margin-left: auto;
    padding-left: 10px;
    padding-right: 10px;
}
</style>
    @include('components.cropper.multifile_js')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
               
                <div class="row">

                    <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('Add Marksheet')</h3>
                        </div><!-- /.box-header -->

                        <form id="form1" method="POST"
                        action="{{route('academic.submit.admitcard')}}" enctype="multipart/form-data" >
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label>@lang('Template Name')</label><small class="req"> *</small>
                                    <input autofocus="" id="name" value="" name="name" placeholder="" type="text" class="form-control" autocomplete="off" required>
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Heading')</label>
                                    <input autofocus="" id="heading" value="" name="heading" placeholder="" type="text" class="form-control" required>
                                    <span class="text-danger"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label>@lang('Title')</label>
                                    <input autofocus="" id="title" value="" name="title" placeholder="" type="text" class="form-control">
                                    <span class="text-danger"></span>
                                </div>
                             
                                
                                <div class="form-group">
                                    <label>@lang('Exam Name')</label>
                                    <input autofocus="" id="examname" value="" name="examname" placeholder="" type="text" class="form-control" required>
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Exam Center')</label>
                                    <input autofocus="" id="examcenter" value="" name="examcenter" placeholder="" type="text" class="form-control" required>
                                    <span class="text-danger"></span>
                                </div>
                                
                                <div class="form-group">
                                    <label>@lang('Body Text')</label>
                                    <textarea id="bodyText" name="bodyText" type="text" class="form-control"></textarea>
                                 
                                    <span class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>@lang('Footer Text')</label>
                                    <textarea id="footerText" name="footerText" type="text" class="form-control"></textarea>
                                 
                                    <span class="text-danger"></span>
                                </div>
                               
                                
                                 <div class="image-upload form-group">
                                        <label class="control-label upperlabel">
                                            @lang('Left Logo')
                                            <span id="deliMG" onclick="cancelUploadMulti('fileMulti');" style="display: none;" class="myspanRemove">@lang('Remove')</span>
                                        </label>
                                        <label class="btn btn-success btn-sm btn-block uploded-text" for="multiFileUp">@lang('Choose File')
                                        </label>
                                        <input type="file" name="llogo" class="file-upload form-control" id="multiFileUp"> 
                                 <span class="text-danger"></span>
                                </div> 
                                 <div class="image-upload form-group">
                                        <label class="control-label upperlabel">
                                            @lang('Middle Logo')
                                            <span id="deliMG" onclick="cancelUploadMulti('fileMulti');" style="display: none;" class="myspanRemove">@lang('Remove')</span>
                                        </label>
                                        <label class="btn btn-success btn-sm btn-block uploded-text" for="multiFileUp">@lang('Choose File')
                                        </label>
                                        <input type="file" name="mlogo" class="file-upload form-control" id="multiFileUp"> 
                                 <span class="text-danger"></span>
                                </div>
                                <div class="clearfix"></div>

                                <div class="image-upload form-group">
                                        <label class="control-label upperlabel">
                                            @lang('Right Logo')
                                            <span id="deliMG" onclick="cancelUploadMulti('fileMulti');" style="display: none;" class="myspanRemove">@lang('Remove')</span>
                                        </label>
                                        <label class="btn btn-success btn-sm btn-block uploded-text" for="multiFileUp">@lang('Choose File')
                                        </label>
                                        <input type="file" name="rlogo" class="file-upload form-control" id="multiFileUp"> 
                                 <span class="text-danger"></span>
                                </div>
                               
                                <div class="image-upload form-group">
                                        <label class="control-label upperlabel">
                                            @lang('Left Signature')
                                            <span id="deliMG" onclick="cancelUploadMulti('fileMulti');" style="display: none;" class="myspanRemove">@lang('Remove')</span>
                                        </label>
                                        <label class="btn btn-success btn-sm btn-block uploded-text" for="multiFileUp">@lang('Choose File')
                                        </label>
                                        <input type="file" name="lsign" class="file-upload form-control" id="multiFileUp"> 
                                 <span class="text-danger"></span>
                                </div>
                                <div class="image-upload form-group">
                                        <label class="control-label upperlabel">
                                            @lang('Middle Signature')
                                            <span id="deliMG" onclick="cancelUploadMulti('fileMulti');" style="display: none;" class="myspanRemove">@lang('Remove')</span>
                                        </label>
                                        <label class="btn btn-success btn-sm btn-block uploded-text" for="multiFileUp">@lang('Choose File')
                                        </label>
                                        <input type="file" name="msign" class="file-upload form-control" id="multiFileUp"> 
                                 <span class="text-danger"></span>
                                </div>
                                 <div class="image-upload form-group">
                                        <label class="control-label upperlabel">
                                            @lang('Right Signature')
                                            <span id="deliMG" onclick="cancelUploadMulti('fileMulti');" style="display: none;" class="myspanRemove">@lang('Remove')</span>
                                        </label>
                                        <label class="btn btn-success btn-sm btn-block uploded-text" for="multiFileUp">@lang('Choose File')
                                        </label>
                                        <input type="file" name="rsign" class="file-upload form-control" id="multiFileUp"> 
                                 <span class="text-danger"></span>
                                </div>
                                 <div class="image-upload form-group">
                                        <label class="control-label upperlabel">
                                            @lang('Background Image')
                                            <span id="deliMG" onclick="cancelUploadMulti('fileMulti');" style="display: none;" class="myspanRemove">@lang('Remove')</span>
                                        </label>
                                        <label class="btn btn-success btn-sm btn-block uploded-text" for="multiFileUp">@lang('Choose File')
                                        </label>
                                        <input type="file" name="bgimg" class="file-upload form-control" id="multiFileUp"> 
                                 <span class="text-danger"></span>
                                </div>

                                <ul class="list-group">
                                    <li class="list-group-item">
                                        @lang('Name')
                                        <div class="TriSea-technologies-Switch pull-right">
                                            <input id="is_name" name="is_name" type="checkbox" value="1" />
                                            <label for="is_name" class="label-default"></label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        @lang('Father Name')
                                        <div class="TriSea-technologies-Switch pull-right">
                                            <input id="is_fname" name="is_fname" type="checkbox" value="1" />
                                            <label for="is_fname" class="label-default"></label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        @lang('Mother Name')
                                        <div class="TriSea-technologies-Switch pull-right">
                                            <input id="is_mname" name="is_mname" type="checkbox" value="1" />
                                            <label for="is_mname" class="label-default"></label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        @lang('E-Mail')
                                        <div class="TriSea-technologies-Switch pull-right">
                                            <input id="is_email" name="is_email" type="checkbox" value="1" />
                                            <label for="is_email" class="label-default"></label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        @lang('Phone')
                                        <div class="TriSea-technologies-Switch pull-right">
                                            <input id="is_phone" name="is_phone" type="checkbox" value="1" />
                                            <label for="is_phone" class="label-default"></label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        @lang('Student Photo')
                                        <div class="TriSea-technologies-Switch pull-right">
                                            <input id="is_photo" name="is_photo" type="checkbox" value="1" />
                                            <label for="is_photo" class="label-default"></label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        @lang('Address')
                                        <div class="TriSea-technologies-Switch pull-right">
                                            <input id="is_address" name="is_address" type="checkbox" value="1" />
                                            <label for="is_address" class="label-default"></label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        @lang('Admission ID')
                                        <div class="TriSea-technologies-Switch pull-right">
                                            <input id="is_admission_id" name="is_admission_id" type="checkbox" value="1" />
                                            <label for="is_admission_id" class="label-default"></label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        @lang('Student ID')
                                        <div class="TriSea-technologies-Switch pull-right">
                                            <input id="is_st_id" name="is_st_id" type="checkbox" value="1" />
                                            <label for="is_st_id" class="label-default"></label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        @lang('Class')
                                        <div class="TriSea-technologies-Switch pull-right">
                                            <input id="is_class" name="is_class" type="checkbox" value="1" />
                                            <label for="is_class" class="label-default"></label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        @lang('Section')
                                        <div class="TriSea-technologies-Switch pull-right">
                                            <input id="is_section" name="is_section" type="checkbox" value="1" />
                                            <label for="is_section" class="label-default"></label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        @lang('Session')
                                        <div class="TriSea-technologies-Switch pull-right">
                                            <input id="is_session" name="is_session" type="checkbox" value="1" />
                                            <label for="is_session" class="label-default"></label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        @lang('Left Signature Title')
                                        <div class="TriSea-technologies-Switch pull-right">
                                            <input id="lsign_title" name="lsign_title" type="checkbox" value="1" />
                                            <label for="lsign_title" class="label-default"></label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        @lang('Middle Signature Title')
                                        <div class="TriSea-technologies-Switch pull-right">
                                            <input id="msign_title" name="msign_title" type="checkbox" value=" 1" />
                                            <label for="msign_title" class="label-default"></label>
                                        </div>
                                    </li> 
                                    <li class="list-group-item">
                                       @lang('Right Signature Title')
                                        <div class="TriSea-technologies-Switch pull-right">
                                            <input id="rsign_title" name="rsign_title" type="checkbox" value="1" />
                                            <label for="rsign_title" class="label-default"></label>
                                        </div>
                                    </li>
                                </ul>
                                       
                                <div class="form-group ">
                                    
                                      <label>@lang('Choose Page:') </label>
                                   <label class="radio-inline" for="a4">
                                    {{ Form::radio('page', 'a4', true, ['id'=>'a4'])}}
                                    A4 Page</label>
                                   
                                   <label class="radio-inline" for="a5">
                                    {{ Form::radio('page', 'a5', false, ['id'=>'a5'])}}
                                    A5 Page</label>
                                    

                                </div>

                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                <label for="status" class="col-md-4 control-label">* @lang('Status')</label>
                              

                                    {!! Form::select('status',status(), old('status'), array('id' => 'status', 'class' => 'form-control', 'placeholder' => trans('Choose'),'required')) !!}
                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                    @endif
                               
                            </div>
                          

                            </div><!-- /.box-body -->
                            <div class="box-footer" style="padding: 10px;">
                                <button type="submit" class="btn btn-info ">@lang('Save')</button>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary" id="hroom">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">@lang('Marksheet List')</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <div class="download_label"> @lang('Marksheet List')</div>
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                                <div class="dt-buttons btn-group btn-group2">
                                    <a class="btn btn-default dt-button buttons-copy buttons-html5" tabindex="0" aria-controls="DataTables_Table_0" href="#" title="Copy"><span><i class="fa fa-files-o"></i></span></a>

                                    <a class="btn btn-default dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="DataTables_Table_0" href="#" title="Excel"><span><i class="fa fa-file-excel-o"></i></span></a> 

                                    <a class="btn btn-default dt-button buttons-csv buttons-html5" tabindex="0" aria-controls="DataTables_Table_0" href="#" title="CSV"><span><i class="fa fa-file-text-o"></i></span></a> 

                                    <a class="btn btn-default dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_0" href="#" title="PDF"><span><i class="fa fa-file-pdf-o"></i></span></a>

                                    <a class="btn btn-default dt-button buttons-print" tabindex="0" aria-controls="DataTables_Table_0" href="#" title="Print"><span><i class="fa fa-print"></i></span></a>

                                    <a class="btn btn-default dt-button buttons-collection buttons-colvis" tabindex="0" aria-controls="DataTables_Table_0" href="#" title="Columns"><span><i class="fa fa-columns"></i></span></a> 
                                </div>
                                <div id="DataTables_Table_0_filter" class="dataTables_filter"><label><input type="search" class="" placeholder="Search..." aria-controls="DataTables_Table_0"></label>
                                </div>
                                <table class="table table-striped table-bordered table-hover example dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Certificate Name: activate to sort column ascending" style="width: 256px;">@lang('Certificate Name')</th>

                                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Background Image: activate to sort column descending" style="width: 281px;" aria-sort="ascending">@lang('Background Image')</th>

                                        <th class="text-right sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 157px;">@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row" class="odd">
                                        <td class="mailbox-name">
                                            <a style="cursor: pointer;" class="view_data" id="4" data-toggle="popover" data-original-title="" title="">@lang('Template_1')</a>
                                        </td>
                                        <td class="mailbox-name sorting_1"></td>
                                        <td class="mailbox-date text-right no-print">
                                            <a id="4" class="btn btn-default btn-xs view_data" title="View">
                                                <i class="fa fa-reorder"></i>
                                            </a>
                                            <a data-placement="left" href="" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a data-placement="left" href="" class="btn btn-default btn-xs" data-toggle="tooltip" title="" onclick="return confirm('Delete Confirm?');" data-original-title="Delete">
                                                <i class="fa fa-remove"></i>
                                            </a> 
                                        </tr>
                                            <tr role="row" class="even">

                                                <td class="mailbox-name sorting_1"> </td>

                                            </td>
                                        </tr>
                                        </tbody>
                            </table><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Records: 1 to 3 of 3</div><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><a class="paginate_button previous disabled" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" id="DataTables_Table_0_previous"><i class="fa fa-angle-left"></i></a><span><a class="paginate_button current" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" id="DataTables_Table_0_next"><i class="fa fa-angle-right"></i></a></div></div><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div>


                </div>
                       
              
@endsection 



