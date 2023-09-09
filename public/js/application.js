window.addEventListener('load', function () {
    $('.popTop').attr('data-toggle', 'popover').attr('data-placement', 'top').attr('data-html', 'true');
    $('.popRight').attr('data-toggle', 'popover').attr('data-placement', 'right').attr('data-html', 'true');
    $('.popLeft').attr('data-toggle', 'popover').attr('data-placement', 'left').attr('data-html', 'true');
    var findALl = document.getElementsByClassName('popTop');
    for (var i = 0; i < findALl.length; i++) {
        if (findALl[i].getAttribute('title')) {
            findALl[i].setAttribute('data-content', findALl[i].getAttribute('title'));
            findALl[i].removeAttribute('title'); //use only if you need to remove data-src attribute after setting src
        }
    }
    var findALls = document.getElementsByClassName('popRight');
    for (var i = 0; i < findALls.length; i++) {
        if (findALls[i].getAttribute('title')) {
            findALls[i].setAttribute('data-content', findALls[i].getAttribute('title'));
            findALls[i].removeAttribute('title'); //use only if you need to remove data-src attribute after setting src
        }
    }
    var findALlls = document.getElementsByClassName('popLeft');
    for (var i = 0; i < findALlls.length; i++) {
        if (findALlls[i].getAttribute('title')) {
            findALlls[i].setAttribute('data-content', findALlls[i].getAttribute('title'));
            findALlls[i].removeAttribute('title'); //use only if you need to remove data-src attribute after setting src
        }
    }
    $('[data-toggle="popover"]').popover({trigger: 'hover'});
    loader_fade_out();
    /* all_images();*/
    datepicker_format();
    for_pay_unpay();
    setWindowHeight();

    $(".toggle-password").click(function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
})
$(window).click(function () {
    setWindowHeight();
});

function thisMaxHeight() {
    var maxHeight = 0;
    $("#main-container .panel.panel-default").each(function () {
        if ($(this).height() > maxHeight) {
            maxHeight = $(this).height();
        }
    });
    return maxHeight;
}

function setWindowHeight() {
    setTimeout(function () {
        var thisHeight = 200;
        if (window.location.href.indexOf("school/website") > -1) {
            var body = document.body,
                html = document.documentElement;
            thisHeight = Math.max(body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight);
        } else {
            if (getCookie('height') <= thisMaxHeight()) {
                setCookie('height', thisMaxHeight(), 0);
                thisHeight = thisHeight + thisMaxHeight();
                if (thisHeight < 750)
                    thisHeight = 750;
            }
        }
        $("#main-container").height(thisHeight)
    }, 1000)
    var width = window.innerWidth;
    if (width > 1370) {
        $(".ex-w-lg-4").addClass("col-lg-4").removeClass('mt-3');
        $(".nav.flex-column span.w-100").addClass('ex-w-cs-f');
        $(".cus-w-pl-0").addClass('pl-0');
        $(".cus-w-pl-15").removeClass('pl-0');
        $("#app-navbar-collapse .nav-item .nav-link").addClass('ex-w-nav-p');
        $(".navbar").addClass("ex-w-mh-100");
        $(".navbar-right-section").addClass("ex-w-h-85");
        $(".imga.navbar-left-section img").addClass("ex-w-img-logo");
    } else {
        $(".ex-w-lg-4").removeClass("col-lg-4").addClass('mt-3');
        $(".nav.flex-column span.w-100").removeClass('ex-w-cs-f');
        $(".cus-w-pl-0").removeClass('pl-0');
        $(".cus-w-pl-15").addClass('pl-0');
        $("#app-navbar-collapse .nav-item .nav-link").removeClass('ex-w-nav-p');
        $(".navbar").removeClass("ex-w-mh-100");
        $(".navbar-right-section").removeClass("ex-w-h-85");
        $(".imga.navbar-left-section img").removeClass("ex-w-img-logo");
    }
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(";");
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function loader_fade_out() {
    $('.loader').fadeOut();
}

$(window).on('load', function () {
    $(".book_preload").delay(2000).fadeOut(200);
    $(".book").on('click', function () {
        $(".book_preload").fadeOut(200);
    })
})

function currentDateTime(id) {
    var today = new Date();
    var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date + ' ' + time;
    $('#' + id).html(dateTime);
}

function dm() {
    var dm = $(".dm").attr('class');
}

function data_table_div(lang_url=false) {
    var pathArray = window.location.pathname.split('/');

    if (pathArray[1] == 'schoolpayments' && pathArray[2] == 'agent') {
        var lengthChange = false;
    } else if (pathArray[1] == 'school' && pathArray[2] == 'payments' && pathArray[3] == 'list') {
        var lengthChange = false;
    } else if (pathArray[1] == 'schoolpayments' && pathArray[2] == 'paid') {
        var lengthChange = false;
    } else {
        var lengthChange = true;
    }
    if (lang_url == false){
        var myTable = $('.table-data-div').DataTable({'pageLength': 25, 'order': [], 'lengthChange': lengthChange}); //{paging: false}
    }else{
        var myTable = $('.table-data-div').DataTable({'pageLength': 25, 'order': [], 'lengthChange': lengthChange,'language':{url:lang_url}}); //{paging: false}
    }
}

function for_pay_unpay() {
    $('.my_cus_table').DataTable();
}

function all_images() {
    var allimages = document.getElementsByTagName('img');
    for (var i = 0; i < allimages.length; i++) {
        if (allimages[i].getAttribute('data-src')) {
            allimages[i].setAttribute('src', allimages[i].getAttribute('data-src'));
        }
    }
}

function datepicker_format() {
    $('.datepicker').datepicker({format: 'yyyy-mm-dd'});
}

function ajaxExamDegreeTitle(value, ids) {
    if (ids == 0) {
        var id = '';
    } else {
        var id = ids;
    }
    if (value != '') {
        $.ajax({
            type: "POST",
            cache: false,
            url: "/routeExamDegreeTitle",
            data: {
                value: value, id: id
            },
            success: function (data) {
                $('#textOrSelect' + id).html(data);
            },
            error: function (xhr, textStatus, thrownError, jqXHR) {
            },
        });
    }
}

function isEmpty(val) {
    return (val === undefined || val == null || val.length <= 0) ? true : false;
}

function otherstitle(value, ids) {
    if (ids == 0) {
        var id = '';
    } else {
        var id = ids;
    }
    if ((value == 'Other') || (value == 'Others')) {
        $('#otherHideShow' + id).show();
        $('#others' + id).attr('required', true);
    } else {
        $('#otherHideShow' + id).hide();
        $('#others' + id).attr('required', false);
    }
}

function academicviewedit(showhide, id) {
    if (showhide == 'show') {
        $('#academicedit' + id).show();
        $('#academicview' + id).hide();
    } else {
        $('#academicedit' + id).hide();
        $('#academicview' + id).show();
    }
}

var path = $('meta[name="url"]').attr('content');

function getAjaxDistrict(id, value, sid = null) {
    $.ajax({
        type: "POST",
        cache: false,
        url: path + '/getDistrict',
        data: {value: value},
        success: function (data) {
            $('#' + id).html(data.district);
            if (sid !== null) {
                $("#" + id).val(sid);
            }
        }, error: function (xhr, textStatus, thrownError) {
            console.log("Something error!!!!")
        },
    });
}

function getAjaxThana(id, value, sid = null) {
    $.ajax({
        type: "POST",
        cache: false,
        url: path + '/getThana',
        async: false,
        data: {value: value},
        success: function (data) {
            $('#' + id).html(data.thana);
            if (sid !== null) {
                $("#" + id).val(sid);
            }
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
        async: false,
        data: {value: value},
        success: function (data) {
            $('#state').html(data.state);
        }, error: function (xhr, textStatus, thrownError) {
            console.log("Something error!!!!")
        },
    });
}

function getsections(value, std = false) {
    $.ajax({
        type: "POST",
        cache: false,
        url: path + '/getSection',
        async: false,
        data: {value: value},
        success: function (data) {
            $('#sections').html(data.section);
            if (std)
                $('#student').html('');
        }, error: function (xhr, textStatus, thrownError) {
            console.log("Something error!!!!")
        },
    });
}

function getStudentsBySection(value, multi = 0, placeholder = 0) {
    $.ajax({
        type: "POST",
        cache: false,
        url: path + '/getStudentsBySection',
        async: false,
        data: {value: value},
        success: function (data) {
            $('#student').html(data.student);
            if (multi === 1 && data.count_std > 0) {
                $('#student').prepend("<option value='all' selected='selected'>All</option>");
            }
            if (placeholder === 1 && data.count_std > 0) {
                $('#student').prepend("<option value='' selected='selected'>Choose</option>");
            }
        }, error: function (xhr, textStatus, thrownError) {
            console.log("Something error!!!!")
        },
    });
}

function getStudentsBySectionRS(rs_value, multi = 0, section_id_name) {
    var section_id = $("#" + section_id_name).val();
    getStudentRS(rs_value, multi, section_id);
}

function getStudentsByRSSection(section_id, multi = 0, rs_id_name) {
    var rs_value = $("#" + rs_id_name).val();
    getStudentRS(rs_value, multi, section_id);
}

function getStudentRS(rs_value, multi, section_id) {
    $.ajax({
        type: "POST",
        cache: false,
        url: path + '/getStudentsBySectionRS',
        async: false,
        data: {'rs_value': rs_value, 'section_id': section_id},
        success: function (data) {
            $('#student').html(data.student);
            if (multi === 1 && data.count_std > 0) {
                $('#student').prepend("<option value='all' selected='selected'>All</option>");
            }
        }, error: function (xhr, textStatus, thrownError) {
            console.log("Something error!!!!")
        },
    });
}

function getBoardExamByStudent(value) {
    $.ajax({
        type: "POST",
        cache: false,
        url: path + '/getBoardExamByStudent',
        async: false,
        data: {value: value},
        success: function (data) {
            $('#board_exam').html(data.exams).prepend("<option value='' selected='selected'>Choose</option>");
        }, error: function (xhr, textStatus, thrownError) {
            console.log("Something error!!!!")
        },
    });
}

function getStudentsSessionSection() {
    let session_id = document.getElementById("session").value;
    let section_id = document.getElementById("section").value;
    if (session_id && section_id) {
        $.ajax({
            type: "POST",
            cache: false,
            url: path + '/getStudentsBySession',
            async: false,
            data: {section_id: section_id, session_id: session_id},
            success: function (data) {
                $('#student').html(data.student).prepend("<option value='' selected='selected'>Choose</option>");
            }, error: function (xhr, textStatus, thrownError) {
                console.log("Something error!!!!")
            },
        })
    }
}

function getPersentDistrict(value) {
    getAjaxDistrict('preDistrict', value);
}

function getPermanentDistrict(value) {
    getAjaxDistrict('pastDistrict', value);
}

function getPersentThana(value) {
    getAjaxThana('preThana', value);
}

function getPermanentThana(value) {
    getAjaxThana('pastThana', value);
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
        $("#pastAddress").attr('required', true);
        $("#pastpostoffice").attr('required', true);
        $("#pastpostcode").attr('required', true);
        $("#pastDivision").attr('required', true);
        $("#pastDistrict").attr('required', true);
        $("#pastThana").attr('required', true);
    }
}


function confirm_delete(id) {
    Swal.fire({
        title: "Confirm Delete",
        text: "Are you sure you want to Delete",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $('#delete_form_' + id).submit();
        }
    })
}

function confirmStatus(id, msg) {
    Swal.fire({
        title: "Confirmation",
        text: "Are you sure " + msg,
        type: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Confirm!'
    }).then((result) => {
        if (result.value) {
            $('#confirm_form_' + id).submit();
        }
    })
}

function accountEmailCheck(accountEmail) {
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(accountEmail)) {
        // $("#emailMsg").text(accountEmail+" is not a valid email");
        $("#emailMsg").show();
        if (isEmpty(accountEmail)) {
            // document.getElementById("emailMsg").innerHTML = "";
        } else {
            $("#email.form-control").addClass('has-error').attr('title', '').attr('data-content', '<h5 class=\'text-danger\'> Please type a valid email</h5>').popover('show');
            email.focus;
        }
    } else {
        $.ajax({
            type: "POST",
            cache: false,
            async: false,
            url: "/checkEmail",
            data: {email: accountEmail},
            success: function (data) {
                if (data.status === '200') {
                    $("#email.form-control").removeClass('has-error').attr('title', '').attr('data-content', data.msg).popover('show');
                    //document.getElementById("emailMsg").innerHTML = data.msg;
                    setTimeout(function () {
                        //$("#emailMsg").hide();
                    }, 2000);
                }
                if (data.status === '404') {
                    $("#emailMsg").show();
                    $("#email.form-control").addClass('has-error').attr('title', '').attr('data-content', data.msg).popover('show');
                    //document.getElementById("emailMsg").innerHTML = data.msg;
                }
            }
        });
    }
}


function activeInactiveUser(id, value) {
    var crrnt = window.location.pathname;
    if (value == 1) {
        var myBtn = 'Inactive';
        var btnColor = '#cd2a19';
        var flassm = 'Successfully Inactivated';
    } else if (value == 2) {
        var myBtn = 'Active';
        var btnColor = '#2778c4';
        var flassm = 'Successfully Activated';
    } else {
        var myBtn = 'Active';
        var btnColor = '#2778c4';
        var flassm = 'Successfully Activated';
    }

    Swal.fire({
        title: "Are you sure?",
        text: "Once clicked, this will be " + myBtn + "!",
        icon: 'info',
        confirmButtonText: myBtn,
        confirmButtonColor: btnColor,
        allowOutsideClick: false,
        showCancelButton: true,
    })
        .then((willAction) => {
            if (willAction.isConfirmed) {
                $.post('/users/active_inactive_user/' + id + '/' + value, function (data) {
                    if (data == 200) {
                        Swal.fire({
                            title: flassm,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                            timerProgressBar: true
                        });
                        if (crrnt == '/agents') {
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            $("#tr" + id).hide();
                        }
                    } else {
                        Swal.fire({
                            title: 'Something went wrong!',
                            icon: 'warning',
                            timer: 2000,
                            showConfirmButton: false,
                            timerProgressBar: true
                        });
                    }
                });
            } else {
                //cancel
            }
        });
}


