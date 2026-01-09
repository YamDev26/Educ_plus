<table class="table table-striped table-bordered mt-0" id="Transaction-History" style="border: 1px solid">
  <thead>
    <tr class="table-dark">
      <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 5%"></th>
      <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 8%">Matricule</th>
      <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 25%">Nom & Prenoms</th>
      <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 5%">Genre</th>
      <th class="text-center py-2" scope="col" style="border-right: 1px solid white;" title="Composition Française">CF</th>
      <th class="text-center py-2" scope="col" style="border-right: 1px solid white;" title="Orthographe-Grammaire">OG</th>
      <th class="text-center py-2" scope="col" style="border-right: 1px solid white;" title="Expression Orale">EO</th>
      <th class="text-center py-2" scope="col" style="border-right: 1px solid white; width: 7%">Moyenne</th>
      <th class="text-center py-2" scope="col" style="width: 7%">Rang</th>
    </tr>
  </thead>
  <tbody>
    @php $i = 0; @endphp
    @foreach ($datas as $item)
    <tr>
      <td scope="col" class="text-center">{{ $i < 9 ? '0'.$i+=1:$i+=1 }}</td>
      <td class="text-center">{{ $item['matricule'] }}</td>
      <td title="{{ $item['name'] }}">
        {{ Str::limit($item['name'], '25', '...') }}
      </td>
      <td class="text-center">{{ $item['genre'] }}</td>
      @forelse ($item['notes'] as $note)
        <td class="text-center">{{ $note ? $note['moyenne']:'---' }}</td>
      @empty
        <td class="text-center">---</td>
      @endforelse
      <td class="text-center">{{ $item['resultat'] ? $item['resultat']['moyenne']:'---'}}</td>
      <td class="text-center">{{ $item['resultat'] ? $item['resultat']['rang']:'---'}}</td>
    </tr>
    @endforeach
  </tbody>
</table>