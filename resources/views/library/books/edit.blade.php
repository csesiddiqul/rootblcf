@extends('layouts.app')

@section('title', __('Edit Book'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('library/issued-books') .'">'. trans('Manage Library').'</a> /<a href="'. route('library.books.index') .'">'. trans('All Books').'</a> / <b>'.trans('Edit').'<b>'])
                @include('components.sectionbar.library-bar')
                <div class="panel panel-default">
                    <div class="panel-body col-md-6">
                        <form action="{{ url('library/books', $book->id) }}" method="POST">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}
                            @include('library.books.form', $book)
                            <div class="form-group">
                                <div class="col-sm-3 pl-0">
                                    <button type="submit" class="{{btnClass()}}">@lang('Update')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
