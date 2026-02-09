
@extends('app')
@section('title', 'Discipline '.$level['code'])
@section('link')

@endsection
@section('content')
<div class="page-content mx-sm-3">
    <div class="row">
        <div class="col-12 px-lg-2">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-2 mb-0">
                    <h5 class="mb-0">Niveau {{ $level['code'] }}</h5>
                    <span class="mb-0 d-flex" style="float: right;">
                      <form action="{{ route('level.edit', $level['id']) }}" method="get">
                        @csrf
                        <input type="hidden" name="serie" id="serie">
                        <button type="submit" class="btn btn-outline-light py-0 px-2" style="border: none; border-radius: 3px">
                          <i class="fadeIn animated bx bx-edit-alt m-0" style="font-size: 16px"></i>
                        </button>
                      </form>
                      <a href="{{ route('level.index') }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                        <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                      </a>
                    </span>
                </div>
                <div class="card-body mx-3">
                  <ul class="nav nav-tabs" role="tablist">
                    @foreach ($dts as $item)
                      <li class="nav-item" role="presentation" style="width: 200px">
                        <a class="nav-link {{ $item['actif'] == 1 ? 'active':null }}" id="{{ $item['actif'] == 1 ? 'actif':$item['actif'] }}" data-id="{{ $item['id'] }}" data-bs-toggle="tab" href="#{{ $item['link'] }}" role="tab" aria-selected="true">
                          <div class="d-flex align-items-center">
                            <div class="tab-icon">
                              <i class="lni lni-cogs me-1"></i>
                            </div>
                            <div class="tab-title">{{ 'Série '.strtoupper($item['libelle']) }}</div>
                          </div>
                        </a>
                      </li>
                    @endforeach
                  </ul>
                  <div class="table-responsive mt-4">
                    <div class="tab-content py-3">
                      @foreach ($dts as $item)
                        <div class="tab-pane fade {{ $item['actif'] == 1 ? 'active show':null }}" id="{{ $item['link'] }}" role="tabpanel">
                          <table class="table table-bordered" id="example2_wrapper">
                            <thead>
                              <tr class="table-dark">
                                <th class="py-2 text-center" scope="col" style="width: 10%"></th>
                                <th class="py-2 text-center" scope="col" style="width: 40%">Libellé</th>
                                <th class="py-2 text-center" scope="col" style="width: 30%">Code</th>
                                <th class="py-2 text-center" scope="col" style="width: 20%">coefficient</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @forelse ($item['data'] as $items)
                                  <tr class="dataYear">
                                    <td class="text-center">{{ $i < 9 ? '0'.$i+=1:$i+=1 }}</td>
                                    <td class="ml-3">{{ ucwords($items->discipline->libelle) }}</td>
                                    <td class="text-center">{{ ucwords($items->discipline->abbreviat) }}</td>
                                    <td class="text-center">{{ $items->coefficient }}</td>
                                  </tr>
                                @empty
                                <tr class="dataYear">
                                  <td colspan="5" class="text-center">Paramètre non effectué.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        </div>
                      @endforeach
                    </div>
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
    // URL Default End Page
    $id = $('#actif').data('id');
    $('#serie').val($id);
    
    $('.nav-item a').on('click', function() {
      $id = $(this).data('id');
      $('#serie').val($id);
    })
  });
</script>
@endsection