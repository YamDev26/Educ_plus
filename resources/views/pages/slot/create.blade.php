
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
                    <a href="{{ route('slot.index') }}" class="btn btn-outline-light py-1 mb-1" style="float: right; font-size: 12px; border-radius: 2px">Back</a>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive mt-0">
                        <form action="{{ route(count($morning) ? 'slot.update':'slot.store') }}" method="post" class="w-100">
                            @csrf
                            <div class="card">
                                <div class="d-flex flex-between-center flex-wrap gap-2 pt-3 pb-0 mb-0">
                                    <div class="col-ms-6 card-body pt-1 px-5" style="border-right: 1px solid grey;">
                                        <Strong style="font-size: 19px; mt-1"> Heure Matinnée</Strong>
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
                                        <Strong style="font-size: 19px"> Heure Après Midi</Strong>
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
                                    <button type="submit" class="btn btn-dark px-5" style="border-radius: 2px; border: 1px solid rgb(91, 88, 88)">Validation</button>
                                </div>
                            </div>
                        </form>
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