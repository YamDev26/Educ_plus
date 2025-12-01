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
                        <a href="{{ route('student.create') }}" class="btn btn-outline-light py-1 mb-1" style="font-size: 12px; border-radius: 2px">Add</a>
                        <a href="{{ route('classe.index') }}" class="btn btn-outline-light py-1 mb-1" style="font-size: 12px; border-radius: 2px">Back</a>
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

    });
</script>
@endsection