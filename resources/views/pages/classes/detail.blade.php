@extends('app')
@section('title', 'Classe '.$level['code'])
@section('content')
<div class="page-content">
    <div class="rox">
        <div class="col-lg-10 col-12 offset-lg-1">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-2 mb-0">
                    <h5 class="mb-0">Classe Niveau {{ $level['code'] }}</h5>
                    <span style="float: right; ">
                        <button type="button" data-id="{{ $level['id'] }}" id="addClass" class="btn btn-outline-light py-1 mb-1" style="font-size: 12px; border-radius: 2px">Add</button>
                        <a href="{{ route('classe.index') }}" class="btn btn-outline-light py-1 mb-1" style="font-size: 12px; border-radius: 2px">Back</a>
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="table-dark">
                                    <th class="text-center" scope="col"></th>
                                    <th class="text-center" scope="col">Libellé</th>
                                    <th class="text-center" scope="col">Effectif</th>
                                    <th class="text-center" scope="col">Status</th>
                                    <th class="text-center w-25" scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @forelse ($data as $item)
                                <tr>
                                    <td class="text-center">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                                    <td class="text-center">{{ $item['libelle'] }}</td>
                                    <td class="text-center">{{ ($item['inscrit'] <= 9 ? '0'.$item['inscrit']:$item['inscrit']).'/'.$item['effectif'] }}</td>
                                    <td class="text-center">
                                        <div class="badge bg-{{ getStatus($item['status'])[0] }} d-flex align-items-center text-white w-25 px-2" style="margin: 0px auto">
                                            <span>{{ getStatus($item['status'])[1] }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center py-1">
                                        <div class="d-flex justify-content-center order-actions my-0">
                                            <button class="mx-1 p-1"><i class="bx bx-edit" style="font-size: 12px"></i></button>
                                            <button class="mx-1 p-1"><i class="bx bx-trash" style="font-size: 12px"></i></button>
                                        </div>
                                        {{-- <a href="{{ route('classe.show', $item['id']) }}" class="btn btn-outline-light py-1" style="font-size: 10px; border-radius: 2px">Info</a> --}}
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
<div class="modal fade" id="addModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Classe</h5>
            </div>
            <form action="{{ route('classe.store') }}" method="post">
            @csrf
            <input type="hidden" name="level" value="{{ $level['id'].'_'.$level['code'] }}">
            <div class="modal-body">
                <div class="row my-3">
                    <div class="col-6">
                        <div class="form-group mx-2 mb-3">
                            <label class="form-label" for="effectif">Effectif de la classe<span class="text-danger">*</span> :</label>
                            <input type="text" name="effectif" class="form-control" id="effectif" minlength="1" value="30">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mx-2 mb-3">
                            <label class="form-label" for="number">Nombre de classe<span class="text-danger">*</span> :</label>
                            <input type="text" name="number" class="form-control" id="number" minlength="1" value="1">
                        </div>
                    </div>
                    @if($serie)
                    <div class="col-6 mt-2">
                        <label>Série <span class="text-danger">*</span> :</label>
                        <div class="d-flex justify-content-evenly">
                            @foreach ($serie as $item)
                            <span class="form-check">
                                <input type="radio" name="serie" id="serie{{ $item['id'] }}" class="form-check-input" value="{{ $item['id'].'_'.$item['libelle'] }}" checked>
                                <label class="form-check-label" for="serie{{ $item['id'] }}">{{ $item['libelle'] }}</label>
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if(in_array($level['id'], [3, 4, 5, 6, 7]))
                    <div class="col-6 mt-2">
                        <label>LV2 <span class="text-danger">*</span> :</label>
                        <div class="d-flex justify-content-evenly">
                            <span class="form-check" title="Allemand">
                                <input class="form-check-input" type="radio" name="lv2" id="all" checked>
                                <label class="form-check-label" for="all">All</label>
                            </span>
                            <span class="form-check" title="Espagnol">
                                <input class="form-check-input" type="radio" name="lv2" id="esp">
                                <label class="form-check-label" for="esp">Esp</label>
                            </span>
                            <span class="form-check" title="Classe mixte">
                                <input class="form-check-input" type="radio" name="lv2" id="mixt">
                                <label class="form-check-label" for="mixt">Mixt</label>
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
@endsection
@section('script')
<script>
    $(document).ready(function() {

        $('#number, #effectif').on('keypress', function(e) {
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
        })
    })
</script>
@endsection