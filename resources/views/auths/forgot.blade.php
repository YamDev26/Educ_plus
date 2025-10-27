@extends('auth')
@section('title', 'forgot-password')
@section('content')
<div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
    <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
        <div class="card-body">
            <img src="{{ asset('assets/images/login-images/forgot-password-cover.svg') }}" class="img-fluid auth-img-cover-login" width="650" alt=""/>
        </div>
    </div>
</div>
<div class="col-12 col-xl-5 col-xxl-4 auth-cover-right bg-light align-items-center justify-content-center">
    <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
        <div class="card-body p-sm-5">
            @error('email')
            <div class="alert border-0 alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class="bx bxs-message-square-x"></i>
                    </div>
                    <div class="ms-3">
                        <div class="text-white">{{$message}}</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @enderror
            <div class="p-3">
                <div class="text-center">
                    <img src="{{ asset('assets/images/icons/forgot-2.png') }}" width="100" alt="">
                </div>
                <h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
                <p class="text-muted">Enter your registered email ID to reset the password</p>
                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="my-4">
                        <label class="form-label" for="email">Email<span class="text-danger">*</span> :</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Entrez votre adresse mail ici">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-light px-5" style="border-radius: 3px">Send</button>
                    </div>
                </form>
                <div class="text-center my-3">
                    <a href="{{ route('login') }}">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection