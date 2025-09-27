@extends('auth')
@section('title', 'login')
@section('content')
<div class="card">
    <div class="card-body p-4">
        @error('email')
            <div class="alert alert-danger py-1 border-0 d-flex align-items-center" role="alert">
                <div class="bg-danger me-1 m-0 icon-item">
                    <svg class="svg-inline--fa fa-times-circle text-white fs-7" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times-circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                        <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z"></path>
                    </svg>
                </div>
                <p class="mb-0 flex-1" style="font-size: 12px">{{$message}}</p>
                <button class="btn-close" style="font-size: 10px" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @enderror
        <div class="row flex-between-center">
            <div class="text-center">
                <span class="font-sans-serif text-primary fw-bolder fs-5 d-inline-block">CONNEXION</span>
                <hr class="my-0 mx-3">
            </div>
        </div>
        <form class="mt-4" action="{{route('login')}}" method="post">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="email">Email Address :</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Email address"/>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Password :</label>   
                <input type="password" name="password" id="password" class="form-control" placeholder="Password"/>
            </div>
            <div class="row flex-between-center">
                <div class="col-auto">
                    <div class="form-check mb-0">
                        <input class="form-check-input" type="checkbox" id="basic-checkbox" checked="checked" />
                        <label class="form-check-label mb-0" for="basic-checkbox">Remember me</label>
                    </div>
                </div>
                <div class="col-auto">
                    <a class="fs-10" href="{{route('password.request')}}">Forgot Password ?</a>
                </div>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Log In</button>
            </div>
        </form>
        <div class="position-relative mt-4">
        <hr/>
        <div class="divider-content-center">or log in with</div>
        </div>
        <div class="row g-2 mt-2">
            <div class="col-sm-6">
                <a class="btn btn-outline-google-plus btn-sm d-block w-100" href="#"><span class="fab fa-google-plus-g me-2" data-fa-transform="grow-8"></span> google</a>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-outline-facebook btn-sm d-block w-100" href="#"><span class="fab fa-facebook-square me-2" data-fa-transform="grow-8"></span> facebook</a>
            </div>
        </div>
    </div>
</div>
@endsection