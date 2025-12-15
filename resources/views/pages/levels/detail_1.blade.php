
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
                    <h5 class="mb-0">Discipline {{ $level['code'] }}</h5>
                    <span style="float: right; ">
                        <a href="{{ route(('level.edit'), $level['id']) }}" class="btn btn-outline-light py-1 mx-2" style="font-size: 12px; border-radius: 2px">Edit</a>
                        <a href="{{ route('level.index') }}" class="btn btn-outline-light py-1 mb-1" style="font-size: 12px; border-radius: 2px">Back</a>
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-bordered" id="example2_wrapper">
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
                                @forelse ($dts as $item)
                                <tr class="dataYear">
                                    <td class="text-center">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                                    <td class="ml-3">{{ ucwords($item->discipline->libelle) }}</td>
                                    <td class="text-center">{{ ucwords($item->discipline->abbreviat) }}</td>
                                    <td class="text-center">{{ $item->coefficient }}</td>
                                </tr>
                                @empty
                                <tr class="dataYear">
                                    <td colspan="5" class="text-center">Paramètre non effectué.</td>
                                </tr>
                                @endforelse
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