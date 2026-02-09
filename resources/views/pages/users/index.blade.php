@extends('app')
@section('title', 'Teachers')
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
                    <h5 class="mb-0">Users</h5>
                    <span style="float: right; ">
                        <a href="{{ route('user.create') }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Add New Student" style="border: none; border-radius: 3px">
                            <i class="fadeIn animated bx bx-edit-alt m-0" style="font-size: 17px"></i>
                        </a>
                        <button type="button" class="btn btn-outline-light py-0 px-2 mb-1" id="btnFile" style="border: none; border-radius: 3px" title="Import File">
                          <i class="lni lni-share-alt mx-0" style="font-size: 17px"></i>
                        </button>
                    </span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive mt-4">
                                <table class="table table-striped table-bordered" id="myTable" style="border: 1px solid; width: 100%">
                                <thead>
                                    <tr class="table-dark">
                                        <th class="text-center py-2" scope="col" style="border-right: 1px solid white"></th>
                                        <th class="text-center py-2" style="width: 30%; border-right: 1px solid white">Nom & Prénoms</th>
                                        <th class="text-center py-2" style="width: 20%; border-right: 1px solid white">Adresse Email</th>
                                        <th class="text-center py-2" style="width: 20%; border-right: 1px solid white">Contact</th>
                                        <th class="text-center py-2" style="width: 15%; border-right: 1px solid white">Profil</th>
                                        <th class="text-center py-2" style="width: 150%">Actions</th>
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
<div class="modal fade" id="fileModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title">Import Fille</h5>
                <span style="font-size: 15px">{{ date('d-m-Y') }}</span>
            </div>
            <form action="{{ route('teacher.import') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group mx-1 mb-3">
                        <a href="{{ route('teacher.export') }}" class="btn btn-outline-light my-1 mx-2 px-2 py-0 exportBtn" style="float:right; border: none; border-radius: 3px" title="DownLoad File">
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
@endsection
@section('script')
<script>
    $(document).ready(function() {

      // Affiche Data Table
      $('#myTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('user.data') }}",
          columns: [
              { data: 'counter', className: "text-center pt-2", orderable: false, searchable: false },
              { data: 'name', searchable: true },
              { data: 'email', searchable: true },
              { data: 'contact', searchable: true , className: "text-center"},
              { data: 'profil', searchable: true , className: "text-center"},
              { data: 'action', orderable: false, searchable: false },
          ]
      });


      $('#btnFile').on('click', function() {
        var modal = new bootstrap.Modal($('#fileModal'));
        modal.show();
      });

    });
</script>
@endsection