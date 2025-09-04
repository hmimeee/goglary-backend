@extends('layouts.guest')

@section('title', 'Login')
@section('page-title', 'Welcome Back')
@section('page-subtitle', 'Please sign in to continue')

@section('content')
@if(session('status'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="email" class="form-control" id="email" name="email"
                   value="{{ old('email') }}" placeholder="Enter your email" required autofocus>
        </div>
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password" class="form-control" id="password" name="password"
                   placeholder="Enter your password" required>
        </div>
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="remember" name="remember">
        <label class="form-check-label" for="remember">Remember me</label>
    </div>

    <button type="submit" class="btn btn-guest">
        <i class="fas fa-sign-in-alt me-2"></i>Sign In
    </button>
</form>
@endsection

@section('footer')
@if (Route::has('password.request'))
    <a href="{{ route('password.request') }}" class="text-link">Forgot your password?</a>
@endif
@endsection
