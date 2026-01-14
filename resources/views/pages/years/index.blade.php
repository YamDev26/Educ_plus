@extends('app')
@section('title', 'school yaer')
@section('link')
<style>
    .dataTables_length, .dataTables_info, .dataTables_paginate  {
        display: none
    }
</style>
@endsection
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-12 px-lg-2">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-2 mb-0">
                    <h5 class="mb-0">Années Scolaires</h5>
                    <div id="table-recent-leads-actions">
                        <button type="button" class="btn btn-outline-light py-0 px-2 mb-1" id="addYear" title="New School Year" style="border: none; border-radius: 3px">
                            <i class="fadeIn animated bx bx-edit-alt m-0" style="font-size: 17px"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-bordered" id="Transaction-History" style="border: 1px solid">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center" scope="col" style="border-right: 1px solid white"></th>
                                    <th class="text-center" scope="col" style="border-right: 1px solid white">Année Scolaire</th>
                                    <th class="text-center" scope="col" style="border-right: 1px solid white">Découpage</th>
                                    <th class="text-center" scope="col" style="border-right: 1px solid white">Statut</th>
                                    <th class="text-center" scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach ($datas as $item)
                                    <tr class="dataYear">
                                        <td class="text-center">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                                        <td class="text-center">{{ $item['libelle'] }}</td>
                                        <td class="text-center">{{ ucwords($item['cutting'] == '1' ? 'Trimestre':'Semestre') }}</td>
                                        <td class="text-center">
                                            <div class="badge bg-{{ getStatus($item['actif'])[0] }} w-50" style="margin: 0px auto">
												<span>{{ getStatus($item['actif'])[1] }}</span>
											</div>
                                        </td>
                                        <td class="text-center py-0">
                                            <div class="d-flex justify-content-center my-1">
                                                <button data-id="{{ $item['id'] }}" class="btn btn-outline-light editBtn py-0 px-1 mb-0 mt-1" style="border: none; border-radius: 3px" title="Edit">
                                                    <i class="bx bx-edit font-20 mx-0" style="font-size: 17px"></i>
                                                </button>
                                                <button data-id="{{ $item['id'] }}" class="btn btn-outline-light deleteBtn py-0 px-1 mb-0 mt-1" style="border: none; border-radius: 3px" title="Delete">
                                                    <i class="bx bx-trash font-20 mx-0" style="font-size: 17px"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-fe77f32a-358a-42ac-9b73-d0222afa6979" id="dom-fe77f32a-358a-42ac-9b73-d0222afa6979">
    <!-- Modal Add School Year -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <form action="{{ route('year.store') }}" method="post">
                    @csrf
                    <div class="modal-body p-0">
                        <div class="modal-header py-2">
                            <h5 class="mb-1" id="modalExampleDemoLabel">New</h5>
                            <strong style="font-size: 17px">School Year</strong>
                        </div>
                        <div class="p-4 pb-0">
                            <div class="mb-3">
                                <label class="col-form-label" for="year">Année Scoliare<span class="text-danger">*</span> :</label>
                                <input type="text" name="year" class="form-control" id="year" placeholder="2025-2026">
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="mb-3 py-2" title="Type Decoupage">
                                    {{-- <label class="col-form-label" for="message-text">Libelle<span class="text-danger">*</span> :</label> --}}
                                    <span class="mx-1">
                                        <input type="radio" name="cutting" id="trimestre" value="1" checked>
                                        <label for="trimestre">Trimestre</label>
                                    </span>
                                    <span class="mx-1">
                                        <input type="radio" name="cutting" id="semestre" value="2">
                                        <label for="semestre">Semestre</label>
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Activé<span class="text-danger">*</span> :</label>
                                    <span class="mx-1">
                                        <input type="radio" name="actif" id="oui" value="oui" checked>
                                        <label for="oui">Oui</label>
                                    </span>
                                    <span class="mx-1">
                                        <input type="radio" name="actif" id="non" value="non">
                                        <label for="non">Non</label>
                                    </span>
                                </div>
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

    <!-- Modal Edit School Year -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <form action="{{ route('year.update') }}" method="post">
                    @csrf
                    <div class="modal-body p-0">
                        <div class="modal-header py-2">
                            <h5 class="mb-1" id="modalExampleDemoLabel">Edit</h5>
                            <strong style="font-size: 17px">School Year</strong>
                        </div>
                        <div class="p-4 pb-0">
                            <input type="hidden" name="id" id="idEdit">
                            <div class="mb-3">
                                <label class="col-form-label" for="yearEdit">Année Scoliare<span class="text-danger">*</span> :</label>
                                <input type="text" name="year" class="form-control" id="yearEdit" placeholder="2025-2026">
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="mb-3 py-2" title="Type Decoupage">
                                    {{-- <label class="col-form-label" for="message-text">Libelle<span class="text-danger">*</span> :</label> --}}
                                    <span class="mx-1">
                                        <input type="radio" name="cutting" id="trimEdit" value="1">
                                        <label for="trimEdit">Trimestre</label>
                                    </span>
                                    <span class="mx-1">
                                        <input type="radio" name="cutting" id="semEdit" value="2">
                                        <label for="semEdit">Semestre</label>
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label class="col-form-label">Statut<span class="text-danger">*</span> :</label>
                                    <span class="mx-2">
                                        <input type="checkbox" name="statut" id="etat">
                                        <label for="etat" id="libEdit"></label>
                                    </span>
                                </div>
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

    <!-- Modal Delete School Year -->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <form action="{{ route('year.destroy') }}" method="post">
                    @csrf
                    <div class="modal-body p-0">
                        <div class="modal-header py-2">
                            <h5 class="mb-1" id="modalExampleDemoLabel">Delete</h5>
                            <strong style="font-size: 17px">School Year</strong>
                        </div>
                        <div class="p-4 pb-0">
                            <input type="hidden" name="id" id="detele">
                            <div class="mb-3 text-center">
                                <strong id="texts"></strong><br>
                                <span class="my-3" style="font-size: 13px">Vous êtes sur le point de supprimer cette information.</span>
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
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {

        $('#addYear').on('click', function(e){
            // e.evenDefault();
            // Affichage du modal -------------------------
            var modal = new bootstrap.Modal($('#add-modal'));
            modal.show();
        });

        // Ajax Pour Edition --------------------------
        $('.editBtn').on('click', function() {
            if($(this).data('id')){
                $.ajax({
                    url: '{{ route('year.edit') }}',
                    method: 'GET',
                    data: {id: $(this).data('id')},
                    success: function(data) {
                        addEdit(data['data']);
                        // Affichage du modal -------------------------
                        var modal = new bootstrap.Modal($('#edit-modal'));
                        modal.show();
                    },
                });
            }
        });


        // Ajax Pour Delete
        $('.deleteBtn').on('click', function() {
            if($(this).data('id')){
               $.ajax({
                    url: '{{ route('year.edit') }}',
                    method: 'GET',
                    data: {id: $(this).data('id')},
                    success: function(data) {
                        $('#detele').val(data['data']['id']);
                        $('#texts').text(data['data']['libelle']);
                        // Affichage du modal -------------------------
                        var modal = new bootstrap.Modal($('#delete-modal'));
                        modal.show();
                    },
                }); 
            }
        });


        function addEdit($data){
           $('#yearEdit').val($data['libelle']); $('#idEdit').val($data['id']);
           $data['cutting'] == 1 ? $('#trimEdit').prop('checked', true):$('#trimEdit').prop('checked', false);
           $data['cutting'] == 2 ? $('#semEdit').prop('checked', true):$('#semEdit').prop('checked', false);
           $data['actif'] == 1 ? $('#libEdit').text('Actif'):$('#libEdit').text('Inactif');
           $data['actif'] == 1 ? $('#etat').prop('checked', true):$('#etat').prop('checked', false);
        }


        function ucfirst(str) {
            return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
        }
    })
</script>
@endsection