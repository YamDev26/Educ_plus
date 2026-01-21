
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
                    <span id="libelle">Add Conduite - <span style="text-decoration: underline">{{ $classe->libelle }}</span>
                  </h5>
                  <h5 class="mb-0" style="text-decoration: underline">{{ ucwords($cutting->cutting->libelle) }}</h5>
                  <span class="px-0" style="float: right;">
                    <button type="button" class="btn btn-outline-light py-0 px-2 mb-1" id="btnFile" style="border: none; border-radius: 3px" title="Import Fille">
                      <i class="lni lni-radio-button mx-0" style="font-size: 17px"></i>
                    </button>
                    <a href="{{ route('conduite.return', $classe->id.'_'.$cutting->id) }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                      <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                    </a>
                  </span>
                </div>
                <div class="card-body">
                  <form action="{{ route('conduite.store') }}" method="post" id="myForm">
                    @csrf
                    <div class="table-responsive mt-4">
                      <table class="table table-striped table-bordered mt-0" id="Transaction-History" style="border: 1px solid">
                        <thead>
                          <tr class="table-dark">
                            <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 5%"></th>
                            <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 10%">Matricule</th>
                            <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 31%">Nom & Prenoms</th>
                            <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 10%">Genre</th>
                            <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 10%">Justifiée</th>
                            <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 15%">Non Justifiée</th>
                            <th class="text-center py-2" scope="col" style="width: 12%">Moyenne</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $i = 0; @endphp
                          @foreach ($data as $item)
                          <tr>
                            <td scope="col" class="text-center">{{ $i < 9 ? '0'.$i+=1:$i+=1 }}</td>
                            <td class="text-center">{{ $item['matricule'] }}</td>
                            <td title="{{ $item['name'] }}">
                              {{ Str::limit($item['name'], '35', '...') }}
                            </td>
                            <td class="text-center">{{ $item['genre'] }}</td>
                            <td class="text-center p-0">
                              <input type="text" name="justifie[]" class="form-control my-0 text-center number" value="{{ $item['time'] ? $item['time']['justify']:null }}" placeholder="---">
                            </td>
                            <td class="text-center p-0">
                              <input type="text" name="justifieNon[]" class="form-control my-0 text-center number" value="{{ $item['time'] ? $item['time']['injustify']:null }}" placeholder="---">
                            </td>
                            <td class="text-center p-0">
                              <input type="hidden" name="stdt[]" value="{{ $item['id'].'_'.$item['genre'] }}">
                              <input type="text" name="moyen[]" class="form-control my-0 text-center number moyen" data-vals="20" value="{{ $item['moyen'] ? $item['moyen']['moyenne']:null}}" placeholder="---">
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <hr>
                    <div class="text-center">
                      <input type="hidden" name="class" value="{{ $classe->id }}">
                      <input type="hidden" name="matter" value="{{ $matter->id }}">
                      <input type="hidden" name="cutting" value="{{ $cutting->id }}">
                      <button class="btn btn-dark w-25" id="btnValid">Confirm ...</button>
                    </div>
                  </form>
                </div>
            </div>
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
            <form action="{{ route('conduite.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="class" value="{{ $classe->id }}">
                    <input type="hidden" name="matter" value="{{ $matter->id }}">
                    <input type="hidden" name="cutting" value="{{ $cutting->id }}">
                    <div class="form-group mx-1 mb-3">
                      <a href="{{ route('conduite.export', $classe->id.'_'.$cutting->id) }}" class="btn btn-outline-light my-1 mx-2 px-2 py-0 exportBtn" style="float:right; border: none; border-radius: 3px" title="DownLoad File">
                      <i class="lni lni-download m-0" style="font-size: 17px"></i>
                      </a>
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
<!-- Modal Confirm -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
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
          <button class="btn btn-secondary py-1" style="font-size: 12px; border-radius: 2px;" type="button" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" id="submit" class="btn btn-primary py-1" style="font-size: 12px; border-radius: 2px;">Valider</button>
        </div>
      </div>
  </div>
</div>
@endsection
@section('script')
<script>
  $(document).ready(function() {
    // Autoriser les touches numériques (0-9) et la touche backspace (code 8)
    $('.number').on('keypress', function(e) {
      var key = e.which || e.keyCode;
      if ((key >= 48 && key <= 57) || key === 8 || key === 46 || key === 127) {
        return true;
      } else {
        e.preventDefault();
      }
    });


    $('#submit').click(function() {
      let table = $('#Transaction-History').DataTable();
      // Rendre tous les éléments visibles temporairement pour que les champs soient inclus dans le formulaire
      table.rows().every(function(rowIdx, tableLoop, rowLoop) {
        var row = this.node();
        if (!$(row).is(':visible')) {
          $(row).find('input, select, textarea').each(function() {
            var name = $(this).attr('name');
            var value = $(this).val();
            $('<input>').attr({
              type: 'hidden',
              name: name,
              value: value
            }).appendTo('#myForm');
          });
        }
      });
      $('#myForm').submit();
    });


    // Vérifier que la valeur saisie n'est pa superieur à 20
    $('.moyen').keyup(function() {
      if($(this).val() > $(this).data('vals')){
        $(this).val(null);
      }
    });

    // Confirmation de la moyenne trimestrielles ------
    $('#btnValid').on('click', function(e) {
      e.preventDefault();
      var modal = new bootstrap.Modal($('#confirmModal'));
      modal.show();
    });


    $('#btnFile').on('click', function(e) {
      e.preventDefault();
      var modal = new bootstrap.Modal($('#fileModal'));
      modal.show();
    });
   
  });
</script>
@endsection