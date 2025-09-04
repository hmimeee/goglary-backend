@extends('layouts.guest')

@section('title', 'Forgot Password')
@section('page-title', 'Reset Password')
@section('page-subtitle', 'Enter your email to receive reset instructions')

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

<div class="text-center mb-4">
    <p class="text-muted mb-4">
        Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.
    </p>
</div>

<form method="POST" action="{{ route('password.email') }}">
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

    <button type="submit" class="btn btn-guest">
        <i class="fas fa-paper-plane me-2"></i>Send Reset Link
    </button>
</form>
@endsection

@section('footer')
<a href="{{ route('login') }}" class="text-link">
    <i class="fas fa-arrow-left me-1"></i>Back to Login
</a>
@endsection
