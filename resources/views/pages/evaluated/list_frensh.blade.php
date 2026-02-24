@extends('app')
@section('title', 'List Not Frensh')
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
                  <h5 class="mb-0" title="Français">
                    <span id="libelle">Liste note - <span style="text-decoration: underline">Français</span> - {{ $classe->libelle }}</span>
                  </h5>
                  <h5 class="mb-0" style="text-decoration: underline">{{ ucwords($cutting->cutting->libelle) }}</h5>
                  <span class="px-0" style="float: right;">
                    <a href="{{ route(($teacher ? 'evaluation.str':'evaluated.return'), $classe->id.'_'.$matter->id.'_'.$cutting->id) }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                      <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                    </a>
                  </span>
                </div>
                <div class="card-body">
                  <div class="table-responsive mt-4">
                    <span class="my-0 py-0 w-25 d-flex justify-content-between" style="position: absolute; font-size: 17px">
                      <a href="#" target="_blank" class="btn btn-light py-1 px-2 mb-1" title="Pdf File" style="border: none; border-radius: 3px">
                        <i class="lni lni-download m-0" style="font-size: 15px"></i>
                      </a>
                    </span>
                    <table class="table table-striped mt-0" id="myTable">
                      <thead>
                        <tr class="table-dark">
                          <th class="text-center py-2" scope="col" style="border: 1px solid grey; width: 3%"></th>
                          <th class="text-center py-2" scope="col" style="border: 1px solid grey; width: 8%">Matricule</th>
                          <th class="text-center py-2" scope="col" style="border: 1px solid grey; width: 25%">Nom & Prenoms</th>
                          <th class="text-center py-2" scope="col" style="border: 1px solid grey; width: 5%">Genre</th>
                          <th class="text-center py-2" scope="col" colspan="{{ $nbre_1 }}" style="border: 1px solid grey;" title="Composition Française">CF</th>
                          <th class="text-center py-2" scope="col" colspan="{{ $nbre_2 }}" style="border: 1px solid grey;" title="Orthographe-Grammaire">OG</th>
                          <th class="text-center py-2" scope="col" colspan="{{ $nbre_3 }}" style="border: 1px solid grey;" title="Expression Orale">EO</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $i = 0; @endphp
                        @foreach ($datas as $item)
                        <tr style="border: 1px solid grey;">
                          <td scope="col" class="text-center py-2" style="border: 1px solid grey;">{{ $i < 9 ? '0'.$i+=1:$i+=1 }}</td>
                          <td class="text-center" style="border: 1px solid grey;">{{ $item['matricule'] }}</td>
                          <td title="{{ $item['name'] }}" style="border: 1px solid grey;">
                            {{ Str::limit($item['name'], '25', '...') }}
                          </td>
                          <td class="text-center" style="border: 1px solid grey;">{{ $item['genre'] }}</td>
                          @forelse ($item['notes'][0] as $note)
                            <td class="text-center" style="border: 1px solid grey;">{{ $note ? $note['valeur']:'---' }}</td>
                          @empty
                            <td class="text-center" style="border: 1px solid grey;">---</td>
                          @endforelse
                          @forelse ($item['notes'][1] as $note)
                            <td class="text-center" style="border: 1px solid grey;">{{ $note ? $note['valeur']:'---' }}</td>
                          @empty
                            <td class="text-center" style="border: 1px solid grey;">---</td>
                          @endforelse
                          @forelse ($item['notes'][2] as $note)
                            <td class="text-center" style="border: 1px solid grey;">{{ $note ? $note['valeur']:'---' }}</td>
                          @empty
                            <td class="text-center" style="border: 1px solid grey;">---</td>
                          @endforelse
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

    $('#myTable').DataTable({
      ordering: false,
    });
  
  });
</script>
@endsection