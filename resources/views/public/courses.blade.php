@extends('public.layout.public')

@section('sliderText')
    <h1 class="page-title">COURSE</h1>
 
@endsection

@section('content')

    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <div id="rs-courses-3" class="rs-courses-3 sec-spacer">
        <div class="container">
            <div class="abt-title">
                <h2>OUR COURSES</h2>
            </div>
            <div class="gridFilter">
                <button class="active" data-filter="*">ALL</button>
                <button data-filter=".filter1">SCIENCE</button>
                <button data-filter=".filter2">BUSINESS</button>
                <button data-filter=".filter3">HUMANITIES</button>
                <button data-filter=".filter4">DIPLOMA</button>
            </div>
            <div class="row grid">
                <div class="col-lg-4 col-md-6 grid-item filter1">
                    <div class="course-item">
                        <div class="course-img">
                            <img src="{{asset('public/images/courses/10.jpg')}}" alt=""/>
                            <span class="course-value">$450</span>
                            <div class="course-toolbar">
                                <h4 class="course-category"><a href="#">Science</a></h4>
                                <div class="course-date">
                                    <i class="fa fa-calendar"></i> 28-06-2017
                                </div>
                                <div class="course-duration">
                                    <i class="fa fa-clock-o"></i> 4 year
                                </div>
                            </div>
                        </div>
                        <div class="course-body">
                            <div class="course-desc">
                                <h4 class="course-title"><a href="courses-details.html">Computer Engineering</a></h4>
                                <p>
                                    Cras ultricies lacus consectetur, consectetur scelerisque arcu.Curabitur Aenean
                                    egestas a
                                    Nullam augue augue.
                                </p>
                            </div>
                        </div>
                        <div class="course-footer">
                            <div class="course-seats">
                                <i class="fa fa-users"></i> 70 SEATS
                            </div>
                            <div class="course-button">
                                <a href="#">APPLY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 grid-item filter2">
                    <div class="course-item">
                        <div class="course-img">
                            <img src="{{asset('public/images/courses/11.jpg')}}" alt=""/>
                            <span class="course-value">$450</span>
                            <div class="course-toolbar">
                                <h4 class="course-category"><a href="#">Business</a></h4>
                                <div class="course-date">
                                    <i class="fa fa-calendar"></i> 28-06-2017
                                </div>
                                <div class="course-duration">
                                    <i class="fa fa-clock-o"></i> 4 year
                                </div>
                            </div>
                        </div>
                        <div class="course-body">
                            <div class="course-desc">
                                <h3 class="course-title"><a href="courses-details.html">Business Management</a></h3>
                                <p>
                                    Cras ultricies lacus consectetur, consectetur scelerisque arcu.Curabitur Aenean
                                    egestas a
                                    Nullam augue augue.
                                </p>
                            </div>
                        </div>
                        <div class="course-footer">
                            <div class="course-seats">
                                <i class="fa fa-users"></i> 70 SEATS
                            </div>
                            <div class="course-button">
                                <a href="#">APPLY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 grid-item filter4">
                    <div class="course-item">
                        <div class="course-img">
                            <img src="{{asset('public/images/courses/12.jpg')}}" alt=""/>
                            <span class="course-value">$450</span>
                            <div class="course-toolbar">
                                <h4 class="course-category"><a href="#">Diploma</a></h4>
                                <div class="course-date">
                                    <i class="fa fa-calendar"></i> 28-06-2017
                                </div>
                                <div class="course-duration">
                                    <i class="fa fa-clock-o"></i> 4 year
                                </div>
                            </div>
                        </div>
                        <div class="course-body">
                            <div class="course-desc">
                                <h3 class="course-title"><a href="courses-details.html">Diploma Electrical</a></h3>
                                <p>
                                    Cras ultricies lacus consectetur, consectetur scelerisque arcu.Curabitur Aenean
                                    egestas a
                                    Nullam augue augue.
                                </p>
                            </div>
                        </div>
                        <div class="course-footer">
                            <div class="course-seats">
                                <i class="fa fa-users"></i> 70 SEATS
                            </div>
                            <div class="course-button">
                                <a href="#">APPLY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 grid-item filter1">
                    <div class="course-item">
                        <div class="course-img">
                            <img src="{{asset('public/images/courses/13.jpg')}}" alt=""/>
                            <span class="course-value">$450</span>
                            <div class="course-toolbar">
                                <h4 class="course-category"><a href="courses-details.html">Science</a></h4>
                                <div class="course-date">
                                    <i class="fa fa-calendar"></i> 28-06-2017
                                </div>
                                <div class="course-duration">
                                    <i class="fa fa-clock-o"></i> 4 year
                                </div>
                            </div>
                        </div>
                        <div class="course-body">
                            <div class="course-desc">
                                <h4 class="course-title"><a href="courses-details.html">Civil Engineering</a></h4>
                                <p>
                                    Cras ultricies lacus consectetur, consectetur scelerisque arcu.Curabitur Aenean
                                    egestas a
                                    Nullam augue augue.
                                </p>
                            </div>
                        </div>
                        <div class="course-footer">
                            <div class="course-seats">
                                <i class="fa fa-users"></i> 70 SEATS
                            </div>
                            <div class="course-button">
                                <a href="#">APPLY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 grid-item filter3">
                    <div class="course-item">
                        <div class="course-img">
                            <img src="{{asset('public/images/courses/14.jpg')}}" alt=""/>
                            <span class="course-value">$450</span>
                            <div class="course-toolbar">
                                <h4 class="course-category"><a href="courses-details.html">Humanities</a></h4>
                                <div class="course-date">
                                    <i class="fa fa-calendar"></i> 28-06-2017
                                </div>
                                <div class="course-duration">
                                    <i class="fa fa-clock-o"></i> 4 year
                                </div>
                            </div>
                        </div>
                        <div class="course-body">
                            <div class="course-desc">
                                <h3 class="course-title"><a href="#">Bachelor of Arts</a></h3>
                                <p>
                                    Cras ultricies lacus consectetur, consectetur scelerisque arcu.Curabitur Aenean
                                    egestas a
                                    Nullam augue augue.
                                </p>
                            </div>
                        </div>
                        <div class="course-footer">
                            <div class="course-seats">
                                <i class="fa fa-users"></i> 70 SEATS
                            </div>
                            <div class="course-button">
                                <a href="#">APPLY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 grid-item filter2">
                    <div class="course-item">
                        <div class="course-img">
                            <img src="{{asset('public/images/courses/15.jpg')}}" alt=""/>
                            <span class="course-value">$450</span>
                            <div class="course-toolbar">
                                <h4 class="course-category"><a href="#">Business</a></h4>
                                <div class="course-date">
                                    <i class="fa fa-calendar"></i> 28-06-2017
                                </div>
                                <div class="course-duration">
                                    <i class="fa fa-clock-o"></i> 4 year
                                </div>
                            </div>
                        </div>
                        <div class="course-body">
                            <div class="course-desc">
                                <h3 class="course-title"><a href="courses-details.html">Master of Business A.</a></h3>
                                <p>
                                    Cras ultricies lacus consectetur, consectetur scelerisque arcu.Curabitur Aenean
                                    egestas a
                                    Nullam augue augue.
                                </p>
                            </div>
                        </div>
                        <div class="course-footer">
                            <div class="course-seats">
                                <i class="fa fa-users"></i> 70 SEATS
                            </div>
                            <div class="course-button">
                                <a href="#">APPLY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 grid-item filter4">
                    <div class="course-item">
                        <div class="course-img">
                            <img src="{{asset('public/images/courses/16.jpg')}}" alt=""/>
                            <span class="course-value">$350</span>
                            <div class="course-toolbar">
                                <h4 class="course-category"><a href="#">Diploma</a></h4>
                                <div class="course-date">
                                    <i class="fa fa-calendar"></i> 28-06-2017
                                </div>
                                <div class="course-duration">
                                    <i class="fa fa-clock-o"></i> 4 year
                                </div>
                            </div>
                        </div>
                        <div class="course-body">
                            <div class="course-desc">
                                <h3 class="course-title"><a href="courses-details.html">Diploma in Computer</a></h3>
                                <p>
                                    Cras ultricies lacus consectetur, consectetur scelerisque arcu.Curabitur Aenean
                                    egestas a
                                    Nullam augue augue.
                                </p>
                            </div>
                        </div>
                        <div class="course-footer">
                            <div class="course-seats">
                                <i class="fa fa-users"></i> 70 SEATS
                            </div>
                            <div class="course-button">
                                <a href="#">APPLY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 grid-item filter3 filter4">
                    <div class="course-item">
                        <div class="course-img">
                            <img src="{{asset('public/images/courses/17.jpg')}}" alt=""/>
                            <span class="course-value">$450</span>
                            <div class="course-toolbar">
                                <h4 class="course-category"><a href="courses-details.html">Humanities</a></h4>
                                <div class="course-date">
                                    <i class="fa fa-calendar"></i> 28-06-2017
                                </div>
                                <div class="course-duration">
                                    <i class="fa fa-clock-o"></i> 4 year
                                </div>
                            </div>
                        </div>
                        <div class="course-body">
                            <div class="course-desc">
                                <h4 class="course-title"><a href="#">Master of Arts</a></h4>
                                <p>
                                    Cras ultricies lacus consectetur, consectetur scelerisque arcu.Curabitur Aenean
                                    egestas a
                                    Nullam augue augue.
                                </p>
                            </div>
                        </div>
                        <div class="course-footer">
                            <div class="course-seats">
                                <i class="fa fa-users"></i> 70 SEATS
                            </div>
                            <div class="course-button">
                                <a href="#">APPLY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 grid-item filter1">
                    <div class="course-item">
                        <div class="course-img">
                            <img src="{{asset('public/images/courses/18.jpg')}}" alt=""/>
                            <span class="course-value">$425</span>
                            <div class="course-toolbar">
                                <h4 class="course-category"><a href="#">Science</a></h4>
                                <div class="course-date">
                                    <i class="fa fa-calendar"></i> 28-06-2017
                                </div>
                                <div class="course-duration">
                                    <i class="fa fa-clock-o"></i> 4 year
                                </div>
                            </div>
                        </div>
                        <div class="course-body">
                            <div class="course-desc">
                                <h3 class="course-title"><a href="courses-details.html">Electronics Engineering</a></h3>
                                <p>
                                    Cras ultricies lacus consectetur, consectetur scelerisque arcu.Curabitur Aenean
                                    egestas a
                                    Nullam augue augue.
                                </p>
                            </div>
                        </div>
                        <div class="course-footer">
                            <div class="course-seats">
                                <i class="fa fa-users"></i> 70 SEATS
                            </div>
                            <div class="course-button">
                                <a href="#">APPLY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item disabled"><a class="page-link fa fa-angle-left" href="#" tabindex="-1"></a>
                    </li>
                    <li class="page-item"><a class="page-link active" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link dotted" href="#">...</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                    <li class="page-item"><a class="page-link fa fa-angle-right" href="#"></a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection