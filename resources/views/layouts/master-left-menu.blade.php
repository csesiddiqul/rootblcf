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
    .w-12 {
        width: 12px;
    }
</style>  
<div class="collapse navbar-collapse" id="app-navbar-collapse">
    <!-- Left Side Of Navbar -->
    <ul class="nav  flex-column"> 
        @if(Auth::user()->role == 'master')
        <li class="nav-item" style="border-top: 1px solid #e3e1e1;">
            <a class="nav-link" href="{{ route('masters.index') }}"><i class="fa fa-dashboard w-12"></i><span class="nav-link-text">@lang('Dashboard') </span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('schools.index') }}"><i class="fa fa-graduation-cap w-12"></i><span class="nav-link-text">@lang('Manage Schools') </span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('agents.index') }}"><i class="fa fa-user-circle-o w-12"></i><span class="nav-link-text">@lang('Agents') </span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pricings.index') }}"><i class="fa fa-money w-12"></i><span class="nav-link-text">@lang('Pricings') </span></a>
        </li> 
        <li class="nav-item">
            <a class="nav-link" href="{{ route('schoolpayments.index') }}"><i class="fa fa-credit-card-alt w-12"></i><span class="nav-link-text">@lang('School Payments') </span></a>
        </li> 
        @endif 
    </ul>
</div>
