@extends('layouts.app')
@section('title', __('Edit Expense'))
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
                        {!! Form::model($expense, ['id' => 'ExpenseForm','method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['accounts.expense.update', $expense->id]]) !!}
                        @include('accounts.expense.element')
                        <div class="clearhight"></div>
                        <div class="col-md-2">
                            <button type="submit" id="ExpenseBtn" class="{{btnClass()}}">
                                @lang('Update')
                            </button>
                        </div>
                        <div class="col-md-2 text-center">
                            <a href="{{route('accounts.expense.index')}}"
                               class="{{btnClass()}}">@lang('Cancel')</a>
                        </div>
                        <div class="clearhight50"></div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
