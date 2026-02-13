@extends('pages.resultats.pdf.bulletin')
@section('title', strtoupper('bulletin '.$cutting->cutting->libelle.' - '.$classe->libelle))
@section('content')
<section>
  <div style="width: 100%; height: 17px; margin-top: 10px; margin-bottom: 30px ;text-align: center">
    <span style="font-size: 23px; text-decoration: underline; font-weight: 700;">
      Bulletin De Notes  {{ ucfirst($cutting->cutting->libelle) }} - Année Scolaire {{ $classe->schoolYear->libelle }}
    </span>
  </div>
</section>
@endsection