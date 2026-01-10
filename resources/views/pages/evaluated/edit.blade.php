
@extends('app')
@section('title', 'Edit Moyenne '. $classe->libelle)
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
                  <h5 class="mb-0">Edit Moyenne - <span style="text-decoration: underline">{{ $classe->lv2 == 'mixte' ? session('lv2'):ucwords(changeValMatter($matter->discipline->abbreviat, $classe->autre)) }}</span></h5>
                  <h5 class="mb-0" style="text-decoration: underline">{{ $classe->libelle .' - '. ucwords($cutting->cutting->libelle) }}</h5>
                  <span style="float: right; border-bottom: 1px dotted;">
                    <a href="{{ route('evaluated.return', $classe->id.'_'.$matter->id.'_'.$cutting->id) }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                      <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                    </a>
                  </span>
                </div>
                <div class="card-body">
                  <form action="{{ route('evaluated.moyenEdit') }}" method="post" id="myForm">
                    @csrf
                    <div class="table-responsive mt-4">
                      <span class="my-0 py-0" style="position: absolute; font-size: 17px">
                        Date : {{ date('d-m-Y') }}
                      </span>
                      <table class="table table-striped table-bordered mt-0" id="Transaction-History" style="border: 1px solid">
                          <thead>
                            <tr class="table-dark">
                              <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 5%"></th>
                              <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 20%">Matricule</th>
                              <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 35%">Nom & Prenoms</th>
                              <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 20%">Genre</th>
                              <th class="text-center py-2" scope="col" style="width: 20%">Moyenne</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php $i = 0; @endphp
                            @foreach ($data as $item)
                            <tr>
                              <td scope="col" class="text-center">{{ $i < 9 ? '0'.$i+=1:$i+=1 }}</td>
                              <td class="text-center">{{ $item['matricule'] }}</td>
                              <td title="{{ ucwords($item['name']) }}">
                                {{ Str::limit(ucwords($item['name']), '30', '...') }}
                              </td>
                              <td class="text-center">
                                {{ $item['genre'] == 'F' ? 'Feminin':'Masculin' }}
                              </td>
                              <td class="p-0 d-flex text-center">
                                <div class="input-group m-0" style="margin: 0% auto">
                                  <input type="hidden" name="student[]" value="{{$item['id'].'_'.$item['genre']}}">
                                  <input type="text" name="moyen[]" class="form-control w-50 myInput text-center" data-vals="20" value="{{ $item['resultat']['moyenne'] }}" style="border-radius: 1px; border: 1px dashed rgb(10, 17, 20)">
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                    </div>
                    <hr>
                    <div class="text-center">
                      <input type="hidden" name="str" value="{{ $classe->id.'_'.$matter->id.'_'.$cutting->id }}">
                      <button class="btn btn-dark w-25" id="btnValid">Confirm ...</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Confirm -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm</h1>
        <strong style="font-size: 17px">{{ ucwords($cutting->cutting->libelle) }}</strong>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <div style="width: 40px; height: 40px; border: 1px solid; margin: auto; border-radius: 100px">
            <i class="fadeIn animated bx bx-question-mark" style="font-size: 30px"></i>
          </div>
          <p class="mt-3">Êtes-vous sûr de vouloir soumettre ce formulaire ?</p>
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

      let table = $('#saving-reorder').DataTable();
      $('#submit').click(function() {
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


      // Autoriser les touches numériques (0-9) et la touche backspace (code 8)
      $('.myInput').on('keypress', function(e) {
        var key = e.which || e.keyCode;
        if ((key >= 48 && key <= 57) || key === 8 || key === 46 || key === 127) {
          return true;
        } else {
          e.preventDefault();
        }
      });

      // Vérifier que la valeur saisie n'est pa superieur à la valeur de l'evaluation
      $('.myInput').keyup(function() {
        if($(this).val() > $(this).data('vals')){
          $(this).val($(this).data('vals'));
        }
      });


      $('#btnValid').on('click', function(e) {
        e.preventDefault()
        var modal = new bootstrap.Modal($('#confirmModal'));
        modal.show();
      });
    });
</script>
@endsection