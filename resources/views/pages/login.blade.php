@extends('layouts.auth')

@section('title', 'login')

@section('content')
<div class="form-container shadow-lg mx-auto">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error</strong> {{$error}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endforeach
    @endif

    <h2 class="form-title">Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <input type="email" class="form-control" placeholder="Email Address" name="email"
                value="{{ old('email') }}">
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
        </div>
        <button type="submit" class="btn btn-custom">Login</button>
        <div class="form-footer">
            <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
        </div>
    </form>
</div>
@endsection