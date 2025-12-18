@extends('app')
@section('title', 'Detail Student')
@section('content')
<div class="page-content">
  <div class="row mx-lg-3">
    <div class="col-12">
      @include('partials._alert')
      <div class="card radius-10 w-100">
        <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-1 mb-0">
          <h5 class="mb-0">Detail Student</h5>
          <span style="float: right; ">
						<a href="{{ route('student.edit', $data->id) }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Edit Info" style="border: none; border-radius: 3px">
							<i class="fadeIn animated bx bx-edit-alt m-0" style="font-size: 17px"></i>
						</a>
            <a href="{{ route('student.index') }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
							<i class="lni lni-reply m-0" style="font-size: 17px"></i>
						</a>
          </span>
        </div>
        <div class="card-body px-lg-3">
					<div class="row g-0">
					  <div class="col-md-4 border-end text-center">
              <div class="row row-cols-auto justify-content-center my-0">
                <h5 class="my-0" style="text-decoration: underline dotted;">{{ $data->matricule }}</h5>
              </div>
              <hr>
						  <img src="{{ asset('assets/images/avatars/avatar-1.png') }}" class="img-fluid my-0" alt="..." style="border-radius: 3px">
					  </div>
					  <div class="col-md-8">
						<div class="card-body">
						  <h4 class="card-title">{{ strtoupper($data->first_name.' '.$data->last_name) }}</h4>
						  <div class="d-flex gap-3 py-3">
							<div class="cursor-pointer">
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star text-warning'></i>
								<i class='bx bxs-star'></i>
							  </div>	
							  <div>142 reviews</div>
							  <div class="text-white"><i class='bx bxs-cart-alt align-middle'></i> 134 orders</div>
						  </div>
						  <div class="mb-3"> 
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
							{{-- <div class="col">
								<label class="form-label">Quantity</label>
								<div class="input-group input-spinner">
									<button class="btn btn-light" type="button" id="button-plus"> + </button>
								     <input type="text" class="form-control" value="1">
									<button class="btn btn-light" type="button" id="button-minus"> − </button>
								</div>
							</div>  --}}
							{{-- <div class="col">
									<label class="form-label">Select size</label>
									<div class="">
										<label class="form-check form-check-inline">
										  <input type="radio"class="form-check-input"  name="select_size" checked="" class="custom-control-input">
										  <div class="form-check-label">Small</div>
										</label>
										<label class="form-check form-check-inline">
											<input type="radio"class="form-check-input"  name="select_size" checked="" class="custom-control-input">
											<div class="form-check-label">Medium</div>
										  </label>

										  <label class="form-check form-check-inline">
											<input type="radio"class="form-check-input"  name="select_size" checked="" class="custom-control-input">
											<div class="form-check-label">Large</div>
										  </label>
									</div>
							</div>  --}}
							{{-- <div class="col">
								<label class="form-label">Select Color</label>
								<div class="color-indigators d-flex align-items-center gap-2">
									 <div class="color-indigator-item bg-primary"></div> 
									 <div class="color-indigator-item bg-danger"></div> 
									 <div class="color-indigator-item bg-success"></div> 
									 <div class="color-indigator-item bg-warning"></div> 
								</div>
							</div> --}}
						</div>
						</div>
					  </div>
					</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection