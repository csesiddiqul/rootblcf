<div class="modal" id="imageShowFrame">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{$title}}</h4> 
            </div> 
            <div class="modal-body"> 
                <img src="{{$url}}" class="img-responsive" altr="File">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm crop_can" data-dismiss="modal">Close</button> 
                <a download="{{time()}}.png" href="{{$url}}" title="Download" class="btn crop_image btn-sm">Download</a>
            </div>
        </div>
    </div>
</div>  