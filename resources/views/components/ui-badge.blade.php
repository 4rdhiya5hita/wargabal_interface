@include("partials/main")

    <head>

        @include("partials/title-meta", ["title" => "Badge"])
        
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

                        @include("partials/page-title", ["pagetitle" =>"Lexa", "subtitle" =>"UI Elements", "title" =>"Badge"])

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Example</h4>
                                        <p class="card-title-desc">Badges scale to match the size of the immediate parent element by using relative font sizing and <code class="highlighter-rouge">em</code> units.</p>

                                        <div class="">
                                            <h1>Example heading <span class="badge bg-light text-body">New</span></h1>
                                            <h2>Example heading <span class="badge bg-light text-body">New</span></h2>
                                            <h3>Example heading <span class="badge bg-light text-body">New</span></h3>
                                            <h4>Example heading <span class="badge bg-light text-body">New</span></h4>
                                            <h5>Example heading <span class="badge bg-light text-body">New</span></h5>
                                            <h6>Example heading <span class="badge bg-light text-body">New</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->

                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Variations</h4>
                                        <p class="card-title-desc">Add any of the below mentioned modifier classes to change the appearance of a badge.</p>

                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="badge bg-light text-body">Light</span>
                                            <span class="badge bg-primary">Primary</span>
                                            <span class="badge bg-success">Success</span>
                                            <span class="badge bg-info">Info</span>
                                            <span class="badge bg-warning">Warning</span>
                                            <span class="badge bg-danger">Danger</span>
                                            <span class="badge bg-dark">Dark</span>
                                        </div>

                                        <p class="card-title-desc mt-5">Use the <code class="highlighter-rouge">.badge-pill</code> modifier class to make badges more rounded (with a larger <code class="highlighter-rouge">border-radius</code> and additional horizontal <code class="highlighter-rouge">padding</code>). Useful if you miss the badges from v3.</p>

                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="badge rounded-pill bg-light text-body">Light</span>
                                            <span class="badge rounded-pill bg-primary">Primary</span>
                                            <span class="badge rounded-pill bg-success">Success</span>
                                            <span class="badge rounded-pill bg-info">Info</span>
                                            <span class="badge rounded-pill bg-warning">Warning</span>
                                            <span class="badge rounded-pill bg-danger">Danger</span>
                                            <span class="badge rounded-pill bg-dark">Dark</span>
                                        </div>
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

        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>

</html>