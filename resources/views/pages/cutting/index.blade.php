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
        <div class="col-12 px-lg-2">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-0 mb-0">
                    <h5 class="mb-0">Cutting</h5>
                    <div id="table-recent-leads-actions">
                        <button type="button" class="btn btn-outline-light py-0 px-2 mb-1" id="{{ count($dts) ? 'edit':'add' }}" title="{{ count($dts) ? 'Edit Cutting':'New Cutting' }}" style="border: none; border-radius: 3px">
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
                                    <th class="text-center py-2" scope="col" style="border-right: 1px solid white">Libellé</th>
                                    <th class="text-center py-2" scope="col" style="border-right: 1px solid white">Statut</th>
                                    <th class="text-center py-2" scope="col" style="width: 30%">Période</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach ($dts as $item)
                                    <tr class="dataYear">
                                        <td class="text-center">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                                        <td class="text-center">{{ ucwords($item['cutting']['libelle']) }}</td>
                                        <td class="text-center">
                                            <div class="badge bg-{{ getStatus($item['status'])[0] }} w-25 py-1">
												<span>{{ getStatus( $item['status'])[1] }}</span>
											</div>
                                        </td>
                                        <td class="text-center">{{ date('d/m/Y', strtotime($item['start'])) }} - {{ date('d/m/Y', strtotime($item['end'])) }}</td>
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
                    <div class="modal-header py-2">
                        <h5 class="mb-0" id="modalExampleDemoLabel">New</h5>
                        <strong style="font-size: 17px">Cutting</strong>
                    </div>
                    <div class="py-4 px-1 pb-0">
                        <table class="table table-bordered mx-0">
                            <thead>
                                <tr>
                                    <td class="text-center" style="font-size: 13px"></td>
                                    <td class="text-center" style="font-size: 13px">Debut</td>
                                    <td class="text-center" style="font-size: 13px">Fin</td>
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
                    <div class="modal-header py-2">
                        <h5 class="mb-0" id="modalExampleDemoLabel">Edit</h5>
                        <strong style="font-size: 17px">Cutting</strong>
                    </div>
                    <hr class="mt-0">
                    <div class="py-4 px-1 pb-0">
                        <table class="table table-bordered mx-0" id="editTable">
                            <thead>
                                <tr>
                                    <td class="text-center" style="font-size: 13px"></td>
                                    <td class="text-center" style="font-size: 13px">Debut</td>
                                    <td class="text-center" style="font-size: 13px">Fin</td>
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