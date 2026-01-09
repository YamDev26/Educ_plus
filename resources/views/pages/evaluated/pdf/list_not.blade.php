<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Evaluated Not List</title>
</head>
<style type="text/css">
  @page {
      margin: 1cm 1cm 0.9cm 1cm; /* haut droite bas gauche */
  }
  body {
    margin: 0cm;
    padding: 0cm;
    font-family: sans-serif;
    font-size: 14px
  }
  .watermark {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-50deg);
    font-size: 100px;
    color: rgba(0, 0, 0, 0.05);
    z-index: -1;
    white-space: nowrap;
    text-decoration: underline;
    pointer-events: none;
  }

  #header {
    position: fixed;
    border-bottom: 2px solid gray;
    left: 0;
    right: 0;
    text-align: center;
    font-size: 12px;
    color: #555;
  }

  #footer {
    position: fixed;
    bottom: -50px;
    border-top: 2px solid gray;
    left: 0;
    right: 0;
    height: 50px;
    text-align: center;
    font-size: 12px;
    color: #555;
  }
</style>
<body>
  <div class="watermark">{{ ucwords($evaluated->evaluadet_type->libelle) }}</div>
  <header id="header">
    <i style="text-align: center;font-size: 12px; margin:0%">REPUBLIQUEDE COTE D'IVOIRE</i>
    <i style="text-align: right; float:right; font-size: 12px; margin:0%">Union - Discipline - Travail</i>
    <i style="text-align: right; float:left; font-size: 12px; margin:0%">Année Scolaire : <strong>{{ $evaluated->classe->schoolYear->libelle }}</strong></i>
  </header>

  <section style="padding: 0%; margin-top: 5%">
    <div style="width: 100%; height: 17px; margin-top: 10px; text-align: center">
      <table style="width: 100%" >
        <tr>
          <td style="width: 50%">
            <span style="font-size: 15px; text-decoration: underline; font-weight: 700;">
              {{ ucwords($evaluated->evaluadet_type->libelle) }}
            </span><br>
            Date : {{ date('d-m-Y', strtotime($evaluated->created)) }}
          </td>
          <td style="width: 50%; text-align:right">
            <span style="font-size: 15px;">
              Matière : <span style="text-decoration: underline; font-weight: 700;">
                {{ ucwords(changeValMatter($evaluated->disciplineLevel->discipline->abbreviat, $evaluated->classe->autre)) }} {{ $evaluated->sub_matter_id ? ' - '.$evaluated->subMatter->abbreviated:null}}
              </span>
            </span><br>
            Prof: M. Koffi Jean-Luc
          </td>
        </tr>
      </table>
    </div>
    <div style="width: 100%; height: 17px; text-align: center; margin-top: 20px; margin-bottom: 30px">
      <span style="font-size: 17px; text-decoration: underline; font-weight: 700;">
        Liste des Notes {{ ucwords($evaluated->classe->libelle) }}
      </span>
    </div>

    <div style="margin-top: 10%">
      <table class="table table-striped table-bordered" style="width: 100%">
        <thead style="background: rgb(179, 178, 178);">
          <tr>
            <th scope="col" style="width: 8%; border: 1px solid rgb(179, 178, 178); font-size: 14px; padding: 5px 0px">N°</th>
            <th scope="col" style="width: 15%; border: 1px solid rgb(179, 178, 178); font-size: 12px">Matricule</th>
            <th scope="col" style="width: 40%; border: 1px solid rgb(179, 178, 178); font-size: 12px">Nom & Prenoms</th>
            <th scope="col" style="width: 20%; border: 1px solid rgb(179, 178, 178); font-size: 12px">Genre</th>
            <th scope="col" style="width: 17%; border: 1px solid rgb(179, 178, 178); font-size: 12px">Note</th>
          </tr>
        </thead>
        <tbody>
          @php $i = 0; @endphp
          @foreach ($students as $item)
          <tr>
            <th scope="col" style="text-align: center; border: 1px solid rgb(179, 178, 178); font-size: 10px; padding: 9px 0px">{{ $i < 9 ? '0'.$i+=1:$i+=1 }}</th>
            <td style="text-align: center; border: 1px solid rgb(179, 178, 178); font-size: 12px">{{ $item->matricule }}</td>
            <td style="border: 1px solid rgb(179, 178, 178); font-size: 12px; padding-left: 7px">{{ strtoupper($item->first_name).' '.Str::limit(ucwords($item->last_name), '25', '...') }}</td>
            <td style="text-align: center; border: 1px solid rgb(179, 178, 178); font-size: 12px">{{ $item->genre == 'F' ? 'Feminin':'Masculin' }}</td>
            <td style="text-align: center; border: 1px solid rgb(179, 178, 178); font-size: 12px">
              <strong>{{ $item->valeur == 'nc' ? $item->valeur : $item->valeur.' / '.$evaluated->value*20 }}</strong>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>

  <footer id="footer">
    <table style="width: 100%">
      <tbody>
        <tr>
          <td style="width: 40%">
            <i style="text-align: right; float:left; font-size: 10px; margin:0%">{{ ucwords($school->name) }}</i>
          </td>
          <td style="width: 30%">
            <i style="text-align: center;font-size: 10px; margin:0%">{{ $school->email}} / {{$school->numero }}</i>
          </td>
          <td style="width: 30%">
            <i style="text-align: right; float:right; font-size: 10px; margin:0%">Imprimé le {{date('Y-m-d H:i:s')}}</i>
          </td>
        </tr>
      </tbody>
    </table>
  </footer>
</body>
</html>