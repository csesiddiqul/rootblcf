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
                @include('components.sectionbar.reports-bar')
                <div class="panel-body">


                    @if(!empty(1))
                        <form action="{{route('accounts.set_notes.update',$mynote->id) }}" name="f1" method="post" class="form-inline w-100" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="table-responsive">

                                <table class="table table-bordered">

                                    <tr>
                                        <td colspan="">
                                            <b>1st Auditor</b>
                                            <input type="text" name="audi_1" id="other" value="{{$mynote->auditor1st}}" class="form-control w-100" required>
                                        </td>

                                        <td colspan="">

                                            <b>2nd Auditor</b>
                                            <input type="text" name="audi_2" id="other"  value="{{$mynote->auditor2st}}" class="form-control w-100" required>
                                        </td>



                                        <td colspan="">

                                            <b>Treasurer</b>
                                            <input type="text" name="treasurers" id="other"  value="{!! $mynote->treasurer !!}" class="form-control w-100" required>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="3">
                                            <b>Treasurer Notes</b>
                                            <div style="clear: both;"></div>
                                            <textarea name="notes" rows="4" class="form-control w-100 ckeditor" id="remarks"  placeholder="Write here...">{!! $mynote->notes !!} </textarea>
                                        </td>


                                    </tr>

                                    <tr>
                                        <td colspan="3">
                                            <b>Auditors Report</b>
                                            <div style="clear: both;"></div>
                                            <textarea name="auditorsr_report" rows="4" class="form-control w-100 ckeditor" id="remarks" placeholder="Write here...">{{$mynote->auditors_report}}</textarea>
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

        @if(isset($_GET['studentId']))
        $("#admitButton").trigger('click');
        @endisset
    </script>
@endsection
