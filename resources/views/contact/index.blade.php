@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.contact.index').'">'. trans('Communicate').'</a>  / <b>'. trans('Contact').'<b>'])
                @include('components.sectionbar.communicate-bar')
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if (count($contacts)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Name')</th>
                                        <th scope="col">@lang('Email')</th>
                                        <th scope="col">@lang('Phone')</th>
                                        <th scope="col">@lang('Subject')</th>
                                        <th scope="col">@lang('Message')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        <th scope="col">@lang('Delete')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($contacts as $key=>$contact)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td><small> {{$contact->name}}
                                                </small>
                                            </td>
                                            <td><small> {!! $contact->email !!}
                                                </small>
                                            </td>
                                            <td><small> {!! $contact->phone !!}
                                                </small>
                                            </td>
                                            <td><small> {!! $contact->subject !!}
                                                </small>
                                            </td>
                                            <td><small> {!! $contact->message !!}
                                                </small>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.contact.edit',$contact->id)}}">@lang('Edit')</a>
                                            </td>

                                            <td>
                                                <a class="btn btn-xs btn-danger"
                                                   onclick="confirm_delete('{{$contact->id}}')">@lang('Delete')</a>

                                                <form id="delete_form_{{$contact->id}}"
                                                      action="{{route('academic.contact.destroy',$contact->id)}}"
                                                      method="POST" style="display: none;">
                                                    {{ csrf_field() }}
                                                    @method('DELETE')
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="panel-body">
                                @lang('No Related Data Found.')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

