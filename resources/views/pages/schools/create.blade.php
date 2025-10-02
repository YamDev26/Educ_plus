@extends('app')
@section('title', 'create school')
@section('content')
<div class="row mt-5 mt-lg-0 mt-xl-5 mt-xxl-0">
<div class="col-xl-12 h-100">
    <div class="card theme-wizard mb-5 mb-lg-0 mb-xl-5 mb-xxl-0 h-100">
        <div class="card-header bg-body-tertiary pt-3 pb-2">
            <div class="d-flex mb-0">
                <span class="fa-stack me-2 ms-n1">
                    <svg class="svg-inline--fa fa-circle fa-w-16 fa-stack-2x text-300" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                    </svg>
                    <svg class="svg-inline--fa fa-tasks fa-w-16 fa-inverse fa-stack-1x text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="tasks" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                        <path fill="currentColor" d="M139.61 35.5a12 12 0 0 0-17 0L58.93 98.81l-22.7-22.12a12 12 0 0 0-17 0L3.53 92.41a12 12 0 0 0 0 17l47.59 47.4a12.78 12.78 0 0 0 17.61 0l15.59-15.62L156.52 69a12.09 12.09 0 0 0 .09-17zm0 159.19a12 12 0 0 0-17 0l-63.68 63.72-22.7-22.1a12 12 0 0 0-17 0L3.53 252a12 12 0 0 0 0 17L51 316.5a12.77 12.77 0 0 0 17.6 0l15.7-15.69 72.2-72.22a12 12 0 0 0 .09-16.9zM64 368c-26.49 0-48.59 21.5-48.59 48S37.53 464 64 464a48 48 0 0 0 0-96zm432 16H208a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h288a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-320H208a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h288a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 160H208a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h288a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z"></path>
                    </svg>
                </span>
                <div class="col">
                    <h5 class="mb-0 text-primary position-relative">
                        <span class="dark__bg-1100 pe-3">{{ $school ? 'Edite':'Create' }} School</span>
                        <a href="{{ route('school.index') }}" class="btn btn-falcon-default btn-sm mb-2" style="float: right">Back</a>
                    </h5>
                    <p class="m-0" style="font-size: 13px">Les Champs Avec Astérisque <span class="text-danger">*</span> Sont Obligatoires.</p>
                </div>
            </div>
            <hr class="mt-0">
            <ul class="nav nav-pills mb-3" role="tablist" id="pill-tab2">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-wizard-step="1" data-bs-toggle="pill" data-bs-target="#form-wizard-progress-tab1" type="button" role="tab" aria-controls="form-wizard-progress-tab1" aria-selected="true">
                        <span class="d-none d-md-inline-block fs-10">Etape 1</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-wizard-step="2" data-bs-toggle="pill" data-bs-target="#form-wizard-progress-tab2" type="button" role="tab" aria-controls="form-wizard-progress-tab2" aria-selected="false" tabindex="-1">
                        <span class="d-none d-md-inline-block fs-10">Etape 2</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-wizard-step="3" data-bs-toggle="pill" data-bs-target="#form-wizard-progress-tab3" type="button" role="tab" aria-controls="form-wizard-progress-tab3" aria-selected="false" tabindex="-1">
                        <span class="d-none d-md-inline-block fs-10">Etape 3</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" data-wizard-step="4" data-bs-toggle="pill" data-bs-target="#form-wizard-progress-tab4" type="button" role="tab" aria-controls="form-wizard-progress-tab4" aria-selected="false" tabindex="-1">
                        <span class="d-none d-md-inline-block fs-10">Etape 4</span>
                    </button>
                </li>
            </ul>
        </div>
        <div class="progress" role="progressbar" style="height: 2px;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar"></div>
        </div>
        <div class="card-body py-4">
            <form action="{{ route($school ? 'school.update':'school.store') }}" method="post" enctype="multipart/form-data">
                <div class="tab-content">
                    @csrf
                    <div class="tab-pane active px-sm-3 px-md-5" role="tabpanel" aria-labelledby="form-wizard-progress-tab1" id="form-wizard-progress-tab1">
                        <div novalidate="novalidate" data-wizard-form="1">
                            <div class="mb-3">
                                <label class="form-label" for="codeSchool">Code Etablissement<span class="text-danger">*</span> :</label>
                                <input type="text" name="codeSchool" class="form-control @error('codeSchool') is-invalid @enderror" id="codeSchool" value="{{ old('codeSchool', $school ? $school->code:'') }}" placeholder="Code Etablissement">
                                @error('codeSchool')
                                    <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="nomSchool">Nom Etablissement<span class="text-danger">*</span> :</label>
                                <input type="text" name="nomSchool" class="form-control @error('nomSchool') is-invalid @enderror" id="nomSchool" value="{{ old('nomSchool', $school ? ucwords($school->name):'') }}" placeholder="Nom Etablissement">
                                @error('nomSchool')
                                    <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="nomAbrege">Nom Abrégé Etablissement :</label>
                                <input type="text" name="nomAbrege" class="form-control @error('nomAbrege') is-invalid @enderror" id="nomAbrege" value="{{ old('nomAbrege', $school ? strtoupper($school->abrege):'') }}" placeholder="Nom Abrégé Etablissement">
                                @error('nomAbrege')
                                    <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="statutSchool">Statut Juridique<span class="text-danger">*</span> :</label>
                                <select name="statut" class="form-select @error('statut') is-invalid @enderror" aria-label="Default select example">
                                    <option value="">Select one option ...</option>
                                    <option value="prive" {{$school ? ($school->statut == 'prive' ? 'selected':null):null}} {{old('statut') == 'prive' ? 'selected':''}}>Prive</option>
                                    <option value="public" {{$school ? ($school->statut == 'public' ? 'selected':null):null}} {{old('statut') == 'public' ? 'selected':''}}>Public</option>
                                </select>
                                @error('statut')
                                    <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div>
                                <label class="form-label">Enseignement<span class="text-danger">*</span> :</label>
                                <span>
                                    <input type="checkbox" name="college" id="college" value="college" class="form-check-input" {{$school ? ($school->college ? 'checked':null):'checked'}} {{ old('college') == 'college' ? 'checked':'' }}>
                                    <label class="form-check-label" for="college">Collège</label>
                                </span><span class="mx-1"></span>
                                <span>
                                    <input type="checkbox" name="lycee" id="lycee" value="lycee" class="form-check-input" {{$school ? ($school->lycee ? 'checked':null):'checked'}} {{ old('lycee') == 'lycee' ? 'checked':'' }}>
                                    <label class="form-check-label" for="lycee">Lycée</label>
                                </span>
                                @error('statut')
                                    <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane px-sm-3 px-md-5" role="tabpanel" aria-labelledby="form-wizard-progress-tab2" id="form-wizard-progress-tab2">
                        <div data-wizard-form="2">
                            <div class="mb-3">
                                <label class="form-label" for="drenSchool">DREN / DDEN<span class="text-danger">*</span> :</label>
                                <input type="text" name="drenSchool" class="form-control @error('drenSchool') is-invalid @enderror" id="drenSchool" value="{{ old('drenSchool', $school ? ucwords($school->dren):'') }}" placeholder="DREN / DDEN">
                                @error('drenSchool')
                                    <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="villeSchool">Ville Etablissement<span class="text-danger">*</span> :</label>
                                <input type="text" name="villeSchool" class="form-control @error('villeSchool') is-invalid @enderror" id="villeSchool" value="{{ old('villeSchool', $school ? ucwords($school->ville):'') }}" placeholder="Ville Etablissement">
                                @error('villeSchool')
                                    <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="boitePostale">Boîte Postale :</label>
                                <input type="text" name="boitePostale" id="boitePostale" class="form-control @error('boitePostale') is-invalid @enderror" value="{{ old('boitePostale', $school ? $school->postale:'') }}" placeholder="Boîte Postale Etablissement">
                                @error('boitePostale')
                                    <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="emailSchool">Adresse Email<span class="text-danger">*</span> :</label>
                                <input type="email" name="emailSchool" id="emailSchool" class="form-control @error('emailSchool') is-invalid @enderror" value="{{ old('emailSchool', $school ? $school->email:'') }}" placeholder="Adresse Email Etablissement">
                                @error('emailSchool')
                                    <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="numSchool">Numéro Téléphone<span class="text-danger">*</span> :</label>
                                <input type="text" name="numSchool" id="numSchool" class="form-control @error('numSchool') is-invalid @enderror" value="{{ old('numSchool', $school ? $school->numero:'') }}" placeholder="Numéro Téléphone Etablissement">
                                @error('numSchool')
                                    <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane px-sm-3 px-md-5" role="tabpanel" aria-labelledby="form-wizard-progress-tab3" id="form-wizard-progress-tab3">
                        <div class="form-validation" data-wizard-form="2">
                            <div class="mb-3">
                               <label class="form-label" for="create">Date de création<span class="text-danger">*</span> :</label>
                                <input type="date" name="create" id="create" class="form-control @error('create') is-invalid @enderror" value="{{ old('create', $school ? $school->create:'') }}">      
                                @error('create')
                                    <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                               <label class="form-label" for="ouverture">Date d'ouverture<span class="text-danger">*</span> :</label>
                                <input type="date" name="ouverture" id="ouverture" class="form-control @error('ouverture') is-invalid @enderror" value="{{ old('ouverture', $school ? $school->ouverture:'') }}">      
                                @error('ouverture')
                                    <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="nbreClasse">Nombre de salle de Classe<span class="text-danger">*</span> :</label>
                                <input type="text" name="nbreClasse" id="nbreClasse" class="form-control @error('nbreClasse') is-invalid @enderror" value="{{ old('nbreClasse', $school ? $school->classe:'') }}" placeholder="Nombre de salle de classe">
                                @error('nbreClasse')
                                    <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="row gx-2">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="bibliotheque">Bibliothèque<span class="text-danger">*</span> :</label><br>
                                        <span>
                                            <input type="radio" name="bibliotheque" class="form-check-input" id="oui" value="oui" {{$school ? ($school->bibliotheque ? 'checked':''):'checked'}} {{ old('bibliotheque') == 'oui' ? 'checked':''}}>
                                            <label class="form-check-label" for="oui">Oui</label>
                                        </span>
                                        <span class="mx-1"></span>
                                        <span>
                                            <input type="radio" name="bibliotheque" class="form-check-input" id="non" value="non" {{$school ? ($school->bibliotheque ? '':'checked'):''}} {{ old('bibliotheque') == 'non' ? 'checked':''}}>
                                            <label class="form-check-label" for="non">Non</label>
                                        </span><br>
                                        @error('bibliotheque')
                                            <span class="form-bar text-danger" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="bibliotheque">Labo Physique chimie<span class="text-danger">*</span> :</label><br>
                                        <span>
                                            <input type="radio" name="physChim" class="form-check-input" id="ouiPC" value="oui" {{$school ? ($school->phis_chim ? 'checked':''):'checked'}} {{ old('physChim') == 'oui' ? 'checked':''}}>
                                            <label class="form-check-label" for="ouiPC">Oui</label>
                                        </span>
                                        <span class="mx-1"></span>
                                        <span>
                                            <input type="radio" name="physChim" class="form-check-input" id="nonPC" value="non" {{$school ? ($school->phis_chim ? '':'checked'):''}} {{ old('physChim') == 'non' ? 'checked':''}}>
                                            <label class="form-check-label" for="nonPC">Non</label>
                                        </span><br>
                                        @error('physChim')
                                            <span class="form-bar text-danger" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="bibliotheque">Labo SVT<span class="text-danger">*</span> :</label><br>
                                        <span>
                                            <input type="radio" name="svt" class="form-check-input" id="ouiSvt" value="oui" {{$school ? ($school->svt ? 'checked':''):'checked'}} {{ old('svt') == 'oui' ? 'checked':''}}>
                                            <label class="form-check-label" for="ouiSvt">Oui</label>
                                        </span>
                                        <span class="mx-1"></span>
                                        <span>
                                            <input type="radio" name="svt" class="form-check-input" id="nonSvt" value="non" {{$school ? ($school->svt ? '':'checked'):''}} {{ old('svt') == 'non' ? 'checked':''}}>
                                            <label class="form-check-label" for="nonSvt">Non</label>
                                        </span><br>
                                        @error('svt')
                                            <span class="form-bar text-danger" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="bibliotheque">Salle Informatique<span class="text-danger">*</span> :</label><br>
                                        <span>
                                            <input type="radio" name="info" class="form-check-input" id="ouiInfo" value="oui" {{$school ? ($school->informatique ? 'checked':''):'checked'}} {{ old('info') == 'oui' ? 'checked':''}}>
                                            <label class="form-check-label" for="ouiInfo">Oui</label>
                                        </span>
                                        <span class="mx-1"></span>
                                        <span>
                                            <input type="radio" name="info" class="form-check-input" id="nonInfo" value="non" {{$school ? ($school->informatique ? '':'checked'):''}} {{ old('info') == 'non' ? 'checked':''}}>
                                            <label class="form-check-label" for="nonInfo">Non</label>
                                        </span><br>
                                        @error('info')
                                            <span class="form-bar text-danger" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row gx-2">
                                <div class="col-md-3">
                                    <div class="mb-3" title="Musique/Art plastique">
                                        <label class="form-label" for="bibliotheque">Mus/AP<span class="text-danger">*</span> :</label><br>
                                        <span>
                                            <input type="radio" name="musAp" class="form-check-input" id="musApOui" value="oui" {{$school ? ($school->musi_art_pl ? 'checked':''):'checked'}} {{ old('musAp') == 'oui' ? 'checked':''}}>
                                            <label class="form-check-label" for="musApOui">Oui</label>
                                        </span>
                                        <span class="mx-1"></span>
                                        <span>
                                            <input type="radio" name="musAp" class="form-check-input" id="musApNon" value="non" {{$school ? ($school->musi_art_pl ? '':'checked'):''}} {{ old('musAp') == 'non' ? 'checked':''}}>
                                            <label class="form-check-label" for="musApNon">Non</label>
                                        </span><br>
                                        @error('musAp')
                                            <span class="form-bar text-danger" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="bibliotheque">Cantine Elève<span class="text-danger">*</span> :</label><br>
                                        <span>
                                            <input type="radio" name="cantine" class="form-check-input" id="ouiCant" value="oui" {{$school ? ($school->cantine ? 'checked':''):'checked'}} {{ old('cantine') == 'oui' ? 'checked':''}}>
                                            <label class="form-check-label" for="ouiCant">Oui</label>
                                        </span>
                                        <span class="mx-1"></span>
                                        <span>
                                            <input type="radio" name="cantine" class="form-check-input" id="nonCant" value="non" {{$school ? ($school->cantine ? '':'checked'):''}} {{ old('cantine') == 'non' ? 'checked':''}}>
                                            <label class="form-check-label" for="nonCant">Non</label>
                                        </span><br>
                                        @error('cantine')
                                            <span class="form-bar text-danger" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label" for="bibliotheque">Bus Elève<span class="text-danger">*</span> :</label><br>
                                        <span>
                                            <input type="radio" name="bus" class="form-check-input" id="ouiBus" value="oui" {{$school ? ($school->bus ? 'checked':''):'checked'}} {{ old('bus') == 'oui' ? 'checked':''}}>
                                            <label class="form-check-label" for="ouiBus">Oui</label>
                                        </span>
                                        <span class="mx-1"></span>
                                        <span>
                                            <input type="radio" name="bus" class="form-check-input" id="nonSvt" value="non" {{$school ? ($school->bus ? '':'checked'):''}} {{ old('bus') == 'non' ? 'checked':''}}>
                                            <label class="form-check-label" for="nonBus">Non</label>
                                        </span><br>
                                        @error('bus')
                                            <span class="form-bar text-danger" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div>
                                        <label class="form-label" for="bibliotheque">Gestion Payement<span class="text-danger">*</span> :</label><br>
                                        <span class="mr-3">
                                            <input type="radio" name="paiement" class="form-check-input" id="ouiPaye" value="oui" {{$school ? ($school->caisse ? 'checked':''):'checked'}} {{ old('paiement') == 'oui' ? 'checked':''}}>
                                            <label class="form-check-label" for="ouiPaye">Oui</label>
                                        </span>
                                        <span class="mx-1"></span>
                                        <span>
                                            <input type="radio" name="paiement" class="form-check-input" id="nonPaye" value="non" {{$school ? ($school->caisse ? '':'checked'):''}} {{ old('paiement') == 'non' ? 'checked':''}}>
                                            <label class="form-check-label" for="nonPaye">Non</label>
                                        </span><br>
                                        @error('paiement')
                                            <span class="form-bar text-danger" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane px-sm-3 px-md-5" role="tabpanel" aria-labelledby="form-wizard-progress-tab4" id="form-wizard-progress-tab4">
                        <div class="my-3">
                            <div class="row">
                                <div class="col-12 col-sm-3 text-right">
                                    @if ($school)
                                        <img class="my-3" src="{{asset($school->logoUrl())}}" alt="Logo Etablissement" style="width: 50px; height: 50px; border-radius: 5px; float: right; border: 1px solid">
                                    @endif
                                </div>
                                <div class="col-12 col-sm-7">
                                    <label class="form-label text-left" for="customFile">Logo Etablissement :</label>
                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" id="customFile">
                                </div>
                                @error('image')
                                    <span class="form-bar text-danger" role="alert">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary px-5 my-3">Validation</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer bg-body-tertiary">
            <div class="px-sm-3 px-md-5">
                <ul class="pager wizard list-inline mb-0">
                    <li class="previous">
                        <button class="btn btn-primary pr-0">
                            <svg class="svg-inline--fa fa-chevron-left fa-w-10 me-2" data-fa-transform="shrink-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="" style="transform-origin: 0.3125em 0.5em;"><g transform="translate(160 256)"><g transform="translate(0, 0)  scale(0.8125, 0.8125)  rotate(0 0 0)">
                                <path fill="currentColor" d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z" transform="translate(-160 -256)"></path></g></g>
                            </svg>Prev
                        </button>
                    </li>
                    <li class="next">
                        <button class="btn btn-primary pr-0">
                            Next
                            <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-2" data-fa-transform="shrink-3" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="" style="transform-origin: 0.3125em 0.5em;"><g transform="translate(160 256)"><g transform="translate(0, 0)  scale(0.8125, 0.8125)  rotate(0 0 0)">
                                <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" transform="translate(-160 -256)"></path></g></g>
                            </svg>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#numSchool, #nbreClasse').on('keypress', function(e) {
                var charCode = e.which ? e.which : e.keyCode;
                if (charCode < 48 || charCode > 57) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection