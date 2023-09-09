@extends('layouts.app')
@section('title', __('Register'))
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Money Receipt').'<b>'])
                @include('components.sectionbar.accounts-bar')
                <div class="panel-body">


                    @if(!empty(1))
                        <form action="{{route('accounts.membership_fee.store') }}" name="f1" method="post" class="form-inline w-100" autocomplete="off">
                            @csrf

                            <div class="table-responsive">

                                <table class="table table-bordered">
                                    <tr>
                                        <td>
                                            <b>Committee Name:</b>
                                            <div style="clear: both;"></div>

                                            <select class="form-control w-100" id="ledger_id" name="committeeid" required name="ledger_id">
                                                <option value="0">Choose</option>
                                                @foreach ($committee as $key => $value)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                @endforeach
                                            </select>

                                        </td>
                                        <td>
                                            <b>Donor Name:</b>
                                            <div style="clear: both;"></div>
                                            <input type="text" name="donor"  class="form-control w-100 calculate" >
                                        </td>

                                        <td>
                                            <b>@lang('Date')</b>
                                            <div style="clear: both;"></div>
                                            <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>"  class="form-control w-100 calculate">
                                            @error('date')
                                            <span class="note-help-block text-danger">
                                            <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>Subscription Fee :</b>
                                            <div style="clear: both;"></div>
                                        </td>
                                        <td>
                                            <input type="text" name="subscription" id="subscription" value="0" class="form-control calculate" onkeyup="totalAmount();">
                                        </td>

                                        <td>
                                            <b>Years :</b>
                                            <input  type="number" name="years" id="years"  class="form-control calculate"  value="0" onkeyup="totalAmount();" min="0" max="12">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="font-weight: bold">Total Subscription : </td>
                                        <td style="font-weight: bold">
                                            <input type="number" value="0" name="totalsub" id="totalsub" class="form-control calculate"  onkeyup="totalAmount();" readonly>
                                        </td>

                                        <td style="font-weight: bold">
                                            Start Year :
                                            <input type="date" name="yearstart" id="subscription" class="form-control w-30 calculate">

                                            End Year :
                                            <input type="date" name="yearEnd" id="subscription" class="form-control w-30 calculate">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>Registration Fee :</b>
                                        </td>
                                        <td>
                                            <div style="clear: both;"></div>
                                            <input type="text" name="registration" id="registration"  class="form-control calculate" value="0" onkeyup="totalAmount();">
                                        </td>


                                        <td style="font-weight: bold">
                                            @lang('Ledger')
                                            <select class="form-control" id="ledger_id" required name="ledger_id">
                                                @foreach ($ledgers as  $value)
                                                    <option value="{{$value->id}}" {{$value->id == 1 ? 'selected' : ''}}>{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('ledger_id')
                                            <span class="help-block">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                        </td>


                                    </tr>

                                    <tr>
                                        <td>
                                            <b>Donation:</b>
                                        </td>
                                        <td>
                                            <div style="clear: both;"></div>
                                            <input type="text" name="donations" id="donations"  class="form-control calculate" value="0" onkeyup="totalAmount();">
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <b>Grants:</b>
                                        </td>
                                        <td>
                                            <div style="clear: both;"></div>
                                            <input type="text" name="grants" id="grants"  class="form-control calculate" value="0" onkeyup="totalAmount();">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>Other :</b>
                                        </td>
                                        <td>
                                            <div style="clear: both;"></div>
                                            <input type="text" name="other" id="other"  class="form-control calculate" value="0" onkeyup="totalAmount();">
                                        </td>

                                    </tr>

                                    <tr>
                                        <td>
                                            <b>Subscription Arrears :</b>

                                        </td>
                                        <td>
                                            <div style="clear: both;"></div>
                                            <input type="text" name="arrears"  id="arrears" class="form-control calculate" value="0"  onkeyup="totalAmount();">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <b>Total Amount :</b>
                                        </td>

                                        <td>
                                            <div style="clear: both;"></div>
                                            <input class="form-control" id="totalamaountdet"  name="totalamaountdet" type="number" value="0" readonly>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td colspan="2">
                                            <b>Remarks:</b>
                                            <div style="clear: both;"></div>
                                            <textarea name="remarks" rows="1" class="form-control w-100" id="remarks" placeholder="Write here..."></textarea>
                                        </td>
                                    </tr>



                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <button style="display: inline-block;width:200px;" type="submit" class="{{btnClass()}}">@lang('Submit') </button>
                                        </td>
                                    </tr>

                                </table>
                            </div>
                        </form>
                    @else

                    @endif



                    @if (count($memberships)>0)
                        <div class="table-responsive" style="text-align: right">
                            <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('Name')</th>
                                    <th scope="col">@lang('Subscription / Years')</th>
                                    <th scope="col">@lang('Registration')</th>
                                    <th scope="col">@lang('Donation')</th>
                                    <th scope="col">@lang('Grants')</th>
                                    <th scope="col">@lang('Other')</th>
                                    <th scope="col">@lang('Arrears')</th>
                                    <th scope="col">@lang('Total Amount')</th>
                                    <th scope="col">@lang('M R No')</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($memberships as $key=> $memberfee)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td style="text-align: left">

                                            @php
                                                if($memberfee->committees_id){
                                                           foreach ($committee as $value){
                                                               if ($value->id == $memberfee->committees_id){
                                                                   echo $value->name;
                                                               }
                                                           }
                                                      }elseif ($memberfee->dona_name){
                                                          echo $memberfee->dona_name;
                                                      }else{
                                                         echo 'N/A';
                                                      }
                                            @endphp

                                        </td>
                                        <td>
                                           ( {{$memberfee->subscription}} *  {{$memberfee->year}} )
                                        </td>
                                        <td>
                                         
                                            {{number_format($memberfee->registration??0,2)}}
                                        </td>
                                        <td>
                                             {{number_format($memberfee->donation??0,2)}}
                                        </td>
                                        <td>
                                             {{number_format($memberfee->grants??0,2)}}
                                        </td>
                                        <td>
                                             {{number_format($memberfee->other??0,2)}}
                                        </td>
                                        <td>
                                             {{number_format($memberfee->arrears??0,2)}}
                                           
                                        </td>

                                        <td>
                                             {{number_format($memberfee->amount??0,2)}}
                                            
                                        </td>


                                        <td>
                                            <a href="{{route('accounts.membership_fee.show',$memberfee->id)}}">
                                                {{$memberfee->member_reciept_number}}
                                            </a>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @push('styles')
                            <style>
                                #committeeSection {
                                    display: none
                                }
                            </style>
                        @endpush
                        @push('script')
                            <script>
                                $(document).ready(function () {
                                    function appendFunction() {
                                        var appendHtml = $("#committeeSection").html();
                                        $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
                                    }

                                    setTimeout(function () {
                                        appendFunction();
                                        $("#committeeSection").html('');
                                    }, 1000);
                                })
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
    <script>
        $(function () {
            $('.datepicker').datepicker({
                format: "dd-mm-yyyy",
                viewMode: "days",
                minViewMode: "days",
                autoclose: true
            });
        });
        // Store
        // sessionStorage.setItem("total", {{$total ?? ''}});
        //alert(sessionStorage.getItem("total"));
        $('#checkall').change(function () {
            $('.checkSingle').prop('checked', this.checked);
            if ($(this).is(":checked")) {
                $(this).attr('checked', true);
                $(".removeDisable").prop('disabled', false);
            } else {
                $(this).attr('checked', false);
                $(".waiverCheck").attr('checked', false);
            }
            total();
        });

        $('.waiverCheck').change(function () {
            var id = $(this).attr('id');
            id = (id).replace(/[^\d.]/g, '');
            if ($(this).is(":checked")) {
                var amount = $(this).attr('data-check');
                $(this).attr('checked', true);
                $("#waiver" + id).val(amount).attr('disabled', false);
            } else {
                $(this).attr('checked', false);
                $("#waiver" + id).val('').attr('disabled', true);
            }
            total();
        });

        $('.checkSingle').change(function () {
            var id = $(this).attr('id');
            id = (id).replace(/[^\d.]/g, '');
            if ($('.checkSingle:checked').length == $('.checkSingle').length) {
                $('#checkall').prop('checked', true);
            } else {
                $('#checkall').prop('checked', false);
            }
            if ($(this).is(":checked")) {
                $(this).attr('checked', true);
                $("#amount" + id).attr('disabled', false);
                $("#waiverCheck" + id).attr('disabled', false);
                $("#waiver" + id).val(0).attr('disabled', false);
            } else {
                $(this).attr('checked', false);
                $("#amount" + id).attr('disabled', true);
                $("#waiverCheck" + id).attr('disabled', true);
                $("#waiver" + id).attr('disabled', true).val(0);
            }
            total();
        });

        function total() {
            var arr = document.getElementsByName('amount[]');
            var waiver = document.getElementsByName('waiver[]');
            var tot = 0;
            var waivertot = 0;
            for (var i = 0; i < arr.length; i++) {
                var id = (arr[i].id).replace(/[^\d.]/g, '');
                if (document.getElementById("student" + id).checked) {
                    if (parseInt(arr[i].value))
                        tot += parseFloat(arr[i].value);
                }
                if (document.getElementById("student" + id).checked) {
                    if (parseInt(waiver[i].value))
                        tot += -parseFloat(waiver[i].value);
                }
                if (parseInt(waiver[i].value))
                    waivertot += parseFloat(waiver[i].value);
            }
            if (!isNaN(tot)) {
                document.getElementById('receivedID').innerHTML = tot.toFixed(2);
            }
            if (!isNaN(waivertot)) {
                document.getElementById('waivertotal').innerHTML = waivertot.toFixed(2);
            }
        }

        function confirmSubmit() {
            Swal.fire({
                title: "Confirmation",
                text: "Are you sure you want to received amount?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Ok, Received",
                cancelButtonText: "Check again!"
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('moneyreceivedForm').submit();
                }
            })
        }


        function calculte(){
            var x = document.getElementById("subscription").value;
            var y = document.getElementById("years").value;
            var all = x * y;
            document.getElementById("totalsub").value = all;
        }

        function totalAmount(){
            var subcrip = document.getElementById("subscription").value;
            var years = document.getElementById("years").value;
            var totalsub = parseInt(subcrip) * parseInt(years);
            document.getElementById("totalsub").value = totalsub;
            var registration = document.getElementById("registration").value;
            var donations = document.getElementById("donations").value;
            var other = document.getElementById("other").value;
            var arrears = document.getElementById("arrears").value;
            var grants = document.getElementById("grants").value;
            var sumall = parseFloat(totalsub) + parseFloat(registration) + parseFloat(donations) + parseFloat(other) + parseFloat(arrears) + parseFloat(grants);
            document.getElementById("totalamaountdet").value = sumall;

        }


        @if(isset($_GET['studentId']))
        $("#admitButton").trigger('click');
        @endisset
    </script>
@endsection
