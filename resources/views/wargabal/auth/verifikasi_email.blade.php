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
                                <h4 class="text-muted font-size-18 mt-3 mb-1 text-center">Verifikasi Email Anda Sekarang !</h4>
                                <p class="text-muted text-center">Silahkan masukkan email Anda untuk memverifikasi ulang.</p>
                                <form action="{{ route('verifikasi_ulang_email') }}" method="post" class="form-horizontal mt-4">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" value="{{ old('email') }}" name="email" placeholder="Masukkan email">
                                        <div class="text-success" id="valid-email"></div>
                                        <div class="text-danger" id="invalid-email"></div>
                                    </div>
                                    <div class="mb-3 row mt-4">
                                        <div class="col-12 text-end">
                                            <button class="btn btn-primary w-md waves-effect waves-light" id="verifikasi_button" type="submit">Kirim link verifikasi</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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

            // login button
            $('#verifikasi_button').on('click', function() {
                var email = $('#email').val();
                var check = $error_appear.includes('email');

                if (email.length <= 0 || check == true) {
                    // ubah type button submit ke button agar tidak submit form
                    $('#verifikasi_button').attr('type', 'button');
                } else {
                    // ubah type button submit ke submit agar bisa submit form
                    $('#verifikasi_button').attr('type', 'submit');
                }
            });
        });
    </script>

</body>

</html>