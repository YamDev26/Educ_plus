
@extends('auth')
@section('title', 'login')
@section('content')
<div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
    <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
        <div class="card-body">
                <img src="{{ asset('assets/images/login-images/login-cover.svg') }}" class="img-fluid auth-img-cover-login" width="650" alt=""/>
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
            <div class="">
                <div class="mb-3 text-center">
                    <img src="{{ asset('assets/images/logo-icon.png') }}" width="60" alt="">
                </div>
                <div class="text-center mb-4">
                    <h5 class="">{{ config('app.name') }}</h5>
                    <p class="mb-0">Please log in to your account</p>
                </div>
                <div class="form-body">
                    <form action="{{route('login')}}" method="post" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label class="form-label" for="email">Email Address :</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Email address">
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="password">Password :</label>
                            <div class="input-group mt-0" id="show_hide_password">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="checkbox-signin">
                                <label class="form-check-label" for="checkbox-signin">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">	<a href="{{ route('password.request') }}">Forgot Password ?</a>
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-light px-5" style="border-radius: 3px">Sign in</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection