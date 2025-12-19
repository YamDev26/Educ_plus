@extends('app')
@section('title', 'Inscription Index')
@section('link')
<style>
    .dataTables_length  {
        display: none
    }
</style>
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
                        <button type="button" class="btn btn-outline-light py-0 px-2 mb-1" id="add" style="border: none; border-radius: 3px">
                            <i class="fadeIn animated bx bx-edit-alt m-0" style="font-size: 17px"></i>
                        </button>
                        <button type="button" class="btn btn-outline-light py-0 px-2 mb-1" id="btnAdd" style="border: none; border-radius: 3px" title="Import File">
                            <i class="lni lni-share-alt mx-0" style="font-size: 17px"></i>
                        </button>
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mx-lg-3">
                        <div class="col-12">
                            <div class="table-responsive mt-4">
                                <table class="table table-striped table-bordered w-100" id="myTable" style="border: 1px solid">
                                <thead>
                                        <tr class="table-dark">
                                            <th class="text-center py-2" style=" width: 10%;border-right: 1px solid white"></th>
                                            <th class="text-center py-2" style="width: 30%; border-right: 1px solid white">Student</th>
                                            <th class="text-center py-2" style="width: 20%; border-right: 1px solid white">Classe</th>
                                            <th class="text-center py-2" style="width: 20%; border-right: 1px solid white">Date Inscrit</th>
                                            <th class="text-center py-2" style="width: 20%">Action</th>
                                        </tr>
                                    </thead>
                                    <!-- Content -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Search Model -->
<div class="modal fade" id="addModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title">Search Student</h5>
            </div>
            <form action="#" method="post" id="my_add">
            <div class="modal-body">
                <div class="row my-3">
                    <div class="col-12">
                        <div class="form-group mx-2 mb-3">
                            <label class="form-label" for="matricule">Entrez Le Matricule<span class="text-danger">*</span> :</label>
                            <input type="text" name="matricule" class="form-control number" id="matricule" list="datalistOptions" placeholder="Matricule de l'élève a inscrit.">
                            <datalist id="datalistOptions">
                                <!-- Content  -->
                            </datalist>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary py-1" id="addClose" style="font-size: 12px; border-radius: 2px;" type="button" data-bs-dismiss="modal">Annuler</button>
                <button class="btn btn-primary py-1" style="font-size: 12px; border-radius: 2px;" type="submit">Valider</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Create Model -->
<div class="modal fade" id="createModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title">New Inscription</h5>
                <strong style="font-size: 15px">{{ date('d/m/Y') }}</strong>
            </div>
            <form action="{{ route('inscription.store') }}" method="post" id="my_create">
                @csrf
                <div class="modal-body py-2">
                    <div class="row">
                        <div class="col-4">
                            <strong class="my-2" id="mats" style="font-size: 16px"></strong>
                            <div class="product-img mt-1">
                                <img alt="image student" id="image">
                            </div>
                        </div>
                        <div class="col-8 pt-3 text-left">
                            <p id="name" class="my-1" style="font-size: 18px; font-weight: 800;"></p>
                            <p class="my-1">
                                <strong id="sexe"></strong> - 
                                <span>Né<span id="nature"></span> le <b id="date"></b> à <b id="lieu"></b></span>
                            </p>
                        </div>
                        <hr class="my-2">
                    </div>
                    <section id="section1" style="display: none">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="form-label">Affecté<span class="text-danger">*</span> :</label> <br>
                                    <span class="mx-2">
                                        <input type="radio" name="affected" id="oui_1" class="form-check-input" value="oui" checked>
                                        <label class="form-check-label" for="oui_1">Oui</label>
                                    </span>
                                    <span class="mx-2">
                                        <input type="radio" name="affected" id="non_1" class="form-check-input" value="non">
                                        <label class="form-check-label" for="non_1">Non</label>
                                    </span>
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Redoublant<span class="text-danger">*</span> :</label> <br>
                                <span class="mx-2">
                                    <input type="radio" name="redoublant" id="oui_2" class="form-check-input" value="oui">
                                    <label class="form-check-label" for="oui_2">Oui</label>
                                </span>
                                <span class="mx-2">
                                    <input type="radio" name="redoublant" id="non_2" class="form-check-input" value="non" checked>
                                    <label class="form-check-label" for="non_2">Non</label>
                                </span>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Boursier<span class="text-danger">*</span> :</label> <br>
                                <span class="mx-1" title="Pas bourse">
                                    <input type="radio" name="bourse" id="non" class="form-check-input" value="non" checked>
                                    <label class="form-check-label" for="non">0</label>
                                </span>
                                <span class="mx-1" title="Demi bourse">
                                    <input type="radio" name="bourse" id="demi" class="form-check-input" value="demi">
                                    <label class="form-check-label" for="demi">1/2</label>
                                </span>
                                <span class="mx-1" title="Pleine bourse">
                                    <input type="radio" name="bourse" id="plein" class="form-check-input" value="plein">
                                    <label class="form-check-label" for="plein">1</label>
                                </span>
                            </div>
                        
                            <div class="col-10 mt-3 offset-1">
                                <label for="level" class="form-label">Niveau d'étude<span class="text-danger">*</span> :</label>
                                <select name="level" id="level" class="form-select" required="">
                                    <option selected="" value="">Select</option>
                                    <!-- Content Level -->
                                </select>
                            </div>

                            <div class="col-10 mt-3 offset-1" id="divSerie" style="display: none">
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

                            <div class="col-10 mt-3 offset-1" id="divLv2" style="display: none">
                                <label for="lv2" class="form-label">LV2<span class="text-danger">*</span> :</label>
                                <select name="lv2" id="lv2" class="form-select">
                                    <option selected="" value="">Select</option>
                                    <option value="allemand">Allemand</option>
                                    <option value="espagnol">Espagnol</option>
                                </select>
                            </div>

                            <div class="col-10 mt-3 offset-1" id="divClass" style="display: none">
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
                    </section>
                    <section class="my-3" id="section2" style="display: none">
                        <div class="col-12 text-center">
                            <strong class="text-success my-3" style="font-size: 17px">Inscription effectuée</strong>
                            <p>Classe : <span id="Span"></span></p>
                        </div>
                    </section>
                </div>
                <input type="hidden" name="id" id="idStudent">
                <div class="modal-footer">
                    <button class="btn btn-secondary py-1" style="font-size: 12px; border-radius: 2px;" type="button" data-bs-dismiss="modal">Fermer</button>
                    <button class="btn btn-primary py-1" style="font-size: 12px; border-radius: 2px;" type="submit" disabled>Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title">Delete</h5>
                <strong id="created_at" style="font-size: 15px"></strong>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h5 id="nameDelete"></h5>
                    <strong id="matDelete"></strong><br>
                    <span class="text-danger mb-0" id="classDelete" style="font-size: 17px"></span>
                </div>
                <p class="text-center my-0">Confirmez la suppression.</p>
            </div>
            <form action="{{ route('inscription.delete') }}" method="post">
                @csrf
                <input type="hidden" name="id" id="idDelete">
                 <input type="hidden" name="classId" id="idClass">
                <div class="modal-footer">
                    <button class="btn btn-secondary py-1" style="font-size: 12px; border-radius: 2px;" type="button" data-bs-dismiss="modal">Fermer</button>
                    <button class="btn btn-primary py-1" style="font-size: 12px; border-radius: 2px;" type="submit">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Import FIle -->
<div class="modal fade" id="fileModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title">Import Fille</h5>
                <span style="font-size: 15px">{{ date('d-m-Y') }}</span>
            </div>
            <form action="{{ route('student.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group mx-1 mb-3">
                        <button type="button" class="btn btn-outline-light my-1 mx-2 px-2 py-0 exportBtn" style="float:right; border: none; border-radius: 3px" title="DownLoad File">
                        <i class="lni lni-download m-0" style="font-size: 17px"></i>
                        </button>
                        <label class="form-label" for="files">Select File<span class="text-danger">*</span> :</label>
                        <input type="file" name="files" class="form-control" id="files" style="border-radius: 5px">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary py-1" style="font-size: 12px; border-radius: 2px;" type="button" data-bs-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary py-1" style="font-size: 12px; border-radius: 2px;" type="submit">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Export FIle -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title">Export File</h5>
            </div>
            <form action="{{ route('inscription.export') }}" method="post">
                @csrf
                @method('get')
                <div class="modal-body">
                    <div class="form-group mx-1 mb-3">
                        <label for="levels" class="form-label">Get Level<span class="text-danger">*</span> :</label>
                        <select name="level" id="levels" class="form-select" required="">
                            <option selected="" value="">Select</option>
                            <!-- Content Level -->
                        </select>
                    </div>
                    <div class="form-group mx-1 mb-3" id="classDiv" style="display: none">
                        <label for="classes" class="form-label">Get Classe<span class="text-danger">*</span> :</label>
                        <select name="classe" id="classes" class="form-select" required="">
                            <!-- Content Classe -->
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary py-1" style="font-size: 12px; border-radius: 2px;" type="button" data-bs-dismiss="modal">Annuler</button>
                    <button class="btn btn-primary py-1" style="font-size: 12px; border-radius: 2px;" type="submit">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {

        $('#add').on('click', function() {
            var modal = new bootstrap.Modal($('#addModal'));
            modal.show();
        });

        $('#addClose').on('click', function() {
            $('input[type="text"]').val(null);
        });

        $('#my_add button[type="submit"]').on('click', function($e) {
            $e.preventDefault();
            $val = $('#matricule').val();
            $('.level').remove(); $('#section1, #section2').hide();
            if($val && ($val.length == 9)){
                closeModal($('#addModal'));
                $.ajax({
                    url: '{{ route('inscription.create') }}',
                    method: 'GET',
                    data: { matricule: $val },
                    success: function(data) {
                        console.log(data);
                        if(data.status == 201){
                            $msg = 'Matricule Introuvable';
                            getNotify('error', 'bx bx-x-circle', $msg); 
                        }
                        else{
                            afficheData(data.student);
                            if(data.classe){
                                $('#section2').show();
                                $('#Span').text(data.classe);
                                $('#my_create button[type="submit"]').prop('disabled', true);
                            }
                            else{
                                $('#section1').show();
                                addLevelSelect(data.levels, 'level');
                                $('#idStudent').val(data.student.id);
                                $('#my_create button[type="submit"]').prop('disabled', false);
                            }
                            var modal = new bootstrap.Modal($('#createModal'));
                            modal.show();
                        }
                    },
                });
            }
            else{
                $msg = 'Matricule Incorrect';
                getNotify('warning', 'bx bx-error', $msg);
            }
        });


        $('#btnAdd').on('click', function() {
            var modal = new bootstrap.Modal($('#fileModal'));
            modal.show();
        });


        $('.exportBtn').on('click', function() {
            $('#fileModal').modal('hide');
            $.ajax({
                url: "{{ route('inscription.search') }}",
                method: "GET",
                dataType: "json",
                success: function(dts) {
                    console.log(dts);
                    addLevelSelect(dts, 'levels');
                    var modal = new bootstrap.Modal($('#exportModal'));
                    modal.show();
                }
            });
        });

        // Export File Function
        $('#levels').on('change', function() {
            $level = $(this).val();
            if($level){
                getClasseLevel({level: $level, div: 'classes'});
                $('#classDiv').show();
            }
            else{
                $('#classDiv').hide();
            }
        });


        $('#level').on('change', function() {
            $('#divSerie, #divLv2, #divClass').hide(500);
            $('#lv2 option[value=""]').prop('selected', true);
            $level = $(this).val();
            if($level > 4){
                $code = this.options[this.selectedIndex].dataset.code;
                getSerie($code);
            }
            else if($.inArray($level, ['3', '4']) !== -1){
                $('#divLv2').show(500);
            }
            else{
                getClasseLevel({level: $level, div: 'classe'});
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
                getClasseLevel({level: $level, serie: $val, div: 'classe'});
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
                getClasseLevel({level: $level, lv2: $val, serie: $serie, div: 'classe'});
            }
            else if($val){
                getClasseLevel({level: $level, lv2: $val, div: 'classe'});
            }
            else{
                $('#divClass').hide(200);
            }
        });

        $(document).on('click', '.btnDelete', function() {
            $id = $(this).data('id');
            if($id){
                $.ajax({
                    url: "{{ route('inscription.edit') }}",
                    method: "GET",
                    data: { id: $id },
                    dataType: "json",
                    success: function(dts) {
                        $('#nameDelete').text(dts.name);
                        $('#matDelete').text(dts.matricule);
                        $('#classDelete').text(dts.classe);
                        $('#created_at').text(dts.date);
                        $('#idDelete').val(dts.id);
                        $('#idClass').val(dts.classId);
                        let myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
                        myModal.show();
                    }
                });
            }
        });
        

        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('inscription.data') }}",
            columns: [
                { data: 'counter', className: "text-center pt-4", orderable: false, searchable: false },
                { data: 'student', searchable: true },
                { data: 'classe', searchable: true },
                { data: 'created', searchable: true },
                { data: 'action', orderable: false, searchable: false },
            ]
        });


        // Function ----------------------------------------
        function addLevelSelect($data, $select){
            $i = 0;
            while($i < $data.length){
                $option = '<option value="'+$data[$i].id+'" class="level" data-code="'+$data[$i].code+'">'+$data[$i].code+'</option>';
                $('#'+$select).append($option);
                $i++;
            }
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

        function getClasseLevel({level, lv2 = null, serie = null, div}){
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
                            $('#'+div).css('border', '1px solid rgb(255 255 255 / 15%)');
                            $('#'+div).append('<option value="'+$data[$i].id+'" class="option">'+$data[$i].libelle+'</option>');
                            $i++;
                        }
                    }
                    else{
                        $('#'+div).css('border', '1px solid red');
                        $('#'+div).append('<option value="" class="option">Classe non disponible ...</option>');
                    }
                }
            });
        }

        function afficheData($student){
            $('#name').text($student.name);
            $('#sexe').text($student.sexe);
            $('#date').text($student.date);
            $('#lieu').text($student.lieu);
            $('#mats').text($student.matricule);
            $('#nature').text(($student.sexe == 'F') ? 'e':null);
            $('#image').prop('src', $student.url);
        }

        function getNotify($type, $icon, $message){
            Lobibox.notify($type, {
                pauseDelayOnHover: true,
                continueDelayOnInactiveTab: false,
                position: 'top right',
                icon: $icon,
                msg: $message
            });
        }
        

        function closeModal($modal){
            $('input[type="text"]').val(null);
            (bootstrap.Modal.getInstance($modal) || new bootstrap.Modal($modal)).hide();
        }
    });
</script>
@endsection