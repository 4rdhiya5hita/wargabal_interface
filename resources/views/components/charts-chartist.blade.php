@include("partials/main")

    <head>

        @include("partials/title-meta", ["title" => "Chartist Chart"])

        <link href="assets/libs/chartist/chartist.min.css" rel="stylesheet"> 
        
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

                        @include("partials/page-title", ["pagetitle" =>"Lexa", "subtitle" =>"Charts" ,"title" => "Chartist Chart"])

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title mb-4">Overlapping bars on mobile</h4>

                                        <div class="row text-center mt-4">
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">86541</h5>
                                                <p class="text-muted text-truncate">Activated</p>
                                            </div>
                                            <!-- end col -->
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">2541</h5>
                                                <p class="text-muted text-truncate">Pending</p>
                                            </div>
                                            <!-- end col -->
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">102030</h5>
                                                <p class="text-muted text-truncate">Deactivated</p>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                        <div id="overlapping-bars" class="ct-chart ct-golden-section" dir="ltr"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title mb-4">Stacked bar chart</h4>

                                        <div class="row text-center mt-4">
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">5241</h5>
                                                <p class="text-muted text-truncate">Activated</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">65411</h5>
                                                <p class="text-muted text-truncate">Pending</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">51654</h5>
                                                <p class="text-muted text-truncate">Deactivated</p>
                                            </div>
                                        </div>

                                        <div id="stacked-bar-chart" class="ct-chart ct-golden-section" dir="ltr"></div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title mb-4">Animating a Donut with Svg.animate</h4>

                                        <div class="row text-center mt-4">
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">748949</h5>
                                                <p class="text-muted text-truncate">Activated</p>
                                            </div>
                                            <!-- end col -->
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">5181</h5>
                                                <p class="text-muted text-truncate">Pending</p>
                                            </div>
                                            <!-- end col -->
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">101025</h5>
                                                <p class="text-muted text-truncate">Deactivated</p>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                        <div id="animating-donut" class="ct-chart ct-golden-section" dir="ltr"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title mb-4">Simple pie chart</h4>

                                        <div class="row text-center mt-4">
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">48484</h5>
                                                <p class="text-muted text-truncate">Activated</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">48652</h5>
                                                <p class="text-muted text-truncate">Pending</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">85412</h5>
                                                <p class="text-muted text-truncate">Deactivated</p>
                                            </div>
                                        </div>

                                        <div id="simple-pie" class="ct-chart ct-golden-section simple-pie-chart-chartist" dir="ltr"></div>

                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title mb-4">Advanced Smil Animations</h4>

                                        <div class="row text-center mt-4">
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">45410</h5>
                                                <p class="text-muted text-truncate">Activated</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">4442</h5>
                                                <p class="text-muted text-truncate">Pending</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">3201</h5>
                                                <p class="text-muted text-truncate">Deactivated</p>
                                            </div>
                                        </div>

                                        <div id="smil-animations" class="ct-chart ct-golden-section" dir="ltr"></div>

                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title mb-4">Simple line chart</h4>

                                        <div class="row text-center mt-4">
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">44242</h5>
                                                <p class="text-muted text-truncate">Activated</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">75221</h5>
                                                <p class="text-muted text-truncate">Pending</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">65212</h5>
                                                <p class="text-muted text-truncate">Deactivated</p>
                                            </div>
                                        </div>

                                        <div id="simple-line-chart" class="ct-chart ct-golden-section" dir="ltr"></div>

                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title mb-4">Line Scatter Diagram</h4>

                                        <div class="row text-center mt-4">
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">5677</h5>
                                                <p class="text-muted text-truncate">Activated</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">5542</h5>
                                                <p class="text-muted text-truncate">Pending</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">12422</h5>
                                                <p class="text-muted text-truncate">Deactivated</p>
                                            </div>
                                        </div>

                                        <div id="scatter-diagram" class="ct-chart ct-golden-section" dir="ltr"></div>

                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title mb-4">Line chart with area</h4>

                                        <div class="row text-center mt-4">
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">4234</h5>
                                                <p class="text-muted text-truncate">Activated</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">64521</h5>
                                                <p class="text-muted text-truncate">Pending</p>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="mb-0 font-size-20 text-truncate">94521</h5>
                                                <p class="text-muted text-truncate">Deactivated</p>
                                            </div>
                                        </div>

                                        <div id="chart-with-area" class="ct-chart ct-golden-section" dir="ltr"></div>

                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
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

        <!-- Plugin Js-->
        <script src="assets/libs/chartist/chartist.min.js"></script>
        <script src="assets/libs/chartist-plugin-tooltips/chartist-plugin-tooltip.min.js"></script>
        <!-- demo js-->
        <script src="assets/js/pages/chartist.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>

</html>