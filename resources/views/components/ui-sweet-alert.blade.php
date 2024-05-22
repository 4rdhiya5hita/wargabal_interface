@include("partials/main")

    <head>

        @include("partials/title-meta", ["title" => "Sweet-Alert"])

        <!-- Sweet Alert-->
        <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" /> 
        
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

                        @include("partials/page-title", ["pagetitle" =>"Lexa", "subtitle" =>"UI Elements", "title" =>"Sweet-Alert"])

                        <div class="row">
                            <div class="col-12">
                                <div class="card ">
                                    <div class="card-body">

                                        <h4 class="card-title">Examples</h4>
                                        <p class="card-title-desc">A beautiful, responsive, customizable and accessible (WAI-ARIA) replacement for JavaScript's popup boxes. Zero dependencies.
                                        </p>

                                        <div class="row text-center">
                                            <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                                                <p class="text-muted">A basic message</p>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="sa-basic">Click me</button>
                                            </div>
                                            <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                                                <p class="text-muted">A title with a text under</p>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="sa-title">Click me</button>
                                            </div>
                                            <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                                                <p class="text-muted">A success message!</p>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="sa-success">Click me</button>
                                            </div>
                                            <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                                                <p class="text-muted">A warning message, with a function attached to the "Confirm"-button...</p>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="sa-warning">Click me</button>
                                            </div>

                                            <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                                                <p class="text-muted">By passing a parameter, you can execute something else for "Cancel".</p>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="sa-params">Click me</button>
                                            </div>
                                            <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                                                <p class="text-muted">A message with custom Image Header</p>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="sa-image">Click me</button>
                                            </div>
                                            <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                                                <p class="text-muted">A message with auto close timer</p>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="sa-close">Click me</button>
                                            </div>
                                            <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                                                <p class="text-muted">Custom HTML description and buttons</p>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="custom-html-alert">Click me</button>
                                            </div>
                                            <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                                                <p class="text-muted">A message with custom width, padding and background</p>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="custom-padding-width-alert">Click me</button>
                                            </div>
                                            <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                                                <p class="text-muted">Ajax request example</p>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="ajax-alert">Click me</button>
                                            </div>
                                            <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                                                <p class="text-muted">Chaining modals (queue) example</p>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="chaining-alert">Click me</button>
                                            </div>
                                            <div class="col-xl-3 col-md-4 col-sm-6 mb-4">
                                                <p class="text-muted">Dynamic queue example</p>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" id="dynamic-alert">Click me</button>
                                            </div>

                                        </div>
                                        <!-- end row -->

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

        <!-- Sweet Alerts js -->
        <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <!-- Sweet alert init js-->
        <script src="assets/js/pages/sweet-alerts.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>

</html>