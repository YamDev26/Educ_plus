@extends('auth')
@section('title', 'login')
@section('content')
<div class="card">
    <div class="card-body p-4">
        @error('email')
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <iconify-icon icon="solar:danger-triangle-bold-duotone" class="fs-20 me-1"></iconify-icon>
            <div class="lh-1">{{$message}}</div>
        </div>
        @enderror
        <div class="row flex-between-center">
            <div class="text-center">
                <span class="font-sans-serif text-primary fw-bolder fs-3 d-inline-block">Log In</span>
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
            <div class="d-flex justify-content-between mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkbox-signin" checked=>
                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                </div>
                <a href="{{route('password.request')}}" class="text-muted border-bottom border-dashed">Forget Password</a>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Log In</button>
            </div>
        </form>
    </div>
</div>
@endsection