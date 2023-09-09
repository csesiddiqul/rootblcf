<link rel="stylesheet" type="text/css" href="{{asset('additional/uploadcrop/croppie.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('additional/uploadcrop/croppie.min.css')}}"> 
<script src="{{asset('additional/uploadcrop/template.js')}}"></script>
<div class="modal" id="leftLogoModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"> 
            <div class="modal-header span-none">
                <button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('left-upload').value = ''">&times;</button>
                <h4 class="modal-title">Crop & Upload Left Logo</h4>
                <span id="width-left">100</span>
                <span id="height-left">100</span>
                <span id="type-left">{{$type}}</span>

                <span id="left_name">{{$table_name}}</span>
                <span id="left_id">{{$table_id}}</span>
                <span id="left_field">llogo</span>

            </div> 
            <div class="modal-body">
                <div id="resizer"></div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm crop_can" data-dismiss="modal" onclick="document.getElementById('left-upload').value = ''">Cancel</button>
                <button class="btn crop_image btn-sm" id="applyLeft"><span>Apply</span></button>
                <button class="btn rotate float-lef btn-sm" data-deg="90" > 
                <i class="fa fa-undo"></i></button>
                <button class="btn rotate float-right btn-sm" data-deg="-90" > 
                <i class="fa fa-repeat"></i></button> 
            </div>
        </div>
    </div>
</div> 
<div class="modal" id="middleLogoModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"> 
            <div class="modal-header span-none">
                <button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('middle-upload').value = ''">&times;</button>
                <h4 class="modal-title">Crop & Upload Middle Logo</h4>
                <span id="width-middle">100</span>
                <span id="height-middle">100</span>
                <span id="type-middle">{{$type}}</span>

                <span id="middle_name">{{$table_name}}</span>
                <span id="middle_id">{{$table_id}}</span>
                <span id="middle_field">mlogo</span>

            </div> 
            <div class="modal-body">
                <div id="resizer1"></div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm crop_can" data-dismiss="modal" onclick="document.getElementById('middle-upload').value = ''">Cancel</button>
                <button class="btn crop_image btn-sm" id="applyMiddle"><span>Apply</span></button>
                <button class="btn rotate float-lef btn-sm" data-deg="90" > 
                <i class="fa fa-undo"></i></button>
                <button class="btn rotate float-right btn-sm" data-deg="-90" > 
                <i class="fa fa-repeat"></i></button> 
            </div>
        </div>
    </div>
</div> 

<div class="modal" id="rightLogoModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"> 
            <div class="modal-header span-none">
                <button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('right-upload').value = ''">&times;</button>
                <h4 class="modal-title">Crop & Upload Right Logo</h4>
                <span id="width-right">100</span>
                <span id="height-right">100</span>
                <span id="type-right">{{$type}}</span>

                <span id="right_name">{{$table_name}}</span>
                <span id="right_id">{{$table_id}}</span>
                <span id="right_field">rlogo</span>

            </div> 
            <div class="modal-body">
                <div id="resizer2"></div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm crop_can" data-dismiss="modal" onclick="document.getElementById('right-upload').value = ''">Cancel</button>
                <button class="btn crop_image btn-sm" id="applyRight"><span>Apply</span></button>
                <button class="btn rotate float-lef btn-sm" data-deg="90" > 
                <i class="fa fa-undo"></i></button>
                <button class="btn rotate float-right btn-sm" data-deg="-90" > 
                <i class="fa fa-repeat"></i></button> 
            </div>
        </div>
    </div>
</div>

<!-- Signature  -->
<div class="modal" id="leftsigLogoModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"> 
            <div class="modal-header span-none">
                <button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('leftsig-upload').value = ''">&times;</button>
                <h4 class="modal-title">Crop & Upload Left Signature</h4>
                <span id="width-leftsig">140</span>
                <span id="height-leftsig">50</span>
                <span id="type-left">{{$type}}</span>

                <span id="leftsig_name">{{$table_name}}</span>
                <span id="leftsig_id">{{$table_id}}</span>
                <span id="leftsig_field">lsign</span>

            </div> 
            <div class="modal-body">
                <div id="resizer3"></div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm crop_can" data-dismiss="modal" onclick="document.getElementById('leftsig-upload').value = ''">Cancel</button>
                <button class="btn crop_image btn-sm" id="applyLeftsig"><span>Apply</span></button>
                <button class="btn rotate float-lef btn-sm" data-deg="90" > 
                <i class="fa fa-undo"></i></button>
                <button class="btn rotate float-right btn-sm" data-deg="-90" > 
                <i class="fa fa-repeat"></i></button> 
            </div>
        </div>
    </div>
</div> 
<div class="modal" id="middlesigLogoModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"> 
            <div class="modal-header span-none">
                <button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('middlesig-upload').value = ''">&times;</button>
                <h4 class="modal-title">Crop & Upload Middle Signature</h4>
                <span id="width-middlesig">140</span>
                <span id="height-middlesig">50</span>
                <span id="type-middlesig">{{$type}}</span>

                <span id="middlesig_name">{{$table_name}}</span>
                <span id="middlesig_id">{{$table_id}}</span>
                <span id="middlesig_field">msign</span>

            </div> 
            <div class="modal-body">
                <div id="resizer4"></div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm crop_can" data-dismiss="modal" onclick="document.getElementById('middlesig-upload').value = ''">Cancel</button>
                <button class="btn crop_image btn-sm" id="applyMiddlesig"><span>Apply</span></button>
                <button class="btn rotate float-lef btn-sm" data-deg="90" > 
                <i class="fa fa-undo"></i></button>
                <button class="btn rotate float-right btn-sm" data-deg="-90" > 
                <i class="fa fa-repeat"></i></button> 
            </div>
        </div>
    </div>
</div> 

<div class="modal" id="rightsigLogoModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"> 
            <div class="modal-header span-none">
                <button type="button" class="close" data-dismiss="modal" onclick="document.getElementById('rightsig-upload').value = ''">&times;</button>
                <h4 class="modal-title">Crop & Upload Right Signature</h4>
                <span id="width-rightsig">140</span>
                <span id="height-rightsig">50</span>
                <span id="type-rightsig">{{$type}}</span>

                <span id="rightsig_name">{{$table_name}}</span>
                <span id="rightsig_id">{{$table_id}}</span>
                <span id="rightsig_field">rsign</span>

            </div> 
            <div class="modal-body">
                <div id="resizer5"></div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm crop_can" data-dismiss="modal" onclick="document.getElementById('rightsig-upload').value = ''">Cancel</button>
                <button class="btn crop_image btn-sm" id="applyRightsig"><span>Apply</span></button>
                <button class="btn rotate float-lef btn-sm" data-deg="90" > 
                <i class="fa fa-undo"></i></button>
                <button class="btn rotate float-right btn-sm" data-deg="-90" > 
                <i class="fa fa-repeat"></i></button> 
            </div>
        </div>
    </div>
</div> 





<script src="{{asset('additional/uploadcrop/croppie.js')}}"></script>  