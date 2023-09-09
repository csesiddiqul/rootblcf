@extends('layouts.app')
@section('title', __('All Issued Book'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>trans('Manage Library').' / <b>'.trans('All Issued Books').'</b>'])
                @include('components.sectionbar.library-bar')
                <div class="panel panel-default">
                    <div class="panel-body">
                        @component('components.issued-books-list',['books'=>$issued_books])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
