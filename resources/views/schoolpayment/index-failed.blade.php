@extends('layouts.app') 
@section('title', __('Master Dashboard')) 
@section('content')  
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">  
            @include('layouts.master-left-menu') 
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default pt-0">
                @include('schoolpayment.payment-menu')  
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-data-div table-condensed table-striped table-hover" style="margin-top: 10px !important; ">
                            <thead>
                            <tr> 
                                <th scope="col">@lang('School')</th>
                                <th scope="col">@lang('Trans_No')</th>
                                <th scope="col">@lang('Amount')</th>
                                <th scope="col">@lang('For')</th>
                                <th scope="col">@lang('Date')</th>
                                <th scope="col">@lang('Agent_Code')</th> 
                                <th scope="col">@lang('Ref_Number')</th> 
                                <th scope="col">@lang('Status')</th> 
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($receiveds)>0)
                                @foreach ($receiveds as $key=>$received)
                                <tr>  
                                    @if(!empty($received->school->name)) 
                                        @php 
                                            $fName = $received->school->name;
                                            $sName = $received->school->short_name;
                                            $routeCode = route('school.payments.indexlist',$received->school->code);
                                        @endphp 
                                    @else 
                                        @php 
                                            $fName = "---";
                                            $sName = "---";
                                            $routeCode = route('schoolpayments.index');
                                        @endphp 
                                    @endif  
                                    <td><a href="{{$routeCode}}" class="href"><code title="{{$fName}}" class="popRight">{{$sName}}</code></a></td>
                                    <td>{{ $received->trans_number }}</td>  
                                    <td>
                                        @if($received->currency=='bdt' || $received->currency=='BDT')
                                            ৳{{$received->amount}}
                                        @else
                                            ${{$received->amount}}
                                        @endif 
                                    </td>
                                    <td>
                                        @if($received->purpose_id>0)
                                            {{pricingfor($received->purpose_id)}}
                                        @else
                                            ---
                                        @endif
                                    </td> 
                                    <td>{{ date('m-d-Y',strtotime($received->trans_date)) }}</td> 
                                    <td>
                                        @if(!empty($received->agentcode))
                                            <a class="a-href" href="{{route('agent.profile',$received->agentcode)}}">{{ $received->agentcode }}</a> 
                                        @else
                                            ---
                                        @endif 
                                    </td> 
                                    <td>
                                        @if(!empty($received->ref_number))
                                            {{$received->ref_number}}
                                        @else
                                            ---
                                        @endif 
                                    </td> 
                                    <td> 
                                        <small> 
                                            {!! $received->trans_status == 'Paid' ? '<span class="btn btn-xs allButton btn-block">Paid</span>' : ($received->trans_status == 'Pending' ? '<span class="btn btn-xs btn-warning btn-block">Pending</span>':'<span class="btn btn-xs btn-danger btn-block">Failed</span>') !!}
                                        </small>
                                    </td> 
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="6" class="text-center text-danger">@lang('No Related Data Found.')</td>
                                    <td>&nbsp;</td>
                                </tr>
                            @endif
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>  
@push('script') 
    <script type="text/javascript">
        $.extend( true, $.fn.dataTable.defaults, {
            "bFilter": true,
            initComplete: function () {
                this.api().column(3).every( function () {
                    var column = this;
                    var select = $('<select><option value="">Payment For</option></select>')
                        .appendTo( $(column.header()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );
                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            },
        });

        $(document).ready(function(){
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) { 
                    var min = $('#startdate').datepicker("getDate");
                    var max = $('#enddate').datepicker("getDate");
                    var hireDate = new Date(data[4]);
                    if (min == null && max == null) { return true; }
                    if (min == null && hireDate <= max) { return true;}
                    if(max == null && hireDate >= min) {return true;}
                    if (hireDate <= max && hireDate >= min) { return true; }
                    return false;
                }
            );
        });
        $("#filter").click(function () { 
            var min = $('#startdate').datepicker("getDate");
            var max = $('#enddate').datepicker("getDate");
            if (min==null) {
                $("#startdate").focus().prop('required',true);  
                return false;
            };
            if (max==null) {
                $("#enddate").focus().prop('required',true); 
                return false; 
            };
            
            var myDataTable = $('.table').DataTable();
                myDataTable.draw();
        });
        $(function () {
            $('.datepicker').datepicker({  
                format: 'mm-dd-yyyy',
                autoclose: true,
                todayHighlight: true
            }); 
        });
    </script>
@endpush
@endsection
