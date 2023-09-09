@extends('layouts.app')

@section('title', __('Academic Settings'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" id="main-container">
                <table class="table table-responsive">
                    <form action="" method="post">
                        @csrf
                        <tbody>
                        <tr>
                            <td>Web URL</td>
                            <td>20165757.foqasacademy.com</td>
                        </tr>
                        <tr>
                            <td>Custom Website</td>
                            <td>
                                <a href="#" id="web" data-type="text" data-name="web" data-pk="3"></a>
                                @error('web')
                                {{$message}}
                                @enderror
                                <span id="msg"></span>
                                <br>
                                <span id="msg1"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Https Status</td>
                            <td>Not Secure</td>
                        </tr>
                        <tr>
                            <td>Secure website</td>
                            <td>
                                <button>Secure with Lets Encript</button>
                            </td>
                        </tr>
                        </tbody>
                    </form>
                </table>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('additional/bootstrap-editable.css')}}">

    <script src="{{ asset('additional/bootstrap-editable.min.js')}}"></script>
    <script>
        $(function () {
            $('#web').editable({
                url: "{{url('custom')}}",
                title: 'Enter weburl',
                success: function (response) {
                    console.log(response);
                    Swal.fire({
                        "title": response.msg,
                        "timer": 5000,
                        "padding": "1.25rem",
                        "showConfirmButton": false,
                        "showCloseButton": true,
                        "toast": true,
                        "icon": response.icon,
                        "position": "center",
                        "timerProgressBar": true
                    });

                }
            });
        });
    </script>
@endsection
