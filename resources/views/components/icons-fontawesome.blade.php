@include("partials/main")

    <head>

        @include("partials/title-meta", ["title" => "Font Awesome"])
        
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

                        @include("partials/page-title", ["pagetitle" =>"Lexa", "subtitle" =>"Icons" ,"title" => "Font Awesome"])

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Solid</h4>
                                        <p class="card-title-desc mb-2">Use <code>&lt;i class="fas fa-ad"&gt;&lt;/i&gt;</code> <span class="badge bg-success">v 5.13.0</span>.</p>
                                        <div class="row icon-demo-content" id="solid">
                                        </div>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Regular</h4>
                                        <p class="card-title-desc mb-2">Use <code>&lt;i class="far fa-address-book"&gt;&lt;/i&gt;</code> <span class="badge bg-success">v 5.13.0</span>.</p>
                                        <div class="row icon-demo-content" id="regular">
                                        </div>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Brands</h4>
                                        <p class="card-title-desc mb-2">Use <code>&lt;i class="fab fa-500px"&gt;&lt;/i&gt;</code> <span class="badge bg-success">v 5.13.0</span>.</p>
                                        <div class="row icon-demo-content" id="brand">
                                        </div>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                        </div> <!-- end row -->

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
        
        <!-- fontawesome icons init -->
        <script src="assets/js/pages/fontawesome.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>

</html>