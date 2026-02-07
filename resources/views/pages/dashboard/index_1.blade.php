@extends('app')
@section('title', 'dashboard')
@section('content')
<div class="page-content">
    @include('partials._alert')
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Revenue</p>
                            <h4 class="my-1">$4805</h4>
                            <p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i>$34 Since last week</p>
                        </div>
                        <div class="widgets-icons ms-auto"><i class='bx bxs-wallet'></i>
                        </div>
                    </div>
                    <div id="chart1"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Total Customers</p>
                            <h4 class="my-1">8.4K</h4>
                            <p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i>14% Since last week</p>
                        </div>
                        <div class="widgets-icons ms-auto"><i class='bx bxs-group'></i>
                        </div>
                    </div>
                    <div id="chart2"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0">Store Visitors</p>
                            <h4 class="my-1">59K</h4>
                            <p class="mb-0 font-13"><i class='bx bxs-down-arrow align-middle'></i>12.4% Since last week</p>
                        </div>
                        <div class="widgets-icons ms-auto"><i class='bx bxs-binoculars'></i>
                        </div>
                    </div>
                    <div id="chart3"></div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
    <div class="row row-cols-1 row-cols-xl-2">
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-1">Store Metrics</h5>
                            <p class="mb-0 font-13"><i class='bx bxs-calendar'></i>in last 30 days revenue</p>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22  text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-sm-3 mt-4">
                        <div class="col">
                            <div>
                                <p class="mb-0">Revenue</p>
                                <h4 class="my-1 text-white">$4805</h4>
                                <p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i>$1458 Since last month</p>
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <p class="mb-0">Total Customers</p>
                                <h4 class="my-1 text-white">8.4K</h4>
                                <p class="mb-0 font-13"><i class='bx bxs-up-arrow align-middle'></i>12.3% Since last month</p>
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <p class="mb-0">Store Visitors</p>
                                <h4 class="my-1 text-white">59K</h4>
                                <p class="mb-0 font-13"><i class='bx bxs-down-arrow align-middle'></i>2.4% Since last month</p>
                            </div>
                        </div>
                    </div>
                    <div id="chart4"></div>
                </div>
            </div>
        </div>
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header border-bottom">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Orders Summary</h5>
                        </div>
                        <div class="dropdown ms-auto">
                            <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22  text-option'></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row m-0 row-cols-1 row-cols-md-3">
                        <div class="col border-end">
                            <div id="chart16"></div>
                        </div>
                        <div class="col border-end">
                            <div id="chart17"></div>
                        </div>
                        <div class="col">
                            <div id="chart18"></div>
                        </div>
                    </div>
                    <div id="chart19"></div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
</div>
@endsection
@section('script')
<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/index.js') }}"></script>
<script>
    new PerfectScrollbar('.product-list');
    new PerfectScrollbar('.customers-list');

    $(document).ready(function(){
        
    })
</script>
@endsection
