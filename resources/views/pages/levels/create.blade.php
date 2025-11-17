
@extends('app')
@section('title', 'create level')
@section('content')
<div class="page-content">

</div>
<div class="page-content">
    <div class="row">
        <div class="col-12 px-lg-2">
            <div class="card">
                <div class="card-header border-bottom border-dashed py-2">
                    <h5 class="mb-0 d-flex justify-content-between px-2">
                        <span class="dark__bg-1100 pe-3">Discipline {{ $level['code'] }}</span>
                        <a href="{{ route('level.show',$level['id']) }}" class="btn btn-outline-light py-1 mb-1" style="float: right; font-size: 12px; border-radius: 2px">Back</a>
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <form action="{{ route($edits ? 'level.update':'level.store', $level['id']) }}" method="post">
                            @csrf @method($edits ? 'put':'post')
                            <!-- Table de data -->
                            <input type="hidden" name="id" value="{{ $level['id'] }}">
                            <table class="table table-striped table-bordered mb-3" id="yearTable">
                                <thead>
                                    <tr class="table-dark">
                                        <th class="py-2 text-center" scope="col" style="width: 10%"></th>
                                        <th class="py-2 text-center" scope="col" style="width: 30%">Libellé</th>
                                        <th class="py-2 text-center" scope="col" style="width: 20%">Code</th>
                                        <th class="py-2 text-center" scope="col" style="width: 20%">Statut</th>
                                        <th class="py-2 text-center" scope="col" style="width: 20%">coefficient</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp
                                    @forelse ($dts as $item)
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
                                                    <input type="checkbox" name="mat[]" class="form-check-input" value="{{ $item['id'].'_'.$i+1 }}" {{ $edits ? (in_array($item['id'], array_column($edits->toArray(), 'discipline_id')) ? 'checked':null):null }}>
                                                </span>
                                            </td>
                                            <td class="text-center p-0">
                                                <input type="text" name="coef[]" class="form-control number m-0" id="{{ 'coef_'.$i+1 }}" value="{{ $edits ? dtnCoefMatiere($edits, $item['id']):null }}" placeholder="---" {{ $edits ? (dtnCoefMatiere($edits, $item['id']) ? null:'disabled'):'disabled' }} style="border-radius: 0px; border: none">
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
                            <div class="text-center my-3">
                                <button type="submit" class="btn btn-dark px-5" style="border-radius: 2px">Validation</button>
                            </div>
                        </form>
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