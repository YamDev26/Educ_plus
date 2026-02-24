@extends('app')
@section('title', 'dashboard')
@section('content')
  <div class="page-content">
    @include('partials._alert')
    <div class="card shadow-none bg-transparent border-bottom border-2">
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-md-4">
            @if ($cutting)
              <table class="table my-0" title="{{ nombre($nombre).' Jrs' }}" style="border-bottom: 2px solid {{ $nombre > 15 ? 'rgb(60, 175, 60)':'rgb(193, 44, 44)' }} ">
                <tbody>
                  <tr style="font-size: 17px">
                    <th class="p-0 text-left">{{ strtoupper($cutting->cutting->libelle) }}</th>
                    <th class="p-0 text-center">{{ date('d/m/Y', strtotime($cutting->start)) }}</th>
                    <th class="p-0 text-end">{{ date('d/m/Y', strtotime($cutting->end)) }}</th>
                  </tr>
                </tbody>
              </table>
            @else
              
            @endif
          </div>
          <div class="col-md-5">
            
          </div>
          <div class="col-md-3">
            <h6 class="text-end" style="font-size: 17px;">Date : {{ date('d/m/Y') }}</h6>
          </div>
        </div>
      </div>
    </div>
    <div class="card shadow-none bg-transparent mt-0 pt-0">
      <div class="card-body mt-0 pt-0">
        {{-- <div id="chart1"></div> --}}
        <p class="mb-2 mt-0" style="float: right; border: none; border-radius: 3px">
          Emploi du temps
        </p>
        <table class="table table-striped table-bordered" style="border: 1px solid grey">
          <thead>
            <tr class="table-dark" style="border: 1px solid grey">
              <th class="text-center" scope="col" style="border-right: 1px solid grey"></th>
              @foreach ($days as $day)
                <th class="text-center" scope="col" style="width: 17%; border-right: 1px solid grey">{{ ucfirst($day->libelle) }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach ($times['time1'] as $time)
              <tr class="tableBasique">
                <td class="text-center">{{ $time->debut }}</td>
                <td class="text-center">
                  
                </td>
                <td class="text-center">
                  
                </td>
                <td class="text-center">
                  
                </td>
                <td class="text-center">
                  
                </td>
                <td class="text-center">
                  
                </td>
              </tr>
            @endforeach
            <tr>
              <td colspan="7" class="text-center">
                <div class="d-flex justify-content-around">
                  <span>Après Midi</span>
                  <span>Après Midi</span>
                </div>
              </td>
            </tr>
            @foreach ($times['time2'] as $time)
              <tr class="tableBasique">
                <td class="text-center">{{ $time->debut }}</td>
                <td class="text-center">
                  
                </td>
                <td class="text-center">
                  
                </td>
                <td class="text-center">
                  
                </td>
                <td class="text-center">
                  
                </td>
                <td class="text-center">
                  
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
      {{-- <div class="col">
        <div class="card radius-10">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div>
                <p class="mb-0">Total Users</p>
                <h5 class="mb-0">85,028</h5>
              </div>
              <div class="dropdown ms-auto">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22 text-white'></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a>
                  </li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a>
                  </li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="" id="chart2"></div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card radius-10">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div>
                <p class="mb-0">Page Views</p>
                <h5 class="mb-0">42,892</h5>
              </div>
              <div class="dropdown ms-auto">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22 text-white'></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a>
                  </li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a>
                  </li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="" id="chart3"></div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card radius-10">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div>
                <p class="mb-0">Avg. Session Duration</p>
                <h5 class="mb-0">00:03:20</h5>
              </div>
              <div class="dropdown ms-auto">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22 text-white'></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a>
                  </li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a>
                  </li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="" id="chart4"></div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card radius-10">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div>
                <p class="mb-0">Bounce Rate</p>
                <h5 class="mb-0">51.46%</h5>
              </div>
              <div class="dropdown ms-auto">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">	<i class='bx bx-dots-horizontal-rounded font-22 text-white'></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="javascript:;">Action</a>
                  </li>
                  <li><a class="dropdown-item" href="javascript:;">Another action</a>
                  </li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="" id="chart5"></div>
          </div>
        </div>
      </div> --}}
    </div>
    <!--end row-->
  </div>
@endsection
@section('script')
<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('assets/plugins/highcharts/js/highcharts.js') }}"></script>
<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/index2.js') }}"></script>
<script>
  new PerfectScrollbar('.dashboard-top-countries');
</script>
@endsection