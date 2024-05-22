@include("partials/main")

    <head>

        @include("partials/title-meta", ["title" => "Form Elements"])
        
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

                        @include("partials/page-title", ["pagetitle" =>"Lexa", "subtitle" =>"Forms", "title" =>"Form Elements"])

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="card-title">Textual inputs</h4>
                                        <p class="card-title-desc">Here are examples of <code class="highlighter-rouge">.form-control</code> applied to each textual HTML5 <code class="highlighter-rouge">&lt;input&gt;</code> <code class="highlighter-rouge">type</code>.</p>

                                        <div class="mb-3 row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Text</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                                            </div>
                                        </div><!-- end row -->
                                        <div class="mb-3 row">
                                            <label for="example-search-input" class="col-md-2 col-form-label">Search</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="search" value="How do I shoot web" id="example-search-input">
                                            </div>
                                        </div><!-- end row -->
                                        <div class="mb-3 row">
                                            <label for="example-email-input" class="col-md-2 col-form-label">Email</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input">
                                            </div>
                                        </div><!-- end row -->
                                        <div class="mb-3 row">
                                            <label for="example-url-input" class="col-md-2 col-form-label">URL</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="url" value="https://getbootstrap.com" id="example-url-input">
                                            </div>
                                        </div><!-- end row -->
                                        <div class="mb-3 row">
                                            <label for="example-tel-input" class="col-md-2 col-form-label">Telephone</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="tel" value="1-(555)-555-5555" id="example-tel-input">
                                            </div>
                                        </div><!-- end row -->
                                        <div class="mb-3 row">
                                            <label for="example-password-input" class="col-md-2 col-form-label">Password</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="password" value="hunter2" id="example-password-input">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label for="example-number-input" class="col-md-2 col-form-label">Number</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="number" value="42" id="example-number-input">
                                            </div>
                                        </div><!-- end row -->
                                        <div class="mb-3 row">
                                            <label for="example-datetime-local-input" class="col-md-2 col-form-label">Date and time</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="datetime-local" value="2011-08-19T13:45:00" id="example-datetime-local-input">
                                            </div>
                                        </div><!-- end row -->
                                        <div class="mb-3 row">
                                            <label for="example-date-input" class="col-md-2 col-form-label">Date</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
                                            </div>
                                        </div><!-- end row -->
                                        <div class="mb-3 row">
                                            <label for="example-month-input" class="col-md-2 col-form-label">Month</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="month" value="2011-08" id="example-month-input">
                                            </div>
                                        </div><!-- end row -->
                                        <div class="mb-3 row">
                                            <label for="example-week-input" class="col-md-2 col-form-label">Week</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="week" value="2011-W33" id="example-week-input">
                                            </div>
                                        </div><!-- end row -->
                                        <div class="mb-3 row">
                                            <label for="example-time-input" class="col-md-2 col-form-label">Time</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="time" value="13:45:00" id="example-time-input">
                                            </div>
                                        </div><!-- end row -->
                                        <div class="mb-3 row">
                                            <label for="example-color-input" class="col-md-2 col-form-label">Color</label>
                                            <div class="col-md-10">
                                                <input class="form-control form-control-color w-100" type="color" value="#7a6fbe"
                                                    id="example-color-input">
                                            </div>
                                        </div><!-- end row -->
                                        <div class="mb-3 row">
                                            <label class="col-md-2 col-form-label">Select</label>
                                            <div class="col-md-10">
                                                <select class="form-control">
                                                    <option>Select</option>
                                                    <option>Large select</option>
                                                    <option>Small select</option>
                                                </select>
                                            </div>
                                        </div><!-- end row -->
                                        <div class="mb-3 row">
                                            <label for="example-text-input-lg" class="col-md-2 col-form-label">Large</label>
                                            <div class="col-md-10">
                                                <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" id="example-text-input-lg">
                                            </div>
                                        </div> <!-- end row -->
                                        <div class="mb-3 row mb-0">
                                            <label for="example-text-input-sm" class="col-md-2 col-form-label">Small</label>
                                            <div class="col-md-10">
                                                <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm" id="example-text-input-sm">
                                            </div>
                                        </div> <!-- end row -->
                                    </div>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Form layouts</h4>
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="mt-4">
                                                    <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Form groups</h5>
                                                    <form>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="formrow-firstname-input">First name</label>
                                                            <input type="text" class="form-control" id="formrow-firstname-input" placeholder="Enter your first name">
                                                        </div>
            
                                                        <div class="row">                                                            
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="formrow-email-input">Email</label>
                                                                    <input type="email" class="form-control" id="formrow-email-input" placeholder="Enter your email">
                                                                </div>
                                                            </div> <!-- end col -->
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="formrow-password-input">Password</label>
                                                                    <input type="password" class="form-control" id="formrow-password-input" placeholder="Enter your password">
                                                                </div>
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
            
                                                        <div class="form-group">
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="formrow-customCheck">
                                                                <label class="form-check-label" for="formrow-customCheck">Check me out</label>
                                                            </div>
                                                        </div>
                                                        <div class="mt-4">
                                                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-lg-6 ms-lg-auto">
                                                <div class="mt-5 mt-lg-4">
                                                    <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Horizontal form</h5>
                                                    
                                                    <form>
                                                        <div class="row mb-4">
                                                            <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">First name</label>
                                                            <div class="col-sm-9">
                                                              <input type="text" class="form-control" id="horizontal-firstname-input" placeholder="Enter your first name">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label for="horizontal-email-input" class="col-sm-3 col-form-label">Email</label>
                                                            <div class="col-sm-9">
                                                                <input type="email" class="form-control" id="horizontal-email-input" placeholder="Enter your email">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label for="horizontal-password-input" class="col-sm-3 col-form-label">Password</label>
                                                            <div class="col-sm-9">
                                                              <input type="password" class="form-control" id="horizontal-password-input" placeholder="Enter your password">
                                                            </div>
                                                        </div>
            
                                                        <div class="row justify-content-end">
                                                            <div class="col-sm-9">
                                                                <div class="form-check mb-4">
                                                                    <input type="checkbox" class="form-check-input" id="horizontal-customCheck">
                                                                    <label class="form-check-label" for="horizontal-customCheck">Remember me</label>
                                                                </div>
            
                                                                <div>
                                                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->

                                        <div class="mt-4">
                                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i> Inline forms layout</h5>

                                            <form class="row gx-3 gy-2 align-items-center">
                                                <div class="col-sm-2">
                                                  <label class="visually-hidden" for="specificSizeInputName">Name</label>
                                                  <input type="text" class="form-control" id="specificSizeInputName" placeholder="Enter Name">
                                                </div> <!-- end col -->
                                                <div class="col-sm-2">
                                                  <label class="visually-hidden" for="specificSizeInputGroupUsername">Username</label>
                                                  <div class="input-group">
                                                    <div class="input-group-text">@</div>
                                                    <input type="text" class="form-control" id="specificSizeInputGroupUsername" placeholder="Username">
                                                  </div>
                                                </div> <!-- end col -->
                                                <div class="col-auto">
                                                  <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="autoSizingCheck2">
                                                    <label class="form-check-label" for="autoSizingCheck2">
                                                      Remember me
                                                    </label>
                                                  </div>
                                                </div> <!-- end col -->
                                                <div class="col-auto">
                                                  <button type="submit" class="btn btn-primary">Submit</button>
                                                </div> <!-- end col -->
                                            </form><!-- end form -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Form Layout -->

                         <!-- Start Form Sizing -->
                         <div class="row">
                            <div class="col-lg-12">
                                <div class="card mb-5">
                                    <div class="card-body">
                                        <h4 class="card-title">Sizing</h4>
                                        <p class="card-title-desc">Set heights using classes like <code>.form-control-lg</code> and <code>.form-control-sm</code>.</p>

                                        <form>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="default-input">Default input</label>
                                                        <input class="form-control" type="text" id="default-input" placeholder="Default input">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3 mt-3">
                                                        <label class="form-label" for="form-sm-input">Form Small input</label>
                                                        <input class="form-control form-control-sm" type="text" id="form-sm-input" placeholder=".form-control-sm">
                                                    </div>
                                                </div> <!-- end col -->
                                                
                                                <div class="col-lg-6">
                                                    <div class="mt-3 mb-0">
                                                        <label class="form-label" for="form-lg-input">Form Large input</label>
                                                        <input class="form-control form-control-lg" type="text" id="form-lg-input" placeholder=".form-control-lg">
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                        </form> <!-- end form -->
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <!-- End Form Sizing -->

                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Checkboxes</h4>

                                        <div class="row">
                                            <div class="col-md-5">
                                                <div>
                                                    <h5 class="font-size-14 mb-4">
                                                        <i class="mdi mdi-arrow-right text-primary me-1"></i> Form Checkboxes
                                                    </h5>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="checkbox" id="formCheck1">
                                                        <label class="form-check-label" for="formCheck1">
                                                            Form Checkbox
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="formCheck2" checked>
                                                        <label class="form-check-label" for="formCheck2">
                                                            Form Checkbox checked
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                             <!-- end col -->
                                            <div class="col-md-6 ms-auto">
                                                <div class="mt-4 mt-md-0">
                                                    <h5 class="font-size-14 mb-4"><i
                                                            class="mdi mdi-arrow-right text-primary me-1"></i> Form Checkboxes
                                                        Right</h5>
                                                    <div>
                                                        <div class="form-check form-check-right mb-3">
                                                            <input class="form-check-input" type="checkbox" id="formCheckRight1">
                                                            <label class="form-check-label" for="formCheckRight1">
                                                                Form Checkbox Right
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="form-check form-check-right">
                                                            <input class="form-check-input" type="checkbox" id="formCheckRight2"
                                                                checked>
                                                            <label class="form-check-label" for="formCheckRight2">
                                                                Form Checkbox Right checked
                                                            </label>
                                                        </div>
                                                    </div>         
                                                </div>
                                            </div> <!-- end col -->
                                        </div><!-- end row -->
                                    </div>
                                </div>
                            </div><!-- end col -->
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Radios</h4>

                                        <div class="row">
                                            <div class="col-md-5">
                                                <div>
                                                    <h5 class="font-size-14 mb-4"> <i class="mdi mdi-arrow-right text-primary me-1"></i>Form Radios</h5>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="radio" name="formRadios"
                                                            id="formRadios1" checked>
                                                        <label class="form-check-label" for="formRadios1">
                                                            Form Radio
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="formRadios"
                                                            id="formRadios2">
                                                        <label class="form-check-label" for="formRadios2">
                                                            Form Radio checked
                                                        </label>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-md-6 ms-auto">
                                                <div class="mt-4 mt-lg-0">
                                                    <h5 class="font-size-14 mb-4"> <i class="mdi mdi-arrow-right text-primary me-1"></i>Form Radios Right</h5>
                                                    <div>
                                                        <div class="form-check form-check-right mb-3">
                                                            <input class="form-check-input" type="radio" name="formRadiosRight"
                                                                id="formRadiosRight1" checked>
                                                            <label class="form-check-label" for="formRadiosRight1">
                                                                Form Radio Right
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <div class="form-check form-check-right">
                                                            <input class="form-check-input" type="radio" name="formRadiosRight"
                                                                id="formRadiosRight2">
                                                            <label class="form-check-label" for="formRadiosRight2">
                                                                Form Radio Right checked
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- end col -->
                                        </div> <!-- end row -->
                                    </div>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Switches</h4>
                                        <p class="card-title-desc">A switch has the markup of a custom checkbox but uses the <code>.custom-switch</code> class to render a toggle switch. Switches also support the <code>disabled</code> attribute.</p>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div>
                                                    <h5 class="font-size-14 mb-3"> <i class="mdi mdi-arrow-right text-primary me-1"></i>Switch examples</h5>


                                                    <div class="form-check form-switch mb-3" dir="ltr">
                                                        <input type="checkbox" class="form-check-input" id="customSwitch1" checked>
                                                        <label class="form-check-label" for="customSwitch1">Toggle this switch element</label>
                                                    </div>
                                                    <div class="form-check form-switch" dir="ltr">
                                                        <input type="checkbox" class="form-check-input" disabled id="customSwitch2">
                                                        <label class="form-check-label" for="customSwitch2">Disabled switch element</label>
                                                    </div>
                                                </div>
                                            </div><!-- end col -->
                                            <div class="col-md-6">
                                                <div class="mt-4 mt-md-0">
                                                    <h5 class="font-size-14 mb-3"> <i class="mdi mdi-arrow-right text-primary me-1"></i>Switch sizes</h5>
        
                                                    <div class="form-check form-switch mb-3" dir="ltr">
                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizesm" checked>
                                                        <label class="form-check-label" for="customSwitchsizesm">Small Size Switch</label>
                                                    </div>
        
                                                    <div class="form-check form-switch form-switch-md mb-3" dir="ltr">
                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizemd">
                                                        <label class="form-check-label" for="customSwitchsizemd">Medium Size Switch</label>
                                                    </div>
        
                                                    <div class="form-check form-switch form-switch-lg mb-3" dir="ltr">
                                                        <input type="checkbox" class="form-check-input" id="customSwitchsizelg" checked>
                                                        <label class="form-check-label" for="customSwitchsizelg">Large Size Switch</label>
                                                    </div>
                                                </div>
                                            </div><!-- end col -->
                                        </div><!-- end row -->
                                    </div> <!-- end cardbody -->
                                </div> <!-- end card -->
                            </div> <!-- end col -->
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

        <!-- App js -->
        <script src="assets/js/app.js"></script>
    </body>

</html>