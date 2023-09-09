<script>
    $(document).ready(function () {
        $('.nav-item.active').removeClass('active');
        $('a[href="' + window.location.href + '"]').closest('li').closest('ul').closest('li').addClass('active');
        $('a[href="' + window.location.href + '"]').closest('li').addClass('active');
    });
</script>
<style>
    .nav-item.active, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .nav-item.active, .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus {
        background-color: #ecf0f1;
        font-weight: bold;
        color: #282828;
    }

    .nav-item.active a {
        color: #282828;
    }

    .nav-link-text {
        padding-left: 5%;
    }

    #side-navbar ul > li > a {
        padding: 8px 10px;
    }
</style>
<div class="collapse navbar-collapse" id="app-navbar-collapse">
    <!-- Left Side Of Navbar For Agent -->
    <ul class="nav  flex-column">
        @if(Auth::user()->role == 'agent')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}"><i class="fa fa-dashboard"></i> <span class="nav-link-text">@lang('Dashboard') </span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('agent.profile',auth()->user()->student_code) }}"><i class="fa fa-user"></i> <span class="nav-link-text">@lang('My Profile') </span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('agent.school.list',auth()->user()->student_code) }}"><i class="fa fa-graduation-cap"></i> <span class="nav-link-text">@lang('My Schools') </span></a>
        </li>  
        <li class="nav-item">
            <a class="nav-link" href="{{ route('agent.index',auth()->user()->student_code) }}"><i class="fa fa-credit-card-alt"></i> <span class="nav-link-text">@lang('School Payments') </span></a>
        </li> 
        <li class="nav-item">
            <a class="nav-link" href="{{ route('agent.unpaid',auth()->user()->student_code) }}"><i class="fa fa-credit-card"></i> <span class="nav-link-text">@lang('My Payments') </span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pricings.list') }}"><i class="fa fa-money"></i> <span class="nav-link-text">@lang('Pricings') </span></a>
        </li>  
        @endif
    </ul>
</div>
