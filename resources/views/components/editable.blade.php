@push('styles')
    <!-- Ediable -->
    <link rel="stylesheet" href="{{ asset('additional/bootstrap-editable.css')}}">
    <style>
        .d-none {
            display: none !important;
        }

        .d-block {
            display: block !important;
        }

        @media (min-width: 768px) {
            .w400 {
                width: 400px !important;
            }
        }
    </style>
@endpush
@push('script')
    <!-- Ediable -->
    <script src="{{ asset('additional/bootstrap-editable.min.js')}}"></script>
    <script type="text/javascript">
        // Editable
        $(document).ready(function () {
            $('.color-picker').colorpicker();
            $('.color-picker').click(function () {
                var id = $(this).attr('data-id');
                $(".color_btn_" + id).addClass('d-block').removeClass('d-none');
            });
            $('.hide-submit-btn').click(function () {
                var id = $(this).attr('data-id');
                var value = $(this).attr('data-value');
                $(".color_btn_" + id).addClass('d-none').removeClass('d-block');
                $("#bg_bn_color_" + id).val(value);
            });
            $('.admission_additional_file').click(function () {
                $(".add_file-edit-btn").addClass('d-block').removeClass('d-none');
            });
            $('.hide_additional_field').click(function () {
                $(".add_file-edit-btn").addClass('d-none').removeClass('d-block');
            });
            $("#securenow").click(function () {
                letsEncript();
            });
            $(".logoForType").click(function () {
                var value = $(this).val();
                logoTypeChange(value);
            });
            $('.popupBottom').editable({
                format: 'YYYY',
                viewformat: 'YYYY',
                template: 'YYYY',
                combodate: {
                    minYear: 1800,
                    maxYear: {{date('Y')}},
                    minuteStep: 1
                }
            });
            $('.classTextarea').editable({type: 'textarea', tpl: '<textarea maxlength="5"></textarea>'});
            $('#datetime').editable({
                format: 'yyyy-mm-dd hh:ii',
                viewformat: 'dd-mm-yyyy hh:ii',
                datepicker: {
                    firstDay: 1,
                },
                success: function (data) {
                    Swal.fire({
                        "title": data.msg,
                        "timer": 2000,
                        "padding": "1.25rem",
                        "showConfirmButton": false,
                        "showCloseButton": true,
                        "toast": true,
                        "icon": data.icon,
                        "position": "center",
                        "timerProgressBar": true
                    });
                }
            });
            $('.textAreaW').editable({
                type: 'textarea',
                rows: '5',
                autotext: 'never',
                showbuttons: 'bottom', //false,
                inputclass: 'w400',
                /*tpl: '<textarea maxlength="300"></textarea>',
                validate: function (value) {
                    if (value.length > 300) {
                        return 'Max length is 300';
                    }
                }*/
                success: function (data) {
                    Swal.fire({
                        "title": data.msg,
                        "timer": 2000,
                        "padding": "1.25rem",
                        "showConfirmButton": false,
                        "showCloseButton": true,
                        "toast": true,
                        "icon": data.icon,
                        "position": "center",
                        "timerProgressBar": true
                    });
                    if (data.field === 'site_map') {
                        location.reload();
                    }
                }
            });
            // $.fn.editable.defaults.mode = 'inline';
            $.fn.editable.defaults.params = function (params) {
                params._token = "{{ csrf_token() }}";
                return params;
            };
            $('.required').editable({
                validate: function (value) {
                    if (value == '') {
                        return '{{  trans('validation.required_field') }}';
                    }
                },
                success: function (data) {
                    Swal.fire({
                        "title": data.msg,
                        "timer": 2000,
                        "padding": "1.25rem",
                        "showConfirmButton": false,
                        "showCloseButton": true,
                        "toast": true,
                        "icon": data.icon,
                        "position": "center",
                        "timerProgressBar": true
                    });
                }
            });
            $('.fied-required').editable({
                success: function (data) {
                    Swal.fire({
                        "title": data.msg,
                        "timer": 2000,
                        "padding": "1.25rem",
                        "showConfirmButton": false,
                        "showCloseButton": true,
                        "toast": true,
                        "icon": data.icon,
                        "position": "center",
                        "timerProgressBar": true
                    });
                }
            });
            $("#generate_secret_key").click(function () {
                $.post('{{route('school.secret_key')}}', function (data) {
                    if (data.stt == 200) {
                        $(".secret_key").text('T' + data.secretKey);
                        $(".secret_key_s").text('S' + data.secretKey);
                        Swal.fire({
                            "title": data.msg,
                            "timer": 2000,
                            "padding": "1.25rem",
                            "showConfirmButton": false,
                            "showCloseButton": true,
                            "toast": true,
                            "icon": data.icon,
                            "position": "center",
                            "timerProgressBar": true
                        });
                    }
                })
            });
            $('.extra-filed-add').click(function () {
                var id = $(this).attr('data-id');
                $.post('{{route('setting.update')}}', {
                    pk: $(this).attr('data-pk'),
                    name: $(this).attr('data-name'),
                    value: $("#bg_bn_color_" + id).val()
                }, function (data) {
                    $(".color_btn_" + id).addClass('d-none').removeClass('d-block');
                    Swal.fire({
                        "title": data.msg,
                        "timer": 2000,
                        "padding": "1.25rem",
                        "showConfirmButton": false,
                        "showCloseButton": true,
                        "toast": true,
                        "icon": data.icon,
                        "position": "center",
                        "timerProgressBar": true
                    });
                });
            });
            $('.additional_field').click(function () {
                    var i = 0,arr = [];
                    $('.admission_additional_file:checked').each(function () {
                        arr[i++] = $(this).val();
                    });
                    console.log(arr);
                $.post('{{route('setting.update')}}', {
                    pk: $(this).attr('data-pk'),
                    name: $(this).attr('data-name'),
                    value: arr
                }, function (data) {
                    $(".add_file-edit-btn").addClass('d-none').removeClass('d-block');
                    Swal.fire({
                        "title": data.msg,
                        "timer": 2000,
                        "padding": "1.25rem",
                        "showConfirmButton": false,
                        "showCloseButton": true,
                        "toast": true,
                        "icon": data.icon,
                        "position": "center",
                        "timerProgressBar": true
                    });
                });
            });
        });
    </script>
@endpush