@extends('layouts.app') 
@section('title', __('Master Dashboard')) 
@section('content')
    @php $crn = "৳"; @endphp
@if (count($receiveds)>0) 
    @if($receiveds[0]->currency=='bdt' || $receiveds[0]->currency=='BDT')
        @php $crn = "৳"; @endphp
    @else
        @php $crn = "$"; @endphp
    @endif
    <style type="text/css"> 
        td.pay_able:before {
            content: "{{$crn}}";
        }
        table.dataTable.table-condensed>thead>tr>th {padding-right: 5px;}
    </style>
@endif 
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2" id="side-navbar">  
            @if(Auth::user()->role == 'master') 
                @include('layouts.master-left-menu')
                @push('script')
                    <script src="{{ asset('js/dataTables.checkboxes.min.js') }}"></script>
                @endpush   
            @elseif(Auth::user()->role == 'agent') 
                @include('layouts.agent-left-menu')  
            @endif
        </div>
        <div class="col-md-10" id="main-container">
            <div class="panel panel-default pt-0">
                @include('agent.pay-menu') 
                <div class="panel-body ">
                    <div class="table-responsive"> 
                        <form id="frm-example" action="{{route('agent.payselected',$aguser->student_code)}}" method="POST">
                            @csrf
                        <table id="example" class="table datatable table-bordered my_cus_table table-condensed table-striped table-hover" style="margin-top: 10px !important; ">
                            <thead>
                                <tr> 
                                    @if(Auth::user()->role == 'master') 
                                        <th></th>
                                    @else
                                        <th>#</th>  
                                    @endif 
                                    <th scope="col">@lang('School')</th>
                                    <th scope="col">@lang('Payment For')</th>
                                    <th scope="col">@lang('Amount')</th>
                                    <th scope="col">@lang('Payable')</th>
                                    <th scope="col">@lang('Date')</th> 
                                    <th scope="col">@lang('Trans_No')</th>
                                    <th scope="col" class="textleft">@lang('Ref_Number')</th>  
                                </tr>
                            </thead>
                            <tbody id="tablebody">  
                            @if (count($receiveds)>0)
                                @foreach ($receiveds as $key=>$received)
                                <tr>  
                                    @if(Auth::user()->role == 'master') 
                                        <td>{{$received->id}}</td>
                                    @else
                                        <td>{{$key+1}}</td>  
                                    @endif
                                    
                                    <td><code title="{{$received->school->name}}" class="popRight">{{ $received->school->short_name }}</code></td>
                                    <td>{{pricingfor($received->purpose_id)}}</td> 

                                    @if(!empty($received->shareOf)) 
                                        @php $shareOf = $received->shareOf; @endphp
                                    @else
                                        @php $shareOf = $aguser->agent->shareOf; @endphp
                                    @endif

                                    <td class="pay_able">
                                        @if(!empty($received->amount))
                                            <span title="{{$shareOf}}%" class="popRight">
                                                {{$received->amount}}  
                                            </span>
                                        @else
                                            00.00
                                        @endif  
                                    </td> 
                                    <td class="pay_able pay_amount">   
                                        @php
                                            $percent = $shareOf / 100;
                                            $percents = $received->amount * $percent; 
                                            $percentTk = round($percents,2); 
                                        @endphp 
                                        {{$percentTk}} 
                                    </td> 
                                    <td>{{ date('m-d-Y',strtotime($received->trans_date)) }}</td> 
                                    <td>{{ $received->trans_number }}</td>  
                                    <td class="textleft">
                                        @if(!empty($received->ref_number))
                                            {{$received->ref_number}}
                                        @else
                                            ---
                                        @endif 
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
                            @if (count($receiveds)>0)
                            <tfoot class="tb-footer">
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="th-2"></th>
                                    <th class="th-3"></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                        @if(Auth::user()->role == 'master')  
                        <div id="additional" class="col-sm-4 col-md-4 col-sm-offset-4 col-md-offset-4 form-group" style="display:none">
                            <span id="idSmofAmount"></span> 
                            <input id="tranCheque" type="text" class="form-control" name="tranCheque" placeholder="Trans./Cheque Number" min="1" max="15" autocomplete="off">
                            <div class="clearhight"></div>
                            <textarea id="sNote" class="form-control" name="sNote" placeholder="Write a short note..." style="line-height:22px;" ></textarea> 
                        </div>                                 
                        <div class="col-sm-2 col-md-2 col-sm-offset-5 col-md-offset-5 form-group">
                            <button type="submit" id="registerBtn" class="btn btn-primary btn-sm btn-block">@lang('Submit Now')</button>
                        </div>
                        @endif   
                        </form>  
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div> 
@push('script')   
<script>
$(document).ready(function() {
    var table = $('.my_cus_table').DataTable({
        'columnDefs': [{
            'targets': 0,
            'checkboxes': {
               'selectRow': true
            }
        }],
        'select': {
            'style': 'multi'
        },
        'order': [],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data; 
            var intVal = function ( i ) {
                return typeof i === 'string' ? i.replace(/[\$,]/g, '')*1 : typeof i === 'number' ? i : 0;
            };    
            var payables = api.column( 4 ).data().reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ); 
            var payableTotals = parseFloat(payables).toFixed(2);
            var currency = "{{$crn}}"; 
            $( api.column( 0 ).footer() ).html('&nbsp;');
            $( api.column( 1 ).footer() ).html('&nbsp;');
            $( api.column( 2 ).footer() ).html('&nbsp;');
            $( api.column( 3 ).footer() ).html('Total&nbsp;Payable&nbsp;=');
            $( api.column( 4 ).footer() ).html(currency + ' '+ payableTotals);
            $( api.column( 5 ).footer() ).html('&nbsp;');
            $( api.column( 6 ).footer() ).html('&nbsp;');
            $( api.column( 7 ).footer() ).html('&nbsp;');
        },
        paging: false,
        autoWidth:true 
    });

    $('.my_cus_table input[type=checkbox]').on('change', function () {
        var length = $('#tablebody input[type=checkbox]:checked').length; 

        var sum = 0;
        var currency = "{{$crn}}";
        $('#tablebody input[type=checkbox]:checked').each(function() {
            sum += parseFloat($(this).closest('tr').find('.pay_amount').text());
        });
        var payTotals = parseFloat(sum).toFixed(2);
        $('#idSmofAmount').html('<label>Total Amount = '+currency+ ' '+payTotals+'</label>');

        if (length > 0) {
            $('#additional').show();
            $('#tranCheque').attr('required',true);
            $('#sNote').attr('required',true);
        }else{
            $('#additional').hide();
            $('#tranCheque').attr('required',false);
            $('#sNote').attr('required',false);
        }
    });

    $('#frm-example').on('submit', function(e){
        var form = this; 
        var rows_selected = table.column(0).checkboxes.selected(); 

        var check = $('#tablebody').find('input[type=checkbox]:checked').length;
        if (check<1) {
            Swal.fire({
                title: 'At least one payment should be selected!',
                icon: 'warning',
                timer: 3000,
                showConfirmButton: false,
                timerProgressBar: true
            }); 
            return false;
        }  

        $.each(rows_selected, function(index, rowId){  
            $("#frm-example").append('<input type="hidden" name="id[]" value="'+rowId+'">'); 
        }); 
    }); 
    $('.dt-checkboxes-select-all').css('width','15px');
    var role = "{{Auth::user()->role}}";
    if (role == 'master') {
        var headline = "<h5>Select one or more for make payment</h5>";
    }else{
        var headline = "<h5>Your unpaid payments</h5>"; 
    }
    
    $(document).ready(function () {
        function appendFunction() { 
            $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(headline);
        } 
        setTimeout(function () {
            appendFunction();
            $("#EventSection").html('');
        }, 1000);
    })
});
</script>  

@endpush  
@endsection

 