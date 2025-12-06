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
                        <img src="{{ asset($school->logoUrl()) }}" class="img-fluid" alt="Logo"><br>
                        <strong class="text-center">
                            {{ strtoupper($school['ville']) }}
                        </strong>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body pb-0">
                            <div class="card-title text-center mT-3 mb-1">
                                <h4 class="mb-0">{{ ucwords($school['name']) }}</h4>
                                <strong class="my-0">[{{ strtoupper($school['abrege']) }} ]</strong>
                            </div>
                            <hr class="my-0">
                            <div class="my-3 d-flex justify-content-between mx-lg-3"> 
                                <span class="price h6">Etablissement {{ ucwords($school['statut']) }}</span> 
                                <span class="price h6">Code : {{ ucwords($school['code']) }}</span>
                            </div>
                            {{-- <p class="card-text fs-6">Virgil Abloh’s Off-White is a streetwear-inspired collection that continues to break away from the conventions of mainstream fashion. Made in Italy, these black and brown Odsy-1000 low-top sneakers.</p> --}}
                            <dl class="row">
                                <dt class="col-sm-3">Email :</dt>
                                <dd class="col-sm-9">{{ $school['email'] }}</dd>
                                
                                <dt class="col-sm-3">Téléphone :</dt>
                                <dd class="col-sm-3">{{ $school['numero'] }}</dd>
                                
                                <dt class="col-sm-3">Adresse postale :</dt>
                                <dd class="col-sm-3">{{ $school['postale'] }}</dd>

                                <dt class="col-sm-3">Date de creation :</dt>
                                <dd class="col-sm-3">{{ date('d-m-Y', strtotime($school['create'])) }}</dd>

                                <dt class="col-sm-3">Date d'ouverture :</dt>
                                <dd class="col-sm-3">{{ date('d-m-Y', strtotime($school['ouverture'])) }}</dd>

                                <dt class="col-sm-4">Nombre de salle de classe :</dt>
                                <dd class="col-sm-2">{{ $school['classe'] < 9 ? '0'.$school['classe']:$school['classe'] }}</dd>

                                <dt class="col-sm-3">DREN :</dt>
                                <dd class="col-sm-3">{{ ucwords($school['dren']) }}</dd>

                                <div class="mt-1 mb-0 ml-lg-3"> 
                                    <span class="price h6">Enseignement : Collège - Lycée</span>
                                </div>
                            </dl>
                            <hr class="mt-0">
                            <div class="row row-cols-auto row-cols-1 row-cols-md-3 align-items-center">
                                <div class="col mb-3">
                                    <label class="form-label">Caisse</label>
                                    <div class="">
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" {{ $school['caisse'] ? 'checked':null }}>
                                            <div class="form-check-label">Oui</div>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" {{ $school['caisse'] ? null:'checked' }}>
                                            <div class="form-check-label">Non</div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col mb-3">
                                    <label class="form-label">Cantine</label>
                                    <div class="">
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" {{ $school['cantine'] ? 'checked':null }}>
                                            <div class="form-check-label">Oui</div>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" {{ $school['cantine'] ? null:'checked' }}>
                                            <div class="form-check-label">Non</div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col mb-3">
                                    <label class="form-label">Bus</label>
                                    <div class="">
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" {{ $school['bus'] ? 'checked':null }}>
                                            <div class="form-check-label">Oui</div>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" {{ $school['bus'] ? null:'checked' }}>
                                            <div class="form-check-label">Non</div>
                                        </label>
                                    </div>
                                </div> 
                                <div class="col mb-3">
                                    <label class="form-label">Bibliothèque</label>
                                    <div class="">
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" {{ $school['bibliotheque'] ? 'checked':null }}>
                                            <div class="form-check-label">Oui</div>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" {{ $school['bibliotheque'] ? null:'checked' }}>
                                            <div class="form-check-label">Non</div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col mb-3">
                                    <label class="form-label">Labo SVT</label>
                                    <div class="">
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" {{ $school['svt'] ? 'checked':null }}>
                                            <div class="form-check-label">Oui</div>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" {{ $school['svt'] ? null:'checked' }}>
                                            <div class="form-check-label">Non</div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col mb-3">
                                    <label class="form-label">Labo Physique Chimie</label>
                                    <div class="">
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" {{ $school['phis_chim'] ? 'checked':null }}>
                                            <div class="form-check-label">Oui</div>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" {{ $school['phis_chim'] ? null:'checked' }}>
                                            <div class="form-check-label">Non</div>
                                        </label>
                                    </div>
                                </div> 
                                <div class="col mb-3">
                                    <label class="form-label">Informatique</label>
                                    <div class="">
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" {{ $school['informatique'] ? 'checked':null }}>
                                            <div class="form-check-label">Oui</div>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" {{ $school['informatique'] ? null:'checked' }}>
                                            <div class="form-check-label">Non</div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col mb-3">
                                    <label class="form-label">Musiqque - Art Plastique</label>
                                    <div class="">
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" {{ $school['musi_art_pl'] ? 'checked':null }}>
                                            <div class="form-check-label">Oui</div>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input type="radio" class="form-check-input" {{ $school['musi_art_pl'] ? null:'checked' }}>
                                            <div class="form-check-label">Non</div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col mb-3">
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
                <hr class="mt-1">
                <div class="col-12 text-center mb-3">
                    <button class="btn btn-outline-light btn-sm w-25">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection