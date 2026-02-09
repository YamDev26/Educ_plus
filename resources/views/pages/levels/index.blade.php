
@extends('app')
@section('title', 'Level')
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
                    <h5 class="mb-0">Gestion Des Niveaux</h5>
                    <div class="font-22 text-white"><i class="lni lni-cogs"></i></div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="table-dark">
                                    <th class="text-center" scope="col"></th>
                                    <th class="text-center" scope="col">Libellé</th>
                                    <th class="text-center" scope="col">Code</th>
                                    <th class="text-center" scope="col">Statut</th>
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
                                        <td class="text-center">
                                            <div class="badge bg-{{ count($level['disciplineLevels']) != 0 ? 'success':'danger' }} rounded-pill w-25" style="margin: 0px auto">
                                                <span class="text-center">{{ count($level['disciplineLevels']) != 0 ? 'Actif':'Inactif' }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center py-1">
                                            <a href="{{ route('level.show', $level['id']) }}" class="btn btn-outline-light py-0 px-1 mb-0 mt-1" style="border: none; border-radius: 3px">
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