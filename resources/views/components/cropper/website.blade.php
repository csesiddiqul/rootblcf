<link rel="stylesheet" type="text/css" href="{{asset('additional/uploadcrop/croppie.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('additional/uploadcrop/croppie.min.css')}}"> 
<script src="{{asset('additional/uploadcrop/custom.js')}}"></script>
<div class="modal" id="standardFrame">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"> 
            <div class="modal-header span-none">
                <button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('standard-upload').value = ''">&times;</button>
                <h4 class="modal-title">@lang('Crop & Update Standard Logo')</h4>
                <span id="width-standard">500</span>
                <span id="height-standard">80</span>
                <span id="type-standard">{{$type}}</span>

                <span id="standard_name">{{$table_name}}</span>
                <span id="standard_id">{{$table_id}}</span>
                <span id="standard_field">standard</span>

            </div> 
            <div class="modal-body">
                <div id="resizer"></div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm crop_can" data-dismiss="modal" onclick="document.getElementById('standard-upload').value = ''">@lang('Cancel')</button>
                <button class="btn crop_image btn-sm" id="uploadStandard"><span id="imgapply">@lang('Update')</span></button>
                <button class="btn rotate float-lef btn-sm" data-deg="90" > 
                <i class="fa fa-undo"></i></button>
                <button class="btn rotate float-right btn-sm" data-deg="-90" > 
                <i class="fa fa-repeat"></i></button> 
            </div>
        </div>
    </div>
</div> 
<div class="modal" id="expressFrame">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"> 
            <div class="modal-header span-none">
                <button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('express-upload').value = ''">&times;</button>
                <h4 class="modal-title">@lang('Crop & Update Express Logo')</h4>
                <span id="width-express">80</span>
                <span id="height-express">80</span>
                <span id="type-express">{{$type}}</span>

                <span id="express_name">{{$table_name}}</span>
                <span id="express_id">{{$table_id}}</span>
                <span id="express_field">express</span>

            </div> 
            <div class="modal-body">
                <div id="resizer1"></div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm crop_can" data-dismiss="modal" onclick="document.getElementById('express-upload').value = ''">@lang('Cancel')</button>
                <button class="btn crop_image btn-sm" id="uploadExpress"><span id="imgapply">@lang('Update')</span></button>
                <button class="btn rotate float-lef btn-sm" data-deg="90" > 
                <i class="fa fa-undo"></i></button>
                <button class="btn rotate float-right btn-sm" data-deg="-90" > 
                <i class="fa fa-repeat"></i></button> 
            </div>
        </div>
    </div>
</div> 
<div class="modal" id="iconFrame">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"> 
            <div class="modal-header span-none">
                <button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('icon-upload').value = ''">&times;</button>
                <h4 class="modal-title">@lang('Crop & Update Icon')</h4>
                <span id="width-icon">100</span>
                <span id="height-icon">100</span>
                <span id="type-icon">{{$type}}</span>

                <span id="icon_name">{{$table_name}}</span>
                <span id="icon_id">{{$table_id}}</span>
                <span id="icon_field">icon</span>

            </div> 
            <div class="modal-body">
                <div id="resizer2"></div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm crop_can" data-dismiss="modal" onclick="document.getElementById('icon-upload').value = ''">@lang('Cancel')</button>
                <button class="btn crop_image btn-sm" id="uploadIcon"><span id="imgapply">@lang('Update')</span></button>
                <button class="btn rotate float-lef btn-sm" data-deg="90" > 
                <i class="fa fa-undo"></i></button>
                <button class="btn rotate float-right btn-sm" data-deg="-90" > 
                <i class="fa fa-repeat"></i></button> 
            </div>
        </div>
    </div>
</div> 
<div class="modal" id="aboutFrame">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header span-none">
                <button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('about-upload').value = ''">&times;</button>
                <h4 class="modal-title">@lang('Crop & Update Photo')</h4>
                <span id="width-about">420</span>
                <span id="height-about">252</span>
                <span id="type-about">{{$type}}</span>

                <span id="about_name">{{$table_name}}</span>
                <span id="about_id">{{$table_id}}</span>
                <span id="about_field">about_pic</span>

            </div>
            <div class="modal-body">
                <div id="resizer3"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm crop_can" data-dismiss="modal" onclick="document.getElementById('about-upload').value = ''">@lang('Cancel')</button>
                <button class="btn crop_image btn-sm" id="uploadAbout"><span id="imgapply">@lang('Update')</span></button>
                <button class="btn rotate float-lef btn-sm" data-deg="90" >
                <i class="fa fa-undo"></i></button>
                <button class="btn rotate float-right btn-sm" data-deg="-90" >
                <i class="fa fa-repeat"></i></button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="HeadSignatureFrame">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header span-none">
                <button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('HeadSign-upload').value = ''">&times;</button>
                <h4 class="modal-title">@lang('Crop & Update Photo')</h4>
                <span id="width-HeadSignature">250</span>
                <span id="height-HeadSignature">100</span>
                <span id="type-HeadSignature">{{$type}}</span>

                <span id="HeadSignature_name">{{$table_name}}</span>
                <span id="HeadSignature_id">{{$table_id}}</span>
                <span id="HeadSignature_field">head_signature</span>

            </div>
            <div class="modal-body">
                <div id="resizer4"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm crop_can" data-dismiss="modal" onclick="document.getElementById('HeadSign-upload').value = ''">@lang('Cancel')</button>
                <button class="btn crop_image btn-sm" id="HeadSignature"><span id="imgapply">@lang('Update')</span></button>
                <button class="btn rotate float-lef btn-sm" data-deg="90" >
                <i class="fa fa-undo"></i></button>
                <button class="btn rotate float-right btn-sm" data-deg="-90" >
                <i class="fa fa-repeat"></i></button>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('additional/uploadcrop/croppie.js')}}"></script>