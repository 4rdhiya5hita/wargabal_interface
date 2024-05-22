@include("partials/main")

    <head>

        @include("partials/title-meta", ["title" => "Utilities"])
        
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

                        @include("partials/page-title", ["pagetitle" =>"Lexa", "subtitle" =>"UI Elements", "title" =>"Colors"])


                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Text Colors</h4>
                                        <p class="card-title-desc">
                                            Colorize text with color utilities. If you want to colorize links, you can use 
                                            the .link-* helper classes which have <code>:hover</code> and <code>:focus</code> states.</p>
                                            <div>
                                                <p class="text-primary">text-primary</p>
                                                <p class="text-secondary">text-secondary</p>
                                                <p class="text-success">text-success</p>
                                                <p class="text-danger">text-danger</p>
                                                <p class="text-warning bg-dark">text-warning</p>
                                                <p class="text-info bg-dark">text-info</p>
                                                <p class="text-white bg-dark">text-light</p>
                                                <p class="text-reset">text-dark</p>
                                                <p class="text-body">text-body</p>
                                                <p class="text-muted">text-muted</p>
                                                <p class="text-white bg-dark">text-white</p>
                                                <p class="text-black-50">text-black-50</p>
                                                <p class="text-white-50 bg-dark">text-white-50</p>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Background Colors</h4>
                                        <p class="card-title-desc">Similar to the contextual text color classes, set the background of an element to any contextual class. Background utilities <strong>do not set <code>color</code></strong>,
                                            so in some cases you’ll want to use <code>.text-*</code> <a href="/docs/5.2/utilities/colors/">color utilities</a>.</p>

                                            <div>
                                                <div class="p-2 mb-2 bg-primary text-white">bg-primary</div>
                                                <div class="p-2 mb-2 bg-secondary text-white">bg-secondary</div>
                                                <div class="p-2 mb-2 bg-success text-white">bg-success</div>
                                                <div class="p-2 mb-2 bg-danger text-white">bg-danger</div>
                                                <div class="p-2 mb-2 bg-warning text-white">bg-warning</div>
                                                <div class="p-2 mb-2 bg-info text-white">bg-info</div>
                                                <div class="p-2 mb-2 bg-light text-reset">bg-light</div>
                                                <div class="p-2 mb-2 bg-dark text-white">bg-dark</div>
                                                <div class="p-2 mb-2 bg-body text-reset">bg-body</div>
                                                <div class="p-2 mb-2 bg-white text-reset">bg-white</div>
                                                <div class="p-2 mb-2 bg-transparent text-reset">bg-transparent</div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- end row -->

                         <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-3">Background RGBA Colors</h4>
                                            <div>
                                                <div class="p-2 mb-2 bg-primary-subtle text-primary">bg-primary</div>
                                                <div class="p-2 mb-2 bg-secondary-subtle text-secondary">bg-secondary</div>
                                                <div class="p-2 mb-2 bg-success-subtle text-success">bg-success</div>
                                                <div class="p-2 mb-2 bg-danger-subtle text-danger">bg-danger</div>
                                                <div class="p-2 mb-2 bg-warning-subtle text-warning">bg-warning</div>
                                                <div class="p-2 mb-2 bg-info-subtle text-info">bg-info</div>
                                                <div class="p-2 mb-2 bg-light-subtle text-reset">bg-light</div>
                                                <div class="p-2 mb-2 bg-dark-subtle text-reset">bg-dark</div>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-3">Background Gradient Colors</h4>
                                        <div>
                                            <div class="p-2 mb-2 bg-gradient bg-primary text-white">bg-primary</div>
                                            <div class="p-2 mb-2 bg-gradient bg-secondary text-white">bg-secondary</div>
                                            <div class="p-2 mb-2 bg-gradient bg-success text-white">bg-success</div>
                                            <div class="p-2 mb-2 bg-gradient bg-danger text-white">bg-danger</div>
                                            <div class="p-2 mb-2 bg-gradient bg-warning text-white">bg-warning</div>
                                            <div class="p-2 mb-2 bg-gradient bg-info text-white">bg-info</div>
                                            <div class="p-2 mb-2 bg-gradient bg-light text-reset">bg-light</div>
                                            <div class="p-2 mb-2 bg-gradient bg-dark text-white">bg-dark</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- end row -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Text Opacity Colors</h4>
                                        <p class="card-title-desc">To change that opacity, override <code>--bs-text-opacity</code> via custom styles or inline styles.</p>

                                        <div>
                                            <p class="text-primary">This is default primary text</p>
                                            <p class="text-primary text-opacity-75">This is 75% opacity primary text</p>
                                            <p class="text-primary text-opacity-50">This is 50% opacity primary text</p>
                                            <p class="text-primary text-opacity-25 mb-0">This is 25% opacity primary text</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Background Opacity Colors</h4>
                                        <p class="card-title-desc">Or, choose from any of the <code>.bg-opacity</code> utilities:</p>

                                        <div>
                                            <div class="bg-success p-2 text-white">This is default success background</div>
                                            <div class="bg-success p-2 text-white bg-opacity-75">This is 75% opacity success background</div>
                                            <div class="bg-success p-2 text-reset bg-opacity-50">This is 50% opacity success background</div>
                                            <div class="bg-success p-2 text-reset bg-opacity-25">This is 25% opacity success background</div>
                                            <div class="bg-success p-2 text-reset bg-opacity-10">This is 10% opacity success background</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

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