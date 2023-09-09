@extends('layouts.app')
@section('title', __('Issue Book'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('library/issued-books') .'">'. trans('Manage Library').'</a> / <b>'.trans('Issue Books').'<b>'])
                @include('components.sectionbar.library-bar')
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-6">
                            @component('components.book-issue-form',['books'=>$books])
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
