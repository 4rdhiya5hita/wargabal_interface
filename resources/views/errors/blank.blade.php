@include("partials/main")

    <head>
        
        @include("partials/title-meta", ["title" => "Blank page"])

        @include("partials/head-css")

    </head>

    @include("partials/body")

        <!-- Begin page -->
        <div id="layout-wrapper">

            @include("partials/menu")

            <!-- ============================================================== -->
            <!-- Start right Content herFe -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        @include("partials/page-title", ["pagetitle" =>"Lexa", "subtitle" =>"Pages", "title" =>"Blank page"])
                        
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

        <script src="assets/js/app.js"></script>

    </body>
</html>
