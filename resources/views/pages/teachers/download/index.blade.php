<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>DownLoad Teacher File</title>
</head>
<body>
  <table>
      <thead>
          <tr class="table-dark">
              <th style="width: 80px; text-align:center">n°</th>
              <th style="width: 150px; text-align:center">civilite</th>
              <th style="width: 150px; text-align:center">nom</th>
              <th style="width: 150px; text-align:center">prenoms</th>
              <th style="width: 150px; text-align:center">piece</th>
              <th style="width: 150px; text-align:center">num_piece</th>
              <th style="width: 150px; text-align:center">email</th>
              <th style="width: 150px; text-align:center">contact_1</th>
              <th style="width: 150px; text-align:center">contact_2</th>
              <th style="width: 150px; text-align:center">niveau_etude</th>
              <th style="width: 150px; text-align:center">diplome</th>
              <th style="width: 150px; text-align:center">autorisation</th>
              <th style="width: 150px; text-align:center">num_autorisation</th>
              <th style="width: 150px; text-align:center">type_embauche</th>
              <th style="width: 150px; text-align:center">annee_enseignement</th>
              <th style="width: 150px; text-align:center">matiere_enseignee</th>

          </tr>
      </thead>
      <tbody>
        @php $i = 1; @endphp
          @while ($i <= 30)
          <tr>
            <td style="text-align:center; padding: 10px 0px 10px 0px">{{ $i < 10 ? '0'.$i:$i }}</td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
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