@extends('layout.public')

@section('sliderText')
    <h1 class="page-title">BLOG DETAILS</h1>
    
@endsection

@section('content')

    @include('inc.pages-header')
    @include('inc.pages-slider')
    <div class="single-blog-details sec-spacer">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="single-image">
                        <img src="{{asset('public/images/blog-details/1.jpg')}}" alt="single">
                    </div>{{--single-image End --}}

                    <h5 class="top-title">There is really no discipline that is more tightly intertwined</h5>
                    <p>Lorem Ipsum is simply dummy text of the and typesetting industry. Lorem Ipsum is has been the
                        try’s stasn ndard dummy text ever since the 1500s, when an unknown printer took a galley of it
                        to make. Lorem Ipsum is the simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the indus try’s standard they dummy text ever since the 1500s, when an unknown
                        printer took a galley of type and scram bled it to make a type specimen book.</p>
                    <blockquote>
                        <i class="fa fa-quote-right" aria-hidden="true"></i>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                        the indus try’s standard.
                    </blockquote>
                    <p>Lorem Ipsum is simply dummy text of the and typesetting industry. Lorem Ipsum is has been the
                        industry’s stasn ndard dummy text ever since the 1500s. </p>
                    <p>Lorem Ipsum is simply dummy text of the and typesetting industry. Lorem Ipsum is has been the
                        industry’s stasn ndard dummy text ever since the 1500s, when an unknown printer took a galley of
                        it to make. Lorem Ipsum is the simply dummy text.</p>
                    <div class="share-section">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 life-style">
									<span class="author"> 
										<a href="#"><i class="fa fa-user-o" aria-hidden="true"></i> Admin </a>
									</span>
                                <span class="comment">
										<a href="#"> 
											<i class="fa fa-commenting-o" aria-hidden="true"></i> 12
										</a>
									</span>
                                <span class="date">
										<i class="fa fa-calendar" aria-hidden="true"></i> Sep 13, 2017 
									</span>
                                <span class="cat">
										<a href="#"><i class="fa fa-folder-o" aria-hidden="true"></i> Life Style </a>
									</span>
                            </div>
                            <div class="col-lg-6 col-md--12">
                                <ul class="share-link1">
                                    <li><a href="#"> Tags:</a></li>
                                    <li><a href="#"> Building</a></li>
                                    <li><a href="#"> Plumbing</a></li>
                                    <li><a href="#"> Painting</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>{{--share-section End --}}

                    <div class="share-section2">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <span> You Can Share It : </span>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <ul class="share-link">
                                    <li><a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i> Facebook</a></li>
                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i> Twitter</a></li>
                                    <li><a href="#"><i class="fa fa-google" aria-hidden="true"></i> Google</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>{{--share-section2 End --}}

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <ul class="next-pre-section">
                                <li class="left-arrow"><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i>
                                        Previous Post</a></li>
                                <li class="right-arrow"><a href="#">Next Post <i class="fa fa-angle-right"
                                                                                 aria-hidden="true"></i> </a></li>
                            </ul>{{--next-pre-section End --}}
                        </div>
                    </div>
                    <div class="like-section mt-30">
                        <h3 class="title-bg">YOU MIGHT ALSO LIKE</h3>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="popular-post-img">
                                    <a href="#"><img src="{{asset('public/images/blog-details/mid1.jpg')}}" alt="Blog single photo"></a>
                                </div>
                                <h5>
                                    <a href="#">Easy to Use Your Gallery</a>
                                </h5>
                                <span class="date"><i class="fa fa-calendar" aria-hidden="true"></i> Sep 13, 2017</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="popular-post-img">
                                    <a href="#"><img src="{{asset('public/images/blog-details/mid2.jpg')}}" alt="Blog single photo"></a>
                                </div>
                                <h5>
                                    <a href="#">Easy to Use Your Gallery</a>
                                </h5>
                                <span class="date"><i class="fa fa-calendar" aria-hidden="true"></i> Sep 13, 2017</span>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="popular-post-img">
                                    <a href="#"><img src="{{asset('public/images/blog-details/mid3.jpg')}}" alt="Blog single photo"></a>
                                </div>
                                <h5>
                                    <a href="#">Easy to Use Your Gallery</a>
                                </h5>
                                <span class="date"><i class="fa fa-calendar" aria-hidden="true"></i> Sep 13, 2017</span>
                            </div>
                        </div>
                    </div> {{--like-section End --}}
                    <div class="author-comment">
                        <h3 class="title-bg">Recent Comments</h3>
                        <ul>
                            <li>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        <div class="image-comments"><img src="{{asset('public/images/blog-details/comment.png')}}"
                                                                         alt="Blog Details photo"></div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                        <span class="reply"> <span class="date"><i class="fa fa-calendar"
                                                                                   aria-hidden="true"></i> Sep 13, 2017</span></span>
                                        <div class="dsc-comments">
                                            <h4>Thesera Minton</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do they
                                                eiusmod tempor incidi dunt ut labore et dolore magna aliquat enim ad
                                                minim veniam ad minim veniam.</p>
                                            <a href="#"> Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        <div class="image-comments"><img src="{{asset('public/images/blog-details/comment.png')}}"
                                                                         alt="Blog Details photo"></div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                        <span class="reply"> <span class="date"><i class="fa fa-calendar"
                                                                                   aria-hidden="true"></i> Sep 13, 2017</span></span>
                                        <div class="dsc-comments">
                                            <h4>Thesera Minton</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do they
                                                eiusmod tempor.</p>
                                            <a href="#"> Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        <div class="image-comments"><img src="{{asset('public/images/blog-details/comment.png')}}"
                                                                         alt="Blog single photo"></div>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                        <span class="reply"><span class="date"><i class="fa fa-calendar"
                                                                                  aria-hidden="true"></i> Sep 13, 2017</span></span>
                                        <div class="dsc-comments">
                                            <h4>Thesera Minton</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do they
                                                eiusmod tempor incidi dunt ut labore et dolore magna aliquat enim ad
                                                minim veniam ad minim veniam.</p>
                                            <a href="#"> Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>{{--author-comment End --}}
                    <div class="leave-comments-area">
                        <form>
                            <fieldset>
                                <h4 class="title-bg">Leave Comments</h4>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Fast Name*</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Last Name*</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Email*</label>
                                            <input type="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Website</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label>Your comment here...</label>
                                            <textarea cols="40" rows="10" class="textarea form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button class="btn-send" type="submit">Post Comment</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>{{--leave-comments-area end --}}
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="sidebar-area">
                        <div class="search-box">
                            <h3 class="title">Search Courses</h3>
                            <div class="box-search">
                                <input class="form-control" placeholder="Search Here ..." name="srch-term"
                                       id="srch-term" type="text">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"
                                                                                 aria-hidden="true"></i></button>
                            </div>
                        </div>{{--search-box end --}}
                        <div class="cate-box">
                            <h3 class="title">Categories</h3>
                            <ul>
                                <li>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Analysis & Features
                                        <span>(05)</span></a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Video Reviews
                                        <span>(07)</span></a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">Engineering Tech
                                        <span>(09)</span></a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#"> Righteous
                                        Indignation <span>(08)</span></a>
                                </li>
                                <li>
                                    <i class="fa fa-angle-right" aria-hidden="true"></i> <a href="#">General Education
                                        <span>(04)</span></a>
                                </li>
                            </ul>
                        </div>{{-- cate-box end --}}
                        <div class="latest-courses">
                            <h3 class="title">Latest Courses</h3>
                            <div class="post-item">
                                <div class="post-img">
                                    <a href="blog-details.html"><img src="{{asset('public/images/blog-details/sm1.jpg')}}" alt=""
                                                                     title="News image"></a>
                                </div>
                                <div class="post-desc">
                                    <h4><a href="blog-details.html">Raken develops reporting The software</a></h4>
                                    <span class="duration">
	                                        <i class="fa fa-clock-o" aria-hidden="true"></i> 4 Years
	                                    </span>
                                    <span class="price">Price: <span>$350</span></span>
                                </div>
                            </div>{{-- post-item end --}}
                            <div class="post-item">
                                <div class="post-img">
                                    <a href="blog-details.html"><img src="{{asset('public/images/blog-details/sm2.jpg')}}" alt=""
                                                                     title="News image"></a>
                                </div>
                                <div class="post-desc">
                                    <h4><a href="blog-details.html">Raken develops reporting The software</a></h4>
                                    <span class="duration">
	                                        <i class="fa fa-clock-o" aria-hidden="true"></i> 4 Years
	                                    </span>
                                    <span class="price">Price: <span>$350</span></span>
                                </div>
                            </div>{{---- post-item end --}}
                            <div class="post-item">
                                <div class="post-img">
                                    <a href="blog-details.html"><img src="{{asset('public/images/blog-details/sm3.jpg')}}" alt=""
                                                                     title="News image"></a>
                                </div>
                                <div class="post-desc">
                                    <h4><a href="blog-details.html">Raken develops reporting The software</a></h4>
                                    <span class="duration">
	                                        <i class="fa fa-clock-o" aria-hidden="true"></i> 4 Years
	                                    </span>
                                    <span class="price">Price: <span>$350</span></span>
                                </div>
                            </div>{{-- post-item end --}}
                        </div>
                        <div class="tags-cloud clearfix">
                            <h3 class="title">Product Tags</h3>
                            <ul>
                                <li>
                                    <a href="#">SCIENCE</a>
                                </li>
                                <li>
                                    <a href="#">HUMANITIES</a>
                                </li>
                                <li>
                                    <a href="#">DIPLOMA</a>
                                </li>
                                <li>
                                    <a href="#">BUSINESS</a>
                                </li>
                                <li>
                                    <a href="#">SPROTS</a>
                                </li>
                                <li>
                                    <a href="#">RESEARCH</a>
                                </li>
                                <li>
                                    <a href="#">ARTS</a>
                                </li>
                                <li>
                                    <a href="#">ADMISSIONS</a>
                                </li>
                            </ul>
                        </div>{{-- tags-cloud end --}}

                        <div class="newsletter">
                            <h4>Newsletter</h4>
                            <p>Sign up for our Newsletter !</p>
                            <div class="box-newsletter">
                                <input class="form-control" placeholder="support@rstheme.com" name="newsletter-term"
                                       id="newsletter-term" type="text">
                                <button class="btn btn-default" type="submit"><i class="fa fa-arrow-right"
                                                                                 aria-hidden="true"></i></button>
                            </div>
                        </div>{{-- newsletter end --}}
                    </div>{{-- sidebar-area end --}}
                </div>
            </div>
        </div>
    </div>
@endsection