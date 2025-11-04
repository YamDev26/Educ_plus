@extends('app')
@section('title', 'Gestion Classe')
@section('link')
<style>
    .dataTables_length, .dataTables_info, .dataTables_paginate  {
        display: none
    }
</style>
@endsection
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-lg-10 col-12 offset-lg-1">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-2 mb-0">
                    <h5 class="mb-0">Gestion Des Classes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-bordered" id="myTable">
                            <thead>
                                <tr class="table-dark">
                                    <th class="text-center" scope="col"></th>
                                    <th class="text-center" scope="col">Libellé</th>
                                    <th class="text-center" scope="col">Code</th>
                                    <th class="text-center" scope="col">Classe</th>
                                    <th class="text-center" scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach ($levels as $level)
                                    <tr>
                                        <td class="text-center">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                                        <td class="ml-3">{{ ucwords($level['libelle']) }}</td>
                                        <td class="text-center">{{ ucwords($level['code']) }}</td>
                                        <td class="text-center">{{ count($level['classes']) <= 9 ? '0'.count($level['classes']):count($level['classes']) }}</td>
                                        <td class="text-center py-1">
                                            <a href="{{ route('classe.show', $level['id']) }}" class="btn btn-outline-light py-0 px-1" style="border-radius: 2px"><i class="bx bx-grid-small m-0"></i></a>
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
@endsection
@section('script')
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>
<script>
    $('#myTable').DataTable({
        pageLength: 10,
        lengthMenu: [10, 25, 50],
    });
</script>
@endsection