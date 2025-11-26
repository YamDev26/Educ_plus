@extends('app')
@section('title', 'Inscription Index')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-12">
          @include('partials._alert')
          <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-1 mb-0">
                    <h5 class="mb-0">Gestion Des Elèves</h5>
                    <span style="float: right; ">
                        <button type="button" class="btn btn-outline-light py-1 mb-1" id="add" style="font-size: 12px; border-radius: 2px">Add</button>
                        <a href="{{ route('classe.index') }}" class="btn btn-outline-light py-1 mb-1" style="font-size: 12px; border-radius: 2px">Back</a>
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-bordered" id="users-table">
                           <thead>
                                <tr class="table-dark">
                                    <th style="width: 5%">Id</th>
                                    <th style="width: 25%">Matricule</th>
                                    <th style="width: 25%">Nom</th>
                                    <th style="width: 30%">Prenom</th>
                                    <th style="width: 15%">Action</th>
                                </tr>
                            </thead>
                            
                        </table>
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
                            <input type="text" name="matricule" class="form-control number" id="matricule" placeholder="Matricule de l'élève a inscrit.">
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
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title">New Inscription</h5>
                <strong style="font-size: 13px">{{ date('d/m/Y') }}</strong>
            </div>
            <form action="#" method="post" id="my_create">
            <div class="modal-body py-2">
                <div class="row">
                     <div class="col-4">
                        <strong id="mats">25280226Y</strong>
                        <div class="product-img mt-1">
                            <img src="{{ asset('assets/images/icons/user-interface.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-8 pt-3 text-left">
                        <p id="names" class="my-1" style="font-size: 17px">CISSE Koné Bacongo</p>
                        <p class="my-1">
                            <strong>F</strong> - 
                            <span>Né le 12/04/2012 à Abidjan</span>
                        </p>
                    </div>
                    <hr class="my-1">
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
                        <span class="mx-1">
                            <input type="radio" name="redoublant" id="non" class="form-check-input" value="non" checked>
                            <label class="form-check-label" for="non">Non</label>
                        </span>
                        <span class="mx-1">
                            <input type="radio" name="redoublant" id="demi" class="form-check-input" value="demi">
                            <label class="form-check-label" for="demi">1/2</label>
                        </span>
                        <span class="mx-1">
                            <input type="radio" name="redoublant" id="plein" class="form-check-input" value="plein">
                            <label class="form-check-label" for="plein">Oui</label>
                        </span>
                    </div>
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
            if($val && ($val.length == 9)){
                closeModal($('#addModal'));
                $.ajax({
                    url: '{{ route('inscription.create') }}',
                    method: 'GET',
                    data: { matricule: $val },
                    success: function(data) {
                        if(data.status == 201){
                            $msg = 'Matricule Introuvable';
                            getNotify('error', 'bx bx-x-circle', $msg); 
                        }
                        else{
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


        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('inscription.data') }}",
            columns: [
            { data: 'id' },
            { data: 'matricule' },
            { data: 'first_name' },
            { data: 'last_name' },
            { data: 'action', orderable: false, searchable: false },
            ]
        });


        // Function
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