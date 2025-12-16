@extends('app')
@section('title', 'Student Index')
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
        <div class="col-12">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-1 mb-0">
                    <h5 class="mb-0">Gestion Des Elèves</h5>
                    <span style="float: right; ">
                        <a href="{{ route('student.create') }}" class="btn btn-outline-light py-1 mb-1 mx-2" style="font-size: 12px; border-radius: 2px">Add</a>
                        <button type="button" class="btn btn-outline-light py-0 px-3 mb-1" id="btnAdd" style="border-radius: 2px"><i class="lni lni-exit-up m-0" style="font-size: 12px"></i></button>
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive mt-4">
                                <table class="table table-striped table-bordered" id="myTable" style="border: 1px solid">
                                <thead>
                                    <tr class="table-dark">
                                        <th class="text-center py-3" scope="col" style="border-right: 1px solid white"></th>
                                        <th class="text-center py-3" style="width: 30%; border-right: 1px solid white">Nom & Prénoms</th>
                                        <th class="text-center py-3" style="width: 20%; border-right: 1px solid white">Date et lieu de naissance</th>
                                        <th class="text-center py-3" style="width: 20%; border-right: 1px solid white">Parent</th>
                                        <th class="text-center py-3" style="width: 20%">Actions</th>
                                    </tr>
                                </thead>
                                <!-- Content  -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Model -->
<div class="modal fade" id="addModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title">Import Fille</h5>
                <strong id="strong" style="font-size: 19px">{{ date('d-m-Y') }}</strong>
            </div>
            <form action="#" method="post">
            @csrf
            <input type="hidden" name="id" id="editId">
            <div class="modal-body">
                <div class="form-group mx-1 mb-3">
                    <a href="{{ route('student.export') }}" class="btn btn-outline-secondary my-1 mx-2 py-0 exportBtn" style="float:right; border-radius: 50px">
                      <i class="lni lni-download m-0" style="font-size: 15px"></i>
                    </a>
                    <label class="form-label" for="fichier">Select File<span class="text-danger">*</span> :</label>
                    <input type="file" name="fichier" class="form-control @error('fichier') is-invalid @enderror" id="fichier" aria-describedby="inputGroupFileAddon04" aria-label="Upload" style="border-radius: 5px">
                    @error('fichier')
                        <span class="form-bar text-danger" role="alert">
                            {{$message}}
                        </span>
                    @enderror
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

        // Affiche Data Table
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('student.data') }}",
            columns: [
                { data: 'counter', className: "text-center pt-4", orderable: false, searchable: false },
                { data: 'student', searchable: true },
                { data: 'dateNaiss', searchable: true },
                { data: 'parent', searchable: true },
                { data: 'action', orderable: false, searchable: false },
            ]
        });

        // Click Open Modal
        $('#btnAdd').on('click', function() {
            var modal = new bootstrap.Modal($('#addModal'));
            modal.show();
        });


        $('.exportBtn').on('click', function() {
            $('#addModal').modal('hide');
            setTimeout(function() {
            $msg = 'Téléchargement effectué';
            getNotify('info', 'bx bx-info-circle', $msg, 'top left');
            }, 1500)
        });


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