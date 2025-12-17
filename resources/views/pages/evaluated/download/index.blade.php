<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ ucwords($evaluated->type).' - '.(20*$evaluated->value) }}</title>
</head>
<body>
   <table>
      <thead>
          <tr class="table-dark">
              <th style="width: 80px; text-align:center">num</th>
              <th style="width: 100px; text-align:center">matricule</th>
              <th style="width: 350px; text-align:center">nom_Prenoms</th>
              <th style="width: 100px; text-align:center">genre</th>
              <th style="width: 80px; text-align:center">note</th>
          </tr>
      </thead>
      <tbody>
        @php $i = 1; @endphp
          @foreach ($students as $item)
          <tr>
            <td style="text-align:center; padding: 10px 0px 10px 0px">{{ $i++.'_'.$item->id.'_'.$evaluated->id }}</td>
            <td style="text-align:center; padding: 10px 0px 10px 0px">{{ $item->matricule }}</td>
            <td> {{ strtoupper($item->first_name).' '.ucwords($item->last_name) }}</td>
            <td style="text-align:center; padding: 10px 0px 10px 0px">{{ $item->genre == 'F' ? 'Feminin':'Masculin' }}</td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
          </tr>
          @endforeach
      </tbody>
  </table>
</body>
</html>