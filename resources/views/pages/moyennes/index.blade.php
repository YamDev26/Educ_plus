
@extends('app')
@section('title', 'Moyenne Index')
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
                  <h5 class="mb-0">Gestion Moyenne</h5>
                  <div class="font-22 text-white"><i class="lni lni-cogs"></i></div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-2">
                        <table class="table table-striped table-bordered" id="myTable" style="border: 1px solid">
                            <thead>
                                <tr class="table-dark">
                                    <th class="text-center py-2" scope="col" style="border-right: 1px solid white"></th>
                                    <th class="text-center py-2" scope="col" style="border-right: 1px solid white">Libellé</th>
                                    <th class="text-center" scope="col" style="border-right: 1px solid white">Effectif</th>
                                    <th class="text-center" scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                              <!-- content add -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add Search Model -->
<div class="modal fade" id="addModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title">Cutting</h5>
            </div>
            <form action="{{ route('moyenne.show') }}" method="get" id="my_add">
              @csrf
              <div class="modal-body">
                  <div class="row my-3">
                      <div class="col-12">
                        <input type="hidden" name="class" id="class">
                          <div class="form-group mx-2 mb-3">
                              <label class="form-label" for="cutting">Select<span class="text-danger">*</span> :</label>
                              <select name="cutting" class="form-select" id="cutting" data-placeholder="Choose one thing" style="background: transparent !import">
                                {{-- <option>- - - - -</option> --}}
                              </select>
                          </div>
                      </div>
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

    $('#myTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('moyenne.data') }}",
      columns: [
        { data: 'counter', className: "text-center pt-3", orderable: false, searchable: false },
        { data: 'libelle', className: "text-center pt-3", searchable: true },
        { data: 'inscrit', className: "text-center pt-3", searchable: true },
        { data: 'action', orderable: false, searchable: false },
      ]
    });


    $(document).on('click', '.btn-outline-light', function() {
      $id = $(this).data('id'); $('.option').remove();
      if($id){
        $.ajax({
          url: "{{ route('moyenne.search') }}",
          method: "GET",
          dataType: "json",
          success: function(dts) {
            if(dts.status == 200){
              $data = dts.data;
              $i = 0;
              while($i < $data.length){
                $('#cutting').append('<option class="option" value="'+$data[$i]['id']+'">'+$data[$i]['libelle']+'</option>');
                $i++;
              }
            }
            else{
              $('#cutting').append('<option class="option">Aucune valeur definie ...</option>');
            }
            $('#class').val($id);
            var modal = new bootstrap.Modal($('#addModal'));
            modal.show();
          }
        });
      }
      else{
        $msg = 'Une erreur est survenue/';
        getNotify('warning', 'bx bx-error', $msg);
      }
    });


    //  Function 
    function getNotify($type, $icon, $message){
      Lobibox.notify($type, {
        pauseDelayOnHover: true,
        continueDelayOnInactiveTab: false,
        position: 'top right',
        icon: $icon,
        msg: $message
      });
    }

  });
</script>
@endsection