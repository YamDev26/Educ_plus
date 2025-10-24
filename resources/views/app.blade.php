
<!DOCTYPE html>
<html data-bs-theme="light" lang="fr-FR" dir="ltr">
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }} | @yield('title')</title>
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

  <!-- Theme Config Js -->
  <script src="{{ asset('assets/js/config.js') }}"></script>
  <link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style">
  <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css">
</head>
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
</head>

<body>
  @include('includes._loader')
  <div class="wrapper">

    <!-- Menu Start -->
    @include('includes._navbar')

    <!-- Topbar Start -->
    @include('includes._header')

    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content bg-transparent">
            <div class="card mb-0 shadow-none">
              <div class="px-3 py-2 d-flex flex-row align-items-center" id="top-search">
                <i class="ti ti-search fs-22"></i>
                <input type="search" class="form-control border-0" id="search-modal-input" placeholder="Search for actions, people,">
                <button type="button" class="btn p-0" data-bs-dismiss="modal" aria-label="Close">[esc]</button>
              </div>
            </div>
          </div>
      </div>
    </div>

    <div class="page-content">
      @yield('content')

      <!-- Footer Start -->
      <footer class="footer">
        <div class="page-container">
          <div class="row">
            <div class="col-md-6 text-center text-md-start">
              <script>document.write(new Date().getFullYear())</script> © Boron - By <span class="fw-bold text-decoration-underline text-uppercase text-reset fs-12">Coderthemes</span>
            </div>
            <div class="col-md-6">
              <div class="text-md-end footer-links d-none d-md-block">
                <a href="javascript: void(0);">About</a>
                <a href="javascript: void(0);">Support</a>
                <a href="javascript: void(0);">Contact Us</a>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>

  </div>

  <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script>
    window.addEventListener('load', function () {
      const loader = document.getElementById('loader');
      loader.classList.add('fade-out');
      document.body.classList.remove('loading'); // réactive le scroll
      setTimeout(() => loader.remove(), 500); // supprime après fondu
    });
  </script>
  @yield('script')
</body>
</html>