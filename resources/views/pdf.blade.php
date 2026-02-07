<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
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
        top: -20px;
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
    <div class="watermark">@yield('font')</div>
    <header id="header">
        <i style="text-align: center;font-size: 11px; margin:0%">REPUBLIQUEDE COTE D'IVOIRE</i>
        <i style="text-align: right; float:right; font-size: 11px; margin:0%">Union - Discipline - Travail</i>
        <i style="text-align: right; float:left; font-size: 11px; margin:0%">Année Scolaire : <strong>@yield('year')</strong></i>
    </header>

    <section style="padding: 0%; margin-top: 5%">
        @yield("content")
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