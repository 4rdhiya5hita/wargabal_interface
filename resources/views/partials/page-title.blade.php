<!-- start page title -->
<div class="row">
    <div class="col-sm-6">
        <div class="page-title-box">
            <!-- jika variabel title tidak ada maka ganti dengan subtitle -->
             @if (empty($title))
            <h4>{{ $subtitle }}</h4>
            @else
            <h4>{{ $title }}</h4>
            @endif
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $pagetitle }}</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $subtitle }}</a></li>
                    @if (!empty($title))
                    <li class="breadcrumb-item active">{{ $title }}</li>
                    @endif
                </ol>
        </div>
    </div>
    <div class="col-sm-6">
        <!-- <div class="state-information d-none d-sm-block">
            <div class="state-graph">
                <div id="header-chart-1" data-colors='["--bs-primary"]'></div>
                <div class="info">Balance $ 2,317</div>
            </div>
            <div class="state-graph">
                <div id="header-chart-2" data-colors='["--bs-info"]'></div>
                <div class="info">Item Sold 1230</div>
            </div>
        </div> -->
    </div>
</div>
<!-- end page title -->