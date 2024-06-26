@include("partials/main")

    <head>

        @include("partials/title-meta", ["title" => "Form File Upload"])

        <!-- Plugins css -->
        <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
        
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

                        @include("partials/page-title", ["pagetitle" =>"Lexa", "subtitle" =>"Forms", "title" =>"Form File Upload"])

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Dropzone</h4>
                                        <p class="card-title-desc">DropzoneJS is an open source library that provides drag’n’drop file uploads with image previews.
                                        </p>

                                        <div>
                                            <form action="#" class="dropzone">
                                                <div class="fallback">
                                                    <input name="file" type="file" multiple="multiple">
                                                </div>
                                                <div class="dz-message needsclick">

                                                    <div class="mb-3">
                                                        <i class="mdi mdi-cloud-upload-outline text-muted display-4"></i>
                                                    </div>

                                                    <h4>Drop files here or click to upload.</h4>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="button" class="btn btn-primary waves-effect waves-light">Send Files
                                            </button>
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

        <!-- Plugins js -->
        <script src="assets/libs/dropzone/min/dropzone.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>

</html>