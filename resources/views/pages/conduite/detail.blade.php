
@extends('app')
@section('title', 'Detail Conduite')
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
        <div class="col-12 px-lg-2">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-2 mb-0">
                  <h5 class="mb-0">
                    <span id="libelle">Moyenne {{ ucwords($matter->libelle) }} - <span style="text-decoration: underline">{{ $classe->libelle }}</span>
                  </h5>
                  <h5 class="mb-0" style="text-decoration: underline">{{ ucwords($cutting->cutting->libelle) }}</h5>
                  <span class="px-0" style="float: right;">
                    <button type="button" class="btn btn-outline-light py-0 px-2 mb-1" id="confirm" title="Confirmation" style="border: none; border-radius: 3px">
                      <i class="fadeIn animated bx bx-duplicate m-0" style="font-size: 17px"></i>
                    </button>
                    <a href="{{ route('conduite.create', $classe->id.'_'.$cutting->id) }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Edit Info" style="border: none; border-radius: 3px">
                      <i class="fadeIn animated bx bx-edit-alt m-0" style="font-size: 17px"></i>
                    </a>
                    {{-- <button type="button" class="btn btn-outline-light py-0 px-2 mb-1" id="btnFile" style="border: none; border-radius: 3px" title="Import Fille">
                      <i class="lni lni-radio-button mx-0" style="font-size: 17px"></i>
                    </button> --}}
                    <a href="{{ route('conduite.index') }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                      <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                    </a>
                  </span>
                </div>
                <div class="card-body">
                  <div class="table-responsive mt-4">
                    <span class="my-0 py-0" style="position: absolute; font-size: 17px">
                      <a href="#" target="_black" class="btn btn-outline-light py-0 px-2 mb-1" style="float:right; border: none; border-radius: 3px" title="DownLoad PDF">
                        <i class="lni lni-download m-0" style="font-size: 17px"></i>
                      </a>
                    </span>
                    <table class="table table-striped table-bordered mt-0" id="Transaction-History" style="border: 1px solid">
                      <thead>
                        <tr class="table-dark">
                          <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 5%"></th>
                          <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 8%">Matricule</th>
                          <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 25%">Nom & Prenoms</th>
                          <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 5%">Genre</th>
                          <th class="text-center py-2" scope="col" style="border-right: 1px solid white;">Sanction 1</th>
                          <th class="text-center py-2" scope="col" style="border-right: 1px solid white;">Sanction 2</th>
                          <th class="text-center py-2" scope="col" style="border-right: 1px solid white;">Sanction 3</th>
                          <th class="text-center py-2" scope="col" style="border-right: 1px solid white;">Sanction 4</th>
                          <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 7%">Moyenne</th>
                          <th class="text-center py-2" scope="col" style="width: 7%">Rang</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $i = 0; @endphp
                        @foreach ($data as $item)
                        <tr>
                          <td scope="col" class="text-center">{{ $i < 9 ? '0'.$i+=1:$i+=1 }}</td>
                          <td class="text-center">{{ $item['matricule'] }}</td>
                          <td title="{{ $item['name'] }}">
                            {{ Str::limit($item['name'], '30', '...') }}
                          </td>
                          <td class="text-center">{{ $item['genre'] }}</td>
                          <td class="text-center">1</td>
                          <td class="text-center">2</td>
                          <td class="text-center">3</td>
                          <td class="text-center">4</td>
                          <td class="text-center">{{ $item['moyen'] ? $item['moyen']['moyenne']:'---'}}</td>
                          <td class="text-center">{{ $item['moyen'] ? $item['moyen']['rang']:'---'}}</td>
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
<!-- Modal Confirm -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="{{ route('evaluated.confirme') }}" method="get">
          @csrf
          <div class="modal-header py-2">
            <h3 class="modal-title fs-5" id="exampleModalLabel">Confirm Moyen</h3>
            <strong style="font-size: 17px">{{ ucwords($cutting->cutting->libelle) }}</strong>
          </div>
          <div class="modal-body">
            <div class="text-center">
              <div style="width: 40px; height: 40px; border: 1px solid; margin: auto; border-radius: 100px">
                <i class="fadeIn animated bx bx-question-mark" style="font-size: 30px"></i>
              </div>
              <p class="mt-3">Confirmez que ces moyennes sont correctes !</p>
            </div>
          </div>
          <div class="modal-footer">
            {{-- <input type="hidden" name="str" value="{{ $classe->id.'_'.$matter->id.'_'.$cutting->id }}"> --}}
            <button class="btn btn-secondary py-1" style="font-size: 12px; border-radius: 2px;" type="button" data-bs-dismiss="modal">Annuler</button>
            <button type="submit" id="submit" class="btn btn-primary py-1" style="font-size: 12px; border-radius: 2px;">Valider</button>
          </div>
        </form>
      </div>
  </div>
</div>
@endsection
@section('script')
<script>
  $(document).ready(function() {
    // Confirmation de la moyenne trimestrielles ------
    $('#confirm').on('click', function(e) {
      e.preventDefault();
      var modal = new bootstrap.Modal($('#confirmModal'));
      modal.show();
    });
   
  });
</script>
@endsection