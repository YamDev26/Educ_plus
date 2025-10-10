@extends('app')
@section('title', 'Slot Time')
@section('content')
<div class="row g-3">
    <div class="col-12">
        <div class="card" id="TableCrmRecentLeads" data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;status&quot;],&quot;page&quot;:8,&quot;pagination&quot;:true}">
            <div class="card-header d-flex flex-between-center flex-wrap gap-2 pt-3 pb-0 mb-0">
                <h5 class="mb-0">Slot Time</h5>
                <div id="table-recent-leads-actions">
                    <a href="{{ route('slot.create') }}" class="btn btn-falcon-default btn-sm mb-2" style="float: left">Add</a>
                </div>
            </div>
            <hr class="mt-0 mb-2 mx-4">
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    @include('partials._search')

                    <!-- Table de data -->
                    <table class="table table-bordered" id="tables">
                        <thead>
                            <tr class="table-active">
                                <th class="py-2 text-center" scope="col">#</th>
                                <th class="py-2 text-center" scope="col">Libellé</th>
                                <th class="py-2 text-center" scope="col">Debut</th>
                                <th class="py-2 text-center" scope="col">Fin</th>
                                <th class="py-2 text-center" scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0; @endphp
                            @if (count($morning) && count($after))
                                @foreach ($morning as $item)
                                    <tr class="tableBasique">
                                        <td class="text-center">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                                        <td class="ml-3">{{ ucwords($item['libelle']) }}</td>
                                        <td class="text-center">{{ ucwords($item['code']) }}</td>
                                        <td class="text-center">
                                            <span class="badge badge rounded-pill d-block p-2 badge-subtle-{{ count($item['disciplineLevels']) != 0 ? 'success':'danger' }} w-50" style="margin: 0px auto">
                                                {{ count($item['disciplineLevels']) != 0 ? 'Actif':'Inactif' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('level.show',$item['id']) }}" class="btn btn-falcon-default btn-sm dropdown-toggle">discipline</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                               <tr class="tableBasique">
                                    <td colspan="5" class="text-center">
                                        <span style="font-size: 13px">Informations Non Disponibles</span>
                                    </td>
                                </tr> 
                            @endif
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



    });
</script>
@endsection