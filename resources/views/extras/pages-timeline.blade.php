@include("partials/main")

    <head>

        @include("partials/title-meta", ["title" => "Timeline"])
        
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

                        @include("partials/page-title", ["pagetitle" =>"Lexa", "subtitle" =>"Pages" ,"title" => "Timeline"])

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <section id="cd-timeline" class="cd-container">
                                            <div class="cd-timeline-block timeline-right">
                                                <div class="cd-timeline-img bg-success">
                                                    <i class="mdi mdi-adjust"></i>
                                                </div>
                                                <!-- cd-timeline-img -->

                                                <div class="cd-timeline-content">
                                                    <h3>Timeline Event One</h3>
                                                    <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
                                                    <span class="cd-date">May 23</span>
                                                </div>
                                                <!-- cd-timeline-content -->
                                            </div>
                                            <!-- cd-timeline-block -->

                                            <div class="cd-timeline-block timeline-left">
                                                <div class="cd-timeline-img bg-danger">
                                                    <i class="mdi mdi-adjust"></i>
                                                </div>
                                                <!-- cd-timeline-img -->

                                                <div class="cd-timeline-content">
                                                    <h3>Timeline Event Two</h3>
                                                    <p class="mb-4 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium</p>
                                                    <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light mt-1">See more detail</button>
                                                    <span class="cd-date me-2">May 30</span>
                                                </div>
                                                <!-- cd-timeline-content -->
                                            </div>
                                            <!-- cd-timeline-block -->

                                            <div class="cd-timeline-block timeline-right">
                                                <div class="cd-timeline-img bg-info">
                                                    <i class="mdi mdi-adjust"></i>
                                                </div>
                                                <!-- cd-timeline-img -->

                                                <div class="cd-timeline-content">
                                                    <h3>Timeline Event Three</h3>
                                                    <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, obcaecati, quisquam id molestias eaque error assumenda delectus. Odit, itaque, deserunt corporis vero ipsum nisi eius odio natus ullam provident pariatur temporibus quia eos repellat ... <a href="#" class="text-primary">Read more</a></p>
                                                    <span class="cd-date">Jun 05</span>
                                                </div>
                                                <!-- cd-timeline-content -->
                                            </div>
                                            <!-- cd-timeline-block -->

                                            <div class="cd-timeline-block timeline-left">
                                                <div class="cd-timeline-img bg-pink">
                                                    <i class="mdi mdi-adjust"></i>
                                                </div>
                                                <!-- cd-timeline-img -->

                                                <div class="cd-timeline-content">
                                                    <h3>Timeline Event Four</h3>
                                                    <p class="mb-4 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut.</p>
                                                    <div class="d-flex flex-wrap gap-3">
                                                        <img src="assets/images/small/img-1.jpg" alt="" class="rounded" width="120">
                                                        <img src="assets/images/small/img-2.jpg" alt="" class="rounded" width="120">
                                                    </div>
                                                    <span class="cd-date">Jun 14</span>
                                                </div>
                                                <!-- cd-timeline-content -->
                                            </div>
                                            <!-- cd-timeline-block -->

                                            <div class="cd-timeline-block timeline-right">
                                                <div class="cd-timeline-img bg-warning">
                                                    <i class="mdi mdi-adjust"></i>
                                                </div>
                                                <!-- cd-timeline-img -->

                                                <div class="cd-timeline-content">
                                                    <h3>Timeline Event Five</h3>
                                                    <p class="mb-4 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum.</p>
                                                    <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light">See more detail</button>
                                                    <span class="cd-date me-2">Jun 18</span>
                                                </div>
                                                <!-- cd-timeline-content -->
                                            </div>
                                            <!-- cd-timeline-block -->

                                            <div class="cd-timeline-block">

                                                <div class="cd-timeline-img bg-primary d-xl-none">
                                                    <i class="mdi mdi-adjust"></i>
                                                </div>
                                                <!-- cd-timeline-img -->
                                                <div class="cd-timeline-content">
                                                    <h3>Timeline Event End</h3>
                                                    <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, obcaecati, quisquam id molestias eaque asperiores voluptatibus cupiditate error assumenda delectus odit similique earum voluptatem doloremque dolorem ipsam quae rerum quis. Deserunt corporis vero ipsum nisi eius odio natus ullam provident pariatur temporibus quia eos repellat consequuntur.</p>
                                                    <span class="cd-date">Jun 30</span>
                                                </div>
                                                <!-- cd-timeline-content -->
                                            </div>
                                            <!-- cd-timeline-block -->
                                        </section>
                                        <!-- cd-timeline -->

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