@extends('layouts.app')

@section('title', __('Register'))
@section('content')
    <style>
        h4 {
            font-size: 21px !important;
        }

        .border {
            border: none !important;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.contact.index').'">'. trans('Communicate').'</a>  / <a href="'. route('academic.complain.index').'">'. trans('Feedback').'</a>  / <b>'. $complain->name.'<b>'])
                @include('components.sectionbar.communicate-bar')
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <form action="">

                                <div class="form-group col-md-4">
                                    <label for="title">Name</label>
                                    <input type="text" name="name" class="form-control border" id="name" readonly
                                           value="{{$complain->name}}">

                                    @error('name')
                                    <span class="help-block">
                                <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="title"> @lang('Contact Number')</label>
                                    <input type="text" name="contactnumber" class="form-control border"
                                           id="contactnumber" readonly value="{!! $complain->contactnumber !!} ">

                                    @error('contactnumber')
                                    <span class="help-block">
                                <strong>{{ $message }}</strong>
                        </span>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="email"> @lang('Email')</label>
                                    <input type="email" name="email" class="form-control border" readonly id="email"
                                           value="{!! $complain->email !!}">
                                    @error('email')
                                    <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>


                                <div class="form-group col-md-12">
                                    <label for="description"> @lang('Description')</label>
                                    <textarea name="description" class="form-control rounded-0 border " readonly
                                              id="description" rows="5">{!! $complain->description !!}</textarea>
                                    @error('description')
                                    <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="remark"> @lang('Remark')</label>
                                    <textarea name="remark" class="form-control rounded-0 border " readonly id="remark"
                                              rows="2">{!! $complain->remark !!}</textarea>
                                    @error('description')
                                    <span class="help-block">
                                <strong>{{ $message }}</strong>
                            </span>
                                    @enderror
                                </div>

                                <div class="clearhight"></div>

                                <div class="col-md-2 text-center">
                                    <a href="{{route('academic.complain.index')}}"
                                       class="{{btnClass()}}">@lang('Back')</a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
