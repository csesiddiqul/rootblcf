@extends('public.layout.public',['title' => transMsg('Gallery') ])
@section('sliderText')
    <h1 class="page-title">@lang('OUR GALLERY')</h1>
@endsection
@section('content')
    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <div class="rs-gallery sec-spacer">
        <div class="container">
           @if (count($gallerys) > 0)
            <div class="row">
                @foreach($gallerys as $gallery)
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        @php
                        if (empty($gallery->photo)) {
                           $image = asset('image/no_image.png');
                        }else{
                          $image = $gallery->photo;
                        }
                        @endphp
                        <img src="{{$image}}" alt="Gallery Image"/>
                        <div class="gallery-desc">
                            @isset($gallery->title)
                            <h3><a href="#">{{$gallery->title}}</a></h3>
                            @endisset

                            @isset($gallery->description)
                            <p>{{$gallery->description}}</p>
                            @endisset

                            <a class="image-popup" href="{{$image}}" title="{{$gallery->title}}">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
               @endforeach
                
            </div>
            <nav aria-label="Page navigation example">
                    {{$gallerys->links()}}
            </nav>
            @else
                <div class="alert alert-danger text-center">
                    @lang('Data not found')
                </div>
            @endif
        </div>
    </div>
@endsection