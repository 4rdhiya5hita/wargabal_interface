@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Login"])

    @include("partials/head-css")

</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="card-body pt-0">

                            <div class="p-3">
                                <h4 class="text-muted font-size-18 mt-3 mb-1 text-center">Selamat Datang !</h4>
                                <p class="text-muted text-center">Silahkan login untuk melanjutkan.</p>
                                <form action="{{ route('login') }}" method="post" class="form-horizontal mt-4">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" value="{{ old('email') }}" name="email" placeholder="Masukkan email">
                                        <div class="text-success" id="valid-email"></div>
                                        <div class="text-danger" id="invalid-email"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="userpassword">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Masukkan password">
                                        <div class="text-success" id="valid-password"></div>
                                        <div class="text-danger" id="invalid-password"></div>
                                    </div>
                                    <div class="mb-3 row mt-4">
                                        <!-- <div class="col-6">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customControlInline">
                                                    <label class="form-check-label" for="customControlInline">Ingat saya
                                                    </label>
                                                </div>
                                            </div> -->
                                        <div class="col-12 text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light" id="login_button" type="submit">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- masuk sebagai guest tanpa login -->
                    <div class="mt-5 text-center">
                        <p>Kembali ke dashboard tanpa login. <a href="{{ route('index') }}" class="text-primary"> Kalender Bali </a></p>
                        <p>Belum punya akun ? <a href="{{ route('register_page') }}" class="text-primary"> Signup Sekarang </a></p>
                    </div>
                    <!-- <div class="mt-5 text-center">
                    </div> -->

                    <form id="resend-verification-form" action="{{ route('verifikasi_ulang_email') }}" method="post" style="display: none;">
                        @csrf
                        <input type="hidden" name="email" id="email-input">
                        <input type="hidden" name="password" id="password-input">
                    </form>

                </div>
            </div>
        </div>
    </div>

    @include("partials/vendor-scripts")
<!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $error_appear = [];
            // email
            $('#email').on('input', function() {
                var email = $('#email').val();
                var email_length = email.length;
                if (email_length <= 0) {
                    $('#email').removeClass('is-valid');
                    $('#email').addClass('is-invalid');
                    $('#invalid-email').html('Email harus diisi!');
                    $('#valid-email').html('');
                    $error_appear.push('email');
                } else if (!email.includes('@')) {
                    $('#email').removeClass('is-valid');
                    $('#email').addClass('is-invalid');
                    $('#invalid-email').html('Input harus berupa format email!');
                    $('#valid-email').html('');
                    $error_appear.push('email');
                } else {
                    $('#email').removeClass('is-invalid');
                    $('#email').addClass('is-valid');
                    $('#valid-email').html('Ok!');
                    $('#invalid-email').html('');
                    $error_appear = $error_appear.filter(function(item) {
                        return item !== 'email';
                    });
                }
            });

            // password
            $('#password').on('input', function() {
                var password = $('#password').val();
                var password_length = password.length;
                if (password_length < 8) {
                    $('#password').removeClass('is-valid');
                    $('#password').addClass('is-invalid');
                    $('#invalid-password').html('Password minimal 8 karakter!');
                    $('#valid-password').html('');
                    $error_appear.push('password');
                } else {
                    $('#password').removeClass('is-invalid');
                    $('#password').addClass('is-valid');
                    $('#valid-password').html('Ok!');
                    $('#invalid-password').html('');
                    $error_appear = $error_appear.filter(function(item) {
                        return item !== 'password';
                    });
                }
            });

            // login button
            $('#login_button').on('click', function() {
                var email = $('#email').val();
                var password = $('#password').val();
                var check = $error_appear.includes('email') || $error_appear.includes('password');

                if (email.length <= 0 || password.length <= 0 || check == true) {
                    // ubah type button submit ke button agar tidak submit form
                    $('#login_button').attr('type', 'button');
                } else {
                    // ubah type button submit ke submit agar bisa submit form
                    $('#login_button').attr('type', 'submit');
                }
            });
        });
    </script>

    @if($errors->any())
    @foreach ($errors->all() as $error)

    @if ($error == "The phone field must be between 10 and 13 digits.")
    <script>
        var error_text = "Nomor telepon minimal 10 karakter!";
    </script>
    @elseif ($error == "The password field must be at least 8 characters.")
    <script>
        var error_text = "Password minimal 8 karakter!";
    </script>
    @elseif ($error == "The password confirmation field must be at least 8 characters.")
    <script>
        var error_text = "Konfirmasi password minimal 8 karakter!";
    </script>
    @elseif ($error == "The password confirmation field must match password.")
    <script>
        var error_text = "Konfirmasi password tidak sama dengan password!";
    </script>
    @elseif ($error == "The email has already been taken.")
    <script>
        var error_text = "Email sudah terdaftar!";
    </script>
    @else
    <script>
        var error_text = "Data tidak lengkap! Silakan cek kembali form Anda!";
    </script>
    @endif

    <script>
        Swal.fire({
            title: 'Error!',
            text: error_text,
            icon: 'error',
            confirmButtonText: 'Close'
        })
    </script>

    @endforeach
    @endif

    @if(session('error'))
        <script>
            $(document).ready(function() {
                // ambil email dari input form dan masukkan ke sebuah variabel
                var email = $('#email').val();
                var password = $('#password').val();

                @if(session('error') == 'Email atau password salah!')
                    Swal.fire({
                        title: 'Error!',
                        text: '{{ session('error') }}',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                @else
                    Swal.fire({
                        title: 'Error!',
                        text: '{{ session('error') }}',
                        icon: 'error',
                        showCloseButton: true,
                        showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText: 'Kirim ulang link verifikasi',
                        cancelButtonText: 'Close',
                        preConfirm: () => {
                            // Set nilai email dan password ke input form tersembunyi
                            document.getElementById('email-input').value = email;
                            document.getElementById('password-input').value = password;
                            // Kirim form
                            document.getElementById('resend-verification-form').submit();
                        }
                    });
                @endif
            });
        </script>
    @endif


</body>

</html>