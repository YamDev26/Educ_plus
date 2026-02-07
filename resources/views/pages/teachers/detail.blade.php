@extends('app')
@section('title', 'Detail Teacher')
@section('link')
<style>
  
</style>
@endsection
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-12">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-1 mb-0">
                    <h5 class="mb-0">Detail Teacher</h5>
                    <span style="float: right; ">
                      <a href="{{ route('teacher.index') }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                        <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                      </a>
                    </span>
                </div>
                <div class="my-3">
                  <div class="row mT-2 mb-0">
										<div class="col-lg-5 mb-0" style="height: 320px">
											<div class="card mb-0">
												<div class="card-body">
													<div class="d-flex flex-column align-items-center text-center">
														<img src="{{ asset('assets/images/avatars/avatar-2.png') }}" alt="Teacher" class=" p-1" width="120" style="border-radius: 10px">
														<div class="">
															<div class="position-absolute top-0 end-0 m-3 bg-{{ $user->actif ? 'success':'danger' }} px-1"><span class="text-white">{{ $user->actif ? 'Actif':'Inactif'}}</span></div>
														</div>
														<div class="mt-3">
															<h5>{{ $user->civilite.' '.strtoupper($user->first_name).' '.ucwords($user->last_name) }}</h5>
															<p class="mb-1">{{ $user->email }}</p>
															<p class="font-size-sm mb-1">{{ $user->contact1 }} {{ $user->contact2 ?'/ '.$user->contact2:null }}</p>
															<p class="font-size-sm">{{ ucwords($user->matter) }}</p>
															<button class="btn btn-light px-5 pt-1" id="btn">Edit</button>
															<a href="{{ route('teacher.edit',$user->id) }}" id="url"></a>
														</div>
													</div>
													<hr class="mt-3 mb-0">
												</div> 
											</div>
										</div>
										<div class="col-lg-7 mb-0" style="height: 325px">
											<div class="card mb-0">
												<div class="card-body px-3">
													<table class="table table-bordered mt-1" style="width: 90%; margin: 0px auto">
														<tr>
															<td>Pièce</td>
															<td>{{ ucwords($user->piece) }}</td>
														</tr>
														<tr>
															<td>Numéro Pièce</td>
															<td>{{ ucwords($user->num_piece) }}</td>
														</tr>
														<tr>
															<td>Niveau d'étude</td>
															<td>{{ ucwords($user->niveau) }}</td>
														</tr>
														<tr>
															<td>Dernier diplôme</td>
															<td>{{ ucwords($user->diplome) }}</td>
														</tr>
														<tr>
															<td>Autorisation</td>
															<td>{{ ucwords($user->autorise) }}</td>
														</tr>
														<tr>
															<td>Numero autorisation</td>
															<td>{{ ucwords($user->num_autorise) }}</td>
														</tr>
														<tr>
															<td>Ancienneté</td>
															<td>{{ $user->anciennete ? $user->anciennete.' ans':'---' }}</td>
														</tr>
														<tr>
															<td>Contrat</td>
															<td>{{ ucwords($user->profile) }}</td>
														</tr>
													</table>
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
@section('script')
<script>
    $(document).ready(function() {

      $('#btn').on('click', function() {
				$("#url")[0].click();
			});

    });
</script>
@endsection