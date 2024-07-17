@include("partials/main")

<head>

    @include("partials/title-meta", ["title" => "Konfirmasi Email"])

    @include("partials/head-css")

</head>

<body>
    <div class="account-pages my-4 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="account-pages my-4 pt-sm-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8 col-lg-6 col-xl-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="text-muted font-size-18 mt-3 mb-1 text-center">Terima Kasih Telah Mendaftar!</h4>
                                        <p class="text-muted text-center">Silakan periksa email Anda untuk konfirmasi pendaftaran.</p>
                                        <div class="text-center mt-4">
                                            <!-- silahkan login -->
                                            <a href="{{ route('login_page') }}" class="btn btn-primary">Login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        $(function() {
            // jika with success controller is called
            if ("{{ $toast }}" == true) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "bottom-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "{{ $message }}"
                });
            }
        });
    </script>

</body>

</html>