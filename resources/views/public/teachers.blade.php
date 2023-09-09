@extends('public.layout.public',['title' => transMsg('Teacher') ])
@section('sliderText')
    <h1 class="page-title">@lang('OUR TEACHERS')</h1>
@endsection
@section('content')
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <style>
        .rs-team-single .team-icons a:hover{
            background-color: {{foqas_setting('theme_bg')}}        !important;
            color: {{foqas_setting('theme_color')}}        !important;
        }
        .rs-team-single .team-icons a,.team-item .social-icon i{
            color: {{foqas_setting('theme_bg')}}        !important;
        }
    </style>
    <div id="rs-team-2" class="rs-team-2 team-page sec-spacer">
        <div class="container">
            {{--<div class="gridFilter">
                <button class="active" data-filter="*">ALL</button>
                <button data-filter=".filter1">SCIENCE</button>
                <button data-filter=".filter2">BUSINESS STUDIES</button>
                <button data-filter=".filter3">ARTS</button>
                <button data-filter=".filter4">DIPLOMA</button>
            </div>--}}
            @if (count($teachers) > 0)
                <div class="row grid">
                    @foreach($teachers as $teacher)
                        <div class="col-lg-3 col-md-6 col-xs-6 grid-item filter1">
                            <div class="team-item">
                                <div class="team-img">
                                    @empty($teacher->pic_path)
                                        @php $profileImage = asset('image/blank.jpg') @endphp
                                    @else
                                        @php $profileImage = $teacher->pic_path @endphp
                                    @endempty
                                    <a href="{{route('teacher.show',['id'=>$teacher->id,'name'=>$teacher->name])}}">
                                        <img src="{{$profileImage}}" alt=""/>
                                    </a>
                                    <div class="social-icon">
                                        <a href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
                                        <a href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
                                        <a href="javascript:void(0)"><i class="fa fa-google-plus"></i></a>
                                        <a href="javascript:void(0)"><i class="fa fa-linkedin"></i></a>
                                    </div>
                                </div>
                                <div class="team-body">
                                    <a href="{{route('teacher.show',['id'=>$teacher->student_code,'name'=>\Illuminate\Support\Str::slug($teacher->name)])}}">
                                        <h3 class="name">{{$teacher->name}}</h3></a>
                                    <span class="designation">{{ucwords($teacher->role_title)}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <nav aria-label="Page navigation example">
                    {{$teachers->links()}}
                </nav>
            @else
                <div class="alert alert-danger text-center">
                    data not found
                </div>
            @endif
        </div>
    </div>
@endsection