@extends('app')
@section('title', 'Slot Time')
@section('content')
<div class="row g-3">
    <div class="col-12">
        <div class="card" id="TableCrmRecentLeads" data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;status&quot;],&quot;page&quot;:8,&quot;pagination&quot;:true}">
            <div class="card-header d-flex flex-between-center flex-wrap gap-2 pt-3 pb-0 mb-0">
                <h5 class="mb-0">Slot Time</h5>
                <div id="table-recent-leads-actions">
                    @if(!(count($morning) && count($after)))
                    <a href="{{ route('slot.create') }}" class="btn btn-falcon-default btn-sm mb-2" style="float: left">Add</a>
                    @endif
                </div>
            </div>
            <hr class="mt-0 mb-2 mx-4">
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    @include('partials._search')

                    <!-- Table de data -->
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr class="table-active">
                                <th class="py-2 text-center" scope="col">#</th>
                                <th class="py-2 text-center" scope="col">Libellé</th>
                                <th class="py-2 text-center" scope="col">Debut</th>
                                <th class="py-2 text-center" scope="col">Fin</th>
                                <th class="py-2 text-center" scope="col">Actions</th>
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
                                    <td class="text-center py-2">
                                        <button class="btn btnEdit btn-sm px-2 py-1" title="Edit Data" data-id="{{ $item['id'] }}" data-val1="{{ $item['debut'] }}" data-val2="{{ $item['fin'] }}" data-bs-toggle="modal" data-bs-target="#edit-modal">
                                            <i class="far fa-edit m-0"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                <tr class="tableBasique">
                                    <th colspan="5" class="py-0 mx-md-5">
                                        <div class="d-flex justify-content-around">
                                            <span>----------</span>
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
                                    <td class="text-center py-2">
                                        <button class="btn btnEdit btn-sm px-2 py-1" title="Edit Data" data-id="{{ $item['id'] }}" data-val1="{{ $item['debut'] }}" data-val2="{{ $item['fin'] }}" data-bs-toggle="modal" data-bs-target="#edit-modal">
                                            <i class="far fa-edit m-0"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                               <tr class="tableBasique">
                                    <td colspan="5" class="text-center">
                                        <span style="font-size: 13px">Informations Non Disponibles</span>
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
<div class="tab-pane preview-tab-pane active" role="tabpanel" aria-labelledby="tab-dom-fe77f32a-358a-42ac-9b73-d0222afa6979" id="dom-fe77f32a-358a-42ac-9b73-d0222afa6979">
<!-- Modal Edit School Year -->
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <form action="{{ route('slot.update') }}" method="post">
                    @csrf
                    <div class="modal-body p-0">
                        <div class="rounded-top-3 py-2 ps-4 pe-6 bg-body-tertiary">
                            <h5 class="mb-1" id="modalExampleDemoLabel">Edit Slot Time</h5>
                        </div>
                        <div class="p-4 pb-0">
                            <input type="hidden" name="id" id="idEdit">
                            <div class="mb-3">
                                <label class="col-form-label" for="debut">Heure Debut<span class="text-danger">*</span> :</label>
                                <input type="time" name="debut" class="form-control" id="debut">
                            </div>
                            <div class="mb-3">
                                <label class="col-form-label" for="fin">Heure FIn<span class="text-danger">*</span> :</label>
                                <input type="time" name="fin" class="form-control" id="fin">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" style="font-size: 12px" type="button" data-bs-dismiss="modal">Annuler</button>
                        <button class="btn btn-primary" style="font-size: 12px" type="submit">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {

        $('.btnEdit').on('click', function() {
            $('#idEdit').val($(this).data('id'));
            $('#debut').val($(this).data('val1'));
            $('#fin').val($(this).data('val2'));
        });


        // Search Input Get -----
        $('#inputSearch').on('keyup', function() {
            $val = $(this).val();

            if($val){
               $.ajax({
                    url: '{{ route('slot.search') }}',
                    method: 'GET',
                    data: {search: $val},
                    success: function(data) {
                        $('.tableBasique').hide();
                        $('.mySearch').remove();

                        
                        if(data['status'] == 200){
                            addRow(data['data']);
                        }
                        else{
                            console.log(data['status']);
                            $('#myTable tbody').append(`
                                <tr class="mySearch">
                                    <td colspan="5" class="text-center" style="font-size: 13px">Informations Introuvables</td>
                                </tr>
                            `);
                        }
                    },
                });
            }
            else{
                $('.tableBasique').show();
                $('.mySearch').remove();
            }
        });



        // FUNCTION GET App
        function addRow($data){
            $i = 0;
            while($i <= $data.length){
                $t = $i+1 <= 9 ? '0'+($i+1):$i+1;
                $actif = $data[$i]['actif'] ? 'success':'danger';
                $val = $data[$i]['actif'] ? 'Actif':'Inactif'
                $('#myTable tbody').append(`<tr class="yearSearch">
                    <td class="text-center">`+$t+`</td>
                    <td class="text-center">`+$data[$i]['libelle']+`</td>
                    <td class="text-center">`+ucfirst($data[$i]['cutting'])+`</td>
                    <td class="text-center">
                        <span class="badge badge rounded-pill d-block p-2 badge-subtle-`+$actif+` w-50" style="margin: 0px auto">
                            `+$val+`
                        </span>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-link p-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit" data-bs-original-title="Edit">
                            <svg class="svg-inline--fa fa-edit fa-w-18 text-500" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                                <path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path>
                            </svg>
                        </button>
                        <button class="btn btn-link p-0 ms-2" type="button" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Delete" data-bs-original-title="Delete">
                            <svg class="svg-inline--fa fa-trash-alt fa-w-14 text-500" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                                <path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path>
                            </svg>
                        </button>
                    </td>
                </tr>`);
                $i++;
            }
        }

    });
</script>
@endsection