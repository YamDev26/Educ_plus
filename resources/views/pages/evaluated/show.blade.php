
@extends('app')
@section('title', 'Get Evaluated')
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
              <h5 class="mb-0" title="{{ ucwords($matter->discipline->libelle) }}">
                Evaluated - <span style="text-decoration: underline">{{ strtoupper($matter->discipline->abbreviat ?? $matter->discipline->libelle) }}</span>
              </h5>
              <h5 class="mb-0" style="text-decoration: underline">{{ $classe->libelle }}</h5>
              <span style="float: right; ">
                  <button type="button" class="btn btn-outline-light py-1 mb-1" id="addBtn" style="font-size: 12px; border-radius: 2px" disabled>Add</button>
                  <a href="{{ route('evaluated.index') }}" class="btn btn-outline-light py-1 mb-1" style="font-size: 12px; border-radius: 2px">Back</a>
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
                        <table class="table table-striped table-bordered w-100" id="{{ $table[$i] }}" style="border: 1px solid">
                          <thead>
                            <tr>
                              <th style="border-bottom: 1px solid"></th>
                              <th style="border-bottom: 1px solid">Type Evaluation {{ $i++ }}</th>
                              <th style="border-bottom: 1px solid">Valeur</th>
                              <th style="border-bottom: 1px solid">Created</th>
                              <th class="text-center" style="border-bottom: 1px solid">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <!-- Content Table -->
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
            <div class="modal-header py-3">
                <h5 class="modal-title">New Evaluated</h5>
                <strong>{{ date('d/m/Y') }}</strong>
            </div>
            <form action="{{ route('evaluated.create') }}" method="post">
              @csrf
              <div class="modal-body">
                  <div class="row my-3">
                      <div class="col-12">
                        <input type="hidden" name="classe" id="classId" value="{{ $classe->id }}">
                        <input type="hidden" name="matter" id="matter" value="{{ $matter->id }}">
                        <input type="hidden" name="cutting" id="cutting">
                        <div class="form-group mx-2 mb-3">
                          <label class="form-label" for="type">Type Evaluation<span class="text-danger">*</span> :</label>
                          <select name="type" class="form-select" id="type" data-placeholder="Choose one thing" style="background: transparent !import">
                            <option value="">Select One Option ...</option>
                            <option value="activité pratique">Activité Pratique</option>
                            <option value="devoir de classe">Devoir De Classe</option>
                            <option value="devoir de niveau">Devoir De Niveau</option>
                            <option value="interogation ecrite">Interogation Ecrite</option>
                            <option value="interogation orale">Interogation Orale</option>
                          </select>
                        </div>

                        <div class="form-group mx-2 mb-3">
                          <label class="form-label" for="values">Valeur Evaluation<span class="text-danger">*</span> :</label>
                          <select name="values" class="form-select" id="values" data-placeholder="Choose one thing" style="background: transparent !import">
                            <option value="">Select One Option ...</option>
                            <option value="0.5">10</option>
                            <option value="1">20</option>
                            <option value="2">40</option>
                          </select>
                        </div>

                        <div class="form-group mx-2 mb-0">
                          <label class="form-label" for="date">Date Evaluation<span class="text-danger">*</span> :</label>
                          <input type="date" name="date" class="form-select" id="date" data-placeholder="Choose one thing" style="background: transparent !import">
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
    $('#myTable_1, #myTable_2, #myTable_3').DataTable();

    // Default Actif navs-tabs ---------
    $actif = $("#actif").data('status');
    $actif == 1 ? $('#addBtn').prop('disabled', false):$('#addBtn').prop('disabled', true);
    $('#cutting').val($("#actif").data('id'));

    if(!$("#actif").data('status')){
      $('#inactif_1').addClass('active');
      $('#successhome').addClass('show active');
    }

    $('.nav-link').on('click', function(){
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
      var modal = new bootstrap.Modal($('#addModal'));
        modal.show();
    });


  });
</script>
@endsection