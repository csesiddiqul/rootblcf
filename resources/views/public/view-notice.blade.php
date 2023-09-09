@extends('public.layout.public',['title' => transMsg('Notice') ])
@section('sliderText')
    <h1 class="page-title">@lang('Notices')</h1>
@endsection
@push('styles')
    <style>
        .table td, .table th {
            border-top: 1px solid #dee2e6 !important;
        }
    </style>
@endpush
@section('content')
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <div id="rs-latest-news" class="rs-latest-news sec-spacer">
        <div class="container">
            <div class="row table-responsive">
                <table class="table table-bordered no-footer datatable">
                    <thead class="text-center">
                    <tr>
                        <th>@lang('SN')</th>
                        <th>@lang('Date')</th>
                        <th>@lang('Title')</th>
                        <th>@lang('File')</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if (count($notices)>0)
                        @foreach($notices as $notice)
                            <tr>
                                <td width="10%">{{enTobnLang($loop->index +1)}}</td>
                                <td width="15%">{{enTobnLang(date('Y-m-d',strtotime($notice->created_at)))}}</td>
                                <td width="65%"><a
                                            href="{{route('single.notice',$notice->slug)}}">{{$notice->title}}</a></td>
                                <td width="10%">
                                    @if(!empty($notice->file_path))
                                        <a href="{{$notice->file_path}}" download>
                                            <img src="{{getIconByExtension(pathinfo($notice->file_path, PATHINFO_EXTENSION))}}"
                                                 alt="" style="width: 40% !important;">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center text-danger">@lang('No notice was published')</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                {{--<div class="news-list-block">
                    @foreach($notices as $notice)
                        <div class="news-list-item col-md-6" style="cursor: pointer; float: left; "
                             onclick="window.location='{{route('single.notice',$notice->slug)}}';">
                            <div class="news-img">
                                <a href="#">
                                    <img src="{{getIconByExtension(pathinfo($notice->file_path, PATHINFO_EXTENSION))}}"
                                         alt=""/>
                                </a>
                            </div>
                            <div class="news-content">
                                <h5 class="news-title"><a
                                            href="{{route('single.notice',$notice->slug)}}">{{$notice->title}}</a>
                                </h5>
                                <div class="news-date">
                                    <i class="fa fa-calendar-check-o"></i>
                                    <span>{{date('M d,Y',strtotime($notice->created_at))}}</span>
                                </div>
                                <div class="news-desc">
                                    <p>
                                        <a href="{{route('single.notice',$notice->slug)}}">{!! \Illuminate\Support\Str::limit($notice->description,80) !!}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>--}}
            </div>
            {{--<nav aria-label="Page navigation example">
                {{$notices->links()}}
            </nav>--}}
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            @if((session('localLang') ?? 'en') == 'bn')
            $('.datatable').DataTable({'pageLength': 25,'language':{url:"{{asset('excel/bn.json')}}"}});
            @else
            $('.datatable').DataTable({'pageLength': 25});
            @endif
        });
    </script>
    <style>
        .pagination .page-item > * {
            width: 30px;
            height: 40px;
            line-height: 35px;
        }

        .pagination #DataTables_Table_0_previous > * ,.pagination  #DataTables_Table_0_next > *  {
            width: 80px !important;
        }
    </style>
@endsection