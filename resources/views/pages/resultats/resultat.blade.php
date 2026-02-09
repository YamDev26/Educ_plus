
@extends('app')
@section('title', 'List Resultat')
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
                  <h5 class="mb-0">Resultat liste - {{ ucwords($cutting->cutting->libelle) }}</h5>
                  <h5 class="mb-0">{{ $classe->libelle }}</h5>
                  <span class="d-flex" style="float: right;">
                    <a href="{{ route('resultat.pdf') }}" target="_back" class="btn btn-outline-light py-0 px-2 mb-1" style="border: none; border-radius: 3px">
                      <i class="lni lni-files m-0" style="font-size: 17px"></i>
                    </a>
                    <a href="{{ route('resultat.index') }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                      <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                    </a>
                  </span>
                </div>
                <div class="card-body">
                  <div class="table-responsive mt-2">
                    <table class="table table-striped" id="myTable">
                      <thead>
                        <tr class="table-dark" style="border: 1px solid grey">
                          <th class="text-center" scope="col" style="border: 1px solid grey"></th>
                          <th class="text-center" scope="col" style="border: 1px solid grey">Matricule</th>
                          <th class="text-center" scope="col" style="border: 1px solid grey">Nom & Prénoms</th>
                          <th class="text-center" scope="col" style="border: 1px solid grey">Genre</th>
                          <th class="text-center" scope="col" style="width: 10%; border: 1px solid grey">Moyenne</th>
                          <th class="text-center" scope="col" style="width: 10%; border: 1px solid grey">Rang</th>
                          <th class="text-center py-1" scope="col" style="border: 1px solid grey; width: 7%">
                            <input type="checkbox" id="checkAll">
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $i = 0; @endphp
                        @foreach ($dats as $item)
                          <tr style="border: 1px solid grey">
                            <td scope="col" class="text-center" style="border: 1px solid grey">{{ $i < 9 ? '0'.$i+=1:$i+=1 }}</td>
                            <td class="text-center" style="border: 1px solid grey">{{ $item['matricule'] }}</td>
                            <td title="{{ $item['name'] }}" style="border: 1px solid grey">
                              {{ Str::limit($item['name'], '40', '...') }}
                            </td>
                            <td class="text-center" style="border: 1px solid grey">{{ $item['genre'] }}</td>
                            <td class="text-center" style="border: 1px solid grey">{{ $item['moyen'] ? $item['moyen']['moyenne']:'---'}}</td>
                            <td class="text-center" style="border: 1px solid grey">{{ $item['moyen'] ? $item['moyen']['rang']:'---'}}</td>
                            <td class="text-center" style="border: 1px solid grey">
                              <input type="checkbox" name="{{ $item['id'] }}" class="row-check">
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
<script>
  $(document).ready(function() {

    $('#myTable').DataTable({
      ordering: false
    });

    $("#checkAll").on("change", function(){
      let table = $('#myTable').DataTable();
      var checked = this.checked;
      table.rows().every(function () {
        $(this.node()).find('.row-check').prop('checked', checked);
      });
    });

  });
</script>
@endsection