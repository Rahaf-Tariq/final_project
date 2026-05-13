@extends('layouts.app')

@section('title', 'Login - ShopHub')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-5">
                        <h1 class="card-title text-center mb-4">Login</h1>

                        <form method="POST" action="{{ route('login') }}" novalidate>
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required autofocus>
                                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" required>
                                @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-lg mb-3">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </form>

                        <p class="text-center">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="text-primary">Register here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
