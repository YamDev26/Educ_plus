@extends('app')
@section('title', 'create school')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-0 mb-0" style="border: none">
                    <h5 class="mb-0">{{ $school ? 'Edit':'Add' }} Information School</h5>
                    <div class="group-btn">
                        <a href="{{ route('school.index') }}" class="btn btn-outline-light py-1 mb-1" style="font-size: 12px; border-radius: 2px">Back</a>
                    </div>
                </div>
                <hr class="mt-0 mx-3">
                <div class="card-body p-4">
                    @include('partials._alert')
                    <div class="form-body">
                        <form action="{{ route($school ? 'school.update':'school.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label class="form-label" for="codeSchool">Code Etablissement<span class="text-danger">*</span> :</label>
                                        <input type="text" name="codeSchool" class="form-control @error('codeSchool') is-invalid @enderror" id="codeSchool" value="{{ old('codeSchool', $school ? $school->code:'') }}" placeholder="Code Etablissement" style="border-radius: 5px">
                                        @error('codeSchool')
                                            <span class="form-bar text-danger" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="nomSchool">Nom Etablissement<span class="text-danger">*</span> :</label>
                                        <input type="text" name="nomSchool" class="form-control @error('nomSchool') is-invalid @enderror" id="nomSchool" value="{{ old('nomSchool', $school ? ucwords($school->name):'') }}" placeholder="Nom Etablissement" style="border-radius: 5px">
                                        @error('nomSchool')
                                            <span class="form-bar text-danger" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="nomAbrege">Nom Abrégé Etablissement :</label>
                                        <input type="text" name="nomAbrege" class="form-control @error('nomAbrege') is-invalid @enderror" id="nomAbrege" value="{{ old('nomAbrege', $school ? strtoupper($school->abrege):'') }}" placeholder="Nom Abrégé Etablissement" style="border-radius: 5px">
                                        @error('nomAbrege')
                                            <span class="form-bar text-danger" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="statutSchool">Statut Juridique<span class="text-danger">*</span> :</label><br>
                                                <span>
                                                    <input type="radio" name="statut" id="prive" value="prive" class="form-check-input" {{$school ? ($school->statut == 'prive' ? 'checked':''):'checked'}} {{ old('statut') == 'prive' ? 'checked':''}}>
                                                    <label class="form-check-label" for="prive">Privé</label>
                                                </span><span class="mx-1"></span>
                                                <span class="mx-2">
                                                    <input type="radio" name="statut" id="public" value="public" class="form-check-input" {{$school ? ($school->statut == 'public' ? 'checked':''):''}} {{ old('statut') == 'public' ? 'checked':''}}>
                                                    <label class="form-check-label" for="public">Public</label>
                                                </span> <br>
                                                @error('statut')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                                
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Enseignement<span class="text-danger">*</span> :</label> <br>
                                                <span>
                                                    <input type="checkbox" name="college" id="college" value="college" class="form-check-input" {{$school ? ($school->college ? 'checked':null):'checked'}} {{ old('college') == 'college' ? 'checked':'' }}>
                                                    <label class="form-check-label" for="college">Collège</label>
                                                </span><span class="mx-1"></span>
                                                <span class="mx-2">
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
                                    <div class="mb-3">
                                        <label class="form-label" for="drenSchool">DREN / DDEN<span class="text-danger">*</span> :</label>
                                        <input type="text" name="drenSchool" class="form-control @error('drenSchool') is-invalid @enderror" id="drenSchool" value="{{ old('drenSchool', $school ? ucwords($school->dren):'') }}" placeholder="DREN / DDEN" style="border-radius: 5px">
                                        @error('drenSchool')
                                            <span class="form-bar text-danger" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="villeSchool">Ville Etablissement<span class="text-danger">*</span> :</label>
                                        <input type="text" name="villeSchool" class="form-control @error('villeSchool') is-invalid @enderror" id="villeSchool" value="{{ old('villeSchool', $school ? ucwords($school->ville):'') }}" placeholder="Ville Etablissement" style="border-radius: 5px">
                                        @error('villeSchool')
                                            <span class="form-bar text-danger" role="alert">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div>
                                    
                                </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="border border-3 p-4 pb-2 rounded">
                                        <div class="mb-3">
                                            <label class="form-label" for="boitePostale">Boîte Postale :</label>
                                            <input type="text" name="boitePostale" id="boitePostale" class="form-control @error('boitePostale') is-invalid @enderror" value="{{ old('boitePostale', $school ? $school->postale:'') }}" placeholder="Boîte Postale Etablissement" style="border-radius: 5px">
                                            @error('boitePostale')
                                                <span class="form-bar text-danger" role="alert">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="emailSchool">Adresse Email<span class="text-danger">*</span> :</label>
                                            <input type="email" name="emailSchool" id="emailSchool" class="form-control @error('emailSchool') is-invalid @enderror" value="{{ old('emailSchool', $school ? $school->email:'') }}" placeholder="Adresse Email Etablissement" style="border-radius: 5px">
                                            @error('emailSchool')
                                                <span class="form-bar text-danger" role="alert">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="numSchool">Numéro Téléphone<span class="text-danger">*</span> :</label>
                                            <input type="text" name="numSchool" id="numSchool" class="form-control @error('numSchool') is-invalid @enderror" value="{{ old('numSchool', $school ? $school->numero:'') }}" placeholder="Numéro Téléphone Etablissement" style="border-radius: 5px">
                                            @error('numSchool')
                                                <span class="form-bar text-danger" role="alert">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group mx-1 mb-3">
                                            <label class="form-label" for="create">Date de création<span class="text-danger">*</span> :</label>
                                            <input type="date" name="create" id="create" class="form-control @error('create') is-invalid @enderror" value="{{ old('create', $school ? $school->created:'') }}" style="border-radius: 5px">      
                                            @error('create')
                                                <span class="form-bar text-danger" role="alert">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mx-1 mb-3">
                                            <label class="form-label" for="ouverture">Date d'ouverture<span class="text-danger">*</span> :</label>
                                            <input type="date" name="ouverture" id="ouverture" class="form-control @error('ouverture') is-invalid @enderror" value="{{ old('ouverture', $school ? $school->opened:'') }}" style="border-radius: 5px">      
                                            @error('ouverture')
                                                <span class="form-bar text-danger" role="alert">
                                                    {{$message}}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group mb-3 pt-md-3">
                                                    <label class="form-label" for="bibliotheque">Gestion Caisse<span class="text-danger">*</span> :</label><br>
                                                    <span>
                                                        <input type="radio" name="paiement" class="form-check-input" id="ouiPaye" value="oui" {{$school ? ($school->paiement ? 'checked':''):'checked'}} {{ old('paiement') == 'oui' ? 'checked':''}}>
                                                        <label class="form-check-label" for="ouiPaye">Oui</label>
                                                    </span>
                                                    <span class="mx-2">
                                                        <input type="radio" name="paiement" class="form-check-input" id="nonPaye" value="non" {{$school ? ($school->paiement ? '':'checked'):''}} {{ old('paiement') == 'non' ? 'checked':''}}>
                                                        <label class="form-check-label" for="nonPaye">Non</label>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group mx-1 mb-3">
                                                    <label class="form-label" for="fichier">Logo Etablissement :</label>
                                                    <input type="file" name="fichier" class="form-control @error('fichier') is-invalid @enderror" id="fichier" aria-describedby="inputGroupFileAddon04" aria-label="Upload" style="border-radius: 5px">
                                                    @error('fichier')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 my-3 text-center">
                                <button type="submit" class="btn btn-outline-light w-25">Valider ...</button>
                            </div>
                        </form>
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
            $('#numSchool, #nbreClasse').on('keypress', function(e) {
                var charCode = e.which ? e.which : e.keyCode;
                if (charCode < 48 || charCode > 57) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection