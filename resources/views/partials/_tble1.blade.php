<table class="table table-striped table-bordered mt-0" id="Transaction-History" style="border: 1px solid">
  <thead>
    <tr class="table-dark">
      <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 5%"></th>
      <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 8%">Matricule</th>
      <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 25%">Nom & Prenoms</th>
      <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 5%">Genre</th>
      @php $i = 1; @endphp
      @forelse ($evaluated as $item)
      <th class="text-center py-2" scope="col" style="border-right: 1px solid white;" title="Note sur {{ $item->value*20 }}">N{{ $i++ }}</th>
      @empty
      <th class="text-center py-2" scope="col" style="border-right: 1px solid white;">Undefined evaluated</th>
      @endforelse
      <th class="text-center py-2" scope="col" style="border-right: 1px solid white;">Moyenne</th>
      <th class="text-center py-2" scope="col">Rang</th>
    </tr>
  </thead>
  <tbody>
    @php $i = 0; @endphp
    @foreach ($datas as $item)
    <tr>
      <td scope="col" class="text-center">{{ $i < 9 ? '0'.$i+=1:$i+=1 }}</td>
      <td class="text-center">{{ $item['matricule'] }}</td>
      <td title="{{ $item['name'] }}">
        {{ Str::limit($item['name'], '30', '...') }}
      </td>
      <td class="text-center">{{ $item['genre'] }}</td>
      @forelse ($item['notes'] as $note)
        <td class="text-center">{{ $note ? $note['valeur']:'---' }}</td>
      @empty
        <td class="text-center">---</td>
      @endforelse
      <td class="text-center">{{ $item['resultat'] ? $item['resultat']['moyenne']:'---'}}</td>
      <td class="text-center">{{ $item['resultat'] ? $item['resultat']['rang']:'---'}}</td>
    </tr>
    @endforeach
  </tbody>
</table>