
@extends('app')
@section('title', 'create slot time')
@section('content')
<div class="row g-3">
    <div class="col-12">
        <div class="card" id="TableCrmRecentLeads" data-list="{&quot;valueNames&quot;:[&quot;name&quot;,&quot;email&quot;,&quot;status&quot;],&quot;page&quot;:8,&quot;pagination&quot;:true}">
            <div class="card-header bg-body-tertiary pt-3 pb-2">
                <!-- <h5 class="mb-0">Add Discipline 6eme</h5> -->
                <div class="d-flex mb-0">
                    <span class="fa-stack me-2 ms-n1">
                        <svg class="svg-inline--fa fa-circle fa-w-16 fa-stack-2x text-300" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                        </svg>
                        <svg class="svg-inline--fa fa-tasks fa-w-16 fa-inverse fa-stack-1x text-primary" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="tasks" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                            <path fill="currentColor" d="M139.61 35.5a12 12 0 0 0-17 0L58.93 98.81l-22.7-22.12a12 12 0 0 0-17 0L3.53 92.41a12 12 0 0 0 0 17l47.59 47.4a12.78 12.78 0 0 0 17.61 0l15.59-15.62L156.52 69a12.09 12.09 0 0 0 .09-17zm0 159.19a12 12 0 0 0-17 0l-63.68 63.72-22.7-22.1a12 12 0 0 0-17 0L3.53 252a12 12 0 0 0 0 17L51 316.5a12.77 12.77 0 0 0 17.6 0l15.7-15.69 72.2-72.22a12 12 0 0 0 .09-16.9zM64 368c-26.49 0-48.59 21.5-48.59 48S37.53 464 64 464a48 48 0 0 0 0-96zm432 16H208a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h288a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16zm0-320H208a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h288a16 16 0 0 0 16-16V80a16 16 0 0 0-16-16zm0 160H208a16 16 0 0 0-16 16v32a16 16 0 0 0 16 16h288a16 16 0 0 0 16-16v-32a16 16 0 0 0-16-16z"></path>
                        </svg>
                    </span>
                    <div class="col">
                        <h5 class="mb-0 text-primary position-relative">
                            <span class="dark__bg-1100 pe-3">New Slot Time</span>
                            <a href="{{ route('slot.index') }}" class="btn btn-falcon-default btn-sm mb-2" style="float: right">Back</a>
                        </h5>
                    </div>
                </div>
            </div>
            <hr class="mt-0 mb-2 mx-3">
            <div class="card-body">
                <div class="table-responsive scrollbar">
                    <form action="{{ route('slot.store') }}" method="post" class="w-100">
                        @csrf
                        <div class="card">
                            <div class="d-flex flex-between-center flex-wrap gap-2 pt-3 pb-0 mb-0">
                                <div class="col-ms-6 card-body pt-1" style="border-right: 1px solid grey;">
                                    <Strong style="font-size: 17px mt-1 mr-0"> Heure Matinnée</Strong>
                                    <hr class="mx-1 mt-1 w-75">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="heure1">Heure 1 :</label>
                                        <table class="w-100 mx-3">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="form-label" for="morningD1">Debut :</label>
                                                        <input type="time" name="martin1[]" class="form-control w-75" id="morningD1">
                                                    </td>
                                                    <td>
                                                        <label class="form-label" for="morningF1">Fin :</label>
                                                        <input type="time" name="martin2[]" class="form-control w-75" id="morningF1">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="heure2">Heure 2 :</label>
                                        <table class="w-100 mx-3">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="form-label" for="morningD2">Debut :</label>
                                                        <input type="time" name="martin1[]" class="form-control w-75" id="morningD2">
                                                    </td>
                                                    <td>
                                                        <label class="form-label" for="morningF2">Fin :</label>
                                                        <input type="time" name="martin2[]" class="form-control w-75" id="morningF2">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="heure3">Heure 3 :</label>
                                        <table class="w-100 mx-3">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="form-label" for="morningD3">Debut :</label>
                                                        <input type="time" name="martin1[]" class="form-control w-75" id="morningD3">
                                                    </td>
                                                    <td>
                                                        <label class="form-label" for="morningF3">Fin :</label>
                                                        <input type="time" name="martin2[]" class="form-control w-75" id="morningF3">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="heure4">Heure 4 :</label>
                                        <table class="w-100 mx-3">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="form-label" for="morningD4">Debut :</label>
                                                        <input type="time" name="martin1[]" class="form-control w-75" id="morningD4">
                                                    </td>
                                                    <td>
                                                        <label class="form-label" for="morningF4">Fin :</label>
                                                        <input type="time" name="martin2[]" class="form-control w-75" id="morningF4">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Heure 5 :</label>
                                        <table class="w-100 mx-3">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="form-label" for="morningD5">Debut :</label>
                                                        <input type="time" name="martin1[]" class="form-control w-75" id="morningD5">
                                                    </td>
                                                    <td>
                                                        <label class="form-label" for="morningF5">Fin :</label>
                                                        <input type="time" name="martin2[]" class="form-control w-75" id="morningF5">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-ms-6 card-body pt-1 ml-0">
                                    <Strong style="font-size: 17px"> Heure Après Midi</Strong>
                                    <hr class="mx-1 mt-1 w-75">
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="heure1">Heure 1 :</label>
                                        <table class="w-100 mx-3">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="form-label" for="afterD1">Debut :</label>
                                                        <input type="time" name="after1[]" class="form-control w-75" id="afterD1">
                                                    </td>
                                                    <td>
                                                        <label class="form-label" for="afterF1">Fin :</label>
                                                        <input type="time" name="after2[]" class="form-control w-75" id="afterF1">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="heure2">Heure 2 :</label>
                                        <table class="w-100 mx-3">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="form-label" for="afterD2">Debut :</label>
                                                        <input type="time" name="after1[]" class="form-control w-75" id="afterD2">
                                                    </td>
                                                    <td>
                                                        <label class="form-label" for="afterF2">Fin :</label>
                                                        <input type="time" name="after2[]" class="form-control w-75" id="afterF2">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="heure3">Heure 3 :</label>
                                        <table class="w-100 mx-3">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="form-label" for="afterD3">Debut :</label>
                                                        <input type="time" name="after1[]" class="form-control w-75" id="afterD3">
                                                    </td>
                                                    <td>
                                                        <label class="form-label" for="afterF3">Fin :</label>
                                                        <input type="time" name="after2[]" class="form-control w-75" id="afterF3">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="heure4">Heure 4 :</label>
                                        <table class="w-100 mx-3">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="form-label" for="afterD4">Debut :</label>
                                                        <input type="time" name="after1[]" class="form-control w-75" id="afterD4">
                                                    </td>
                                                    <td>
                                                        <label class="form-label" for="afterF4">Fin :</label>
                                                        <input type="time" name="after2[]" class="form-control w-75" id="afterF4">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Heure 5 :</label>
                                        <table class="w-100 mx-3">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <label class="form-label" for="afterD5">Debut :</label>
                                                        <input type="time" name="after1[]" class="form-control w-75" id="afterD5">
                                                    </td>
                                                    <td>
                                                        <label class="form-label" for="afterF5">Fin :</label>
                                                        <input type="time" name="after2[]" class="form-control w-75" id="afterF5">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-2">
                            <div class="text-center mt-0">
                                <button type="submit" class="btn btn-primary px-5">Validation</button>
                            </div>
                        </div>
                    </form>
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