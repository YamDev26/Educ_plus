
@extends('app')
@section('title', 'Resultat')
@section('link')
<style>
    .dataTables_length  {
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
                  <h5 class="mb-0" title="{{ ucwords($matter->discipline->libelle) }}">
                    <span id="libelle">Resultat - <span style="text-decoration: underline">{{ strtoupper($matter->discipline->abbreviat ?? $matter->discipline->libelle) }}</span> - {{ $classe->libelle }}</span>
                  </h5>
                  <h5 class="mb-0" style="text-decoration: underline">{{ ucwords($cutting->cutting->libelle) }}</h5>
                  <span class="px-0" style="float: right; border-bottom: 2px solid">
                    <button type="button" class="btn btn-outline-light py-0 px-2 mb-1" title="Confirmation" style="border: none; border-radius: 3px">
                      <i class="fadeIn animated bx bx-duplicate m-0" style="font-size: 17px"></i>
                    </button>
                    <a href="#" type="button" class="btn btn-outline-light py-0 px-2 mb-1" style="border: none; border-radius: 3px" title="Edit Moyenne">
                      <i class="fadeIn animated bx bx-edit-alt mx-0" style="font-size: 17px"></i>
                    </a>
                    <a href="{{ route('evaluated.back', $classe->id.'_'.$matter->id) }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                      <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                    </a>
                  </span>
                </div>
                <div class="card-body">
                  <div class="table-responsive mt-4">
                    <span class="my-0 py-0" style="position: absolute; font-size: 17px">
                      <a href="#" class="btn btn-outline-light py-0 px-2 mb-1" style="float:right; border: none; border-radius: 3px" title="DownLoad File">
                        <i class="lni lni-download m-0" style="font-size: 17px"></i>
                      </a>
                    </span>
                    <table class="table table-striped table-bordered mt-0" id="Transaction-History" style="border: 1px solid">
                      <thead>
                        <tr class="table-dark">
                          <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 5%"></th>
                          <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 8%">Matricule</th>
                          <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 25%">Mon & Prenoms</th>
                          <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 5%">Genre</th>
                          @php $i = 1; @endphp
                          @forelse ($evaluated as $item)
                          <th class="text-center py-2" scope="col" style="border-right: 1px solid white;" title="Note sur {{ $item->value*20 }}">N{{ $i++ }}</th>
                          @empty
                          <th class="text-center py-2" scope="col" style="border-right: 1px solid white;">Undefined evaluated</th>
                          @endforelse
                          <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 7%">Moyenne</th>
                          <th class="text-center py-2" scope="col" style="width: 7%">Rang</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $i = 0; @endphp
                        @foreach ($datas as $item)
                        <tr>
                          <td scope="col" class="text-center">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                          <td class="text-center">{{ $item['matricule'] }}</td>
                          <td title="{{ $item['name'] }}">
                            {{ Str::limit($item['name'], '25', '...') }}
                          </td>
                          <td class="text-center">{{ $item['genre'] }}</td>
                          @forelse ($item['notes'] as $note)
                            <td class="text-center">{{ $note ? $note['valeur']:'---' }}</td>
                          @empty
                            <td class="text-center">---</td>
                          @endforelse
                          <td class="text-center">---</td>
                          <td class="text-center">---</td>
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
<script>
  $(document).ready(function() {

   
  });
</script>
@endsection