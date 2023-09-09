@extends('layouts.app')
@section('title', __('Add New Expense'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/accountant').'">'. trans('Manage Accounts').'</a> / <b>'.trans('Add New Expense').'<b>'])
                @include('components.sectionbar.accounts-bar')
                <div class="panel panel-default ptlb-515">
                    <div class="panel-body plt-07">
                        {!! Form::open(['route' => 'accounts.expense.store', 'method' => 'post','enctype'=>'multipart/form-data','id'=>'ExpenseForm']) !!}
                        @include('accounts.expense.element')
                        <div class="clearhight"></div>
                        <div class="col-md-2">
                            <button type="button" id="ExpenseBtn" class="{{btnClass()}}">
                                @lang('Create Voucher')
                            </button>
                        </div>
                        <div class="col-md-2 text-center">
                            <a href="{{route('accounts.expense.index')}}"
                               class="{{btnClassCancel()}}">@lang('Cancel')</a>
                        </div>
                        <div class="clearhight50"></div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function () {
            $('#date').datepicker({
                format: "dd-mm-yyyy",
                viewMode: "days",
                minViewMode: "days",
                autoclose: true
            });
        })
        document.getElementById("ExpenseBtn").onclick = function () {
            let allAreFilled = true;
            document.getElementById("ExpenseForm").querySelectorAll("[required]").forEach(function (i) {
                if (!allAreFilled) return;
                if (!i.value) allAreFilled = false;
                if (i.type === "radio") {
                    let radioValueCheck = false;
                    document.getElementById("ExpenseForm").querySelectorAll(`[name=${i.name}]`).forEach(function (r) {
                        if (r.checked) radioValueCheck = true;
                    })
                    allAreFilled = radioValueCheck;
                }
            })
            if (allAreFilled) {
                confirmSubmit();
            } else {
                Swal.fire({
                    title: "Warning",
                    text: "Please fill in all the required fields.",
                    icon: 'question',
                    showCancelButton: false,
                    confirmButtonColor: '#d33',
                    confirmButtonText: "Ok"
                })
            }
        };

        function confirmSubmit() {
            Swal.fire({
                title: "Confirmation",
                text: "Are you sure you want to Create Voucher?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Ok, Confirm"
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('ExpenseForm').submit();
                }
            })
        }
    </script>
@endpush
