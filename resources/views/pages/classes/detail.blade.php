@extends('app')
@section('title', 'Classe '.$level['code'])
@section('link')
<style>
    .dataTables_length, .dataTables_info, .dataTables_paginate  {
        display: none
    }
</style>
@endsection
@section('content')
<div class="page-content">
    <div class="rox">
        <div class="col-12 px-lg-2">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-2 mb-0">
                    <h5 class="mb-0">Niveau {{ $level['code'] }}</h5>
                    <span style="float: right; ">
                        <button type="button" class="btn btn-outline-light py-0 px-2 mb-1" data-id="{{ $level['id'] }}" id="addClass" style="border: none; border-radius: 3px">
                            <i class="fadeIn animated bx bx-edit-alt m-0" style="font-size: 17px"></i>
                        </button>
                        <a href="{{ route('classe.index') }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                            <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                        </a>
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr class="table-dark">
                                    <th class="text-center py-2" scope="col"></th>
                                    <th class="text-center py-2" scope="col">Libellé</th>
                                    <th class="text-center py-2" scope="col">Effectif</th>
                                    <th class="text-center py-2" scope="col">Status</th>
                                    <th class="text-center w-25" scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @forelse ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                                    <td class="text-center">{{ $item['libelle'] }} {{ $item['lv2'] ? ' - '.ucwords($item['lv2']):null }}</td>
                                    <td class="text-center">{{ ($item['inscrit'] <= 9 ? '0'.$item['inscrit']:$item['inscrit']).'/'.$item['effectif'] }}</td>
                                    <td class="text-center">
                                        <div class="badge bg-{{ getStatus($item['status'])[0] }} text-center text-white px-2" style="margin: 0px auto; width: 70px">
                                            <span>{{ getStatus($item['status'])[1] }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center py-1">
                                        <div class="d-flex justify-content-center my-0">
                                            <a href="{{ route('time.index', $item['id']) }}" class="btn btn-outline-light py-0 px-1 mb-0 mt-1" style="border: none; border-radius: 3px" title="Timetable">
                                                <i class="fadeIn animated bx bx-slider-alt m-0" style="font-size: 17px"></i>
                                            </a>
                                            <button data-id="{{ $item['id'] }}" class="btn btn-outline-light btnEdit py-0 px-1 mb-0 mt-1" style="border: none; border-radius: 3px" title="Edit classe">
                                                <i class="bx bx-edit m-0" style="font-size: 17px"></i>
                                            </button>
                                            <button data-lib="{{ $item['id'].'_'.$item['libelle'] }}" class="btn btn-outline-light btnDelete py-0 px-1 mb-0 mt-1" style="border: none; border-radius: 3px" title="Delete classe">
                                                <i class="bx bx-trash m-0" style="font-size: 17px"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Aucune classe pour le moment.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Classe Model -->
<div class="modal fade" id="addModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title">New</h5>
                <strong style="font-size: 18px">{{ $level['code'] }}</strong>
            </div>
            <form action="{{ route('classe.store') }}" method="post">
            @csrf
            <input type="hidden" name="level" value="{{ $level['id'].'_'.$level['code'] }}" id="level">
            <div class="modal-body">
                <div class="row my-3">
                    <div class="col-6">
                        <div class="form-group mx-2 mb-3">
                            <label class="form-label" for="effectif">Effectif de la classe<span class="text-danger">*</span> :</label>
                            <input type="text" name="effectif" class="form-control number" id="effectif" minlength="1" value="30">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mx-2 mb-3">
                            <label class="form-label" for="number">Nombre de classe<span class="text-danger">*</span> :</label>
                            <input type="text" name="number" class="form-control number" id="number" minlength="1" value="1">
                        </div>
                    </div>
                    @if($serie)
                    <div class="col-6 mt-2 mb-3" title="Série">
                        <div class="d-flex">
                            {{-- <label>Série <span class="text-danger">*</span> :</label> --}}
                            @php $i = 0; @endphp
                            @while ($i < sizeof($serie))
                            <span class="form-check mx-2">
                                <input type="radio" name="serie" id="serie{{ $serie[$i]['id'] }}" class="form-check-input check-serie" value="{{ $serie[$i]['id'].'_'.$serie[$i]['libelle'] }}" {{ $i == 0 ? 'checked':null }}>
                                <label class="form-check-label" for="serie{{ $serie[$i]['id'] }}">{{ $serie[$i]['libelle'] }}</label>
                            </span>
                            @php $i++ @endphp
                            @endwhile
                        </div>
                    </div>
                    @endif
                    @if(in_array($level['id'], [3, 4, 5, 6, 7]))
                    <div class="col-6 mt-2 mb-3" id="lv2Div" title="LV2">
                        <div class="d-flex">
                            {{-- <label>LV2 <span class="text-danger">*</span> :</label> --}}
                            <span class="form-check mx-2" title="Allemand">
                                <input class="form-check-input" type="radio" name="lv2" id="all" value="allemand" checked>
                                <label class="form-check-label" for="all">All</label>
                            </span>
                            <span class="form-check mx-2" title="Espagnol">
                                <input class="form-check-input" type="radio" name="lv2" id="esp" value="espagnol">
                                <label class="form-check-label" for="esp">Esp</label>
                            </span>
                            <span class="form-check mx-2" title="Classe mixte">
                                <input class="form-check-input" type="radio" name="lv2" id="mixt" value="mixte">
                                <label class="form-check-label" for="mixt">Mix</label>
                            </span>
                        </div>
                    </div>
                    @endif

                    @if($school['autres'])
                    <div class="col-12 mt-2">
                        <div class="d-flex">
                            {{-- <label class="mx-2">Autre <span class="text-danger">*</span> :</label> --}}
                            <span class="form-check mx-2" title="Musique">
                                <input class="form-check-input" type="radio" name="autres" id="musique" value="musique" checked>
                                <label class="form-check-label" for="musique">Musique</label>
                            </span>
                            <span class="form-check mx-2" title="Arts Plastique">
                                <input class="form-check-input" type="radio" name="autres" id="arts" value="arts plastique">
                                <label class="form-check-label" for="arts">Arts Plastique</label>
                            </span>
                        </div>
                    </div>
                    @endif
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
<!-- Edit Classe Model -->
<div class="modal fade" id="btnEdit" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title">Edit</h5>
                <strong id="strong" style="font-size: 19px"></strong>
            </div>
            <form action="{{ route('classe.update') }}" method="post">
            @csrf
            <input type="hidden" name="id" id="editId">
            <div class="modal-body">
                <div class="row my-3">
                    <div class="col-6">
                        <div class="form-group mx-2 mb-3">
                            <label class="form-label" for="editNbre">Effectif de la classe<span class="text-danger">*</span> :</label>
                            <input type="text" name="effectif" class="form-control number" id="editNbre" minlength="1">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mx-2 mb-3">
                            <label class="form-label">Status :</label>
                            <div class="my-2">
                                <input type="checkbox" name="status" id="status" class="mx-2">
                                <label class="form-label" for="status" id="label"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-2" id="editLv2" style="display: none">
                        <div class="d-flex">
                            {{-- <label>LV2 <span class="text-danger">*</span> :</label> --}}
                            <span class="form-check mx-2" title="Allemand">
                                <input class="form-check-input" type="radio" name="lv2" id="allEdit" value="allemand" checked>
                                <label class="form-check-label" for="allEdit">All</label>
                            </span>
                            <span class="form-check mx-2" title="Espagnol">
                                <input class="form-check-input" type="radio" name="lv2" id="espEdit" value="espagnol">
                                <label class="form-check-label" for="espEdit">Esp</label>
                            </span>
                            <span class="form-check mx-2" title="Classe mixte">
                                <input class="form-check-input" type="radio" name="lv2" id="mixEdit" value="mixte">
                                <label class="form-check-label" for="mixEdit">Mix</label>
                            </span>
                        </div>
                    </div>
                    @if($school['autres'])
                    <div class="col-6 mt-2">
                        <div class="d-flex">
                            <span class="form-check" title="Musique">
                                <input class="form-check-input" type="radio" name="autres" id="editMus" value="musique">
                                <label class="form-check-label" for="editMus">Musique</label>
                            </span>
                            <span class="form-check mx-2" title="Arts Plastique">
                                <input class="form-check-input" type="radio" name="autres" id="EditArt" value="arts plastique">
                                <label class="form-check-label" for="EditArt">Arts Plastique</label>
                            </span>
                        </div>
                    </div>
                    @endif
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
<!-- Detele Classe Model -->
<div class="modal fade" id="dteModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete</h5>
                <strong id="delet" style="font-size: 19px"></strong>
            </div>
            <form action="{{ route('classe.destroy') }}" method="post">
            @csrf
            <input type="hidden" name="id" id="deteleId">
            <div class="modal-body">
                <div class="text-center mx-2 mb-3">
                    <p>Confirmez la suppression de cette classe</p>
                    <b id="libDelete"></b>
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
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {

        $('.number').on('keypress', function(e) {
            var charCode = e.which ? e.which : e.keyCode;
            if (charCode < 48 || charCode > 57) {
                e.preventDefault();
            }
        });


        $('#addClass').on('click', function() {
            if($(this).data('id')){
                // Affichage du modal -------------------------
                var modal = new bootstrap.Modal($('#addModal'));
                modal.show();
            }
        });


        $('.btnEdit').on('click', function() {
            if($(this).data('id')){
                $.ajax({
                    url: '{{ route('classe.edit') }}',
                    method: 'GET',
                    data: {id: $(this).data('id')},
                    success: function(data) {
                        $('#editId').val(data['id']);
                        $('#strong').text(data['libelle']);
                        $('#editNbre').val(data['effectif']);
                        $('#label').text(data['status'] == 1 ? 'Actif':'Iactif');
                        data['status'] == 1 ? 
                        $('#status').prop('checked', true):
                        $('#status').prop('checked', false);
                        data['autre'] == 'musique' ? $('#editMus').prop('checked', true):$('#EditArt').prop('checked', true);
                        if(data['lv2']){
                            $('#editLv2').show();
                            if(data['lv2'] == 'allemand'){
                                $('#allEdit').prop('checked', true);
                            }
                            else if(data['lv2'] == 'espagnol'){
                                $('#espEdit').prop('checked', true);
                            }
                            else if(data['lv2'] == 'mixte'){
                                $('#mixEdit').prop('checked', true);
                            }
                        }
                        // Affichage du modal -------------------------
                        var modal = new bootstrap.Modal($('#btnEdit'));
                        modal.show();
                    },
                });
            }
        });


        // Delete Classe
        $('.btnDelete').on('click', function() {
            $val = $(this).data('lib');
            if($val){
                $data = $val.split('_');
                $('#delet').text($data[1]);
                $('#deteleId').val($data[0]);
                $('#libDelete').text($data[1]);
                // Affichage du modal -------------------------
                var modal = new bootstrap.Modal($('#dteModal'));
                modal.show();
            }
        });


        $('.check-serie').on('click', function() {
            $level = ($('#level').val()).split('_');
            if($(this).val()){
                $val = ($(this).val()).split('_');
                if($level[0] != 5 && ($val[1] == 'C' || $val[1] == 'D')){
                    $('input[name="lv2"]').prop('checked', false);
                    $('#lv2Div').hide();
                }
                else{
                    $('input[name="lv2"]').prop('checked', true);
                    $('#lv2Div').show();
                }
            }
        });


        $('#myTable').DataTable({
            pageLength: 10,
            lengthMenu: [10, 25, 50],
        });
    })
</script>
@endsection