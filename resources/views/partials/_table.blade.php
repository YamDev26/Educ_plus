<table class="table table-bordered" id="yearTable">
    <thead>
        <tr class="table-active">
            <th class="py-2 text-center" scope="col">#</th>
            <th class="py-2 text-center" scope="col">Année Scolaire</th>
            <th class="py-2 text-center" scope="col">Libellé</th>
            <th class="py-2 text-center" scope="col">Statut</th>
            <th class="py-2 text-center" scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @php $i = 0; @endphp
        @forelse ($years as $year)
            <tr class="dataYear">
                <td class="text-center">{{ $i <= 9 ? '0'.$i+=1:$i+=1 }}</td>
                <td class="text-center">{{ $year['libelle'] }}</td>
                <td class="text-center">{{ ucwords($year['cutting'] == 1 ? 'Trimestre':'Semestre') }}</td>
                <td class="text-center">
                    <span class="badge badge rounded-pill d-block p-2 badge-subtle-{{ $year['actif'] ? 'success':'danger' }} w-50" style="margin: 0px auto">
                        {{ $year['actif'] ? 'Actif':'Inactif' }}
                    </span>
                </td>
                <td class="text-center">
                    <div class="dropdown font-sans-serif position-static">
                        <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                            <svg class="svg-inline--fa fa-ellipsis-h fa-w-16 fs-10" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ellipsis-h" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                <path fill="currentColor" d="M328 256c0 39.8-32.2 72-72 72s-72-32.2-72-72 32.2-72 72-72 72 32.2 72 72zm104-72c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72zm-352 0c-39.8 0-72 32.2-72 72s32.2 72 72 72 72-32.2 72-72-32.2-72-72-72z"></path>
                            </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end border py-0">
                            <div class="py-2">
                                <button class="dropdown-item editBtn" data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="{{ $year['id'] }}">Edit</button>
                                <button class="dropdown-item text-danger deleteBtn" data-bs-toggle="modal" data-bs-target="#delete-modal" data-id="{{ $year['id'] }}">Delete</button>
                            </div>
                        </div>
                    </div>
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
{{ $years->links('pagination::bootstrap-5') }} <!-- Laravel pagination -->