@extends('layouts.app')

@section('title', __('Add New Book'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('library/issued-books') .'">'. trans('Manage Library').'</a> /<a href="'. route('library.books.index') .'">'. trans('All Books').'</a> / <b>'.trans('Add New Book').'<b>'])
                @include('components.sectionbar.library-bar')
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-6">
                            <form action="{{ route('library.books.store') }}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}
                                @include('library.books.create-form')
                                <div class="form-group">
                                    <div class="col-sm-3 pl-0">
                                        <button type="submit" class="{{btnClass()}}">@lang('Save')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
