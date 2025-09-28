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
                <td class="text-center">{{ ucwords($year['cutting']) }}</td>
                <td class="text-center">
                    <span class="badge badge rounded-pill d-block p-2 badge-subtle-{{ $year['actif'] ? 'success':'danger' }} w-50" style="margin: 0px auto">
                        {{ $year['actif'] ? 'Actif':'Inactif' }}
                    </span>
                </td>
                <td class="text-center">
                    <button class="btn btn-link p-0 editBtn" data-bs-toggle="modal" data-bs-target="#edit-modal" data-id="{{ $year['id'] }}" title="Edit">
                        <svg class="svg-inline--fa fa-edit fa-w-18 text-500" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path>
                        </svg>
                    </button>
                    <button class="btn btn-link p-0 ms-2 deleteBtn" data-bs-toggle="modal" data-bs-target="#delete-modal" data-id="{{ $year['id'] }}" title="Delete">
                        <svg class="svg-inline--fa fa-trash-alt fa-w-14 text-500" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M32 464a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V128H32zm272-256a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zm-96 0a16 16 0 0 1 32 0v224a16 16 0 0 1-32 0zM432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16z"></path>
                        </svg>
                    </button>
                </td>
            </tr>
        @empty
            <tr class="dataYear">
                <td colspan="5" class="text-center">
                    <span style="font-size: 13px">Informations Introuvables</span>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
{{ $years->links('pagination::bootstrap-5') }} <!-- Laravel pagination -->