@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.sectionbar.district')
                <div class="panel panel-default">
                    <div class="panel-body">
                        @if (count($district)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Division Name')</th>
                                        <th scope="col">@lang('District Name')</th>
                                        <th scope="col">@lang('District Bangla')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        <th scope="col">@lang('Delete')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($district as $key=>$div)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td><small>
                                                    {{$div->division['name']}}
                                                </small>
                                            </td>
                                            <td><small>
                                                    {{$div->name}}
                                                </small>
                                            </td>
                                            <td><small>
                                                    {{$div->namebn}}
                                                </small>
                                            </td>
                                            <td>
                                                <small>
                                                    {{($div->status == 1) ? 'Active' : 'De-Active'}}
                                                </small>
                                            </td>


                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.district.edit',$div->id)}}">@lang('Edit')</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-danger" href="javascript:void(0)"
                                                   onclick="confirm_delete('{{$div->id}}')">@lang('Delete')</a>

                                                <form id="delete_form_{{$div->id}}"
                                                      action="{{route('academic.district.destroy',$div->id)}}"
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
                                    #districtSection {
                                        display: none
                                    }
                                </style>
                            @endpush

                            @push('script')
                                <script>
                                    $(document).ready(function () {
                                        function appendFunction() {
                                            var appendHtml = $("#districtSection").html();
                                            $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
                                        }

                                        setTimeout(function () {
                                            appendFunction();
                                        }, 1000);
                                    })
                                </script>
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