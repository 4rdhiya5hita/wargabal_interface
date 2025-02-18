@include("partials/main")

    <head>

        @include("partials/title-meta", ["title" => "500 Error"])
        
        @include("partials/head-css")

    </head>

    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="card-body pt-0">
                                <div class="ex-page-content text-center">
                                    <h1 class="text-dark">500</h1>
                                    <h3 class="">Terjadi masalah internal pada server!</h3>
                                    <br>

                                    <a class="btn btn-primary mb-4 waves-effect waves-light" href="index.html"><i class="mdi mdi-home"></i> Kembali ke Dashboard</a>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="mt-5 text-center">
                            © <script>document.write(new Date().getFullYear())</script> Lexa <span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>

        @include("partials/vendor-scripts")
        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>

</html>