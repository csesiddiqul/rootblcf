window.addEventListener('load', function () {
    $('.popTop').attr('data-toggle', 'popover').attr('data-placement', 'top').attr('data-html', 'true');
    var findALl = document.getElementsByClassName('popTop');
    for (var i = 0; i < findALl.length; i++) {
        if (findALl[i].getAttribute('title')) {
            findALl[i].setAttribute('data-content', findALl[i].getAttribute('title'));
            findALl[i].removeAttribute('title');
        }
    }
    $('[data-toggle="popover"]').popover({trigger: 'hover'});
})

function isEmpty(val) {
    return (val === undefined || val == null || val.length <= 0) ? true : false;
}

var path = $('meta[name="url"]').attr('content');

function getPersentDistrict(value, sid = null) {
    $.ajax({
        type: "POST",
        cache: false,
        url: path + '/getDistrict',
        data: {value: value},
        success: function (data) {
            $('#preDistrict').html(data.district);
            if (sid !== null) {
                $("#preDistrict").val(sid);
            }
        }, error: function (xhr, textStatus, thrownError) {
            console.log("Something error!!!!")
        },
    });
}

function getPermanentDistrict(value) {
    $.ajax({
        type: "POST",
        cache: false,
        url: path + '/getDistrict',
        async: false,
        data: {value: value},
        success: function (data) {
            $('#pastDistrict').html(data.district);
        }, error: function (xhr, textStatus, thrownError) {
            console.log("Something error!!!!")
        },
    });
}

function getPersentThana(value, sid = null) {
    $.ajax({
        type: "POST",
        cache: false,
        url: path + '/getThana',
        async: false,
        data: {value: value},
        success: function (data) {
            $('#preThana').html(data.thana);
            if (sid !== null) {
                $("#preThana").val(sid);
            }
        }, error: function (xhr, textStatus, thrownError) {
            console.log("Something error!!!!")
        },
    });
}

function getPermanentThana(value) {
    $.ajax({
        type: "POST",
        cache: false,
        url: path + '/getThana',
        data: {value: value},
        success: function (data) {
            $('#pastThana').html(data.thana);
        }, error: function (xhr, textStatus, thrownError) {
            console.log("Something error!!!!")
        },
    });
}

function getPersentstate(value) {
    $.ajax({
        type: "POST",
        cache: false,
        url: path + '/getState',
        data: {value: value},
        success: function (data) {
            $('#state').html(data.state);
        }, error: function (xhr, textStatus, thrownError) {
            console.log("Something error!!!!")
        },
    });
}

function sametoPersent() {
    if (document.getElementById("persent_same").checked) {
        document.getElementById("pastAddress").value = "";
        document.getElementById("pastpostoffice").value = "";
        document.getElementById("pastpostcode").value = "";
        document.getElementById("pastDivision").value = "";
        document.getElementById("pastDistrict").value = "";
        document.getElementById("pastThana").value = "";
        $("#pastAddress").attr('disabled', true);
        $("#pastpostoffice").attr('disabled', true);
        $("#pastpostcode").attr('disabled', true);
        $("#pastDivision").attr('disabled', true);
        $("#pastDistrict").attr('disabled', true);
        $("#pastThana").attr('disabled', true);
        $("#pastAddress").attr('required', false);
        $("#pastpostoffice").attr('required', false);
        $("#pastpostcode").attr('required', false);
        $("#pastDivision").attr('required', false);
        $("#pastDistrict").attr('required', false);
        $("#pastThana").attr('required', false);
    } else {
        $("#pastAddress").attr('disabled', false);
        $("#pastpostoffice").attr('disabled', false);
        $("#pastpostcode").attr('disabled', false);
        $("#pastDivision").attr('disabled', false);
        $("#pastDistrict").attr('disabled', false);
        $("#pastThana").attr('disabled', false);
    }
}

