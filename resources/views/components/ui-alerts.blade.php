@include("partials/main")

    <head>

        @include("partials/title-meta", ["title" => "Alerts"])
        
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

                        @include("partials/page-title", ["pagetitle" =>"Lexa", "subtitle" =>"UI Elements", "title" =>"Alerts"])

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Examples</h4>
                                        <p class="card-title-desc">Alerts are available for any length of text, as well as an optional dismiss button. For proper styling, use one of the four <strong>required</strong> contextual classes (e.g., <code class="highlighter-rouge">.alert-success</code>). For inline dismissal, use the alerts jQuery plugin.</p>

                                        <div class="">
                                            <div class="alert alert-success" role="alert">
                                                <strong>Well done!</strong> You successfully read this important alert message.
                                            </div>
                                            <div class="alert alert-info" role="alert">
                                                <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                                            </div>
                                            <div class="alert alert-warning" role="alert">
                                                <strong>Warning!</strong> Better check yourself, you're not looking too good.
                                            </div>
                                            <div class="alert alert-danger mb-0" role="alert">
                                                <strong>Oh snap!</strong> Change a few things up and try submitting again.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Link color</h4>
                                        <p class="card-title-desc">Use the <code class="highlighter-rouge">.alert-link</code> utility class to quickly provide matching colored links within any alert.</p>

                                        <div class="">
                                            <div class="alert alert-success" role="alert">
                                                <strong>Well done!</strong> You successfully read <a href="#" class="alert-link">this important alert message</a>.
                                            </div>
                                            <div class="alert alert-info" role="alert">
                                                <strong>Heads up!</strong> This <a href="#" class="alert-link">alert needs
                                                    your attention</a>, but it's not super important.
                                            </div>
                                            <div class="alert alert-warning" role="alert">
                                                <strong>Warning!</strong> Better check yourself, you're <a href="#" class="alert-link">not looking too good</a>.
                                            </div>
                                            <div class="alert alert-danger mb-0" role="alert">
                                                <strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things
                                                    up</a> and try submitting again.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Dismissing</h4>
                                        <p class="card-title-desc">
                                            Add a dismiss button and the <code>.alert-dismissible</code> class, which adds extra padding
                                            to the right of the alert and positions the <code>.btn-close</code> button.
                                        </p>

                                        <div class="">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                </button>
                                                <strong>Well done!</strong> You successfully read this important alert message.
                                            </div>
                                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                </button>
                                                <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                                            </div>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                </button>
                                                <strong>Warning!</strong> Better check yourself, you're not looking too good.
                                            </div>
                                            <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                </button>
                                                <strong>Oh snap!</strong> Change a few things up and try submitting again.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Additional content</h4>
                                        <p class="card-title-desc">Alerts can also contain additional HTML elements like headings and paragraphs.</p>

                                        <div class="">
                                            <div class="alert alert-success mb-0" role="alert">
                                                <h4 class="alert-heading font-size-18">Well done!</h4>
                                                <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                                                <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Examples</h4>
                                        <p class="card-title-desc">Alerts are available for any length of text, as well as an optional dismiss button. For proper styling, use one of the four <strong>required</strong> contextual classes (e.g., <code class="highlighter-rouge">.alert-success .bg-**</code>). For inline dismissal, use the alerts jQuery plugin.</p>

                                        <div class="">
                                            <div class="alert alert-success bg-success text-white" role="alert">
                                                <strong>Well done!</strong> You successfully read this important alert message.
                                            </div>
                                            <div class="alert alert-info bg-info text-white" role="alert">
                                                <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                                            </div>
                                            <div class="alert alert-warning bg-warning text-white" role="alert">
                                                <strong>Warning!</strong> Better check yourself, you're not looking too good.
                                            </div>
                                            <div class="alert alert-danger bg-danger text-white mb-0" role="alert">
                                                <strong>Oh snap!</strong> Change a few things up and try submitting again.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Alert Examples</h4>

                                        <div class="">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="alert alert-success alert-dismissible fade show mt-4 px-4 mb-0 text-center" role="alert">
                                                        <i class="mdi mdi-check-circle-outline d-block display-4 mt-2 mb-3 text-success"></i>
                                                        <h5 class="text-success">Success</h5>
                                                        <p>A simple success alert</p>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                           
                                                        </button>
                                                    </div>
                                                </div>
    
                                                <div class="col-sm-6">
                                                    <div class="alert alert-danger alert-dismissible fade show mt-4 px-4 mb-0 text-center" role="alert">
                                                        <i class="mdi mdi-alert-octagon-outline d-block display-4 mt-2 mb-3 text-danger"></i>
                                                        <h5 class="text-danger">Error</h5>
                                                        <p>A simple danger alert</p>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                                           
                                                        </button>
                                                    </div>
                                                </div>
    
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Live Example</h4>
                                        <p class="card-title-desc">Click the button below to show an alert (hidden with inline styles to start), then dismiss (and destroy) it with the built-in close button.</p>
                                    
                                        <div class="">
                                            <div id="liveAlertPlaceholder"></div>
                                            <button type="button" class="btn btn-primary" id="liveAlertBtn">Show live alert</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

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

        <!-- Alerts Live Demo js -->
        <script src="assets/js/pages/alerts.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>

</html>