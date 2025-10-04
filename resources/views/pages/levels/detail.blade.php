
@extends('app')
@section('title', 'list discipline')
@section('content')
<div class="row g-3">
    <div class="col-12">
        <div class="card" id="TableCrmRecentLeads" data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;status&quot;],&quot;page&quot;:8,&quot;pagination&quot;:true}">
            <div class="card-header bg-body-tertiary pt-3 pb-2">
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
                            <a href="{{ route(($dts ? 'level.edit':'level.create'), $level['id']) }}" class="btn btn-falcon-default btn-sm mb-2" style="float: right">{{ $dts ? 'Edit':'Add' }}</a>
                        </h5>
                    </div>
                </div>
            </div>
            <hr class="mt-0 mb-2 mx-2">
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    @include('partials._search')

                    <!-- Table de data -->
                    <table class="table table-bordered" id="yearTable">
                        <thead>
                            <tr class="table-active">
                                <th class="py-2 text-center" scope="col">#</th>
                                <th class="py-2 text-center" scope="col">Libellé</th>
                                <th class="py-2 text-center" scope="col">Code</th>
                                <th class="py-2 text-center" scope="col">coefficient</th>
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
                                    <td colspan="5" class="text-center">
                                        <span style="font-size: 13px">Matières non parametrées</span>
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
        
    });
</script>
@endsection