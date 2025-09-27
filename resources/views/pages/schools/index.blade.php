@extends('app')
@section('title', 'school')
@section('content')
<div class="row g-3 mb-3">
    <div class="col-xl-12">
        <div class="row g-3">
            <div class="col-12">
                <div class="card bg-transparent-50 overflow-hidden pt-3">
                    <div class="card-header position-relative">
                        <div class="bg-holder d-none d-md-block bg-card z-1" style="background-image:url({{ asset('assets/img/illustrations/ecommerce-bg.png') }});background-size:230px;background-position:right bottom;z-index:-1;"></div>
                        <div class="position-relative z-2">
                            @if ($school)
                               <a href="{{ route('school.edit') }}" class="btn btn-falcon-default btn-sm mb-2" style="float: left">Edite</a> 
                            @else
                                <a href="{{ route('school.create') }}" class="btn btn-falcon-default btn-sm mb-2" style="float: left">create</a>
                            @endif
                            <div class="text-center">
                                <h3 class="text-primary mb-1">{{ ucwords($school['name']) }} {{ $school['abrege'] ? '('.strtoupper($school['abrege']).')':null }}</h3>
                                <p style="text-decoration: underline; font-weight: bold">Statut {{ ucwords($school['statut']) }}</p>
                            </div>
                            <div class="d-flex py-3">
                                <div class="pe-3">
                                    <p class="text-600 fs-10 my-1 fw-medium">Student</p>
                                    <h6 class="text-800">00 ..</h6>
                                </div>
                                <div class="ps-3">
                                    <p class="text-600 fs-10 my-1">Personnel</p>
                                    <h6 class="text-800 mb-0">00 ..</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <ul class="mb-0 list-unstyled list-group font-sans-serif">
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['code'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['code'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Code Etablissement</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['code'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>{{ $school['code'] }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['dren'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['dren'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>DREN / DDEN</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['dren'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>{{ ucwords($school['dren']) }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['ville'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['ville'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Ville</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['ville'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>{{ ucwords($school['ville']) }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['postale'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['postale'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Boîte Postale</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['postale'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>{{ ucwords($school['postale']) }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['email'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['email'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Adresse Email</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['email'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>{{ ucwords($school['postale']) }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['numero'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['numero'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Numéro Téléphone</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['numero'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>+225 {{ ucwords($school['numero']) }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['create'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['create'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Date Création</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['create'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>{{ date('d/m/Y', strtotime($school['create'])) }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['ouverture'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['ouverture'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Date Ouverture</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['ouverture'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>{{ date('d/m/Y', strtotime($school['ouverture'])) }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item mb-0 rounded-0 py-0 px-x1 list-group-item{{ $school['logo'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['logo'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Logo</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['logo'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    @if ($school['logo'])
                                                        <strong>Non Defini</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                    @else
                                                        <img class="m-0" src="{{ asset('assets/img/team/1-thumb.png') }}" alt="Logo Etablissement" style="width: 50px; height: 50px; border-radius: 5px">
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-sm-6">
                                <ul class="mb-0 list-unstyled list-group font-sans-serif">
                                    
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['classe'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['classe'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Nombre Salle Classe</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['classe'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>{{ $school['classe'] <= 9 ? '0'.$school['classe']:$school['classe'] }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['bibliotheque'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['bibliotheque'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Bibliothèque</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['bibliotheque'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>{{ $school['bibliotheque'] ? 'Oui':'Non' }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['phis_chim'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['phis_chim'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Labarotoire Physique Chimie</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['phis_chim'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>{{ $school['phis_chim'] ? 'Oui':'Non' }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['svt'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['svt'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Labarotoire SVT</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['svt'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>{{ $school['svt'] ? 'Oui':'Non' }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['informatique'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['informatique'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Salle Informatique</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['informatique'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>{{ $school['informatique'] ? 'Oui':'Non' }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['infirmerie'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['infirmerie'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Infirmerie</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['infirmerie'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>{{ $school['infirmerie'] ? 'Oui':'Non' }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['cantine'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['cantine'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Cantine Elève</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['cantine'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>{{ $school['cantine'] ? 'Oui':'Non' }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['bus'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['bus'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Bus Elève</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['bus'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>{{ $school['bus'] ? 'Oui':'Non' }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item mb-0 rounded-0 py-3 px-x1 list-group-item{{ $school['caisse'] ? '':'-warning' }} border-x-0 border-top-0">
                                        <div class="row flex-between-center">
                                            <div class="col">
                                                <div class="d-flex">
                                                    <svg class="svg-inline--fa fa-circle fa-w-16 mt-1 fs-11 {{ $school['caisse'] ? 'text-primary':'' }}" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                                    </svg>
                                                    <p class="fs-10 ps-2 mb-0">
                                                        <strong>Gestion Caisse</strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-auto d-flex align-items-center">
                                                <a class="fs-10 fw-medium {{ $school['caisse'] ? '':'text-warning-emphasis' }}" href="#!">
                                                    <strong>{{ $school['caisse'] ? 'Oui':'Non' }}</strong>
                                                    <svg class="svg-inline--fa fa-chevron-right fa-w-10 ms-1 fs-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg="">
                                                        <path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection