@extends('layouts.app')

@section('title', __('All Books'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('library/issued-books') .'">'. trans('Manage Library').'</a> /<a href="'. route('library.books.index') .'">'. trans('All Books').'</a> / <b>'.trans('Book Details').'<b>'])
                @include('components.sectionbar.library-bar')
                <hr>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-sm-3">
                            <img src="{{ $book->img_path }}" alt="{{ $book->title }}"/>
                        </div>
                        <div class="col-sm-9">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>@lang('Book Code')</th>
                                    <td>{{ $book->book_code }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Book Title')</th>
                                    <td>{{ $book->title }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Author')</th>
                                    <td>{{ $book->author }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('About')</th>
                                    <td>{{ $book->about }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Quantity')</th>
                                    <td>{{ $book->quantity }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Rack No')</th>
                                    <td>{{ $book->rackNo }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('row No')</th>
                                    <td>{{ $book->rowNo }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Type')</th>
                                    <td>{{ $book->type }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Price')</th>
                                    <td>{{ $book->price }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Class')</th>
                                    <td>{{ $book->class->class_number }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('School')</th>
                                    <td>{{ $book->school->name }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Created At')</th>
                                    <td>{{ $book->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Updated At')</th>
                                    <td>{{ $book->updated_at }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('Registered By')</th>
                                    <td>{{ $book->user->name }}</td>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
