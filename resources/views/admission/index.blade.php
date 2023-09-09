@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @if (\Route::current()->getName() == 'academic.admission.pending')
                    @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.admission.pending').'">'. transMsg('Admission').'</a> / <b>'.transMsg('Applications').'<b>'])
                @endif
                @if (\Route::current()->getName() == 'academic.admission.approve')
                    @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.admission.pending').'">'. transMsg('Admission').'</a> / <b>'.transMsg('Applications Short List').'<b>'])
                @endif
                @php
                    $total = \App\AdmissionPayment::leftjoin('admissions', 'admissions.id', 'admission_payments.admission_id')
                                                ->where('admission_payments.trans_status', 'Paid')
                                                ->where('admissions.preadmission_id', preAdmissionId())
                                                ->where('admission_payments.school_id', auth()->user()->school_id)
                                                ->sum('admission_payments.amount');
                @endphp
                <span id="mg-top" style="float: right;margin-top: -40px; margin-right: 15px;"><strong>@lang('Total Amount') : </strong>{{number_format($total,2)}} {{school('country')->currency == "BDT" ? 'Tk' : '$'}}</span>
                @include('components.sectionbar.admission-bar')
                <div class="panel panel-default">
                    <div class="panel-body pad-top-0">
                        @if (count($admission)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Roll')</th>
                                        <th scope="col">@lang('Password')</th>
                                        <th scope="col">@lang('Student Name')</th>
                                        <th scope="col">@lang('Father Name')</th>
                                        <th scope="col"> {{trans(school('country')->code == 'BD' || 'SG' ? 'Class' : 'Grade')}}</th>
                                        <th scope="col">@lang('Gender')</th>
                                        <th scope="col">@lang('Religion')</th>
                                        @php($payment_status = foqas_setting('add_payment_status'))
                                        <th scope="col">@lang('Status')</th>
                                        @if($payment_status==1 && school('country')->code != 'SG')
                                            <th scope="col">@lang('Transition ID')</th>
                                            <th scope="col">@lang('Amount')</th>
                                        @endif
                                        {{--   @foreach ($admission as $heads)
                                               @if($heads->status == 1)
                                                   <th scope="col">@lang('Delete')</th>
                                               @endif
                                               @break($loop->first)
                                           @endforeach--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($admission as $key=>$div)
                                        <tr id="change{{$div->id}}">
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td>
                                                <a href="{{route('academic.admission.show',$div->id)}}">
                                                    <small> {{$div->roll}} </small> </a></td>
                                            <td><small> {{$div->add_pass}} </small></td>
                                            <td>
                                                <small> {{$div->name}} </small>
                                            </td>
                                            <td><small> {{$div->father_name}} </small></td>
                                            <td>{{$div->class['name']??''}}</td>
                                            <td>{{gender($div->gender,true)}}</td>
                                            <td>{{religon($div->religon,true)}}</td>
                                            <td>
                                                {!! Form::select('status',admissionstatus(), $div->status, array('id' => 'status'.$div->id, 'class' => 'form-control input-sm', 'onChange' =>'admissionActions(this.value,'.$div->id.')')) !!}
                                            </td>
                                            @if($payment_status==1  && school('country')->code != 'SG')
                                                @if(isset($div->admissionPayment))
                                                    @if ($div->admissionPayment->trans_status == 'Paid')
                                                        <td>
                                                            <small title="<span>@lang('Application Amount') : {{round($div->admissionPayment->amount + $div->admissionPayment->stripe_fee,2)}} {{$div->admissionPayment->currency == "BDT" ? 'Tk' : '$'}}</span><br>
                                                    <span>{{trans($div->admissionPayment->trans_type == "2" ? 'Sslcommerz' : 'Stripe' .' Charge')}}  : - {{$div->admissionPayment->stripe_fee}} {{$div->admissionPayment->currency == "BDT" ? 'Tk' : '$'}}</span><br>

                                                    <span style='border-top:1 px solid'> @lang('Net Amount') : {{$div->admissionPayment->amount}} {{$div->admissionPayment->currency == "BDT" ? 'Tk' : '$'}}</span><br>
                                                     <small><span>@lang('Payment Method') : {{$div->admissionPayment->card_type}}</span><br>
                                                    <span>@lang('Transition Date') : {{$div->admissionPayment->trans_date}}</span>
                                                    </small>"
                                                                   class="popLeft text-info">{{$div->admissionPayment->trans_number}}</small>
                                                        </td>
                                                        <td>
                                                            <small>{{round($div->admissionPayment->amount,2)}} {{$div->admissionPayment->currency == "BDT" ? 'Tk' : '$'}}</small>
                                                        </td>
                                                    @else
                                                        <td>@lang('N/A')</td>
                                                        <td></td>
                                                    @endif
                                                @else
                                                    <td>@lang('N/A')</td>
                                                    <td></td>
                                                @endif
                                            @endif
                                            {{--  @if($div->status==1)
                                                 <td>
                                                     <a class="btn btn-xs btn-danger"
                                                        onclick="confirm_delete('{{$div->id}}')">@lang('Delete')</a>
                                                     <form id="delete_form_{{$div->id}}"
                                                           action="{{route('academic.admission.destroy',$div->id)}}"
                                                           method="POST" style="display: none;">
                                                         {{ csrf_field() }}
                                                         @method('DELETE')
                                                     </form>
                                                 </td>
                                             @endif--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @push('script')
                                <script>
                                    $.extend(true, $.fn.dataTable.defaults, {
                                        "bFilter": true,
                                        initComplete: function () {
                                            this.api().column(5).every(function () {
                                                var column = this;
                                                var select = $('<select><option value="">{{transMsg(school('country')->code == 'BD' ? 'Class' : 'Grade')}}</option></select>')
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
                                            this.api().column(7).every(function () {
                                                var column = this;
                                                var select = $('<select><option value="">@lang('Religion')</option></select>')
                                                    .appendTo($(column.header()).empty())
                                                    .on('change', function () {
                                                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                                                    });
                                                column.data().unique().sort().each(function (d, j) {
                                                    select.append('<option value="' + d + '">' + d + '</option>')
                                                });
                                            });
                                        },
                                    });
                                </script>
                            @endpush
                        @else
                            <div class="panel-body">
                                @lang('No Related Data Found.')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .swal2-validation-message::after {
            content: '{{trans('Please, Write the reason!')}}';
        }
    </style>

@endsection
