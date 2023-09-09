@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. url('users/'.Auth::user()->school->code.'/1/0').'">'. transMsg('Students').'</a> / <b>'.transMsg('Student '.(school('country')->code == 'SG' ? 'Branch' : 'House')).'<b>'])
                @include('components.sectionbar.house-bar',['houses'=>$houses])
                <div class="panel panel-default">
                    <div class="panel-body" style="padding-top: 0px !important;">
                        @if (count($houses)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Name')</th>
                                        <th scope="col">@lang('Description')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        <th scope="col">@lang('Delete')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($houses as $key=>$house)
                                        <tr>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td><small> <a href="{{route('academic.house.show',$house->id)}}">{{$house->name}}</a>
                                                </small>
                                            </td>
                                            <td><small>{!! \Illuminate\Support\Str::limit($house->description,50) !!}
                                                </small>
                                            </td>
                                            <td><small> {{status($house->status)}}
                                                </small>
                                            </td>

                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.house.edit',$house->id)}}">@lang('Edit')</a>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-danger"
                                                   onclick="confirm_delete('{{$house->id}}')">@lang('Delete')</a>

                                                <form id="delete_form_{{$house->id}}"
                                                      action="{{route('academic.house.destroy',$house->id)}}"
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
                                    #houseSection {
                                        display: none
                                    }
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
                var appendHtml = $("#houseSection").html();
                $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
            }

            setTimeout(function () {
                appendFunction();
            }, 1000);
        })
    </script>
@endpush


