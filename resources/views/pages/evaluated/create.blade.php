
@extends('app')
@section('title', 'Add Note')
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
                  <h5 class="mb-0">Add Note - <span style="text-decoration: underline">{{ ucwords($evaluated->disciplineLevel->discipline->abbreviat) }}</span></h5>
                  <h5 class="mb-0" style="text-decoration: underline">{{ $evaluated->classe->libelle }}</h5>
                  <span style="float: right; ">
                    <button type="button" class="btn btn-outline-light py-1 mb-1" id="addBtn" style="font-size: 12px; border-radius: 2px" disabled>Save</button>
                    <button type="button" class="btn btn-outline-light py-1 mb-1" id="fileBtn" style="font-size: 12px; border-radius: 2px">Import</button>
                    <a href="#" class="btn btn-outline-light py-1 mb-1" style="font-size: 12px; border-radius: 2px">Back</a>
                  </span>
                </div>
                <div class="card-body">
                  <form action="{{ route('evaluated.store') }}" method="post" id="myForm">
                    @csrf
                    <div class="table-responsive mt-4">
                      <span class="my-0 py-0" style="position: absolute; font-size: 17px">
                        {{ ucwords($evaluated->type) }} du <u class="text-white">{{ date('d-m-Y', strtotime($evaluated->created)) }}</u>
                      </span>
                      <table class="table table-striped table-bordered mt-0" id="Transaction-History" style="border: 1px solid">
                          <thead>
                              <tr class="table-dark">
                                  <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 5%"></th>
                                  <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 20%">Matricule</th>
                                  <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 35%">Mon & Prenoms</th>
                                  <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 20%">Genre</th>
                                  <th class="text-center py-2" scope="col" style="width: 20%">Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                            @php $i = 0; @endphp
                            @foreach ($students as $item)
                            <tr>
                              <td scope="col" class="text-center">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                              <td class="text-center">{{ $item->matricule }}</td>
                              <td title="{{ strtoupper($item->first_name).' '.ucwords($item->last_name) }}">
                                {{ strtoupper($item->first_name).' '.Str::limit(ucwords($item->last_name), '25', '...') }}
                              </td>
                              <td class="text-center">
                                {{ $item->genre == 'F' ? 'Feminin':'Masculin' }}
                              </td>
                              <td class="p-0 d-flex text-center">
                                <div class="input-group m-0" style="margin: 0% auto">
                                  <input type="text" class="form-control w-50 myInput" placeholder="Add Not" style="border-radius: 1px">
                                  <span class="input-group-text w-50" id="inputGroup-sizing-default" style="border-radius: 1px"><strong>/ {{ $evaluated->value*20 }}</strong></span>
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                    </div>
                    <hr>
                    <div class="text-center">
                      <button class="btn btn-dark w-25" id="btnValid">Confirm ...</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Model Import File -->
<div class="modal fade" id="fileModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
              <h5 class="modal-title">Import File</h5>
              <h5 class="modal-title">{{ ucwords($evaluated->disciplineLevel->discipline->abbreviat) }}</h5>
            </div>
            <form action="{{ route('evaluated.import') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
                <div class="row my-3">
                  <div class="col-12">
                    <a href="{{ route('evaluated.export', $evaluated->id) }}" class="btn btn-outline-secondary my-1 mx-2 py-0 exportBtn" style="float:right; border-radius: 50px">
                      <i class="lni lni-download m-0" style="font-size: 15px"></i>
                    </a>
                    <div class="form-group mx-1 mb-3">
                      <label class="form-label" for="fichier">Select file<span class="text-danger">*</span> :</label>
                      <input type="file" name="fichier" class="form-control" id="fichier" aria-describedby="inputGroupFileAddon04" aria-label="Upload" style="border-radius: 3px">
                    </div>
                  </div>
                </div>
              </div>
              <input type="hidden" name="evaluated" value="{{  $evaluated->id }}">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Form ...</h1>
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

      // Autoriser les touches numériques (0-9) et la touche backspace (code 8)
      $('.myInput').on('keypress', function(e) {
          var key = e.which || e.keyCode;
          if ((key >= 48 && key <= 57) || key === 8 || key === 46 || key === 127) {
              return true;
          } else {
              e.preventDefault();
          }
      });


      $('#fileBtn').on('click', function() {
        var modal = new bootstrap.Modal($('#fileModal'));
        modal.show();
      });


      $('.exportBtn').on('click', function() {
        $('#fileModal').modal('hide');
        setTimeout(function() {
          $msg = 'Téléchargement effectué';
          getNotify('info', 'bx bx-info-circle', $msg, 'top left');
        }, 1500)
      });


      $('#btnValid').on('click', function(e) {
        e.preventDefault()
        var modal = new bootstrap.Modal($('#confirmModal'));
        modal.show();
      });


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
        
       // Soumet le formulaire
        $('#myForm').submit();
      });

      
      $msg = '{{ session("msg") }}';
      if($msg){
        getNotify('success', 'bx bx-check-circle', $msg, 'top right');
      }


      // Function JS
      function getNotify($type, $icon, $message, $position){
        Lobibox.notify($type, {
            pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            position: $position,
            icon: $icon,
            msg: $message
        });
      }
    });
</script>
@endsection