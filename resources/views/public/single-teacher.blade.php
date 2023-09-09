@extends('public.layout.public',['title' => $teacher->name,'tname'=>true ])

@section('sliderText')
    <h1 class="page-title">{{$teacher->name}}</h1>
@endsection
@section('content')
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <!-- Team Single Start -->
    <div class="rs-team-single pt-100">
        <div class="container">
            <div class="row team">
                <div class="col-lg-4 col-md-12">
                    <div class="team-photo mobile-mb-40">
                       @empty($teacher->pic_path)
                            @php $profileImage = asset('image/blank.jpg') @endphp
                        @else
                            @if (file_exists($teacher->pic_path))
                                @php $profileImage = icpl_image($teacher->pic_path) @endphp
                            @else
                                @php $profileImage = asset('image/blank.jpg') @endphp
                            @endif
                        @endempty
                        <img src="{{$profileImage}}" alt="Team1">
                        <div class="team-icons" style="text-align: left">
                            <a href="#" title="facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="#" title="twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="#" title="google plus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                            <a href="#" title="linkedin">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <h3 class="team-name">{{$teacher->name}}</h3>
                    <h6 class="team-title">{{ucwords($teacher->role_title)}}</h6>
                    <div class="team-contact">
                        @if(!empty($teacher->phone_number))
                            <i class="fa fa-mobile"></i>  {{$teacher->phone_number}}<br>
                        @endif
                        @if(!empty($teacher->email))
                            <i class=" fa fa-envelope-o"></i>  {{$teacher->email}}<br>
                        @endif
                        @if(!empty($teacher->blood_group))
                            <i class=" fa fa-tint"></i>  {{bloodgroup($teacher->blood_group,true)}}<br>
                        @endif
                        @if(!empty($teacher->nationality))
                            <i class=" fa fa-flag"></i>  {{$teacher->nationality}}<br>
                        @endif
                        @if(!empty($teacher->address))
                            <i class=" fa fa-address-card-o"></i>  {{$teacher->address}}
                        @endif
                    </div>
                    @if(!empty($teacher->about))
                        <div style="width: 100%;text-align: justify">
                            <h5>@lang('About')</h5>
                            {!! nl2br($teacher->about) !!}
                        </div>
                    @endif
                    {{--<div class="team-skill">
                        <h3 class="skill-title">Our Teacher Skill:</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="progress rs-progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width:95%">
                                        <span class="pb-label">Accounting</span>
                                        <span class="pb-percent">95%</span>
                                    </div>
                                </div>
                                <div class="progress rs-progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width:85%">
                                        <span class="pb-label">Reading</span>
                                        <span class="pb-percent">85%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="progress rs-progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="88" aria-valuemin="0" aria-valuemax="100" style="width:88%">
                                        <span class="pb-label">Writing</span>
                                        <span class="pb-percent">88%</span>
                                    </div>
                                </div>
                                <div class="progress rs-progress">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:75%">
                                        <span class="pb-label">Speaking</span>
                                        <span class="pb-percent">75%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>
    <!-- Team Single End -->
    <style>
        .team-contact i {
            margin-right: 10px;
            width: 15px;
        }
    </style>
@endsection
