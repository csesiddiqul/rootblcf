<div class="row" id="body-row">
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
        <ul class="list-group">
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
            </li>
            <a href="#" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                    <span id="collapse-text" class="menu-collapsed">Collapse</span>
                </div>
            </a>
            <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-dashboard fa-fw mr-3"></span>
                    <span class="menu-collapsed">Dashboard</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <div id='submenu1' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Charts</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Reports</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Tables</span>
                </a>
            </div>
        </ul>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.nav-item.active').removeClass('active');
        $('a[href="' + window.location.href + '"]').closest('li').closest('ul').closest('li').addClass('active');
        $('a[href="' + window.location.href + '"]').closest('li').addClass('active');

    });
    $(document).ready(function(){
// Hide submenus
        $('#body-row .collapse').collapse('hide');

// Collapse/Expand icon
        $('#collapse-icon').addClass('fa-angle-double-left');

// Collapse click
        $('[data-toggle=sidebar-colapse]').click(function() {
            SidebarCollapse();
        });

        function SidebarCollapse () {
            $('.menu-collapsed').toggleClass('d-none');
            $('.sidebar-submenu').toggleClass('d-none');
            $('.submenu-icon').toggleClass('d-none');
            $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');

            // Collapse/Expand icon
            $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
        }
    });
</script>
<style>
    .ptop {
        padding-top: 15px;
    }
