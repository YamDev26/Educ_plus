@extends('app')
@section('title', 'Student Index')
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
                    <div class="row mx-lg-3">
                        <div class="col-12">
                            <div class="table-responsive mt-4">
                                <table class="table table-striped table-bordered" id="myTable" style="border: 1px solid">
                                <thead>
                                    <tr class="table-dark">
                                        <th class="text-center py-3" style="width: 30%">Nom & Prénoms</th>
                                        <th class="text-center py-3" style="width: 25%">Date et lieu de naissance</th>
                                        <th class="text-center py-3" style="width: 25%">Parent</th>
                                        <th class="text-center py-3" style="width: 15%">Actions</th>
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
            { data: 'student', searchable: true },
            { data: 'dateNaiss', searchable: true },
            { data: 'parents', searchable: true },
            { data: 'action', orderable: false, searchable: false },
            ]
        });

    });
</script>
@endsection