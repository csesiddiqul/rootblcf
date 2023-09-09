<div class="">
    <div class="col-md-6" style="padding-left: 0px;">
        <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                <label for="type">@lang('Template Type')<small class="text-danger"> *</small></label>{!! Form::select('type',templateType(), null, array('id' => 'type', 'class' => 'form-control',  'placeholder' => trans('Choose'))) !!}
                @if ($errors->has('type'))
                <span class="help-block">
                    <strong>{{ $errors->first('type') }}</strong>
                </span>
                @endif
    </div>
    <div class="form-group " id="div1">
        <label for="name">@lang('Template Name') <small class="text-danger"> *</small></label>
        {!! Form::text('name', null, ['class' => 'form-control','id'=>'name','required']) !!}
    </div>
    <div class="form-group " id="div2">
        <label for="heading">@lang('Heading') <small class="text-danger"> *</small></label>
        {!! Form::text('heading', null, ['class' => 'form-control','id'=>'heading','required']) !!}
        <span class="text-danger"></span>
    </div>

    
</div>
    <div class="col-md-6" style="padding-right: 0px;">
     <div class="form-group" id="div4">
        <label for="examname">@lang('Exam Name') <small class="text-danger"> *</small></label>
        {!! Form::text('examname', null, ['class' => 'form-control','id'=>'examname','required']) !!}
        <span class="text-danger"></span>
    </div>
    <div class="form-group" id="div5">
        <label for="examdate">@lang('Exam Date') <small class="text-danger"> *</small></label>
        {!! Form::text('examdate', null, ['class'=>'form-control','id'=>'examdate','required']) !!}
        <span class="text-danger"></span>
    </div> 
    {{--
    <div class="form-group" id="div7">
        <label for="title">@lang('Title') <small class="text-danger"> *</small></label>
        {!! Form::text('title', null, ['class' => 'form-control','id'=>'title','required']) !!}
        <span class="text-danger"></span>
    </div>
    --}}
    

    </div>

    <div class="col-md-12 pl-0 pr-0" id="div8">
        <div class="form-group" >
        <label for="examcenter">@lang('Exam Center') <small class="text-danger"> *</small></label>
        {!! Form::text('examcenter', null, ['class' => 'form-control','id'=>'examcenter','required']) !!}
        <span class="text-danger"></span>
    </div>
    </div>
    
