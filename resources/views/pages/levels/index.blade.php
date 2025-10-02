
@extends('app')
@section('title', 'list level')
@section('content')
<div class="row g-3">
    <div class="col-12">
        <div class="card" id="TableCrmRecentLeads" data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;status&quot;],&quot;page&quot;:8,&quot;pagination&quot;:true}">
            <div class="card-header d-flex flex-between-center flex-wrap gap-2 pt-3 pb-0 mb-0">
                <h5 class="mb-0">Gestion Des Disciplines</h5>
                <div id="table-recent-leads-actions">
                    <button class="btn btn-falcon-default btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#add-modal" style="float: left">Add Year</button>
                </div>
            </div>
            <hr class="mt-0 mb-2 mx-4">
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    @include('partials._search')

                    <!-- Table de data -->
                    <table class="table table-bordered" id="yearTable">
                        <thead>
                            <tr class="table-active">
                                <th class="py-2 text-center" scope="col">#</th>
                                <th class="py-2 text-center" scope="col">Libellé</th>
                                <th class="py-2 text-center" scope="col">Code</th>
                                <th class="py-2 text-center" scope="col">Statut</th>
                                <th class="py-2 text-center" scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0; @endphp
                            @forelse ($levels as $level)
                                <tr class="dataYear">
                                    <td class="text-center">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                                    <td class="ml-3">{{ ucwords($level['libelle']) }}</td>
                                    <td class="text-center">{{ ucwords($level['code']) }}</td>
                                    <td class="text-center">
                                        <span class="badge badge rounded-pill d-block p-2 badge-subtle-{{ $level['actif'] ? 'success':'danger' }} w-50" style="margin: 0px auto">
                                            {{ $level['actif'] ? 'Actif':'Inactif' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-falcon-default btn-sm dropdown-toggle" data-id="{{ $level['id'] }}" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">discipline</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu3">
                                            <a class="dropdown-item" href="#">A</a>
                                            <a class="dropdown-item" href="#">C</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="dataYear">
                                    <td colspan="5" class="text-center">
                                        <span style="font-size: 13px">Informations Non Disponibles</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.dropdown-toggle').on('click', function() {
            $id = $(this).data('id');
            alert($id);
        })
    });
</script>
@endsection