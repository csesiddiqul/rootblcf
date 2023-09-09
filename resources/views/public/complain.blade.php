@extends('public.layout.public',['title' => transMsg('Feedback') ])

@section('sliderText')
    <h1 class="page-title">@lang('Feedback')</h1>

@endsection

@section('content')

    @include('public.inc.pages-header')
    @include('public.inc.pages-slider')
    <div class="contact-page-section sec-spacer">
        <div class="container">
            
          

            <div class="contact-comment-section">
                {{--<h3>Leave Comment</h3>--}}
                <div id="form-messages"></div>
                
                 <form  method="POST" id="contact-form" action="{{ route('public.complain_store') }}">
                    {{ csrf_field() }}
                
                    <fieldset>
                        <div class="row">
                            <div class="col-md-8 offset-md-2 col-sm-12">
                                <div class="form-group">
                                    <label> @lang('Name')</label>
                                    <input name="name" id="name" class="form-control" type="text">
                                     @if ($errors->has('name'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                   </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8 offset-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>@lang('Contact Number')</label>
                                    <input name="contactnumber" id="contactnumber" class="form-control" type="text">
                                    @if ($errors->has('contactnumber'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('contactnumber') }}</strong>
                                   </span>
                                    @endif
                                </div>
                            </div>
                             <div class="col-md-8  offset-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>@lang('Email')</label>
                                    <input name="email" id="email" class="form-control" type="email" required>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                   </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8 offset-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>@lang('Description of your Feedback')</label>
                                    <textarea cols="40" rows="10" id="description" name="description"
                                     class="textarea form-control" required></textarea>
                                     @if ($errors->has('description'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('description') }}</strong>
                                   </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                       
                        <div class="col-md-8 offset-md-2 form-group mb-0 pl-0">
                            <input class="btn-send" type="submit" value="Submit Now">
                        </div>

                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection