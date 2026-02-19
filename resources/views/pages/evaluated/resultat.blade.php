
@extends('app')
@section('title', 'Resultat')
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
                  <h5 class="mb-0" title="{{ $classe->lv2 == 'mixte' ? $matter->discipline->abbreviat:ucwords($matter->discipline->libelle) }}">
                    <span id="libelle">Resultat - <span style="text-decoration: underline">{{ $classe->lv2 == 'mixte' ? session('lv2'):strtoupper(changeValMatter($matter->discipline->abbreviat, $classe->autre)) }}</span> - {{ $classe->libelle }}</span>
                  </h5>
                  <h5 class="mb-0" style="text-decoration: underline">{{ ucwords($cutting->cutting->libelle) }}</h5>
                  <span class="px-0" style="float: right;">
                    <button type="button" class="btn btn-outline-light py-0 px-2 mb-1" id="confirm" title="Confirmation" style="border: none; border-radius: 3px" {{ $exist ? 'disabled':null }}>
                      <i class="fadeIn animated bx bx-duplicate m-0" style="font-size: 17px"></i>
                    </button>
                    @if (!$exist)
                      <a href="{{ route(($teacher ? 'evaluation.edit':'evaluated.edit'), $classe->id.'_'.$matter->id.'_'.$cutting->id) }}" type="button" class="btn btn-outline-light py-0 px-2 mb-1" style="border: none; border-radius: 3px" title="Edit Moyenne">
                        <i class="fadeIn animated bx bx-edit-alt mx-0" style="font-size: 17px"></i>
                      </a>
                    @endif
                    <a href="{{ route(($teacher ? 'evaluation.back':'evaluated.back'), $classe->id.'_'.$matter->id) }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                      <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                    </a>
                  </span>
                </div>
                <div class="card-body">
                  <div class="table-responsive mt-4">
                    <span class="my-0 py-0 w-25 d-flex justify-content-between" style="position: absolute; font-size: 17px">
                      <a href="{{ route(($teacher ? 'evaluation.pdf_2':'evaluated.pdf_2'), $classe->id.'_'.$matter->id.'_'.$cutting->id) }}" target="_blank" class="btn btn-light py-1 px-2 mb-1" title="Pdf File" style="border: none; border-radius: 3px">
                        <i class="lni lni-download m-0" style="font-size: 15px"></i>
                      </a>
                    </span>
                    @include($verify ? 'partials._tble2':'partials._tble1')
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
        <form action="{{ route($teacher ? 'evaluation.approved':'evaluated.approved') }}" method="get">
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
            <input type="hidden" name="str" value="{{ $classe->id.'_'.$matter->id.'_'.$cutting->id }}">
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

    $('#myTable').DataTable({
      ordering: false
    });

    $('#confirm').on('click', function(e) {
      e.preventDefault()
      var modal = new bootstrap.Modal($('#confirmModal'));
      modal.show();
    });
   
  });
</script>
@endsection