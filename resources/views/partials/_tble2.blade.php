<table class="table table-striped mt-0" id="myTable">
  <thead>
    <tr class="table-dark">
      <th class="text-center py-2" scope="col" style="border: 1px solid grey; width: 5%"></th>
      <th class="text-center py-2" scope="col" style="border: 1px solid grey; width: 8%">Matricule</th>
      <th class="text-center py-2" scope="col" style="border: 1px solid grey; width: 25%">Nom & Prenoms</th>
      <th class="text-center py-2" scope="col" style="border: 1px solid grey; width: 5%">Genre</th>
      <th class="text-center py-2" scope="col" style="border: 1px solid grey;" title="Composition Française">CF</th>
      <th class="text-center py-2" scope="col" style="border: 1px solid grey;" title="Orthographe-Grammaire">OG</th>
      <th class="text-center py-2" scope="col" style="border: 1px solid grey;" title="Expression Orale">EO</th>
      <th class="text-center py-2" scope="col" style="border: 1px solid grey;">Moyenne</th>
      <th class="text-center py-2" scope="col" style="border: 1px solid grey;">Rang</th>
    </tr>
  </thead>
  <tbody>
    @php $i = 0; @endphp
    @foreach ($datas as $item)
    <tr style="border: 1px solid grey;">
      <td scope="col" class="text-center py-2" style="border: 1px solid grey;">{{ $i < 9 ? '0'.$i+=1:$i+=1 }}</td>
      <td class="text-center" style="border: 1px solid grey;">{{ $item['matricule'] }}</td>
      <td title="{{ $item['name'] }}" style="border: 1px solid grey;">
        {{ Str::limit($item['name'], '25', '...') }}
      </td>
      <td class="text-center" style="border: 1px solid grey;">{{ $item['genre'] }}</td>
      @forelse ($item['notes'] as $note)
        <td class="text-center" style="border: 1px solid grey;">{{ $note ? $note['moyenne']:'---' }}</td>
      @empty
        <td class="text-center" style="border: 1px solid grey;">---</td>
      @endforelse
      <td class="text-center" style="border: 1px solid grey;">{{ $item['resultat'] ? $item['resultat']['moyenne']:'---'}}</td>
      <td class="text-center" style="border: 1px solid grey;">{{ $item['resultat'] ? $item['resultat']['rang']:'---'}}</td>
    </tr>
    @endforeach
  </tbody>
</table>