function registry_sweet() {
    Swal.fire({
        customClass: {
            container: 'container-class-custom',
            popup: 'popup-class-custom',
            header: 'header-class-custom',
            title: 'title-class-custom',
            closeButton: 'close-button-class-custom',
            content: 'content-class-custom',
            input: 'input-class',
            actions: 'actions-class-custom',
            confirmButton: 'confirm-button-custom',
            cancelButton: 'cancel-button-custom'
        },
        title: 'Write your institution secret key',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off',
            min: 1,
            id: 'secretKey',
            name: 'secretKey'
        },
        showCancelButton: true,
        confirmButtonText: 'Go now',
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        preConfirm: (value) => {
            if (document.getElementById('secretKey').value) {
                $.post('/school/secretKey/' + value, function (data) {
                    if (data['status'] === '200') {
                        window.location = '/registry';
                    }
                    if (data['status'] === '404') {
                        registry_sweet();
                        Swal.showValidationMessage('Your secret key is invalid');
                    }
                })
            } else {
                Swal.showValidationMessage('Please write your secret key');
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {

        }
    });
}


function registry_sweet1() {
    Swal.fire({
        customClass: {
            container: 'container-class-custom',
            popup: 'popup-class-custom',
            header: 'header-class-custom',
            title: 'title-class-custom',
            closeButton: 'close-button-class-custom',
            content: 'content-class-custom',
            input: 'input-class',
            actions: 'actions-class-custom',
            confirmButton: 'confirm-button-custom',
            cancelButton: 'cancel-button-custom'
        },
        title: 'Write your institution secret key',
        input: 'number',
        inputAttributes: {
            autocapitalize: 'off',
            min: 1,
            id: 'secretKey',
            name: 'secretKey'
        },
        confirmButtonText: 'Next ...',
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        preConfirm: (value) => {
            if (document.getElementById('secretKey').value) {
                $.post('/school/secretKey/' + value, function (data) {
                    if (data['status'] === '200') {
                        Swal.fire({
                            customClass: {
                                container: 'container-class-custom',
                                popup: 'popup-class-custom',
                                header: 'header-class-custom',
                                title: 'title-class-custom',
                                closeButton: 'close-button-class-custom',
                                content: 'content-class-custom',
                                input: 'input-class',
                                actions: 'actions-class-custom',
                                confirmButton: 'confirm-button-custom',
                                cancelButton: 'cancel-button-custom'
                            },
                            title: 'Register as a',
                            input: 'select',
                            inputOptions: {
                                'teacher': 'Teacher',
                                'laibrarian': 'Laibrarian',
                                'accountant': 'Accountant',
                                'staff': 'Staff'
                            },
                            inputPlaceholder: 'Select',
                            inputAttributes: {
                                id: 'employee',
                                name: 'employee'
                            },
                            showCancelButton: true,
                            confirmButtonText: 'Go now',
                            showLoaderOnConfirm: true,
                            preConfirm: (employee) => {
                                if (employee) {
                                    window.location = '/registry';
                                } else {
                                    Swal.showValidationMessage('Please select one');
                                }
                            },
                        }).then(employee => {
                            Swal.fire({
                                title: false,
                                html: 'Please wait ...',
                                timer: 2000,
                                timerProgressBar: true,
                                showConfirmButton: false,
                                willOpen: () => {
                                    Swal.showLoading()
                                    timerInterval = setInterval(() => {
                                        const content = Swal.getContent()
                                        if (content) {
                                            const b = content.querySelector('b')
                                            if (b) {
                                                b.textContent = Swal.getTimerLeft()
                                            }
                                        }
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                }
                            })
                        })
                    } else if (data['status'] === '404') {
                        registry_sweet();
                        Swal.showValidationMessage('Your secret key is invalid');
                    }
                })
            } else {
                Swal.showValidationMessage('Please write your secret key');
            }
        },
        showCancelButton: true,
    })
        .catch(err => {
            swal("Error");
        });
}

function registry_sweet2() {
    Swal.mixin({
        input: 'text',
        confirmButtonText: 'Next &rarr;',
        showCancelButton: true,
        progressSteps: ['1', '2']
    }).queue([
        {
            title: 'Write your institution secret key',
            inputAttributes: {
                id: 'employee',
                required: 'required'
            },
        },
        'Register as a'
    ]).then((result) => {
        if (result.value) {
            alert(result);
            const answers = JSON.stringify(result.value)
            Swal.fire({
                title: 'All done!',
                html: `
            Your answers:
            <pre><code>${answers}</code></pre>
          `,
                confirmButtonText: 'Lovely!'
            })
        }
    })
}

function accountEmailCheck(accountEmail) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(accountEmail)) {
        // $("#emailMsg").text(accountEmail+" is not a valid email");
        /* $("#emailMsg").show();
         if (isEmpty(accountEmail)) {
             document.getElementById("emailMsg").innerHTML = "";
         } else {
             $(".email.form-control").addClass('has-error');
             document.getElementById("emailMsg").innerHTML = "<h5 class='text-danger'> Email is not valid</h5>";
             email.focus;
         }*/
    } else {
        $.ajax({
            type: "POST",
            cache: false,
            url: "/checkEmail",
            data: {email: accountEmail},
            success: function (data) {
                if (data.status === '200') {
                    $("#email.form-control").removeClass('has-error').attr('title', '').attr('data-content', data.msg).popover('show');
                    //document.getElementById("emailMsg").innerHTML = data.msg;
                    setTimeout(function () {
                        $("#emailMsg").hide();
                    }, 3000);
                }
                if (data.status === '404') {
                    $("#emailMsg").show();
                    $("#email.form-control").removeClass('has-error').attr('title', '').attr('data-content', data.msg).popover('show');
                    //document.getElementById("emailMsg").innerHTML = data.msg;
                }
            }
        });
    }
}

$("#admission_form #email").keyup(function () {
    var accountEmail = $(this).val();
    accountEmailCheck(accountEmail);
});

$("#admission_form #email").keydown(function () {
    var accountEmail = $(this).val();
    accountEmailCheck(accountEmail);
});


$(document).delegate('.btnSubmit', 'click', function (e) {

    $('#admission_form').validate({
        rules: {
            /*email: {
                required: true,
                maxlength: 250,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },*/
            name: {
                required: true,
                maxlength: 50
            },
            father_name: {
                required: true,
                maxlength: 50
            },
            mother_name: {
                required: true,
                maxlength: 50
            },
            contactperson: {
                required: true,
                maxlength: 50
            },
            cemail: {
                required: true,
                maxlength: 50
            },
            contactpersonmobile: {
                required: true,
                maxlength: 50
            },
            realation: {
                required: true,
                maxlength: 50
            },
            class_id: {
                required: true,
                digits: true,
            },
            placeBirth: {
                required: true,
                maxlength: 100
            },
            dob: {
                required: true,
                maxlength: 100
            },
            mobile: {
                required: true,
                digits: true,
            },
            gender: {
                required: true,
                digits: true,
            },
            bloodgroup: {
                required: true,
                digits: true,
            },
            religon: {
                required: true,
                digits: true,
            },
            /* preDivision: {
                 required: true,
                 digits: true,
             },
             preDistrict: {
                 required: true,
                 digits: true,
             },
             preThana: {
                 required: true,
                 digits: true,
             },
             pastDivision: {
                 required: true,
                 digits: true,
             },
             pastDistrict: {
                 required: true,
                 digits: true,
             },
             pastThana: {
                 required: true,
                 digits: true,
             }*/
        },
        submitHandler: function (form) {
            var formData = new FormData($(form)[0]); //$(form).serialize();
            $.ajax({
                url: path + "/admission/review",
                type: 'POST',
                dataType: 'json',
                data: formData,
                async: false,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('.btnSubmit').text('Reviewing...');
                }, success: function (data) {
                    e.preventDefault();
                    if (data['status'] === '200') {
                        window.location.replace('/admission/review');
                        /* Swal.fire({
                             icon: 'success',
                             title: 'Congratulations',
                             html: data['msg'],
                             timer: 3000,
                             timerProgressBar: true,
                             showConfirmButton: false,
                         }) */
                        // $(form).trigger("reset");
                    }

                    /* $('.btnSubmit').text('Previewing').css('box-shadow', 'none');*/
                }, error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    });
});

function applicationPreview() {
    $('#admission_form').validate({
        rules: {
            email: {
                required: true,
                maxlength: 250,
                email: true
            },
            name: {
                required: true,
                maxlength: 50
            },
            class_id: {
                required: true,
                digits: true,
            },
            gender: {
                required: true,
                digits: true,
            },
            bloodgroup: {
                required: true,
                digits: true,
            },
            religon: {
                required: true,
                digits: true,
            },
            /*preDivision: {
                required: true,
                digits: true,
            }, 
            preDistrict: {
                required: true,
                digits: true,
            }, 
            preThana: {
                required: true,
                digits: true,
            }, 
            pastDivision: {
                required: true,
                digits: true,
            },
            pastDistrict: {
                required: true,
                digits: true,
            }, 
            pastThana: {
                required: true,
                digits: true,
            },*/

            phone: {
                required: true,
                digits: true,
                maxlength: 15,
                minlength: 11,
            }
        }, submitHandler: function (form) {
            $.ajax({
                url: "/apply/review",
                type: 'post',
                dataType: 'html',
                data: $("#admission_form").serialize(),
                beforeSend: function () {
                    $('.btnPreview').text('Loading...');
                }, success: function (html) {
                    $(".append.modal-body").html(html);
                    $(".modal-body.dssdsd").html(html);
                    $('#previewModal').modal('toggle').modal('show');
                    $('.btnPreview').text('Review');
                }, error: function (xhr, ajaxOptions, thrownError) {
                    $('.btnPreview').text('Review');
                    console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    });
}


function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}

$("#downloadApp #roll").on("input", function () {
    var position = this.selectionStart - 1;
    fixed = this.value.replace(/[^0-9]/g, ""); //remove all but number and .
    if (fixed.charAt(0) === ".") //can't start with .
        fixed = fixed.slice(1);
    var pos = fixed.indexOf(".") + 1;
    if (pos >= 0)
        fixed = fixed.substr(0, pos) + fixed.slice(pos).replace('.', ''); //avoid more than one .

    if (this.value !== fixed) {
        this.value = fixed;
        this.selectionStart = position;
        this.selectionEnd = position;
    }
});


