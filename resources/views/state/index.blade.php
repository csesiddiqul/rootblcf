@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.sectionbar.state-bar')
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if (count($state)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Country Name')</th>
                                        <th scope="col">@lang('State Name')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        <th scope="col">@lang('Delete')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($state as $key=>$sta)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td><small>
                                                    {{$sta->country['name']}}
                                                </small>
                                            </td>
                                            <td><small>
                                                    {{$sta->name}}
                                                </small>
                                            </td>
                                            <td>
                                                <small>
                                                    {{$sta->status == 1 ? 'Active':'Inactive'}}
                                                </small>
                                            </td>


                                            <td>
                                                <a class="btn btn-xs btn-danger"
                                                   href="{{route('academic.state.edit',$sta->id)}}">@lang('Edit')</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-danger"
                                                   onclick="confirm_delete('{{$sta->id}}')">@lang('Delete')</a>

                                                <form id="delete_form_{{$sta->id}}"
                                                      action="{{route('academic.state.destroy',$sta->id)}}"
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
                             @push('styles')
                            <style>
                                #stateSection{display: none}
                            </style>
                        @endpush
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
@push('script')
    <script>
        $(document).ready(function () {
            function appendFunction() {
                var appendHtml = $("#stateSection").html();
                $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
            }

            setTimeout(function () {
                appendFunction();
                $("#stateSection").html('');
            }, 1000);
        })
    </script>
@endpush