<div class="clearfix"></div>
    
    <div class="form-group" id="div9">
        <label for="bodyText">@lang('Body Text') <small class="text-danger"> *</small></label>
        {!! Form::textarea('bodyText', null, ['class' => 'form-control rounded-0 ckeditor','id'=>'bodyText','required', 'row'=>'5']) !!}
        <span class="text-danger"></span>
    </div>
    <div class="form-group" id="div10">
        <label for="footerText">@lang('Footer Text')</label>
        {!! Form::textarea('footerText', null, ['class' => 'form-control','rows'=>'3','id'=>'footerText']) !!}


        <span class="text-danger"></span>
    </div>
    <div class="row">
        <div class="col-sm-4 image-upload" id="div11">
            <label class="control-label upperlabel">@lang('Left Logo')</label>
            <label for="left-upload">
                @if (isset($template->llogo) && !empty($template->llogo) && !file_exists($template->llogo))
                    @php $llogo = $template->llogo; 
                    $onclick = true; 
                    @endphp
                @else
                    @php $llogo = asset('img/expresxs.png');$llogoRBtn = 'd-none';
                    $onclick = false;
                     @endphp
                @endif
                <img src="{{$llogo}}" id="preview_left" class="img-responsive">
            </label>
            <input type="file" value="" class="file-upload standard_width" id="left-upload" accept="image/*">
            <div class="remove-div">
                <div class="btn-group removeUpImage {{$llogoRBtn??''}}"
                     onclick="cancelUploadImg('preview_left','removeLeft','llogoInput','expresxs')" id="removeLeft">
                    <span class="btn btn-info btn-sm" @if($onclick)onclick="removeThisImg('{{$template->id}}','llogo')" @endif>@lang('Remove')</span>
                    <span class="btn btn-danger btn-sm">×</span>
                </div>
                <div id="llogoInput" style="display:none"></div>
            </div>
        </div>
        <div class="col-sm-4 image-upload" id="div12">
            <label class="control-label upperlabel">@lang('Middle Logo')</label>
            <label for="middle-upload">
                @if (isset($template->mlogo) && !empty($template->mlogo) && !file_exists($template->mlogo))
                    @php $mlogo = $template->mlogo;  
                    $onclick = true; 
                    @endphp
                @else
                    @php $mlogo = asset('img/expresxs.png');$mlogoRBtn = 'd-none';
                    $onclick = false; @endphp
                @endif
                <img src="{{$mlogo}}" id="preview_middle" class="img-responsive">
            </label>
            <input type="file" value="" class="file-upload standard_width" id="middle-upload" accept="image/*">
            <div class="remove-div">
                <div class="btn-group removeUpImage {{$mlogoRBtn??''}}"
                     onclick="cancelUploadImg('preview_middle','removeMiddle','mlogoInput','expresxs')"
                     id="removeMiddle">
                    <span class="btn btn-info btn-sm" @if($onclick)onclick="removeThisImg('{{$template->id}}','mlogo')" @endif>@lang('Remove')</span>
                    <span class="btn btn-danger btn-sm">×</span>
                </div>
                <div id="mlogoInput" style="display:none"></div>
            </div>
        </div>
        <div class="col-sm-4 image-upload" id="div13">
            <label class="control-label upperlabel">@lang('Right Logo')</label>
            <label for="right-upload">
                @if (isset($template->rlogo) && !empty($template->rlogo) && !file_exists($template->rlogo))
                    @php $rlogo = $template->rlogo; 
                    $onclick = true;
                    @endphp
                @else
                    @php $rlogo = asset('img/expresxs.png');$rlogoRBtn = 'd-none'; 
                    $onclick = false;@endphp
                @endif
                <img src="{{$rlogo}}" id="preview_right" class="img-responsive">
            </label>
            <input type="file" value="" class="file-upload standard_width" id="right-upload" accept="image/*">
            <div class="remove-div">
                <div class="btn-group removeUpImage {{$rlogoRBtn??''}}"
                     onclick="cancelUploadImg('preview_right','removeRight','rlogoInput','expresxs')" id="removeRight">
                    <span class="btn btn-info btn-sm" @if($onclick)onclick="removeThisImg('{{$template->id}}','rlogo')" @endif>@lang('Remove')</span>
                    <span class="btn btn-danger btn-sm">×</span>
                </div>
                <div id="rlogoInput" style="display:none"></div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="col-sm-4 image-upload" id="div14">
            <label class="control-label upperlabel">@lang('Left Signature')</label>
            <label for="leftsig-upload">
                @if (isset($template->lsign) && !empty($template->lsign) && !file_exists($template->lsign))
                    @php $lsign = $template->lsign;
                        $onclick = true;
                    @endphp
                @else
                    @php $lsign = asset('img/Signature1.png');$lsignBtn = 'd-none';
                        $onclick = false;@endphp
                @endif
                <img src="{{$lsign}}" id="preview_leftsig" class="img-responsive">
            </label>
            <input type="file" value="" class="file-upload standard_width" id="leftsig-upload" accept="image/*">
            <div class="remove-div">
                <div class="btn-group removeUpImage {{$lsignBtn??''}}"
                     onclick="cancelUploadImg('preview_leftsig','removeLeftsig','lsignInput','Signature1')"
                     id="removeLeftsig" >
                    <span class="btn btn-info btn-sm" @if($onclick)onclick="removeThisImg('{{$template->id}}','lsign')" @endif>@lang('Remove')</span>
                    <span class="btn btn-danger btn-sm">×</span>
                </div>
                <div id="lsignInput" style="display:none"></div>
            </div>
        </div>
        <div class="col-sm-4 image-upload" id="div15">
            <label class="control-label upperlabel">@lang('Middle Signature')</label>
            <label for="middlesig-upload">
                @if (isset($template->msign) && !empty($template->msign) && !file_exists($template->msign))
                    @php $msign = $template->msign; $onclick = true;@endphp
                @else
                    @php $msign = asset('img/Signature2.png');$msignBtn = 'd-none'; 
                    $onclick = false;@endphp
                @endif
                <img src="{{$msign}}" id="preview_middlesig" class="img-responsive">
            </label>
            <input type="file" value="" class="file-upload standard_width" id="middlesig-upload" accept="image/*">
            <div class="remove-div">
                <div class="btn-group removeUpImage {{$msignBtn??''}}"
                     onclick="cancelUploadImg('preview_middlesig','removeMiddlesig','msignInput','Signature2')"
                     id="removeMiddlesig">
                    <span class="btn btn-info btn-sm" @if($onclick)onclick="removeThisImg('{{$template->id}}','msign')" @endif>@lang('Remove')</span>
                    <span class="btn btn-danger btn-sm">×</span>
                </div>
                <div id="msignInput" style="display:none"></div>
            </div>
        </div>
        <div class="col-sm-4 image-upload" id="div16">
            <label class="control-label upperlabel">@lang('Right Signature')</label>
            <label for="rightsig-upload">
                @if (isset($template->rsign) && !empty($template->rsign) && !file_exists($template->rsign))
                    @php $rsign = $template->rsign;$onclick = true; @endphp
                @else
                    @php $rsign = asset('img/Signature3.png');$rsignBtn = 'd-none'; 
                    $onclick = false; @endphp
                @endif
                <img src="{{$rsign}}" id="preview_rightsig" class="img-responsive">
            </label>
            <input type="file" value="" class="file-upload standard_width" id="rightsig-upload" accept="image/*">
            <div class="remove-div">
                <div class="btn-group removeUpImage  {{$rsignBtn??''}}"
                     onclick="cancelUploadImg('preview_rightsig','removeRightsig','rsignInput','Signature3')"
                     id="removeRightsig" >
                    <span class="btn btn-info btn-sm" @if($onclick)onclick="removeThisImg('{{$template->id}}','rsign')" @endif>@lang('Remove')</span>
                    <span class="btn btn-danger btn-sm">×</span>
                </div>
                <div id="rsignInput" style="display:none"></div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4" id="div17">
            <div class="form-check">
                <label class="form-check-label" for="lsign_title">
              <input class="form-check-input" type="checkbox" {{!empty($template->lsign_title) ? 'checked' : '' }} id="lsign_title">
              
                @lang('Left Sign Title')
              </label>
            </div>
            <div id="lsign1" class="{{empty($template->lsign_title) ? 'd-none' : '' }}">

                 {!! Form::textarea('lsign_title', null, ['class' => 'form-control','rows'=>'2','id'=>'lsign_titletxt']) !!}
            </div>
        </div>
        <div class="col-sm-4" id="div18">
            <div class="form-check ">
                <label class="form-check-label" for="msign_title">
              <input class="form-check-input" type="checkbox" {{!empty($template->msign_title) ? 'checked' : '' }} id="msign_title">
           @lang('Middle Sign Title')</label>
          </div>
            <div id="lsign2" class="{{empty($template->msign_title) ? 'd-none' : '' }}">

                 {!! Form::textarea('msign_title', null, ['class' => 'form-control','rows'=>'2','id'=>'msign_titletxt']) !!}
            </div>
        </div>
        <div class="col-sm-4" id="div19">
             <div class="form-check ">
                <label class="form-check-label" for="rsign_title">
              <input class="form-check-input" type="checkbox" {{!empty($template->rsign_title) ? 'checked' : '' }} id="rsign_title">
              @lang('Right Sign Title')</label>
          </div>
             <div id="lsign3" class="{{empty($template->rsign_title) ? 'd-none' : '' }}">

                 {!! Form::textarea('rsign_title', null, ['class' => 'form-control','rows'=>'2','id'=>'rsign_titletxt']) !!}
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <!--                                <div class="image-upload form-group">
                                            <label class="control-label upperlabel">
                                                Background Image
                                                <span id="deliMG" onclick="cancelUploadMulti('fileMulti');" style="display: none;" class="myspanRemove">Remove</span>
                                            </label>
                                            <label class="btn btn-success btn-sm btn-block uploded-text" for="multiFileUp">Choose File
                                            </label>
                                            <input type="file" name="bgimg" class="file-upload form-control" id="multiFileUp">
                                     <span class="text-danger"></span>
                                    </div>-->
    <div class="row" style="margin-top: 10px;">
        <div class="col-sm-6" id="div20">
            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                <label for="photo_position">@lang('Student Photo Position')</label>{!! Form::select('photo_position',studentPhoto(), old('photo_position'), array('id' => 'photo_position', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                @if ($errors->has('photo_position'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('photo_position') }}</strong>
                                </span>
                @endif
            </div>
        </div>
        <div class="col-sm-6" id="div21">
            <div class="form-group{{ $errors->has('info_position') ? ' has-error' : '' }}">
                <label for="info_position">@lang('Student Informations Position')</label>
                {!! Form::select('info_position',infoPosition(), old('info_position'), array('id' => 'info_position', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
                @if ($errors->has('info_position'))
                    <span class="help-block">
                                    <strong>{{ $errors->first('info_position') }}</strong>
                                </span>
                @endif
            </div>
        </div>
    </div>


    <div class="row" id="div22">
        <div class="col-sm-6">
            <ul class="list-group">
                <li class="list-group-item">
                    @lang('Name')
                    <div class="TriSea-technologies-Switch pull-right">
                        {!! Form::checkbox('is_name', '1', null,  ['id' => 'is_name']) !!}
                        <label for="is_name" class="label-success"></label>
                    </div>
                </li>
                <li class="list-group-item">
                    @lang('Father Name')
                    <div class="TriSea-technologies-Switch pull-right">
                        {!! Form::checkbox('is_fname', '1', null,  ['id' => 'is_fname']) !!}
                        <label for="is_fname" class="label-success"></label>
                    </div>
                </li>
                <li class="list-group-item">
                    @lang('Mother Name')
                    <div class="TriSea-technologies-Switch pull-right">
                        {!! Form::checkbox('is_mname', '1', null,  ['id' => 'is_mname']) !!}
                        <label for="is_mname" class="label-success"></label>
                    </div>
                </li>
                <li class="list-group-item">
                    @lang('E-Mail')
                    <div class="TriSea-technologies-Switch pull-right">
                        {!! Form::checkbox('is_email', '1', null,  ['id' => 'is_email']) !!}
                        <label for="is_email" class="label-success"></label>
                    </div>
                </li>
                <li class="list-group-item">
                    @lang('Student Photo')
                    <div class="TriSea-technologies-Switch pull-right">
                        {!! Form::checkbox('is_photo', '1', null,  ['id' => 'is_photo']) !!}
                        <label for="is_photo" class="label-success"></label>
                    </div>
                </li>
                 <li class="list-group-item">
                    @lang('Phone')
                    <div class="TriSea-technologies-Switch pull-right">
                        {!! Form::checkbox('is_phone', '1', null,  ['id' => 'is_phone']) !!}
                        <label for="is_phone" class="label-success"></label>
                    </div>
                </li>


            </ul>
        </div>
        <div class="col-sm-6">
            <ul class="list-group">
                <li class="list-group-item">
                    @lang('Admission ID')
                    <div class="TriSea-technologies-Switch pull-right">
                        {!! Form::checkbox('is_admission_id', '1', null,  ['id' => 'is_admission_id']) !!}
                        <label for="is_admission_id" class="label-success"></label>
                    </div>
                </li>
                {{--
                <li class="list-group-item">
                    @lang('Student ID')
                    <div class="TriSea-technologies-Switch pull-right">
                        {!! Form::checkbox('is_st_id', '1', null,  ['id' => 'is_st_id']) !!}
                        <label for="is_st_id" class="label-success"></label>
                    </div>
                </li>
                --}}
                <li class="list-group-item">
                    @lang('Class')
                    <div class="TriSea-technologies-Switch pull-right">
                        {!! Form::checkbox('is_class', '1', null,  ['id' => 'is_class']) !!}
                        <label for="is_class" class="label-success"></label>
                    </div>
                </li>
                <li class="list-group-item">
                    @lang('Section')
                    <div class="TriSea-technologies-Switch pull-right">
                        {!! Form::checkbox('is_section', '1', null,  ['id' => 'is_section']) !!}
                        <label for="is_section" class="label-success"></label>
                    </div>
                </li>
                <li class="list-group-item">
                    @lang('Session')
                    <div class="TriSea-technologies-Switch pull-right">
                        {!! Form::checkbox('is_session', '1', null,  ['id' => 'is_session']) !!}
                        <label for="is_session" class="label-success"></label>
                    </div>
                </li>

               
                <li class="list-group-item">
                    @lang('Address')
                    <div class="TriSea-technologies-Switch pull-right">
                        {!! Form::checkbox('is_address', '1', null,  ['id' => 'is_address']) !!}
                        <label for="is_address" class="label-success"></label>
                    </div>
                </li>
                {{--
                <li class="list-group-item">
                    Left Signature Title
                    <div class="TriSea-technologies-Switch pull-right">
                        {!! Form::checkbox('lsign_title', '1', null,  ['id' => 'lsign_title']) !!}
                        <label for="lsign_title" class="label-success"></label>
                    </div>
                </li>
                <li class="list-group-item">
                    Middle Signature Title
                    <div class="TriSea-technologies-Switch pull-right">
                        {!! Form::checkbox('msign_title', '1', null,  ['id' => 'msign_title']) !!}
                        <label for="msign_title" class="label-success"></label>
                    </div>
                </li>
                <li class="list-group-item">
                    Right Signature Title
                    <div class="TriSea-technologies-Switch pull-right">
                        {!! Form::checkbox('rsign_title', '1', null,  ['id' => 'rsign_title']) !!}
                        <label for="rsign_title" class="label-success"></label>
                    </div>
                </li>
                --}}
            </ul>
        </div>
    </div>

<div class="clearfix"></div>
    <div class="col-sm-6" style="padding-left: 0px;">
        <div class="form-group ">

        <label>@lang('Choose Page')<span>@lang(':')</span></label>
        <div class="clearfix"></div>
        <label class="radio-inline" for="a4">
            {{ Form::radio('page', 'a4', true, ['id'=>'a4'])}}
            A4 Page</label>

        <label class="radio-inline" for="a5">
            {{ Form::radio('page', 'a5', false, ['id'=>'a5'])}}
            A5 Page</label>


    </div>
    </div>

    <div class="col-sm-6" style="padding-right: 0px;">
        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
        <label for="status">@lang('Status') <small class="text-danger">
                *</small></label>{!! Form::select('status',status(), old('status'), array('id' => 'status', 'class' => 'form-control', 'placeholder' => trans('Choose'))) !!}
        @if ($errors->has('status'))
            <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
        @endif
    </div>
    </div>


</div><!-- /.box-body -->
