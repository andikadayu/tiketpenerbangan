<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/css-hamburgers/hamburgers.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animsition/css/animsition.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/select2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
                <form id="frmRegister" action="{{ url()->current() . '/process' }}" method="POST" class="login100-form validate-form" autocomplete="off">
                    {{ csrf_field() }}
                    <span class="login100-form-title p-b-33">
                        Register Akun
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Nama">
                        <input type="text" name="nama" class="input100" placeholder="Nama" required>
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                    <div class="wrap-input100 rs1 validate-input" data-validate="Username">
                        <input type="text" name="username" class="input100" placeholder="Username" required>
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                    <div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
                        <input type="password" name="password" class="input100" placeholder="Password" required>
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                    <div class="wrap-input100 rs1 validate-input">
                        <input type="password" name="confirmpassword" class="input100" placeholder="Konfirmasi Password" required>
                        <span class="focus-input100-1"></span>
                        <span class="focus-input100-2"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-20">
                        <button class="login100-form-btn">
                            Register
                        </button>
                    </div>

                    <div class="text-center p-t-45 p-b-4">
                        <span class="txt1">
                            Sudah mempunyai akun?
                        </span>

                        <a href="{{ url('login') }}" class="txt2 hov1" style="text-decoration: none;">
                            Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/animsition/js/animsition.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('assets/vendor/countdowntime/countdowntime.js') }}"></script>

    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        $('#frmRegister').submit(function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let elementsForm = $(this).find('button, input');

            elementsForm.attr('disabled', true);

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    elementsForm.removeAttr('disabled');

                    if (response.RESULT == 'OK') {
                        window.location.href = '{{ url("login") }}';
                    } else {
                        alert(response.MESSAGE);
                    }
                }
            }).fail(function() {
                elementsForm.removeAttr('disabled');

                alert('Have an error! Please contact developers');
            });
        });
    </script>
</body>

</html>