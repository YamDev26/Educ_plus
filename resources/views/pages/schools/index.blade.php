@extends('app')
@section('title', 'school')
@section('content')
<div class="row g-3 mb-3">
    <div class="col-xl-12">
        <div class="row g-3">
        <div class="col-12">
            <div class="card bg-transparent-50 overflow-hidden pt-3">
                <div class="card-header position-relative">
                    <div class="bg-holder d-none d-md-block bg-card z-1" style="background-image:url({{ asset('assets/img/illustrations/ecommerce-bg.png') }});background-size:230px;background-position:right bottom;z-index:-1;"></div>
                    <div class="position-relative z-2">
                        <a href="{{ route('school.create') }}" class="btn btn-falcon-default btn-sm mb-2" style="float: right">create</a>
                        <div>
                            <h3 class="text-primary mb-1 text-center">{{ ucwords($school['name']) }}</h3>
                            <p>Here’s what happening with your store today </p>
                        </div>
                        <div class="d-flex py-3">
                            <div class="pe-3">
                            <p class="text-600 fs-10 fw-medium">Today's visit </p>
                            <h4 class="text-800 mb-0">14,209</h4>
                            </div>
                            <div class="ps-3">
                            <p class="text-600 fs-10">Today’s total sales </p>
                            <h4 class="text-800 mb-0">$21,349.29 </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="mb-0 list-unstyled list-group font-sans-serif">
                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item-warning border-x-0 border-top-0">
                        <div class="row flex-between-center">
                        <div class="col">
                            <div class="d-flex">
                            <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path></svg><!-- <div class="fas fa-circle mt-1 fs-11"></div> Font Awesome fontawesome.com -->
                            <p class="fs-10 ps-2 mb-0"><strong>5 products</strong> didn’t publish to your Facebook page</p>
                            </div>
                        </div>
                        <div class="col-auto d-flex align-items-center"><a class="fs-10 fw-medium text-warning-emphasis" href="#!">View products<svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg><!-- <i class="fas fa-chevron-right ms-1 fs-11"></i> Font Awesome fontawesome.com --></a></div>
                        </div>
                    </li>
                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 greetings-item text-700 border-x-0 border-top-0">
                        <div class="row flex-between-center">
                        <div class="col">
                            <div class="d-flex">
                            <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path></svg><!-- <div class="fas fa-circle mt-1 fs-11 text-primary"></div> Font Awesome fontawesome.com -->
                            <p class="fs-10 ps-2 mb-0"><strong>7 orders</strong> have payments that need to be captured</p>
                            </div>
                        </div>
                        <div class="col-auto d-flex align-items-center"><a class="fs-10 fw-medium" href="#!">View payments<svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg><!-- <i class="fas fa-chevron-right ms-1 fs-11"></i> Font Awesome fontawesome.com --></a></div>
                        </div>
                    </li>
                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 greetings-item text-700  border-0">
                        <div class="row flex-between-center">
                        <div class="col">
                            <div class="d-flex">
                            <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""><path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path></svg><!-- <div class="fas fa-circle mt-1 fs-11 text-primary"></div> Font Awesome fontawesome.com -->
                            <p class="fs-10 ps-2 mb-0"><strong>50+ orders</strong> need to be fulfilled</p>
                            </div>
                        </div>
                        <div class="col-auto d-flex align-items-center"><a class="fs-10 fw-medium" href="#!">View orders<svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg><!-- <i class="fas fa-chevron-right ms-1 fs-11"></i> Font Awesome fontawesome.com --></a></div>
                        </div>
                    </li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection