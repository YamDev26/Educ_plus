
@extends('app')
@section('title', 'dashboard')
@section('content')
  <div class="row mb-3">
    <div class="col">
      <div class="card bg-100 shadow-none border">
        <div class="row gx-0 flex-between-center">
          <div class="col-sm-auto d-flex align-items-center"><img class="ms-n2" src="{{ asset('assets/img/illustrations/crm-bar-chart.png') }}" alt="" width="90">
            <div>
              <h6 class="text-primary fs-10 mb-0">Année Scolaire</h6>
              <h4 class="text-primary fw-bold mb-0">2025-2026 <span class="text-info fw-medium"> | Trimestre 1</span></h4>
            </div>
            <img class="ms-n4 d-md-none d-lg-block" src="{{ asset('assets/img/illustrations/crm-line-chart.png') }}" alt="" width="150">
          </div>
          <div class="col-md-auto p-3">
            <form class="row align-items-center g-3">
              <div class="col-auto">
                <h6 class="text-700 mb-0">Showing Data For: </h6>
              </div>
              <div class="col-md-auto position-relative">
                <input class="form-control form-control-sm datetimepicker ps-4 flatpickr-input" id="CRMDateRange" type="text" data-options="" readonly="readonly" value="{{ date("d-m-Y") }}">
                <svg class="svg-inline--fa fa-calendar-alt fa-w-14 text-primary position-absolute top-50 translate-middle-y ms-2" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="calendar-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M0 464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V192H0v272zm320-196c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM192 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12h-40c-6.6 0-12-5.4-12-12v-40zM64 268c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zm0 128c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12H76c-6.6 0-12-5.4-12-12v-40zM400 64h-48V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H160V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48H48C21.5 64 0 85.5 0 112v48h448v-48c0-26.5-21.5-48-48-48z"></path></svg><!-- <span class="fas fa-calendar-alt text-primary position-absolute top-50 translate-middle-y ms-2"> </span> Font Awesome fontawesome.com --></div>
            </form>
          </div>
        </div>
      </div>

      <div class="card mb-3">
        <div class="card-body px-xxl-0 pt-1">
          <div class="row g-0">
            <div class="col-xxl-3 col-md-6 px-3 text-center border-end-md border-bottom border-bottom-xxl-0 pb-3 p-xxl-0 ps-md-0">
              <div class="icon-circle icon-circle-primary"><svg class="svg-inline--fa fa-user-graduate fa-w-14 fs-7 text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-graduate" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" data-fa-i2svg=""><path fill="currentColor" d="M319.4 320.6L224 416l-95.4-95.4C57.1 323.7 0 382.2 0 454.4v9.6c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-9.6c0-72.2-57.1-130.7-128.6-133.8zM13.6 79.8l6.4 1.5v58.4c-7 4.2-12 11.5-12 20.3 0 8.4 4.6 15.4 11.1 19.7L3.5 242c-1.7 6.9 2.1 14 7.6 14h41.8c5.5 0 9.3-7.1 7.6-14l-15.6-62.3C51.4 175.4 56 168.4 56 160c0-8.8-5-16.1-12-20.3V87.1l66 15.9c-8.6 17.2-14 36.4-14 57 0 70.7 57.3 128 128 128s128-57.3 128-128c0-20.6-5.3-39.8-14-57l96.3-23.2c18.2-4.4 18.2-27.1 0-31.5l-190.4-46c-13-3.1-26.7-3.1-39.7 0L13.6 48.2c-18.1 4.4-18.1 27.2 0 31.6z"></path></svg><!-- <span class="fs-7 fas fa-user-graduate text-primary"></span> Font Awesome fontawesome.com --></div>
              <h4 class="mb-1 font-sans-serif"><span class="text-700 mx-2" data-countup="{&quot;endValue&quot;:&quot;4968&quot;}">4,968</span><span class="fw-normal text-600">New Learners</span></h4>
              <p class="fs-10 fw-semi-bold mb-0">4203 <span class="text-600 fw-normal">last month</span></p>
            </div>
            <div class="col-xxl-3 col-md-6 px-3 text-center border-end-xxl border-bottom border-bottom-xxl-0 pb-3 pt-4 pt-md-0 pe-md-0 p-xxl-0">
              <div class="icon-circle icon-circle-info"><svg class="svg-inline--fa fa-chalkboard-teacher fa-w-20 fs-7 text-info" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chalkboard-teacher" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" data-fa-i2svg=""><path fill="currentColor" d="M208 352c-2.39 0-4.78.35-7.06 1.09C187.98 357.3 174.35 360 160 360c-14.35 0-27.98-2.7-40.95-6.91-2.28-.74-4.66-1.09-7.05-1.09C49.94 352-.33 402.48 0 464.62.14 490.88 21.73 512 48 512h224c26.27 0 47.86-21.12 48-47.38.33-62.14-49.94-112.62-112-112.62zm-48-32c53.02 0 96-42.98 96-96s-42.98-96-96-96-96 42.98-96 96 42.98 96 96 96zM592 0H208c-26.47 0-48 22.25-48 49.59V96c23.42 0 45.1 6.78 64 17.8V64h352v288h-64v-64H384v64h-76.24c19.1 16.69 33.12 38.73 39.69 64H592c26.47 0 48-22.25 48-49.59V49.59C640 22.25 618.47 0 592 0z"></path></svg><!-- <span class="fs-7 fas fa-chalkboard-teacher text-info"></span> Font Awesome fontawesome.com --></div>
              <h4 class="mb-1 font-sans-serif"><span class="text-700 mx-2" data-countup="{&quot;endValue&quot;:&quot;324&quot;}">324</span><span class="fw-normal text-600">New Trainers</span></h4>
              <p class="fs-10 fw-semi-bold mb-0">301 <span class="text-600 fw-normal">last month</span></p>
            </div>
            <div class="col-xxl-3 col-md-6 px-3 text-center border-end-md border-bottom border-bottom-md-0 pb-3 pt-4 p-xxl-0 pb-md-0 ps-md-0">
              <div class="icon-circle icon-circle-success"><svg class="svg-inline--fa fa-book-open fa-w-18 fs-7 text-success" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="book-open" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M542.22 32.05c-54.8 3.11-163.72 14.43-230.96 55.59-4.64 2.84-7.27 7.89-7.27 13.17v363.87c0 11.55 12.63 18.85 23.28 13.49 69.18-34.82 169.23-44.32 218.7-46.92 16.89-.89 30.02-14.43 30.02-30.66V62.75c.01-17.71-15.35-31.74-33.77-30.7zM264.73 87.64C197.5 46.48 88.58 35.17 33.78 32.05 15.36 31.01 0 45.04 0 62.75V400.6c0 16.24 13.13 29.78 30.02 30.66 49.49 2.6 149.59 12.11 218.77 46.95 10.62 5.35 23.21-1.94 23.21-13.46V100.63c0-5.29-2.62-10.14-7.27-12.99z"></path></svg><!-- <span class="fs-7 fas fa-book-open text-success"></span> Font Awesome fontawesome.com --></div>
              <h4 class="mb-1 font-sans-serif"><span class="text-700 mx-2" data-countup="{&quot;endValue&quot;:&quot;3712&quot;}">3,712</span><span class="fw-normal text-600">New Courses</span></h4>
              <p class="fs-10 fw-semi-bold mb-0">2779 <span class="text-600 fw-normal">last month</span></p>
            </div>
            <div class="col-xxl-3 col-md-6 px-3 text-center pt-4 p-xxl-0 pb-0 pe-md-0">
              <div class="icon-circle icon-circle-warning"><svg class="svg-inline--fa fa-dollar-sign fa-w-9 fs-7 text-warning" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="dollar-sign" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 288 512" data-fa-i2svg=""><path fill="currentColor" d="M209.2 233.4l-108-31.6C88.7 198.2 80 186.5 80 173.5c0-16.3 13.2-29.5 29.5-29.5h66.3c12.2 0 24.2 3.7 34.2 10.5 6.1 4.1 14.3 3.1 19.5-2l34.8-34c7.1-6.9 6.1-18.4-1.8-24.5C238 74.8 207.4 64.1 176 64V16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v48h-2.5C45.8 64-5.4 118.7.5 183.6c4.2 46.1 39.4 83.6 83.8 96.6l102.5 30c12.5 3.7 21.2 15.3 21.2 28.3 0 16.3-13.2 29.5-29.5 29.5h-66.3C100 368 88 364.3 78 357.5c-6.1-4.1-14.3-3.1-19.5 2l-34.8 34c-7.1 6.9-6.1 18.4 1.8 24.5 24.5 19.2 55.1 29.9 86.5 30v48c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-48.2c46.6-.9 90.3-28.6 105.7-72.7 21.5-61.6-14.6-124.8-72.5-141.7z"></path></svg><!-- <span class="fs-7 fas fa-dollar-sign text-warning"></span> Font Awesome fontawesome.com --></div>
              <h4 class="mb-1 font-sans-serif"><span class="text-700 mx-2" data-countup="{&quot;endValue&quot;:&quot;1054&quot;}">1,054</span><span class="fw-normal text-600">Refunds</span></h4>
              <p class="fs-10 fw-semi-bold mb-0">1201 <span class="text-600 fw-normal">last month</span></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
