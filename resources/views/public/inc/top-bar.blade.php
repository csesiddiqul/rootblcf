<!-- Toolbar Start -->
<div class="rs-toolbar">
    <div class="container">
        <div class="row">
            <div class="col-md-4  col-sm-12 d-md-block d-none">
                <div class="rs-toolbar-left">
                    <div class="toolbar-share-icon">
                        <ul>
                            <li><a href="{{foqas_setting('facebook')}}"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{foqas_setting('twitter')}}"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{{foqas_setting('linkedin')}}"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="{{foqas_setting('pinterest')}}"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-12 pl pr">
                <div class="rs-toolbar-right pull-right">
                    <div class="transcss pull-right ml-3 ml-10">
                        @php($localLang = session('localLang') ?? \App::getLocale())
                        <form action="{{route('setLang')}}" autocomplete="off" method="POST">
                            @csrf
                            <select name="lang" autocomplete="off" onchange="this.form.submit()"
                                    title="@lang('Change language')">
                                <option value="bn" {{$localLang == 'bn' ? 'selected' : ''}}>Bangla</option>
                                <option value="en" {{$localLang == 'en' ? 'selected' : ''}}>English</option>
                            </select>
                        </form>
                    </div>
                    <a href="{{route('login')}}" class="apply-btn">@lang('Login')</a>
                    @if(school('country')->code == 'BD')
                        <a href="#" class="apply-btn beforedivider" onclick="registry_sweet()">@lang('Register')</a>
                    @endif
                    @if (foqas_setting('admission_form') == 1)
                        <a href="{{route('apply.admission')}}" class="apply-btn beforedivider">@lang('Apply Now')</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Toolbar End -->
<!-- Toolbar Start -->

{{--<div class="container-fluid">
    <div class="row">

        <div class="col-md-12 col-sm-12" style=" background-color: #282828;">
           <marquee direction="left" style="color: #fff;">
This is a sample scrolling text that has scrolls texts to left.
</marquee>
        </div>
    </div>
</div>--}}

<!-- Toolbar End -->

