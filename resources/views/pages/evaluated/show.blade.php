
@extends('app')
@section('title', 'Evaluated Detail')
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
          <div class="card m-lg-2">
            <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-2 mb-lg-3">
              <h5 class="mb-0" title="{{ $classe->lv2 == 'mixte' ? $matter->discipline->abbreviat:ucwords($matter->discipline->libelle) }}">
                Evaluated - <span style="text-decoration: underline">{{ $classe->lv2 == 'mixte' ? session('lv2'):strtoupper(changeValMatter($matter->discipline->abbreviat, $classe->autre)) }}</span>
              </h5>
              <h5 class="mb-0" style="text-decoration: underline">{{ $classe->libelle }}</h5>
              <span class="d-flex" style="float: right;">
                <button type="button" class="btn btn-outline-light py-0 px-2 mb-1" id="addBtn" style="border: none; border-radius: 3px" disabled>
                  <i class="fadeIn animated bx bx-edit-alt m-0" style="font-size: 17px"></i>
                </button>
                <form action="{{ route($teacher ? 'evaluation.detail':'evaluated.detail') }}" method="get">
                  @csrf
                  <input type="hidden" name="cutting" id="cuttingId">
                  <input type="hidden" name="class" value="{{ $classe->id }}">
                  <input type="hidden" name="matter" value="{{ $matter->id }}">
                  <button class="btn btn-outline-light py-0 px-2 mb-1" id="oerView" title="Over View" style="border: none; border-radius: 3px">
                    <i class="fadeIn animated bx bx-slider m-0" style="font-size: 18px"></i>
                  </button>
                </form>
                <a href="{{ route($teacher ? 'evaluation.index':'evaluated.index') }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                  <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                </a>
              </span>
            </div>
							<div class="card-body my-lg-2 w-100">
								<ul class="nav nav-tabs" role="tablist">
                  @php $t = 1; @endphp
                  @foreach ($data as $item)
                  <li class="nav-item" role="presentation">
										<a class="nav-link {{ $item['status'] == 1 ? 'active':'' }}" id="{{ $item['status'] == 1 ? 'actif':'inactif_'.$t++ }}" data-id="{{ $item['id'] }}" data-status="{{ $item['status'] }}" data-bs-toggle="tab" href="#{{ $item['idTable'] }}" role="tab" aria-selected="true">
											<div class="d-flex align-items-center">
												<div class="tab-icon" id="icon" style="display: {{ $item['status'] == 1 ? '':'none' }}">
                          <i class="lni lni-dropbox-original"></i>
												</div>
												<div class="tab-title mx-2">{{ ucwords($item['libelle']) }}</div>
											</div>
										</a>
									</li>
                  @endforeach
								</ul>
								<div class="tab-content py-3">
                  @php $i = 1; $table = [1 => 'myTable_1', 2 => 'myTable_2', 3 => 'myTable_3'] @endphp
                  @foreach ($data as $item)
                    <div class="tab-pane fade {{ $item['status'] == 1 ? 'show active':'' }}" id="{{ $item['idTable'] }}" role="tabpanel">
                      <div class="table-responsive mt-lg-4 px-lg-3">
                        <table class="table table-striped w-100" id="{{ $table[$i] }}">
                          <thead>
                            <tr class="table-dark">
                              <th style="border: 1px solid grey; width: 10%"></th>
                              <th class="text-center" style="border: 1px solid grey; width: 20%">Type Evaluation</th>
                              <th class="text-center" style="border: 1px solid grey; width: 20%">Valeur</th>
                              <th class="text-center" style="border: 1px solid grey; width: 20%">Created</th>
                              <th class="text-center" style="border: 1px solid grey; width: 20%">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php $j = 1; @endphp
                            @foreach ($item['evaluated'] as $data)
                              <tr>
                                <th class="text-center py-0" style="border: 1px solid grey">
                                <div class="ms-auto py-2">{{ $j <= 9 ? '0'.$j++:$j++ }}</div>
                                </th>
                                <td class="py-0" style="border: 1px solid grey">
                                  <div class="ms-auto py-2">{{ ucwords($data->evaluadet_type->libelle) }}</div>
                                </td>
                                <td class="text-center py-0" style="border: 1px solid grey">
                                  <div class="ms-auto py-2">Sur {{ $data->value * 20 }}</div>
                                </td>
                                <td class="text-center py-0" style="border: 1px solid grey">
                                  <div class="ms-auto py-2">{{ date('d/m/Y', strtotime($data->created)) }}</div>
                                </td>
                                <td class="text-center py-0" style="border: 1px solid grey">
                                  <div class="ms-auto py-2 my-0">
                                    <a href="{{ route(($teacher ? 'evaluation.list':'evaluated.list'), $data->id) }}" class="btn btn-outline-light py-0 px-1 mr-2" style="border: none; border-radius: 3px" title="List not">
                                      <i class="fadeIn animated bx bx-list-plus m-0" style="font-size: 16px"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-outline-light py-0 px-1 mr-2" style="border: none; border-radius: 3px" title="Edit">
                                      <i class="fadeIn animated bx bx-highlight m-0" style="font-size: 16px"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-light py-0 px-1 delete" data-id="{{ $data->id }}" style="border: none; border-radius: 3px" title="Delete">
                                      <i class="fadeIn animated bx bx-trash m-0" style="font-size: 16px"></i>
                                    </button>
                                  </div>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  @endforeach
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
                <h5 class="modal-title">New Evaluated</h5>
                <strong>{{ date('d/m/Y') }}</strong>
            </div>
            <form action="{{ route($teacher ? 'evaluation.create':'evaluated.create') }}" method="post">
              @csrf
              @method('get')
              <div class="modal-body">
                  <div class="row my-3">
                      <div class="col-12">
                        <input type="hidden" name="classe" id="classId" value="{{ $classe->id }}">
                        <input type="hidden" name="matter" id="matter" value="{{ $matter->id }}">
                        <input type="hidden" name="cutting" id="cutting">

                        @if ($subMatter)
                          <div class="form-group mx-2 mb-3">
                            <label class="form-label" for="subMatter">Matière<span class="text-danger">*</span> :</label>
                            <select name="sub" class="form-select" id="subMatter" style="background: transparent !import" required>
                              <option value="">Select One Option ...</option>
                              @foreach ($subMatter as $item)
                                <option value="{{ $item->id }}">{{ ucwords($item->libelle) }}</option>
                              @endforeach
                            </select>
                          </div>
                        @endif

                        <div class="form-group mx-2 mb-3">
                          <label class="form-label" for="type">Type Evaluation<span class="text-danger">*</span> :</label>
                          <select name="type" class="form-select" id="type" style="background: transparent !import">
                            <option value="">Select One Option ...</option>
                            @foreach ($typeEvaluated as $item)
                              <option value="{{ $item->id }}">{{ ucwords($item->libelle) }}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="form-group mx-2 mb-3">
                          <label class="form-label" for="values">Valeur Evaluation<span class="text-danger">*</span> :</label>
                          <select name="values" class="form-select" id="values" style="background: transparent !import">
                            <option value="">Select One Option ...</option>
                            <option value="0.5">10</option>
                            <option value="1">20</option>
                            <option value="2">40</option>
                          </select>
                        </div>

                        <div class="form-group mx-2 mb-0">
                          <label class="form-label" for="date">Date Evaluation<span class="text-danger">*</span> :</label>
                          <input type="date" name="date" class="form-select" id="date" style="background: transparent !import">
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

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header py-2">
        <h1 class="modal-title fs-5" id="deteleModalLabel">Delete Data</h1>
        <strong>{{ date('d-m-Y') }}</strong>
      </div>
      <div class="modal-body pt-0">
        <div class="text-center">
          <p class="my-0">
            <i class="fadeIn animated bx bx-info-circle text-info" style="font-size: 50px"></i>
          </p>
          <div class="mt-1">
            <strong style="font-size: 20ps" id="libDelete"></strong> <br>
            <span>Noté sur <span id="valDelete"></span>, fait le <u id="dateDelete"></u></span>
          </div>
          <span>Confirmez la suppresion de cette évaluation !</span>
        </div>
      </div>
      <form action="{{ route($teacher ? 'evaluation.destroy':'evaluated.destroy') }}" method="post">
        @csrf
        <input type="hidden" name="id" id="idDelete">
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
    $('#myTable_1, #myTable_2, #myTable_3').DataTable({
      ordering: false
    });

    // Default Actif navs-tabs ---------
    $actif = $("#actif").data('status');
    $actif == 1 ? $('#addBtn').prop('disabled', false):$('#addBtn').prop('disabled', true);
    $('#cutting, #cuttingId').val($("#actif").data('id'));

    if(!$("#actif").data('status')){
      $('#inactif_1').addClass('active');
      $('#successhome').addClass('show active');
      $('#cuttingId').val($("#inactif_1").data('id'));
    }


    $('.nav-link').on('click', function(){
      $('#cuttingId').val($(this).data('id'));
      if($(this).data('status') != 2){
        $('#addBtn').prop('disabled', false);
        $('#cutting').val($(this).data('id'));
      }
      else{
        $('#addBtn').prop('disabled', true);
        $('#cutting').val();
      }
    });


    $('#addBtn').on('click', function() {
      $('#type, #date, #values').val('');
      var modal = new bootstrap.Modal($('#addModal'));
      modal.show();
    });


    $('.delete').on('click', function() {
      if($(this).data('id')){
        $.ajax({
          url: "{{ route($teacher ? 'evaluation.delete':'evaluated.delete') }}",
          method: "GET",
          data: { id: $(this).data('id') },
          dataType: "json",
          success: function(dts) {
            if(dts){
              $('#libDelete').text(dts.libelle);
              $('#valDelete').text(dts.values);
              $('#dateDelete').text(dts.created);
              $('#idDelete').val(dts.id);
            }
            var modal = new bootstrap.Modal($('#deleteModal'));
            modal.show();
          }
        });
      }
    });


  });
</script>
@endsection