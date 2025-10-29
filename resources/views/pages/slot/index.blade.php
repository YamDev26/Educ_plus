@extends('app')
@section('title', 'Slot Time')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-lg-10 col-12 offset-lg-1">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-2 mb-0">
                    <h5 class="mb-0">Slot Time</h5>
                    <a href="{{route('slot.create') }}" class="btn btn-outline-light py-1 mb-1" style="font-size: 12px; border-radius: 2px">{{ $morning ? 'Edit':'Add' }}</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr class="table-dark">
                                    <th class="py-2 text-center" scope="col"></th>
                                    <th class="py-2 text-center" scope="col">Libellé</th>
                                    <th class="py-2 text-center" scope="col">Debut</th>
                                    <th class="py-2 text-center" scope="col">Fin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @if (count($morning) && count($after))
                                    @foreach ($morning as $item)
                                    <tr class="tableBasique">
                                        <td class="text-center py-2">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                                        <td class="text-left pl-2 py-2">{{$item['order'] == 1 ? $item['order'].'ère':$item['order'].'ème'}} Heure</td>
                                        <td class="text-center py-2">
                                            @php $vals = explode(':', $item['debut']);  @endphp {{ $vals[0].'h'.$vals[1] }}
                                        </td>
                                        <td class="text-center py-2">
                                            @php $vals = explode(':', $item['fin']);  @endphp {{ $vals[0].'h'.$vals[1] }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr class="tableBasique">
                                        <th colspan="5" class="py-2 mx-md-5">
                                            <div class="d-flex justify-content-around">
                                                <span>----------</span>
                                                <span>----------</span>
                                                <span>----------</span>
                                            </div>
                                        </th>
                                    </tr>
                                    @foreach ($after as $item)
                                    <tr class="tableBasique">
                                        <td class="text-center py-2">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                                        <td class="text-left pl-2 py-2">{{$item['order'] == 1 ? $item['order'].'ère':$item['order'].'ème'}} Heure</td>
                                        <td class="text-center py-2">
                                            @php $vals = explode(':', $item['debut']);  @endphp {{ $vals[0].'h'.$vals[1] }}
                                        </td>
                                        <td class="text-center py-2">
                                            @php $vals = explode(':', $item['fin']);  @endphp {{ $vals[0].'h'.$vals[1] }}
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                <tr class="tableBasique">
                                        <td colspan="5" class="text-center">
                                            <span style="font-size: 14px">Aucune donnée trouvée</span>
                                        </td>
                                    </tr> 
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection