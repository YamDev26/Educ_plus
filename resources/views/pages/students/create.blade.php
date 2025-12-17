@extends('app')
@section('title', $data ? 'Student Edit':'Student Create')
@section('link')
<link href="{{ asset('assets/plugins/bs-stepper/css/bs-stepper.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="page-content">
	<div class="row">
        <div class="col-12">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-1 mb-0">
                    <h5 class="mb-0">Ajou De Nouvel Elève</h5>
                    <span style="float: right; ">
                        <a href="{{ route('student.index') }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                            <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    <!--start stepper one-->
                    <div id="stepper1" class="bs-stepper">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist">
                                    <div class="step" data-target="#test-l-1">
                                    <div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                                        <div class="bs-stepper-circle">1</div>
                                        <div class="">
                                            <h5 class="mb-0 steper-title">Personal Info</h5>
                                            <p class="mb-0 steper-sub-title">Enter Your Details</p>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#test-l-2">
                                        <div class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                                        <div class="bs-stepper-circle">2</div>
                                        <div class="">
                                            <h5 class="mb-0 steper-title">Account Details</h5>
                                            <p class="mb-0 steper-sub-title">Setup Account Details</p>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-line"></div>
                                    <div class="step" data-target="#test-l-3">
                                        <div class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                                        <div class="bs-stepper-circle">3</div>
                                        <div class="">
                                            <h5 class="mb-0 steper-title">Education</h5>
                                            <p class="mb-0 steper-sub-title">Education Details</p>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="bs-stepper-line"></div>
                                        <div class="step" data-target="#test-l-4">
                                            <div class="step-trigger" role="tab" id="stepper1trigger4" aria-controls="test-l-4">
                                            <div class="bs-stepper-circle">4</div>
                                            <div class="">
                                                <h5 class="mb-0 steper-title">Work Experience</h5>
                                                <p class="mb-0 steper-sub-title">Experience Details</p>
                                            </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="bs-stepper-content">
                                    <form action="{{ route('student.store') }}" method="post" id="myForm" enctype="multipart/form-data">
                                        @csrf
                                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                                            <h5 class="mb-1">Your Personal Information</h5>
                                            <p class="mb-4">Enter your personal information to get closer to copanies</p>

                                            <div class="row g-3 p-2">
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label class="form-label">Situation Familiale<span class="text-danger">*</span> :</label>
                                                    <div class="row">
                                                        <div class="col-lg-7 col-12 mt-lg-2">
                                                            <div class="d-flex justify-content-around">
                                                                <span class="form-check">
                                                                    <input type="radio" name="parent" class="form-check-input" id="pere" value="pere">
                                                                    <label class="form-check-label" for="pere">Père</label>
                                                                </span>
                                                                <span class="form-check">
                                                                    <input type="radio" name="parent" class="form-check-input" id="mere" value="mere">
                                                                    <label class="form-check-label" for="mere">Mère</label>
                                                                </span>
                                                                <span class="form-check">
                                                                    <input type="radio" name="parent" class="form-check-input" id="tuteur" value="tuteur" checked>
                                                                    <label class="form-check-label" for="tuteur">Tuteur</label>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <div class="my-3 position-relative d-inline-block col-12">
                                                        <p class="text-danger my-0 position-absolute" id="existPts" style="display: none">Parent déjà présent !</p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="phon1" class="form-label">Téléphone 1<span class="text-danger">*</span> :</label>
                                                            <input type="text" name="phon1" id="phon1" class="form-control number @error('phon1') is-invalid @enderror" value="{{ old('phon1') }}" placeholder="Numéro téléphone 1">
                                                            @error('phon1')
                                                                <span class="form-bar text-danger" role="alert">
                                                                    {{$message}}
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="phon2" class="form-label">Téléphone 2 :</label>
                                                            <input type="text" name="phon2" id="phon2" class="form-control number @error('phon2') is-invalid @enderror" value="{{ old('phon2') }}" placeholder="Numéro téléphone 2">
                                                            @error('phon2')
                                                                <span class="form-bar text-danger" role="alert">
                                                                    {{$message}}
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="nameFirstParent" class="form-label">Nom Parent<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="nameFirstParent" id="nameFirstParent" class="form-control @error('nameFirstParent') is-invalid @enderror" value="{{ old('nameFirstParent') }}" placeholder="Entrez le nom">
                                                    @error('nameFirstParent')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="nameLastParent" class="form-label">Prénoms Parent<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="nameLastParent" id="nameLastParent" class="form-control @error('nameLastParent') is-invalid @enderror" value="{{ old('nameLastParent') }}" placeholder="Entrez le prenoms">
                                                    @error('nameLastParent')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="profesionParent" class="form-label">Profession Parent<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="profesionParent" id="profesionParent" class="form-control @error('profesionParent') is-invalid @enderror" value="{{ old('profesionParent') }}" placeholder="Entrez le profession">
                                                    @error('profesionParent')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="emal" class="form-label">Adresse Email Parent :</label>
                                                    <input type="email" name="email" id="emal" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Entrez l'adresse Email">
                                                    @error('email')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <div style="float: right">
                                                        <button type="button" class="btn btn-light px-4 button" data-type="1" onclick="stepper1.next()">Next<i class='bx bx-right-arrow-alt ms-2'></i></button>
                                                    </div>
                                                </div>
                                            </div><!---end row-->
                                            
                                        </div>

                                        <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                                            <h5 class="mb-1">Account Details</h5>
                                            <p class="mb-4">Enter Your Account Details.</p>

                                            <div class="row g-3">
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="matricule" class="form-label">Matricule<span class="text-danger">*</span> : <strong class="text-danger pl-2" id="mtls" style="display: none">Matricule déjà utilisé par un autre élève !</strong></label>
                                                    <input type="text" name="matricule" id="matricule" class="form-control @error('matricule') is-invalid @enderror" value="{{ old('matricule') }}" placeholder="Entrez le matricule">
                                                    @error('matricule')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="genre" class="form-label">Genre<span class="text-danger">*</span> :</label>
                                                    <select name="genre" id="genre" class="form-select @error('genre') is-invalid @enderror" aria-label="Default select">
                                                        <option value="">Select</option>
                                                        <option value="F" {{ old('genre') == 'F' ? 'selected':'' }}>Feminin</option>
                                                        <option value="M" {{ old('genre') == 'M' ? 'selected':'' }}>Masculin</option>
                                                    </select>
                                                    @error('genre')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="firstName" class="form-label">Nom<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="firstName" id="firstName" class="form-control @error('firstName') is-invalid @enderror" value="{{ old('firstName') }}" placeholder="Entrez le nom">
                                                    @error('firstName')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="lastName" class="form-label">Prenoms<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="lastName" id="lastName" class="form-control @error('lastName') is-invalid @enderror" value="{{ old('lastName') }}" placeholder="Entrez le prenoms">
                                                    @error('lastName')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="dateNaiss" class="form-label">Date de naissance<span class="text-danger">*</span> :</label>
                                                    <input type="date" name="dateNaiss" id="dateNaiss" class="form-control @error('dateNaiss') is-invalid @enderror" value="{{ old('dateNaiss') }}" placeholder="Entrez la date de naissance">
                                                    @error('dateNaiss')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="lieuNaiss" class="form-label">Lieu de naissance<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="lieuNaiss" id="lieuNaiss" class="form-control @error('lieuNaiss') is-invalid @enderror" value="{{ old('lieuNaiss') }}" placeholder="Entrez le lieu de naissance">
                                                    @error('lieuNaiss')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="nationalite" class="form-label">Nationalité<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="nationalite" id="nationalite" class="form-control @error('nationalite') is-invalid @enderror" list="datalistOptions" value="{{ old('nationalite') }}" placeholder="Entrez la nationalité">
                                                    <datalist id="datalistOptions">
                                                        {{-- <option value="San Francisco"></option>
                                                        <option value="New York"></option>
                                                        <option value="Seattle"></option>
                                                        <option value="Los Angeles"></option>
                                                        <option value="Chicago"></option> --}}
                                                    </datalist>
                                                    @error('nationalite')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="extrait" class="form-label">Numéro d’extrait de naissance<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="extrait" id="extrait" class="form-control @error('extrait') is-invalid @enderror" value="{{ old('extrait') }}" placeholder="Entrez le numéro d’extrait de naissance">
                                                    @error('extrait')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <div class="d-flex align-items-center gap-3" style="float: right">
                                                        <button type="button" class="btn btn-outline-light px-4" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2'></i>Previous</button>
                                                        <button type="button" class="btn btn-light px-4" onclick="stepper1.next()">Next<i class='bx bx-right-arrow-alt ms-2'></i></button>
                                                    </div>
                                                </div>
                                            </div><!---end row-->
                                        </div>

                                        <div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">
                                            <h5 class="mb-1">Your Education Information</h5>
                                            <p class="mb-4">Inform companies about your education life</p>

                                            <div class="row g-3">
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="pereNameFirst" class="form-label">Nom Père Biologique<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="pereNameFirst" id="pereNameFirst" class="form-control  @error('pereNameFirst') is-invalid @enderror" value="{{ old('pereNameFirst') }}" placeholder="Entrez le nom du père biologie">
                                                    @error('pereNameFirst')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="pereNameLast" class="form-label">Prenoms Père Biologique<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="pereNameLast" id="pereNameLast" class="form-control @error('pereNameLast') is-invalid @enderror" value="{{ old('pereNameLast') }}" placeholder="Entrez le prenoms du père biologie">
                                                    @error('pereNameLast')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="profPere" class="form-label">Profession Père Biologique<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="profPere" id="profPere" class="form-control @error('profPere') is-invalid @enderror" value="{{ old('profPere') }}" placeholder="Entrez la profession du père biologie">
                                                    @error('profPere')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="phonPere" class="form-label">Téléphone Pére Biologique :</label>
                                                    <input type="text" name="phonPere" id="phonPere" class="form-control number @error('phonPere') is-invalid @enderror" value="{{ old('phonPere') }}" placeholder="Entrez le contact du père biologie">
                                                    @error('phonPere')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="mereNameFirst" class="form-label">Nom Mère Biologique<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="mereNameFirst" id="mereNameFirst" class="form-control @error('mereNameFirst') is-invalid @enderror" value="{{ old('mereNameFirst') }}" placeholder="Entrez le nom du mère biologie">
                                                    @error('mereNameFirst')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="mereNameLast" class="form-label">Prenoms Mère Biologique<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="mereNameLast" id="mereNameLast" class="form-control @error('mereNameLast') is-invalid @enderror" value="{{ old('mereNameLast') }}" placeholder="Entrez le prenoms du mère biologie">
                                                    @error('mereNameLast')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="profMere" class="form-label">Profession Mère Biologique<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="profMere" id="profMere" class="form-control @error('profMere') is-invalid @enderror" value="{{ old('profMere') }}" placeholder="Entrez la profession du mère biologie">
                                                    @error('profMere')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="phonMere" class="form-label">Téléphone Mére Biologique :</label>
                                                    <input type="text" name="phonMere" id="phonMere" class="form-control number @error('phonMere') is-invalid @enderror" value="{{ old('phonMere') }}" placeholder="Entrez le contact du mère biologie">
                                                    @error('phonMere')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <div class="d-flex align-items-center gap-3" style="float: right">
                                                        <button type="button" class="btn btn-outline-light px-4" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2'></i>Previous</button>
                                                        <button type="button" class="btn btn-light px-4" onclick="stepper1.next()">Next<i class='bx bx-right-arrow-alt ms-2'></i></button>
                                                    </div>
                                                </div>
                                            </div><!---end row-->
                                            
                                        </div>

                                        <div id="test-l-4" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger4">
                                            <h5 class="mb-1">Work Experiences</h5>
                                            <p class="mb-2">Can you talk about your past work experience?</p>

                                            <div class="row g-3" style="margin: 0px auto">
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="residence" class="form-label">Résidence<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="residence" id="residence" class="form-control @error('residence') is-invalid @enderror" value="{{ old('residence') }}" placeholder="Entrez la résidence">
                                                    @error('residence')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="file" class="form-label">Photo d’identité :</label>
                                                    <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" accept="image/jpeg, image/png, image/jpg">
                                                    @error('file')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="oldSchool" class="form-label">Ancien établissement fréquenté<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="oldSchool" id="oldSchool" class="form-control @error('oldSchool') is-invalid @enderror" value="{{ old('oldSchool') }}" placeholder="Entrez l'ncien établissement fréquenté">
                                                    @error('oldSchool')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="oldLevel" class="form-label">Ancien niveau<span class="text-danger">*</span> :</label>
                                                    <select name="oldLevel" id="oldLevel" class="form-select @error('oldLevel') is-invalid @enderror" data-placeholder="Choose one thing">
                                                        <option value="">Selectionner</option>
                                                        @foreach ($oldLevel as $item)
                                                            <option value="{{ $item }}">{{ $item }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('oldLevel')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-lg-3 mb-2">
                                                    <label for="affecte" class="form-label">Affecté(e)<span class="text-danger">*</span> :</label>
                                                    <select name="affecte"  id="affecte" class="form-select @error('affecte') is-invalid @enderror" data-placeholder="Choose one thing">
                                                        <option value="non">Non</option>
                                                        <option value="oui" selected>Oui</option>
                                                    </select>
                                                    @error('affecte')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-lg-3 mb-2">
                                                    <label for="doublant" class="form-label">Redoublant(e)<span class="text-danger">*</span> :</label>
                                                    <select name="doublant"  id="doublant" class="form-select @error('doublant') is-invalid @enderror" data-placeholder="Choose one thing">
                                                        <option value="non" selected>Non</option>
                                                        <option value="oui">Oui</option>
                                                    </select>
                                                    @error('doublant')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-lg-3 mb-2">
                                                    <label for="boursier" class="form-label">Boursier(e)<span class="text-danger">*</span> :</label>
                                                    <select name="boursier"  id="boursier" class="form-select @error('boursier') is-invalid @enderror" data-placeholder="Choose one thing">
                                                        <option value="non" selected>Non</option>
                                                        <option value="demi">Demi bourse</option>
                                                        <option value="pliein">Pleine bourse</option>
                                                    </select>
                                                    @error('boursier')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-lg-3 mb-3">
                                                    <label for="interne" class="form-label">Interne<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="interne" id="interne" class="form-control @error('interne') is-invalid @enderror" value="{{ old('interne') ?? 'd/p' }}">
                                                </div>
                                                <div class="col-6 col-lg-3 mb-2">
                                                    <label for="level" class="form-label">Niveau actuel<span class="text-danger">*</span> :</label>
                                                    <select name="level" id="level" class="form-select @error('level') is-invalid @enderror" aria-label="Default select">
                                                        <option value="">Select</option>
                                                        @foreach ($levels as $item)
                                                            <option value="{{ $item['id'] }}" data-code="{{ $item['code'] }}" {{ old('level') == $item['id'] ? 'selected':'' }}>{{ $item['code'] }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('level')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-lg-3 mb-2" id="divSerie" style="display: none">
                                                    <label for="serie" class="form-label">Série<span class="text-danger">*</span> :</label>
                                                    <select name="serie"  id="serie" class="form-select @error('serie') is-invalid @enderror" data-placeholder="Choose one thing">
                                                        <option value="">Select</option>
                                                    </select>
                                                    @error('serie')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-lg-3 mb-2" id="divLv2" style="display: none">
                                                    <label for="lv2" class="form-label">LV2<span class="text-danger">*</span> :</label>
                                                    <select name="lv2"  id="lv2" class="form-select @error('lv2') is-invalid @enderror" data-placeholder="Choose one thing">
                                                        <option value="">Select</option>
                                                        <option value="allemand">Allemand</option>
                                                        <option value="espagnol">Espagnol</option>
                                                    </select>
                                                    @error('lv2')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-6 col-lg-3 mb-2" id="divClass" style="display: none">
                                                    <label for="classe" class="form-label">Classe<span class="text-danger">*</span> :</label>
                                                    <select name="classe" id="classe" class="form-select @error('classe') is-invalid @enderror" aria-label="Default select">
                                                        <!-- Add Classe -->
                                                    </select>
                                                    @error('classe')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                
                                                <div class="col-12">
                                                    <div class="d-flex align-items-center gap-3" style="float: right">
                                                        <button type="button" class="btn btn-light px-4" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2'></i>Previous</button>
                                                        <button type="submit" class="btn btn-light px-4 button" data-type="6" onclick="stepper1.next()">Valider<i class='bx bx-right-arrow-alt ms-2'></i></button>
                                                    </div>
                                                </div>
                                            </div><!---end row-->
                                            
                                        </div>
                                    </form>
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
<script src="{{ asset('assets/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bs-stepper/js/main.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.number').on('keypress', function(e) {
            var charCode = e.which ? e.which : e.keyCode;
            if (charCode < 48 || charCode > 57) {
                e.preventDefault();
            }
        });


        // Gestion des buttons -------------
        $('.button').on('click', function() {
            $type = $(this).data('type');
            if($type == 1){
                $val = $('input[name="parent"]:checked').val();
                if($val == 'pere'){
                    getValFather();
                }
                else if($val == 'mere'){
                    getValMother();
                }
            }
            else if($type == 6){
                $('#myForm').submit();
            }
        });


        // Change Val Level ----------------
        $('#level').on('change', function() {
            $('#divSerie, #divLv2, #divClass').hide(200);
            $('#lv2 option[value=""]').prop('selected', true);
            $level = $(this).val();
            if($level > 4){
                $code = this.options[this.selectedIndex].dataset.code;
                getSerie($code);
            }
            else if($.inArray($level, ['3', '4']) !== -1){
                $('#divLv2').show(200);
            }
            else{
                getClasseLevel({level: $level});
            }
        });


        // Change Val Serie ------------
        $('#serie').on('change', function() {
            $('#divLv2, #divClass').hide(200);
            $('.option').remove();
            $('#lv2 option[value=""]').prop('selected', true);
            $val = $(this).val(); $level = $("#level").val();
            if(($.inArray($level, ['6', '7']) !== -1) && ($.inArray($val, ['4', '5']) !== -1)){
                $('#divLv2').hide(200);
                getClasseLevel({level: $level, serie: $val});
            }
            else{
                if($.inArray($val, ['1', '2', '3', '4']) !== -1){
                $('#divLv2').show(200)
                }
                else{
                    $('#divLv2').hide(200);
                }
            }
        });


        // Change Val Lv2 ----------------
        $('#lv2').on('change', function() {
            $val = $(this).val(); $level = $("#level").val(); $serie = $('#serie').val();
            if($serie){
                getClasseLevel({level: $level, lv2: $val, serie: $serie});
            }
            else if($val){
                getClasseLevel({level: $level, lv2: $val});
            }
            else{
                $('#divClass').hide(200);
            }
        });

        // Verification du matricule ---------------------------
        $('#matricule').on('keyup', function() {
            if(($(this).val()).length == 9){
                $.ajax({
                    url: "{{ route('ajax.matricule') }}",
                    method: "GET",
                    data: { mtls: $(this).val() },
                    dataType: "json",
                    success: function(dts) {
                        dts == 200 ? $('#mtls').show():$('#mtls').hide();
                    }
                });
            }
        });


        $('#phon1, #phon2').on('keyup', function() {
            if(($(this).val()).length == 10){
                $.ajax({
                    url: "{{ route('ajax.phon') }}",
                    method: "GET",
                    data: { phon: $(this).val() },
                    dataType: "json",
                    success: function(dts) {
                        if(dts.status == 200){
                            $('#existPts').show();
                            $('#phon1').val(dts.data['phon1']);
                            $('#phon2').val(dts.data['phon2']);
                            $('#nameFirstParent').val(dts.data['first']);
                            $('#nameLastParent').val(dts.data['last']);
                            $('#profesionParent').val(dts.data['profession']);
                            $('#email').val(dts.data['email']);
                        }
                        else{
                            $('#existPts').hide();
                            $('#phon1').val();
                            $('#phon2').val();
                            $('#nameFirstParent').val();
                            $('#nameLastParent').val();
                            $('#profesionParent').val();
                            $('#email').val();
                        }
                    }
                });
            }
        });


        // Search Nationality ------------------
        $('#nationalite').on('keyup', function() {
            if(($(this).val()).length >= 3){
                $.ajax({
                    url: "{{ route('ajax.natiolity') }}",
                    method: "GET",
                    data: { val: $(this).val() },
                    dataType: "json",
                    success: function(dts) {
                        if(dts.status == 200){
                           $(this).val(dts.data['libelle']);
                        }
                    }
                });
            }
        });


        //  Function -----------------
        function getClasseLevel({level, lv2 = null, serie = null}){
            $.ajax({
                url: "{{ route('ajax.classe') }}",
                method: "GET",
                data: {
                    level: level,
                    lv2: lv2 ?? null,
                    serie: serie ?? null
                },
                dataType: "json",
                success: function(dts) {
                    $('.option').remove();
                    $('#divClass').show(200);
                    if(dts.status == 200){
                        $data = dts.data;
                        $i = 0;
                        while($i < $data.length){
                            $('#classe').css('border', '1px solid rgb(255 255 255 / 15%)');
                            $('#classe').append('<option value="'+$data[$i].id+'" class="option">'+$data[$i].libelle+'</option>');
                            $i++;
                        }
                    }
                    else{
                        $('#classe').css('border', '1px solid red');
                        $('#classe').append('<option value="" class="option">Classe non disponible ...</option>');
                    }
                }
            });
        }

        function getSerie($value){
            $.ajax({
                url: "{{ route('ajax.serie') }}",
                method: "GET",
                data: { code: $value },
                dataType: "json",
                success: function(dts) {
                    $('.serie').remove();
                    if(dts.status == 200){
                        $('#divSerie').show(200);
                        $data = dts.data;
                        $i = 0;
                        while($i < $data.length){
                            $('#serie').append(`<option class="serie" value="`+$data[$i].id+`">`+$data[$i].libelle+`</option>`);
                            $i++;
                        }
                    }
                }
            });
        }


        function getValFather(){
            $('#pereNameFirst').val($('#nameFirstParent').val());
            $('#pereNameLast').val($('#nameLastParent').val());
            $('#profPere').val($('#profesionParent').val());
            $('#phonPere').val($('#phon1').val());
        }

        function getValMother(){
            $('#mereNameFirst').val($('#nameFirstParent').val());
            $('#mereNameLast').val($('#nameLastParent').val());
            $('#profMere').val($('#profesionParent').val());
            $('#phonMere').val($('#phon1').val());
        }
    });
</script>
@endsection