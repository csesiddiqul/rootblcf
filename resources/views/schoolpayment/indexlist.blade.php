@extends('layouts.app') 
@section('title', __('Master Dashboard')) 
@section('content')  
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">  
            @if(Auth::user()->role == 'master') 
                @include('layouts.master-left-menu')
            @elseif(Auth::user()->role == 'agent') 
                @include('layouts.agent-left-menu')  
            @endif
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default pt-0">
                @include('schoolpayment.top-menu')
                <div class="panel-body p-0">
                    <div class="col-md-12">
                    <div class="table-responsive">
                        @if (count($receiveds)>0)
                            @include('agent.date-range')
                        @endif
                        <table class="table table-bordered table-data-div table-condensed table-striped table-hover" style="margin-top: 10px !important; ">
                            <thead>
                            <tr>  
                                <th scope="col">@lang('Payment For')</th>
                                <th scope="col">@lang('Trans_No')</th>
                                <th scope="col">@lang('Amount')</th> 
                                <th scope="col">@lang('Trans. By')</th>
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
                                    <td>{{pricingfor($received->purpose_id)}}</td> 
                                    <td>{{ $received->trans_number }}</td>  
                                    <td>
                                        @if($received->currency=='bdt' || $received->currency=='BDT')
                                            ৳{{$received->amount}}
                                        @else
                                            ${{$received->amount}}
                                        @endif 
                                    </td> 
                                    <td>{{ $received->transBy }}</td>
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
</div>  
@push('script') 
    <script type="text/javascript">
        $.extend( true, $.fn.dataTable.defaults, {
            "bFilter": true,
            initComplete: function () {
                this.api().column(0).every( function () {
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
    </script>
@endpush
@endsection
