@extends('layouts.app')

@section('title', __('Students'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                <div class="panel panel-default">
                    <div id="sectionClass" class="{{count($sections)>0 ? 'd-none':''}}">
                        <div class="btn-group new_b" style="overflow: hidden;">
                            <a href="{{route('academic.class')}}" class="btn {{route('academic.class')? 'active':''}}">@lang('View Section')</a>
                            @include('layouts.master.create-section-form')
                        </div>
                    </div>
                    <div class="panel-body">

                       {{-- <div class="form-check">
                            <?php
                            $checked = Session::has('ignoreSessions') ? (Session::get('ignoreSessions') == "true" ? "checked='checked'" : "") : "";
                            ?>
                            <input class="form-check-input position-static" type="checkbox" name="ignoreSessionsCheck" id="ignoreSessionsId" <?php echo $checked ?>>
                            @lang("Ignore Sessions when listing students for promoting")
                        </div>--}}
                        @if (count($sections)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">@lang('SL')</th>
                                        <th scope="col">@lang('Section Name')</th>
                                        <th scope="col">@lang('Room Number')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sections as $key=> $section)
                                        <tr>
                                            <td scope="row">{{$key+1}}</td>
                                            <td>@lang('Section') {{$section->section_number}}</td>
                                            <td>{{$section->room_number}}</td>
                                            <td><small> {{$section->status == 1 ? 'Active' : 'Inactive'}}
                                                </small>
                                            </td>
                                            @if(Auth::user()->role == 'admin')
                                                <td>
                                                    <a class="btn btn-xs btn-default" href="{{route('school.section.edit',[$section->class_id,$section->id])}}">@lang('Edit')</a>
                                                    <a class="btn btn-xs btn-success" href="{{url('school/promote-students/'.$section->id)}}">+ @lang('Promote Students')</a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{$sections->links()}}
                        @else
                            @lang('No Related Data Found.')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function (){
            function appendFunction(){
                var appendHtml = $("#sectionClass").html();
                $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
            }
            setTimeout(function(){ appendFunction() }, 1000);
        })
    </script>
@endpush