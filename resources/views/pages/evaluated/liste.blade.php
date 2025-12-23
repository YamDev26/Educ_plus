
@extends('app')
@section('title', 'Evaluated Add Not')
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
                  <h5 class="mb-0"><span id="libelle">Detail</span> Note - <span style="text-decoration: underline">{{ ucwords($evaluated->disciplineLevel->discipline->abbreviat) }}</span></h5>
                  <h5 class="mb-0" style="text-decoration: underline">{{ $evaluated->classe->libelle }}</h5>
                  <span class="px-0" style="float: right; border-bottom: 2px solid">
                    @if (count($students))
                    <button type="button" class="btn btn-outline-light py-0 px-2 mb-1" id="editBtn" style="border: none; border-radius: 3px" title="Edit Not">
                      <i class="fadeIn animated bx bx-edit-alt mx-0" style="font-size: 17px"></i>
                    </button>
                    @else
                    <a href="{{ route('evaluated.note', $evaluated->id) }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Add Note" style="border: none; border-radius: 3px">
                      <i class="fadeIn animated bx bx-duplicate m-0" style="font-size: 17px"></i>
                    </a>
                    @endif
                    <a href="{{ route('evaluated.back', $evaluated->classe->id.'_'.$evaluated->disciplineLevel->id) }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                      <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                    </a>
                  </span>
                </div>
                <div class="card-body">
                  <form action="{{ route('evaluated.store') }}" method="post" id="myForm">
                    @csrf
                    <div class="table-responsive mt-4">
                      <span class="my-0 py-0" style="position: absolute; font-size: 17px">
                        {{ ucwords($evaluated->evaluadet_type->libelle) }} du <u class="text-white">{{ date('d-m-Y', strtotime($evaluated->created)) }}</u>
                      </span>
                      <table class="table table-striped table-bordered mt-0" id="Transaction-History" style="border: 1px solid">
                          <thead>
                            <tr class="table-dark">
                              <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 5%"></th>
                              <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 20%">Matricule</th>
                              <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 35%">Mon & Prenoms</th>
                              <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 20%">Genre</th>
                              <th class="text-center py-2" scope="col" style="width: 20%">Note</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php $i = 0; @endphp
                            @foreach ($students as $item)
                            <tr>
                              <td scope="col" class="text-center">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                              <td class="text-center">{{ $item->matricule }}</td>
                              <td title="{{ strtoupper($item->first_name).' '.ucwords($item->last_name) }}">
                                {{ strtoupper($item->first_name).' '.Str::limit(ucwords($item->last_name), '25', '...') }}
                              </td>
                              <td class="text-center">
                                {{ $item->genre == 'F' ? 'Feminin':'Masculin' }}
                              </td>
                              <td class="p-0 d-flex text-center">
                                <div class="input-group m-0" style="margin: 0% auto">
                                  <input type="text" class="form-control w-50 myInput text-center" style="border-radius: 1px;" value="{{ $item->valeur }}">
                                  <span class="input-group-text w-50" id="inputGroup-sizing-default" style="border-radius: 1px"><strong>/ {{ $evaluated->value*20 }}</strong></span>
                                </div>
                              </td>
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                    </div>
                    <hr>
                    <div class="text-center" id="btnEdit" style="display: none">
                      <button class="btn btn-dark w-25" id="btnValid">Confirm ...</button>
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
    $('#editBtn').on('click', function(e) {
      e.preventDefault();
      $("#editBtn").hide(500);
      $('.myInput').css('border', ' 1px dashed rgb(52, 154, 212)');
      $('#libelle').text('Edit');
      $('#btnEdit').show(500);
    });
  });
</script>
@endsection