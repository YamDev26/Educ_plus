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
                    <h5 class="mb-0">Gestion Des Elèves</h5>
                    <span style="float: right; ">
                        <a href="{{ route('student.create') }}" class="btn btn-outline-light py-1 mb-1" style="font-size: 12px; border-radius: 2px">Add</a>
                        <a href="{{ route('classe.index') }}" class="btn btn-outline-light py-1 mb-1" style="font-size: 12px; border-radius: 2px">Back</a>
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
                                <form onSubmit="return false">
                                    <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                                        <h5 class="mb-1">Your Personal Information</h5>
                                        <p class="mb-4">Enter your personal information to get closer to copanies</p>

                                        <div class="row g-3 p-2">
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label class="form-label">Parent d'élève<span class="text-danger">*</span> :</label>
                                                <div class="row">
                                                    <div class="col-lg-7 col-12">
                                                        <div class="d-flex justify-content-around">
                                                            <span class="form-check">
                                                                <input name="parent" class="form-check-input" type="radio" id="pere" checked>
                                                                <label class="form-check-label" for="pere">Père</label>
                                                            </span>
                                                            <span class="form-check">
                                                                <input name="parent" class="form-check-input" type="radio" id="mere">
                                                                <label class="form-check-label" for="mere">Mère</label>
                                                            </span>
                                                            <span class="form-check">
                                                                <input name="parent" class="form-check-input" type="radio" id="tuteur">
                                                                <label class="form-check-label" for="tuteur">Tuteur</label>
                                                            </span>
                                                            <span class="form-check">
                                                                <input name="parent" class="form-check-input" type="radio" id="tutrice">
                                                                <label class="form-check-label" for="tutrice">Tutrice</label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
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
                                                <input type="text" name="nameFirstParent" id="nameFirstParent" class="form-control @error('nameFirstParent') is-invalid @enderror" value="{{ old('nameFirstParent') }}" placeholder="Entrez le nom parent d'élève ...">
                                                @error('nameFirstParent')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="nameLastParent" class="form-label">Prénoms Parent<span class="text-danger">*</span> :</label>
                                                <input type="text" name="nameLastParent" id="nameLastParent" class="form-control @error('nameLastParent') is-invalid @enderror" value="{{ old('nameLastParent') }}" placeholder="Entrez le prenoms parent d'élève ...">
                                                @error('nameLastParent')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="profesionParent" class="form-label">Profession Parent<span class="text-danger">*</span> :</label>
                                                <input type="text" name="profesionParent" id="profesionParent" class="form-control @error('profesionParent') is-invalid @enderror" value="{{ old('profesionParent') }}" placeholder="Entrez le profession parent d'élève ...">
                                                @error('profesionParent')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="emal" class="form-label">Adresse Email Parent :</label>
                                                <input type="email" name="email" id="emal" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Entrez l'adresse Email parent d'élève ...">
                                                @error('email')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <div style="float: right">
                                                    <button type="button" class="btn btn-light px-4" onclick="stepper1.next()">Next<i class='bx bx-right-arrow-alt ms-2'></i></button>
                                                </div>
                                            </div>
                                        </div><!---end row-->
                                        
                                    </div>

                                    <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                                        <h5 class="mb-1">Account Details</h5>
                                        <p class="mb-4">Enter Your Account Details.</p>

                                        <div class="row g-3">
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="matricule" class="form-label">Matricule Elève<span class="text-danger">*</span> :</label>
                                                <input type="text" name="matricule" id="matricule" class="form-control @error('matricule') is-invalid @enderror" value="{{ old('matricule') }}" placeholder="Entrez le matricule de l'élève ...">
                                                @error('matricule')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="genre" class="form-label">Genre Elève<span class="text-danger">*</span> :</label>
                                                <select name="genre" id="genre" class="form-select @error('genre') is-invalid @enderror" aria-label="Default select">
                                                    <option value="">---</option>
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
                                                <label for="firstName" class="form-label">Nom Elève<span class="text-danger">*</span> :</label>
                                                <input type="text" name="firstName" id="firstName" class="form-control @error('firstName') is-invalid @enderror" value="{{ old('firstName') }}" placeholder="Entrez le nom de l'élève ...">
                                                @error('firstName')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="lastName" class="form-label">Prenoms Elève<span class="text-danger">*</span> :</label>
                                                <input type="text" name="lastName" id="lastName" class="form-control @error('lastName') is-invalid @enderror" value="{{ old('lastName') }}" placeholder="Entrez le prenoms de l'élève ...">
                                                @error('lastName')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="dateNaiss" class="form-label">Date de naissance<span class="text-danger">*</span> :</label>
                                                <input type="date" name="dateNaiss" id="dateNaiss" class="form-control @error('dateNaiss') is-invalid @enderror" value="{{ old('dateNaiss') }}" placeholder="Entrez la date de naissance de l'élève ...">
                                                @error('dateNaiss')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="lieuNaiss" class="form-label">Lieu de naissance<span class="text-danger">*</span> :</label>
                                                <input type="text" name="lieuNaiss" id="lieuNaiss" class="form-control @error('lieuNaiss') is-invalid @enderror" value="{{ old('lieuNaiss') }}" placeholder="Entrez le lieu de naissance de l'élève ...">
                                                @error('lieuNaiss')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="nationalite" class="form-label">Nationalité<span class="text-danger">*</span> :</label>
                                                <input type="text" name="nationalite" id="nationalite" class="form-control @error('nationalite') is-invalid @enderror" value="{{ old('nationalite') }}" placeholder="Entrez la nationalité de l'élève ...">
                                                @error('nationalite')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="residence" class="form-label">Résidence<span class="text-danger">*</span> :</label>
                                                <input type="text" name="residence" id="residence" class="form-control @error('residence') is-invalid @enderror" value="{{ old('residence') }}" placeholder="Entrez la résidence de l'élève ...">
                                                @error('residence')
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
                                                <label for="pereNameFirst" class="form-label">Nom du père<span class="text-danger">*</span> :</label>
                                                <input type="text" name="pereNameFirst" id="pereNameFirst" class="form-control  @error('pereNameFirst') is-invalid @enderror" value="{{ old('pereNameFirst') }}" placeholder="Entrez le nom du père biologie ...">
                                                @error('pereNameFirst')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="perenameLast" class="form-label">Prenoms du père<span class="text-dznger">*</span> :</label>
                                                <input type="text" name="perenameLast" id="perenameLast" class="form-control  @error('perenameLast') is-invalid @enderror" value="{{ old('perenameLast') }}" placeholder="Entrez le prenoms du père biologie ...">
                                                @error('perenameLast')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="profPere" class="form-label">Profession du père<span class="text-danger">*</span> :</label>
                                                <input type="text" name="profPere" id="profPere" class="form-control  @error('profPere') is-invalid @enderror" value="{{ old('profPere') }}" placeholder="Entrez la profession du père biologie ...">
                                                @error('profPere')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="phonPere" class="form-label">Téléphone du pére :</label>
                                                <input type="text" name="phonPere" id="phonPere" class="form-control  @error('phonPere') is-invalid @enderror" value="{{ old('phonPere') }}" placeholder="Entrez le contact du père biologie ...">
                                                @error('phonPere')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                             <div class="col-12 col-lg-6 mb-2">
                                                <label for="mereNameFirst" class="form-label">Nom du mère<span class="text-danger">*</span> :</label>
                                                <input type="text" name="mereNameFirst" id="mereNameFirst" class="form-control @error('mereNameFirst') is-invalid @enderror" value="{{ old('mereNameFirst') }}" placeholder="Entrez le nom du mère biologie ...">
                                                @error('mereNameFirst')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="merenameLast" class="form-label">Prenoms du mère<span class="text-dznger">*</span> :</label>
                                                <input type="text" name="merenameLast" id="merenameLast" class="form-control @error('merenameLast') is-invalid @enderror" value="{{ old('merenameLast') }}" placeholder="Entrez le prenoms du mère biologie ...">
                                                @error('merenameLast')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="profPere" class="form-label">Profession du mère<span class="text-danger">*</span> :</label>
                                                <input type="text" name="profMere" id="profMere" class="form-control @error('profMere') is-invalid @enderror" value="{{ old('profMere') }}" placeholder="Entrez la profession du mère biologie ...">
                                                @error('profMere')
                                                    <span class="form-bar text-danger" role="alert">
                                                        {{$message}}
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <label for="phonMere" class="form-label">Téléphone du mére :</label>
                                                <input type="text" name="phonMere" id="phonMere" class="form-control @error('phonMere') is-invalid @enderror" value="{{ old('phonMere') }}" placeholder="Entrez le contact du mère biologie ...">
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
                                        <p class="mb-4">Can you talk about your past work experience?</p>

                                        <div class="row g-3">
                                            <div class="col-12 col-lg-6 mb-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="level" class="form-label">Niveau d'étude<span class="text-danger">*</span> :</label>
                                                        <select name="level" id="level" class="form-select @error('level') is-invalid @enderror" aria-label="Default select">
                                                            <option value="">Select level ...</option>
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
                                                    <div class="col-6">
                                                        <label class="form-label">Série<span class="text-danger">*</span> :</label>
                                                        <div class="d-flex py-1" id="divSerie">
                                                            <!-- Add Serie -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 mb-2">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="form-label">LV2<span class="text-danger">*</span> :</label>
                                                        <div class="d-flex">
                                                            <span class="form-check mx-2">
                                                                <input type="radio" name="lv2"  class="form-check-input" id="all" checked>
                                                                <label class="form-check-label" for="all">Allemand</label>
                                                            </span>
                                                            <span class="form-check mx-2">
                                                                <input type="radio" name="lv2"  class="form-check-input" id="esp">
                                                                <label class="form-check-label" for="esp">Espagnol</label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
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
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="Experience2" class="form-label">Experience 2</label>
                                                <input type="text" class="form-control" id="Experience2" placeholder="Experience 2">
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="PhoneNumber" class="form-label">Position</label>
                                                <input type="text" class="form-control" id="PhoneNumber" placeholder="Position">
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="Experience3" class="form-label">Experience 3</label>
                                                <input type="text" class="form-control" id="Experience3" placeholder="Experience 3">
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <label for="PhoneNumber" class="form-label">Position</label>
                                                <input type="text" class="form-control" id="PhoneNumber" placeholder="Position">
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex align-items-center gap-3" style="float: right">
                                                    <button type="button" class="btn btn-light px-4" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2'></i>Previous</button>
                                                    <button type="submit" class="btn btn-light px-4" onclick="stepper1.next()">Submit</button>
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

        // Get Function Verify Level
        $('#level').on('change', function() {
            $('.serie-check').remove();
            if($(this).val() > 4){
                $code = this.options[this.selectedIndex].dataset.code;
                $.ajax({
                    url: "{{ route('ajax.serie') }}",
                    method: "GET",
                    data: {
                        code: $code
                    },
                    dataType: "json",
                    success: function(dts) {
                        if(dts.status == 200){
                            $data = dts.data;
                            $i = 0;
                            while($i < $data.length){
                                $val = $i == 0 ? 'checked':null;
                                $('#divSerie').append(`<span class="form-check serie-check mx-2">
                                    <input type="radio" name="serie"  class="form-check-input" value="`+$data[$i].id+`" id="`+$data[$i].libelle+`" `+$val+`>
                                    <label class="form-check-label" for="`+$data[$i].libelle+`">`+$data[$i].libelle+`</label>
                                </span>`);
                                $i++;
                            }
                        }
                    }
                })
            }
        });




        //  Function -----------------
        function getClasseLevel($level){
            $.ajax({
                url: "{{ route('ajax.classe') }}",
                method: "GET",
                data: {
                    level: $level
                },
                dataType: "json",
                success: function(dts) {
                    $('.option').remove();
                    if(dts.status == 200){
                        $data = dts.data;
                        $i = 0;
                        while($i < $data.length){
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
    });
</script>
@endsection