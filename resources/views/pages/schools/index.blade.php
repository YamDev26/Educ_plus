@extends('app')
@section('title', 'School')
@section('content')
<div class="page-container">
 
    <div class="page-title-head d-flex align-items-sm-center flex-sm-row flex-column gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 text-uppercase fw-bold mb-0">School Details</h4>
        </div>

        <div class="text-end">
            <a href="{{ route('school.create') }}" class="btn btn-primary w-100 d-flex align-items-center gap-1"><i class="ti ti-plus"></i> Add</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-5 col-lg-12">
            <div class="card bg-body">
                <div class="card-body">
                    <!-- Crossfade -->
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item text-center active">
                                <img src="{{ asset('assets/images/products/p-3.png') }}" alt="" class="img-fluid bg-body shadow-none rounded">
                            </div>
                        </div>
                    </div>
                </div>                  
                <div class="card-footer p-0">
                    <div class="bg-body-secondary shadow rounded p-3">
                        <h4 class="mb-3 text-dark">Data Actif :</h4>
                        <div class="bg-warning-subtle border border-warning-subtle p-2 rounded">
                            <div class="row text-xxl-center">
                                <div class="col border-end border-warning-subtle">
                                    <h3 id="days" class="fw-bold fs-18 text-dark">10</h3>
                                    <p class="mb-0">Students</p>
                                </div>
                                <div class="col border-end border-warning-subtle">
                                    <h3 id="hours" class="fw-bold fs-18 text-dark">09</h3>
                                    <p class="mb-0">Teachers</p>
                                </div>
                                <div class="col border-end border-warning-subtle">
                                    <h3 id="minutes" class="fw-bold fs-18 text-dark">30</h3>
                                    <p class="mb-0">Personnels</p>
                                </div>
                                <div class="col">
                                    <h3 id="seconds" class="fw-bold fs-18 text-dark">70</h3>
                                    <p class="mb-0">Autres</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="position-absolute top-0 end-0 p-5 pt-3 z-1">
                    <div data-toggler="on">
                        <button type="button" class="btn btn-icon btn-secondary rounded-circle" data-toggler-on>
                            <iconify-icon icon="solar:heart-angle-bold-duotone" class="fs-22 text-danger"></iconify-icon>
                        </button>
                        <button type="button" class="btn btn-icon btn-light rounded-circle d-none" data-toggler-off>
                            <iconify-icon icon="solar:heart-angle-bold-duotone" class="fs-22" data-toggler-off></iconify-icon>
                        </button>
                    </div>
                </span>
                <span class="position-absolute top-0 start-0 p-5 pt-2 z-1">
                    <span class="badge bg-danger fs-14">School</span>
                </span>
            </div>
        </div>
        <div class="col-xl-7 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="badge bg-success-subtle text-success px-2 py-1 fs-13 rounded-pill">New</span>
                        </div>
                        <div class="flex-grow-1 d-inline-flex align-items-center justify-content-end fs-16">
                            <span class="ti ti-star-filled text-warning"></span>
                            <span class="ti ti-star-filled text-warning"></span>
                            <span class="ti ti-star-filled text-warning"></span>
                            <span class="ti ti-star-filled text-warning"></span>
                            <span class="ti ti-star-filled text-warning"></span>
                            <span class="ms-1 fs-14">23k Reviews </span>
                        </div>
                    </div>
                    <div class="mt-3 mb-1">
                        <a href="#!" class="text-dark fs-20 fw-medium">Minetta Rattan Swivel Luxury Green Premium Lounge Chair</a>
                    </div>
                    <p class="text-muted fw-medium fs-14 mb-1"><span class="text-dark">Menufechar : </span> Premium Furniture</p>
                    <p class="text-muted fw-medium fs-14 mb-1"><span class="text-dark">Article : </span> CR63541</p>
                    <p class="text-muted fw-medium fs-14 mb-1"><span class="text-dark">Sold Items : </span> 76k</p>
                    <p class="text-muted fw-medium fs-14 mb-0"><span class="text-dark">Product Code : </span> CD4671CR</p>

                    <h2 class="my-4 fw-bold text-dark">$300.00 <span class="text-muted fs-14 fw-medium">/ 20% Off</span></h2>
                    <div class="d-flex flex-wrap align-items-center gap-2 mt-3 mb-2" role="group" aria-label="Basic checkbox toggle button group">
                        <p class="mb-0 text-dark fw-semibold fs-15">Colors : </p>
                        <input type="checkbox" class="btn-check" id="color-dark2">
                        <label class="btn avatar btn-icon rounded-circle d-flex justify-content-center align-items-center" for="color-dark2"> <i class="ti ti-circle-filled fs-28 rounded-circle text-success"></i></label>

                        <input type="checkbox" class="btn-check" id="color-yellow2">
                        <label class="btn avatar btn-icon rounded-circle d-flex justify-content-center align-items-center" for="color-yellow2"> <i class="ti ti-circle-filled fs-28 rounded-circle text-warning"></i></label>

                        <input type="checkbox" class="btn-check" id="color-white2">
                        <label class="btn avatar btn-icon rounded-circle d-flex justify-content-center align-items-center" for="color-white2"> <i class="ti ti-circle-filled fs-28 rounded-circle text-primary"></i></label>

                        <input type="checkbox" class="btn-check" id="color-info" checked="">
                        <label class="btn avatar btn-icon rounded-circle d-flex justify-content-center align-items-center" for="color-info"> <i class="ti ti-circle-filled fs-28 rounded-circle text-info"></i></label>

                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2 my-3">
                        <p class="mb-0 text-dark fw-semibold fs-15">Stock : </p>
                        <div>
                            <p class="text-success mb-0 fw-semibold fs-15"><i class="ti ti-checks"></i> In Stock</p>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap align-items-center gap-2 my-3">
                        <p class="mb-0 text-dark fw-semibold fs-15">Quantity : </p>
                        <div data-touchspin class="input-step border bg-body-secondary p-1 mt-1 rounded-pill d-inline-flex overflow-visible">
                            <button type="button" class="minus bg-light text-dark border-0 rounded-circle fs-20 lh-1 h-100">-</button>
                            <input type="number" class="text-dark text-center border-0 bg-body-secondary rounded h-100" value="1" min="0" max="100" readonly="">
                            <button type="button" class="plus bg-light text-dark border-0 rounded-circle fs-20 lh-1 h-100">+</button>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top border-dashed">
                    <div class="row g-2">
                        <div class="col-lg-3">
                            <a href="#!" class="btn btn-primary w-100 d-flex align-items-center gap-1"><iconify-icon icon="solar:cart-large-2-bold" class="fs-16 align-middle"></iconify-icon> Add to Bag</a>
                        </div>
                        <div class="col-lg-3">
                            <a href="#!" class="btn btn-success w-100 d-flex align-items-center gap-1"><iconify-icon icon="solar:bag-check-bold" class="fs-16 align-middle"></iconify-icon> Buy Now</a>
                        </div>
                        <div class="col-lg-3">
                            <a href="#!" class="btn btn-outline-danger w-75 d-flex align-items-center gap-1"><iconify-icon icon="solar:heart-bold" class="fs-16 align-middle"></iconify-icon> Wishlist</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection