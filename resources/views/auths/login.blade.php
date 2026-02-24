
@extends('auth')
@section('title', 'Login')
@section('content')
<div class="col-12 col-xl-7 col-xxl-8 auth-cover-left align-items-center justify-content-center d-none d-xl-flex">
    <div class="card shadow-none bg-transparent shadow-none rounded-0 mb-0">
        <div class="card-body">
            <img src="{{ asset('assets/images/login-images/login-cover.svg') }}" class="img-fluid auth-img-cover-login" width="650" alt=""/>
        </div>
    </div>
</div>
<div class="col-12 col-xl-5 col-xxl-4 auth-cover-right align-items-center justify-content-center">
    <div class="card rounded-0 m-3 shadow-none bg-transparent mb-0">
        <div class="card-body p-sm-5">
            <div class="form">
                {{-- <div class="text-center mb-4">
                    <h5 class="">{{ config('app.name') }}</h5>
                </div> --}}
                <div class="text-center">
                    <img src="{{ asset('assets/images/login-images/lock.png') }}" width="100" alt="">
                </div>
                <div class="form-body mb-2">
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
                <div class="text-center text-danger">
                    @error('email')
                        {{$message}}
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
@endsection