<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add Inscription {{ $classe['libelle'] }}</title>
</head>
<body>
  <table>
      <thead>
          <tr class="table-dark">
              <th style="width: 80px; text-align:center">num</th>
              @if ($classe['lv2'])
              <th style="width: 150px; text-align:center">LV2</th>
              @endif
              <th style="width: 150px; text-align:center">matricule</th>
              <th style="width: 150px; text-align:center">nom</th>
              <th style="width: 150px; text-align:center">prenoms</th>
              <th style="width: 150px; text-align:center">genre</th>
              <th style="width: 100px; text-align:center">affecte</th>
              <th style="width: 100px; text-align:center">redoublant</th>
              <th style="width: 100px; text-align:center">boursier</th>
          </tr>
      </thead>
      <tbody>
        @php $i = 1; @endphp
          @while ($i <= $classe['effectif'])
          <tr>
            <td style="text-align:center; padding: 10px 0px 10px 0px">{{ $i < 10 ? '0'.$i:$i }}</td>
            @if ($classe['lv2'])
            <th style="width: 150px; text-align:center">{{ $classe['lv2'] != 'mixte' ? $classe['lv2']:'' }}</th>
            @endif
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
          </tr>
          @php $i++ @endphp
          @endwhile
      </tbody>
  </table>
</body>
</html>