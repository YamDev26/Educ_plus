@extends('app')
@section('title', 'School')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-lg-10 col-12 offset-lg-1">
            <div class="card">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-3 mb-0">
                    <h5 class="mb-0">School Detail</h5>
                    <a href="{{ route('level.index') }}" class="btn btn-outline-light py-1 mb-1" style="font-size: 12px; border-radius: 2px">Back</a>
                </div>
                <div class="row g-0">
                    <div class="col-md-4 border-end">
                        <img src="{{ asset('storage/' .$school->logoUrl()) }}" class="img-fluid" alt="Logo de l'établissement"><br>
                        <strong class="text-center">
                            {{ strtoupper($school['ville']) }}
                        </strong>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="card-title text-center my-3">
                                <h4 class="mb-0">{{ ucwords($school['name']) }}</h4>
                                <strong class="my-0">[{{ strtoupper($school['abrege']) }}]</strong>
                            </div>
                            <div class="my-3"> 
                                <span class="price h4">$149.00</span> 
                                <span class="">/per kg</span> 
                            </div>
                            <p class="card-text fs-6">Virgil Abloh’s Off-White is a streetwear-inspired collection that continues to break away from the conventions of mainstream fashion. Made in Italy, these black and brown Odsy-1000 low-top sneakers.</p>
                            <dl class="row">
                                <dt class="col-sm-3">Model#</dt>
                                <dd class="col-sm-9">Odsy-1000</dd>
                                
                                <dt class="col-sm-3">Color</dt>
                                <dd class="col-sm-9">Brown</dd>
                                
                                <dt class="col-sm-3">Delivery</dt>
                                <dd class="col-sm-9">Russia, USA, and Europe </dd>
                            </dl>
                            <hr>
                            <div class="row row-cols-auto row-cols-1 row-cols-md-3 align-items-center">
                                <div class="col">
                                    <label class="form-label">Select size</label>
                                    <div class="">
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="select_size" checked="">
                                            <div class="form-check-label">Small</div>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="select_size" checked="">
                                            <div class="form-check-label">Medium</div>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" name="select_size" checked="">
                                            <div class="form-check-label">Large</div>
                                        </label>
                                    </div>
                                </div> 
                                <div class="col">
                                    <label class="form-label">Select Color</label>
                                    <div class="color-indigators d-flex align-items-center gap-2">
                                        <div class="color-indigator-item bg-primary"></div> 
                                        <div class="color-indigator-item bg-danger"></div> 
                                        <div class="color-indigator-item bg-success"></div> 
                                        <div class="color-indigator-item bg-warning"></div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
@endsection