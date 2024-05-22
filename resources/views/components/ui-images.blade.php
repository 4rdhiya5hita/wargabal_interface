@include("partials/main")

    <head>

        @include("partials/title-meta", ["title" => "Images"])
        
        @include("partials/head-css")

    </head>

    <body data-sidebar="dark">

        <!-- Begin page -->
        <div id="layout-wrapper">

            @include("partials/topbar")
            
            @include("partials/sidebar")

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        @include("partials/page-title", ["pagetitle" =>"Lexa", "subtitle" =>"UI Elements", "title" =>"Images"])

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Image thumbnails</h4>
                                        <p class="card-title-desc">In addition to our border-radius utilities, you can use
                                            <code class="highlighter-rouge">.img-thumbnail</code> to give an image a rounded 1px border appearance.</p>

                                        <div>
                                            <img class="img-thumbnail" alt="200x200" width="200" src="assets/images/small/img-3.jpg" data-holder-rendered="true">
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->

                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Image Rounded & Circle</h4>
                                        <p class="card-title-desc">Use classes
                                            <code>.rounded</code> and <code>.rounded-circle</code>.</p>

                                        <div>
                                            <img class="rounded me-4" alt="200x200" width="200" src="assets/images/small/img-4.jpg" data-holder-rendered="true">
                                            <img class="rounded-circle mt-4 mt-sm-0" alt="200x200" src="assets/images/users/user-4.jpg" data-holder-rendered="true">
                                        </div>
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Responsive images</h4>
                                        <p class="card-title-desc">Images in Bootstrap are made responsive with <code class="highlighter-rouge">.img-fluid</code>. <code class="highlighter-rouge">max-width: 100%;</code> and <code class="highlighter-rouge">height: auto;</code> are applied to the image so that it scales with the parent element.</p>

                                        <div>
                                            <img src="assets/images/small/img-2.jpg" class="img-fluid" alt="Responsive image">
                                        </div>
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Image Sizes</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <img src="assets/images/users/user-3.jpg" alt="" class="rounded avatar-sm">
                                                            <p class="mt-2 mb-lg-0"><code>.avatar-sm</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <img src="assets/images/users/user-4.jpg" alt="" class="rounded avatar-md">
                                                            <p class="mt-2  mb-lg-0"><code>.avatar-md</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <img src="assets/images/users/user-5.jpg" alt="" class="rounded avatar-lg">
                                                            <p class="mt-2 mb-lg-0"><code>.avatar-lg</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                </div><!-- end row -->
                                            </div><!-- end col -->
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <img src="assets/images/users/user-3.jpg" alt="" class="rounded-circle avatar-sm">
                                                            <p class="mt-2 mb-lg-0"><code>.avatar-sm</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <img src="assets/images/users/user-4.jpg" alt="" class="rounded-circle avatar-md">
                                                            <p class="mt-2  mb-lg-0"><code>.avatar-md</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                    <div class="col-lg-4">
                                                        <div>
                                                            <img src="assets/images/users/user-5.jpg" alt="" class="rounded-circle avatar-lg">
                                                            <p class="mt-2 mb-lg-0"><code>.avatar-lg</code></p>
                                                        </div>
                                                    </div><!-- end col -->
                                                </div><!-- end row -->
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                    </div>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                @include("partials/footer")
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        @include("partials/right-sidebar")
        
        @include("partials/vendor-scripts")

        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>

</html>