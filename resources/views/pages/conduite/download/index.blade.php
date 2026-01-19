<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ ucwords($cutting->cutting->libelle).' - '.($classe->value) }}</title>
</head>
<body>
   <table>
      <thead>
        <tr class="table-dark">
          <th style="width: 100px; text-align:center">num</th>
          <th style="width: 150px; text-align:center">matricule</th>
          <th style="width: 300px; text-align:center">nom_Prenoms</th>
          <th style="width: 150px; text-align:center">genre</th>
          <th style="width: 150px; text-align:center">nombre_heure</th>
          <th style="width: 150px; text-align:center">justifiee</th>
          <th style="width: 150px; text-align:center">non_justifiee</th>
          <th style="width: 150px; text-align:center">moyenne</th>
        </tr>
      </thead>
      <tbody>
        @php $i = 1; @endphp
          @foreach ($students as $item) 
          <tr>
            <td style="text-align:left; padding: 10px 0px 10px 0px">{{ $item->id.'_'.$cutting->id.'_'.$i++ }}</td>
            <td style="text-align:left; padding: 10px 0px 10px 0px">{{ $item->matricule }}</td>
            <td style="text-align:left; padding: 10px 0px 10px 0px"> {{ strtoupper($item->first_name).' '.ucwords($item->last_name) }}</td>
            <td style="text-align:center; padding: 10px 0px 10px 0px">{{ $item->genre == 'F' ? 'Feminin':'Masculin' }}</td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
          </tr>
          @endforeach
      </tbody>
  </table>
</body>
</html>