function admissionActions(value, id) {
    if (value == 3) {
        var inputs = 'textarea';
        var inputLabels = false;
        var requireds = 'required';
    } else {
        var inputs = false;
        var inputLabels = false;
        var requireds = false;
    }

    if (value == 1) {
        var myBtn = 'Pending';
        var btnColor = '#f39c12';
        var flassm = 'Successfully Pending';
    } else if (value == 2) {
        var myBtn = 'Approve';
        var btnColor = '#3498db';
        var flassm = 'Successfully Approved';
    } else if (value == 3) {
        var myBtn = 'Reject';
        var btnColor = '#e74c3c';
        var flassm = 'Successfully Rejected';
    } else if (value == 4) {
        var myBtn = 'Paid';
        var btnColor = '#18bc9c';
        var flassm = 'Successfully Paid';
    } else {
        var myBtn = 'Unpaid';
        var btnColor = '#95a5a6';
        var flassm = 'Successfully Unpaid';
    }

    Swal.fire({
        title: "Are you sure?",
        text: "Once clicked, this will be " + myBtn + "!",
        input: inputs,
        inputLabel: inputLabels,
        icon: 'info',
        inputAttributes: {
            id: 'admission',
            placeholder: 'Write the reason ...',
            required: requireds
        },
        confirmButtonText: myBtn,
        confirmButtonColor: btnColor,
        allowOutsideClick: false,
        showCancelButton: true,
    })
        .then((willAction) => {
            var remark = willAction.value;
            if (remark != true) {
                var remarks = remark;
            } else {
                var remarks = 'noremark';
            }

            if (willAction.isConfirmed) {
                $.post('/academic/admission/actions/' + value + '/' + id + '/' + remarks, function (data) {
                    if (data == 200) {
                        Swal.fire({
                            title: flassm,
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                            timerProgressBar: true
                        });
                        $('#change' + id).hide();
                    } else {
                        Swal.fire({
                            title: 'Something went wrong, Try again!',
                            icon: 'warning',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true
                        });
                    }
                });
            } else {

            }
        });
}

function priceStatus(value, id) {
    if (value == 2) {
        var myBtn = 'Pending';
        var btnColor = '#f39c12';
        var flassm = 'Successfully Pending';
    } else if (value == 1) {
        var myBtn = 'Active';
        var btnColor = '#3498db';
        var flassm = 'Successfully Activated';
    } else if (value == 4) {
        var myBtn = 'Default';
        var btnColor = '#18bc9c';
        var flassm = 'Successfully set as default';
    } else {
        var myBtn = 'Inactive';
        var btnColor = '#e74c3c';
        var flassm = 'Successfully Inactivated';
    }

    Swal.fire({
        title: "Are you sure?",
        text: "Once clicked, this will be " + myBtn + "!",
        icon: 'info',
        confirmButtonText: myBtn,
        confirmButtonColor: btnColor,
        allowOutsideClick: false,
        showCancelButton: true,
    }).then(function (isConfirm) {
        if (isConfirm.isConfirmed == true) {
            $.post('/pricings/status/' + value + '/' + id, function (data) {
                if (data == 200) {
                    if (value == 2) {
                        $('#status' + id).removeClass('selec0 selec1').addClass('selec2');
                    } else if (value == 1) {
                        $('#status' + id).removeClass('selec0 selec2').addClass('selec1');
                    } else if (value == 4) {
                        $('#status' + id).removeClass('selec0 selec2 selec1');
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else {
                        $('#status' + id).removeClass('selec1 selec2').addClass('selec0');
                    }

                    Swal.fire({
                        title: flassm,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                } else {
                    Swal.fire({
                        title: 'Something went wrong, Try again!',
                        icon: 'warning',
                        timer: 3000,
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                }
            });
        } else {
            location.reload();
        }
    });
}

function img_confirm_delete(table, id, field, mgs) {
    Swal.fire({
        title: "Confirm Delete",
        text: "Are you sure you want to delete " + mgs + '?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete Now'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: "/uploadedImg/delete",
                data: {table: table, id: id, field: field},
                success: function (data) {
                    if (data['status'] == 200) {
                        Swal.fire({
                            text: false,
                            icon: 'success',
                            title: 'Successfully deleted, ' + mgs + '!',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            showCloseButton: true,
                            toast: true
                        });
                    } else {
                        Swal.fire({
                            text: false,
                            title: 'Something went wrong, Try again!',
                            icon: 'error',
                            timer: 3000,
                            showConfirmButton: false,
                            timerProgressBar: true,
                            showCloseButton: true,
                            toast: true
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
        }
    })
}

function letsEncript() {
    Swal.fire({
        title: "Confirm Secure",
        text: "Are you sure you want to Secure your Domain?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Let's Secure"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "POST",
                cache: false,
                async: false,
                url: "/update_info",
                data: {pk: 4, name: 'letsencript', value: '00100'},
                success: function (data) {
                    if (data['status'] == 200) {
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    }
                    Swal.fire({
                        text: false,
                        title: data.msg,
                        icon: data.icon,
                        timer: data.time || 3000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        showCloseButton: true,
                        toast: true
                    });
                },
                error: function (jqXHR, exception) {
                    var msg = '';
                    if (jqXHR.status === 0) {
                        msg = 'Not connect.\n Verify Network.';
                    } else if (jqXHR.status == 404) {
                        msg = 'Requested page not found. [404]';
                    } else if (jqXHR.status == 500) {
                        msg = 'Internal Server Error [500].';
                    } else if (exception === 'parsererror') {
                        msg = 'Requested JSON parse failed.';
                    } else if (exception === 'timeout') {
                        msg = 'Time out error.';
                    } else if (exception === 'abort') {
                        msg = 'Ajax request aborted.';
                    } else {
                        msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    }
                    Swal.fire({
                        text: false,
                        title: msg,
                        icon: 'error',
                        timer: 3000,
                        showConfirmButton: false,
                        timerProgressBar: true,
                        showCloseButton: true,
                        toast: true
                    });
                },
            });
        }
    })
}

function logoTypeChange(value) {
    $.ajax({
        type: "POST",
        cache: false,
        async: false,
        url: "/update_info",
        data: {pk: 2, name: 'logo_type', value: value},
        success: function (data) {
            if (data['status'] == 200) {
                setTimeout(function () {
                    location.reload();
                }, 3000);
            }
            Swal.fire({
                text: false,
                title: data.msg,
                icon: data.icon,
                timer: data.time || 3000,
                showConfirmButton: false,
                timerProgressBar: true,
                showCloseButton: true,
                toast: true
            });
        },
        error: function (jqXHR, exception) {

        },
    });
}

function editMarkRow(id) {
    $('#' + id).css("background", "#FFF");
}

function saveToDatabase(editableObj, id) {
    $('#' + id).css("background", "url(https://foqasacademy.com/img/loading.gif) no-repeat right");
    var value = $(editableObj).text();
    if (isNaN(value)) {
        Swal.fire({
            text: false,
            title: 'Please give only number!',
            icon: 'error',
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true,
            showCloseButton: true,
            toast: true
        });
        value = 0;
        $('#' + id).css("color", "#e74c3c").focus();
        return false;
    }

    $.ajax({
        url: "/academic/admission/marksentry",
        type: "POST",
        async: false,
        data: 'editval=' + value + '&id=' + id,
        success: function (data) {
            if (data == '200') {
                $('#' + id).css("background", "#f5f5f500").attr('style', 'color:#444');
            } else {
                $('#' + id).css("background", "#f5f5f500").attr('style', 'color:#e74c3c').focus();
            }
        }
    });
}

function removeThisImg(id, name) {
    $.post(path + '/academic/remove/removetempleteImg/' + id + '/' + name, function (data) {
        // console.log(data.msg);
    })
}

$(document).ready(function () {
    $('.takeAttendance').on("click", function () {
        const id = $(this).attr('id');
        $('#' + id).css("background", "url(https://foqasacademy.com/img/loading.gif) no-repeat right");
        var insert = [];
        insert.push(id);
        if ($(this).is(":checked")) {
            insert.push('1');
        } else {
            insert.push('0');
        }
        insert = insert.toString();
        $.ajax({
            url: "/takeAttendanceViaSection",
            method: "POST",
            async: false,
            data: {insert: insert},
            success: function (data) {
                //   console.log(data);
            }
        });
    });
    $('.adjustAtt').on("click", function () {
        var id = $(this).attr('id');
        $("#adjustAtt" + id).removeClass('d-none').focus();
    });
    $(".adjustAttR").on('keyup', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            $(this).blur();
        }
    });
    $('#attrCheckAll').change(function () {
        Swal.fire({
            title: "Confirmation !",
            text: "Are you sure to Attendance all student",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes",
            allowOutsideClick: false,
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: false,
                    html: 'Please wait in <b></b> milliseconds',
                    timer: 1000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    didOpen: () => {
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
                        clearInterval(timerInterval);
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        $('.takeAttendance').trigger('click').prop('checked', this.checked);
                        if ($(this).is(":checked")) {
                            $(this).attr('checked', true);
                        } else {
                            $(this).attr('checked', false);
                        }
                        $(".attrCheckNone").html("");
                    }
                })
            } else {
                $(this).attr('checked', false);
            }
        }).catch(err => {
            $(this).attr('checked', false);
        });
    });
});

function adjustAttRemark(element) {
    var id = $(element).attr('data-id');
    var value = $(element).val();
    if (isEmpty(value)) {
        Swal.fire({
            title: "Remarks !",
            text: "Write your Correction remarks",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Write...",
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {
                $(element).focus();
            } else {
                $(element).addClass('d-none');
                if ($("#" + id).is(":checked")) {
                    $("#" + id).prop("checked", false);
                } else {
                    $("#" + id).prop('checked', true);
                }
            }
        })
    } else {
        var insert = [];
        insert.push(id);
        if ($("#" + id).is(":checked")) {
            insert.push('1');
        } else {
            insert.push('0');
        }
        insert.push(value);
        $.ajax({
            url: "/adjustAttendance",
            method: "POST",
            async: false,
            data: {insert: insert},
            success: function (data) {
                //  console.log(data);
            }
        });
    }
}

function menusContent(id, name) {
    Swal.fire({
        title: "Confirmation !",
        text: "Content already added " + name + " menu. If you want delete " + name + " & this content click on Confirm delete.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Confirm Delete",
        allowOutsideClick: false
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: path + "/academic/menu/" + id,
                method: "DELETE",
                async: false,
                data: {reConfirm: 1},
                success: function (data) {
                    $("#tr" + id).hide();
                    Swal.fire({
                        "title": "Menu Delete successfully",
                        "text": "",
                        "timer": 3000,
                        "width": "32rem",
                        "padding": "1.25rem",
                        "showConfirmButton": false,
                        "showCloseButton": true,
                        "toast": true,
                        "icon": "success",
                        "position": "center",
                        "timerProgressBar": true
                    });
                }
            });
        } else {
            $.ajax({
                url: path + "/academic/menu/" + id,
                method: "DELETE",
                async: false,
                data: {reConfirm: 2},
                success: function (data) {
                }
            });
        }
    })
}

function priceReferenceCode(code) {
    $.ajax({
        type: "POST",
        cache: false,
        url: path + '/pricings/checkcode',
        async: false,
        data: {code: code},
        success: function (data) {
            if (data['price']) {
                var total = data['price'] / (1 - 0.025);
                var amount = parseFloat(total).toFixed(2);
                var tran_fee = parseFloat(total - data['price']).toFixed(2);
            }

            if (data['status'] == 1) {
                $('.alert table caption').text(data['title']);
                $('.alert table>tbody>tr:first-child td:first-child span').text(data['price_type']);
                $('.alert table>tbody>tr:first-child td:last-child span').text(data['price']);
                $('.alert table>tbody>tr:nth-child(2) td span').text(tran_fee);
                $('.alert table>tbody>tr:nth-child(3) td span').text(amount);
                $('.alert table>tbody>tr:last-child td span').text(data['perStudent']);

                $('#pricingTable').show();
                $('#indicator').html('Reference Code').css('color', '#5f6368');
                $('#regbtn').attr({disabled: false});
                $("#preview_cry").attr("src", "").hide();
                $('#ref_number').removeClass('has-error');
            } else if (data['status'] == 4) {
                $('.alert table caption').text(data['title']);
                $('.alert table>tbody>tr:first-child td:first-child span').text(data['price_type']);
                $('.alert table>tbody>tr:first-child td:last-child span').text(data['price']);
                $('.alert table>tbody>tr:nth-child(2) td span').text(tran_fee);
                $('.alert table>tbody>tr:nth-child(3) td span').text(amount);
                $('.alert table>tbody>tr:last-child td span').text(data['perStudent']);

                $('#pricingTable').show();
                if (code) {
                    $('#indicator').html('*Reference Code <img src="' + path + '/img/verify.gif" alt="Image"/>').css('color', 'red');
                    $('#regbtn').attr({disabled: true});
                    $('#ref_number').removeClass('has-error');
                } else {
                    $('#indicator').html('Reference Code').css('color', '#5f6368');
                    $('#regbtn').attr({disabled: false});
                    $('#ref_number').removeClass('has-error');
                }
                $("#preview_cry").attr("src", "").hide();
            } else {
                $("#preview_cry").attr("src", path + '/image/foqas_cry.png').css('display', 'block');
                $('#regbtn').attr({disabled: true});
                $('#pricingTable').hide();

            }
        }, error: function (xhr, textStatus, thrownError) {
            console.log("Something error!!!!")
        },
    });
}

function stripeReferenceCode(code) {
    $.ajax({
        type: "POST",
        cache: false,
        url: path + '/pricings/checkcode',
        async: false,
        data: {code: code},
        success: function (data) {
            if (data['price']) {
                var total = (data['price'] + 0.30) / (1 - 0.029);
                var amount = parseFloat(total).toFixed(2);
                var stripe_fee = parseFloat(total - data['price']).toFixed(2);
            }
            ;

            if (data['status'] == 1) {
                $('.alert table caption').text(data['title']);
                $('.alert table>tbody>tr:first-child td:first-child span').text(data['price_type']);
                $('.alert table>tbody>tr:first-child td:last-child span').text(data['price']);
                $('.alert table>tbody>tr:nth-child(2) td span').text(stripe_fee);
                $('.alert table>tbody>tr:nth-child(3) td span').text(amount);
                $('.alert table>tbody>tr:last-child td span').text(data['perStudent']);

                $('#pricingTable').show();
                $('#indicator').html('Reference Code').css('color', '#5f6368');
                $('#regbtn').attr({disabled: false});
                $("#preview_cry").attr("src", "").hide();
                $('#ref_number').removeClass('has-error');
            } else if (data['status'] == 4) {
                $('.alert table caption').text(data['title']);
                $('.alert table>tbody>tr:first-child td:first-child span').text(data['price_type']);
                $('.alert table>tbody>tr:first-child td:last-child span').text(data['price']);
                $('.alert table>tbody>tr:nth-child(2) td span').text(stripe_fee);
                $('.alert table>tbody>tr:nth-child(3) td span').text(amount);
                $('.alert table>tbody>tr:last-child td span').text(data['perStudent']);

                $('#pricingTable').show();
                if (code) {
                    $('#indicator').html('*Reference Code <img src="' + path + '/img/verify.gif" alt="Image"/>').css('color', 'red');
                    $('#regbtn').attr({disabled: true});
                } else {
                    $('#indicator').html('Reference Code').css('color', '#5f6368');
                    $('#regbtn').attr({disabled: false});
                }
                $("#preview_cry").attr("src", "").hide();
                $('#ref_number').removeClass('has-error');
            } else {
                $("#preview_cry").attr("src", path + '/image/foqas_cry.png').css('display', 'block');
                $('#regbtn').attr({disabled: true});
                $('#pricingTable').hide();

            }
        }, error: function (xhr, textStatus, thrownError) {
            console.log("Something error!!!!")
        },
    });
}

function agentCodeCheck(code) {
    $.ajax({
        type: "POST",
        cache: false,
        url: path + '/agents/check',
        async: false,
        data: {code: code},
        success: function (data) {
            if (data == 200) {
                $('#verifiedAgent').html('Agent Number').css('color', '#5f6368');
                $('#regbtn').attr({disabled: false});
                $("#preview_cry").attr("src", "").hide();
                $('#agentcode').removeClass('has-error');
            } else {
                if (code) {
                    $('#verifiedAgent').html('*Agent Number <img src="' + path + '/img/verify.gif" alt="Image"/>').css('color', 'red');
                    $('#regbtn').attr({disabled: true});
                } else {
                    $('#verifiedAgent').html('Agent Number').css('color', '#5f6368');
                    $('#regbtn').attr({disabled: false});
                }
                $('#agentcode').removeClass('has-error');
            }
        }, error: function (xhr, textStatus, thrownError) {
            console.log("Something error!!!!")
        },
    });
}

function pricingType(value) {
    if (value == 1) {
        $('#subsMonthDiv').css('display', 'block');
        $('#perStudentDiv').css('display', 'block');
        $('#subsMonthDiv .control-label').text('*Subscription With');
        $('.select2').css('width', '100%');
        $('#subsMonth').attr('required', true);
        $('#perStudent').attr('required', true);
    } else if (value == 3) {
        $('#subsMonthDiv').css('display', 'block');
        $('#perStudentDiv').hide();
        $('#subsMonthDiv .control-label').text('*Number of Month');
        $('.select2').css('width', '100%');
        $('#subsMonth').attr('required', true);
        $('#perStudent').attr('required', false);
    } else {
        $('#subsMonthDiv').hide();
        $('#perStudentDiv').hide();
        $('#subsMonth').attr('required', false);
        $('#perStudent').attr('required', false);
    }
}

