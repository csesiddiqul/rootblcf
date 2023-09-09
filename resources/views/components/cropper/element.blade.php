<link rel="stylesheet" type="text/css" href="{{asset('additional/uploadcrop/croppie.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('additional/uploadcrop/croppie.min.css')}}"> 
<script src="{{asset('additional/uploadcrop/custom.js')}}"></script>
<div class="modal" id="imageFrame">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('file-upload').value = ''">&times;</button>
                <h4 class="modal-title">Crop & Upload Image</h4>
                <span id="width-crop">{{$width}}</span>
                <span id="height-crop">{{$height}}</span>
                <span id="type-crop">{{$type}}</span>
            </div> 
            <div class="modal-body">
                <div id="resizer"></div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm crop_can" data-dismiss="modal" onclick="document.getElementById('file-upload').value = ''">Cancel</button>
                <button class="btn crop_image btn-sm" id="upload"><span id="imgapply">Apply</span></button>
                <button class="btn rotate float-lef btn-sm" data-deg="90" > 
                <i class="fa fa-undo"></i></button>
                <button class="btn rotate float-right btn-sm" data-deg="-90" > 
                <i class="fa fa-repeat"></i></button> 
            </div>
        </div>
    </div>
</div> 
<script src="{{asset('additional/uploadcrop/croppie.js')}}"></script>  