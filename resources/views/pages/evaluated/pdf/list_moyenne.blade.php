@extends('pdf')
@section('title', 'liste moyenne matiere')
@section('font', 'Moyenne '.$matters->discipline->abbreviat.' - '.$classe->libelle)
@section('year', $classe->schoolYear->libelle)
@section('content')

<div style="width: 100%; height: 17px; text-align: center; margin-top: 20px; margin-bottom: 30px;">
  <span style="font-size: 17px; text-decoration: underline; font-weight: 900;">
    Moyenne {{ $matters->discipline->abbreviat.' '.ucwords($cuttings->cutting->libelle).' - '.$classe->libelle }}
  </span><br>
  <span>{{ $enseignant ?? '---' }}</span>
</div>

<div style="margin-top: 10%">
  <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%; margin: 0px auto; border: 1px solid black;">
    <thead style="background: rgb(210, 209, 209)">
      <tr>
        <th scope="col" style="width: 4%; font-size: 14px; padding: 5px 0px">N°</th>
        <th scope="col" style="width: 8%; font-size: 12px">Matricule</th>
        <th scope="col" style="width: 35%; font-size: 12px">Nom & Prenoms</th>
        <th scope="col" style="width: 5%; font-size: 12px">Genre</th>
        @php $i = 0; @endphp
        @while ($i < count($evaluated))
        <th scope="col" style="font-size: 12px">N{{$i+=1}}</th>
        @endwhile
        <th scope="col" style="width: 7%; font-size: 12px">Moyenne</th>
        <th scope="col" style="width: 5%; font-size: 12px">Rang</th>
      </tr>
    </thead>
    <tbody>
      @php $i = 0; @endphp
      @foreach ($students as $item)
      <tr>
        <th scope="col" style="text-align: center; font-size: 10px; padding: 9px 0px">{{ $i < 9 ? '0'.$i+=1:$i+=1 }}</th>
        <td style="text-align: center; font-size: 12px">{{ $item['matricule'] }}</td>
        <td style="font-size: 12px; padding-left: 7px">{{ Str::limit(ucwords($item['name']), '30', '...') }}</td>
        <td style="text-align: center; font-size: 12px">{{ $item['genre'] }}</td>
        @foreach ($item['notes'] as $note)
          <td style="text-align: center; font-size: 12px">
            <strong>{{ $note['valeur'] }}</strong>
          </td>
        @endforeach
        <th scope="col" style="width: 7%; font-size: 12px">{{ $item['resultat'] ? $item['resultat']['moyenne']:'---' }}</th>
        <th scope="col" style="width: 5%; font-size: 12px">{{ $item['resultat'] ? $item['resultat']['rang']:'---' }}</th>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection