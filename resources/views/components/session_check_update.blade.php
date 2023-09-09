@push('script')
    <script>
        @if(session('create_session_now'))
        (async () => {
            const {value: formValues} = await Swal.fire({
                title: '{{transMsg('Please create a session to start your school')}}',
                html:
                    '<label for="swal-input1" class="custom-label">@lang("Session Name")</label><input id="swal-input1" autocomplete="off" placeholder="Ex: {{date('Y')}}" type="text" class="swal2-input">' +
                    '<label for="swal-input2" class="custom-label">@lang("Start Time")</label><input id="swal-input2" autocomplete="off" placeholder="Ex: {{date('d-m-Y')}}" class="swal2-input select_date">' +
                    '<label for="swal-input3" class="custom-label">@lang("End Time")</label><input id="swal-input3" autocomplete="off" placeholder="Ex: {{date('d-m-Y')}}" class="swal2-input select_date">',
                focusConfirm: false,
                preConfirm: () => {
                    return new Promise(function (resolve) {
                        if ($('#swal-input1').val() == '') {
                            swal.showValidationMessage("{{transMsg('Session name is required')}}");
                            $('#swal-input1').focus()
                        } else if ($('#swal-input2').val() == '') {
                            swal.showValidationMessage("{{transMsg('Session start time is required')}}");
                            $('#swal-input2').focus()
                        } else if ($('#swal-input3').val() == '') {
                            swal.showValidationMessage("{{transMsg('Session end time is required')}}");
                            $('#swal-input3').focus()
                        } else {
                            if ($('#swal-input1').val()) {
                                $.post("{{route('academic.session.store')}}?check=1", {request: $('#swal-input1').val()}, function (data) {
                                    if (data.status == 409) {
                                        swal.showValidationMessage(data.msg);
                                    } else {
                                        swal.resetValidationMessage();
                                        resolve([
                                            $('#swal-input1').val(),
                                            $('#swal-input2').val(),
                                            $('#swal-input3').val()
                                        ]);
                                    }
                                });
                            }
                        }
                        Swal.enableButtons();
                    })
                }, onOpen: function () {
                    $('#swal-input1').focus()
                },
                allowOutsideClick: false,
                confirmButtonText: '{{transMsg('Submit')}}',
                customClass: 'swal-wide',
            })

            if (formValues) {
                if (formValues) {
                    $.post("{{route('academic.session.store')}}", {request: formValues}, function (data) {
                        if (data.status == 200) {
                            Swal.fire({
                                title: data.msg,
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false,
                                timerProgressBar: true
                            });
                            location.reload();
                        } else {
                            Swal.fire({
                                title: data.msg,
                                icon: 'info',
                                timer: 2000,
                                showConfirmButton: false,
                                timerProgressBar: true
                            });
                        }
                    });
                }
            }
        })()
        @endif
        @if(session('active_session_now'))
        (async () => {
                const {value: formValues} = await Swal.fire({
                    title: '{{transMsg('Please active a session to start your school')}}',
                    html:
                        '<label for="swal-input1" class="custom-label">@lang("Session")</label>{!! Form::select('schoolyear', schoolSession(false, true), null, ['class' => 'swal2-input','id'=>'swal-input1','placeholder'=>'Choose']) !!}',
                    focusConfirm: false,
                    preConfirm: () => {
                        return new Promise(function (resolve) {
                            if ($('#swal-input1').val() == '') {
                                swal.showValidationMessage("{{transMsg('Session is required')}}");
                                $('#swal-input1').focus()
                            } else {
                                swal.resetValidationMessage();
                                resolve([
                                    $('#swal-input1').val()
                                ]);
                            }
                            Swal.enableButtons();
                        })
                    },
                    allowOutsideClick: false,
                    confirmButtonText: '{{transMsg('Activate')}}',
                    customClass: 'swal-wide',
                })
                if (formValues) {
                    if (formValues) {
                        $.post("{{route('academic.session.store')}}?update=1", {request: formValues}, function (data) {
                            if (data.status == 200) {
                                Swal.fire({
                                    title: data.msg,
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false,
                                    timerProgressBar: true
                                });
                                location.reload();
                            } else {
                                Swal.fire({
                                    title: data.msg,
                                    icon: 'info',
                                    timer: 2000,
                                    showConfirmButton: false,
                                    timerProgressBar: true
                                });
                            }
                        });
                    }
                }
            })()
        @endif
        $(function () {
            $('.select_date').datepicker({
                format: "dd-mm-yyyy",
                viewMode: "days",
                minViewMode: "days",
                autoclose: true,
            });
        });
    </script>
    <style>
        .custom-label {
            float: left;
            margin-bottom: 0px;
            font-size: 13px;
        }

        .swal2-input {
            margin-top: 5px;
        }

        .swal-wide {
            width: 500px !important;
        }

        .swal2-title {
            padding: 20px 0px;
        }
    </style>
@endpush