@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Register"])

    @include("partials/head-css")

</head>

<body>
    <div class="account-pages my-4 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="card-body pt-0">
                            <div class="p-3">
                                <h4 class="text-muted font-size-18 mt-3 mb-1 text-center">Selamat Datang !</h4>
                                <p class="text-muted text-center">Dapatkan akunmu disini.</p>
                                <form action="{{ route('register') }}" method="post" class="form-horizontal mt-4 needs-validation" novalidate>
                                    @csrf

                                    <div class="mb-3">
                                        <label for="name">Nama</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama" required>
                                        <div class="text-success" id="valid-name"></div>
                                        <div class="text-danger" id="invalid-name"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>
                                        <div class="text-success" id="valid-email"></div>
                                        <div class="text-danger" id="invalid-email"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone">No. Telepon</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Masukkan nomor telepon" required>
                                        <div class="text-success" id="valid-phone"></div>
                                        <div class="text-danger" id="invalid-phone"></div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
                                        <div class="text-success" id="valid-password"></div>
                                        <div class="text-danger" id="invalid-password"></div>
                                    </div>


                                    <div class="mb-3">
                                        <label for="password_confirmation">Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Masukkan konfirmasi password" required>
                                        <div class="text-success" id="valid-password-confirmation"></div>
                                        <div class="text-danger" id="invalid-password-confirmation"></div>
                                    </div>

                                    <div class="mb-3 row mt-4">
                                        <div class="col-12 text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light" id="register_button" type="submit">Register</button>
                                        </div>
                                    </div>

                                    <!-- <div class="mb-0 row">
                                            <div class="col-12 mt-4">
                                                <p class="text-muted mb-0 font-size-14">By registering you agree to the Lexa <a href="#" class="text-primary">Terms of Use</a></p>
                                            </div>
                                        </div> -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 text-center">
                        <p>Sudah punya akun ? <a href="{{ route('login_page') }}" class="text-primary"> Login </a> </p>
                        <!-- © <script>document.write(new Date().getFullYear())</script> Lexa <span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include("partials/vendor-scripts")
    <!-- Validation -->
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function() {
            $error_appear = [];

            // name
            $('#name').on('input', function() {
                var name = $('#name').val();
                var name_length = name.length;
                if (name_length <= 0) {
                    $('#name').removeClass('is-valid');
                    $('#name').addClass('is-invalid');
                    $('#invalid-name').html('Nama harus diisi!');
                    $('#valid-name').html('');
                    $error_appear.push('name');
                } else {
                    $('#name').removeClass('is-invalid');
                    $('#name').addClass('is-valid');
                    $('#valid-name').html('Ok!');
                    $('#invalid-name').html('');
                    $error_appear = $error_appear.filter(function(item) {
                        return item !== 'name';
                    }); // hapus name dari array error
                }
            });

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
                    }); // hapus email dari array error
                }
            });

            // phone
            $('#phone').on('input', function() {
                var phone = $('#phone').val();
                var phone_length = phone.length;
                if (phone_length < 10 || phone_length > 13) {
                    $('#phone').removeClass('is-valid');
                    $('#phone').addClass('is-invalid');
                    $('#invalid-phone').html('Nomor telepon minimal 10-13 karakter!');
                    $('#valid-phone').html('');
                    $error_appear.push('phone');
                } else if (isNaN(phone)) {
                    $('#phone').removeClass('is-valid');
                    $('#phone').addClass('is-invalid');
                    $('#invalid-phone').html('Input harus berupa angka!');
                    $('#valid-phone').html('');
                    $error_appear.push('phone');
                } else {
                    $('#phone').removeClass('is-invalid');
                    $('#phone').addClass('is-valid');
                    $('#valid-phone').html('Ok!');
                    $('#invalid-phone').html('');
                    $error_appear = $error_appear.filter(function(item) {
                        return item !== 'phone';
                    }); // hapus phone dari array error
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
                    }); // hapus password dari array error
                }
            });

            // password_confirmation
            $('#password_confirmation').on('input', function() {
                var password = $('#password').val();
                var password_confirmation = $('#password_confirmation').val();
                if (password_confirmation != password) {
                    $('#password_confirmation').removeClass('is-valid');
                    $('#password_confirmation').addClass('is-invalid');
                    $('#invalid-password-confirmation').html('Konfirmasi password tidak sama dengan password!');
                    $('#valid-password-confirmation').html('');
                    $error_appear.push('password_confirmation');
                } else {
                    $('#password_confirmation').removeClass('is-invalid');
                    $('#password_confirmation').addClass('is-valid');
                    $('#valid-password-confirmation').html('Ok!');
                    $('#invalid-password-confirmation').html('');
                    $error_appear = $error_appear.filter(function(item) {
                        return item !== 'password_confirmation';
                    }); // hapus password_confirmation dari array error
                }
            });

            $('#register_button').on('click', function() {
                var name = $('#name').val();
                var email = $('#email').val();
                var phone = $('#phone').val();
                var password = $('#password').val();
                var password_confirmation = $('#password_confirmation').val();
                var check = $error_appear.includes('name') || $error_appear.includes('email') || $error_appear.includes('phone') || $error_appear.includes('password') || $error_appear.includes('password_confirmation');

                if (name.length <= 0 || email.length <= 0 || phone.length <= 0 || password.length <= 0 || password_confirmation.length <= 0 || check == true) {
                    // ubah type button submit ke button agar tidak submit form
                    $('#register_button').attr('type', 'button');
                } else {
                    // ubah type button submit ke submit agar bisa submit form
                    $('#register_button').attr('type', 'submit');
                }
            });
        });
    </script>


    <!-- return redirect()->back()->with('error', 'Data tidak valid!')->withErrors($validator)->withInput(); -->
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
    @elseif ($error == "The email field must be a valid email address.")
    <script>
        var error_text = "Email tidak valid!";
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


    <!-- return redirect()->back()->with('error', 'Email sudah terdaftar!')->withInput(); -->
    @if(session('error'))
    <script>
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'Close'
        });
    </script>
    @endif


</body>

</html>