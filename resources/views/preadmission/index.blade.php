@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.admission.pending').'">'. trans('Admission').'</a> / <b>'.trans('Admission Year').'<b>'])
                @include('components.sectionbar.admission-bar')
                <div class="clearfix"></div>
                <div class="col-md-4 pl-0">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form method="POST" id="registerForm"
                                  action="{{ $postUrl }}">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
                                    <label for="year" class="control-label">@lang('Admission Year')</label>
                                    {!! Form::text('year', $preAdmission->year ?? null, array('id' => 'year','readonly', 'class' => 'form-control', 'placeholder' => trans('Year'),'autocomplete'=>'off','required')) !!}
                                    @if ($errors->has('year'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('shift') ? ' has-error' : '' }}">
                                    <label for="shift" class="control-label">@lang('Shift')</label>
                                    {!! Form::text('shift', $preAdmission->shift ?? null, array('id' => 'shift', 'class' => 'form-control', 'placeholder' => trans('Ex: Shift A'),'required')) !!}
                                    @if ($errors->has('shift'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('shift') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                    <label for="status" class="control-label">@lang('Status')</label>

                                    {!! Form::select('status',status(), $preAdmission->status ?? ('status'), array('id' => 'status', 'class' => 'form-control', 'placeholder' => trans('Choose'),'required')) !!}
                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                @isset($preAdmission)
                                    @method('PUT')
                                @endisset
                                <div class="form-group">
                                    <div class="col-md-6 pl-0">
                                        <button type="submit" id="registerBtn" class="{{btnClass()}}">
                                            @isset($preAdmission)
                                                @lang('Update')
                                            @else
                                                @lang('Create')
                                            @endisset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 pl-0 pr-0">
                    <div class="panel panel-default">
                        <div class="panel-body pad-top-0">
                            @if (count($preadmissions)>0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-data-div table-condensed table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">@lang('Year')</th>
                                            <th scope="col">@lang('Shift')</th>
                                            <th scope="col">@lang('Status')</th>
                                            <th scope="col">@lang('Created Date')</th>
                                            <th scope="col">@lang('Edit')</th>
                                            <th scope="col">@lang('Delete')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($preadmissions as $key=>$div)
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td><small>{{$div->year}}</small></td>
                                                <td><small>{{$div->shift}}</small></td>
                                                <td><small>{{status($div->status)}}</small></td>
                                                <td><small>{{$div->created_at->format('l,F  j,Y ')}}</small></td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger"
                                                       href="{{route('academic.preadmission.edit',$div->id)}}">@lang('Edit')</a>
                                                </td>
                                                <td>
                                                    <a class="btn btn-xs btn-danger"
                                                       onclick="confirm_delete('{{$div->id}}')">@lang('Delete')</a>

                                                    <form id="delete_form_{{$div->id}}"
                                                          action="{{route('academic.preadmission.destroy',$div->id)}}"
                                                          method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                        @method('DELETE')
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <h5 class="text-center"> @lang('No Related Data Found.')</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <style type="text/css">
        .pad-bot-top {
            padding-bottom: 0px;
        }

        .pad-left-0 {
            padding-top: 10px;
        }
    </style>
    <script>
        $(function () {
            $('#year').datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true
            });
        });
    </script>
    @push('script')
        <script>
            $(document).ready(function () {
                function appendFunction() {
                    $(".table-responsive div.row:first-child div.col-sm-6:first-child").html('<h5 class="tablehead">{{trans('Year List')}}</h5>');
                }

                setTimeout(function () {
                    appendFunction();
                }, 1000);
            })
        </script>
    @endpush
@endsection