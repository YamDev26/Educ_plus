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
    font-size: 12px
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

  #head{
    position: relative;
    width: 100%;
    top: 20px;
    border-bottom: 3px solid grey;
    border-radius: 10px;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    height: 90px;
    background: #eee;
    padding-top: 0px;
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
    <header id="head">
      <table>
      <tbody>
        <tr style="width: 100%;">
          <td style="width: 10%; height: 80px; padding: 3px">
            <img src="{{ public_path('storage/' . $school->logo) }}" class="m-b-10" alt="Logo établissement" style="width: 80px; height: 80px;">
          </td>
          <td style="width: 470px; height: 80px; border: 2px solid grey; border-radius: 5px; text-align: center; font-size: 13px; padding: 3px">
            <table style="width: 100%; text-align: center">
              <tbody>
                <tr style="text-align: center">
                  <td style="text-align: center; font-size: 12px">REPUBLIQUEDE COTE D'IVOIRE</td>
                </tr>
                <tr style="text-align: center">
                  <td style="text-align: center">
                    Ministère de l'Education Nationale et de l'Alphabétisation
                  </td>
                </tr>
                <tr>
                  <td style="text-align: center; width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; padding-top: 4%">
                    <strong style="text-transform: uppercase; margin-top: 3px;">{{$school->name}}</strong>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
          <td style="width: 460px; height: 80px; border: 2px solid grey; border-radius: 5px; font-size: 13px;  padding: 3px;">
            <table style="width: 100%;">
              <tbody>
                <tr>
                  <td style="width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <span>Adresse : <strong>{{$school->postal}}</strong></span>
                  </td>
                  <td style="width: 100px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <span>Code : <b>{{$school->code}}</b></span>
                  </td>
                </tr>
                <tr>
                  <td style="width: 200px; padding-top: 5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <span>Telephone : <strong>{{$school->numero}}</strong></span>
                  </td>
                  <td style="width: 100px; padding-top: 5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    <span>Statut : <strong>{{ ucwords($school->statut) }}</strong></span>
                  </td>
                </tr>
                <tr style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                  <td colspan="2" style="padding-top: 5px;">Email : <strong>{{$school->email}}</strong></td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
      </table>
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