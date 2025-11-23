@extends('app')
@section('title', 'Student Index')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-12">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-1 mb-0">
                    <h5 class="mb-0">Gestion Des Elèves</h5>
                    <span style="float: right; ">
                        <a href="{{ route('student.create') }}" class="btn btn-outline-light py-1 mb-1" style="font-size: 12px; border-radius: 2px">Add</a>
                        <a href="{{ route('classe.index') }}" class="btn btn-outline-light py-1 mb-1" style="font-size: 12px; border-radius: 2px">Back</a>
                    </span>
                </div>
                <div class="card-body">
                    <div class="table-responsive mt-4">
                        <table class="table table-striped table-bordered" id="Transaction-History">
                           <thead>
                                <tr class="table-dark">
                                    <th style="width: 5%"></th>
                                    <th style="width: 30%">Nom & Prénoms</th>
                                    <th style="width: 25%">Date et lieu de naissance</th>
                                    <th style="width: 25%">Parent</th>
                                    <th style="width: 15%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($students as $item)
                                <tr>
                                    <th class="text-center py-3">
                                        <p class="mb-0 font-13 pt-2">01</p>
                                    </th>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="">
                                                <img src="{{ asset('assets/images/avatars/avatar-1.png') }}" class="rounded-circle" width="46" height="46" alt="" />
                                            </div>
                                            <div class="ms-2">
                                                <h6 class="mb-1 font-14">{{ strtoupper($item['first_name']).' '.ucwords($item['last_name']) }}</h6>
                                                <p class="mb-0 font-13">{{ $item['genre'] == 'F' ? 'Feminin':'Masculin' }} - {{ $item['matricule'] }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="ms-2 pt-1">
                                            <h6 class="mb-1 font-14">Né{{ $item['genre'] == 'F' ? 'e':'' }} le {{ date('d/m/Y', strtotime($item['date_naiss'])) }}</h6>
                                            <p class="mb-0 font-13">à {{ ucwords($item['lieu_naiss']) }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="ms-2 pt-1">
                                            <h6 class="mb-1 font-14">{{ strtoupper($item['parent_std']['first']).' '.ucwords($item['parent_std']['last']) }}</h6>
                                            <p class="mb-0 font-13">{{ $item['parent_std']['phon1'] }}{{ $item['parent_std']['phon2'] ? ' / '.$item['parent_std']['phon2']:null }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center py-2">
                                        <div class="d-flex justify-content-center order-actions pt-1">
                                            <button class="mx-1 p-1" title="Detail"><i class="bx bx-show-alt" style="font-size: 15px"></i></button>
                                            <button class="mx-1 p-1" title="Edit"><i class="bx bx-edit" style="font-size: 15px"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
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