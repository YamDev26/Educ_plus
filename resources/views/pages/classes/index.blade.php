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
        <div class="col-12 px-lg-2">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-2 mb-0">
                    <h5 class="mb-0">Gestion Des Classes</h5>
                    <div class="font-22 text-white"><i class="lni lni-cogs"></i></div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4 px-lg-2">
                        <table class="table table-striped table-bordered" id="myTable" style="border: 1px solid">
                            <thead>
                                <tr class="table-dark">
                                    <th class="text-center" scope="col" style="border-right: 1px solid white"></th>
                                    <th class="text-center" scope="col" style="border-right: 1px solid white">Libellé</th>
                                    <th class="text-center" scope="col" style="border-right: 1px solid white">Code</th>
                                    <th class="text-center" scope="col" style="border-right: 1px solid white">Classe</th>
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
                                             <a href="{{ route('classe.show', $level['id']) }}" class="btn btn-outline-light py-0 px-1 mb-0 mt-1" style="border: none; border-radius: 3px">
                                                <i class="fadeIn animated bx bx-slider m-0" style="font-size: 17px"></i>
                                            </a>
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