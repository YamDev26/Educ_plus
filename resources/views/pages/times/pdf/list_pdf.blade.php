<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Emploi du tems {{ $classe->libelle }}</title>
</head>
<style type="text/css">
  @page {
      margin: 1.5cm 2cm 1.5cm 2cm; /* haut droite bas gauche */
  }
  body {
    margin: 0cm;
    padding: 0cm;
    font-family: sans-serif;
    font-size: 12px
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
    top: -20px;
    text-align: center;
    font-size: 15px;
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
  <div class="watermark">{{ ucwords('Emploi du temps') }}</div>
  <header id="header">
    <i style="text-align: center;font-size: 11px; margin:0%">REPUBLIQUEDE COTE D'IVOIRE</i>
    <i style="text-align: right; float:right; font-size: 11px; margin:0%">Union - Discipline - Travail</i>
    <i style="text-align: right; float:left; font-size: 11px; margin:0%">Année Scolaire : <strong>{{ $classe->schoolYear->libelle }}</strong></i>
  </header>

  <section style="padding: 0%; margin-top: 5%">
    <div style="width: 100%; height: 17px; text-align: center; margin-top: 20px; margin-bottom: 30px">
      <span style="font-size: 17px; text-decoration: underline; font-weight: 700;"> EMPLOI DU TEMPS {{ strtoupper($classe->libelle) }}</span>
    </div>

    <div style="width: 100%; margin-top: 5%">
      <table border="2" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%; margin: 10px auto; border: 1px solid black;">
        <thead>
          <tr>
            <th scope="col" style="font-size: 15px;">Horaire</th>
            @foreach ($days as $day)
            <th style="width: 17%; text-align: center; font-size: 15px;">{{ucfirst($day->libelle) }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @if (sizeof($dts_1) || sizeof($dts_1))
            @foreach ($times['time1'] as $time)
                <tr class="tableBasique">
                    <td style="text-align: center; font-size: 14px">{{ $time->debut }}</td>
                    <td style="text-align: center; font-size: 14px">
                        {{ indexMatter($time->id.'_1_1', $dts_1, $classe->lv2, $classe->autre) }}
                    </td>
                    <td style="text-align: center; font-size: 14px">
                        {{ indexMatter($time->id.'_2_1', $dts_1, $classe->lv2, $classe->autre) }}
                    </td>
                    <td style="text-align: center; font-size: 14px">
                        {{ indexMatter($time->id.'_3_1', $dts_1, $classe->lv2, $classe->autre) }}
                    </td>
                    <td style="text-align: center; font-size: 14px">
                        {{ indexMatter($time->id.'_4_1', $dts_1, $classe->lv2, $classe->autre) }}
                    </td>
                    <td style="text-align: center; font-size: 14px">
                        {{ indexMatter($time->id.'_5_1', $dts_1, $classe->lv2, $classe->autre) }}
                    </td>
                </tr>
            @endforeach
            <tr>
              <th colspan="6" class="text-center">
                <div class="d-flex justify-content-around">
                  <span>Après Midi</span>
                </div>
              </th>
            </tr>
            @foreach ($times['time2'] as $time)
                <tr class="tableBasique">
                    <td style="text-align: center; font-size: 14px">{{ $time->debut }}</td>
                    <td style="text-align: center; font-size: 14px">
                      {{ indexMatter($time->id.'_1_2', $dts_2, $classe->lv2, $classe->autre) }}
                    </td>
                    <td style="text-align: center; font-size: 14px">
                      {{ indexMatter($time->id.'_2_2', $dts_2, $classe->lv2, $classe->autre) }}
                    </td>
                    <td style="text-align: center; font-size: 14px">
                      {{ indexMatter($time->id.'_3_2', $dts_2, $classe->lv2, $classe->autre) }}
                    </td>
                    <td style="text-align: center; font-size: 14px">
                      {{ indexMatter($time->id.'_4_2', $dts_2, $classe->lv2, $classe->autre) }}
                    </td>
                    <td style="text-align: center; font-size: 14px">
                      {{ indexMatter($time->id.'_5_2', $dts_2, $classe->lv2, $classe->autre) }}
                    </td>
                </tr>
            @endforeach
          @else
            <tr>
              <td colspan="6" style="text-align: center; font-size: 14px">
                <div class="my-2">
                  Emploi du temps non défini
                </div>
              </td>
            </tr>
          @endif
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