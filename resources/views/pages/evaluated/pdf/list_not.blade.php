@extends('pdf')
@section('title', ucwords($evaluated->evaluadet_type->libelle))
@section('font', ucwords($evaluated->evaluadet_type->libelle))
@section('year', $evaluated->classe->schoolYear->libelle)
@section('content')
<div style="width: 100%; height: 17px; text-align: center; margin-top: 20px; margin-bottom: 30px;">
  <span style="font-size: 17px; text-decoration: underline; font-weight: 900;">
    Note {{ ucwords($evaluated->evaluadet_type->libelle).' '.$evaluated->disciplineLevel->discipline->abbreviat.
    ' du '.date('d-m-Y', strtotime($evaluated->created)).' - '.$evaluated->classe->libelle }}
  </span><br>
  <span>{{ $enseignant ?? '---' }}</span>
</div>

<div style="margin-top: 10%">
  <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%; margin: 0px auto; border: 1px solid black;">
    <thead style="background: rgb(210, 209, 209)">
      <tr>
        <th scope="col" style="width: 8%; font-size: 14px; padding: 5px 0px">N°</th>
        <th scope="col" style="width: 15%; font-size: 12px">Matricule</th>
        <th scope="col" style="width: 40%; font-size: 12px">Nom & Prenoms</th>
        <th scope="col" style="width: 20%; font-size: 12px">Genre</th>
        <th scope="col" style="width: 17%; font-size: 12px">Note</th>
      </tr>
    </thead>
    <tbody>
      @php $i = 0; @endphp
      @foreach ($students as $item)
      <tr>
        <th scope="col" style="text-align: center; font-size: 10px; padding: 9px 0px">{{ $i < 9 ? '0'.$i+=1:$i+=1 }}</th>
        <td style="text-align: center; font-size: 12px">{{ $item->matricule }}</td>
        <td style="font-size: 12px; padding-left: 7px">{{ strtoupper($item->first_name).' '.Str::limit(ucwords($item->last_name), '30', '...') }}</td>
        <td style="text-align: center; font-size: 12px">{{ $item->genre == 'F' ? 'Feminin':'Masculin' }}</td>
        <td style="text-align: center; font-size: 12px">
          <strong>{{ $item->valeur == 'nc' ? $item->valeur : $item->valeur.' / '.$evaluated->value*20 }}</strong>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection