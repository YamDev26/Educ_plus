@extends('app')
@section('title', 'Cutting')
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
        <div class="col-lg-10 col-12 offset-lg-1">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-0 mb-0">
                    <h5 class="mb-0">Gestion Des Découpages</h5>
                    <div id="table-recent-leads-actions">
                        @if (count($dts))
                            <button class="btn btn-outline-light py-1 mb-1" type="button" id="edit" style="font-size: 12px; border-radius: 2px">Edit</button>
                        @else
                            <button class="btn btn-outline-light py-1 mb-1" type="button" id="add" style="font-size: 12px; border-radius: 2px">Add</button>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-bordered" id="Transaction-History">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center" scope="col"></th>
                                    <th class="text-center" scope="col">Libellé</th>
                                    <th class="text-center" scope="col">Statut</th>
                                    <th class="text-center" scope="col">Période</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach ($dts as $item)
                                    <tr class="dataYear">
                                        <td class="text-center">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                                        <td class="text-center">{{ ucwords($item['cutting']['libelle']) }}</td>
                                        <td class="text-center">
                                            <div class="badge bg-{{ getStatus($item['status'])[0] }} d-flex align-items-center text-white w-50" style="margin: 0px auto">
                                                <i class="bx bx-radio-circle-marked bx-burst bx-rotate-90 align-middle font-18 me-1"></i>
												<span>{{ getStatus( $item['status'])[1] }}</span>
											</div>
                                        </td>
                                        <td class="text-center">du {{ date('d/m/Y', strtotime($item['start'])) }} au {{ date('d/m/Y', strtotime($item['end'])) }}</td>
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
<!-- Modal Add School Year -->
<div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 500px">
        <div class="modal-content position-relative">
            <form action="{{ route('cutting.store') }}" method="post">
                @csrf
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-2 ps-4 pe-6">
                        <h5 class="mb-0 pt-2" id="modalExampleDemoLabel">New Cutting</h5>
                    </div>
                    <hr>
                    <div class="py-4 px-1 pb-0">
                        <table class="table table-bordered mx-0">
                            <thead>
                                <tr>
                                    <td class="text-center" style="font-size: 13px"></td>
                                    <td class="text-center" style="font-size: 13px">Date debut</td>
                                    <td class="text-center" style="font-size: 13px">Date Fin</td>
                                </tr>
                            </thead>
                            <tbody>
                                <input type="hidden" name="year" id="year" value="{{ $year }}">
                                @foreach ($cutting as $item)
                                    <tr>
                                        <td class="p-0" style="font-size: 13px">
                                            <p class="m-2">{{ ucwords($item['libelle']) }}</p>
                                            <input type="hidden" name="id[]" value="{{ $item['id'] }}">
                                        </td>
                                        <td class="p-0">
                                            <input type="date" name="debut[]" class="form-control py-2" style="font-size: 13px; border-radius: 0px; border: none">
                                        </td>
                                        <td class="p-0">
                                            <input type="date" name="fin[]" class="form-control py-2" style="font-size: 13px; border-radius: 0px; border: none">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
            <form action="{{ route('cutting.update') }}" method="post">
                @csrf
                <div class="modal-body p-0">
                    <div class="rounded-top-3 p-1">
                        <h5 class="mb-0 py-2" id="modalExampleDemoLabel">Edit Cutting</h5>
                    </div>
                    <hr>
                    <div class="py-4 px-1 pb-0">
                        <table class="table table-bordered mx-0" id="editTable">
                            <thead>
                                <tr>
                                    <td class="text-center" style="font-size: 13px"></td>
                                    <td class="text-center" style="font-size: 13px">Date debut</td>
                                    <td class="text-center" style="font-size: 13px">Date Fin</td>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Content Table  -->
                            </tbody>
                        </table>
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
        // 
        $('#add').on('click', function() {
            // Affichage du modal -------------------------
            var modal = new bootstrap.Modal($('#add-modal'));
            modal.show();
        });

        $('#edit').on('click', function() {
            $year = $('#year').val();
            $('.editRow').remove();
            if($year){
                $.ajax({
                    url: '{{ route('cutting.edit') }}',
                    method: 'GET',
                    data: {
                        id: $year
                    },
                    success: function(data){
                        $i = 0;
                        while($i < data.length){
                            $row = (`<tr class="editRow">
                                <td class="p-0" style="font-size: 13px">
                                    <p class="m-2">`+capitalizeFirstLetter(data[$i]['libelle'])+`</p>
                                    <input type="hidden" name="id[]" value="`+data[$i]['id']+`">
                                </td>
                                <td class="p-0">
                                    <input type="date" name="debut[]" class="form-control py-2" value="`+data[$i]['start']+`" style="font-size: 13px; border-radius: 0px; border: none">
                                </td>
                                <td class="p-0">
                                    <input type="date" name="fin[]" class="form-control py-2" value="`+data[$i]['end']+`" style="font-size: 13px; border-radius: 0px; border: none">
                                </td>
                            </tr>`);
                            $('#editTable tbody').append($row);
                            $i++;
                        }

                        // Affichage du modal -------------------------
                        var modal = new bootstrap.Modal($('#edit-modal'));
                        modal.show();
                    }
                }); 
            }
        });

        function capitalizeFirstLetter(texte) {
            return texte.charAt(0).toUpperCase() + texte.slice(1).toLowerCase();
        }
    })
</script>
@endsection