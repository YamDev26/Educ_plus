@extends('app')
@section('title', 'Student Edit')
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
                    <h5 class="mb-0">Edit Elève</h5>
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
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="bs-stepper-content">
                                    <form action="{{ route('student.update', $data->id) }}" method="post" id="myForm" enctype="multipart/form-data">
                                        @csrf @method('put')
                                        <div id="test-l-1" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger1">
                                            <h5 class="mb-1">Your Personal Information</h5>
                                            <p class="mb-4">Enter your personal information to get closer to copanies</p>

                                            <div class="row g-3 p-2">
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="phon1" class="form-label">Téléphone 1<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="phon1" id="phon1" class="form-control number @error('phon1') is-invalid @enderror" value="{{ old('phon1', $data->parent_std->phon1) }}" placeholder="Numéro téléphone 1">
                                                    @error('phon1')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="phon2" class="form-label">Téléphone 2 :</label>
                                                    <input type="text" name="phon2" id="phon2" class="form-control number @error('phon2') is-invalid @enderror" value="{{ old('phon2', $data->parent_std->phon2) }}" placeholder="Numéro téléphone 2">
                                                    @error('phon2')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="nameFirstParent" class="form-label">Nom Parent<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="nameFirstParent" id="nameFirstParent" class="form-control @error('nameFirstParent') is-invalid @enderror" value="{{ old('nameFirstParent', $data->parent_std->first) }}" placeholder="Entrez le nom">
                                                    @error('nameFirstParent')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="nameLastParent" class="form-label">Prénoms Parent<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="nameLastParent" id="nameLastParent" class="form-control @error('nameLastParent') is-invalid @enderror" value="{{ old('nameLastParent', $data->parent_std->last) }}" placeholder="Entrez le prenoms">
                                                    @error('nameLastParent')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="profesionParent" class="form-label">Profession Parent<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="profesionParent" id="profesionParent" class="form-control @error('profesionParent') is-invalid @enderror" value="{{ old('profesionParent', $data->parent_std->profession) }}" placeholder="Entrez le profession">
                                                    @error('profesionParent')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="emal" class="form-label">Adresse Email Parent :</label>
                                                    <input type="email" name="email" id="emal" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $data->parent_std->email) }}" placeholder="Entrez l'adresse Email">
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
                                            </div>
                                        </div>

                                        <div id="test-l-2" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger2">
                                            <h5 class="mb-1">Account Details</h5>
                                            <p class="mb-4">Enter Your Account Details.</p>

                                            <div class="row g-3">
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="matricule" class="form-label">Matricule<span class="text-danger">*</span> : <strong class="text-danger pl-2" id="mtls" style="display: none">Matricule déjà utilisé par un autre élève !</strong></label>
                                                    <input type="text" name="matricule" id="matricule" class="form-control @error('matricule') is-invalid @enderror" value="{{ old('matricule', $data->matricule) }}" placeholder="Entrez le matricule">
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
                                                        <option value="F" {{ old('genre') == 'F' ? 'selected':'' }} {{ $data->genre == 'F' ? 'selected':'' }}>Feminin</option>
                                                        <option value="M" {{ old('genre') == 'M' ? 'selected':'' }} {{ $data->genre == 'M' ? 'selected':'' }}>Masculin</option>
                                                    </select>
                                                    @error('genre')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="firstName" class="form-label">Nom<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="firstName" id="firstName" class="form-control @error('firstName') is-invalid @enderror" value="{{ old('firstName', $data->first_name) }}" placeholder="Entrez le nom">
                                                    @error('firstName')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="lastName" class="form-label">Prenoms<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="lastName" id="lastName" class="form-control @error('lastName') is-invalid @enderror" value="{{ old('lastName', $data->last_name) }}" placeholder="Entrez le prenoms">
                                                    @error('lastName')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="dateNaiss" class="form-label">Date de naissance<span class="text-danger">*</span> :</label>
                                                    <input type="date" name="dateNaiss" id="dateNaiss" class="form-control @error('dateNaiss') is-invalid @enderror" value="{{ old('dateNaiss', $data->date_naiss) }}" placeholder="Entrez la date de naissance">
                                                    @error('dateNaiss')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="lieuNaiss" class="form-label">Lieu de naissance<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="lieuNaiss" id="lieuNaiss" class="form-control @error('lieuNaiss') is-invalid @enderror" value="{{ old('lieuNaiss', $data->lieu_naiss) }}" placeholder="Entrez le lieu de naissance">
                                                    @error('lieuNaiss')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="nationalite" class="form-label">Nationalité<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="nationalite" id="nationalite" class="form-control @error('nationalite') is-invalid @enderror" value="{{ old('nationalite', $data->nationalitie->libelle) }}" placeholder="Entrez la nationalité">
                                                    @error('nationalite')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="extrait" class="form-label">Numéro d’extrait de naissance<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="extrait" id="extrait" class="form-control @error('extrait') is-invalid @enderror" value="{{ old('extrait', $data->num_extrait) }}" placeholder="Entrez le numéro d’extrait de naissance">
                                                    @error('extrait')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="residence" class="form-label">Résidence<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="residence" id="residence" class="form-control @error('residence') is-invalid @enderror" value="{{ old('residence', $data->residence) }}" placeholder="Entrez la résidence">
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
                                                <div class="col-12 mt-2">
                                                    <div class="d-flex align-items-center gap-3" style="float: right">
                                                        <button type="button" class="btn btn-outline-light px-4" onclick="stepper1.previous()"><i class='bx bx-left-arrow-alt me-2'></i>Previous</button>
                                                        <button type="button" class="btn btn-light px-4" onclick="stepper1.next()">Next<i class='bx bx-right-arrow-alt ms-2'></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="test-l-3" role="tabpanel" class="bs-stepper-pane" aria-labelledby="stepper1trigger3">
                                            <h5 class="mb-1">Your Education Information</h5>
                                            <p class="mb-4">Inform companies about your education life</p>

                                            <div class="row g-3">
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="pereNameFirst" class="form-label">Nom Père Biologique<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="pereNameFirst" id="pereNameFirst" class="form-control  @error('pereNameFirst') is-invalid @enderror" value="{{ old('pereNameFirst', $data->biological_std ? $data->biological_std->first_father:null) }}" placeholder="Entrez le nom du père biologie">
                                                    @error('pereNameFirst')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="pereNameLast" class="form-label">Prenoms Père Biologique<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="pereNameLast" id="pereNameLast" class="form-control  @error('pereNameLast') is-invalid @enderror" value="{{ old('pereNameLast', $data->biological_std ? $data->biological_std->last_father:null) }}" placeholder="Entrez le prenoms du père biologie">
                                                    @error('pereNameLast')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="profPere" class="form-label">Profession Père Biologique<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="profPere" id="profPere" class="form-control  @error('profPere') is-invalid @enderror" value="{{ old('profPere', $data->biological_std ? $data->biological_std->prof_father:null) }}" placeholder="Entrez la profession du père biologie">
                                                    @error('profPere')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="phonPere" class="form-label">Téléphone Pére Biologique :</label>
                                                    <input type="text" name="phonPere" id="phonPere" class="form-control  @error('phonPere') is-invalid @enderror" value="{{ old('phonPere', $data->biological_std ? $data->biological_std->phon_father:null) }}" placeholder="Entrez le contact du père biologie">
                                                    @error('phonPere')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="mereNameFirst" class="form-label">Nom Mère Biologique<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="mereNameFirst" id="mereNameFirst" class="form-control @error('mereNameFirst') is-invalid @enderror" value="{{ old('mereNameFirst', $data->biological_std ? $data->biological_std->first_mother:null) }}" placeholder="Entrez le nom du mère biologie">
                                                    @error('mereNameFirst')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="mereNameLast" class="form-label">Prenoms Mère Biologique<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="mereNameLast" id="mereNameLast" class="form-control @error('mereNameLast') is-invalid @enderror" value="{{ old('mereNameLast', $data->biological_std ? $data->biological_std->last_mother:null) }}" placeholder="Entrez le prenoms du mère biologie">
                                                    @error('mereNameLast')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="profMere" class="form-label">Profession Mère Biologique<span class="text-danger">*</span> :</label>
                                                    <input type="text" name="profMere" id="profMere" class="form-control @error('profMere') is-invalid @enderror" value="{{ old('profMere', $data->biological_std ? $data->biological_std->prof_mother:null) }}" placeholder="Entrez la profession du mère biologie">
                                                    @error('profMere')
                                                        <span class="form-bar text-danger" role="alert">
                                                            {{$message}}
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-12 col-lg-6 mb-2">
                                                    <label for="phonMere" class="form-label">Téléphone Mére Biologique :</label>
                                                    <input type="text" name="phonMere" id="phonMere" class="form-control @error('phonMere') is-invalid @enderror" value="{{ old('phonMere', $data->biological_std ? $data->biological_std->phon_mother:null) }}" placeholder="Entrez le contact du mère biologie">
                                                    @error('phonMere')
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
                                            </div>
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