//Only for ready function
$(document).ready(function () {
    $('.validForm #regbtn').attr({disabled: true});
    $('.stripe-button-el').attr('id', 'regbtn');
});

function confirmLogout() {
    Swal.fire({
        title: "Logout",
        text: "Are you sure you want to logout ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Ok, Logout"
    }).then((result) => {
        if (result.value) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }
    })
}

function attendanceSendSMS(section, date, showDate) {
    Swal.fire({
        input: 'textarea',
        inputLabel: 'Write Message',
        inputValue: 'The message is to inform you that your student was absent ' + showDate + ', Thank you',
        inputPlaceholder: 'Type your message here...',
        inputAttributes: {
            'aria-label': 'Type your message here'
        },
        customClass: {
            confirmButton: 'foqas-btn',
        },
        showCancelButton: true,
        confirmButtonText: 'Send',
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        preConfirm: (object) => {
            if (object === false) return false;
            if (object === "") {
                Swal.showValidationMessage(`The message field is required`);
                return false
            }
            return object;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            var insert = [];
            insert.push(section);
            insert.push(date);
            insert.push(result.value);
            // console.log(insert);
            $.ajax({
                url: "/attendanceSendSMS",
                method: "POST",
                async: false,
                data: {insert: insert},
                success: function (data) {
                    //console.log(data);
                    Swal.fire({
                        "title": data.msg,
                        "timer": 2000,
                        "padding": "1.25rem",
                        "showConfirmButton": false,
                        "showCloseButton": true,
                        "toast": true,
                        "icon": (data.status === 200 ? 'success' : 'warning'),
                        "position": "center",
                        "timerProgressBar": true
                    });
                }
            });
        }
    })
}

function resultsSendSMS(exam, section) {
    Swal.fire({
        input: 'textarea',
        inputLabel: 'Write Message ( $exam_name, $class, $section, $roll, $gpa, $school_name, $session,$pass_or_fail )',
        inputValue: '$school_name has been published $exam_name exam results in $session Session. Your Roll is $roll & you achieve $gpa (out of 5.00) status $pass_or_fail, Thank you',
        inputPlaceholder: 'Type your message here...',
        inputAttributes: {
            'aria-label': 'Type your message here'
        },
        customClass: {
            confirmButton: 'foqas-btn',
        },
        showCancelButton: true,
        confirmButtonText: 'Send',
        showLoaderOnConfirm: true,
        allowOutsideClick: false,
        preConfirm: (object) => {
            if (object === false) return false;
            if (object === "") {
                Swal.showValidationMessage(`The message field is required`);
                return false
            }
            return object;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            var insert = [];
            insert.push(section);
            insert.push(exam);
            insert.push(result.value);
            // console.log(insert);
            $.ajax({
                url: "/resultsSendSMS",
                method: "POST",
                async: false,
                data: {insert: insert},
                success: function (data) {
                    Swal.fire({
                        "title": data.msg,
                        "timer": 2000,
                        "padding": "1.25rem",
                        "showConfirmButton": false,
                        "showCloseButton": true,
                        "toast": true,
                        "icon": (data.status === 200 ? 'success' : 'warning'),
                        "position": "center",
                        "timerProgressBar": true
                    });
                }
            });
        }
    })
}

$(document).delegate('#cloneAtForm button', 'click', function (e) {
    $('#cloneAtForm').validate({
        rules: {
            previous_exam: {
                required: true,
                digits: true
            },
            new_exam: {
                required: true,
                digits: true
            }
        }, messages: {
            previous_exam: {
                required: "Please select an previous exam",
            },
            new_exam: {
                required: "Please select an new exam",
            }
        }, submitHandler: function (form) {
            Swal.fire({
                title: "Confirmation",
                text: "Are you sure you want to Clone one exams  to another's exams ?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Ok, Clone"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: path + "/academic/clone/course_config",
                        type: 'post',
                        data: $("#cloneAtForm").serialize(),
                        beforeSend: function () {
                            $('#cloneAtForm button').text('Cloning ...');
                        }, success: function (data) {
                            Swal.fire({
                                "title": data.message,
                                "timer": 5000,
                                "padding": "1.25rem",
                                "showConfirmButton": false,
                                "showCloseButton": true,
                                "toast": true,
                                "icon": data.type,
                                "position": "center",
                                "timerProgressBar": true
                            });
                            $('#cloneAtForm button').text('Clone');
                            if (data.status === 200) {
                                location.reload();
                            }
                        }, error: function (xhr, ajaxOptions, thrownError) {
                            $('#cloneAtForm button').text('Clone');
                            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                }
            })
        }
    });
});
