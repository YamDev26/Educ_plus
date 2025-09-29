@extends('app')
@section('title', 'cutting')
@section('content')
<div class="row g-3">
    <div class="col-12">
        <div class="card" id="TableCrmRecentLeads" data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;status&quot;],&quot;page&quot;:8,&quot;pagination&quot;:true}">
            <div class="card-header d-flex flex-between-center flex-wrap gap-2 pt-3 pb-0 mb-0">
                <h5 class="mb-0">Gestion Des Découpages</h5>
                <div id="table-recent-leads-actions">
                    @if(!$dts)
                    <button class="btn btn-falcon-default btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#add-modal" style="float: left">Cutting</button>
                    @endif
                </div>
            </div>
            <hr class="mt-0 mb-2 mx-4">
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    @include('partials._search')

                    <!-- Table de data -->
                    <table class="table table-bordered" id="yearTable">
                        <thead>
                            <tr class="table-active">
                                <th class="py-2 text-center" scope="col">#</th>
                                <th class="py-2 text-center" scope="col">Année Scolaire</th>
                                <th class="py-2 text-center" scope="col">Libellé</th>
                                <th class="py-2 text-center" scope="col">Statut</th>
                                <th class="py-2 text-center" scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0; @endphp
                            @forelse ($dts as $item)
                                <tr class="dataYear">
                                    <td class="text-center">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                                    <td class="text-center">{{ $item['libelle'] }}</td>
                                    <td class="text-center">{{ ucwords($item['cutting']) }}</td>
                                    <td class="text-center">
                                        <span class="badge badge rounded-pill d-block p-2 badge-subtle-{{ $item['actif'] ? 'success':'danger' }} w-50" style="margin: 0px auto">
                                            {{ $item['actif'] ? 'Actif':'Inactif' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-link p-0 editBtn" data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="{{ $item['id'] }}" title="Edit">
                                            <svg class="svg-inline--fa fa-edit fa-w-18 text-500" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                                                <path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path>
                                            </svg>
                                        </button>
                                        <button class="btn btn-link p-0 ms-2 deleteBtn" data-bs-toggle="modal" data-bs-target="#delete-modal" data-id="{{ $item['id'] }}" title="Delete">
                                            <svg class="svg-inline--fa fa-trash-alt fa-w-14 text-500" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                                <path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr class="dataYear">
                                    <td colspan="5" class="text-center">
                                        <span style="font-size: 13px">Informations Non Disponibles</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-fe77f32a-358a-42ac-9b73-d0222afa6979" id="dom-fe77f32a-358a-42ac-9b73-d0222afa6979">
    <!-- Modal Add School Year -->
    <div class="modal fade" id="add-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <form action="{{ route('cutting.store') }}" method="post">
                    @csrf
                    <div class="modal-body p-0">
                        <div class="rounded-top-3 py-2 ps-4 pe-6 bg-body-tertiary">
                            <h5 class="mb-1" id="modalExampleDemoLabel">New Cutting</h5>
                        </div>
                        <div class="py-4 px-1 pb-0">
                            <table class="table table-bordered mx-1">
                                <thead>
                                    <tr>
                                        <td class="text-center" style="font-size: 13px">#</td>
                                        <td class="text-center" style="font-size: 13px">Date debut</td>
                                        <td class="text-center" style="font-size: 13px">Date Fin</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" name="year" value="{{ $year }}">
                                    @foreach ($cutting as $item)
                                        <tr>
                                            <td class="p-0" style="font-size: 13px">
                                                <p class="m-2">{{ ucwords($item['libelle']) }}</p>
                                                <input type="hidden" name="id[]" value="{{ $item['id'] }}">
                                            </td>
                                            <td class="p-0">
                                                <input type="date" name="debut[]" class="form-control py-2" style="font-size: 13px">
                                            </td>
                                            <td class="p-0">
                                                <input type="date" name="fin[]" class="form-control py-2" style="font-size: 13px">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" style="font-size: 12px" type="button" data-bs-dismiss="modal">Annuler</button>
                        <button class="btn btn-primary" style="font-size: 12px" type="submit">Valider</button>
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
                        <div class="rounded-top-3 py-2 ps-4 pe-6 bg-body-tertiary">
                            <h5 class="mb-1" id="modalExampleDemoLabel">Edit School Year</h5>
                        </div>
                        <div class="p-4 pb-0">
                            <input type="hidden" name="id" id="idEdit">
                            <div class="mb-3">
                                <label class="col-form-label" for="yearEdit">Année Scoliare<span class="text-danger">*</span> :</label>
                                <input type="text" name="year" class="form-control" id="yearEdit" placeholder="2025-2026">
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="message-text">Libelle<span class="text-danger">*</span> :</label>
                                <span class="mx-2">
                                    <input type="radio" name="cutting" id="trimEdit" value="trimestre">
                                    <label for="trimEdit">Trimestre</label>
                                </span>
                                <span class="mx-2">
                                    <input type="radio" name="cutting" id="semEdit" value="semestre">
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
                    <div class="modal-footer">
                        <button class="btn btn-secondary" style="font-size: 12px" type="button" data-bs-dismiss="modal">Annuler</button>
                        <button class="btn btn-primary" style="font-size: 12px" type="submit">Valider</button>
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
                        <div class="rounded-top-3 py-2 ps-4 pe-6 bg-body-tertiary">
                            <h5 class="mb-1" id="modalExampleDemoLabel">Delete School Year</h5>
                        </div>
                        <div class="p-4 pb-0">
                            <input type="hidden" name="id" id="detele">
                            <div class="mb-3 text-center">
                                <strong id="text"></strong><br>
                                <span class="my-3" style="font-size: 13px">Vous êtes sur le point de supprimer cette information.</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" style="font-size: 12px" type="button" data-bs-dismiss="modal">Annuler</button>
                        <button class="btn btn-primary" style="font-size: 12px" type="submit">Valider</button>
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
       
    })
</script>
@endsection