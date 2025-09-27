
<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} | @yield('title')</title>

  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">

  <link href="{{ asset('vendors/leaflet/leaflet.css') }}" rel="stylesheet">
  <link href="{{ asset('vendors/leaflet.markercluster/MarkerCluster.css') }}" rel="stylesheet">
  <link href="{{ asset('vendors/leaflet.markercluster/MarkerCluster.Default.css') }}" rel="stylesheet">
  <link href="{{ asset('vendors/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com/">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
  <link href="{{ asset('vendors/simplebar/simplebar.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/theme-rtl.min.css') }}" rel="stylesheet" id="style-rtl">
  <link href="{{ asset('assets/css/theme.min.css') }}" rel="stylesheet" id="style-default">
  <link href="{{ asset('assets/css/user-rtl.min.css') }}" rel="stylesheet" id="user-style-rtl">
  <link href="{{ asset('assets/css/user.min.css') }}" rel="stylesheet" id="user-style-default">
  <style>
    /* Style du loader */
    #loader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgb(18, 32, 37);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      transition: opacity 0.5s ease-out;
    }

    #loader.fade-out {
      opacity: 0;
      pointer-events: none;
    }

    body.loading {
      overflow: hidden;
    }
  </style>
  <script>
    var isRTL = JSON.parse(localStorage.getItem('isRTL'));
    if (isRTL) {
      var linkDefault = document.getElementById('style-default');
      var userLinkDefault = document.getElementById('user-style-default');
      linkDefault.setAttribute('disabled', true);
      userLinkDefault.setAttribute('disabled', true);
      document.querySelector('html').setAttribute('dir', 'rtl');
    } else {
      var linkRTL = document.getElementById('style-rtl');
      var userLinkRTL = document.getElementById('user-style-rtl');
      linkRTL.setAttribute('disabled', true);
      userLinkRTL.setAttribute('disabled', true);
    }
  </script>
</head>

<body class="loading">

  @include('includes._loader')

  <main class="main" id="top">
    <div class="container" data-layout="container">
      <script>
        var isFluid = JSON.parse(localStorage.getItem('isFluid'));
        if (isFluid) {
          var container = document.querySelector('[data-layout]');
          container.classList.remove('container');
          container.classList.add('container-fluid');
        }
      </script>
      @include('includes._navbar')

      <!-- Header -->
      <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;"></nav>

      
      <div class="content">
        
        @include('includes._header')

        <!-- Nav Bar -->
        <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;" data-move-target="#navbarVerticalNav" data-navbar-top="combo"></nav>


        <script>
          var navbarPosition = localStorage.getItem('navbarPosition');
          var navbarVertical = document.querySelector('.navbar-vertical');
          var navbarTopVertical = document.querySelector('.content .navbar-top');
          var navbarTop = document.querySelector('[data-layout] .navbar-top:not([data-double-top-nav');
          var navbarDoubleTop = document.querySelector('[data-double-top-nav]');
          var navbarTopCombo = document.querySelector('.content [data-navbar-top="combo"]');

          if (localStorage.getItem('navbarPosition') === 'double-top') {
            document.documentElement.classList.toggle('double-top-nav-layout');
          }

          if (navbarPosition === 'top') {
            navbarTop.removeAttribute('style');
            navbarTopVertical.remove(navbarTopVertical);
            navbarVertical.remove(navbarVertical);
            navbarTopCombo.remove(navbarTopCombo);
            navbarDoubleTop.remove(navbarDoubleTop);
          } else if (navbarPosition === 'combo') {
            navbarVertical.removeAttribute('style');
            navbarTopCombo.removeAttribute('style');
            navbarTop.remove(navbarTop);
            navbarTopVertical.remove(navbarTopVertical);
            navbarDoubleTop.remove(navbarDoubleTop);
          } else if (navbarPosition === 'double-top') {
            navbarDoubleTop.removeAttribute('style');
            navbarTopVertical.remove(navbarTopVertical);
            navbarVertical.remove(navbarVertical);
            navbarTop.remove(navbarTop);
            navbarTopCombo.remove(navbarTopCombo);
          } else {
            navbarVertical.removeAttribute('style');
            navbarTopVertical.removeAttribute('style');
            navbarTop.remove(navbarTop);
            navbarDoubleTop.remove(navbarDoubleTop);
            navbarTopCombo.remove(navbarTopCombo);
          }
        </script>

        @include('includes._alert')
        <!-- Contenu des pages -->
        @yield('content')

        <!-- Footer -->
        @include('includes._footer')
      </div>
      
    </div>
  </main>

  <script src="{{ asset('vendors/popper/popper.min.js') }}"></script>
  <script src="{{ asset('vendors/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{ asset('vendors/anchorjs/anchor.min.js') }}"></script>
  <script src="{{ asset('vendors/is/is.min.js') }}"></script>
  <script src="{{ asset('vendors/chart/chart.umd.js') }}"></script>
  <script src="{{ asset('vendors/leaflet/leaflet.js') }}"></script>
  <script src="{{ asset('vendors/leaflet.markercluster/leaflet.markercluster.js') }}"></script>
  <script src="{{ asset('vendors/leaflet.tilelayer.colorfilter/leaflet-tilelayer-colorfilter.min.js') }}"></script>
  <script src="{{ asset('vendors/countup/countUp.umd.js') }}"></script>
  <script src="{{ asset('vendors/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/data/world.js') }}"></script>
  <script src="{{ asset('vendors/dayjs/dayjs.min.js') }}"></script>
  <script src="{{ asset('vendors/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('vendors/fontawesome/all.min.js') }}"></script>
  <script src="{{ asset('vendors/lodash/lodash.min.js') }}"></script>
  <script src="{{ asset('vendors/list.js/list.min.js') }}"></script>
  <script src="{{ asset('assets/js/theme.js') }}"></script>
  <script>
    window.addEventListener('load', function () {
      const loader = document.getElementById('loader');
      loader.classList.add('fade-out');
      document.body.classList.remove('loading'); // réactive le scroll
      setTimeout(() => loader.remove(), 500); // supprime après fondu
    });
  </script>
</body>
</html>