</style>
{{--@if($auth_user->role != 'master')
<ul class="nav flex-column">
  <li class="nav-item">
    <a class="nav-link" href="{{url('user/'.$auth_user->student_code)}}"><i class="material-icons">face</i> <span
        class="nav-link-text">@lang('Profile')</span></a>
  </li>
</ul>
@endif--}}
@php $auth_user = auth()->user(); @endphp
<div class="collapse navbar-collapse" id="app-navbar-collapse">
    <!-- Left Side Of Navbar -->
    <ul class="nav  flex-column">
        @if($auth_user->role == 'teacher' || $auth_user->role == 'admin')
            @php
                $currentSession = currentSession();
            @endphp
            <li style="border-bottom: 1px solid #e3e1e1;text-align: center;padding: 10px 0px;color: #000000">
                <span class="w-100" style="margin-bottom: 4px;font-size: 14.5px">@lang('Current Session') : {{$currentSession->schoolyear ?? 'Null'}}</span>
            </li>
            <li class="nav-item ptop">
                <a class="nav-link" href="{{ url('home') }}"><i class="fal fa-tachometer-alt-fastest w-12"></i><span
                            class="nav-link-text">@lang('Dashboard')</span></a>
            </li>
            @if($auth_user->role == 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('academic.admission.pending')}}"><i
                                class="fad fa-university w-12"></i><span
                                class="nav-link-text">@lang('Admissions')</span></a>
                </li>
            @endif
        @endif
        @if($auth_user->role == 'student' || $auth_user->role == 'accountant' || $auth_user->role == 'librarian')
            <li class="nav-item">
                <a class="nav-link" href="{{url('user/'.$auth_user->student_code)}}"><i
                            class="fad fa-user w-12"></i><span
                            class="nav-link-text">@lang('Profile')</span></a>
            </li>
        @endif
        @if($auth_user->role == 'student')
            <li class="nav-item">
                <a class="nav-link" href="{{route('ac_statement')}}">
                    <i class="fa fa-calculator w-12"></i>
                    <span class="nav-link-text">@lang('Financial Statement')</span>
                </a>
            </li>
        @endif
        @if($auth_user->role != 'student')
            <li class="nav-item">
                <a class="nav-link" href="{{url('users/'.$auth_user->school->code.'/1/0')}}"><i
                            class="fa fa-user-md w-12"></i><span class="nav-link-text">@lang('Students')</span></a>
            </li>
            @if($auth_user->role == 'accountant')
                <li class="nav-item">
                    <a class="nav-link" href="{{url('users/'.$auth_user->school->code.'/0/1')}}"><i
                                class="fa fa-user-md w-12"></i><span class="nav-link-text">@lang('Teachers')</span></a>
                </li>
            @endif
        @endif
        @if($auth_user->role == 'admin')
            <li class="nav-item">
                <a class="nav-link" href="{{route('all_index',[$auth_user->school->code,0,1])}}"><i
                            class="fa fa-sitemap w-12"></i><span
                            class="nav-link-text">@lang('Human Resource')</span></a>
            </li> 
            <li class="nav-item">
                <a class="nav-link" href="{{route('academic.class')}}"><i
                            class="fa fa-mortar-board w-12"></i><span
                            class="nav-link-text">@lang('Academics')</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('attendance.index',$auth_user->school->code) }}"><i
                            class="fa fa-clock-o w-12"></i><span
                            class="nav-link-text">@lang('Attendance')</span></a>
            </li>
        @endif
        @if($auth_user->role == 'admin')
            @if (branch_permission())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('academic.branch.index') }}"><i
                                class="fa fa-building-o w-12"></i><span
                                class="nav-link-text">@lang('Branch Settings')</span></a>
                </li>
            @endif

            <li class="nav-item">
                <a class="nav-link" href="{{ url('exams') }}"><i
                            class="fa fa fa-map-o w-12"></i><span
                            class="nav-link-text">@lang('Exams')</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('academic.contact.index')}}"><i
                            class="fa fa-bullhorn w-12"></i><span
                            class="nav-link-text">@lang('Communication')</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('academic/certificate') }}"><i
                            class="fa fa-newspaper-o w-12"></i><span
                            class="nav-link-text">@lang('Certificates')</span></a>
            </li>

            @if($auth_user->subscription)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('school.subscription') }}"><i class="fa fa-gift w-12"></i><span
                                class="nav-link-text">@lang('Subscription')</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('make.payment.school')}}"><i
                                class="fa fa-newspaper-o w-12"></i><span
                                class="nav-link-text">@lang('Make a Payment')</span></a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('school.website') }}"><i class="fa fa-globe w-12"></i><span
                            class="nav-link-text">@lang('Website Settings')</span></a>
            </li>
            {{--<li class="nav-item">
                  <a class="nav-link" href="{{route('academic.menu.index')}}"><i class="fa fa-empire w-12"></i><span
                              class="nav-link-text">@lang('Front Management')</span></a>
              </li>--}}

            {{-- <li class="nav-item" style="border-bottom: 1px solid #dbd8d8;"></li>

             <li class="nav-item" style="border-bottom: 1px solid #dbd8d8;"></li>--}}
            {{--<li class="nav-item">
                <a class="nav-link" href="{{ route('settings.index') }}"><i class="material-icons">settings</i> <span
                            class="nav-link-text">@lang('Academic Settings')</span></a>
            </li>--}}
        @endif
        {{--
        @if($auth_user->role == 'admin' || $auth_user->role == 'accountant')
            <li class="nav-item dropdown">
                <a role="button" href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false"><i
                            class="material-icons">monetization_on</i> <span
                            class="nav-link-text">@lang('Fees Generator')</span> <i class="fa fa-angle-down pull-right"></i></a>
                <ul class="dropdown-menu" style="width: 100%;">
                    <!-- Dropdown menu links -->
                    <li>
                        <a class="dropdown-item" href="{{ url('fees/all') }}"><i class="material-icons">developer_board</i>
                            <span class="nav-link-text">@lang('Generate Form')</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('fees/create') }}"><i class="material-icons">note_add</i>
                            <span class="nav-link-text">@lang('Add Fee Field')</span></a>
                    </li>
                </ul>
            </li>
        @endif
        --}}
        @if($auth_user->role == 'admin' || $auth_user->role == 'accountant')
            <li class="nav-item">
                <a class="nav-link" href="{{url('users/'.$auth_user->school->code.'/accountant')}}"><i
                            class="fa fa-calculator w-12"></i><span
                            class="nav-link-text">@lang('Manage Accounts') </span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('payroll.index.process','first')}}"><i class="fa fa-product-hunt w-12"></i><span class="nav-link-text">@lang('Payroll')</span></a>
            </li>
        @endif
        @if($auth_user->role == 'student')
            {{--<li class="nav-item">
                <a class="nav-link active" href="{{ url('attendances/0/'.$auth_user->id.'/0') }}"><i
                            class="material-icons">date_range</i>
                    <span class="nav-link-text">@lang('My Attendance')</span></a>
            </li>--}}
            <li class="nav-item">
                <a class="nav-link" href="{{url('user/'.$auth_user->id.'/notifications')}}">
                    <i class="fal fa-envelope w-12"></i>
                    <span class="nav-link-text">@lang('Notifications')</span>
                    @php
                        $mc = \App\Notification::where('student_id', $auth_user->id)->where('active', 1)->count();
                    @endphp
                    @if($mc > 0)
                        <span class="label label-danger"
                              style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">{{$mc}}</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('course.index',[0,$auth_user->section_id]) }}"><i
                            class="fal fa-book w-12"></i>
                    <span class="nav-link-text">@lang('My Courses')</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('grade.each_student',$auth_user->student_code) }}">
                    <i class="fal fa-poll w-12"></i>
                    <span class="nav-link-text">@lang('My Grade')</span></a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{url('stripe/charge')}}"><i class="fal fa-credit-card"></i><span
                            class="nav-link-text">@lang('Payment')</span></a>
            </li>--}}
            {{-- <li class="nav-item">
                 <a class="nav-link" href="{{url('stripe/receipts')}}"><i class="fal fa-receipt"></i><span
                             class="nav-link-text">@lang('Receipt')</span></a>
             </li>--}}
            <li class="nav-item">
                <a class="nav-link" href="{{url('academic/student/certificates')}}"><i
                            class="fad fa-badge-check w-12"></i>
                    <span class="nav-link-text">Certificates</span></a>
            </li>
        @endif
        @if($auth_user->role == 'admin' || $auth_user->role == 'librarian')
            <li class="nav-item">
                <a class="nav-link" href="{{ url('library/issued-books') }}"><i
                            class="fa fa-newspaper-o w-12"></i><span
                            class="nav-link-text">@lang('Manage Library')</span></a>
            </li>
        @endif
        @if($auth_user->role == 'teacher')
            <li class="nav-item">
                <a class="nav-link" href="{{url('user/'.$auth_user->student_code)}}"><i class="fa fa-user w-12"></i>
                    <span class="nav-link-text">@lang('My Profile')</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('courses/'.$auth_user->id.'/0') }}"><i class="fa fa-book w-12"></i>
                    <span class="nav-link-text">@lang('My Courses')</span></a>
            </li>

            {{--            <li class="nav-item">
                            <a class="nav-link" href="{{route('academic.contact.index')}}"><i
                                        class="fa fa-bullhorn w-12"></i><span
                                        class="nav-link-text">@lang('Communication')</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('academic.notice.index')}}"><i
                                        class="fa fa-bell w-12"></i><span
                                        class="nav-link-text">@lang('Notice')</span></a>
                        </li>--}}
        @endif

        @if($auth_user->role == 'admin')
          <li class="nav-item">
                <a class="nav-link" style="color: red;" href="{{route('academic.help')}}"><i
                            class="fa fa-question-circle w-12"></i><span
                            class="nav-link-text"><b>@lang('Help')</b> </span></a>
            </li>
        @endif
    </ul>
</div>

