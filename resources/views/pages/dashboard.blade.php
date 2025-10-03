
@extends('app')
@section('title', 'dashboard')
@section('content')
  <div class="row mb-3">
    <div class="col">
      <div class="card bg-100 shadow-none border">
        <div class="row gx-0 flex-between-center">
          <div class="col-sm-auto d-flex align-items-center"><img class="ms-n2" src="{{ asset('assets/img/illustrations/crm-bar-chart.png') }}" alt="" width="90">
            <div>
              <h6 class="text-primary fs-10 mb-0">Welcome to </h6>
              <h4 class="text-primary fw-bold mb-0">Falcon <span class="text-info fw-medium">CRM</span></h4>
            </div><img class="ms-n4 d-md-none d-lg-block" src="{{ asset('assets/img/illustrations/crm-line-chart.png') }}" alt="" width="150">
          </div>
          <div class="col-md-auto p-3">
            <form class="row align-items-center g-3">
              <div class="col-auto">
                <h6 class="text-700 mb-0">Showing Data For: </h6>
              </div>
              <div class="col-md-auto position-relative"><input class="form-control form-control-sm datetimepicker ps-4 flatpickr-input" id="CRMDateRange" type="text" data-options="{&quot;mode&quot;:&quot;range&quot;,&quot;dateFormat&quot;:&quot;M d&quot;,&quot;disableMobile&quot;:true , &quot;defaultDate&quot;: [&quot;Aug 24&quot;, &quot;Aug 31&quot;] }" readonly="readonly"><svg class="svg-inline--fa fa-calendar-alt fa-w-14 text-primary position-absolute top-50 translate-middle-y ms-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path></svg><!-- <span class="fas fa-calendar-alt text-primary position-absolute top-50 translate-middle-y ms-2"> </span> Font Awesome fontawesome.com --></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
