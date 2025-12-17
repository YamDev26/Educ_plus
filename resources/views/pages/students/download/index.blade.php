<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add New Student</title>
</head>
<body>
  <table>
      <thead>
          <tr class="table-dark">
              <th style="width: 80px; text-align:center">num</th>
              <th style="width: 150px; text-align:center">matricule</th>
              <th style="width: 150px; text-align:center">nom</th>
              <th style="width: 150px; text-align:center">prenoms</th>
              <th style="width: 150px; text-align:center">genre</th>
              <th style="width: 150px; text-align:center">date_naissance</th>
              <th style="width: 150px; text-align:center">lieu_naissance</th>
              <th style="width: 150px; text-align:center">nationalite</th>
              <th style="width: 150px; text-align:center">nom_parent</th>
              <th style="width: 150px; text-align:center">prenom_parent</th>
              <th style="width: 150px; text-align:center">contact_parent_1</th>
              <th style="width: 150px; text-align:center">contact_parent_2</th>
          </tr>
      </thead>
      <tbody>
        @php $i = 1; @endphp
          @while ($i <= 500)
          <tr>
            <td style="text-align:center; padding: 10px 0px 10px 0px">{{ $i < 10 ? '0'.$i:$i  }}</td>
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