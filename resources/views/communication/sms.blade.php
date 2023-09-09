@extends('layouts.app')

@section('title', __('SMS'))

@section('content')
    <link href="{{asset('additional/tagsinput/bootstrapTags.css')}}" rel="stylesheet">
    <script src="{{asset('additional/tagsinput/bootstrapTypeTag.js')}}"></script>
    <script src="{{asset('additional/tagsinput/bootstrapTag.js')}}"></script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" id="side-navbar">
                @include('layouts.leftside-menubar')
            </div>
            <div class="col-md-10" id="main-container">
                @include('components.pages-bar',['pageTitle' =>'<a href="'. route('academic.contact.index').'">'. trans('Communicate').'</a>  / <b>'. trans('Send SMS').'<b>'])
                @include('components.sectionbar.communicate-bar')
                <div class="col-md-12 pl-0  pr-0">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {!! Form::open(['route' => 'academic.send_sms', 'method' => 'post']) !!}
                            <div class="col-md-3 pl-0">
                                <div class="form-group{{ $errors->has('teacher') ? ' has-error' : '' }}">
                                    {!! Form::label('teacher', trans('Teacher'), ['class' => 'control-label']) !!}
                                    {!! Form::select('teacher[]',$teacher ?? array(), null, array('class' => 'select2 form-control','multiple')) !!}
                                    @error('teacher')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 pl-0">
                                <div class="form-group{{ $errors->has('section') ? ' has-error' : '' }} ">
                                    {!! Form::label('section', trans('Section'), ['class' => 'control-label']) !!}
                                    {!! Form::select('section',$section, $request_section ?? null, array('class' => 'select2 form-control','onchange'=>'getStudentsBySection(this.value,1,0)', 'placeholder' => trans('Choose'))) !!}
                                    @error('section')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="form-group{{ $errors->has('student') ? ' has-error' : '' }}">
                                    {!! Form::label('student', trans('Student'), ['class' => 'control-label']) !!}
                                    {!! Form::select('student[]',array(), null, array('id'=>'student','class' => 'select2 form-control','multiple')) !!}
                                    @error('student')
                                    <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                {!! Form::label('other_number', trans('Other Number Separate with (Comma/tab/Enter)'), ['class' => 'control-label']) !!}
                                {!! Form::text('other_number', null, array('class' => 'form-control','data-role' => 'tagsinput', 'placeholder' => transMsg('Start with 8801*********'))) !!}
                                @error('other_number')
                                <span class="help-block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                {!! Form::label('message', trans('Message'), ['class' => 'control-label']) !!}
                                <textarea class="form-control" onkeyup="countChar(this.value)" name="message"
                                          placeholder="Type your message" rows="7">{{ old('message') }}</textarea>
                                <span style="color: green;width: 100%"><span id="charNum"
                                                                             style="color: #000">0</span> @lang('Characters') | <span
                                            style="color: green"><span
                                                id="leftChar">1530</span> @lang('Characters Left') |</span> <span
                                            id="totalSMS">@lang('Count SMS') : 0</span></span>
                                <br>
                                <span style="color: red">* @lang('160 Characters are counted as 1 SMS in case of English language & 70 in other language'). <br> * @lang('One simple text message containing extended GSM character set (~^{}[]\|) is of 70 characters long'). <br> @lang('Check your SMS count before pushing SMS').</span>
                                @error('message')
                                <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-2 mt-25">
                                <button type="submit" class="{{btnClass()}}"
                                        style="height: 38px">@lang('Send')</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script type="text/javascript">
        function countChar(value) {
            var len = value.length;
            if (len >= 1530) {
                value = value.substring(0, 1530);
            } else {
                $('#charNum').text(0 + len);
                $("#leftChar").text(parseInt('1530') - len);
                var sms = '1';
                if (/[\u0080-\uFFFF]/.test(value)) {
                    if (len <= '70')
                        sms = '1';
                    else if (len >= '70' && len <= '140')
                        sms = '2';
                    else if (len >= '140' && len <= '210')
                        sms = '3';
                    else if (len >= '210' && len <= '280')
                        sms = '4';
                    else if (len >= '280' && len <= '350')
                        sms = '5';
                    else if (len >= '350' && len <= '420')
                        sms = '6';
                    else if (len >= '420' && len <= '510')
                        sms = '7';
                    else if (len >= '510' && len <= '580')
                        sms = '8';
                    else if (len >= '580' && len <= '650')
                        sms = '9';
                    else if (len >= '650' && len <= '720')
                        sms = '10';
                } else {
                    if (len <= '160')
                        sms = '1';
                    else if (len >= '160' && len <= '320')
                        sms = '2';
                    else if (len >= '320' && len <= '480')
                        sms = '3';
                    else if (len >= '480' && len <= '640')
                        sms = '4';
                    else if (len >= '640' && len <= '800')
                        sms = '5';
                    else if (len >= '800' && len <= '960')
                        sms = '6';
                    else if (len >= '960' && len <= '1120')
                        sms = '7';
                    else if (len >= '1120' && len <= '1280')
                        sms = '8';
                    else if (len >= '1280' && len <= '1440')
                        sms = '9';
                    else if (len >= '1440' && len <= '1600')
                        sms = '10';
                }
                $("#totalSMS").text('Count SMS : ' + sms);
            }
        }
    </script>
@endpush