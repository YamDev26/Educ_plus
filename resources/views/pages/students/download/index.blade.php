<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ajout de nouvel eleve</title>
</head>
<body>
  <table>
      <thead>
          <tr class="table-dark">
              <th style="width: 80px; text-align:center">num</th>
              <th style="width: 100px; text-align:center">matricule</th>
              <th style="width: 350px; text-align:center">Mom_Prenoms</th>
              <th style="width: 100px; text-align:center">genre</th>
              <th style="width: 80px; text-align:center">note</th>
          </tr>
      </thead>
      <tbody>
        @php $i = 1; @endphp
          @while ($i <= 500)
          <tr>
            <td style="text-align:center; padding: 10px 0px 10px 0px">{{ $i < 10 ? '0'.$i:$i  }}</td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
            <td style="text-align:center; padding: 10px 0px 10px 0px"></td>
          </tr>
          @php $i++ @endphp
          @endwhile
      </tbody>
  </table>
</body>
</html>