@include("partials/main")

    <head>

        @include("partials/title-meta", ["title" => "Lightbox"])

        <!-- Lightbox css -->
        <link href="assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" /> 
        
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

                        @include("partials/page-title", ["pagetitle" =>"Lexa", "subtitle" =>"UI Elements", "title" =>"Lightbox"])

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Single image lightbox</h4>
                                        <p class="card-title-desc">Three simple popups with different scaling settings.</p>

                                        <div class="row">
                                            <div class="col-6">
                                                <h5 class="font-size-14 mb-3 text-muted">Fits (Horz/Vert)</h5>
                                                <a class="image-popup-vertical-fit" href="assets/images/small/img-2.jpg" title="Caption. Can be aligned it to any side and contain any HTML.">
                                                    <img class="img-fluid" alt="" src="assets/images/small/img-2.jpg" width="145">
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="font-size-14 mb-3 text-muted">Effects</h5>
                                                <a class="image-popup-no-margins" href="assets/images/small/img-3.jpg">
                                                    <img class="img-fluid" alt="" src="assets/images/small/img-3.jpg" width="75">
                                                </a>
                                                <p class="mt-2 mb-0 text-muted">No gaps, zoom animation, close icon in top-right corner.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Lightbox gallery</h4>
                                        <p class="card-title-desc">In this example lazy-loading of images is enabled for the next image based on move direction. </p>

                                        <div class="popup-gallery">
                                            <a class="float-start" href="assets/images/small/img-1.jpg" title="Project 1">
                                                <div class="img-responsive">
                                                    <img src="assets/images/small/img-1.jpg" alt="" width="120">
                                                </div>
                                            </a>
                                            <a class="float-start" href="assets/images/small/img-2.jpg" title="Project 2">
                                                <div class="img-responsive">
                                                    <img src="assets/images/small/img-2.jpg" alt="" width="120">
                                                </div>
                                            </a>
                                            <a class="float-start" href="assets/images/small/img-3.jpg" title="Project 3">
                                                <div class="img-responsive">
                                                    <img src="assets/images/small/img-3.jpg" alt="" width="120">
                                                </div>
                                            </a>
                                            <a class="float-start" href="assets/images/small/img-4.jpg" title="Project 4">
                                                <div class="img-responsive">
                                                    <img src="assets/images/small/img-4.jpg" alt="" width="120">
                                                </div>
                                            </a>
                                            <a class="float-start" href="assets/images/small/img-5.jpg" title="Project 5">
                                                <div class="img-responsive">
                                                    <img src="assets/images/small/img-5.jpg" alt="" width="120">
                                                </div>
                                            </a>
                                            <a class="float-start" href="assets/images/small/img-6.jpg" title="Project 6">
                                                <div class="img-responsive">
                                                    <img src="assets/images/small/img-6.jpg" alt="" width="120">
                                                </div>
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Zoom Gallery</h4>
                                        <p class="card-title-desc">Zoom effect works only with images.</p>

                                        <div class="zoom-gallery">
                                            <a class="float-start" href="assets/images/small/img-3.jpg" title="Project 1"><img src="assets/images/small/img-3.jpg" alt="" width="275"></a>
                                            <a class="float-start" href="assets/images/small/img-7.jpg" title="Project 2"><img src="assets/images/small/img-7.jpg" alt="" width="275"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Popup with video or map</h4>
                                        <p class="card-title-desc">In this example lazy-loading of images is enabled for the next image based on move direction. </p>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex flex-wrap gap-2">
                                                    <a class="popup-youtube btn btn-secondary" href="http://www.youtube.com/watch?v=0O2aH4XLbto">Open YouTube Video</a>
                                                    <a class="popup-vimeo btn btn-secondary" href="https://vimeo.com/45830194">Open Vimeo Video</a>
                                                    <a class="popup-gmaps btn btn-secondary" href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&amp;hl=en&amp;t=v&amp;hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom">Open Google Map</a>
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                    </div><!-- end cardbody -->
                                </div><!-- end card -->
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

        <!-- Magnific Popup-->
        <script src="assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

        <!-- lightbox init js-->
        <script src="assets/js/pages/lightbox.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>

</html>