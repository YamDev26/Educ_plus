@extends('app')
@section('title', 'School')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-12">
            @include('partials._alert')
            <div class="card">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-0 mb-0" style="border: none">
                    <h5 class="mb-0">School Detail</h5>
                    <div class="group-btn">
                        <a href="{{ route('school.edit') }}" class="btn btn-outline-light py-1 mb-1 mx-2" style="font-size: 12px; border-radius: 2px">{{ $school ? 'Edit':'Add' }}</a>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-light py-1 mb-1" style="font-size: 12px; border-radius: 2px">Back</a>
                    </div>
                </div>
                <hr class="mt-0 mb-3 mx-3">
                <div class="row g-0 mt-3">
                    <div class="col-md-4 border-end text-center">
                        <p class="pt-sm-5">
                            <img src="{{ asset('storage/' . $school->logo) }}" class="img-fluid mt-sm-5" alt="........" style="margin-top: 15px; border-radius: 10px">
                        </p>
                        <p class="mb-0">
                            {{ $school->college ? 'Collège':'...' }} - {{ $school->lycee ? 'Lycée':'...' }}
                        </p>
                        <div class="cursor-pointer">
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star text-warning"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                        </div>
                        {{-- <strong class="text-center" style="font-size: 17px">Ville: {{ ucwords($school->ville) }}</strong> --}}
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="card-title text-center mT-3 mb-1">
                                <h4 class="mb-0">{{ ucwords($school->name) }}</h4>
                                <strong class="my-0">{{ $school['abrege'] ? '[ '.strtoupper($school->abrege).' ]':null }}</strong>
                            </div>
                            <hr class="my-0">
                            <div class="my-4 d-flex justify-content-between mx-lg-3"> 
                                <span class="h6">Etablissement {{ ucwords($school->statut) }}</span>
                                
                                <span class="h6">Code : {{ ucwords($school->code) }}</span>
                            </div>
                            <dl class="row mt-3">
                                <dd class="col-sm-3 h6">Email :</dt>
                                <dd class="col-sm-9 h6">{{ $school->email }}</dd>
                                <hr class="my-2">
                                <dd class="col-sm-3 h6 mb-4">Téléphone :</dt>
                                <dd class="col-sm-3 h6 mb-4">{{ $school->numero }}</dd>
                                
                                <dt class="col-sm-3 h6 mb-4">Adresse postale :</dt>
                                <dd class="col-sm-3 h6 mb-4">{{ $school->postale }}</dd>
                                <hr class="my-2">
                                <dt class="col-sm-3 h6 mb-4">DREN :</dt>
                                <dd class="col-sm-3 h6 mb-4">{{ ucwords($school->dren) }}</dd>

                                <dt class="col-sm-3 h6 mb-4">Ville :</dt>
                                <dd class="col-sm-3 h6 mb-4">{{ ucwords($school->ville) }}</dd>
                                <hr class="my-2">
                                <dt class="col-sm-3 h6 mb-4">Date de creation :</dt>
                                <dd class="col-sm-3 h6 mb-4">{{ date('d-m-Y', strtotime($school->created)) }}</dd>

                                <dt class="col-sm-3 h6 mb-4">Date d'ouverture :</dt>
                                <dd class="col-sm-3 h6 mb-4">{{ date('d-m-Y', strtotime($school->opened)) }}</dd>
                            </dl>
                            <hr>
                            <div class="row row-cols-auto row-cols-1 row-cols-md-3 align-items-center">
                                <div class="col">
                                    <label class="form-label">Gestion caisse</label>
                                    <div class="">
                                        <label class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" {{ $school->paiement ? 'checked':null }} disabled>
                                            <div class="form-check-label">Oui</div>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" {{ $school->paiement ? null:'checked' }} disabled>
                                            <div class="form-check-label">Non</div>
                                        </label>
                                    </div>
                                </div>
                                {{-- <div class="col">
                                    <label class="form-label">Type d'enseignement</label>
                                    <div class="">
                                        <label class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" {{ $school->college ? 'checked':null }} disabled>
                                            <div class="form-check-label">Collége</div>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" {{ $school->lycee ? 'checked':null }} disabled>
                                            <div class="form-check-label">Lycée</div>
                                        </label>
                                    </div>
                                </div>  --}}
                                <div class="col">
                                    <label class="form-label">Informatique</label>
                                    <div class="">
                                        <label class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" {{ $school->informatik ? 'checked':null }} disabled>
                                            <div class="form-check-label">Oui</div>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" {{ $school->informatik ? null:'checked' }} disabled>
                                            <div class="form-check-label">Non</div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <label class="form-label">Musique & Art plastique</label>
                                    <div class="">
                                        <label class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" {{ $school->autres ? 'checked':null }} disabled>
                                            <div class="form-check-label">Oui</div>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="checkbox" class="form-check-input" {{ $school->autres ? null:'checked' }} disabled>
                                            <div class="form-check-label">Non</div>
                                        </label>
                                    </div>
                                </div> 
                            </div>
                    
                        </div>
                    </div>
                </div>
                <hr class="mx-3 mb-3">
            </div>
        </div>
    </div>
</div>
@endsection