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
                <div class="card-header border-bottom-0">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-1">Top Products</h5>
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
                </div>
                <div class="product-list p-3 mb-3">
                    <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="product-img">
                                    <img src="assets/images/icons/chair.png" alt="" />
                                </div>
                                <div class="ms-2">
                                    <h6 class="mb-1">Light Blue Chair</h6>
                                    <p class="mb-0">$240.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <h6 class="mb-1">$2140.00</h6>
                            <p class="mb-0">345 Sales</p>
                        </div>
                        <div class="col-sm">
                            <div id="chart5"></div>
                        </div>
                    </div>
                    <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="product-img">
                                    <img src="assets/images/icons/user-interface.png" alt="" />
                                </div>
                                <div class="ms-2">
                                    <h6 class="mb-1">Honor Mobile 7x</h6>
                                    <p class="mb-0">$159.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <h6 class="mb-1">$3570.00</h6>
                            <p class="mb-0">148 Sales</p>
                        </div>
                        <div class="col-sm">
                            <div id="chart6"></div>
                        </div>
                    </div>
                    <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="product-img">
                                    <img src="assets/images/icons/watch.png" alt="" />
                                </div>
                                <div class="ms-2">
                                    <h6 class="mb-1">Hand Watch</h6>
                                    <p class="mb-0">$250.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <h6 class="mb-1">$3650.00</h6>
                            <p class="mb-0">122 Sales</p>
                        </div>
                        <div class="col-sm">
                            <div id="chart7"></div>
                        </div>
                    </div>
                    <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="product-img">
                                    <img src="assets/images/icons/idea.png" alt="" />
                                </div>
                                <div class="ms-2">
                                    <h6 class="mb-1">Mini Laptop</h6>
                                    <p class="mb-0">$260.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <h6 class="mb-1">$6320.00</h6>
                            <p class="mb-0">452 Sales</p>
                        </div>
                        <div class="col-sm">
                            <div id="chart8"></div>
                        </div>
                    </div>
                    <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="product-img">
                                    <img src="assets/images/icons/tshirt.png" alt="" />
                                </div>
                                <div class="ms-2">
                                    <h6 class="mb-1">Slim-T-Shirt</h6>
                                    <p class="mb-0">$112.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <h6 class="mb-1">$2360.00</h6>
                            <p class="mb-0">572 Sales</p>
                        </div>
                        <div class="col-sm">
                            <div id="chart9"></div>
                        </div>
                    </div>
                    <div class="row border mx-0 mb-3 py-2 radius-10 cursor-pointer">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="product-img">
                                    <img src="assets/images/icons/headphones.png" alt="" />
                                </div>
                                <div class="ms-2">
                                    <h6 class="mb-1">Smart Headphones</h6>
                                    <p class="mb-0">$360.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <h6 class="mb-1">$9840.00</h6>
                            <p class="mb-0">275 Sales</p>
                        </div>
                        <div class="col-sm">
                            <div id="chart10"></div>
                        </div>
                    </div>
                    <div class="row border mx-0 py-2 radius-10 cursor-pointer">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center">
                                <div class="product-img">
                                    <img src="assets/images/icons/shoes.png" alt="" />
                                </div>
                                <div class="ms-2">
                                    <h6 class="mb-1">Green Sports Shoes</h6>
                                    <p class="mb-0">$410.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <h6 class="mb-1">$3840.00</h6>
                            <p class="mb-0">265 Sales</p>
                        </div>
                        <div class="col-sm">
                            <div id="chart11"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
    <div class="row row-cols-1 row-cols-lg-3">
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Top Categories</h5>
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
                    <div class="mt-5" id="chart15"></div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Kids <span class="badge bg-light-white-2 rounded-pill">25</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Women <span class="badge bg-light-white-3 rounded-pill">10</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Men <span class="badge bg-white rounded-pill text-dark">65</span>
                    </li>
                    <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">Furniture <span class="badge bg-light-white-4 text-white rounded-pill">14</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col d-flex">
            <div class="card radius-10 w-100">
                <div class="card-body">
                    <p class="font-weight-bold mb-1">Visitors</p>
                    <div class="d-flex align-items-center">
                        <div>
                            <h4 class="mb-0">43,540</h4>
                        </div>
                        <div class="">
                            <p class="mb-0 align-self-center font-weight-bold ms-2">4.4 <i class='bx bxs-up-arrow-alt mr-2'></i>
                            </p>
                        </div>
                    </div>
                    <div id="chart21"></div>
                </div>
            </div>
        </div>
        <div class="col d-flex">
            <div class="card radius-10 w-100 overflow-hidden">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Sales Overiew</h5>
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
                    <div class="mt-5" id="chart20"></div>
                </div>
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex align-items-center justify-content-between text-center">
                        <div>
                            <h6 class="mb-1 font-weight-bold">$289.42</h6>
                            <p class="mb-0">Last Week</p>
                        </div>
                        <div class="mb-1">
                            <h6 class="mb-1 font-weight-bold">$856.14</h6>
                            <p class="mb-0">Last Month</p>
                        </div>
                        <div>
                            <h6 class="mb-1 font-weight-bold">$987,25</h6>
                            <p class="mb-0">Last Year</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
    <div class="row">
        <div class="col-12 col-xl-6 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header border-bottom">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">New Customers</h5>
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
                <div class="customers-list p-3 mb-3">
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                            <img src="assets/images/avatars/avatar-3.png" class="rounded-circle" width="46" height="46" alt="" />
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Emy Jackson</h6>
                            <p class="mb-0 font-13">emy_jac@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                            <img src="assets/images/avatars/avatar-4.png" class="rounded-circle" width="46" height="46" alt="" />
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Martin Hughes</h6>
                            <p class="mb-0 font-13">martin.hug@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                            <img src="assets/images/avatars/avatar-23.png" class="rounded-circle" width="46" height="46" alt="" />
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Laura Madison</h6>
                            <p class="mb-0 font-13">laura_01@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                            <img src="assets/images/avatars/avatar-24.png" class="rounded-circle" width="46" height="46" alt="" />
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Shoan Stephen</h6>
                            <p class="mb-0 font-13">s.stephen@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                            <img src="assets/images/avatars/avatar-20.png" class="rounded-circle" width="46" height="46" alt="" />
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Keate Medona</h6>
                            <p class="mb-0 font-13">Keate@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                            <img src="assets/images/avatars/avatar-16.png" class="rounded-circle" width="46" height="46" alt="" />
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Paul Benn</h6>
                            <p class="mb-0 font-13">pauly.b@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                            <img src="assets/images/avatars/avatar-25.png" class="rounded-circle" width="46" height="46" alt="" />
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Winslet Maya</h6>
                            <p class="mb-0 font-13">winslet_02@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                            <img src="assets/images/avatars/avatar-11.png" class="rounded-circle" width="46" height="46" alt="" />
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Bruno Bernard</h6>
                            <p class="mb-0 font-13">bruno.b@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                            <img src="assets/images/avatars/avatar-17.png" class="rounded-circle" width="46" height="46" alt="" />
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Merlyn Dona</h6>
                            <p class="mb-0 font-13">merlyn.d@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                    <div class="customers-list-item d-flex align-items-center border-bottom p-2 cursor-pointer">
                        <div class="">
                            <img src="assets/images/avatars/avatar-7.png" class="rounded-circle" width="46" height="46" alt="" />
                        </div>
                        <div class="ms-2">
                            <h6 class="mb-1 font-14">Alister Campel</h6>
                            <p class="mb-0 font-13">alister_42@xyz.com</p>
                        </div>
                        <div class="list-inline d-flex customers-contacts ms-auto">	<a href="javascript:;" class="list-inline-item"><i class='bx bxs-envelope'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bxs-microphone'></i></a>
                            <a href="javascript:;" class="list-inline-item"><i class='bx bx-dots-vertical-rounded'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 d-flex">
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
