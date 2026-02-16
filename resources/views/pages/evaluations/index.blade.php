@extends('app')
@section('title', 'Gestion Evaluation')
@section('link')
<style>
  
</style>
@endsection
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-12 px-lg-2">
            @include('partials._alert')
            <div class="card radius-10 w-100">
              <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-2 mb-0">
                <h5 class="mb-0">Gestion Des Evaluations</h5>
                <div class="font-22 text-white"><i class="lni lni-cogs"></i></div>
              </div>
              <div class="card-body">
                <div class="table-responsive mt-4">
                  <table class="table table-bordered">
                    <thead>
                      <tr class="table-dark">
                        <th class="text-center" scope="col"></th>
                        <th class="text-center" scope="col">Classe</th>
                        <th class="text-center" scope="col">Effectif</th>
                        <th class="text-center" scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @foreach ($dts as $item)
                          <tr>
                            <td class="text-center">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                            <td class="text-center">{{ $item['libelle'] }}</td>
                            <td class="text-center">{{ ($item['inscrit'] <= 9 ? '0'.$item['inscrit']:$item['inscrit']).'/'.$item['effectif'] }}</td>
                            <td class="text-center py-1">
                              <button data-id="{{ $item['id'] }}" class="btn btn-outline-light py-0 px-1 mb-0 mt-1" style="border: none; border-radius: 3px">
                                <i class="fadeIn animated bx bx-slider m-0" style="font-size: 17px"></i>
                              </button>
                            </td>
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
<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('evaluation.show') }}" method="get">
        @csrf
        <div class="modal-header py-2">
          <h5 class="modal-title" id="modalLabel">Matières autirisées</h5>
        </div>
        <div class="modal-body py-4">
          <div class="form-group mx-2 my-1 text-center">
            <label class="form-label">Matière<span class="text-danger">*</span> :</label>
            <input type="hidden" name="class" id="classId">
            <span id="modals">
              <!-- Content  -->
            </span>
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

    $('.btn-outline-light').on('click', function() {
      $('#classId').val($(this).data('id'));
      if($(this).data('id')){
        $('.option').remove();
        $.ajax({
          url: '{{ route('evaluation.ajax') }}',
          method: 'GET',
          data: {id: $(this).data('id')},
          success: function(data) { 
            $i = 0;
            while($i < data.length){
              $check = $i == 0 ? 'checked':'';
              $('#modals').append('<span class="option mx-3">'+
                '<input type="radio" name="matter" value="'+data[$i]['id']+'_'+data[$i]['libelle']+'" id="'+data[$i]['id']+'" '+$check+'>'+
                '<label for="'+data[$i]['id']+'" class="form-label mx-2">'+data[$i]['libelle']+'</label>'+
              '</span>');
              $i++;
            }
            var modal = new bootstrap.Modal($('#addModal'));
            modal.show();
          },
        });
      }
    });
  })
</script>
@endsection