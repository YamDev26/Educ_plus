
@extends('app')
@section('title', 'create level')
@section('content')
<div class="page-container">
    <div class="page-title-head d-flex align-items-sm-center flex-sm-row flex-column gap-2">
        <div class="flex-grow-1">
            <h4 class="fs-18 text-uppercase fw-bold mb-0">Discipline {{ $level['code'] }}</h4>
        </div>

        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('level.show',$level['id']) }}" class="btn btn-outline-dark py-0" style="float: right">Back</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header border-bottom border-dashed py-2">
                    <h5 class="mb-0 d-flex justify-content-between px-2">
                        <span class="dark__bg-1100 pe-3">Discipline {{ $level['code'] }}</span>
                        <a href="{{ route('level.show',$level['id']) }}" class="btn btn-falcon-default btn-sm mb-2" style="float: right">Back</a>
                    </h5>
                </div> --}}
                <div class="card-body">
                    <div class="table-responsive scrollbar">
                        @include('partials._search')
                        <form action="{{ route($edits ? 'level.update':'level.store', $level['id']) }}" method="post">
                            @csrf @method($edits ? 'put':'post')
                            <!-- Table de data -->
                            <input type="hidden" name="id" value="{{ $level['id'] }}">
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
                            <hr class="mb-2 mt-0">
                            <div class="text-center">
                                <button type="submit" class="btn btn-info py-1 px-5">Validation</button>
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

        $('.form-check-input').on('click', function() {alert('ddfdfc');
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