@extends('pdf')
@section('title', 'Fiche d\'inscription')
@section('font', 'Fiche d\'inscription')
@section('year', '2025-2026')
@section('content')
<div style="width: 70%; border: 2px solid; border-radius: 30px; text-align: center; margin: 20px auto; padding: 15px; font-size: 23px; font-weight: 900;">
  FICHE INDIVIDUELLE D'INSCRIPTION
</div>
<div style="width: 100%; text-align:center; margin-top: 3%; font-size: 17px">
  {{ ucwords('Année scolaire 2025 / 2026') }}
</div>

<div style="width: 95%; margin: 20px auto; padding: 10px; border: 1px solid rgb(120, 117, 117); border-radius: 2px; text-align: center">
    <h3 style="text-decoration: underline; margin-top: 5px">COLLEGE SAINT VIATEUR ABIDJAN</h3>
    <table style="width: 100%">
      <tbody>
        <tr>
          <td style="width: 70%; text-align: left">
            <p style="margin: 2px 5px 2px 0px">Email: {{ $school->email }}</p>
            <p style="margin: 2px 5px 2px 0px">Tel: {{ $school->numero }}</p>
            <p style="margin: 2px 5px 2px 0px">Adresse postale: {{ $school->postale }}</p>
            <p style="margin: 2px 5px 2px 0px">DREN: {{ strtoupper($school->dren) }}</p>
            <p style="margin: 2px 5px 2px 0px">Ville: {{ ucwords($school->ville) }}</p>
          </td>
          <td style="width: 30%; text-align: center">
            <div style="margin-bottom: 5px">{{ ucwords($school->statut) }}</div>
            <img src="{{ public_path('storage/' . $school->logo) }}" class="img-fluid" alt="logo" style="width: 100px; height: 100px; border: 2px solid black; border-radius: 10px">
          </td>
        </tr>
      </tbody>
    </table>
</div>
@endsection