

@extends('layouts.auth')

@section('title', 'register')

@section('content')
<div class="form-container shadow-lg mx-auto mt-5">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error</strong> {{$error}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif
    <h2 class="form-title">Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <input type="text" name="name" class="form-control" placeholder="Full Name">
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email Address">
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
        </div>
        <button type="submit" class="btn btn-custom">Register</button>
        <div class="form-footer">
            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>
    </form>
</div>
@endsection