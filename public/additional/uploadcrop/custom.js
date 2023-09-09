var path = $('meta[name="url"]').attr('content');
/*Image Crop Start*/
$(function() {
    var croppie = null;
    var el = document.getElementById('resizer');
    var el1 = document.getElementById('resizer1');
    var el2 = document.getElementById('resizer2'); 
    var el3 = document.getElementById('resizer3');
    var el4 = document.getElementById('resizer4');

    $.base64ImageToBlob = function(str) { 
        var blob = str; 
        return blob;
    }

    $.getImage = function(input, croppie) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {  
                croppie.bind({
                    url: e.target.result,
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $.getImageStan = function(input, croppie) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {  
                croppie.bind({
                    url: e.target.result,
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $.getImageEx = function(input, croppie) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {  
                croppie.bind({
                    url: e.target.result,
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $.getImageIco = function(input, croppie) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {  
                croppie.bind({
                    url: e.target.result,
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file-upload").on("change", function(event) {  
        $("#imageFrame").modal();
        var widths = $("#width-crop").text();
        var heights = $("#height-crop").text();
        var types = $("#type-crop").text(); 

        // Initailize croppie instance and assign it to global variable
        croppie = new Croppie(el, {
                viewport: {
                    width: widths,
                    height: heights,
                    type: types
                },
                boundary: {
                    height: 300
                },
                enableOrientation: true
            });
        $.getImage(event.target, croppie); 
    });

    $("#upload").on("click", function() {
        croppie.result('base64').then(function(base64) {  
            $('#deliMG').show();
            var response =$.base64ImageToBlob(base64); 
            $("#preview_image").attr("src",(response));  
            $("#imageFrame").modal("hide");
            $(".uploded-text").html('<div class="progress"><div class="progress-bar active progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">100% Uploaded</div>');
            $("#uploaded_image_url").html('<input value="'+response+'" id="url_input" type="hidden" name="url">');
        });
    });

    $("#uploadUdated").on("click", function() {
        croppie.result('base64').then(function(base64) {   
            var response =$.base64ImageToBlob(base64);  
            var table = $("#table_name").text();
            var id = $("#table_id").text();
            var field = $("#table_field").text();

            $("#preview_image").attr("src",(path+'/img/progress.gif'));  
            $("#imageFrame").modal("hide"); 
            
            $.ajax({
                type: "POST",
                cache: false,
                url: "/uploadedImg/updated",
                data: {table:table, id:id, field:field, value:response},
                success: function (data) {  
                    if (data['status'] == 200) {
                        Swal.fire({ 
                            text: false,
                            icon: 'success',
                            title: 'Successfully updated image!',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            showCloseButton:true,
                            toast:true 
                        });
                    } else {
                        Swal.fire({
                            text: false,
                            title: 'Something went wrong, Try again!',
                            icon: 'error',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            showCloseButton:true,
                            toast:true
                        });
                    }
                    setTimeout(function () {
                        location.reload();
                    }, 3000); 
                },
                error: function (xhr, textStatus, thrownError, jqXHR) {
                    showResultFailed(jqXHR.responseText);
                    hideWaitingFail();
                },
            });
        });
    });

    $("#standard-upload").on("change", function(event) {  
        $("#standardFrame").modal();
        var widths = $("#width-standard").text();
        var heights = $("#height-standard").text();
        var types = $("#type-standard").text(); 

        // Initailize croppie instance and assign it to global variable
        croppie = new Croppie(el, {
                viewport: {
                    width: widths,
                    height: heights,
                    type: types
                },
                boundary: {
                    height: 300
                },
                enableOrientation: true
            });
        $.getImageStan(event.target, croppie); 
    });

    $("#uploadStandard").on("click", function() {
        croppie.result('base64').then(function(base64) {   
            var response =$.base64ImageToBlob(base64);  
            var table = $("#standard_name").text();
            var id = $("#standard_id").text();
            var field = $("#standard_field").text();

            $("#preview_standard").attr("src",response);  
            $("#standardFrame").modal("hide");

            $.ajax({
                type: "POST",
                cache: false,
                url: "/uploadedImg/updated",
                data: {table:table, id:id, field:field, value:response},
                success: function (data) {   
                    if (data['status'] == 200) {
                        Swal.fire({ 
                            text: false,
                            icon: 'success',
                            title: 'Successfully updated Standard Logo!',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            showCloseButton:true,
                            toast:true 
                        });
                    } else {
                        Swal.fire({
                            text: false,
                            title: 'Something went wrong, Try again!',
                            icon: 'error',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            showCloseButton:true,
                            toast:true
                        });
                    }
                    setTimeout(function () {
                        location.reload();
                    }, 3000); 
                },
                error: function (xhr, textStatus, thrownError, jqXHR) {
                    showResultFailed(jqXHR.responseText);
                    hideWaitingFail();
                },
            });
        });
    }); 

    $("#express-upload").on("change", function(event) {  
        $("#expressFrame").modal();
        var widths = $("#width-express").text();
        var heights = $("#height-express").text();
        var types = $("#type-express").text(); 

        // Initailize croppie instance and assign it to global variable
        croppie = new Croppie(el1, {
                viewport: {
                    width: widths,
                    height: heights,
                    type: types
                },
                boundary: {
                    height: 300
                },
                enableOrientation: true
            });
        $.getImageEx(event.target, croppie); 
    });

    $("#uploadExpress").on("click", function() {
        croppie.result('base64').then(function(base64) {   
            var response =$.base64ImageToBlob(base64);  
            var table = $("#express_name").text();
            var id = $("#express_id").text();
            var field = $("#express_field").text(); 

            $("#preview_express").attr("src",response);  
            $("#expressFrame").modal("hide"); 
            
            $.ajax({
                type: "POST",
                cache: false,
                url: "/uploadedImg/updated",
                data: {table:table, id:id, field:field, value:response},
                success: function (data) {  
                    if (data['status'] == 200) {
                        Swal.fire({ 
                            text: false,
                            icon: 'success',
                            title: 'Successfully updated Express Logo!',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            showCloseButton:true,
                            toast:true 
                        });
                    } else {
                        Swal.fire({
                            text: false,
                            title: 'Something went wrong, Try again!',
                            icon: 'error',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            showCloseButton:true,
                            toast:true
                        });
                    }
                    setTimeout(function () {
                        location.reload();
                    }, 3000); 
                },
                error: function (xhr, textStatus, thrownError, jqXHR) {
                    showResultFailed(jqXHR.responseText);
                    hideWaitingFail();
                },
            });
        });
    });

    $("#icon-upload").on("change", function(event) {  
        $("#iconFrame").modal();
        var widths = $("#width-icon").text();
        var heights = $("#height-icon").text();
        var types = $("#type-icon").text();
        
        // Initailize croppie instance and assign it to global variable
        croppie = new Croppie(el2, {
                viewport: {
                    width: widths,
                    height: heights,
                    type: types
                },
                boundary: {
                    height: 300
                },
                enableOrientation: true
            });
        $.getImageIco(event.target, croppie); 
    });

    $("#uploadIcon").on("click", function() {
        croppie.result('base64').then(function(base64) {   
            var response =$.base64ImageToBlob(base64); 
            var table = $("#icon_name").text();
            var id = $("#icon_id").text();
            var field = $("#icon_field").text();  

            $("#preview_icon").attr("src",response);
            $("#iconFrame").modal("hide"); 
            
            $.ajax({
                type: "POST",
                cache: false,
                url: "/uploadedImg/updated",
                data: {table:table, id:id, field:field, value:response},
                success: function (data) { 
                    if (data['status'] == 200) {
                        Swal.fire({ 
                            text: false,
                            icon: 'success',
                            title: 'Successfully updated Icon!',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            showCloseButton:true,
                            toast:true 
                        });
                    } else {
                        Swal.fire({
                            text: false,
                            title: 'Something went wrong, Try again!',
                            icon: 'error',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            showCloseButton:true,
                            toast:true
                        });
                    }
                    setTimeout(function () {
                        location.reload();
                    }, 3000); 
                },
                error: function (xhr, textStatus, thrownError, jqXHR) {
                    showResultFailed(jqXHR.responseText);
                    hideWaitingFail();
                },
            });
        });
    });

    $("#about-upload").on("change", function(event) {
        $("#aboutFrame").modal();
        var widths = $("#width-about").text();
        var heights = $("#height-about").text();
        var types = $("#type-about").text();

        // Initailize croppie instance and assign it to global variable
        croppie = new Croppie(el3, {
            viewport: {
                width: widths,
                height: heights,
                type: types
            },
            boundary: {
                height: 300
            },
            enableOrientation: true
        });
        $.getImageIco(event.target, croppie);
    });
    $("#uploadAbout").on("click", function() {
        croppie.result('base64').then(function(base64) {
            var response =$.base64ImageToBlob(base64);
            var table = $("#about_name").text();
            var id = $("#about_id").text();
            var field = $("#about_field").text();

            $("#preview_about").attr("src",response);
            $("#aboutFrame").modal("hide");

            $.ajax({
                type: "POST",
                cache: false,
                url: "/uploadedImg/updated",
                data: {table:table, id:id, field:field, value:response},
                success: function (data) {
                    if (data['status'] == 200) {
                        Swal.fire({
                            text: false,
                            icon: 'success',
                            title: 'Successfully updated about us picture!',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            showCloseButton:true,
                            toast:true
                        });
                    } else {
                        Swal.fire({
                            text: false,
                            title: 'Something went wrong, Try again!',
                            icon: 'error',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            showCloseButton:true,
                            toast:true
                        });
                    }
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                },
                error: function (xhr, textStatus, thrownError, jqXHR) {
                    showResultFailed(jqXHR.responseText);
                    hideWaitingFail();
                },
            });
        });
    });
    $("#HeadSign-upload").on("change", function(event) {
        $("#HeadSignatureFrame").modal();
        var widths = $("#width-HeadSignature").text();
        var heights = $("#height-HeadSignature").text();
        var types = $("#type-HeadSignature").text();

        // Initailize croppie instance and assign it to global variable
        croppie = new Croppie(el4, {
            viewport: {
                width: widths,
                height: heights,
                type: types
            },
            boundary: {
                height: 300
            },
            enableOrientation: true
        });
        $.getImageIco(event.target, croppie);
    });
    $("#HeadSignature").on("click", function() {
        croppie.result('base64').then(function(base64) {
            var response =$.base64ImageToBlob(base64);
            var table = $("#HeadSignature_name").text();
            var id = $("#HeadSignature_id").text();
            var field = $("#HeadSignature_field").text();

            $("#preview_HeadSign").attr("src",response);
            $("#HeadSignatureFrame").modal("hide");

            $.ajax({
                type: "POST",
                cache: false,
                url: "/uploadedImg/updated",
                data: {table:table, id:id, field:field, value:response},
                success: function (data) {
                    if (data['status'] == 200) {
                        Swal.fire({
                            text: false,
                            icon: 'success',
                            title: 'Successfully updated Head Of Institute Signature!',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            showCloseButton:true,
                            toast:true
                        });
                    } else {
                        Swal.fire({
                            text: false,
                            title: 'Something went wrong, Try again!',
                            icon: 'error',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            showCloseButton:true,
                            toast:true
                        });
                    }
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                },
                error: function (xhr, textStatus, thrownError, jqXHR) {
                    showResultFailed(jqXHR.responseText);
                    hideWaitingFail();
                },
            });
        });
    });

    // To Rotate Image Left or Right
    $(".rotate").on("click", function() {
        croppie.rotate(parseInt($(this).data('deg'))); 
    });

    $('#imageFrame').on('hidden.bs.modal', function (e) { 
        setTimeout(function() { croppie.destroy(); }, 100);
    })

    $('#standardFrame').on('hidden.bs.modal', function (e) { 
        setTimeout(function() { croppie.destroy(); }, 100);
    })

    $('#expressFrame').on('hidden.bs.modal', function (e) { 
        setTimeout(function() { croppie.destroy(); }, 100);
    })

    $('#iconFrame').on('hidden.bs.modal', function (e) { 
        setTimeout(function() { croppie.destroy(); }, 100);
    })
    $('#aboutFrame').on('hidden.bs.modal', function (e) {
        setTimeout(function() { croppie.destroy(); }, 100);
    })
    $('#HeadSignatureFrame').on('hidden.bs.modal', function (e) {
        setTimeout(function() { croppie.destroy(); }, 100);
    })

});
//Image Crop End

//For cancel upload
function cancelUploadImg(name) {
    $('#preview_image').attr('src',path+'/additional/uploadcrop/'+name+'.png');  
    $("#url_input").remove();
    $('#file-upload').val('');
    $('#deliMG').hide(); 
    $(".uploded-text").html('Choose Picture');
}