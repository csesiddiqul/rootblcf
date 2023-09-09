var path = $('meta[name="url"]').attr('content');
/*Image Crop Start*/
$(function() {
    var croppie = null;
    var el = document.getElementById('resizer');
    var el1 = document.getElementById('resizer1');
    var el2 = document.getElementById('resizer2'); 
    var el3 = document.getElementById('resizer3'); 
    var el4 = document.getElementById('resizer4'); 
    var el5 = document.getElementById('resizer5'); 
    var el6 = document.getElementById('resizer6'); 

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

    $.getImage1 = function(input, croppie) {
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
    $.getImage2 = function(input, croppie) {
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

    $.getImage3 = function(input, croppie) {
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

    $.getImage4 = function(input, croppie) {
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

    $.getImage5 = function(input, croppie) {
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

    $.getImage6 = function(input, croppie) {
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

    //Left Logo
    $("#left-upload").on("change", function(event) {  
        $("#leftLogoModal").modal(); 
        var widths = $("#width-left").text();
        var heights = $("#height-left").text();
        var types = $("#type-left").text(); 

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

    $("#applyLeft").on("click", function() {
        croppie.result('base64').then(function(base64) {  
            var response =$.base64ImageToBlob(base64); 
            $("#preview_left").attr("src",(response));  
            $("#leftLogoModal").modal("hide"); 
            $("#llogoInput").html('<input value="'+response+'" type="hidden" name="llogo">');
            $('#removeLeft').show();
        });
    });

    //Middle Logo
    $("#middle-upload").on("change", function(event) {  
        $("#middleLogoModal").modal(); 
        var widths = $("#width-middle").text();
        var heights = $("#height-middle").text();
        var types = $("#type-middle").text(); 

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
        $.getImage1(event.target, croppie); 
    });

    $("#applyMiddle").on("click", function() {
        croppie.result('base64').then(function(base64) {  
            var response =$.base64ImageToBlob(base64); 
            $("#preview_middle").attr("src",(response));  
            $("#middleLogoModal").modal("hide"); 
            $("#mlogoInput").html('<input value="'+response+'" type="hidden" name="mlogo">');
            $('#removeMiddle').show();
        });
    }); 

    //Right Logo
    $("#right-upload").on("change", function(event) {  
        $("#rightLogoModal").modal(); 
        var widths = $("#width-right").text();
        var heights = $("#height-right").text();
        var types = $("#type-right").text(); 

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
        $.getImage2(event.target, croppie); 
    });

    $("#applyRight").on("click", function() {
        croppie.result('base64').then(function(base64) {  
            var response =$.base64ImageToBlob(base64); 
            $("#preview_right").attr("src",(response));  
            $("#rightLogoModal").modal("hide"); 
            $("#rlogoInput").html('<input value="'+response+'" type="hidden" name="rlogo">');
            $('#removeRight').show();
        });
    });

    //Left Signature
    $("#leftsig-upload").on("change", function(event) {  
        $("#leftsigLogoModal").modal(); 
        var widths = $("#width-leftsig").text();
        var heights = $("#height-leftsig").text();
        var types = $("#type-leftsig").text(); 

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
        $.getImage3(event.target, croppie); 
    });

    $("#applyLeftsig").on("click", function() {
        croppie.result('base64').then(function(base64) {  
            var response =$.base64ImageToBlob(base64); 
            $("#preview_leftsig").attr("src",(response));  
            $("#leftsigLogoModal").modal("hide"); 
            $("#lsignInput").html('<input value="'+response+'" type="hidden" name="lsign">');
            $('#removeLeftsig').show();
        });
    });

    //Middle Signature
    $("#middlesig-upload").on("change", function(event) {  
        $("#middlesigLogoModal").modal(); 
        var widths = $("#width-middlesig").text();
        var heights = $("#height-middlesig").text();
        var types = $("#type-middlesig").text(); 

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
        $.getImage4(event.target, croppie); 
    });

    $("#applyMiddlesig").on("click", function() {
        croppie.result('base64').then(function(base64) {  
            var response =$.base64ImageToBlob(base64); 
            $("#preview_middlesig").attr("src",(response));  
            $("#middlesigLogoModal").modal("hide"); 
            $("#msignInput").html('<input value="'+response+'" type="hidden" name="msign">');
            $('#removeMiddlesig').show();
        });
    }); 

    //Right Signature
    $("#rightsig-upload").on("change", function(event) {  
        $("#rightsigLogoModal").modal(); 
        var widths = $("#width-rightsig").text();
        var heights = $("#height-rightsig").text();
        var types = $("#type-rightsig").text(); 

        // Initailize croppie instance and assign it to global variable
        croppie = new Croppie(el5, {
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
        $.getImage5(event.target, croppie); 
    });

    $("#applyRightsig").on("click", function() {
        croppie.result('base64').then(function(base64) {  
            var response =$.base64ImageToBlob(base64); 
            $("#preview_rightsig").attr("src",(response));  
            $("#rightsigLogoModal").modal("hide"); 
            $("#rsignInput").html('<input value="'+response+'" type="hidden" name="rsign">');
            $('#removeRightsig').show();
        });
    }); 






    // To Rotate Image Left or Right
    $(".rotate").on("click", function() {
        croppie.rotate(parseInt($(this).data('deg'))); 
    });

    $('#leftLogoModal').on('hidden.bs.modal', function (e) { 
        setTimeout(function() { croppie.destroy(); }, 100);
    })

    $('#middleLogoModal').on('hidden.bs.modal', function (e) { 
        setTimeout(function() { croppie.destroy(); }, 100);
    })

    $('#rightLogoModal').on('hidden.bs.modal', function (e) { 
        setTimeout(function() { croppie.destroy(); }, 100);
    })

    $('#leftsigLogoModal').on('hidden.bs.modal', function (e) { 
        setTimeout(function() { croppie.destroy(); }, 100);
    })

    $('#middlesigLogoModal').on('hidden.bs.modal', function (e) { 
        setTimeout(function() { croppie.destroy(); }, 100);
    })

    $('#rightsigLogoModal').on('hidden.bs.modal', function (e) { 
        setTimeout(function() { croppie.destroy(); }, 100);
    })

    $('#iconFrame').on('hidden.bs.modal', function (e) { 
        setTimeout(function() { croppie.destroy(); }, 100);
    })

});
//Image Crop End

//For cancel upload
function cancelUploadImg(id1,id2,id3,name) {
    $('#'+id1).attr('src',path+'/img/'+name+'.png'); 
    $('#'+id2).hide(); 
    $("#"+id3+' input').remove(); 
}