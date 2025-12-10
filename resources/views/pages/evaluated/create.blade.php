
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
                                <td class="text-center">{{ $item->student->matricule }}</td>
                                <td title="{{ strtoupper($item->student->first_name).' '.ucwords($item->student->last_name) }}">
                                  {{ strtoupper($item->student->first_name).' '.Str::limit(ucwords($item->student->last_name), '25', '...') }}
                                </td>
                                <td class="text-center">
                                  {{ $item->student->genre == 'F' ? 'Feminin':'Masculin' }}
                                </td>
                                <td class="p-0 d-flex text-center">
                                  <div class="input-group m-0" style="margin: 0% auto">
                                    <input type="text" class="form-control w-50"placeholder="Add Not" style="border-radius: 1px">
                                    <span class="input-group-text w-50" id="inputGroup-sizing-default" style="border-radius: 1px"><strong>/ {{ $evaluated->value*20 }}</strong></span>
                                  </div>
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
<!-- Model Import File -->
<div class="modal fade" id="fileModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
              <h5 class="modal-title">Import File</h5>
              <h5 class="modal-title">{{ ucwords($evaluated->disciplineLevel->discipline->abbreviat) }}</h5>
            </div>
            <form action="#" method="post" id="my_add">
              @csrf
              <div class="modal-body">
                <div class="row my-3">
                  <div class="col-12">
                    <a href="{{ route('evaluated.export', $evaluated->classe_id.'_'.$evaluated->discipline_level_id) }}" class="btn btn-outline-secondary my-1 mx-2 py-0" style="float:right; border-radius: 50px">
                      <i class="lni lni-download m-0" style="font-size: 15px"></i>
                    </a>
                    <div class="form-group mx-1 mb-3">
                      <label class="form-label" for="matter">Select file<span class="text-danger">*</span> :</label>
                      <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload" style="border-radius: 3px">
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

      $('#fileBtn').on('click', function() {
        var modal = new bootstrap.Modal($('#fileModal'));
        modal.show();
      });
      
      $msg = '{{ session("msg") }}';
      if($msg){
        getNotify('success', 'bx bx-check-circle', $msg);
      }

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