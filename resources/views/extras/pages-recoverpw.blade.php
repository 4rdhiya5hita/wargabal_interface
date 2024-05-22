@include("partials/main")

    <head>

        @include("partials/title-meta", ["title" => "Recoverpw"])
        
        @include("partials/head-css")

    </head>

    <body>
        <div class="account-pages my-5 pt-sm-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card overflow-hidden">
                            <div class="card-body pt-0">
                                <h3 class="text-center mt-5 mb-4">
                                    <a href="index.html" class="d-block auth-logo">
                                        <img src="assets/images/logo-dark.png" alt="" height="30" class="auth-logo-dark">
                                        <img src="assets/images/logo-light.png" alt="" height="30" class="auth-logo-light">
                                    </a>
                                </h3>
                                <div class="p-3">
                                    <h4 class="text-muted font-size-18 mb-3 text-center">Reset Password</h4>
                                    <div class="alert alert-info" role="alert">
                                        Enter your Email and instructions will be sent to you!
                                    </div>
                                    <form class="form-horizontal mt-4" action="index.html">

                                        <div class="mb-3">
                                            <label for="useremail">Email</label>
                                            <input type="email" class="form-control" id="useremail" placeholder="Enter email">
                                        </div>

                                        <div class="mb-3 row">
                                            <div class="col-12 text-end">
                                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 text-center">
                            <p>Remember It ? <a href="pages-login.html" class="text-primary"> Sign In Here </a> </p>
                            © <script>document.write(new Date().getFullYear())</script> Lexa <span class="d-none d-sm-inline-block"> - Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include("partials/vendor-scripts")
        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>

</html>