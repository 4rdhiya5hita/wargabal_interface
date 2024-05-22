<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="badge rounded-pill bg-primary float-end">2</span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('calendar') }}" class=" waves-effect">
                        <i class="mdi mdi-calendar-check"></i>
                        <span>Calendar</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-email-outline"></i>
                        <span>Email</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('email-inbox') }}">Inbox</a></li>
                        <li><a href="{{ route('email-read') }}">Email Read</a></li>
                        <li><a href="{{ route('email-compose') }}">Email Compose</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('chat') }}" class=" waves-effect">
                        <i class="mdi mdi-chat-processing-outline"></i>
                        <span class="badge rounded-pill bg-danger float-end">Hot</span>
                        <span>Chat</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('kanbanboard') }}" class=" waves-effect">
                        <i class="mdi mdi-billboard"></i>
                        <span class="badge rounded-pill bg-success float-end">New</span>
                        <span>Kanban Board</span>
                    </a>
                </li>

                <li class="menu-title">Components</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-buffer"></i>
                        <span>UI Elements</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('ui-alerts') }}">Alerts</a></li>
                            <li><a href="{{ route('ui-buttons') }}">Buttons</a></li>
                            <li><a href="{{ route('ui-badge') }}">Badge</a></li>
                            <li><a href="{{ route('ui-cards') }}">Cards</a></li>
                            <li><a href="{{ route('ui-carousel') }}">Carousel</a></li>
                            <li><a href="{{ route('ui-dropdowns') }}">Dropdowns</a></li>
                            <li><a href="{{ route('ui-utilities') }}">Utilities<span class="badge rounded-pill bg-success float-end">New</span></a></li>
                            <li><a href="{{ route('ui-grid') }}">Grid</a></li>
                            <li><a href="{{ route('ui-images') }}">Images</a></li>
                            <li><a href="{{ route('ui-lightbox') }}">Lightbox</a></li>
                            <li><a href="{{ route('ui-modals') }}">Modals</a></li>
                            <li><a href="{{ route('ui-colors') }}">Colors<span class="badge rounded-pill bg-warning float-end">New</span></a></li>
                            <li><a href="{{ route('ui-offcanvas') }}">Offcanvas</a></li>
                            <li><a href="{{ route('ui-pagination') }}">Pagination</a></li>
                            <li><a href="{{ route('ui-popover-tooltips') }}">Popover &amp; Tooltips</a></li>
                            <li><a href="{{ route('ui-rangeslider') }}">Range Slider</a></li>
                            <li><a href="{{ route('ui-session-timeout') }}">Session Timeout</a></li>
                            <li><a href="{{ route('ui-progressbars') }}">Progress Bars</a></li>
                            <li><a href="{{ route('ui-sweet-alert') }}">Sweet-Alert</a></li>
                            <li><a href="{{ route('ui-tabs-accordions') }}">Tabs &amp; Accordions</a></li>
                            <li><a href="{{ route('ui-typography') }}">Typography</a></li>
                            <li><a href="{{ route('ui-video') }}">Video</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="mdi mdi-clipboard-outline"></i>
                        <span class="badge rounded-pill bg-success float-end">6</span>
                        <span>Forms</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('form-elements') }}">Form Elements</a></li>
                        <li><a href="{{ route('form-validation') }}">Form Validation</a></li>
                        <li><a href="{{ route('form-advanced') }}">Form Advanced</a></li>
                        <li><a href="{{ route('form-editors') }}">Form Editors</a></li>
                        <li><a href="{{ route('form-uploads') }}">Form File Upload</a></li>
                        <li><a href="{{ route('form-xeditable') }}">Form Xeditable</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-chart-line"></i>
                        <span>Charts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('charts-morris') }}">Morris Chart</a></li>
                        <li><a href="{{ route('charts-chartist') }}">Chartist Chart</a></li>
                        <li><a href="{{ route('charts-chartjs') }}">Chartjs Chart</a></li>
                        <li><a href="{{ route('charts-flot') }}">Flot Chart</a></li>
                        <li><a href="{{ route('charts-c3') }}">C3 Chart</a></li>
                        <li><a href="{{ route('charts-other') }}">Jquery Knob Chart</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-format-list-bulleted-type"></i>
                        <span>Tables</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('tables-basic') }}">Basic Tables</a></li>
                        <li><a href="{{ route('tables-datatable') }}">Data Table</a></li>
                        <li><a href="{{ route('tables-responsive') }}">Responsive Table</a></li>
                        <li><a href="{{ route('tables-editable') }}">Editable Table</a></li>
                    </ul>
                </li>

               

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-album"></i>
                        <span>Icons</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('icons-material') }}">Material Design</a></li>
                        <li><a href="{{ route('icons-ion') }}">Ion Icons</a></li>
                        <li><a href="{{ route('icons-fontawesome') }}">Font Awesome</a></li>
                        <li><a href="{{ route('icons-themify') }}">Themify Icons</a></li>
                        <li><a href="{{ route('icons-dripicons') }}">Dripicons</a></li>
                        <li><a href="{{ route('icons-typicons') }}">Typicons Icons</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <span class="badge rounded-pill bg-danger float-end">2</span>
                        <i class="mdi mdi-google-maps"></i>
                        <span>Maps</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('maps-google') }}"> Google Map</a></li>
                        <li><a href="{{ route('maps-vector') }}"> Vector Map</a></li>
                    </ul>
                </li>

                <li class="menu-title">Extras</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-responsive"></i>
                        <span> Layouts </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Vertical</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('layouts-light-sidebar') }}">Light Sidebar</a></li>
                                <li><a href="{{ route('layouts-compact-sidebar') }}">Compact Sidebar</a></li>
                                <li><a href="{{ route('layouts-icon-sidebar') }}">Icon Sidebar</a></li>
                                <li><a href="{{ route('layouts-boxed') }}">Boxed Layout</a></li>
                                <li><a href="{{ route('layouts-preloader') }}">Preloader</a></li>
                                <li><a href="{{ route('layouts-colored-sidebar') }}">Colored Sidebar</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Horizontal</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="{{ route('layouts-horizontal') }}">Horizontal</a></li>
                                <li><a href="{{ route('layouts-hori-topbar-dark') }}">Topbar Dark</a></li>
                                <li><a href="{{ route('layouts-hori-preloader') }}">Preloader</a></li>
                                <li><a href="{{ route('layouts-hori-boxed-width') }}">Boxed Layout</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-account-box"></i>
                        <span> Authentication </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('pages-login') }}">Login</a></li>
                        <li><a href="{{ route('pages-register') }}">Register</a></li>
                        <li><a href="{{ route('pages-recoverpw') }}">Recover Password</a></li>
                        <li><a href="{{ route('pages-lock-screen') }}">Lock Screen</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-text-box-multiple-outline"></i>
                        <span> Extra Pages </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('pages-timeline') }}">Timeline</a></li>
                        <li><a href="{{ route('pages-invoice') }}">Invoice</a></li>
                        <li><a href="{{ route('pages-directory') }}">Directory</a></li>
                        <li><a href="{{ route('pages-blank') }}">Blank Page</a></li>
                        <li><a href="{{ route('pages-404') }}">Error 404</a></li>
                        <li><a href="{{ route('pages-500') }}">Error 500</a></li>
                    </ul>
                </li>

                

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-share-variant"></i>
                        <span>Multi Level</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);">Level 1.1</a></li>
                        <li><a href="javascript: void(0);" class="has-arrow">Level 1.2</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);">Level 2.1</a></li>
                                <li><a href="javascript: void(0);">Level 2.2</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->