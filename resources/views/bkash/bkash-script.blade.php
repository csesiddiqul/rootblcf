<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('bkash-get-token') }}",
            type: 'POST',
            contentType: 'application/json',
            success: function (data) {
                console.log(data);
            },
            error: function () {
                console.log('error');
            }
        });
        var paymentConfig = {
            createCheckoutURL: "{{ route('bkash-create-payment') }}",
            executeCheckoutURL: "{{ route('bkash-execute-payment') }}"
        };
        var paymentRequest;
        paymentRequest = {amount: $('.amount').text(), intent: 'sale', invoice: $('.invoice').text()};
        console.log(JSON.stringify(paymentRequest));
        bKash.init({
            paymentMode: 'checkout',
            paymentRequest: paymentRequest,
            createRequest: function (request) {
                console.log('=> createRequest (request) :: ');
                console.log(request);
                $.ajax({
                    url: paymentConfig.createCheckoutURL + "?amount=" + paymentRequest.amount + "&invoice=" + paymentRequest.invoice,
                    type: 'POST',
                    contentType: 'application/json',
                    success: function (data) {
                        console.log('got data from create  ..');
                        console.log('data ::=>');
                        console.log(JSON.stringify(data));

                        var obj = JSON.parse(data);

                        if (data && obj.paymentID != null) {
                            paymentID = obj.paymentID;
                            bKash.create().onSuccess(obj);
                        }
                        else {
                            console.log('error');
                            bKash.create().onError();
                        }
                    },
                    error: function () {
                        console.log('error');
                        bKash.create().onError();
                    }
                });
            },

            executeRequestOnAuthorization: function () {
                console.log('=> executeRequestOnAuthorization');
                $.ajax({
                    url: paymentConfig.executeCheckoutURL + "?paymentID=" + paymentID,
                    type: 'post',
                    contentType: 'application/json',
                    success: function (data) {
                        console.log('got data from execute  ..');
                        console.log('data ::=>');
                        console.log(JSON.stringify(data));

                        data = JSON.parse(data);
                        if (data && data.paymentID != null) {
                            {{--alert('[SUCCESS] data : ' + JSON.stringify(data));--}}
                            {{--window.location.href = "{!! route('bkash-success') !!}";--}}
                            $.ajax({
                                url: "{!! route('bkash-success') !!}",
                                type: 'POST',
                                contentType: 'application/json',
                                data: JSON.stringify({
                                    "data": data
                                }),
                                success: function (data) {
                                    console.log(data);
                                },
                                error: function () {
                                    console.log('error');
                                }
                            });
                        }
                        else {
                            bKash.execute().onError();
                        }
                    },
                    error: function () {
                        bKash.execute().onError();
                    }
                });
            }
        });

        console.log("Right after init ");
    });

    function callReconfigure(val) {
        bKash.reconfigure(val);
    }

    function clickPayButton() {
        $("#bKash_button").trigger('click');
    }
</script>
<!--

<script type="text/javascript">
    function BkashPayment() {
        // showLoading();
        // get token
        $.ajax({
            url: "{{ route('bkash-get-token') }}",
            type: 'POST',
            contentType: 'application/json',
            success: function (data) {
                console.log(data);
                $('pay-with-bkash-button').trigger('click');
                if (data.hasOwnProperty('msg')) {
                    showErrorMessage(data) // unknown error
                }
            },
            error: function (err) {
                ///  hideLoading();
                showErrorMessage(err);
            }
        });
    }

        $(document).ready(function () {
            alert();
            let paymentID = '';
            bKash.init({
                paymentMode: 'checkout',
                paymentRequest: {},
                createRequest: function (request) {
                    setTimeout(function () {
                        createPayment(request);
                    }, 2000)
                },
                executeRequestOnAuthorization: function (request) {
                    $.ajax({
                        url: '{{ route('bkash-execute-payment') }}',
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify({
                            "paymentID": paymentID
                        }),
                        success: function (data) {
                            console.log(data);
                            if (data) {
                                if (data.paymentID != null) {
                                    BkashSuccess(data);
                                } else {
                                    showErrorMessage(data);
                                    bKash.execute().onError();
                                }
                            } else {
                                $.get('{{ route('bkash-query-payment') }}', {
                                    payment_info: {
                                        payment_id: paymentID
                                    }
                                }, function (data) {
                                    if (data.transactionStatus === 'Completed') {
                                        BkashSuccess(data);
                                    } else {
                                        createPayment(request);
                                    }
                                });
                            }
                        },
                        error: function (err) {
                            bKash.execute().onError();
                        }
                    });
                },
                onClose: function () {
                    // for error handle after close bKash Popup
                }
            });
        })

    function createPayment(request) {
        // Amount already checked and verified by the controller
        // because of createRequest function finds amount from this request
        request['amount'] = 100; // max two decimal points allowed
        $.ajax({
            url: '{{ route('bkash-create-payment') }}',
            data: JSON.stringify(request),
            type: 'POST',
            contentType: 'application/json',
            success: function (data) {
                // hideLoading();
                if (data && data.paymentID != null) {
                    paymentID = data.paymentID;
                    bKash.create().onSuccess(data);
                } else {
                    bKash.create().onError();
                }
            },
            error: function (err) {
                //  hideLoading();
                showErrorMessage(err.responseJSON);
                bKash.create().onError();
            }
        });
    }

    function BkashSuccess(data) {
        $.post('{{ route('bkash-success') }}', {
            payment_info: data
        }, function (res) {
            location.reload()
        });
    }

    function showErrorMessage(response) {
        let message = 'Unknown Error';
        if (response.hasOwnProperty('errorMessage')) {
            let errorCode = parseInt(response.errorCode);
            let bkashErrorCode = [2001, 2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014,
                2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030,
                2031, 2032, 2033, 2034, 2035, 2036, 2037, 2038, 2039, 2040, 2041, 2042, 2043, 2044, 2045, 2046,
                2047, 2048, 2049, 2050, 2051, 2052, 2053, 2054, 2055, 2056, 2057, 2058, 2059, 2060, 2061, 2062,
                2063, 2064, 2065, 2066, 2067, 2068, 2069, 503,
            ];
            if (bkashErrorCode.includes(errorCode)) {
                message = response.errorMessage
            }
        }
        Swal.fire("Payment Failed!", message, "error");
    }
</script>-->
