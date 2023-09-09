<script type="text/javascript">
    $(function () {
        $('input[type="file"]').change(function () { 
            if ($(this).val() != "") {
                $('#deliMG').show();
                $('#fileSubmitBtns').show();
                $('#multiFileUp').prop('required',true);
                $(".uploded-text").html('<div class="progress"><div class="progress-bar active progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">100% Uploaded</div>');
            }else{
                $('#multiFileUp').val('').prop('required',false);
                $('#deliMG').hide(); 
			    $('#fileSubmitBtns').hide(); 
			    $(".uploded-text").html('Choose File');
            }
        });
    })

    //For cancel upload
	function cancelUploadMulti(name) {  
	    $('#multiFileUp').val('').prop('required',false);
        $('#deliMG').hide(); 
	    $('#fileSubmitBtns').hide(); 
	    $(".uploded-text").html('Choose File');
	}
</script>