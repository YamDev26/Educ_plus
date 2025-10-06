
@extends('app')
@section('title', 'list level')
@section('content')
<div class="row g-3">
    <div class="col-12">
        <div class="card" id="TableCrmRecentLeads" data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;status&quot;],&quot;page&quot;:8,&quot;pagination&quot;:true}">
            <div class="card-header bg-body-tertiary pt-3 pb-2">
                <!-- <h5 class="mb-0">Add Discipline 6eme</h5> -->
                <div class="d-flex mb-0">
                    <span class="fa-stack me-2 ms-n1">
                        <svg class="svg-inline--fa fa-circle fa-w-16 fa-stack-2x text-300" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                        </svg>
                        <svg class="svg-inline--fa fa-tasks fa-w-16 fa-inverse fa-stack-1x text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="tasks" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M139.61 35.5a12 12 0 0 0-17 0L58.93 98.81l-22.7-22.12a12 12 0 0 0-17 0L3.53 92.41a12 12 0 0 0 0 17l47.59 47.4a12.78 12.78 0 0 0 17.61 0l15.59-15.62L156.52 69a12.09 12.09 0 0 0 .09-17zm0 159.19a12 12 0 0 0-17 0l-63.68 63.72-22.7-22.1a12 12 0 0 0-17 0L3.53 252a12 12 0 0 0 0 17L51 316.5a12.77 12.77 0 0 0 17.6 0l15.7-15.69 72.2-72.22a12 12 0 0 0 .09-16.9zM64 368c-26.49 0-48.59 21.5-48.59 48S37.53 464 64 464a48 48 0 0 0 0-96zm432 16H208a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h288a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-320H208a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h288a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 160H208a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h288a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z"></path>
                        </svg>
                    </span>
                    <div class="col">
                        <h5 class="mb-0 text-primary position-relative">
                            <span class="dark__bg-1100 pe-3">Discipline {{ $level['code'] }}</span>
                            <a href="{{ route('level.show',$level['id']) }}" class="btn btn-falcon-default btn-sm mb-2" style="float: right">Back</a>
                        </h5>
                    </div>
                </div>
            </div>
            <hr class="mt-0 mb-2 mx-3">
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
                                            <input type="text" name="coef[]" class="form-control number m-0" id="{{ 'coef_'.$i+1 }}" value="{{ $edits ? dtnCoefMatiere($edits, $item['id']):null }}" placeholder="---" {{ $edits ? (dtnCoefMatiere($edits, $item['id']) ? null:'disabled'):'disabled' }}>
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
                        <div class="text-center mt-é">
                            <button type="submit" class="btn btn-primary px-5">Validation</button>
                        </div>
                    </form>
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