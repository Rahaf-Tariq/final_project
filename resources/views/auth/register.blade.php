@extends('layouts.app')

@section('title', 'Register - ShopHub')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-5">
                        <h1 class="card-title text-center mb-4">Register</h1>

                        <form method="POST" action="{{ route('register') }}" novalidate>
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" required>
                                @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-lg mb-3">
                                <i class="fas fa-user-plus me-2"></i>Register
                            </button>
                        </form>

                        <p class="text-center">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-primary">Login here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
