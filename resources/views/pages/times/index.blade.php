@extends('app')
@section('title', 'Time Table '.$classe->libelle)
@section('link')
<style>
  
</style>
@endsection
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-12">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-1 mb-0">
                    <h5 class="mb-0">Emploi du temps</h5>
                    <h5>{{ $classe->libelle }}</h5>
                    <span style="float: right;">
                      <a href="#" class="btn btn-outline-light py-0 px-2 mb-1" title="Teacher Classe" style="border: none; border-radius: 3px">
                        <i class="lni lni-user m-0" style="font-size: 17px"></i>
                      </a>
                      <a href="{{ route('time.create', $classe->id) }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Add Time Table" style="border: none; border-radius: 3px">
                        <i class="bx bx-edit m-0" style="font-size: 17px"></i>
                      </a>
                      <a href="{{ route('teacher.index') }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                        <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                      </a>
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-bordered" style="border: 1px solid white">
                            <thead>
                                <tr class="table-dark" style="border: 1px solid white">
                                    <th class="text-center" scope="col" style="border-right: 1px solid white"></th>
                                    @foreach ($days as $day)
                                      <th class="text-center" scope="col" style="width: 17%; border-right: 1px solid white">{{ ucfirst($day->libelle) }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {

      

    });
</script>
@endsection