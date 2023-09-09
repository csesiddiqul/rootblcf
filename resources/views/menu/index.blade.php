@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('school.website').'">'. trans('Website Settings').'</a> / <b>'.trans('Menus list').'<b>'])
                @include('components.sectionbar.frontmanagement-bar',['menus'=>$menus])
                <div class="panel panel-default">
                    <div class="panel-body" style="padding-top: 0px !important; ">
                        @if (count($menus)>0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-data-div table-condensed table-striped table-hover"
                                       style="margin-top: 10px !important; ">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">@lang('Name')</th>
                                        <th scope="col">@lang('Parent Menu')</th>
                                        <th scope="col">@lang('Slug')</th>
                                        <th scope="col">@lang('Priority')</th>
                                        <th scope="col">@lang('Page/Dropdown')</th>
                                        <th scope="col">@lang('Status')</th>
                                        <th scope="col">@lang('Edit')</th>
                                        <th scope="col">@lang('Delete')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($menus as $key=>$menu)
                                        <tr @if ($menu->type == 2)id="tr{{$menu->id}}" @endif>
                                            <th scope="row">{{  $key + 1 }}</th>
                                            <td><small>{{$menu->name}}</small></td>
                                            <td><small>{{$menu->parentMenu->name??''}}</small></td>
                                            <td><small>{{$menu->slug}}</small></td>
                                            <td><small>{{$menu->priority}}</small></td>
                                            <td><small>{{$menu->url == 1 ? 'Page' : 'dropdown'}}</small></td>
                                            <td><small>
                                                    <span class="label label-{{$menu->status ==1 ? 'success' : 'danger'}}">{{status($menu->status)}}</span></small>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-default"
                                                   href="{{route('academic.menu.edit',$menu->id)}}">@lang('Edit')</a>
                                            </td>
                                            <td>
                                                @if ($menu->type == 2)
                                                    <a class="btn btn-xs btn-danger"
                                                       onclick="confirm_delete('{{$menu->id}}')">@lang('Delete')</a>

                                                    <form id="delete_form_{{$menu->id}}"
                                                          action="{{route('academic.menu.destroy',$menu->id)}}"
                                                          method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @push('script')
                                <style>
                                    #menuSection {
                                        display: none
                                    }
                                </style>
                                <script>
                                    $(document).ready(function () {
                                        @if ($menusContent = session('menusContent'))
                                        menusContent('{{$menusContent->id}}', '{{$menusContent->name}}');
                                        @endif
                                        function appendFunction() {
                                            var appendHtml = $("#menuSection").html();
                                            $(".table-responsive div.row:first-child div.col-sm-6:first-child").html(appendHtml);
                                        }
                                        setTimeout(function () {
                                            appendFunction();
                                            $("#menuSection").html('');
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

