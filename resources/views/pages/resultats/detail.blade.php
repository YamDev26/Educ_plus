@extends('app')
@section('title', 'Resultat '.ucwords($cutting->cutting->libelle))
@section('link')
<style></style>
@endsection
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-12">
            @include('partials._alert')
            <div class="card">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-0 mb-0" style="border: none">
                    <h5 class="mb-0">Statistiques - {{ ucwords($cutting->cutting->libelle) }}</h5>
                    <h5 class="mb-0">{{ $classe->libelle }}</h5>
                    <span class="d-flex" style="float: right;">
                      <a href="{{ route('resultat.result',$classe->id.'_'.$cutting->id) }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Edit Info" style="border: none; border-radius: 3px">
                        <i class="lni lni-list m-0" style="font-size: 17px"></i>
                      </a>
                      <a href="{{ route('resultat.index') }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                        <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                      </a>
                    </span>
                </div>
                <hr class="mt-0 mb-3 mx-3">
                <div class="row g-0 mt-3" style="border-top: 1px solid red; border-radius: 5px">
                    <div class="col-md-4 border-end text-center">
                      <div class="px-3">
                        <div class="mt-2" id="chart20"></div>
                        <hr class="mx-2">
                        <div class="d-flex align-items-center justify-content-between text-center">
                          <div>
                            <h6 class="mb-1 font-weight-bold">$289.42</h6>
                            <p class="mb-0">Last Week</p>
                          </div>
                          <div class="mb-1">
                            <h6 class="mb-1 font-weight-bold">$856.14</h6>
                            <p class="mb-0">Last Month</p>
                          </div>
                          <div>
                            <h6 class="mb-1 font-weight-bold">$987,25</h6>
                            <p class="mb-0">Last Year</p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="card-title text-center mt-3 mb-3">
                                <h4 class="mb-0">{{ ucfirst(appreciationClasse($resultat['moyenne'])) }}</h4>
                            </div>
                            <hr class="my-0 mx-3">
                            <div class="my-4 d-flex justify-content-between mx-lg-3"> 
                                <table class="table table-bordered mt-2">
                                  <thead>
                                    <tr>
                                      <th></th>
                                      <th class="text-center">Moy < 10</th>
                                      <th class="text-center">Moy ≥ 10 </th>
                                      <th class="text-center">Pourcentage</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                      <th>Filles</th>
                                      <th class="text-center">{{ nombre($resultat['nbre_non_moyenne_feminin']).' ≃ '. $resultat['taux_echec_feminin'].'%' }}</th>
                                      <th class="text-center">{{ nombre($resultat['nbre_moyenne_feminin']).' ≃ '. $resultat['taux_reussite_feminin'].'%' }}</th>
                                      <th class="text-center">{{ $resultat['taux_feminin'].'%' }}</th>
                                    </tr>
                                    <tr>
                                      <th>Garçons</th>
                                      <th class="text-center">{{ nombre($resultat['nbre_non_moyenne_masculin']).' ≃ '. $resultat['taux_echec_masculin'].'%' }}</th>
                                      <th class="text-center">{{ nombre($resultat['nbre_moyenne_masculin']).' ≃ '. $resultat['taux_reussite_masculin'].'%' }}</th>
                                      <th class="text-center">{{ $resultat['taux_masculin'].'%' }}</th>
                                    </tr>
                                    <tr>
                                      <th>Total</th>
                                      <th class="text-center">{{ nombre($resultat['nbre_non_moyenne']).' ≃ '. $resultat['taux_echec'].'%' }}</th>
                                      <th class="text-center">{{ nombre($resultat['nbre_moyenne']).' ≃ '. $resultat['taux_reussite'].'%' }}</th>
                                      <th class="text-center">{{ '100%' }}</th>
                                    </tr>
                                  </tbody>
                                </table>
                            </div>
                            <hr class="mx-3 mt-1">
                            <div class="mx-3 d-flex align-items-center justify-content-between text-center">
                              <div>
                                <h6 class="mb-1 font-weight-bold">$289.42</h6>
                                <p class="mb-0">Moyenne min</p>
                              </div>
                              <div class="mb-1">
                                <h6 class="mb-1 font-weight-bold">$856.14</h6>
                                <p class="mb-0">Moyenne max</p>
                              </div>
                              <div>
                                <h6 class="mb-1 font-weight-bold">$987,25</h6>
                                <p class="mb-0">Prof Principal</p>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mx-3 mb-3">
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
  <script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/js/index.js') }}"></script>
  <script>
      new PerfectScrollbar('.product-list');
      new PerfectScrollbar('.customers-list');

      $(document).ready(function(){
          
      })
  </script>
@endsection