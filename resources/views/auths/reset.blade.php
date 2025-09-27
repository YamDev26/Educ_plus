@extends('auth')
@section('title', 'reset-password')
@section('content')
<div class="card">
    <div class="card-body p-4">
        <div class="row flex-between-center">
            <div class="text-center">
                <span class="font-sans-serif text-primary fw-bolder fs-5 d-inline-block">RESET NEW PASSWORD</span><br>
                <hr class="my-0 mx-3">
            </div>
        </div>
        <form class="mt-4" action="#" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="card-email">New Password :</label>
                <input class="form-control" type="text" placeholder="New Password"/>
            </div>
            <div class="mb-3">
                <label class="form-label" for="card-email">Confirm Password :</label>
                <input class="form-control" type="text" placeholder="Confirm Password"/>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Send Reset Link</button>
            </div>
        </form>
        <div class="text-center mt-4">
            <hr class="mb-0">
            <a class="fs-10 text-600 " href="{{route('login')}}">I can't recover my account using this page</a>
        </div>
        
    </div>
</div>
@endsection