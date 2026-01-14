
@extends('app')
@section('title', 'Create Slot Time')
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-12 px-lg-2">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-2 mb-0">
                    <h5 class="dark__bg-1100 pe-3">{{ count($morning) ? 'Edit':'New' }} Slot Time</h5>
                    <a href="{{ route('slot.index') }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                        <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                    </a>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive mt-0">
                        <form action="{{ route(count($morning) ? 'slot.update':'slot.store') }}" method="post" class="w-100">
                            @csrf
                            <div class="d-flex flex-between-center flex-wrap gap-2 pt-3 pb-0 mb-0">
                                <div class="col-ms-6 card-body pt-1 px-5" style="border-right: 1px solid grey;">
                                    <Strong style="font-size: 19px; mt-1"> Matin</Strong>
                                    <hr class="mx-1 mt-1 w-75">
                                    @php $i = 1; @endphp
                                    @for ($i = 1; $i <= $nbre; $i++)
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="heure1">Heure {{ $i }} :</label>
                                        <table class="w-100 mx-3">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="form-label" for="morningD{{ $i }}">Debut :</label>
                                                        <input type="time" name="martin1[]" class="form-control w-75" id="morningD{{ $i }}" value="{{ count($morning) ?(count($morning) >= $i ? $morning[$i-1]['debut']:null):null }}">
                                                    </td>
                                                    <td>
                                                        <label class="form-label" for="morningF{{ $i }}">Fin :</label>
                                                        <input type="time" name="martin2[]" class="form-control w-75" id="morningF{{ $i }}" value="{{ count($morning) ? (count($morning) >= $i ? $morning[$i-1]['fin']:null):null }}">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @endfor
                                </div>
                                <div class="col-ms-6 card-body px-5 pt-1 ml-0">
                                    <Strong style="font-size: 19px">Après Midi</Strong>
                                    <hr class="mx-1 mt-1 w-75">
                                    @for ($i = 1; $i <= $nbre; $i++)
                                    <div class="form-group mb-2">
                                        <label class="form-label" for="heure1">Heure {{ $i }} :</label>
                                        <table class="w-100 mx-3">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="form-label" for="afterD{{ $i }}">Debut :</label>
                                                        <input type="time" name="after1[]" class="form-control w-75" id="afterD{{ $i }}" value="{{ count($after) ? (count($after) >= $i ? $after[$i-1]['debut']:null):null }}">
                                                    </td>
                                                    <td>
                                                        <label class="form-label" for="afterF{{ $i }}">Fin :</label>
                                                        <input type="time" name="after2[]" class="form-control w-75" id="afterF{{ $i }}" value="{{ count($after) ? (count($after) >= $i ? $after[$i-1]['fin']:null):null }}">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                            <hr class="mt-0">
                            <div class="text-center my-3">
                                <button class="btn btn-dark w-25" id="btnValid">Confirm ...</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection