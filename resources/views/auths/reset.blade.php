@extends('auth')
@section('title', 'reset-password')
@section('content')
<div class="mb-4 text-center">
    <img src="{{ asset('assets/images/logo-icon.png') }}" width="60" alt="" />
</div>
<div class="text-start mb-4">
    <h5 class="">Genrate New Password</h5>
    <p class="mb-0">We received your reset password request. Please enter your new password!</p>
</div>
<form class="mt-4" action="{{ route('password.update') }}" method="post">
    @csrf
    <input type="hidden" name="token" value="{{ $request->route('token') }}">
    <div class="mb-3 mt-4">
        <label class="form-label">New Password</label>
        <input type="text" class="form-control" placeholder="Enter new password">
    </div>
    <div class="mb-4">
        <label class="form-label">Confirm Password</label>
        <input type="text" class="form-control" placeholder="Confirm password">
    </div>
    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-light px-5" style="border-radius: 3px">Valider</button>
    </div>
</form>
<div class="text-center my-3">
    <a href="{{ route('login') }}">Back to Login</a>
</div>
@endsection