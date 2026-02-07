@extends('pdf')
@section('title', strtoupper('moyenne '.$cutting->cutting->libelle.' - '.$classe->libelle))
@section('font', ucwords($cutting->cutting->libelle.' - '.$classe->libelle))
@section('year', $classe->schoolYear->libelle)
@section('content')
<div style="width: 100%; height: 17px; text-align: center; margin-top: 20px; margin-bottom: 30px;">
  <span style="font-size: 17px; text-decoration: underline; font-weight: 900;">
    LISTE MOYENNE {{ strtoupper($cutting->cutting->libelle.' - '.$classe->libelle) }}
  </span><br>
  <span>PP - {{ $enseignant ?? '---' }}</span>
</div>
<div style="margin-top: 5%">
  <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; margin: 0px auto; border: 1px solid black;">
    <thead style="background: rgb(210, 209, 209);">
      <tr>
        <th scope="col" style="width: 3%; font-size: 14px; padding: 5px 0px"></th>
        <th scope="col" style="width: 8%; font-size: 12px">Matricule</th>
        <th scope="col" style="width: 26%; font-size: 12px">Nom & Prenoms</th>
        <th scope="col" style="width: 7%; font-size: 12px">Genre</th>
        @foreach ($matters as $item)
        <th scope="col" style="font-size: 12px">{{ $item['abbreviat'] }}</th>
        @endforeach
        <th scope="col" style="width: 7%; font-size: 12px">Moyenne</th>
        <th scope="col" style="width: 7%; font-size: 12px">Rang</th>
      </tr>
    </thead>
    <tbody>
      @php $i = 0; @endphp
      @foreach ($data as $item)
      <tr>
        <th scope="col" style="text-align: center;font-size: 10px; padding: 9px 0px">{{ $i < 9 ? '0'.$i+=1:$i+=1 }}</th>
        <td style="text-align: center;font-size: 12px">{{ $item['matricule'] }}</td>
        <td style="font-size: 12px; padding-left: 7px">{{ Str::limit($item['name'], '40', '...') }}</td>
        <td style="text-align: center;font-size: 12px">{{ $item['genre'] }}</td>
        @foreach ($item['moyens'] as $moyen)
        <td style="text-align: center;font-size: 12px">{{ $moyen ?? '---' }}</td>
        @endforeach
        <td style="text-align: center;font-size: 12px">{{ $item['moyen'] ? $item['moyen']['moyenne']:'---'}}</td>
        <td style="text-align: center;font-size: 12px">{{ $item['moyen'] ? $item['moyen']['rang']:'---'}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection