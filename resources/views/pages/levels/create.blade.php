
@extends('app')
@section('title', 'list level')
@section('content')
<div class="row g-3">
    <div class="col-12">
        <div class="card" id="TableCrmRecentLeads" data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;status&quot;],&quot;page&quot;:8,&quot;pagination&quot;:true}">
            <div class="card-header d-flex flex-between-center flex-wrap gap-2 pt-3 pb-0 mb-0">
                <h5 class="mb-0">Add Discipline 6eme</h5>
                <div id="table-recent-leads-actions">
                    <a href="{{ route('level.show',$level['id']) }}" class="btn btn-falcon-default btn-sm mb-2" style="float: left">Back</a>
                </div>
            </div>
            <hr class="mt-0 mb-2 mx-3">
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    @include('partials._search')

                    <!-- Table de data -->
                    <table class="table table-bordered" id="yearTable">
                        <thead>
                            <tr class="table-active">
                                <th class="py-2 text-center" scope="col" style="width: 10%">#</th>
                                <th class="py-2 text-center" scope="col" style="width: 30%">Libellé</th>
                                <th class="py-2 text-center" scope="col" style="width: 20%">Code</th>
                                <th class="py-2 text-center" scope="col" style="width: 20%">Statut</th>
                                <th class="py-2 text-center" scope="col" style="width: 20%">coefficient</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0; @endphp
                            @forelse ($disciplines as $item)
                                <tr class="dataYear">
                                    <td class="text-center py-0">
                                        <p class="my-0 pt-2">{{ $i <= 8 ? '0'.$i+=1:$i+=1 }}</p>
                                    </td>
                                    <td class="ml-3 py-0">
                                        <p class="my-0 pt-2">{{ ucwords($item['libelle']) }}</p>
                                    </td>
                                    <td class="ml-3 py-0">
                                        <p class="m-0 pt-2">{{ ucwords($item['abbreviat']) }}</p>
                                    </td>
                                    <td class="text-center py-0">
                                        <span class="form-check form-switch m-0 pt-2">
                                            <input type="checkbox" name="mat[]" class="form-check-input" value="{{ $item['id'].'_'.$i+1 }}">
                                        </span>
                                    </td>
                                    <td class="text-center p-0">
                                        <input type="text" name="coef[]" class="form-control number m-0" id="{{ 'coef_'.$i+1 }}" placeholder="---" disabled>
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
        $('.number').on('keypress', function(e) {
            var charCode = e.which ? e.which : e.keyCode;
            if (charCode < 48 || charCode > 57) {
                e.preventDefault(); // Empêche la saisie si ce n'est pas un chiffre
            }
        });

        $('.form-check-input').on('click', function() {
            $val = ($(this).val()).split('_');
            if ($(this).is(':checked')) {
                $('#coef_'+$val[1]).prop('disabled', false);
                $('#coef_'+$val[1]).val(1);
            } else {
                $('#coef_'+$val[1]).prop('disabled', true);
                $('#coef_'+$val[1]).val(null);
            }
        })
    });
</script>
@endsection