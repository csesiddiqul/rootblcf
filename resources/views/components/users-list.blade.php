<div class="clearfix"></div>
<div class="table-responsive">
    <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">@lang('Code')</th>
            @foreach ($users as $user)
                <th scope="col">@lang(ucfirst($user->role).' Name')</th>
                @if($user->role == 'student')
                    @if(school('country')->code == 'SG')
                        <th scope="col">@lang('NRIC')</th>
                        <th scope="col">@lang('Level')</th>
                        <th scope="col">@lang('Stream')</th>
                        <th scope="col">@lang('Nationality')</th>
                        <th scope="col">@lang('Citizenship')</th>
                        <th scope="col">@lang('School')</th>
                        <th scope="col">@lang('NTIL')</th>
                        <th scope="col">@lang('CG')</th>
                        <th scope="col">{{transMsg(school('country')->code == 'BD' || 'SG' ? 'Class' : 'Grade')}}</th>
                        <th scope="col">@lang('WeekEnd / ISPP')</th>
                    @else
                        <th scope="col">@lang('Roll')</th>
                        @if (!Session::has('section-attendance'))
                            <th scope="col">@lang('Session')</th>
                            <th scope="col">{{transMsg(school('country')->code == 'BD' || 'SG' ? 'Class' : 'Grade')}}</th>
                            <th scope="col">@lang('Version')</th>
                            <th scope="col">@lang('Section')</th>
                            {{--<th scope="col">@lang('Father')</th>
                            <th scope="col">@lang('Mother')</th>--}}
                        @endif
                    @endif
                @elseif($user->role != 'student')
                    @if (!Session::has('section-attendance'))
                        <th scope="col">@lang('Email')</th>
                        @if(Auth::user()->role == 'admin' && $user->role == 'teacher')
                            <th scope="col">@lang('Courses')</th>
                        @endif
                    @endif
                @elseif($user->role == 'accountant' || $user->role == 'librarian')
                    @if (!Session::has('section-attendance'))
                        <th scope="col">@lang('Email')</th>
                    @endif
                @endif
                @break($loop->first)
            @endforeach
            @if (!Session::has('section-attendance') && school('country')->code == 'SG' && $user->role == 'teacher' || school('country')->code != 'SG')
                <th scope="col">@lang('Gender')</th>
                <th scope="col">@lang('Phone')</th>
            @endif
            <th scope="col">@lang('Status')</th>
            @if (!Session::has('section-attendance'))
                @if(Auth::user()->role == 'admin' && $user->role == 'teacher')
                    <th scope="col">@lang('Education')</th>
                @endif
            @endif
            @if($user->role == 'admin' || $user->role == 'staff' || $user->role == 'accountant' || $user->role == 'librarian' )
                <th scope="col">@lang('Title')</th>
            @endif
            @if($user->role == 'student')
                <th scope="col">@lang('Payment')</th>
            @endif
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $key=>$user)
            <tr id="tr{{$user->id}}">
                <td scope="row">{{ $key + 1 }}</td>
                <td><small>{!! $user->student_code !!}</small></td>
                <td>
                    <small>
                        @if(!empty($user->pic_path))
                            @if (file_exists($user->pic_path))
                                <img data-src="{{asset('01-progress.gif')}}" src="{{url($user->pic_path)}}"
                                     style="border-radius: 50%;" width="25px" height="25px">
                            @else
                                @if($user->gender == 1)
                                    <img data-src="https://img.icons8.com/color/48/000000/guest-male--v1.png"
                                         src="https://img.icons8.com/color/48/000000/guest-male--v1.png"
                                         style="border-radius: 50%;" width="25px" height="25px">&nbsp;
                                @else
                                    <img data-src="https://img.icons8.com/color/48/000000/businesswoman.png"
                                         src="https://img.icons8.com/color/48/000000/businesswoman.png"
                                         style="border-radius: 50%;" width="25px" height="25px">&nbsp;
                                @endif
                            @endif
                        @else
                            @if($user->gender == 1)
                                <img data-src="https://img.icons8.com/color/48/000000/guest-male--v1.png"
                                     src="https://img.icons8.com/color/48/000000/guest-male--v1.png"
                                     style="border-radius: 50%;" width="25px" height="25px">&nbsp;
                            @else
                                <img data-src="https://img.icons8.com/color/48/000000/businesswoman.png"
                                     src="https://img.icons8.com/color/48/000000/businesswoman.png"
                                     style="border-radius: 50%;" width="25px" height="25px">&nbsp;
                            @endif
                        @endif
                        <a href="{{url('user/'.$user->student_code)}}">
                            {{$user->name}}</a>
                    </small></td>
                @if($user->role == 'student')
                    @if(school('country')->code == 'SG')
                        <td>
                            <small>
                                @isset($user->studentInfo['dob_no'])
                                    {!! $user->studentInfo['dob_no'] !!}
                                @endisset
                            </small>
                        </td>
                        <td>
                            {{$user->section->section_number}}
                        </td>
                        <td>
                            <small>
                                @isset($user->studentInfo['stream'])
                                    {!! $user->studentInfo['stream'] !!}
                                @endisset
                            </small>
                        </td>
                        <td>
                            {!! nationalityArray($user->nationality) !!}
                        </td>
                        <td>
                            <small>
                                @isset($user->studentInfo['singaporepr'])
                                    {!! residentstatus($user->studentInfo['singaporepr'],true) !!}
                                @endisset
                            </small>
                        </td>
                        <td>
                            <small>
                                @isset($user->studentInfo['main_school_name_address'])
                                    {!! $user->studentInfo['main_school_name_address'] !!}
                                @endisset
                            </small>
                        </td>
                        <td>
                            <small>
                                @isset($user->studentInfo['version'])
                                    {{ucfirst($user->studentInfo['version'])??''}}
                                @endisset
                            </small>
                        </td>
                        <td><small>{{school('short_name')}}</small></td>
                        <td> {{$user->section->class->name}} {{!empty($user->group)? '- '.$user->group:''}} </td>
                        <td>
                            <small>
                                @isset($user->studentInfo['weekEnd'])
                                    {!! $user->studentInfo['weekEnd'] !!}
                                @endisset
                            </small>
                        </td>
                    @else
                        <td>@isset($user->studentInfo['class_roll']){!! $user->studentInfo['class_roll'] !!}@endisset</td>
                        @if (!Session::has('section-attendance'))
                            <td>
                                <small>
                                    @isset($user->studentInfo['session'])
                                        {{getSessionById($user->studentInfo['session'],'schoolyear')}}
                                        {{-- @if($user->studentInfo['session'] == now()->year || $user->studentInfo['session'] > now()->year)
                                             <span class="label label-success">@lang('Promoted/New')</span>
                                         @else
                                             <span class="label label-danger">@lang('Not Promoted')</span>
                                         @endif--}}
                                    @endisset
                                </small>
                            </td>
                            <td>{{$user->section->class->name}} {{!empty($user->group)? '- '.$user->group:''}}
                            </td>
                            <td>
                                <small>
                                    @isset($user->studentInfo['version'])
                                        {{ucfirst($user->studentInfo['version'])??''}}
                                    @endisset
                                </small>
                            </td>
                            <td style="white-space: nowrap;"> {{$user->section->section_number}}
                                {{-- @if(Auth::user()->role == 'student' || Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
                                  - <a class="btn btn-xs btn-primary" role="button" href="{{url('courses/0/'.$user->section->id)}}">@lang('All Courses')</a>
                                @endif --}}
                            </td>
                            {{--<td><small>
                                    @isset($user->studentInfo['father_name'])
                                        {{$user->studentInfo['father_name']}}
                                    @endisset</small></td>
                            <td><small>
                                    @isset($user->studentInfo['mother_name'])
                                        {{$user->studentInfo['mother_name']}}
                                    @endisset</small></td>--}}
                        @endif
                    @endif
                @elseif($user->role == 'teacher')
                    @if (!Session::has('section-attendance'))
                        <td>
                            <small>{{$user->email}}</small>
                        </td>
                        @if(Auth::user()->role == 'admin')
                            <td style="white-space: nowrap;">
                                <small>
                                    <a href="{{route('course.index',[$user->id,'0'])}}">@lang('All Courses')</a>
                                </small>
                            </td>
                        @endif
                    @endif
                @elseif($user->role == 'accountant' || $user->role == 'librarian' || Auth::user()->role == 'admin')
                    @if (!Session::has('section-attendance'))
                        <td>
                            <small>{{$user->email}}</small>
                        </td>
                    @endif
                @endif
                @if (!Session::has('section-attendance'))
                    @if(school('country')->code == 'SG' && $user->role == 'teacher' || school('country')->code != 'SG')
                        <td>{{gender($user->gender,true)}}</td>
                        <td><small>{{$user->phone_number}}</small></td>
                    @endif
                    <td>
                        <small @if(Auth::user()->role == 'admin') onclick="activeInactiveUser({{$user->id.','.$user->active}})" @endif>
                            {!! $user->active == 1 ? '<span class="btn btn-xs allButton">'.trans('Active').'</span>' : ($user->active == 2 ? '<span class="btn btn-xs btn-warning">'.trans('Pending').'</span>':'<span class="btn btn-xs btn-danger">'.trans('Inactive').'</span>') !!}
                        </small>
                    </td>
                    @if(Auth::user()->role == 'admin' && $user->role == 'teacher')
                        <td>
                            <a class="btn btn-xs btn-info"
                               href="{{route('teacherEducationInfo.create',['id'=>$user->id])}}">@lang('Education')</a>
                        </td>
                    @endif
                @endif
                @if (!Session::has('section-attendance'))
                    @if($user->role == 'admin' || $user->role == 'staff' || $user->role == 'accountant' || $user->role == 'librarian' )
                        <td><small>{{getRoleTitle($user->role_title)??$user->role_title}}</small></td>
                    @endif
                @endif
                @if($user->role == 'student')
                    <td><a class="btn btn-xs btn-success" href="{{route('accounts.moneyreceipt')}}?studentId={{$user->student_code}}" target="_blank">@lang('Receive')</a></td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
